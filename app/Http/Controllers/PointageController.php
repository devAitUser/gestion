<?php

namespace App\Http\Controllers;

use App\Models\Pointage;
use App\Models\Projet;

use App\Models\Pointage_detail;


use App\Models\Affectation;

use App\Models\pointage_detail_projet;
 



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
            $add = new Pointage_detail(); 
            $add->mois = $request->mois;
            $add->anne = $request->date_year;
            $add->projet_id = $request->id_projet;
            $add->save();

            $affectation = Affectation::where([ 'projet' =>  $request->id_projet , 'statut'    => 'actif' ])->get();


            for($i=0;$i<count($affectation);$i++)
            {
               
                $add_detail_projet = new pointage_detail_projet();
                $add_detail_projet->projet_id = $request->id_projet;
                $add_detail_projet->nom_prenom = $affectation[$i]->nom ." ". $affectation[$i]->prenom ;
                
                $add_detail_projet->save();
     
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



        for($i=0;$i<count($pointage_detail);$i++)
        {
 
            $projet = Projet::find( $pointage_detail[$i]->projet_id  );
 
            $att[] =  [ 
            'id' =>  $pointage_detail[$i]->id , 
            'client'=> $projet->client, 
            'anne' => $pointage_detail[$i]->anne , 
            'mois' => $pointage_detail[$i]->mois , 

             ];
 
        }

        $data = array( 'pointage_detail'=> $att );


        return  $data ;


    }
    public function pointage_saisir(){

        return view('pointage.saisir');

    }

    

}
