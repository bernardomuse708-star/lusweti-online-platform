<?php 

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Page;

class PreviewPage extends Component
{
    public string $token;
    public $page;

    public function mount($token)
    {
        $this->token = $token;

        $this->page = Page::where('preview_token', $token)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.pages.preview-page');
    }
}