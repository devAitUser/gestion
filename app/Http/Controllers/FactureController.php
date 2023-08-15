<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Client;
use App\Models\Order;
use App\Models\User;
use App\Models\Facture;
use App\Models\Product_facture;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Models\Projet;
use \NumberFormatter;
use Artisan;
use DateTime;
use Carbon\Carbon;
 
use App\Models\Facture_client;
use App\Models\Article_facture_client;
class FactureController extends Controller
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
       return view('facture.index');
    }


    public function getdevis(Request $request)
    {
        $devis = Facture::all(); 
        $data = array( 'devis'=> $devis);
        return  $data ;

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $products= Product::all();
        $clients = Client::all();
        
        $data = array( 'products'=> $products , 'clients'=> $clients   );
        return view('facture.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

       


        if (!$request->product) {

            session()->flash('no_product','no_product');
            return redirect()->to('/facture/create');

        } else {


            if($request->isMethod('post')){

                $add_devis = new Facture();
                $add_devis->objet= $request->input('objet');
                $add_devis->date= $request->input('date');
                $add_devis->client= $request->input('client');
                $add_devis->save();
                
                for($i=0;$i<count($request->product);$i++){
                    $product_devis = new Product_facture();
                    $product_devis->facture_id  = $add_devis->id;
                    $product_devis->designation = $request->product[$i];
                    $product_devis->quantite = $request->quantity[$i];
                    $product_devis->quantite_max = $request->quantite_max[$i];
                 
                    $product_devis->prix = $request->prix[$i];
                    $product_devis->save();
                }
    
                return redirect()->to('/facture');
            
            }
           

        }
        $request->all();


       
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
        //
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
        $client = Client::find($request->id);
        $client->nom = $request->nom;
        $client->telephone = $request->telephone;
        $client->adresse = $request->adresse;
       
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
        $client_client= Facture::find($id);  

        $client_client->delete();
    }

    function pdf($id)
    {

     $devis= Facture::find($id);

     
     $products = Product_facture::where('facture_id', '=', $devis->id)->get(); 

     
        for($i=0;$i<count($products);$i++)
        {
            $table_product[] = (object) [ 
            'id'=> $products[$i]->id ,
            'designation'=> $products[$i]->designation,
            'quantite_max'=> $products[$i]->quantite_max ,
            'quantite'=> $products[$i]->quantite ,
            'prix'=> $products[$i]->prix , 
            'prix_total'=> $products[$i]->prix * $products[$i]->quantite , 
            ];
            $sum[] =  $products[$i]->prix * $products[$i]->quantite ;
    
        }

        function sumArray($array) {
            $total = 0;
            foreach ($array as $value) {
                $total += $value;
            }
    
            return $total;
        }

        function calcul_tva($value) {
            $value = $value * 0.20;
            return $value;
        }

        $calcul_total_htva = sumArray($sum);
        $calcul_tva= calcul_tva($calcul_total_htva);
        $calcul_ttc= $calcul_tva +  $calcul_total_htva;
        $date = date('d/m/Y ', time());

        $letter_to_number = new \NumberFormatter('fr', \NumberFormatter::SPELLOUT);

        $devis['products']=$table_product;
        $devis['current_date']= $date;
        $devis['total_htva']= number_format($calcul_total_htva,2,",",".");
        $devis['tva']= number_format($calcul_tva,2,",",".");
        $devis['ttc']= number_format($calcul_ttc,2,",",".") ;
        $devis['amount_letter']= $letter_to_number->format($calcul_ttc);

     

     
         view()->share('devis', $devis);
         $pdf = PDF::loadView('facture.pdf');
     
         return $pdf->stream();


    }

    public function facture_client()
    {

        return view('facture_client.index');

    }

    
    public function edit_facture_client($id)
    {
        $facture_client = Facture_client::find($id);
        $article_facture_clients=  Article_facture_client::where('id_facture_clients', '=', $id )->get(); 
        $projets = Projet::all();
        

        $data = array( "projets" =>  $projets ,  "facture_client" =>  $facture_client ,  "article_facture_clients" =>  $article_facture_clients );

        return view('facture_client.edit', $data);

    }

    public function new_facture_client()
    {

        $projets = Projet::all();

        $data = array( "projets" =>  $projets );

        return view( 'facture_client.ajouter' , $data );

    }


    public function fill_projet_article($id){


        $product_facture   = Product_facture::where('facture_id', '=', $id )->get(); 

        return  $product_facture;

    }

   

    
    public function store_facture_client(Request $request){


        $projet = Projet::find($request->projet);

        $add_facture   = new Facture_client();
        $add_facture->id_projet = $request->projet;
        $add_facture->nom_projet = $projet->client;
        $add_facture->date = $request->date;
        $add_facture->date_debut = $request->date_debut;
        $add_facture->date_fin = $request->date_fin;
        $add_facture->montant = $request->total_ttc;
        $add_facture->year = Carbon::now()->format('Y');
        $add_facture->save();

        
        for($i=0;$i<count($request->numero);$i++){

            $add   = new Article_facture_client();
            $add->numero = $request->numero[$i];
            $add->id_facture_clients  = $add_facture->id;
            $add->article  =  $request->product[$i];
            $add->quantite  =  $request->quantity[$i];
            $add->prix  =  $request->prix[$i];
            $add->save();

        }

        return redirect()->to('/facture_client/'); 


        
    }


    public function fill_table_facture_client(Request $request){

        $table_facture_client= array();

        $facture_client = Facture_client::where([ 'id_projet' =>  $request->id_projet  ,  'year'    => $request->anne ])->get();


        $projet = Projet::find($request->id_projet);

        for($i=0;$i<count($facture_client);$i++)
        {
            $table_facture_client[] = (object) [ 
            'id'=> $facture_client[$i]->id ,
            'nom_projet'=> $facture_client[$i]->nom_projet,
            'montant'=> $facture_client[$i]->montant,
            'date'=> $facture_client[$i]->date,
            'client'=> $projet->client ,
            'objet'=> $projet->objet , 
           
            ];
         
    
        }


        return  $table_facture_client ;


       
        
    }

    public function facture_client_pdf($id){

        $facture_client = Facture_client::find($id);


        $article_facture = Article_facture_client::where('id_facture_clients', '=', $id  )->get(); 


        $projet = Projet::find($facture_client->id_projet);
   
        
        for($i=0;$i<count($article_facture);$i++)
        {
            $table_product[] = (object) [ 
            'id'=> $article_facture[$i]->id ,
             'numero'=> $article_facture[$i]->numero,
             'article'=> $article_facture[$i]->article ,
             'quantite'=> $article_facture[$i]->quantite ,
             'prix'=> $article_facture[$i]->prix , 
             'prix_total'=> $article_facture[$i]->prix * $article_facture[$i]->quantite , 
            ];
            $sum[] =  $article_facture[$i]->prix * $article_facture[$i]->quantite ;
    
        }
   
       function sumArray($array) {
           $total = 0;
           foreach ($array as $value) {
               $total += $value;
           }
      
           return $total;
        }
   
        function calcul_tva($value) {
           $value = $value * 0.20;
           return $value;
        }
   
        $calcul_total_htva = sumArray($sum);
        $calcul_tva= calcul_tva($calcul_total_htva);
        $calcul_ttc= $calcul_tva +  $calcul_total_htva;
        $date = date('d/m/Y ', time());
    
        $letter_to_number = new \NumberFormatter('fr', \NumberFormatter::SPELLOUT);
        $facture['objet']= $projet->objet ;
        $facture['facture_client']= $facture_client ;
        $facture['info_facture']=$facture_client ;
        $facture['products']=$table_product;
        $facture['current_date']= $date;
        $facture['total_htva']= number_format($calcul_total_htva,2,",",".");
        $facture['tva']= number_format($calcul_tva,2,",",".");
        $facture['ttc']= number_format($calcul_ttc,2,",",".") ;
        $facture['amount_letter']= $letter_to_number->format($calcul_ttc);
    
            
    
            
        view()->share('facture', $facture);
        $pdf = PDF::loadView('facture_client.pdf');
            
        return $pdf->stream();


        




    }


    public function parametres_facture_client_pdf($id){

        $facture_client = Facture_client::find($id);
        $projet = Projet::find($facture_client->id_projet);

         $data = array( "id" =>  $id , "projet" =>  $projet  , "facture_client" =>  $facture_client  );
        return view('facture_client.parametre',$data);

    }

    public function update_facture_client(Request $request){

        $facture_client = Facture_client::find( $request->id_facture_client );
        $facture_client->date = $request->date;
        $facture_client->date_debut = $request->date_debut;
        $facture_client->date_fin  = $request->date_fin;
        $facture_client->save(); 

        /*$article_facture = Article_facture_client::where('id_facture_clients', '=', $request->id_facture_client  )->get();*/
        
        return redirect()->to('/edit_facture_client/'.$request->id_facture_client); 
         


    }

    



   


}
