<?php

namespace App\Http\Controllers;
use App\Models\Historique_paiement;

use Illuminate\Http\Request;

class Historique_paiementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($id)
    {
        $data = array('id'=> $id );
       return view('historique_paiement.index', $data);
    }


    public function get_paiements($id)
    {
        $historique_paiement = Historique_paiement::where('facture_fournisseur_id', '=', $id )->get();
        $data = array( 'historique_paiement'=> $historique_paiement);
       return  $data ;

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data = array( 'id'=> $id);
        return view('historique_paiement.add',$data); 
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
            $historique_paiement = new Historique_paiement; 
            $historique_paiement->facture_fournisseur_id  = $request->facture_fournisseur_id;
            $historique_paiement->mode_paiement = $request->mode_paiement;
            $historique_paiement->n_cheque  = $request->numero_cheque;
            $historique_paiement->date_cheque = $request->date_cheque;
            $historique_paiement->montant = $request->montant;
            $historique_paiement->etat_paiement = $request->etat_paiement;
            $historique_paiement->save();
            return Response()->json(['etat' => true  , 'id_historique_paiement' => $historique_paiement->id ]);
         } 
       
    }

    
    public function edit($id)
    {


        $clients   = Client::find($id);   


    
     
        $data = array( "clients" => $clients );
        return view('clients.edit',$data)  ; 
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
        $client = Historique_paiement::find($request->id);
        $client->mode_paiement = $request->mode_paiement;
        $client->n_cheque = $request->n_cheque;
        $client->date_cheque = $request->date_cheque;
        $client->montant = $request->montant;
        $client->etat_paiement = $request->etat_paiement;
   
    
        $client->save();
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete= Historique_paiement::find($id);  

        $delete->delete();
    }

}
