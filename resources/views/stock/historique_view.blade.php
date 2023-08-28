@extends('layouts.master')
@section('main-content')

           <link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/materialdesignicons.min.css') }}>
           <link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/vuetify.min.css') }}>
           <link rel="stylesheet" type="text/css" href={{ asset('assets/styles/css/custom_vuetify.css') }}>
           <style>
              i.mdi.mdi-file-pdf.size_icon {
                  font-size: 25px;
               }
           </style>
           
           <div class="breadcrumb">
                <h1>  La liste de l'historique des articles</h1>
            
            </div>

            @include('layouts.common.flash_message')

            <div class=" border-top"></div>
            
            <div id="app_devis" data-app>
         

               <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header  gradient-purple-indigo  0-hidden pb-80">
                             <div class="pt-4">
                              <div class="row">
                                  <h4 class="col-md-4 text-white">historique des articles</h4>
                                  <input v-model="search" type="text" class="form-control form-control-rounded col-md-4 ml-3 mr-3"  append-icon="mdi-magnify" placeholder="Rechercher devis ...">
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
                                                 Historique des articles
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
                                                             label="Mois"
                                                             outlined
                                                             @change="fn_mois" 
                                                             ></v-select>
                                                       
                                                          </v-col>
                                                          <v-col
                                                          
                                                          cols="12"
                                                          sm="6"
                                                          >
                                                            
                                                       
                                                          </v-col>
                                                       </v-row>
                   
                   
                                                       <v-row >
                                                          <v-col
                                                         
                                                          cols="12"
                                                          sm="6"
                                                          >
                                                         
                                                       
                                                          </v-col>
                                                        
                                                       </v-row>
                                                   
                                         
                                                 </v-card-title>


                                              
                                              
                                                <v-data-table  @input="item($event)" :headers="headers" :items="stocks" :search="search" :value="selectedRows" v-model="selected" :items-per-page="5"  :sort-by.sync="sortBy"
                                             :sort-desc.sync="sortDesc" show-select   item-key="id"
                                      :expanded.sync="expanded" @click:row="clicked">
                            
                                    
                                    <template v-slot:item.details="{ item }">
                                        <v-btn color="purple" fab small dark  @click="view_pdf(item)" target="_blank">
                                        <i class="mdi mdi-file-pdf size_icon"></i>
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
                 'id'   => $id,
               
               ]) !!}
            </script>
            <script src="{{ asset('js/app_view_stocks_historique.js') }}"></script>

@endsection



