<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Mail\Edi\Success;
use App\Mail\Edi\Failure;
use App\Mail\Gpos\Failure as FailureGPOS;
use App\Mail\Gpos\Success as SuccessGPOS;
use App\Mail\Gpos\SuccessExcel as SuccessGPOSExcel;
use App\Text\EDIGPOS;
use App\Text\EDI;
use Mail;

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
        $schedule->command('edi:send')
                 ->dailyAt('23:00')
                 ->onSuccess(function () {
                    $edi=new EDI;
                    $count=$edi->count();
                    $names=$edi->names();
                    Mail::send(new Success($count,$names));
                  })
                 ->onFailure(function () {
                    Mail::send(new Failure);
                  });
        $schedule->command('gpos:send')
                 ->weeklyOn(1, '3:00')
                 ->onSuccess(function () {
                    $gpos=new EDIGPOS;
                    $counts=$gpos->counts();
                    $names=$gpos->names();
                    $count=$gpos->count();
                    $name=$gpos->name();
                    Mail::send(new SuccessGPOSExcel($count,$name));
                    Mail::send(new SuccessGPOS($counts,$names));
                  })
                 ->onFailure(function () {
                    Mail::send(new FailureGPOS);
                  });
        $schedule->command('upc:null')
                 ->dailyAt('17:00');
        $schedule->command('gpos:validate')
                 ->dailyAt('16:30');
        $schedule->command('DMI:start')
                 ->dailyAt('21:30');
       $schedule->command('speedTest:start')
                  ->dailyAt('12:00');
    }
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
