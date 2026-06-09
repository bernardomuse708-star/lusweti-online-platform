<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:publish-scheduled-pages')]
#[Description('Command description')]
class PublishScheduledPages extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        Page::where('status', 'scheduled')
            ->where('published_at', '<=', now())
            ->update([
                'status' => 'published'
            ]);

        $this->info('Scheduled pages published successfully.');
    }
}
