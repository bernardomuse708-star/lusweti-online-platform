<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\SectionType;
use Illuminate\Console\Command;

class CheckPages extends Command
{
    protected $signature = 'pages:check';
    protected $description = 'Check pages and sections';

    public function handle()
    {
        $this->info('Pages: ' . Page::count());
        $this->info('Page Sections: ' . PageSection::count());
        $this->info('Section Types: ' . SectionType::count());

        $page = Page::first();
        if ($page) {
            $this->info('First page: ' . $page->title . ' (slug: ' . $page->slug . ')');
            $this->info('Status: ' . $page->status);
            $this->info('Sections count: ' . $page->sections->count());
            
            foreach ($page->sections as $section) {
                $this->info('  - Section: ' . $section->title);
                $this->info('    Type: ' . $section->sectionType->name);
                $this->info('    Livewire Component: ' . ($section->sectionType->livewire_component ?? 'NULL'));
                $this->info('    Visible: ' . ($section->is_visible ? 'YES' : 'NO'));
            }
        }

        return 0;
    }
}
