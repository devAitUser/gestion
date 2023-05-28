<?php

namespace App\Http\Controllers;
use App\Models\Projet;
use App\Models\Product_facture;
use App\Models\Client;


use Illuminate\Http\Request;

class ProjetsController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
       return view('projets.index');
    }


    public function get_projets(Request $request)
    {
        $projets = Projet::all(); 
        $data = array( 'projets'=> $projets);
       return  $data ;

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all(); 
        $data = array( 'clients'=> $clients);

        return view('projets.add',$data); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post')){
            $projet = new Projet; 
            $projet->client = $request->client;
            $projet->type_prestation = $request->type_prestation;
            $projet->objet = $request->objet;
            $projet->status = $request->status;
            $projet->n_marche = $request->n_marche;
            $projet->date_debut = $request->date_debut;
            $projet->duree = $request->duree;
            $projet->montant_min = $request->montant_min ;
            $projet->montant_max = $request->montant_max ;
          
            $projet->save();


            // for($i=0;$i<count($request->product);$i++){
            //     $product_devis = new Product_facture();
            //     $product_devis->facture_id  = $projet->id;
            //     $product_devis->numero = $request->numero[$i];
            //     $product_devis->designation = $request->product[$i];
            //     $product_devis->quantite = $request->quantity[$i];
            //     $product_devis->quantite_max = $request->quantite_max[$i];
             
            //     $product_devis->prix = $request->prix[$i];
            //     $product_devis->save();
            // }
        
            return redirect()->to('/projets');
         } 
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $clients   = Projet::find($id);   


    
     
        $data = array( "clients" => $clients );
        return view('projets.edit',$data)  ; 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $client = Projet::find($request->id);
        $client->nom_client = $request->nom_client;
        $client->personne_contact = $request->personne_contact;
        $client->ice = $request->ice;
        $client->telephone1 = $request->telephone1;
        $client->telephone2 = $request->telephone1;
        $client->numero_fax = $request->numero_fax;
        $client->adresse_complete = $request->adresse_complete;
        $client->adresse_mail = $request->adresse_mail;
        $client->ville = $request->ville;
    
        $client->save();
       
        return redirect()->to('/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client_client= Projet::find($id);  

        $client_client->delete();
    }
}
