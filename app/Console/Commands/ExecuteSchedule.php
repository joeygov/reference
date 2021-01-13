<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Schedule;

class ExecuteSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute Schedule on Delete';

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
     * @return int
     */
    public function handle()
    {
        \Log::info(get_class().'->handle(): Executing');

        $count = 0;

        Schedule::whereDate('start_date', Carbon::now())->each(function ($schedule) use (&$count)
        {
            $schedule->schedule_employee()->each(function ($query)
            {
                $query->delete();
            });

            $schedule->delete();

            $count++;
        });

        $headers = ['Total Deleted'];
        $data    = [['Total Deleted' => $count]];

        $this->table($headers, $data);
        \Log::info(get_class().'->handle(): Done');
    }
}
