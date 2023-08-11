<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Facture_fournisseur;

use DateTime;

use App\Models\Fournisseur;

class CommandName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
     * @return int
     */
    public function handle()
    {


        while (true) {
          

            $fournisseurs =  Fournisseur::where([ 'type' =>  'Loyer' ,  'etat'    => 'Actif' ])->get();

            $datetime_system = new DateTime(date('Y-m-d')); // Date object for current date
            $datetime_system = $datetime_system->format('m');
            

            foreach ($fournisseurs as $fournisseur  ) {
                $date =  $fournisseur->date ; 
                $datetime = new DateTime($date); // Date object for current date
                $datetime->modify('next month'); // Modifying object to next month date
                $next_month_num = $datetime->format('m');
                if($datetime_system == $next_month_num){

                    $facture = new  Facture_fournisseur();
                    $facture->fournisseurs_id  = $fournisseur->id;
                    $facture->etat_paiement = 'non payé';
                    $facture->numero_facture = 0;
                    $facture->date = $fournisseur->date;
                    $facture->projet_id = $fournisseur->projet_id;
                    $facture->total_ttc = $fournisseur->montant;
                    $facture->save();

                    $up_date = new DateTime($fournisseur->date); // Date object for current date
                    $up_date->modify('next month'); 
                    $up_date = $up_date->format('Y-m-d');

                    $fournisseur->date = $up_date ; 
                    $fournisseur->save();

               
                
                }
               
            }

            // Pause d'une minute avant la prochaine itération
            sleep(60);
        }
    }
}
