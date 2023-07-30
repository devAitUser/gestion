<?php

namespace App\Http\Controllers;
use App\Models\Projet;
use App\Models\Caisse_detail;

use Illuminate\Http\Request;
use App\Models\Facture;
use PDF;

use Session;

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

        $alimen = Caisse_detail::where([ 'id_projet' =>  $id  ,  'operation'    => 'Alimentation' ])->sum('montant');
        $depense = Caisse_detail::where([ 'id_projet' =>  $id  ,  'operation'    => 'dépense' ])->sum('montant');

        $solde  = $alimen - $depense ;

        $data = array(  'id'=> $id , 'find_projet'=> $find_projet->administration , 
        'nom_projet'=> $find_projet->client , 'all_projets'=> $all_projet , 'solde'=>   number_format($find_projet->solde,2,",",".")  );
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
            'solde'=> number_format($projets[$i]->solde,2,","," "), 

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

        $check = Projet::find($request->id_projet);

        if($request->operation == 'dépense'  ){

            if( $check->solde > $request->montant ){

                $new =  new Caisse_detail();

                $new->operation = $request->operation ; 
        
                $new->id_projet  = $request->id_projet  ;
                
        
        
                    $new->origin__du_compte  = 'Caisse' ;
        
            
        
                if(isset($request->type)){
        
                    $new->type  = $request->type  ;
        
                    if($request->type == 'alimentation'){
        
                        $add_alimentation =  new Caisse_detail();
        
                        $add_alimentation->operation = "Alimentation" ; 
        
                        $add_alimentation->id_projet  = $request->projet  ;
                        $add_alimentation->date  = $request->date  ;
                        $add_alimentation->montant  = $request->montant  ;
                        $add_alimentation->save();

                        $up_solde_caisse = Projet::find($request->projet);
                        $up_solde_caisse->solde = $up_solde_caisse->solde + $request->montant ; 
                        $up_solde_caisse->save();
                    }
        
                }
        
                if(isset($request->banque)){
        
                    $new->banque  = $request->banque  ;
        
                }

                $new->detail  = $request->detail  ;

                $new->Bénéficiaire  = $request->Bénéficiaire  ;
        
                $new->id_projet  = $request->current_id_projet  ;
                $new->date  = $request->date  ;
        
                $new->montant  = $request->montant  ;
        
                
                
                
        
                $new->save();
        
                $up_solde = Projet::find($request->id_projet);
                $up_solde->solde = $up_solde->solde - $request->montant ; 
                $up_solde->save();

            } else {
                Session::flash('var_dépense', 'Votre solde insuffisant'); 
            }

        }
        
        if($request->operation == 'Alimentation'  ){

                $new =  new Caisse_detail();

                $new->operation = $request->operation ; 
        
                $new->id_projet  = $request->id_projet  ;
                
                if(isset($request->origine_compte)){
        
                    $new->origin__du_compte  = $request->origine_compte  ;
        
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
        
                $up_solde = Projet::find($request->id_projet);
                $up_solde->solde = $up_solde->solde + $request->montant ; 
                $up_solde->save();
               

            

        }
        

        return redirect()->to('/caisse/'.$request->current_id_projet.'/detail'); 

    }

    public function get_caisse_detail($id){

        $caisse = Caisse_detail::where('id_projet', '=', $id )->get();

        $data = array( 'caisse_detail'=> $caisse );

        return $data ;

    }


    function pdf($id)
    {

       $caisse_detail= Caisse_detail::find($id);

        view()->share('caisse_detail', $caisse_detail);
        $pdf = PDF::loadView('caisse.pdf');
     
         //return view('caisse.pdf');
       return $pdf->stream();


    }

 


}
