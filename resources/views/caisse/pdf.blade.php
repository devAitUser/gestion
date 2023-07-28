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

  <table class="table_title" width="100%" style='padding-top: 20px; '>
    <tr>
        <!-- <td><strong class='under_line'>Objet&nbsp;:</strong> {{ $caisse_detail['objet'] }}</td> -->

    </tr>


  </table>

  <br/>


  

  


  <div width="100%" style="background-color: #e9df85;" class="block_bon_caisse">

     <h3>  Bon de caisse : {{ $caisse_detail['id'] }}  </h3>

  </div>

  <table width="100%" class='table_info'>

    <tbody>



       <tr>

       <td width="20%" class="product" style="background-color: #e9df85;" >Date : </td>
       <td  width="50%" class="product" align="CENTER" > {{ $caisse_detail['date'] }} </td> 

       </tr>

       <tr>

       <td width="20%" class="product" style="background-color: #e9df85;" >Operation : </td>
       <td  width="50%" class="product" align="CENTER" >{{ $caisse_detail['operation'] }}</td> 
       </tr>

       @if( $caisse_detail['origin__du_compte'] != "" )
       <tr>
       <td width="20%" class="product" style="background-color: #e9df85;" >Source : </td>
       <td  width="50%" class="product" align="CENTER" >{{ $caisse_detail['origin__du_compte'] }}</td> 
       </tr>
       @endif


       @if( $caisse_detail['type'] != "" )
       <tr>
        <td width="20%" class="product" style="background-color: #e9df85;" >Type : </td>
        <td  width="50%" class="product" align="CENTER" >{{ $caisse_detail['type'] }}</td> 
       </tr>
       @endif

       @if( $caisse_detail['detail'] != "" )
       <tr>
        <td width="20%" class="product" style="background-color: #e9df85;" >Detail : </td>
        <td  width="50%" class="product" align="CENTER" >{{ $caisse_detail['detail'] }}</td> 
       </tr>
       @endif


       @if( $caisse_detail['Bénéficiaire'] != "" )
       <tr>
        <td width="20%" class="product" style="background-color: #e9df85;" >Bénéficiaire : </td>
        <td  width="50%" class="product" align="CENTER" >{{ $caisse_detail['Bénéficiaire'] }}</td> 
       </tr>
        @endif


        @if( $caisse_detail['montant'] != "" )
        <tr>
        <td width="20%" class="product" style="background-color: #e9df85;" >Montant : </td>
        <td  width="50%" class="product" align="CENTER" >  {{ number_format($caisse_detail['montant'],2,",",".")  }} DH </td> 
        </tr>
        @endif
  


     </tr>

    
 


    </tbody>

  </table>

  <table width="100%" style='padding-top: 25px; margin-left: 13px;'>
    <tr>
      <td width="30%"> Signature caissier :  </td>   <td width="40%" align="LEFT"> Signature courtier : </td>   <td width="30%"> Signature Bénéficiaire : </td>
    
    </tr>
  </table>

</body>
</html>