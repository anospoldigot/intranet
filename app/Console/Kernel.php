<?php

namespace App\Console;

use App\Jobs\ChangeStatusEvent;
use App\Jobs\EventNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
 
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new ChangeStatusEvent)->everyMinute();
        // $schedule->job(new EventNotification)->everyFiveMinutes();

        // $schedule->command('inspire')->hourly();
        // $schedule->call(new EventNotifications)->daily();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
