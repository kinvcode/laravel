<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeUploadLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upload:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a symbolic link from "public/storage" to "storage/app/public"';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (file_exists(public_path('filespace'))) {
            return $this->error('The "public/filespace" directory already exists.');
        }

        if (is_link(public_path('filespace'))) {
            $this->laravel->make('files')->delete(public_path('filespace'));
        }

        $this->laravel->make('files')->link(
            storage_path('app/filespace'), public_path('filespace')
        );

        $this->info('The [public/filespace] directory has been linked.');
    }
}
