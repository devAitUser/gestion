@extends('layouts.master')
@section('main-content')
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/materialdesignicons.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/vuetify.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('assets/styles/css/custom_vuetify.css') }}>
<div class="breadcrumb">
   <h1>  La liste des Cassiers</h1>
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
                     <h4 class="col-md-4 text-white">Cassiers</h4>
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
                                 la liste des Cassiers
                                 <v-spacer></v-spacer>
                              </v-card-title>
                              <v-card-title class="text-right">
                                 <v-spacer></v-spacer>
                                
                      
                              </v-card-title>
                              <v-data-table  @input="item($event)" :headers="headers" :items="pointage" :search="search" :value="selectedRows" v-model="selected" :items-per-page="5"  :sort-by.sync="sortBy"
                                 :sort-desc.sync="sortDesc" show-select   item-key="id"
                                 :expanded.sync="expanded" @click:row="clicked">
                                 <template v-slot:item.status="{ item }">
                               
                                                      <span v-if="item.status" class="badge badge-success">Caisse principale</span>
                                                      <span v-else class="badge badge-danger" >Sous Caisse</span>
                                             
                                             </template>
                             
                                 <template v-slot:item.action="{ item }">
                                    <v-btn color="purple" fab small dark  @click="editItem(item)">
                                       <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                    </v-btn>
                                 </template>
                                 <template v-slot:item.affecatation ="{ item }" >
                                    <v-btn align-center  class="mx-0"  small  fab dark color="teal" @click="shwo_affectation(item)">
                                       <v-icon dark>mdi-format-list-bulleted-square</v-icon>
                                    </v-btn>
                                    <v-dialog v-model="dialog" max-width="800px" :retain-focus="false">
                                       <v-card>
                                          <v-card-title>
                                             <span class="headline"> Les historiques de affectations  </span>
                                          </v-card-title>
                                          <v-form @submit.prevent="post_data" ref="form" v-model="valid" lazy-validation>
                                             <v-container>
                                                <v-menu
                                                   v-model="menu2"
                                                   :close-on-content-click="false"
                                                   transition="scale-transition"
                                                   offset-y
                                                   max-width="290px"
                                                   min-width="290px"
                                                   >
                                                   <template v-slot:activator="{ on, attrs }">
                                                   </template>
                                                </v-menu>
                                                <v-row>
                                                   <v-col
                                                      cols="12"
                                                      sm="6"
                                                      >
                                                      <v-combobox
                                                         v-model="addItem.projet"
                                                         label="Projet"
                                                         :items="projets"
                                                         item-text="client"
                                                         item-value="client"
                                                         required
                                                         >
                                                      </v-combobox>
                                                   </v-col>
                                                   <v-col
                                                      cols="12"
                                                      sm="6"
                                                      >
                                                      <v-text-field
                                                         v-model="addItem.debut"
                                                         label="Debut Date"
                                                         type="date"
                                                         ></v-text-field>
                                                   </v-col>
                                                   <v-col
                                                      cols="12"
                                                      sm="6"
                                                      >
                                                      <v-text-field
                                                         v-model="addItem.fin"
                                                         label="Date fin"
                                                         persistent-hint
                                                         prepend-icon="event"
                                                         v-bind="attrs"
                                                         type="date"
                                                         v-on="on"
                                                         ></v-text-field>
                                                   </v-col>
                                                   <v-col
                                                      cols="12"
                                                      sm="6"
                                                      >
                                                      <v-combobox
                                                         v-model="addItem.statut"
                                                         label="Statut"
                                                         :items="['actif','non actif']"
                                                         required
                                                         >
                                                      </v-combobox>
                                                   </v-col>
                                                   <v-col
                                                      cols="12"
                                                      sm="12"
                                                      >
                                                      <v-btn
                                                         color="success"
                                                         class="mt-4"
                                                         block
                                                         type="submit"
                                                         >
                                                         Ajouter
                                                      </v-btn>
                                                   </v-col>
                                                   <v-dialog
                                                      v-model="dialog2"
                                                      width="auto"
                                                      >
                                                      <v-card>
                                                         <v-card-title>
                                                            Modifier l'affectation
                                                         </v-card-title>
                                                         <v-card-text>
                                                            <v-row>
                                                               <v-col
                                                                  cols="12"
                                                                  sm="6"
                                                                  >
                                                                  <v-combobox
                                                                     v-model="editedItem.projet"
                                                                     label="Projet"
                                                                     :items="projets"
                                                                     item-text="client"
                                                                     item-value="client"
                                                                     required
                                                                     >
                                                                  </v-combobox>
                                                               </v-col>
                                                               <v-col
                                                                  cols="12"
                                                                  sm="6"
                                                                  >
                                                                  <v-text-field
                                                                     v-model="editedItem.debut"
                                                                     label="date debut"
                                                                     type="date"
                                                                     ></v-text-field>
                                                               </v-col>
                                                               <v-col
                                                                  cols="12"
                                                                  sm="6"
                                                                  >
                                                                  <v-text-field
                                                                     v-model="editedItem.fin"
                                                                     required
                                                                     label="date fin"
                                                                     variant="solo"
                                                                     ></v-text-field>
                                                               </v-col>
                                                               <v-col
                                                                  cols="12"
                                                                  sm="6"
                                                                  >
                                                                  <v-combobox
                                                                     v-model="editedItem.statut"
                                                                     label="Statut"
                                                                     required
                                                                     :items="['actif', 'non actif']"
                                                                     >
                                                                  </v-combobox>
                                                               </v-col>
                                                               <v-col
                                                                  cols="12"
                                                                  sm="6"
                                                                  >
                                                                  <v-btn
                                                                     color="success"
                                                                     class="mt-4"
                                                                     block
                                                                     @click="update_item_affectation(item)"
                                                                     >
                                                                     Modifier
                                                                  </v-btn>
                                                               </v-col>
                                                               <v-col
                                                                  cols="12"
                                                                  sm="6"
                                                                  >
                                                                  <v-btn
                                                                     color="success"
                                                                     class="mt-4"
                                                                     block
                                                                     @click="dialog2 = false"
                                                                     >
                                                                     sortir
                                                                  </v-btn>
                                                               </v-col>
                                                            </v-row>
                                                         </v-card-text>
                                                      </v-card>
                                                   </v-dialog>
                                                </v-row>
                                             </v-container>
                                          </v-form>
                                          <v-data-table :headers="subHeaders"
                                             :items="affectation"
                                             item-key="color"
                                             hide-actions
                                             class="elevation-10">
                                             <template v-slot:item.actions="{ item }">
                                                <v-icon
                                                   size="small"
                                                   class="me-2"
                                                   @click="edit_Item_paiement(item)"
                                                   >
                                                   mdi-pencil
                                                </v-icon>
                                                <v-icon
                                                   size="small"
                                                   @click="deleteItem_affectation(item.id)"
                                                   >
                                                   mdi-delete
                                                </v-icon>
                                             </template>
                                          </v-data-table>
                                          </v-card-title>
                                          <v-card-actions>
                                             <v-spacer></v-spacer>
                                             <v-btn color="blue darken-1" text @click="close">Annuler</v-btn>
                                          </v-card-actions>
                                       </v-card>
                                    </v-dialog>
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
<script src="{{ asset('js/app_caisse.js') }}"></script>
@endsection