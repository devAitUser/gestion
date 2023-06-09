@extends('layouts.master')
@section('main-content')
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/materialdesignicons.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/vuetify.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('assets/styles/css/custom_vuetify.css') }}>
<div class="breadcrumb">
   <h1>  La liste des Pointages</h1>
</div>
@include('layouts.common.flash_message')
<div class=" border-top"></div>
<div id="app" data-app>
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header  gradient-purple-indigo  0-hidden pb-80">
               <div class="pt-4">
                  <div class="row">
                     <h4 class="col-md-4 text-white">Pointage</h4>
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
                                 la liste des Pointages du projet : &nbsp;   <strong>  {{$projet}} </strong> 
                                 <v-spacer></v-spacer>
                              </v-card-title>
                              <v-card-title class="text-right">
                                 <v-spacer></v-spacer>
                                
                      
                              </v-card-title>
                              <div class="card-body">
                  
                            <div class="table-responsive">
                              
                               <form method="POST" action="{{ route('post_data_info_pointage') }}">
                               @csrf
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nom et Prenom</th>
                                            <th scope="col">Jour Travaillé</th>

                                            <th scope="col">Avance sur salaire</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                       @foreach ($pointage_detail_projets as $pointage_detail_projet)

                                       <tr>
                                          <th scope="row">{{$pointage_detail_projet->id}}</th>
                                          <td>{{$pointage_detail_projet->nom_prenom}}

                                             <input type="text" value="{{$pointage_detail_projet->nom_prenom}}" name="nom_prenom[]" hidden>
                                             <input type="text" value="{{$pointage_detail_projet->employe_id}}" name="employe_id[]" hidden>
                                          </td>
                                           <td>

                                              <input type="text" class="form-control" name='jour_travaille[]' value="26">

                                          </td>

                                          <td>

                                             <input type="text" class="form-control" name='avance_salaire[]' value="0" >

                                             <input type="text" value="{{$pointage_detail_projet->rib}}" name="rib[]" hidden >
                                         

                                         </td>
                                      </tr>
                                           
                                       @endforeach


                                       <input type="text" value="{{$projet_id}}" name="projet_id" hidden >
                                       
                                       <input type="text" value="{{$id_projet}}" name="id_projet" hidden >


                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary text-white"  >Envoyer</button>

                                </form>
                            </div>


                        </div>
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
   window.laravel ={!! json_encode([
     'token' => csrf_token(),
     'url'   => url('/'),
     'date'   => date('Y-m-d'),
   
   
   ]) !!}


   $(document).ready(function(){




         $.ajaxSetup({
                  headers: {
                     'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                  }
            });
            $.ajax({
                  url: window.laravel.url + "/getprojets",
                  method: "get",
                  
                  dataType: "json",
                  success: function(data) {


                     $.each(data.projets, function() {
                        $("#select_projet").append($("<option   />").text(this.client));
                     });


               




                  }
         })

   });

</script>
<script src="{{ asset('js/valider_pointage.js') }}"></script>

@endsection