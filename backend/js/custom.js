$(function () {
//iCheck for checkbox and radio inputs
       
        //Red color scheme for iCheck
        $('.itemslist input[type="checkbox"],#conference-ushers input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        $('.itemslist input[type="radio"]').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        
});
function generatePackage(checkboxlist)
{
    var node = '<div class="form-group">'+
                       '<div class="col-sm-2"><input class="form-control" placeholder="Package Name" type="text" name="package[]" required></div>'+
                       '<div class="col-sm-2"><input placeholder="price" min="0" class="form-control" type="number" name="price[]" required></div>'+
                       '<div class="col-sm-7"><h4 class="col-sm-2">Items:</h4>'+checkboxlist+'</div>'+
                       '<div class="col-sm-1"><a class="btn btn-danger btn-sm fa fa-minus fa-lg delete-new-row"> </a></div>'+
                       '</div>';
               $(".more-items").append(node);
               
    $('.itemslist input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
}

function naming()
{
    var i=0;
    
    $(".itemslist").each(function(){
        $(this).find(':checkbox').attr('name', 'items['+i+'][]');
        i++;
    });
}

    $(document).on('keyup', '#import-form textarea', function (event){
        var text = $(this).val();
        var lines = text.split(/\r|\r\n|\n/);
        var count = lines.length;
        $(this).prev('label').find('span').text("("+count+")");
        //alert(count);
        //if (text.length == 0)
        //    $("#" + $(this).attr('data-count_span')).html('(0)');
        //else
        //    $("#" + $(this).attr('data-count_span')).html('(' + count + ')');
    });
    
    function validateUsherCare(store)
    {
        var max = parseInt($('#max_'+store).val());
        var total = 0; 
        $('.qty_'+store).each(function(){
           total += parseInt($(this).val());
        });
        //alert(total);
        if(total > max)
        {
            $("#error_"+store).show();
            $("#valid").val('0');
        }
        else{
            $("#error_"+store).hide();
            $("#valid").val('1');
        }
            
            
    }
    
    $(document).on('submit', '#care-form', function (event){
        if($("#valid").val() == "0")
            return false
        return true;
        });

    