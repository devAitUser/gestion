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
<form action="{{url('updateclients/'.$clients['id'])}}" method="post">
  @csrf
<div class="breadcrumb">
   <h1>  Ajouter un client </h1>
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
            <div class="col-md-2"> <label for="name" class="product-label text-dark">Nom de client</label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                     <label for="inputtext11" class="ul-form__label">Nom de client*</label>
                     <input id="designation" type="text"  name="nom_client" class="form-control  " value="{{ $clients['nom_client'] }}" required >
                     <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>
      <!-- end::form 3-->
      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark">Personne contactée </label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                     <label for="inputtext11" class="ul-form__label">Personne contactée *</label>
                     <input id="designation" type="text"  name="personne_contact" class="form-control  " value="{{ $clients['personne_contact'] }}" required>
                     <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>
      <!-- end::form 3-->
      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark">ICE </label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                     <label for="inputtext11" class="ul-form__label">ICE  *</label>
                     <input id="designation" type="number"  name="ice" class="form-control  " value="{{ $clients['ice'] }}" required>
                     <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>
      <!-- end::form 3-->
      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark"> telephone 1  </label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                     <label for="inputtext11" class="ul-form__label"> telephone 1   *</label>
                     <input id="designation" type="text"  name="telephone1" class="form-control  " value="{{ $clients['telephone1'] }}" required>
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
               <div class="col-md-2"> <label for="name" class="product-label text-dark"> telephone 2  </label></div>
               <div class="col-md-10">
                  <div class="form-row">
                     <div class="form-group col-md-12">
                        <label for="inputtext11" class="ul-form__label"> telephone 2      *</label>
                        <input id="designation" type="text"  name="telephone2" class="form-control  " value="{{ $clients['telephone2'] }}" required>
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
               <div class="col-md-2"> <label for="name" class="product-label text-dark"> Numero de fax  </label></div>
               <div class="col-md-10">
                  <div class="form-row">
                     <div class="form-group col-md-12">
                        <label for="inputtext11" class="ul-form__label"> Numero de fax     *</label>
                        <input id="designation" type="text"  name="numero_fax" class="form-control  " value="{{ $clients['numero_fax'] }}" required>
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
                     <div class="col-md-2"> <label for="name" class="product-label text-dark"> Adresse compléte </label></div>
                     <div class="col-md-10">
                        <div class="form-row">
                           <div class="form-group col-md-12">
                              <label for="inputtext11" class="ul-form__label"> Adresse compléte     *</label>
                              <input id="designation" type="text"  name="adresse_complete" class="form-control  " value="{{ $clients['adresse_complete'] }}" required>
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
                     <div class="col-md-2"> <label for="name" class="product-label text-dark"> Adresse email  </label></div>
                     <div class="col-md-10">
                        <div class="form-row">
                           <div class="form-group col-md-12">
                              <label for="inputtext11" class="ul-form__label"> Adresse email    *</label>
                              <input id="designation" type="text"  name="adresse_mail" class="form-control  " value="{{ $clients['adresse_mail'] }}" required>
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
                     <div class="col-md-2"> <label for="name" class="product-label text-dark"> ville  </label></div>
                     <div class="col-md-10">
                        <div class="form-row">
                           <div class="form-group col-md-12">
                              <label for="inputtext11" class="ul-form__label"> ville   *</label>
                              <input id="designation" type="text"  name="ville" class="form-control  " value="{{ $clients['ville'] }}" required>
                              <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                              
         
                           </div>
         
                    
                      
         
                     
                        </div>
                     </div>
                     
                  </div>
               </div>
               <!-- end::form 3-->


    
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
                  enregistré
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



@endsection

