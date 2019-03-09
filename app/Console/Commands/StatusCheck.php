<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StatusCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status_check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $sql = "UPDATE host_status SET status=\"Deactive\" WHERE status != \"Deactive\" AND lastcheck_at < CURRENT_TIMESTAMP + INTERVAL - 5 MINUTE";
        \DB::update($sql);
    }
}
