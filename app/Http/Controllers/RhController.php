<?php

namespace App\Http\Controllers;

use App\Models\Employe;

use App\Models\Projet;

use App\Models\Affectation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RhController extends Controller
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
        return view('rh.index');
     }
 
 
     public function get_rh(Request $request)
     {
         $employes = Employe::all(); 
         $att_affectation = array();
         

         for($i=0;$i<count($employes);$i++)
         {

            $affectation = Affectation::where('employe_id', '=', $employes[$i]->id )->get();

            unset($att_affectation);
            $att_affectation = array();
            if ($affectation != null) {

                
                for($j=0;$j<count($affectation);$j++)
                {

                    $projet = Projet::find($affectation[$j]->projet );
                    if ($projet != null) {
                            $att_affectation[] =  [ 
                                'id'=>  $affectation[$j]->id , 
                                'projet'=> $projet->client, 
                                'debut'=> $affectation[$j]->debut , 
                                'fin'=> $affectation[$j]->fin , 
                                'statut'=> $affectation[$j]->statut , 

                                ];
                    }
                        
                }

             }

            


            
            $att[] =  [ 
                'id'=>  $employes[$i]->id , 
                'nom'=> $employes[$i]->nom, 
                'prenom'=> $employes[$i]->prenom , 
                'adresse'=> $employes[$i]->adresse , 
                'ville'=> $employes[$i]->ville , 
                'cnss'=> $employes[$i]->cnss ,
                'cin'=> $employes[$i]->cin ,
                'telephone'=> $employes[$i]->telephone ,
                'email'=> $employes[$i]->email ,
                'genre'=> $employes[$i]->genre ,
                'nationnalite'=> $employes[$i]->nationnalite ,
                'fonction'=> $employes[$i]->fonction ,
                'date_recrutement'=> $employes[$i]->date_recrutement ,
                'banque'=> $employes[$i]->banque ,
                'debut_contrat'=> $employes[$i]->debut_contrat ,
                'fin_contrat'=> $employes[$i]->fin_contrat ,
                'affectation'  => $att_affectation , 
                 ];

         }
         $data = array( 'employe'=> $att);
        return  $data ;
 
     }
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('rh.add'); 
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
             $add = new Employe; 
             $add->nom = $request->nom;
             $add->prenom = $request->prenom;
             $add->adresse = $request->adresse;
             $add->date_naissance = $request->date_naissance;
             $add->ville = $request->ville;
             $add->cnss = $request->cnss ;
             $add->cin = $request->cin ;
             $add->telephone = $request->telephone ;
             $add->email = $request->email ;
             $add->genre = $request->genre ;
             $add->nationnalite = $request->nationnalite ;
             $add->fonction = $request->fonction ;
             $add->date_recrutement = $request->date_recrutement ;
             $add->banque = $request->banque ;
             $add->debut_contrat = $request->debut_contrat ;
             $add->fin_contrat = $request->fin_contrat ;
             $add->save();
         
             return redirect()->to('/rh');
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
 
 
         $employe   = Employe::find($id);   
 
         $projets   = Projet::all();  
     
      
         $data = array( "employe" => $employe , "projets" => $projets  );
         return view('rh.edit',$data)  ; 
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
         $up = Employe::find($request->id);
         $up->nom = $request->nom;
         $up->prenom = $request->prenom;
         $up->adresse = $request->adresse;
         $up->date_naissance = $request->date_naissance;
         $up->ville = $request->ville;
         $up->cnss = $request->cnss ;
         $up->cin = $request->cin ;
         $up->telephone = $request->telephone ;
         $up->email = $request->email ;
         $up->genre = $request->genre ;
         $up->nationnalite = $request->nationnalite ;
         $up->fonction = $request->fonction ;
         $up->date_recrutement = $request->date_recrutement ;
         $up->banque = $request->banque ;
         $up->debut_contrat = $request->debut_contrat ;
         $up->fin_contrat = $request->fin_contrat ;
         $up->save();
     
         
        
         return redirect()->to('/rh');
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $delete= Employe::find($id);  
 
         $delete->delete();
     }

     public function delete_affectation($id)
     {
         $delete= Affectation::find($id);  
 
         $delete->delete();
     }

     public function test(){

        $edit =  Affectation::where('employe_id', '=' , 9 )->latest()->first();
        if($edit == null){
             $tt= "ok";
        }
        else {
            $tt= $edit->projet;  
        }
        return $tt;

     }


     public function store_affectation(Request $request){


        $edit =  Affectation::where('employe_id', '=' , $request->employe_id )->latest()->first();


        if ($edit == null) {

            $add = new Affectation; 
            $add->employe_id = $request->employe_id;
            $add->projet = $request->projet;
            $add->debut = $request->debut;
           
            $add->statut = 'actif';
    
            $add->save();
    
            return Response()->json(['etat' => true  , 'id' => $add->id , 'debut' => $add->debut ]);
           
         } else {

                if($edit->projet != $request->projet ){

                    $edit->fin= date_create($request->debut)->modify('-1 days')->format('Y-m-d');
                    $edit->statut = 'non actif';
                    $edit->save();
        
                    $add = new Affectation; 
                    $add->employe_id = $request->employe_id;
                    $add->projet = $request->projet;
                    $add->debut = $request->debut;
                    $add->fin = $request->fin;
                    $add->statut = 'actif';
            
                    $add->save();
            
                    return Response()->json(['etat' => true  , 'id' => $add->id , 'debut' => $add->debut , 'new_fin_date' => $edit->fin , 'old_id' => $edit->id ]);
        
                 
        
                }


         }




       

       

     }

    


     public function update_affectation(Request $request){

        $update= Affectation::find($request->id); 
        $update->projet = $request->projet;
        $update->debut = $request->debut;
        $update->fin = $request->fin;
        $update->statut = $request->statut;
        $update->save();

     }
}
