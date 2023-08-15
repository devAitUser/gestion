@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.bubble.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.snow.css')); ?>">
<link rel="stylesheet" type="text/css" href={{ asset('assets/styles/css/custom_style.css') }}>
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/dropzone.min.css')); ?>">

<style>


.spinner:after {
    background: #ffc107;

}
span.spinner.spinner-primary {
    font-size: 5px;
}

.buttonload {
  background-color: #4CAF50; /* Green background */
  border: none; /* Remove borders */
  color: white; /* White text */
  padding: 12px 16px; /* Some padding */
  font-size: 16px /* Set a font size */
}


table.calcul {
      width: 90%;
   }
   .block_calcul th, .block_calcul td {
      padding: 0.75rem;
      vertical-align: top;
      border-top: 1px solid #dee2e6;
   }
</style>
@endsection
@section('main-content')
<form action=" {{url('update_facture_client')}}" enctype="multipart/form-data" method="post">
  @csrf
<div class="breadcrumb">
   <h1>  creer facture client  </h1>
</div>
<div id="msg"></div>
<div class=" border-top"></div>

 


   <div class="card mt-3">
      <!--begin::form-->
      <div class="card-header bg-transparent">
         <p class="submit_mandatory ">* champ  obligatoire </p>
      </div>


 

       
     
      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark">Projet </label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">

                     <input type="text" name="id_facture_client" value="{{$facture_client['id']}}" hidden>
                    
                   <select  class=" form-control"  name="projet" id="projet" disabled>
                      <option value="">Selectionnez</option>
                      @foreach($projets as $projet)
                      @if ($projet->id == $facture_client['id_projet'] )
                          
                      <option value="{{$projet->id}}" selected> {{$projet->client}} </option>
                          
                      @else 
                      <option value="{{$projet->id}}"> {{$projet->client}} </option>
                      @endif
                      
               
                      @endforeach
                   </select>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>


    
     
   
     
   
       
      
            <!-- end::form 3-->
                 <!-- end::form 3-->
                 <div class="card-body">
                  <div class="row">
                     <div class="col-md-2"> <label for="name" class="product-label text-dark"> Date </label></div>
                     <div class="col-md-10">
                        <div class="form-row">
                           <div class="form-group col-md-12">
              
                              <input type="date"  name="date" class="form-control" value="{{$facture_client['date'] }}"  required>
                           
                              
         
                           </div>
         
                    
                      
         
                     
                        </div>
                     </div>
                     
                  </div>
               </div>
         
               <!-- end::form 3-->
      <!-- end::form 3-->

      
      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark"> Date Debut</label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                 
                     <input type="date"  name="date_debut" class="form-control  " value="{{$facture_client['date_debut'] }}"  required>
                     <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>

      <!-- end::form 3-->
      <div class="card-body">
            <div class="row">
               <div class="col-md-2"> <label for="name" class="product-label text-dark"> Date Fin </label></div>
               <div class="col-md-10">
                  <div class="form-row">
                     <div class="form-group col-md-12">
                        
                        <input  type="date"  name="date_fin" class="form-control  " value="{{$facture_client['date_fin'] }}" required .>
            

                     </div>

            
               

               
                  </div>
               </div>
               
            </div>
         </div>




         

      


         

      
      </div>
      <div class="row">

         <div class="col-lg-12">
            <div class="card">
                  <div class="card-body">
                     <div class="d-flex justify-content-between">
                        <div class="card-title">insertion des nouveaux articles</div>
                        <div class="headder-elements tt">
                           <div class="list-icons">
                              <a href="" class="ul-task-manager__list-icon " id="arrow-down"><i class="i-Arrow-Down"></i></a>
                             
                           </div>
                        </div>
                     </div>
                     <div class="table-responsive table-product ">
                        <table id="table_product-n" class="table">
                           <thead>
                              <tr>
            
                                 <th scope="col">Numero</th>
                                 <th scope="col">Article</th>
                                 <th scope="col">QTE </th>
                              
                                 <th scope="col">Prix</th>
                                 <th scope="col">Total</th>
                                 <th scope="col">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($article_facture_clients as $article_facture_client)
                              <tr class="item" id="row_{{$article_facture_client->numero}}">
                                 <td>  <input type="number" name="numero[]" value="{{$article_facture_client->numero}}" required=""> </td>
                                 <td><input type="text" name="product[]" value="{{$article_facture_client->article}}" required="" readonly="readonly"></td>
                                 <td>  <input type="number" name="quantity[]" class="quantity" value="{{$article_facture_client->quantite}}" required=""> </td>
                                 <td> <input type="number" name="prix[]" value="{{$article_facture_client->prix}}" required="" readonly="readonly"> </td>
                                 <td>0</td> 
                                 <td><a href="" class="prevent-default" onclick="removeRow_table(event,{{$article_facture_client->numero}})"><i class="i-Close-Window text-19 text-danger font-weight-700" "=""></i></a></td>
                              </tr>
                              @endforeach
                            
                           </tbody>
                        </table>
                     </div>
                  </div>

            </div>
         </div>

         <div class="col-lg-12">
            <div class="row">

            <div class="col-lg-6">
            </div>

            <div class="col-lg-6 block_calcul">
               <table class="calcul">
                  <tr class='col_footer total_ht ' >
                        <td class='col_none' colspan="4"></td>
                        <td class='footer_border' align="center"> <strong>Total HTVA</strong> </td>
                        <td align="right"><div  width="50%" align="right"> <strong>0</strong> </div></td>
                  </tr>
                  <tr class='col_footer t_tva'>
                        <td class='col_none' colspan="4"></td>
                        <td class='footer_border' align="center"> <strong>Taux TVA (20%) </strong></td>
                        <td align="right"><div class='c_f' width="50%" align="right"> <strong>0</strong></div> </td>
                  </tr>
                  <tr class='col_footer total_ttc'>
                        <td class='col_none' colspan="4"></td>
                        <td class='footer_border' align="center"><strong>Total TTC</strong> </td>
                        <input type="text" value='' name='total_ttc' id="total_ttc" hidden>
                  
                        <td align="right"><div class='c_f' width="50%" align="right"> <strong>0</strong></div> </td>
                  </tr>
               </table>
            </div>
               
            </div>
         </div>


         



            <div class="col-lg-12">
               <div class="card-footer">
                  <div class="mc-footer">
                     <div class="row">
                        <div class="col-lg-12 text-center">
                        
                           <button type="submit" class="btn d-inline  btn-primary m-1" type="button">
                           Créer
                           </button>
                        
                           <button type="button" class="btn btn-outline-secondary m-1">Annuler</button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end::form 3-->
            </div>

         </div>



   </div>
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <div class="card mt-3">
      <!--begin::form-->

      <!-- end::form 3-->
   </div>

   
    


   </form>
@endsection
@section('page-js')
<script>
   window.laravel ={!! json_encode([
     'token' => csrf_token(),
     'url'   => url('/'),
     'date'   => date('Y-m-d'),
   
   
   ]) !!}
   
   
   
   
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="<?php echo e(asset('assets/js/vendor/dropzone.min.js')); ?>"></script>
<script src="{{asset('assets/js/dropzone.script.js')}}"></script>
<script src="{{ asset('js/new_facture_client.js') }}"></script>


@endsection

