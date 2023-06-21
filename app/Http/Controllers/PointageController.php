<?php

namespace App\Http\Controllers;

use App\Models\Pointage;
use App\Models\Projet;

use App\Models\Pointage_detail;


use App\Models\Affectation;
use App\Models\Employe; 


use App\Models\Info_pointage; 

use App\Models\pointage_detail_projet;
 

use Carbon\Carbon;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PointageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
       return view('pointage.index');
    }


    public function get_rh(Request $request)
    {
        $pointage = Pointage::all(); 

        $data = array( 'pointage'=> $pointage);
        return  $data ;




    }

    public function edit($id)
    {
        
        $data = array( 'id'=> $id);
        
        return view('pointage.edit',$data);

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


            $count = 0 ;
           

            $affectation = Affectation::where([ 'projet' =>  $request->id_projet  ,  'statut'    => 'actif' ])->get();


         
    

            $array_month = array(1 => 'janvier', 2 => 'février', 3 => 'mars', 4 => 'avril' , 5 => 'mai' , 6 => 'juin' , 7 => 'juillet' , 8 => 'août' , 9 => 'septembre' , 10 => 'octobre' , 11 => 'novembre' , 12 => 'décembre' );


            
            for($i=0;$i<count($affectation);$i++)
            {

                $date_debut = Carbon::parse($affectation[$i]->debut);

                $mois_entrer = array_search($request->mois, $array_month);

                if( $mois_entrer >= $date_debut->month  ){

                   


                    if($count == 0 ){

                        $add = new Pointage_detail(); 
                        $add->mois = $request->mois;
                        $add->anne = $request->date_year;
                        $add->projet_id = $request->id_projet;
                        $add->save();
                        
                    }

                    $employe = Employe::find( $affectation[$i]->employe_id );
                    $add_detail_projet = new pointage_detail_projet();
                    $add_detail_projet->projet_id = $request->id_projet;
                    $add_detail_projet->pointage_detail_id = $add->id;
                    $add_detail_projet->nom_prenom = $employe->nom . " " . $employe->prenom ;
                    $add_detail_projet->save();


                    $count++;

                }
               
            
     
            }

          


            
        
            return redirect()->to('/pointage/'.$request->id_projet.'/detail');
         } 
         $employe = Employe::all();
       
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
    public function get_pointage_detail($id){


        $pointage_detail = Pointage_detail::where('projet_id', '=', $id )->get();

        //$data = array( 'pointage_detail'=> $pointage_detail );


        $pointage_status = 0;



        for($i=0;$i<count($pointage_detail);$i++)
        {
 
            $projet = Projet::find( $pointage_detail[$i]->projet_id  );

            $info_pointage = Info_pointage::where('pointage_detail_id', '=', $pointage_detail[$i]->id )->get();

            if ($info_pointage  != null) {
                $pointage_status = 0;
             }else {
                $pointage_status = 1;
             }

 
            $att[] =  [ 
            'id' =>  $pointage_detail[$i]->id , 
            'client'=> $projet->client, 
            'projet_id' => $pointage_detail[$i]->projet_id  , 
            'anne' => $pointage_detail[$i]->anne , 
            'mois' => $pointage_detail[$i]->mois , 
            'status' => $pointage_status , 

             ];
 
        }

        $data = array( 'pointage_detail'=> $att );


        return  $data ;


    }
    public function pointage_saisir($id){



      $pointage_detail_projet = Pointage_detail_projet::where('pointage_detail_id', '=', $id )->get();


      $projet = Projet::find($pointage_detail_projet[0]->projet_id);


      $data = array( 'pointage_detail_projets'=> $pointage_detail_projet , 'projet_id'=> $id , 'projet'=> $projet->client  );

        return view('pointage.saisir',$data);

    }
    public function post_data_info_pointage(Request $request){

         

         for($i=0;$i<count($request->nom_prenom);$i++){
            $new  =  new info_pointage();
            $new->pointage_detail_id      = $request->projet_id;
            $new->nom_employe             = $request->nom_prenom[$i];
            $new->jour_travaille          = $request->jour_travaille[$i];
            $new->avance_salaire          = $request->avance_salaire[$i];

            $new->save();  
         }


         return redirect()->to('/pointage/'.$request->projet_id.'/valider');

         


    }

    public function pointage_valider($id){


        


        $pointage =  Info_pointage::where('pointage_detail_id', '=', $id )->get();


        $data = array( 'pointages'=> $pointage   );


        return view('pointage.valider',$data);


    
    }

    public function test_p(){
 
        $time = "1900-02-01 00:00:00";

        $maDate = Carbon::parse($time);
    

        $array_month = array(1 => 'janvier', 2 => 'février', 3 => 'mars', 4 => 'avril' , 5 => 'mai' , 6 => 'juin' , 7 => 'juillet' , 8 => 'août' , 9 => 'septembre' , 10 => 'octobre' , 11 => 'novembre' , 12 => 'décembre' );

        $key = array_search('août', $array_month);

        if( $key ==  $maDate->month){}


       return $maDate->month   ;
    }

    

}
