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
<form action=" {{url('store_demande_stock')}}" enctype="multipart/form-data" method="post">
  @csrf
<div class="breadcrumb">
   <h1>  Demande material / fourniture  </h1>
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
            <div class="col-md-2"> <label for="name" class="product-label text-dark">Projet Concerné </label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                    
                   <select  class=" form-control"  name="projet" id="projet">
                      <option value="">Selectionnez</option>
                      @foreach($projets as $projet)
                      <option value="{{$projet->id}}"> {{$projet->n_marche}}_{{$projet->client}} </option>
               
                      @endforeach
                   </select>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>



      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark"> Type </label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                    
                   <select  class=" form-control"  name="type" id="projet">
                      <option value="">Selectionnez</option>
                      <option value="Material">Material</option>
                      <option value="Fourniture">Fourniture</option>
                   </select>
                     

                  </div>

           
             

            
               </div>
            </div>
            
         </div>
      </div>



    
     
   
     
   
       
      
           
         
               <!-- end::form 3-->
      <!-- end::form 3-->

      
     

     
      <div class="row">

         <div class="col-lg-12">
            <div class="card">
                  <div class="card-body">
                    
                     <div class="d-flex justify-content-between">
                        <div class="card-title">insertion des nouveaux articles</div>
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
            
                               
                                 <th scope="col">Article</th>
                                
                                 <th scope="col">QTE Disponible </th>
                              
                                 <th scope="col">QTE Demander</th>
                             
                                 <th scope="col">Action</th>
                              </tr>
                           </thead>
                           <tbody>

                            
                            
                           </tbody>
                        </table>
                     </div>
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
<script src="{{ asset('js/create_demande_stock.js') }}"></script>


@endsection

