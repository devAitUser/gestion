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
<form action=" {{url('projets/store')}}" enctype="multipart/form-data" method="post">
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
            <div class="col-md-2"> <label for="name" class="product-label text-dark">Type de prestation *</label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                    
                   <select  class=" form-control"  name="type_prestation" id="">
                      <option value="">Selectionnez</option>
                      <option value="Marché">Marché</option>
                      <option value="B.C">B.C</option>
                   </select>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>


      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark">status *</label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                    

                  <select name="status" class="form-control">

                   <option>actif</option>
                   <option>non actif</option>
                   

                  </select>


                     

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
                  
                     <input id="designation" type="text"  name="n_marche" class="form-control  "  required>
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
                 
                     <input id="montant_min" type="text"  name="montant_min" class="form-control  " readonly="readonly"  required>
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
                     
                     <input id="montant_max" type="text"  name="montant_max" class="form-control  "  required readonly="readonly">
                     <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>
           <!-- end::form 3-->
           <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark"> Importer termes de références  </label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
        
                     <input id="designation" type="file"  name="file" class="form-control  "  required>
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

