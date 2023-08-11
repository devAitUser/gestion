<?php

namespace App\Http\Controllers;


use App\Models\Fournisseur;
use App\Models\Projet;
use Illuminate\Http\Request;

use App\Models\Facture_fournisseur;

use DateTime;

class FournisseurController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
       return view('fournisseur.index');
    } 

    public function get_fournisseur()
    {
       $fournisseur = Fournisseur::all(); 
       $data = array( 'fournisseur'=> $fournisseur);
       return  $data ;

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projets = Projet::all(); 
        $data = array( 'projets'=> $projets );

        return view('fournisseur.add', $data  ); 
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
            $client = new Fournisseur; 
            $client->nom = $request->nom;
            $client->personne_contact = $request->personne_contact;
            $client->email   = $request->email;
            $client->ice = $request->ice;
            $client->rib = $request->rib;
            $client->adresse = $request->adresse ;
            $client->specialite = $request->specialite ;
            $client->telephone = $request->telephone ;
            $client->type = $request->type ;
            $client->etat = $request->etat ;
            $client->date = $request->date ;
            $client->projet_id = $request->projet ;
            $client->montant = $request->montant ;
            $client->save();
            return redirect()->to('/fournisseur');
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


        $fournisseur   = Fournisseur::find($id);   


    
     
        $data = array( "fournisseur" => $fournisseur );
        return view('fournisseur.edit',$data)  ; 
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
        $client = Fournisseur::find($request->id);
        $client->nom = $request->nom;
        $client->personne_contact = $request->personne_contact;
        $client->email	 = $request->email;
        $client->ice = $request->ice;
        $client->rib = $request->rib;
        $client->adresse = $request->adresse;
        $client->specialite = $request->specialite;
        $client->telephone = $request->telephone;
        $client->type = $request->type;
    
        $client->save();
       
        return redirect()->to('/fournisseur');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete= Fournisseur::find($id);  

        $delete->delete();
    }
    

}
