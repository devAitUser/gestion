<?php

namespace App\Http\Controllers;
use App\Models\Projet;
use App\Models\Caisse_detail;

use Illuminate\Http\Request;

class CaisseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       return view('caisse.index');
    }

    public function caisse_detail($id)
    {

        $all_projet = Projet::all(); 

        $find_projet = Projet::find($id); 

        $data = array(  'id'=> $id , 'find_projet'=> $find_projet->administration , 'all_projets'=> $all_projet  );
        return view('caisse.detail',$data );
    }

    public function caisse_get_projet(Request $request)
    {
       
        $projets = Projet::all(); 


        for($i=0;$i<count($projets);$i++)
        {
 
            $solde = 0 ;
           

 
            $att[] =  [ 
            'id' =>  $projets[$i]->id , 
            'client'=> $projets[$i]->client,
            'status'=> $projets[$i]->administration, 
            'solde'=> $solde, 

             ];
 
        }
        $data = array( 'projets'=> $att);
      
        return  $data ;




    }

    public function projet_caisse(){

        $projet = Projet::all();
            
        $data = array( 'projets'=> $projet );
      
        return  $data ;

    }

    public function store_caisse_detail(Request $request){

        $new =  new Caisse_detail();

        $new->operation = $request->operation ; 

        $new->id_projet  = $request->id_projet  ;
        
        if(isset($request->origine_compte)){

            $new->origin__du_compte  = $request->origine_compte  ;

        }

        if(isset($request->type)){

            $new->type  = $request->type  ;

        }

        if(isset($request->type)){

            $new->type  = $request->type  ;

        }

        if(isset($request->type)){

            $new->type  = $request->type  ;

        }

        if(isset($request->banque)){

            $new->banque  = $request->banque  ;

        }

        $new->id_projet  = $request->current_id_projet  ;
        $new->date  = $request->date  ;

        $new->montant  = $request->montant  ;

        $new->save();

        return redirect()->to('/caisse/'.$request->current_id_projet.'/detail'); 

    }


}
