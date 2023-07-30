@extends('layouts.master')
@section('main-content')
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/materialdesignicons.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/vuetify.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('assets/styles/css/custom_vuetify.css') }}>
<div class="breadcrumb">
   <h1>  La liste des Factures clients</h1>
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
                     <h4 class="col-md-4 text-white">Factures clients</h4>
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
                                 la liste des Factures clients
                                 <v-spacer></v-spacer>
                              </v-card-title>
                              <v-card-title class="text-right">
                                 <v-spacer></v-spacer>

                                


                                    <v-row >
                                       <v-col
                                      
                                       cols="12"
                                       sm="6"
                                       >
                                          <v-select
                                          v-model="item.mois"
                                          :items="array_mois"
                                          label="Projet"
                                          outlined
                                          @change="fn_mois" 
                                          ></v-select>
                                    
                                       </v-col>
                                       <v-col
                                       
                                       cols="12"
                                       sm="6"
                                       >
                                          <v-select
                                          v-model="item.anne"
                                          :items="array_anne"
                                          label="Année"
                                          outlined
                                          @change="fn_anne" 
                                          ></v-select>
                                    
                                       </v-col>
                                    </v-row>


                                    <v-row >
                                       <v-col
                                      
                                       cols="12"
                                       sm="6"
                                       >
                                      
                                    
                                       </v-col>
                                       <v-col
                                       
                                       cols="12"
                                       sm="6"
                                       >
                                       <v-btn @click="btn_add()"  block class="mt-2 success"  >Ajouter </v-btn>
                                    
                                       </v-col>
                                    </v-row>
                                
                      
                              </v-card-title>
                              <v-data-table  @input="item($event)" :headers="headers" :items="pointage" :search="search" :value="selectedRows" v-model="selected" :items-per-page="5"  :sort-by.sync="sortBy"
                                 :sort-desc.sync="sortDesc" show-select   item-key="id" item-key="lineNumber"
                                 :expanded.sync="expanded" @click:row="clicked">
                                 
                                 
                                    <template v-slot:item.index="{ item }">
                                        @{{item.id_table}}
                                    </template>


                                    <template v-slot:item.action="{ item }">
                                        <v-btn color="purple" fab small dark  @click="editItem(item)">
                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                         </v-btn>
                                    </template>


                                  

                             
                                                            
                             
                                
                                                      
                              </v-data-table>
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
<script src="{{ asset('js/app_facture_client.js') }}"></script>
@endsection