@extends('user.layouts.master')

@section('title','User Cart Page')

@section('content')
    <a href="{{ route('user#home') }}">
    <button class="btn btn-warning my-3 m-4  px-3" ><i class="fa-sharp fa-solid fa-arrow-left mx-2"></i>
        Back
    </button>
    </a>
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $c)
                        <tr>
                            <input type="hidden" value="{{ $c->pizza_price }}" name="" id="price">
                            <td><img src="{{ asset('storage/'.$c->pizza_image) }}" style="width: 100px" class="rounded" alt=""></td>
                            <td class="align-middle"><span class="text-danger fw-bold">{{ $c->pizza_name }}</span>
                                <input type="text" id="orderId" hidden value="{{ $c->id }}">
                                <input type="text" id="productId" hidden value="{{ $c->product_id }}">
                                <input type="text" id="userId" hidden value="{{ $c->user_id }}">
                            </td>
                            <td class="align-middle" id="">{{ $c->pizza_price }} MMK</td>
                            <td class="align-middle">
                                <div class="input-group spinner mx-auto" style="width: 100px;">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">

                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>

                                        <input type="text" disabled class="form-control form-control-sm bg-secondary border-0 text-center" name="qty" value="{{ $c->qty }}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                            </td>
                            <td class="align-middle" id="total">{{ $c->pizza_price*$c->qty }}MMK</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove" ><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{ $totalPrice }} MMK</h6>

                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery Fees</h6>
                            <h6 class="font-weight-medium">3000 MMK</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{ $totalPrice + 3000 }} MMK</h5>
                        </div>
                        <button class="btn btn-block btn-primary rounded font-weight-bold my-3 py-3" id="orderBtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger rounded font-weight-bold my-3 py-3" id="clearBtn">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    @endsection

@section('scriptSource')
<script src="{{ asset('js/cart.js') }}"></script>

<script>
    $('#orderBtn').click(function(){

    //     $parentNode = $(this).parents("tr");
    //    $price = $parentNode.find('#price').val();
    //    $qty = Number($parentNode.find('#qty').val()) ;
    //    $total = ($price*$qty) + "MMK";
    //    $parentNode.find('#total').html($total);

    //    summaryCalculation();

    //    function summaryCalculation(){
    //       //total summary
    //       $totalPrice = 0;
    $orderList = [];
    $randomNumber = 'RDP'  + '0000' + Math.floor(Math.random() * 10000) + "HER" +  Math.floor(Math.random() * 1000);

       $('#dataTable tbody tr').each(function(index,row){

        $orderList.push({
            'user_id' : $(row).find('#userId').val() ,
            'product_id' : $(row).find('#productId').val() ,
            'qty' : $(row).find('#qty').val() ,
            'total' : $(row).find('#total').text().replace("MMK","")*1 ,
            'order_code' : $randomNumber
        })
       });

       $.ajax({
        type : 'get' ,
        url : '/user/ajax/order' ,
        dataType : 'json' ,

        data : Object.assign({},$orderList),
        success : function(response){
            if (response.status == 'true'){
                window.location.href = '/user/home';
            }
         }
    })
  })
  $('#clearBtn').click(function(){
       $('#dataTable tbody tr').remove();
        $('#subTotal').html("0 MMK");
        $('#finalPrice').html("3000 MMK");

        $.ajax({
        type : 'get' ,
        url : '/user/ajax/cart/clear' ,
        dataType : 'json'
        })
    })

    $('.btnRemove').click(function(){
        $parentNode = $(this).parents("tr");
        $productId = $parentNode.find('#productId').val();
        $orderId = $parentNode.find('#orderId').val();
        console.log($productId);
        $parentNode.remove();

        $totalPrice = 0;
       $('#dataTable tbody tr').each(function(index,row){
        $totalPrice += Number($(row).find('#total').text().replace("MMK",""));
       });

       $("#subTotal").html(`${$totalPrice} MMK`);
       $("#finalPrice").html(`${$totalPrice+3000} MMK`);

       $.ajax({
        type : 'get' ,
        url : '/user/ajax/remove/product' ,
        data : {'productId' : $productId , 'orderId' : $orderId} ,
        dataType : 'json'
        })
    })
</script>

@endsection
