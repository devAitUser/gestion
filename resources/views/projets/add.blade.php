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
</style>
@endsection
@section('main-content')
<form action=" {{url('projets/store')}}" method="post">
  @csrf
<div class="breadcrumb">
   <h1>  Ajouter  </h1>
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
            <div class="col-md-2"> <label for="name" class="product-label text-dark">Client *</label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                    
                  <select  id="client" class="js-client-dropdown form-control input-product" style="width: 100%" name="client" required>
                                    <option   value=""> Selectionner le client </option>
                                    @foreach ($clients as $client)
                                   <option  value="{{$client->nom_client}}">{{$client->nom_client	}}</option>
                                    @endforeach
                                 </select>
                     <div class="invalid-feedback"> Veuillez choisir le type_prestation.</div>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>
     
      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark">Type de prestation *</label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                    
                     <input id="designation" type="text"  name="type_prestation" class="form-control  " required >
                     <div class="invalid-feedback"> Veuillez choisir le type_prestation.</div>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>
     
      <!-- end::form 3-->
      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark">Objet *</label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
              
                     <input id="designation" type="text"  name="objet" class="form-control  "  required>
                     <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>
      <!-- end::form 3-->
      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark">n° de marche / Bon de commande *</label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                  
                     <input id="designation" type="number"  name="n_marche" class="form-control  "  required>
                     <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>
            <!-- end::form 3-->
            <div class="card-body">
               <div class="row">
                  <div class="col-md-2"> <label for="name" class="product-label text-dark"> Date de debut *</label></div>
                  <div class="col-md-10">
                     <div class="form-row">
                        <div class="form-group col-md-12">
                         
                           <input id="designation" type="date"  name="date_debut" class="form-control  "  required>
                           <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                           
      
                        </div>
      
                 
                   
      
                  
                     </div>
                  </div>
                  
               </div>
            </div>
      
            <!-- end::form 3-->
                 <!-- end::form 3-->
                 <div class="card-body">
                  <div class="row">
                     <div class="col-md-2"> <label for="name" class="product-label text-dark"> Durée *</label></div>
                     <div class="col-md-10">
                        <div class="form-row">
                           <div class="form-group col-md-12">
              
                              <input id="designation" type="tel"  name="duree" class="form-control  "  required>
                              <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                              
         
                           </div>
         
                    
                      
         
                     
                        </div>
                     </div>
                     
                  </div>
               </div>
         
               <!-- end::form 3-->
      <!-- end::form 3-->

      
      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark"> Montant minimum HT  *</label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                 
                     <input id="designation" type="tel"  name="montant_min" class="form-control  "  required>
                     <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>

      <!-- end::form 3-->
      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark"> Montant maximum HT * </label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                     
                     <input id="designation" type="text"  name="montant_max" class="form-control  "  required>
                     <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>

      

    
   </div>
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <div class="card mt-3">
      <!--begin::form-->

      <!-- end::form 3-->
   </div>

   
    <div class="row">

         <div class="col-lg-12">
            <div class="card">
                  <div class="card-body">
                     <div class="d-flex justify-content-between">
                        <div class="card-title">insertion des Articles    </div>
                        <div class="headder-elements tt">
                           <div class="list-icons">
                              <a href="" class="ul-task-manager__list-icon " id="arrow-down"><i class="i-Arrow-Down"></i></a>
                              <a href="" class="ul-task-manager__list-icon btn-add-n"><i class="i-Add"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="table-responsive table-product ">
                        <table id="table_product-n" class="table">
                           <thead>
                              <tr>
                                 <th scope="col">Numero</th>
                                 <th scope="col">Article</th>
                                 <th scope="col">QTE maximale</th>
                                 <th scope="col">QTE minimale</th>
                                 <th scope="col">Prix</th>
                                 <th scope="col">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr id='row_1'>
                                 <td scope="row" class="row_p">
                                     <input type="text" name="numero[]" required>
                              
                                 </td>
                                 <td scope="row" class="row_p">
                                    <input type="text" name="product[]" required>
                              
                                 </td>
                                 <td>
                                    <input type="number" name="quantite_max[]" required>
                                 </td>
                                 <td>
                                    <input type="number" name="quantity[]" id="" required>
                                 </td>
                                 <td>
                                    <input type="number" name="prix[]" id="" required>
                                 </td>
                                 <td>
                                    <a href="" onClick="removeRow_table(event,1)" ><i class="i-Close-Window text-19 text-danger font-weight-700 prevent-default"></i></a>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>

            </div>
         </div>



   </div>

   <div class="card mt-3">

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

   </form>
@endsection
@section('page-js')
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="<?php echo e(asset('assets/js/vendor/dropzone.min.js')); ?>"></script>
<script src="{{asset('assets/js/dropzone.script.js')}}"></script>
<script src="{{ asset('js/order_script.js') }}"></script>


@endsection

