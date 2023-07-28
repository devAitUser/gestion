<?php

namespace App\Http\Controllers;
use App\Models\Projet;
use App\Models\Product_facture;
use App\Models\Client;
use PDF;


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

            $client_explode = explode('|', $request->client); 

            $projet = new Projet; 
            $projet->client = $client_explode[0];
            $projet->id_client = $client_explode[1];
            $projet->type_prestation = $request->type_prestation;
            $projet->objet = $request->objet;
            $projet->status = $request->status;
            $projet->n_marche = $request->n_marche;
            $projet->date_debut = $request->date_debut;
            $projet->duree = $request->duree;
            $projet->montant_min = $request->montant_min ;
            $projet->montant_max = $request->montant_max ;
            $projet->file      =  $request->file('file')->store('public/projet_files') ;
          
            $projet->save();


            for($i=0;$i<count($request->product);$i++){
                $product = new Product_facture();
                $product->facture_id  = $projet->id;
                $product->numero = $request->numero[$i];
                $product->designation = $request->product[$i];
                $product->unite = $request->unite[$i];
                $product->quantite = $request->quantity[$i];
                $product->quantite_max = $request->quantite_max[$i];
                $product->prix = $request->prix[$i];
                $product->save();
            }
        
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

        $product_facture   = Product_facture::where('facture_id', '=', $id )->get();; 
        
    
     
        $data = array( "clients" => $clients , "product_factures" => $product_facture  );
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
    public function generate_pdf($id){
        $projet = Projet::find($id);
        $client = Client::find($projet->id_client);

        $product_factures =   Product_facture::where('facture_id', '=', $id )->get();

        view()->share('projet',  $projet);
        view()->share('client',  $client);
        view()->share('product_factures',  $product_factures);
        $pdf = PDF::loadView('projets.pdf');
     
         //return view('projets.pdf');
         return $pdf->stream();
    }
}
