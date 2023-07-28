<?php

namespace App\Http\Controllers;
use App\Models\Fournisseur;
use App\Models\Projet;
use App\Models\Historique_paiement;
use App\Models\Facture_fournisseur;
use App\Models\Article_facture_fournisseur;
use App\Models\Stock;
use Illuminate\Http\Request;
use PDF;

class Factures_fournisseurController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($id)
    {
        $fournisseur = Fournisseur::find($id); 
        $nom =  $fournisseur->nom;
        $data = array('id'=> $id , 'nom'=> $nom );
       return view('facture_fournisseurs.index' ,$data );
    } 

    public function get_all_factures_fournisseur()
    {
       $fournisseur = Facture_fournisseur::all();

       
       for($i=0;$i<count($fournisseur);$i++)
       {

           $historique_paiement = Historique_paiement::where('facture_fournisseur_id', '=', $fournisseur[$i]->id )->get();

           $att[] =  [ 
           'id'=>  $fournisseur[$i]->id , 
           'fournisseurs_id'=> $fournisseur[$i]->fournisseurs_id, 
           'etat_paiement'=> $fournisseur[$i]->etat_paiement , 
           'date'=> $fournisseur[$i]->date , 
           'projet_id'=> $fournisseur[$i]->projet_id , 
           'total_ttc'=> $fournisseur[$i]->total_ttc , 
           'historique_paiement'=> $historique_paiement , 
            ];

       }


       $data = array( 'fournisseur' => $att );
       return  $data ;
    }

    public function get_factures_fournisseur($id)
    {
       $fournisseur = Facture_fournisseur::where('fournisseurs_id', '=', $id )->get();
       $fournisseur_nom = Fournisseur::find($id);
       
       for($i=0;$i<count($fournisseur);$i++)
       {

           $historique_paiement = Historique_paiement::where('facture_fournisseur_id', '=', $fournisseur[$i]->id )->get();

           $total_payment = Historique_paiement::where([ 'facture_fournisseur_id' =>  $fournisseur[$i]->id ,  'etat_paiement'    => 'payé' ])->sum('montant');

           $att[] =  [ 
           'id' =>  $fournisseur[$i]->id , 
           'fournisseurs_id'=> $fournisseur[$i]->fournisseurs_id, 
           'etat_paiement' => $fournisseur[$i]->etat_paiement , 
           'date' => $fournisseur[$i]->date , 
           'projet_id' => $fournisseur[$i]->projet_id , 
           'total_ttc' => $fournisseur[$i]->total_ttc , 
           'numero_facture' => $fournisseur[$i]->numero_facture , 
           'historique_paiement' => $historique_paiement , 
           'fournisseur_nom' => $fournisseur_nom->nom , 
           'total_paye' => $total_payment , 
            ];

       }


       $data = array( 'fournisseur' => $att ,  );
       return  $data ;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $fournisseur = Fournisseur::find($id); 

        $article_facture_fournisseurs =  Article_facture_fournisseur::all(); 

        $article = array();

        for($i=0;$i<count($article_facture_fournisseurs);$i++)
        {

            $article[] = $article_facture_fournisseurs[$i]->article;

        }

        $projet = Projet::all(); 

        $data = array('fournisseur'=> $fournisseur->nom , 'id'=> $id , 'projets'=> $projet , 'articles'=> $article );


        return view('facture_fournisseurs.add',$data); 
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
            $facture_fournisseur = new Facture_fournisseur; 
            $facture_fournisseur->fournisseurs_id  =   $request->id_facture_fournisseur;
            $facture_fournisseur->etat_paiement    =   $request->type_etat_paiement;
            $facture_fournisseur->numero_facture   =   $request->numero_facture ;

            $facture_fournisseur->date        =   $request->date ;
            $facture_fournisseur->projet_id   =   $request->projet ;
            $facture_fournisseur->total_ttc   =   $request->total_ttc ;

            $facture_fournisseur->save();

            for($i=0;$i<count($request->product);$i++){
                $article_facture_fournisseurs = new Article_facture_fournisseur();
                $article_facture_fournisseurs->type   = $request->type[$i] ;
                $article_facture_fournisseurs->facture_fournisseur_id   = $facture_fournisseur->id ;
                $article_facture_fournisseurs->numero  = $request->numero[$i];
                $article_facture_fournisseurs->article = $request->product[$i];
                $article_facture_fournisseurs->qte =     $request->quantity[$i];
                $article_facture_fournisseurs->prix =    $request->prix[$i];
                $article_facture_fournisseurs->save();
            }

            for($i=0;$i<count($request->product);$i++){


               





                if($request->type[$i]  != 'Service' ){
                    $check_exist_stock = Stock::where([ 'article' => $request->product[$i] , 'prix'    =>    $request->prix[$i] ])->first();
                    if ($check_exist_stock === null) {
                        $item_stock = new Stock();
                        $item_stock->projets_id =  $request->projet;
                        $item_stock->article    =  $request->product[$i];
                        $item_stock->qte        =  $request->quantity[$i];
                        $item_stock->prix       =  $request->prix[$i];
                        $item_stock->save();
                     }else{
                        $check_exist_stock->qte = $check_exist_stock->qte +  $request->quantity[$i];
                        $check_exist_stock->save();
                     }

                 

                }
            }
        
            return redirect()->to('/factures_fournisseur/'.$request->id_facture_fournisseur); 
         } 



        
       

          


         //return $request->all();
       
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


        $fournisseur      = Facture_fournisseur::find($id);   

        $name_fournisseur = Fournisseur::find($fournisseur->fournisseurs_id);   

        $projet = Projet::all();


         

        $articles      = Article_facture_fournisseur::where('facture_fournisseur_id', '=', $fournisseur->id )->get();
    
     
        $data = array('fournisseur'=> $fournisseur , 'id'=> $id , 'projets'=> $projet ,  'name_fournisseur'=> $name_fournisseur->nom , 'articles'=> $articles  );
        return view('facture_fournisseurs.edit',$data)  ; 
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
       
        return redirect()->to('/facture_fournisseurs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete= Facture_fournisseur::find($id);  
        $delete->delete();
    }
    function pdf($id)
    {

     $facture_fournisseur = Facture_fournisseur::find($id);

     $fournisseur = Fournisseur::find($facture_fournisseur->fournisseurs_id );

     
     $article_facture_fournisseurs = Article_facture_fournisseur::where('facture_fournisseur_id', '=', $id)->get(); 

     
        for($i=0;$i<count($article_facture_fournisseurs);$i++)
        {
            $table_product[] = (object) [ 
            'id'=> $article_facture_fournisseurs[$i]->id ,
            'numero'=> $article_facture_fournisseurs[$i]->numero,
            'designation'=> $article_facture_fournisseurs[$i]->article,
            'quantite'=> $article_facture_fournisseurs[$i]->qte ,
            'prix'=> $article_facture_fournisseurs[$i]->prix , 
            'prix_total'=> $article_facture_fournisseurs[$i]->prix * $article_facture_fournisseurs[$i]->qte , 
            ];
            $sum[] =  $article_facture_fournisseurs[$i]->prix * $article_facture_fournisseurs[$i]->qte ;
    
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
        $devis['id']=$facture_fournisseur->id;
        $devis['client']=$fournisseur->nom;
        $devis['objet']=$facture_fournisseur->etat_paiement;
        $devis['date']=$date;
        $devis['products']=$table_product;
        $devis['current_date']= $date;
        $devis['total_htva']= number_format($calcul_total_htva,2,",",".");
        $devis['tva']= number_format($calcul_tva,2,",",".");
        $devis['ttc']= number_format($calcul_ttc,2,",",".") ;
        $devis['amount_letter']= $letter_to_number->format($calcul_ttc);

     

     
         view()->share('devis', $devis);
         $pdf = PDF::loadView('facture_fournisseurs.pdf');
     
         return $pdf->stream();
        return view('facture_fournisseurs.pdf');


    }
    public function view_all(){
        return view('facture_fournisseurs.view_all');
    }
  

}
