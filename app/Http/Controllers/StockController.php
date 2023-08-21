<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Projet;


use App\Models\Stock;

use App\Models\Demande_fourniture;

use Illuminate\Support\Facades\Auth;


use App\Models\Article_demande_fourniture;

use App\Models\User;

class StockController extends Controller
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
        return view('stock.index');
     }


     public function view_stock($id)
     {
        $data = array( 'id'=> $id );
        return view('stock.view',$data);
        
     }


     public function get_data_stock($id){

        $stocks = Stock::where('projets_id', '=', $id)->get(); 

        return $stocks ; 

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
         return view('stock.add',$data);
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

     public function all_stocks(){
        $projets = Projet::all(); 
        $array_projets = array();
        for($i=0;$i<count($projets);$i++)
        {
            $array_projets[]=  array ('id' => $projets[$i]->id  , 'name' => $projets[$i]->client ." / ".$projets[$i]->n_marche ) ;
            
        }
        return  $array_projets ;

     }
     
     public function gestion_demande_stock()
     {
        return view('stock.demande');

     }
    
     public function create_demande_stock()
     {
        $projets = Projet::all();

        $articles= Stock::all();


       // Étape 2: Traiter les données en doublon
       $articleQuantities = [];
       foreach ($articles as $article) {
           $articleName = $article->article; // Remplacez "nom" par le nom de la colonne contenant le nom de l'article
           $quantity = $article->qte; // Remplacez "quantite" par le nom de la colonne contenant la quantité
       
           if (array_key_exists($articleName, $articleQuantities)) {
               // L'article existe déjà dans le tableau, augmenter la quantité
               $articleQuantities[$articleName] += $quantity  ;
           } else {
               // Ajouter l'article au tableau
               $articleQuantities[$articleName] = $quantity;
           }
        }

        $data = array( "projets" =>  $projets , "all_article" =>  $projets , 'article_list' => $articleQuantities  );
        return view('stock.create_demande', $data);

     }

     public function api_stock_article(Request $request){

        
      

       $articles = Stock::where('type', '=', $request->type )->get();


       // Étape 2: Traiter les données en doublon
       $articleQuantities = [];
       foreach ($articles as $article) {
           $articleName = $article->article; // Remplacez "nom" par le nom de la colonne contenant le nom de l'article
           $quantity = $article->qte; // Remplacez "quantite" par le nom de la colonne contenant la quantité
       
           if (array_key_exists($articleName, $articleQuantities)) {
               // L'article existe déjà dans le tableau, augmenter la quantité
               $articleQuantities[$articleName] += $quantity  ;
           } else {
               // Ajouter l'article au tableau
               $articleQuantities[$articleName] = $quantity;
           }
        }

        return  $articleQuantities;
        
     }

     public function fill_item_stock($id){

        $projets = Projet::all();
        $product   = Stock::where('projets_id', '=', $id )->get(); 

        $data = array( "projets" =>  $projets , "products" =>  $product );


        return  $data;

    }
    public function api_qte_article($id){

        
        $articles= Stock::all();


       // Étape 2: Traiter les données en doublon
       $articleQuantities = [];
       foreach ($articles as $article) {
           $articleName = $article->article; // Remplacez "nom" par le nom de la colonne contenant le nom de l'article
           $quantity = $article->qte; // Remplacez "quantite" par le nom de la colonne contenant la quantité
       
           if (array_key_exists($articleName, $articleQuantities)) {
               // L'article existe déjà dans le tableau, augmenter la quantité
               $articleQuantities[$articleName] += $quantity  ;
           } else {
               // Ajouter l'article au tableau
               $articleQuantities[$articleName] = $quantity;
           }
        }

        return  $articleQuantities[$id];
        
     }
     public function store_demande_stock(Request $request){
     
        $id_user = Auth::id();

        $new = new Demande_fourniture();
        $new->id_user  =  $id_user;
        $new->id_projet_concerne   = $request->projet;
       
        $new->save();

        for($i=0;$i<count($request->article);$i++){

            $create = new Article_demande_fourniture();
          
            $create->id_demande_fourniture   = $new->id;
            $create->nom_article  = $request->article[$i];
            $create->qte_demander  = $request->quantity[$i];
            $create->save();

        }

        return redirect()->to('/gestion_demande_stock');



     }
     public function api_all_demandes_fourniture(){

       $demande_fourniture =  Demande_fourniture::all();

       


       for($i=0;$i<count($demande_fourniture);$i++)
         {
            $projet = Projet::find( $demande_fourniture[$i]->id_projet_concerne );

            $user = User::find( $demande_fourniture[$i]->id_user  );

             $all_demande_fourniture[] = (object) [ 
             'id'=> $demande_fourniture[$i]->id ,
             'user'=> $user->name ,
             'projet_concerne'=> $projet->n_marche.'_'.$projet->client ,
             'etat'=> $demande_fourniture[$i]->etat ,
                
             ];
             
     
         }

         return $all_demande_fourniture;


     }
}
