@extends('admin.layouts.master')



@section('title','Order List Page')

@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                {{-- <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Orders List</h2>

                        </div>
                    </div>

                </div> --}}
                @if (session('createSuccess'))
                <div class="col-5 offset-7">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session ('createSuccess') }}  <i class="fa-sharp fa-solid fa-square-check"></i></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                @if (session('deleteSuccess'))
                <div class="col-5 offset-7">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session ('deleteSuccess') }}  <i class="fa-sharp fa-solid fa-square-check"></i></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                @if (session('updateSuccess'))
                <div class="col-5 offset-7">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session ('updateSuccess') }}  <i class="fa-sharp fa-solid fa-square-check"></i></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

                <div class="row ">
                    <div class="col-3"><h4>Search key: <span class="text-danger">{{ request('key') }}</span></h4></div>
                <div class="col-3 offset-6">
                    <form action="{{ route('admin#orderList') }}" method="GET" class="d-flex border border-0 rounded-right">
                        @csrf
                        <input type="text" name="key" class="p-2" value="{{ request('key') }}">
                        <button class="btn btn-outline-danger border-0" type="submit" title="Search">
                            <i class="fa-solid fa-magnifying-glass fs-5"></i>
                        </button>
                    </form>
                </div>
                </div>

                <div class="row">
                    <div class="d-flex">
                        <div class="my-4 col-3">
                            <div class=" bg-light shadow-sm py-2 px-3 text-center">
                               <h4>Total - ({{ $order->total() }}) </h4>
                            </div>
                        </div>
                        <div class="col-4 offset-5 my-4">
                     <form action="{{ route('admin#changeStatus') }}" method="get">
                        @csrf
                        <div class="input-group mb-3">

                            <select class="form-select" name="orderStatus" id="inputGroupSelect03" aria-label="Example select with button addon">
                                <option class=""  value="">All <i class="fa-solid fa-hourglass-half ms-1"></i></option>
                                <option class="" id="" value="0" @if(request('orderStatus') == '0') selected @endif>Pending <i class="fa-solid fa-hourglass-half ms-1"></i></option>
                                <option class="" id="" value="1" @if(request('orderStatus') == '1') selected @endif>Success <i class="fa-solid fa-circle-check ms-1"></i></option>
                                <option class="" id="" value="2" @if(request('orderStatus') == '2') selected @endif>Reject<i class="fa-solid fa-triangle-exclamation ms-2"></i></option>
                            </select>
                            <button type="submit" class="btn btn-danger changeBtn">Search</button>
                          </div>
                    </form>
                    </div>
                    </div>
                </div>

             {{-- @if (count($pizzas) != 0) --}}
             <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>

                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Order Code</th>
                            <th>Order Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th></th>

                         </tr>
                    </thead>
                    <tbody id="dataList">
                        @foreach ($order as $o)
                        <tr class="tr-shadow">
                            <input type="hidden" class="orderId"  value="{{ $o->id }}">
                            <td class="col-1">{{ $o->user_id }}</td>
                            <td class="col-2">{{$o->user_name }}</td>
                            <td class="col-2">
                                <a href="{{ route('admin#listInfo',$o->order_code) }}">
                                    <button class="btn btn-sm btn-link w-100">
                                        {{ $o->order_code }}
                                    </button>
                                </a>
                            </td>
                            <td class="col-2">{{ $o->created_at->format('F-j-Y')}}</td>
                            <td class="col-2 amount">{{ $o->total_price}}<span class="ms-1">MMK</span></td>
                            <td class="">
                                <select name="status" id="" class=" w-75 p-1 fw-bold statusChange">
                                    <option value="0" class="text-warning fw-bold" @if ($o->status == 0) selected @endif>Pending</option>
                                    <option value="1" class="text-success fw-bold" @if ($o->status == 1) selected @endif>Success</option>
                                    <option value="2" class="text-danger fw-bold" @if ($o->status == 2) selected @endif>Reject</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $order->links() }}
                </div>
            </div>
             {{-- @else
             <H2>There is no Product Here!!</H2>
             @endif --}}

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection

@section('scriptSource')
    <script>
        $('document').ready(function(){
    //      $('#orderStatus').change(function(){
    //         $status = $('#orderStatus').val();


    //         $.ajax({
    //     type : 'get' ,
    //     url : 'http://127.0.0.1:8000/order/ajax/status' ,
    //     dataType : 'json' ,

    //     data : { 'status' : $status },
    //     success : function(response){
    //          $list = '';
    //         for($i=0;$i<response.length;$i++){
    //         //    console.log(`${response[$i].name}`);


    //         $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    //         $dbDate = new Date(response[$i].created_at);
    //         $finalDate = $month[$dbDate.getMonth()] + "-" + $dbDate.getDate() + "-" + $dbDate.getFullYear();

    //         if(response[$i].status == 0){
    //             $status = `
    //             <select name="status" id="" class=" w-75 p-1 fw-bold statusChange">
    //                 <option value="0" selected class="text-warning fw-bold" >Pending</option>
    //                 <option value="1" class="text-success fw-bold" >Success</option>
    //                 <option value="2" class="text-danger fw-bold" >Reject</option>
    //             </select>
    //             `
    //         } else if(response[$i].status == 1){
    //             $status = `
    //             <select name="status" id="" class=" w-75 p-1 fw-bold statusChange">
    //                 <option value="0"  class="text-warning fw-bold" >Pending</option>
    //                 <option value="1" selected class="text-success fw-bold" >Success</option>
    //                 <option value="2" class="text-danger fw-bold" >Reject</option>
    //             </select>
    //             `
    //         }else{
    //             $status = `
    //             <select name="status" id="" class=" w-75 p-1 fw-bold statusChange">
    //                 <option value="0"  class="text-warning fw-bold" >Pending</option>
    //                 <option value="1" class="text-success fw-bold" >Success</option>
    //                 <option value="2" selected class="text-danger fw-bold" >Reject</option>
    //             </select>
    //             `
    //         }

    //             $list += `
    //              <tr class="tr-shadow">
    //                 <input type="hidden" class="orderId"  value="${response[$i].id}">

    //                 <td class="col-1">${response[$i].user_id }</td>
    //                 <td class="col-2">${response[$i].user_name }</td>
    //                 <td class="col-2">${response[$i].order_code }</td>
    //                 <td class="col-2">${$finalDate}</td>
    //                 <td class="col-2">${response[$i].total_price}<span class="ms-1">MMK</span></td>
    //                 <td class="">${$status}</td>
    //             </tr>
    //            `;
    //         }
    //         $('#dataList').html($list);
    //     }

    //     })
    // })

    //change status
    $('.statusChange').change(function(){
        $currentStatus = $(this).val();
        $parentNode = $(this).parents("tr");
        $orderId = $parentNode.find('.orderId').val()


        $.ajax({
        type : 'get' ,
        url : '/order/ajax/status/change' ,
        dataType : 'json' ,

        data : {
            'status' : $currentStatus,
            'orderId' : $orderId
        }

        })


    })

})
    </script>
@endsection
