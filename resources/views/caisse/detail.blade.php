@extends('layouts.master')
@section('main-content')
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/materialdesignicons.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/vuetify.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('assets/styles/css/custom_vuetify.css') }}>
<div class="breadcrumb">

   <style>
      b.solde {
         color: green;
      }
   </style>
   <h1>  La liste des operations </h1>
</div>
@if(Session::has('var_dépense'))
<p class="alert alert-info">{{ Session::get('var_dépense') }}</p>
@endif
@include('layouts.common.flash_message')
<div class=" border-top"></div>
<div id="app" data-app>
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header  gradient-purple-indigo  0-hidden pb-80">
               <div class="pt-4">
                  <div class="row">
                     <h4 class="col-md-4 text-white">Caisse detail</h4>
                     <input v-model="search" type="text" class="form-control form-control-rounded col-md-4 ml-3 mr-3"  append-icon="mdi-magnify" placeholder="Rechercher produits ...">
                     <i aria-hidden="true" class="v-icon notranslate btn_search mdi mdi-magnify theme--light"></i>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="ul-contact-list-body">
                  <div class="ul-contact-main-content">
                     <div class="ul-contact-content">
                        <div class="card">
                           <v-card>
                              <v-card-title>
                                 Les mouvements de la caisse du projet :&nbsp; <b>{{$nom_projet}}</b> 
                                 &nbsp; &nbsp; &nbsp; Solde Actuel : &nbsp; <b class="solde">{{$solde}}</b> 
                                 <v-spacer></v-spacer>
                              </v-card-title>
                              <v-card-title class="text-right">
                                 <v-spacer></v-spacer>
                                
                                 <!-- Button trigger modal -->
                                 <button type="button" class="btn btn-primary btn-md m-1 text-white" data-toggle="modal" data-target="#Modal_pointage">
                                    <i class="nav-icon i-Shopping-Basket"></i>    Nouveau 
                                 </button>
                                
                              </v-card-title>
                              <v-data-table  @input="item($event)" :headers="headers" :items="caisses" :search="search" :value="selectedRows" v-model="selected" :items-per-page="5"  :sort-by.sync="sortBy"
                                 :sort-desc.sync="sortDesc" show-select   item-key="id"
                                 :expanded.sync="expanded" @click:row="clicked">
                                 
                                 
                                   <template v-slot:item.montant="{ item }">
                               
                                         <span v-if="item.operation == 'Alimentation' " class="badge badge-success"> <b> + @{{item.montant}} </b></span>
                                         <span v-else class="badge badge-danger" > <b> - @{{item.montant}}</b> </span>
                                 
                                 </template>
                            
                               
                              
                              </v-data-table>
                           </v-card>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Modal create pointage -->
            <div class="modal fade" id="Modal_pointage" tabindex="-1" role="dialog" aria-labelledby="Modal_pointage" aria-hidden="true">
               <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">créer</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <form method="POST" action="{{ route('store_caisse_detail') }}">
                     <div class="modal-body">
                  
                           @csrf
                     
                        <!-- <div class="form-group">
                           <label for="exampleFormControlInput1">Email address</label>
                           <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                           </div> -->


                           <div class="form-group">
                              <label for="exampleFormControlSelect1">Operations</label>
                              <input type="text" value="{{$id}}" name="current_id_projet" hidden>
                              <select name="operation" class="form-control" id="select_operation">
                                 <option value="" > Selectionner</option>
                                 @if($find_projet)
                                 <option value="Alimentation">Alimentation</option>
                                  @endif
                                 <option value="dépense" >dépense</option>
                        
                              </select>
                           </div>


                           <div id='alimen'>

                                 


                                

                           </div>


                           <div id='depense'>

                                 


                                

                           </div>


                       


                         


                           <div class="form-group">
                              <label for="exampleFormControlSelect1">Date</label>
                              
                              <input  id="date_year_value" type="date"  name="date" class="form-control" >
                           </div>


                           <div class="form-group">
                              <label for="exampleFormControlSelect1">Montant</label>
                       
                              <input  id="date_year_value" type="text"  name="montant" class="form-control" >
                           </div>

                           


                           

                           <input type="text" id="id_projet" name='id_projet' hidden>
                         
                        
                        
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                        
                        <input type="submit" class="btn btn-primary" value="valider">
                     </div>
                  </form>
               </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('page-js')
