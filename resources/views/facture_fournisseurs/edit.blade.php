@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
<style>
   .table-product.active{
   display: none;
   }
   td.row_p {
   width: 214px;
   }
   .btn-calendrier {
   position: relative;
   left: -40px;
   }
   .quantity {
   display: -webkit-inline-box;
   display: -ms-inline-flexbox;
   display: inline-flex;
   }
   .quantity input[type=button] {
   padding: 0 5px;
   min-width: 25px;
   height: 35px;
   border: 2px solid rgba(129,129,129,.2);
   background: 0 0;
   -webkit-box-shadow: none;
   box-shadow: none;
   }
   .quantity input[type=number] {
   width: 30px;
   height: 35px;
   border-right: none;
   border-left: none;
   }
   input[type=text], input[type=email], input[type=password], input[type=search], input[type=number], input[type=url], input[type=tel], input[type=date], select, textarea {
   padding: 0 15px;
   max-width: 100%;
   width: 100%;
   height: 35px;
   border: 2px solid rgba(129,129,129,.2);
   border-radius: 0;
   background-color: #fff !important;
   -webkit-box-shadow: none;
   box-shadow: none;
   vertical-align: middle;
   font-size: 14px;
   -webkit-transition: border-color .5s ease;
   transition: border-color .5s ease;
   } 
   input[type=number] {
   padding: 0;
   text-align: center;
   }
   .quantity input[type=button], .quantity input[type=number] {
   display: inline-block;
   color: #777;
   } 
   .quantity input[type=number], .quantity input[type=number]::-webkit-inner-spin-button, .quantity input[type=number]::-webkit-outer-spin-button {
   margin: 0;
   -webkit-appearance: none;
   -moz-appearance: none;
   appearance: none;
   }

   table.calcul {
    width: 90%; 
   }

   .col-lg-6.block_calcul {
    border-radius: 10px;
    box-shadow: 0 4px 20px 1px rgba(0, 0, 0, 0.06), 0 1px 4px rgba(0, 0, 0, 0.08);
    border: 0;
    }
    .block_calcul th, .block_calcul td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
    }
</style>
@endsection
@section('main-content')
<div class="breadcrumb">
   <h1>Nouvelle facture</h1>
</div>

@if (session()->has('no_product'))

    <script>   
    alert('Vous devez choisir au moins un produit');
   
   </script>


@endif


<div class="separator-breadcrumb border-top"></div>
<form action="{{ url('factures_fournisseur/store')}}" method="POST" id="FormOrder" onsubmit="return validateForm();">
   {{ csrf_field() }}
   <section class="chekout-page">
      <div class="row">
         <div class="col-lg-12 mb-3">
            <div class="card">
               <div class="card-body">
                  <div class="card-body">
                     <div class="card-title">facture</div>
                     <div class=" form-row ">
                        <div class="form-group col-md-12">
                           <label for="inputtext11" class="ul-form__label">facture de fournisseur  :</label>
                           <div class="row">
                              <div class="col-md-11">
                                 <input type="text" name="objet" class="form-control" value="{{$name_fournisseur}}"  disabled >
                                 <input type="text" name="id_facture_fournisseur" class="form-control" value="{{$id}}"  hidden >
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class=" form-row ">
                        <div class="form-group col-md-12">
                           <label for="inputtext11" class="ul-form__label">Etat de paiement  :</label>
                           <div class="row">
                              <div class="col-md-11">
                      
                                 <select name="type_etat_paiement" id="" >

                                    <option >Selectionner</option>
                                    <option value="payé" {{ $fournisseur["etat_paiement"]=='payé' ? 'selected' : '' }} >payé</option>
                                    <option value="non payé" {{ $fournisseur["etat_paiement"]=='non payé' ? 'selected' : '' }}>non payé</option>
                                    <option value="partiellement payé" {{ $fournisseur["etat_paiement"]=='partiellement payé' ? 'selected' : '' }}>partiellement payé</option>

                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class=" form-row ">
                        <div class="form-group col-md-12">
                           <label for="inputtext11" class="ul-form__label">Date  :</label>
                           <div class="row">
                              <div class="col-md-11">
                                 

                                  <input type="date" name='date' value="<?php echo $fournisseur["date"] ?>" >

                              </div>
                           </div>
                        </div>
                     </div>
                     <div class=" form-row ">
                        <div class="form-group col-md-12">
                           <label for="inputtext11" class="ul-form__label">Numero de facture  :</label>
                           <div class="row">
                              <div class="col-md-11">
                                 

                                  <input type="number" name="numero_facture" value='{{ $fournisseur["numero_facture"] }}' >
                                  
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class=" form-row ">
                        <div class="form-group col-md-12">
                           <label for="inputtext11" class="ul-form__label">Projet  :</label>
                           <div class="row">
                              <div class="col-md-11">
                                 

                                  <select name="projet" id="" >
                                    <option value=""></option>
                                    @foreach($projets as $projet)
                                    <option value="{{ $projet->id }}">  {{$projet->client}} </option>
                                    @endforeach
                                  </select>
                                  
                              </div>
                           </div>
                        </div>
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
                                 <th scope="col">QTE </th>
                               
                                  <th scope="col">Prix</th>
                                  <th scope="col">Total</th>
                                  <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($articles as $article)
                              <tr id='row_{{$article->id}}' class="item">
                                 
                                
                                    
                          


                                    <td>
                                       <input type="number" name="numero[]" id="" value="{{$article->numero}}" required>
                                    </td>

                                    <td scope="row" class="row_p">
                                       <input type="text" name="product[]" value="{{$article->article}} " required>
                                 
                                    </td>
                                    
                                    <td>
                                       <input type="number" name="quantity[]" class="quantity" value="{{$article->qte}}" id="" required>
                                    </td>
                                    <td>
                                       <input type="number" name="prix[]" class="prix" value="{{ $article->prix }}" id="" required>
                                    </td>
                                    <td>
                                       0
                                       <input type="number" name="total[]" class="total" required hidden>
                                    </td>
                                    <td>
                                       <a href="" onClick="removeRow_table(event,1)" ><i class="i-Close-Window text-19 text-danger font-weight-700 prevent-default"></i></a>
                                    </td>


                                   
                       
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
   </section>
</form>
@endsection
@section('page-js')

<script src="{{ asset('js/plugins/jquery-3.5.1.min.js') }}"></script>
<link href="{{asset('assets/styles/css/select2.min.css')}}" rel="stylesheet" />
<script src="{{ asset('js/plugins/select2.min.js') }}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script>
   window.laravel ={!! json_encode([
     'token' => csrf_token(),
     'url'   => url('/'),
     'date'   => date('Y-m-d'),
   
   
   ]) !!}
   
   
   
   
</script>
<script src="{{ asset('js/order_script_copy.js') }}"></script>
@endsection
@section('bottom-js')
<script src="{{asset('assets/js/form.basic.script.js')}}"></script>
@endsection