<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Commands\CheckAttendance;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('attendance:check')->dailyAt('17:01');

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        //Commands\CheckAttendance::class
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    
        
        //$this->load(__DIR__.'/Commands');

        //require base_path('routes/console.php');
}
