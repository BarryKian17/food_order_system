$(document).ready(function(){
    $('.btn-minus , .btn-plus').click(function(){

        $parentNode = $(this).parents("tr");
       $price = $parentNode.find('#price').val();
       $qty = Number($parentNode.find('#qty').val()) ;

       if($qty == 1){
        $parentNode.find(".btn-minus").attr("disabled");
       }

       $total = ($price*$qty) + "MMK";
       $parentNode.find('#total').html($total);

       summaryCalculation();
    })


    function summaryCalculation(){
          //total summary
          $totalPrice = 0;
       $('#dataTable tbody tr').each(function(index,row){
        $totalPrice += Number($(row).find('#total').text().replace("MMK",""));
       });

       $("#subTotal").html(`${$totalPrice} MMK`);
       $("#finalPrice").html(`${$totalPrice+3000} MMK`);
    }
})
