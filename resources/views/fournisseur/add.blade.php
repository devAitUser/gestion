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
<form action=" {{url('fournisseur/store')}}" method="post">
  @csrf
<div class="breadcrumb">
   <h1>  Ajouter un fournisseur </h1>
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
            <div class="col-md-2"> <label for="name" class="product-label text-dark">Nom</label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                     <label for="inputtext11" class="ul-form__label">Nom *</label>
                     <input id="designation" type="text"  name="nom" class="form-control  " required >
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
                     <input id="designation" type="text"  name="personne_contact" class="form-control  "  required>
                     <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>
      <!-- end::form 3-->
      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark">Email </label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                     <label for="inputtext11" class="ul-form__label">Email  *</label>
                     <input id="designation" type="email"  name="email" class="form-control  "  required>
                     <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>
            <!-- end::form 3-->
            <div class="card-body">
               <div class="row">
                  <div class="col-md-2"> <label for="name" class="product-label text-dark"> Ice </label></div>
                  <div class="col-md-10">
                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label for="inputtext11" class="ul-form__label">Ice  *</label>
                           <input id="designation" type="tel"  name="ice" class="form-control  "  required>
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
                     <div class="col-md-2"> <label for="name" class="product-label text-dark"> Rib </label></div>
                     <div class="col-md-10">
                        <div class="form-row">
                           <div class="form-group col-md-12">
                              <label for="inputtext11" class="ul-form__label">Rib  *</label>
                              <input id="designation" type="tel"  name="rib" class="form-control  "  required>
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
                     <div class="col-md-2"> <label for="name" class="product-label text-dark"> adresse </label></div>
                     <div class="col-md-10">
                        <div class="form-row">
                           <div class="form-group col-md-12">
                              <label for="inputtext11" class="ul-form__label">adresse  *</label>
                              <input id="designation" type="tel"  name="adresse" class="form-control  "  required>
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
            <div class="col-md-2"> <label for="name" class="product-label text-dark"> specialite
               
            </label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                     <label for="inputtext11" class="ul-form__label">specialite  *</label>
                     <input id="designation" type="tel"  name="specialite" class="form-control  "  required>
                     <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>

      <!-- end::form 3-->
      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark"> telephone </label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                     <label for="inputtext11" class="ul-form__label">telephone  *</label>
                     <input id="designation" type="text"  name="telephone" class="form-control  "  required>
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
            <div class="col-md-2"> <label for="name" class="product-label text-dark"> type </label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                     <label for="inputtext11" class="ul-form__label">type  *</label>
   

                     <select id='select_type' name="type" class='form-control' required>
                        <option value="">Selectionner</option>
                        <option value="Fournisseur">Fournisseur</option>
                        <option value="Loyer">Loyer</option>
                        <option value="Impôts">Impôts</option>
                     </select> 

                     <div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>

              


               



          

             <!-- end::form 3-->
             <div class="">
                <div class="" id='block_etat'>
                  
                  
                     
                        
                           
         

                        
                           
                           
                              
                           

                           
                           

                     

               
                  

                  
                     
                  
                  
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
<script>
$(document).ready(function(){

   var html = '<div class="card-body"><div class="row"><div class="col-md-2"> <label for="name" class="product-label text-dark"> Etat </label></div>';
   html += '<div class="col-md-10">';
   html += ' <div class="form-row">';
   html += ' <div class="form-group col-md-12"> ';
   html += ' <label for="inputtext11" class="ul-form__label">type  *</label> ';
   html += '  <select  name="etat" class="form-control" required>';
   html += '  <option value="">Selectionner</option> ';
   html += '  <option value="Actif">Actif</option> ';
   html += ' <option value="Non Actif   ">Non Actif</option> </select>  ';
   html += '<div class="invalid-feedback"> Veuillez choisir le Titre de designation.</div>  ';
   html += '</div> </div></div> </div></div>  ';




         


   html += '<div class="card-body"><div class="row"><div class="col-md-2"> <label for="name" class="product-label text-dark"> Date * </label></div> ';
   html += ' <div class="col-md-10"> ';
   html += ' <div class="form-row"> ';
   html += ' <div class="form-group col-md-12">  ';
   html += '  <input id="" type="date"  name="date" class="form-control  "  required >  ';
   html += ' </div> ';
   html += ' </div> ';
   html += ' </div>  </div></div>  ';




   html += '<div class="card-body"><div class="row"><div class="card-body">';
   html += '<div class="row">';
   html += ' <div class="col-md-2"> <label for="name" class="product-label text-dark"> Montant * </label></div> ';
   html += '  <div class="col-md-10"> ';
   html += '  <div class="form-row"> ';
   html += '  <div class="form-group col-md-12"> ';
   html += '  <input type="number"  name="montant" class="form-control  "  required > ';
   html += ' </div> ';
   html += ' </div> ';
   html += ' </div> ';
   html += ' </div> </div> </div></div>  ';





   html += ' <div class="card-body"><div class="row"> <div class="col-md-2"> <label for="name" class="product-label text-dark"> Montant * </label></div> ';
   html += '  <div class="col-md-10"> ';
   html += '  <div class="form-row"> ';
   html += '  <div class="form-group col-md-12"> ';
   html += '  <select id="" name="projet" class="form-control" required> ';
   html += ' <option value="">Selectionner</option>';
   @foreach($projets as $projet)
   html += ' <option value="{{$projet->id}}">{{$projet->client}}</option> ';
   @endforeach 
   html += ' </select>  ';
   html += ' </div> ';
   html += ' </div> ';
   html += ' </div>  </div></div>';
 

   $("#select_type").change(function(){
     
       if($("#select_type").val() == 'Loyer'){
         
         $("#block_etat").html(html);
       } else {
         $("#block_etat").empty();
       }
   });

});
</script>



@endsection