<script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.3.1/dist/vuetify.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vuetify@2.3.1/dist/vuetify.min.css"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons"/>
<script src="{{ asset('js/plugins/vue.js') }}"></script>
<script src="{{ asset('js/plugins/vee-validate.js') }}"></script>
<script src="{{ asset('js/plugins/axios.min.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert2@9.js') }}"></script>
<script src="{{ asset('js/plugins/vuetify.js') }}"></script>
<script>




   window.laravel ={!! json_encode([
     'token' => csrf_token(),
     'url'   => url('/'),
     'date'   => date('Y-m-d'),
     'id_projet' => $id
   
   
   ]) !!}


 

   function Function_depense() {
      var type = $("#type_depense").val();

       
         if(type == 'alimentation'){
            $("#depense_projet").append(html_projet_depense)
         } else {
            $("#depense_projet").empty()
         }
    }


    function Function_origine_compte() {
      var type_compte = $("#origine_compte").val();
    
      if(type_compte == 'banque'){
            $("#div_banque").append(html_banque)
         } else {
            $("#div_banque").empty()
         }
    }

    


   $(document).ready(function(){


      html_banque = ' <div class="form-group">';
      html_banque += ' <label for="exampleFormControlSelect1">Banque</label>';
      html_banque += '<select name="banque" class="form-control" id="select_banque">';
      html_banque += '<option>Selectionner</option>';
      html_banque += '<option>BMCE</option>';
      html_banque += ' <option>ATTIJARI WAFA BANK</option>';
      html_banque += '</select>';
      html_banque += '</div>';



      html_alimentation = '<div class="form-group">';

      html_alimentation += '<label for="exampleFormControlSelect1">Origine du compte </label>';

      html_alimentation += '<select onchange="Function_origine_compte()" name="origine_compte" class="form-control" id="origine_compte">';
      html_alimentation += '<option>Selectionner</option>';
      html_alimentation += '<option value="banque" >Banque</option>';
      html_alimentation += '<option value="Associé">Associé</option>';
      html_alimentation += '</select>';
      html_alimentation += '</div>';
      html_alimentation += '<div id="div_banque">  </div>';
     


       html_depense = '<div class="form-group">';
      html_depense += '<label for="exampleFormControlSelect1">Type </label>';
      html_depense += '<select onchange="Function_depense()" name="type" class="form-control" id="type_depense">';
      html_depense += '<option>Selectionner</option>';
      @if($find_projet)
      html_depense += '<option value="alimentation"> Alimenter Sous caisse </option>';
      @endif
      html_depense += '<option value="déplacement">  déplacement  </option>';
      html_depense += '<option value=" Frais divers">  Frais divers </option>';
      html_depense += '<option value="Achat"> Achat  </option>';
      html_depense += '<option value="Béneficiaire"> Béneficiaire </option>';
      html_depense += '<option value="Associé">Associé</option>';
      html_depense += '</select>';
      html_depense += '</div>';
      html_depense += '<div id="depense_projet" > </div>';


      html_projet_depense = '<div class="form-group">';
      html_projet_depense += '<label for="exampleFormControlSelect1">Projet </label>';
      html_projet_depense += '<select name="projet" class="form-control" id="">';
      html_projet_depense += '<option>Selectionner</option>';

      @foreach($all_projets as $all_projet )   
       @if(!$all_projet->administration)
        html_projet_depense += '<option value="{{ $all_projet->id }}"> {{ $all_projet->client }} </option>';
       @endif
      @endforeach

      html_projet_depense += '</select>';
      html_projet_depense += '</div>';
      html_projet_depense += '';



      
     



   
      $("#id_projet").val( window.laravel.id_projet);
      

      
      $("#origine_compte").hide();




      $("#select_operation").change(function(){   


         

         if($(this).val() == "Alimentation"){

             $("#alimen").append(html_alimentation)

             $("#depense").empty()

         } else if($(this).val() == "dépense") {

            $("#alimen").empty()
            

            $("#depense").append(html_depense)

         } else {
            $("#alimen").empty()
            $("#depense").empty()
         }


       

         
   
      });

  

   });

</script>
<script src="{{ asset('js/caisse_detail.js') }}"></script>
@endsection