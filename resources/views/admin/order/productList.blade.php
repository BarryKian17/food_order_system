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

                {{-- <div class="row ">
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
                </div> --}}

                <div class="row">
                    <div class="d-flex">
                        <div class="col-4 mt-1">
                            <button class="btn btn-danger w-25" onclick="history.back()"><i class="fa-sharp fa-solid fa-arrow-left me-1"></i>Back</button>

                            <div class="mt-5 ms-2 p-2 bg-light">
                               @if ($totalPrice[0]->status == 0)
                               <div class="row">
                                <div class="d-flex">
                                    <h4 class="mt-1 me-2">Order Status :</h4>
                                    <h4 class="mt-1">Pending...</h4>
                                    <button class="btn btn-sm btn-warning ms-2"><i class="fa-regular fa-hourglass-half"></i></button>
                                </div>
                            </div>
                               @endif
                               @if ($totalPrice[0]->status == 1)
                                <div class="row">
                                    <div class="d-flex">
                                        <h4 class="mt-1 me-2">Order Status :</h4>
                                        <h4 class="mt-1 text-success">Success</h4>
                                        <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-check"></i></button>
                                    </div>
                                </div>
                               @endif
                               @if ($totalPrice[0]->status == 2)
                               <div class="row">
                                <div class="d-flex">
                                    <h4 class="mt-1 me-2">Order Status :</h4>
                                    <h4 class="mt-1 text-danger">Reject</h4>
                                    <button class="btn btn-sm btn-danger ms-2"><i class="fa-solid fa-triangle-exclamation"></i></button>
                                </div>
                            </div>
                               @endif
                            </div>
                        </div>
                        <div class="my-1 offset-4 col-4">
                            <div class="card">
                                <div class="card-title text-center mt-1">
                                    <h3>Order Info <i class="fa-solid fa-clipboard-list ms-1"></i></h3>
                                    <h5 class="text-muted">(delivery fees included !!!)</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="d-flex">
                                            <div class="col-5">
                                                <h4 class="my-2"><i class="fa-solid fa-user me-1"></i>User Name:</h4>
                                                <h4 class="my-2"># Order Code:</h4>
                                                <h4 class="my-2"><i class="fa-solid fa-money-bill me-1"></i>Total-Price:</h4>
                                                <h4 class="my-2"><i class="fa-solid fa-calendar-days me-1"></i>Date:</h4>
                                            </div>
                                            <div class="col-7">
                                                <h4 class=" text-danger my-2">{{ $orderList[0]->user_name }}</h4>
                                                <h4 class=" text-danger my-2">{{ $orderCode }}</h4>
                                                <h4 class=" text-danger my-2"> {{ $totalPrice[0]->total_price}} MMK</h4>
                                                <h4 class=" text-danger my-2">{{ $orderList[0]->created_at->format('F-j-Y') }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>

            {{-- @if (count($pizzas) != 0) --}}
             <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>

                            <th>Product Image</th>
                            <th>Product Name</th>

                            <th>Product's Price</th>
                            <th>Quantity</th>
                            <th>Total</th>


                         </tr>
                    </thead>
                    <tbody id="dataList">
                        @foreach ($orderList as $o)
                        <tr class="tr-shadow">
                            <input type="hidden" class="orderId"  value="{{ $o->id }}">
                            <td class="col-2"><img src="{{ asset('storage/'.$o->product_image) }}" class="w-75" alt=""></td>
                            <td class="col-2">{{$o->product_name }}</td>
                            <td class="col-2">{{ $o->price }} MMK</td>
                            <td class="col-2">{{ $o->qty }}</td>
                            <td class="col-2 amount">{{ $o->total}}<span class="ms-1">MMK</span></td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
                {{-- <div class="mt-3">
                    {{ $order->links() }}
                </div> --}}
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
