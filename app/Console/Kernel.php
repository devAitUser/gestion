<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Models\Facture;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\CommandName::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:name')->everyMinute();


        $schedule->call(function () {
            // $today = Carbon::now()->toDateString();
            // $dateEntries = DateEntry::all();
    
            // $date =  '26/07/2023'; 
        
            // $today = Carbon::now()->toDateString();
    
            // $userDate = Carbon::createFromFormat('d/m/Y', $date);   
        
    
            // // Vérifier si un mois complet s'est écoulé
            // if ($userDate->addMonth()->toDateString() == $today) {
            //      echo  'Un mois complet sest écoulé depuis la date saisie.';
            // } else {
            //      echo $userDate->toDateString();
            // }

            $facture = new Facture();

            $facture->objet = "tret";
            $facture->client = "tret";
            $facture->date = "20-10-2023";
            $facture->save();



        })->everyMinute(); 
   
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
