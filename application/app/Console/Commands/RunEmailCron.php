<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Cronjobs\EmailCron;

class RunEmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the EmailCron job to send regular queued emails';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            (new EmailCron())->__invoke();
            $this->info('EmailCron executed successfully.');
        } catch (\Exception $e) {
            $this->error('Error executing EmailCron: ' . $e->getMessage());
        }

        return 0;
    }
}
