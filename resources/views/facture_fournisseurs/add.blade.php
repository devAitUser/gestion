@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">

  
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
    input#article_input {
    text-transform: uppercase;
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
                                 <input type="text" name="objet" class="form-control" value="{{$fournisseur}}"  disabled >
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
                   

                                 <input type="text" name="type_etat_paiement" value="non payé" hidden >
                              
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class=" form-row ">
                        <div class="form-group col-md-12">
                           <label for="inputtext11" class="ul-form__label">Date  :</label>
                           <div class="row">
                              <div class="col-md-11">
                                 

                                  <input type="date" name='date'>

                              </div>
                           </div>
                        </div>
                     </div>
                     <div class=" form-row ">
                        <div class="form-group col-md-12">
                           <label for="inputtext11" class="ul-form__label">Numero de facture  :</label>
                           <div class="row">
                              <div class="col-md-11">
                                 

                                  <input type="number" name="numero_facture">
                                  
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
                                    <option value="{{ $projet->id }}">  {{$projet->client }} / {{$projet->n_marche }}   </option>
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
                                 <th scope="col">Type</th>
                                 <th scope="col">Numero</th>
                                 <th scope="col">Article</th>
                                 <th scope="col">QTE </th>
                               
                                  <th scope="col">Prix</th>
                                  <th scope="col">Total</th>
                                  <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr id='row_1' class="item">
                                 <td>
                                     <select name="type[]" >
                                        <option value="Service">Service</option>
                                        <option value="Material informatique">Material informatique</option>
                                        <option value="Fourniture de bureau">Fourniture de bureau</option>
                                        <option value="Autre matériel">  Autre matériel  </option>
                                        <option value="Instalation techniques">Instalation techniques</option>
                                     </select>
                                 </td>
                                 <td>
                                    <input type="number"  name="numero[]" required>
                                  </td>
                                  <td scope="row" class="row_p">
                                      <input type="text" name="product[]" id="article_input" required>
                                
                                  </td>
                                  
                                  <td>
                                    <input type="number" name="quantity[]" class="quantity" id="" required>
                                  </td>
                                  <td>
                                    <input type="number" name="prix[]" class="prix" id="" required>
                                  </td>
                                  <td>
                                     0
                                    <input type="number" name="total[]" class="total" required hidden>
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
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
  $( function() {
    var pausecontent = new Array();
  
    var articles =  <?php echo json_encode($articles); ?>
    
    $( "#article_input" ).autocomplete({
      source: articles
    });
  } );
  </script>
@endsection