<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title> Bon de caisse </title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }

    .gray {
        background-color: lightgray
    }
    th {
    padding: 12px !important;
    }
    .table_info,.table_info th,.table_info td {
    border: 1px solid black;
    border-collapse: collapse;
    border-left: none;
    border-bottom: none;
    padding: 10px;
    }
    td.col_none {
    border: none;
    }
    thead {
    border-left: 1px solid;
    }
    .product ,.footer_border {
    border-left: 1px solid !important;
    border-bottom: 1px solid !important;
    }
    .under_line {
    text-decoration: underline;
    text-underline-position: under;
    }
    .control_footer {
    position: relative;
    left: 50%;
    text-align: center;
    transform: translateX(-50%);
    }

    .c_f {
    width: 100px;
     }
    .table_title tr,.table_title td {
    padding: 10px;
    }


    .block_bon_caisse {
        border: 1px solid;
        margin-bottom: 15px;
        text-align: center;
    }

    img.master_archives_logo {
        width: 35%;
    }

    .block_table {
        display: flex;
    }

</style>

</head>
<body>



  <table width="100%"  >

    <tr>
 
        <td align="LEFT">
            <img class="master_archives_logo"   src="{{public_path('assets/images/logo_master_archives.png')}}" alt="">

        </td>
    </tr>

  </table>

  <table class="table_title" width="50%" style='padding-top: 20px; '>
    <tr>
       <td> <b>Client :</b>   </td>  <td> {{$client['nom_client']}}  </td>
      
    </tr>
    <tr>
    
       <td> <b>Projet :</b>   </td>  <td> {{$projet['objet']}} </td>
    </tr>



  </table>

  <br/>


  

  


  <div width="100%" style="background-color: #e9df85;" class="block_bon_caisse">

     <h3> information sur le client :   </h3>

  </div>




    <table width="100%" class='table_info'>

      <tbody>



        <tr>

        <td width="50%" class="product"  >  <b> Nom de client </b> : {{$client['nom_client']}}  </td>
        <td  width="50%" class="product" align="CENTER" > <b> Ice </b> : {{$client['ice']}} </td> 
        <td  width="50%" class="product" align="CENTER" > <b> Telephone 1 </b> :  0{{$client['telephone1']}}  </td> 

        </tr>

        <tr>

        <td width="50%" class="product"  ><b> Telephone 2 </b> :  0{{$client['telephone2']}}</td>
        <td  width="50%" class="product" align="CENTER" > <b> Numero de fax </b> :  0{{$client['numero_fax']}} </td> 
        <td  width="50%" class="product" align="CENTER" > <b> Adresse complete </b> :  {{$client['adresse_complete']}} </td> 
        </tr>

        <tr>

          <td width="50%" class="product"  ><b> Adresse_mail </b> :  {{$client['adresse_mail']}}</td>
          <td  width="50%" class="product" align="CENTER" > <b> ville </b> :  {{$client['ville']}} </td> 
          <td  width="50%" class="product" align="CENTER" >  </td> 
        </tr>

      



      </tr>





      </tbody>

    </table>


    <div width="100%" style="background-color: #e9df85;" class="block_bon_caisse">

      <h3> information sur le projet :   </h3>

    </div>




    <table width="100%" class='table_info'>

      <tbody>



        <tr>

        <td width="50%" class="product"  > <b> Type de prestation </b> : {{$projet['type_prestation']}} </td>
        <td  width="50%" class="product" align="CENTER" ><b> Objet </b> : {{$projet['type_prestation']}} </td> 
        <td  width="50%" class="product" align="CENTER" > <b> Numero de marche </b> : {{$projet['n_marche']}} </td> 

        </tr>

        <tr>

        <td width="20%" class="product"  ><b> Date de debut </b> : {{$projet['date_debut']}} </td>
        <td  width="50%" class="product" align="CENTER" > <b> Duree </b> : {{$projet['duree']}} </td> 
        <td  width="50%" class="product" align="CENTER" > <b> Montant minimum </b> : {{$projet['montant_min']}} </td> 
        </tr>

        <tr>
          <td width="20%" class="product"  ><b> Montant maximum </b> : {{$projet['montant_max']}} </td>
          <td  width="50%" class="product" align="CENTER" >  </td> 
          <td  width="50%" class="product" align="CENTER" > </td> 
        </tr>

      



      </tr>





      </tbody>

    </table>

    <div width="100%" style="background-color: #e9df85;" class="block_bon_caisse">

       <h3> informations de facturation :   </h3>

    </div>




    <table width="100%" class='table_info'>

      <tbody>



        <tr style="background-color: #e9df85;">
        
          <td  class="product"  > Numero : </td>
          <td  class="product"  > Designation : </td>
          
          <td   class="product" align="CENTER" > unite : </td> 
          <td   class="product" align="CENTER" > Quantite Min : </td> 
          <td   class="product" align="CENTER" > Quantite Max : </td> 
          <td   class="product" align="CENTER" > Prix : </td> 

        </tr>

        @foreach($product_factures as $product_facture)
        <tr>

          <td  class="product"  > {{$product_facture->numero}} </td>
          <td  class="product"  > {{$product_facture->designation}} </td>
          
          <td   class="product" align="CENTER" > {{$product_facture->unite}}  </td> 
          <td   class="product" align="CENTER" > {{$product_facture->quantite}}  </td> 
          <td   class="product" align="CENTER" > {{$product_facture->quantite_max}} </td> 
          <td   class="product" align="CENTER" > {{$product_facture->prix}} </td> 

        </tr>
        @endforeach







     





      </tbody>

    </table>









</body>
</html>