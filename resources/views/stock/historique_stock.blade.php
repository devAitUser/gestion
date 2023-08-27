@extends('layouts.master')
@section('main-content')

           <link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/materialdesignicons.min.css') }}>
           <link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/vuetify.min.css') }}>
           <link rel="stylesheet" type="text/css" href={{ asset('assets/styles/css/custom_vuetify.css') }}>
           <style>
              i.mdi.mdi-file-pdf.size_icon {
                  font-size: 25px;
               }
             .v-menu__content {
                
                 position: fixed !important;
            
                }

           </style>
           
           <div class="breadcrumb">
                <h1>   Historique des Stocks</h1>
            
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
                                  <h4 class="col-md-4 text-white"> Historique des Stocks </h4>

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
                                                 Historique des Stocks
                                                   <v-spacer></v-spacer>
                                                   
                                                </v-card-title>


                                                <v-card-title class="text-right">

                                                    <v-spacer></v-spacer>


                                         
                                               

                                                    </v-card-title>

                                                        <template>
                                                            <v-sheet width="300" class="mx-auto pb-5">
                                                                <v-form validate-on="submit" @submit.prevent="submit">
                                                                <v-combobox
                                                                    v-model="projetSelected"
                                                                    label="Les stocks"
                                                                    item-text="name"
                                                                    :items="array_projets"
                                                                    return-object
                                                                    ></v-combobox>
                                                                <v-btn @click="valider()" block class="mt-2 success"  >valider</v-btn>
                                                                </v-form>
                                                            </v-sheet>
                                                        </template>
                                              
                                 
                                              
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
               
               
               ]) !!}
            </script>
            <script src="{{ asset('js/historique_stocks.js') }}"></script>

@endsection



