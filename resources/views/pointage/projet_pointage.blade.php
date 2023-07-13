@extends('layouts.master')
@section('main-content')
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/materialdesignicons.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/vuetify.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('assets/styles/css/custom_vuetify.css') }}>
<div class="breadcrumb">
   <h1>  La liste des Paies</h1>
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
                              <div class="card-body">
                  
                            <div class="table-responsive">


                            <v-row>
                                 <v-col
                                    cols="6"
                                    md="4"
                                 >

                                 <v-btn @click="btn_retour()"  block class="mt-2 success"  >Retour </v-btn>


                                 </v-col>

                                 <v-col
                                    cols="6"
                                    md="4"
                                 >

                                 <v-btn     block class="mt-2 success"  id="btnExport" > Exporter Excel </v-btn>


                                 </v-col>
                               
                               



                            </v-row>


                              

                              <input type="text" value="{{$mois}}" hidden id="mois">
                              <input type="text" value="{{$anne}}" hidden id="anne">


                               <form method="POST" action="{{ route('post_data_info_pointage') }}">
                               @csrf
                                <table class="table table-bordered" id="mydatatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nom et Prenom</th>

                                            <th scope="col">Rib</th>
                                         
                                            <th scope="col">salaire payé</th>

                                            
                                     
                                            
                                        </tr>
                                    </thead>
                                    <tbody>


                                    <?php $count = 1   ?>

                                       @foreach ($info_pointages as $info_pointage)

                                       <tr>
                                          <th scope="row">{{$count}}</th>
                                          <td>{{$info_pointage->nom_employe}}

                                            
                                          </td>


                                          <td> {{$info_pointage->rib}} </td>
                                      

                                         <td>

                                           {{$info_pointage->salaire_paye}}


                                          </td>

                          
                               
                                      </tr>

                                        <?php $count++; ?>
                                           
                                       @endforeach


                                       
                                       

                                    </tbody>
                                </table>
                              

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





<div class="modal" id="popus_etat_paiement">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- En-tête de la modale -->
        <div class="modal-header">
          <h4 class="modal-title">Etat de paiement</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Corps de la modale -->
        <div class="modal-body">
          <p>etes vous sur </p>
          <input type="text" id="id_info_pointage" hidden>
        </div>
        
        <!-- Pied de la modale -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-primary" onclick="submit_pointage()"  >Valider</button>
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

function showModal(id_pointage_info) {

      
      $('#popus_etat_paiement').modal('show');

      $('#id_info_pointage').val(id_pointage_info)
    }

 function submit_pointage(){


   var id_pointage_info = $('#id_info_pointage').val();

   

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ 
        url: window.laravel.url + "/pointage_api_paiement",
        method: "post",
        data: {
            id: id_pointage_info 
        },
        success: function(data) {

         
         alert()
         if(data.etat){

            window.location.href =  window.laravel.url + '/projet_selectionner_pointage';

         }
           
           


        }
    })


 }   

   


 


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
<script src="{{ asset('js/app_pointage.js') }}"></script>


<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>



<script>
    $(document).ready(function () {

      var mois =  $("#mois").val()
      var anne =  $("#anne").val()

        $("#btnExport").click(function () {
            let table = document.getElementsByTagName("table");
            console.log(table);
            debugger;
            TableToExcel.convert(table[0], {
                name: 'paie_'+mois+'_'+anne+'_master_archives.xlsx',
                sheet: {
                    name: 'Usermanagement'
                }
            });
        });
    });
</script>


@endsection