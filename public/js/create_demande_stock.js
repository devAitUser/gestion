

var tableLength = 1;
var tableLength_2 = 0;
var count = 1;
var count_2 = 0;

var type = "";


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


  

    $(document).on("change",".select_article",function(e){   
        var item = $(this).parent();
        

        if( $(this).val() == "0" ){
            item.next().html(0);
        } 
      
    
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            'async': false,
            url: window.laravel.url + "/api_qte_article/"+ $(this).val() ,
            method: "get",
       
            dataType: "json",
            success: function(data) {
    
                item.next().html(data);
    
    
            }
        })

     });

    

      const d = new Date();
      let year = d.getFullYear();
    
      $("#date_system").val(year);

      $(".btn-add-n").click(function(e) {

            e.preventDefault();   
            count_2++;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                'async': false,
                url: window.laravel.url + "/api_stock_article",
                method: "get",
                data : {   'type' : type  },
        
                dataType: "json",
                success: function(data) {
        
        
                    console.log(data)
                
                    //$("#table_product-n tbody ").empty();
                


                    var add_row = '<tr class="item" id=row_' + count_2 + '  >';
                    add_row += '<td>  ';
                    add_row += '   <select name="article[]" class="select_article" onchange="fill_quantity(' + count_2 + ')">';
                    
                    add_row += ' <option value="0">Selectionner</option>';

                    jQuery.each(data, function(index, item) {
                        add_row += '  <option value="'+index+'"> '+index+' </option>';
                    });
    
                    add_row += '</select> ';
                
                    add_row += ' </td>';
            
                    add_row += '<td>  ';
                    add_row += '0';
                    add_row += ' </td>';
            
            
            
            
                    add_row += '</td>';
                
            
                    add_row += '<td>  ';
                    add_row += '<input type="number" name="quantity[]" class="quantity" required>';
                    add_row += ' </td>';
                    
                
            
                    add_row += ' <td><a href="" class="prevent-default" onClick="removeRow_table(event,' + count_2 + ')" ><i class="i-Close-Window text-19 text-danger font-weight-700""></i></a></td></tr>';
                        
            
            
            
                    if (tableLength_2 > 0) {
            
                        $("#table_product-n tbody tr:last").after(add_row);
                    }
                    if (tableLength_2 == 0) {
            
                        $("#table_product-n tbody ").append(add_row);
                    }
                    tableLength_2++;



                    

                    
                
        
                }
            })


        });


       $(document.body).on('change',"#projet",function (e) {

             $("#table_product-n tbody ").empty();

              tableLength_2 = 0;
              count_2 = 0;
    
              type = this.value;



       });


        






});