

var tableLength = 1;
var tableLength_2 = 1;
var count = 1;
var count_2 = 1;

function removeRow(e,row) {

    e.preventDefault();

    $('html,body').animate({
        scrollTop: 9999
    }, 'slow');
    document.getElementById("row" + row).remove();
    tableLength--;

}

function removeRow_table(e,row) {

    
    e.preventDefault();
    
    $('html,body').animate({
        scrollTop: 9999
    }, 'slow');
    document.getElementById("row_" + row).remove();
    tableLength_2--;
    
    $('table').on('click', 'input[type=number]', () => calculateTotals());
    calculateTotals();

}

function calculateTotals() {
    const subtotals = $('.item').map((idx, val) => calculateSubtotal(val)).get();
    const total = subtotals.reduce((a, v) => a + Number(v), 0);
    const tva = total * 0.20 ;
    const total_ttc = total + tva ;  
     
    $('.total_ht td:last').text(total +" DH");
    $('.t_tva td:last').text(tva+" DH");
    $('.total_ttc td:last').text(total_ttc+" DH");
    $('#total_ttc').val(total_ttc);  

}

function calculateSubtotal(row) {
    const $row = $(row);
    const inputs = $row.find('input');
    const subtotal = inputs[2].value * inputs[3].value;

    $row.find('td:last').prev().text(subtotal);

    return subtotal;
}

function formatAsCurrency(amount) {
    return `$${Number(amount).toFixed(2)}`;
 }



$(document).ready(function() {

    calculateTotals()

    $('table').on('mouseup keyup', 'input[type=number]', () => calculateTotals());

      const d = new Date();
      let year = d.getFullYear();
    
      $("#date_system").val(year);

      $(".btn-add-n").click(function(e) {



        e.preventDefault();

        $('html,body').animate({
            scrollTop: 9999
        }, 'slow');


   
        count_2++;

        

        var add_row = '<tr class="item" id=row_' + count_2 + '  >';
        add_row += '<td>  ';
        add_row += '   <select name="type[]">';
        add_row += ' <option value="">Service</option>';
        add_row += '  <option value="Material informatique">Material informatique</option>';
        add_row += ' <option value="Fourniture de bureau">Fourniture de bureau</option>';
        add_row += '<option value="Autre matĆ©riel  "> Autre matĆ©riel   </option> ';
        add_row += ' <option value="Instalation techniques">Instalation techniques</option> ';
        add_row += '</select> ';
       
        add_row += ' </td>';

        add_row += '<td>  ';
        add_row += '<input type="number" name="numero[]" required>';
        add_row += ' </td>';


        add_row += '<td><input type="text" name="product[]"  required>';

  
        add_row += '</td>';
       

        add_row += '<td>  ';
        add_row += '<input type="number" name="quantity[]" class="quantity" required>';
        add_row += ' </td>';
        add_row += '<td> <input type="number" name="prix[]" required> </td>';
        add_row += '<td>0 <input type="total" name="total[]" hidden> </td>';

        add_row += ' <td><a href="" class="prevent-default" onClick="removeRow_table(event,' + count_2 + ')" ><i class="i-Close-Window text-19 text-danger font-weight-700""></i></a></td></tr>';
            



        if (tableLength_2 > 0) {

            $("#table_product-n tbody tr:last").after(add_row);
        }
        if (tableLength_2 == 0) {

            $("#table_product-n tbody ").append(add_row);
        }
        tableLength_2++;




    

    });


      $("#projet").change(function(){

      
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            'async': false,
            url: window.laravel.url + "/fill_item_stock/"+$(this).val(),
            method: "post",
       
            dataType: "json",
            success: function(data) {
    
    
                console.log(data)
                $("#table_product-n tbody ").empty();
                jQuery.each(data.products, function(index, item) {
                  

                    count_2++;

                    var add_row = '<tr class="item" id=row_' + count_2 + '  >';
                   
            
                   
            
            
                    add_row += '<td><input type="text" name="product[]"  value="'+item.article+'"  required   readonly="readonly" >';
            
              
                    add_row += '</td>';
                   
                    add_row += '<td>'+item.type+' </td> ';
                    add_row += '<td>  ';
                    add_row += '<input type="number" name="quantity[]" class="quantity"  value="'+item.qte+'" required>';
                    add_row += ' </td>';
                    add_row += '<td> <input type="number" name="prix[]" value="" required  > </td>';
                    add_row += '<td>';
                    add_row += '<select>';

                        add_row += '<option> Selectionner </option>';
               
                        jQuery.each(data.projets, function(index, item) {
                          add_row += '<option value="'+item.id+'" > '+item.n_marche+'_'+item.client+' </option>';
                        });

                    add_row += '</select>';
                    add_row += '</td>';
            
                    add_row += ' <td><a href="" class="prevent-default" onClick="removeRow_table(event,' + count_2 + ')" ><i class="i-Close-Window text-19 text-danger font-weight-700""></i></a></td></tr>';


                   


                    $("#table_product-n tbody ").append(add_row);


                });

                
    
                    
    
    
    
                        
    
                    
    
    
              
    
                
    
    
            }
        })
      });




});