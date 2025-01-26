<?php

namespace App\Console\Commands;

use App\Models\File;
use Illuminate\Console\Command;

class FileRandomContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:random-content {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate random content for a file';

    /**
     * Execute the console command.
     */
    public function handle(File $file   )
    {
        $file = File::find($this->argument('file'));
        $file->content = fake()->text(1000);
        $file->save();
    }
}
