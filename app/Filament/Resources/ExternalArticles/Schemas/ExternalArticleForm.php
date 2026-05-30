<?php


namespace App\Filament\Resources\ExternalArticles\Schemas;

use App\Models\Article;
use Filament\Actions\Action as ActionsAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Forms\Components\Actions\Action;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Group as ComponentsGroup;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ExternalArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            ComponentsGroup::make()->schema([
                Section::make('Remote Data Source')->schema([
                    TextInput::make('external_url')
                        ->label('External Article Link')
                        ->url()
                        ->placeholder('https://example.com/sports-news-story')
                        ->columnSpanFull()
                        ->suffixAction(
                        ActionsAction::make('extract_metadata')
                            ->icon('heroicon-o-cloud-arrow-down')
                            ->color(Color::Emerald)
                            ->tooltip('Extract Remote Media Cover')
                            ->action(function (callable $set, $state, $livewire) {
                                if (blank($state)) {
                                    Notification::make()->title('Please enter a valid URL first.')->warning()->send();
                                    return;
                                }

                                try {
                                    $response = Http::timeout(8)->get($state);
                                    if ($response->failed()) throw new \Exception("Server returned status " . $response->status());

                                    $html = $response->body();
                                    preg_match('/<meta[^>]*property=["\']og:image["\'][^>]*content=["\']([^"\']+)["\'][^>]*>/i', $html, $matches);

                                    // Fallback to twitter image specification if OG tag is absent
                                    if (empty($matches[1])) {
                                        preg_match('/<meta[^>]*name=["\']twitter:image["\'][^>]*content=["\']([^"\']+)["\'][^>]*>/i', $html, $matches);
                                    }

                                    if (!empty($matches[1])) {
                                        $extractedImageUrl = $matches[1];

                                        // Set title or summaries if tags are available to speed up workflow execution
                                        preg_match('/<meta[^>]*property=["\']og:title["\'][^>]*content=["\']([^"\']+)["\'][^>]*>/i', $html, $titleMatches);
                                        if (!empty($titleMatches[1])) {
                                            $set('title', html_entity_decode($titleMatches[1]));
                                            $set('slug', Str::slug($titleMatches[1]));
                                        }

                                        // Store target down into component storage buffer state
                                        Notification::make()
                                            ->title('External Cover Image Extracted Successfully!')
                                            ->success()
                                            ->send();

                                        // Pass extracted payload back to Spatie standard initialization pool
                                        $livewire->dispatch('file-extracted', ['url' => $extractedImageUrl]);
                                    } else {
                                        Notification::make()->title('No preview images discovered on remote metadata headers.')->placeholder()->send();
                                    }
                                } catch (\Exception $e) {
                                    Notification::make()->title('Extraction failed: ' . $e->getMessage())->danger()->send();
                                }
                            })
                    ),
                ]),

                Section::make('Content Metadata')->schema([
                    TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),

                    TextInput::make('slug')
                        ->required()
                        ->unique(Article::class, 'slug', ignoreRecord: true),

                    Textarea::make('summary')->rows(3)->columnSpanFull(),

                    SpatieMediaLibraryFileUpload::make('featured_image')
                        ->collection('featured_image')
                        ->columnSpanFull()
                        ->disk('public')
                ])->columns(2),
            ])->columnSpan(['default' => 3, 'md' => 2]),

            ComponentsGroup::make()->schema([
                Section::make('Taxonomy')->schema([
                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->required()
                        ->searchable(),
                ]),
            ])->columnSpan(['default' => 3, 'md' => 1]),
        ])->columns(3);
    }
}