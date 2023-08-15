@extends('layouts.master')
@section('main-content')
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/materialdesignicons.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/vuetify.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('assets/styles/css/custom_vuetify.css') }}>
<div class="breadcrumb">
   <h1>  Paramètre de Factures client</h1>
</div>
@include('layouts.common.flash_message')

<style>
   table.table_parametre {
      justify-content: center;
      display: flex;
      /* box-shadow: 0 3px 1px -2px rgba(0,0,0,.2), 0 2px 2px 0 rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12); */
      /* width: 100%; */
   }
   table.table_parametre tr td {
         padding: 5px 20px;
  }
  tr.fds {
    text-align: center;
  }
  b.solde {
    color: green;
  }
</style>
<div class=" border-top"></div>
<div id="app" data-app>
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header  gradient-purple-indigo  0-hidden pb-80">
               <div class="pt-4">
                  <div class="row">
                     <h4 class="col-md-4 text-white">Paramètre de Factures client</h4>
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
                            Les paramètres  du projet :&nbsp; <b>  {{$projet->client}}_{{$projet->n_marche}}  </b> &nbsp; Montant : &nbsp;<b class="solde"> {{$facture_client->montant}} </b>
                                 
                                 
                              </v-card-title> 


                              <input type="text" hidden id='id_facture' value='{{$id}}'>

                              
                              <table class='table_parametre'>
                                 <tr>
                                     <td width="100%">Nom element</td>
                                     <td width="100%">Apparence</td>
                                 </tr>
                                 <tr>
                                    <td>ICE</td>
                                    <td>
                                       <input type="checkbox" id="ice" name="" value="">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>Date Facture</td>
                                    <td>
                                      <input type="checkbox" id="date" name="" value="">
                                    </td>
                                 </tr>
                            
                                 <tr>
                                    <td>Periode</td>
                                    <td>
                                      <input type="checkbox" id="periode" name="" value="">
                                    </td>
                                 </tr>
                                 <tr class='fds'> 
                                    <td class='fds' colspan="2">
                                       <button type="button" class="btn btn-primary ripple m-1 button_envoyer">Générer PDF</button>
                                    </td>
                                
                                 </tr>
                              </table>
                           </v-card>
                        </div>
                     </div>
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
   var current_year = new Date().getFullYear();
   window.laravel ={!! json_encode([
     'token' => csrf_token(),
     'url'   => url('/'),
     'date'   => date('Y-m-d'),
   
   
   ]) !!}


   $(document).ready(function(){



      $(".button_envoyer").click(function(){
          var id_facture = $("#id_facture").val()
          var ice = false ;
          var date = false ;
          var periode = false;


            if ($('#ice').is(":checked"))
            {
               ice = true ;
            }
            if ($('#date').is(":checked"))
            {
               date = true ;
            }
            if ($('#periode').is(":checked"))
            {
               periode = true;
            }

            window.location.href = window.laravel.url+'/facture_client_pdf/'+id_facture+"?ice="+ice+"&date="+date+"&periode="+periode;
                        
      });

   });

</script>
<script src="{{ asset('js/app_facture_clients.js') }}"></script>
@endsection