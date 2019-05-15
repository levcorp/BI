<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Mail;
use App\Mail\Edi\Success;
use App\Mail\Edi\Failure;
use App\Text\EDI;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        
    ];
    protected function scheduleTimezone()
    {
        return 'America/La_Paz';
    }
    protected function schedule(Schedule $schedule)
    {
        $edi=new EDI;
        $count=$edi->count();
        $names=$edi->names();
        $schedule->command('edi:send')
                  ->dailyAt('23:30')
                  ->onSuccess(function () {
                    Mail::send(new Success($count,$names));
                  })
                  ->onFailure(function () {
                    Mail::send(new Failure);
                  });
    }
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
