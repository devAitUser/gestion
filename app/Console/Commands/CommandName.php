<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Facture;

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
            // Mettez ici le code de la tâche que vous souhaitez exécuter chaque minute
            $facture = new Facture();

            $facture->objet = "tret";
            $facture->client = "tret";
            $facture->date = "20-10-2023";
            $facture->save();

            // Pause d'une minute avant la prochaine itération
            sleep(60);
        }
    }
}
