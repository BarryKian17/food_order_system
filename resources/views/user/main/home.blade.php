
@extends('user.layouts.master')

@section('title','User Home Page')

@section('content')
        <!-- Shop Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <!-- Shop Sidebar Start -->
                <div class="col-lg-3 col-md-4">
                    <!-- Price Start -->
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Category</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <form>
                            <div class="custom-control rounded custom-checkbox d-flex align-items-center justify-content-between mb-3 border-bottom bg-danger text-warning p-1">

                                <a href="{{ route('user#home') }}"><label class="h5 text-warning mt-1" for="price-all">Categoryies</label></a>

                                <span class=" bg-warning mt-1 rounded h5 text-danger p-1">{{ count($category) }}</span>
                            </div>
                           @foreach ($category as $c)
                           <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 shadow-sm text-black">

                           <a href="{{ route('user#filter',$c->id) }}"> <label class="fw-bold" for="price-1">{{$c->name}}</label></a>

                        </div>
                           @endforeach

                        </form>
                    </div>
                    <!-- Price End -->


                    <div class="">
                        <a href=" {{ route('user#cartList') }}">
                            <button class="btn btn btn-outline-danger fs-5  w-100">Order<i class="fa-solid fa-circle-chevron-right ms-1"></i></button>

                        </a>
                    </div>

                </div>
                <!-- Shop Sidebar End -->


                <!-- Shop Product Start -->
                <div class="col-lg-9 col-md-8">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <a href="{{ route('user#cartList') }}">
                                    <button type="button" class="btn btn-outline-danger rounded position-relative">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        @if ( count($cart) ==0 )

                                        @else
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                         {{ count($cart) }}
                                         <span class="visually-hidden">unread messages</span>
                                       </span>
                                        @endif
                                      </button>
                                    </a>

                                    <a href="{{ route('user#cartHistory') }}" class="ms-3">
                                        <button type="button" class="btn btn-outline-danger rounded position-relative">
                                            History <i class="fa-solid fa-clock-rotate-left"></i>
                                           @if ( count($history) ==0 )

                                           @else
                                           <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($history) }}
                                            <span class="visually-hidden">unread messages</span>
                                          </span>
                                           @endif
                                          </button>
                                        </a>
                                </div>
                                <div class="ml-2">
                                    <div class="btn-group">
                                        <select  class="btn btn-danger dropdown-toggle" id="sortingOption" name="sorting" data-toggle="dropdown">
                                            <option class="dropdown-item text-white" value="" href="#">Sorting...</option>
                                            <option class="dropdown-item text-white" value="asc" href="#">Price(Low to High)</option>
                                            <option class="dropdown-item text-white" value="desc" href="#">Price(High to Low)</option>
                                        </select>






                                    </div>
                                    {{-- <div class="btn-group ml-2">
                                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">10</a>
                                            <a class="dropdown-item" href="#">20</a>
                                            <a class="dropdown-item" href="#">30</a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row" id="dataList">
                            @if ( count($pizza) != 0)
                            @foreach ($pizza as $p)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">

                                    <div class="product-item bg-light mb-4"  id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <a href="{{ route('user#pizzaDetails',$p->id) }}"><img class="img-fluid w-100" src="{{ asset('storage/'.$p->image) }}" alt="" style="height: 220px"> </a>
                                             <div class="product-action">
                                                {{-- <a class="btn btn-outline-danger fs-5 mx-2 btn-square" href=""><i class="fa fa-shopping-cart"></i></a> --}}
                                                <a class="btn btn-outline-danger fs-5 mx-2 btn-square" href="{{ route('user#pizzaDetails',$p->id) }}"><i class="fa-solid fa-circle-info"></i></a>

                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h5 text-decoration-none text-truncate d-block text-danger fs-5 fw-bold" href="{{ route('user#pizzaDetails',$p->id) }}">{{ $p->name }}</a>

                                            <div class="d-block  align-items-center justify-content-center mt-2">
                                                <h6 ><i class="fa-solid fa-money-bill me-1"></i>{{ $p->price }} kyats</h6>
                                                {{-- <h5>{{ $p->price }} kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                                <h6><i class="fa-solid fa-stopwatch me-1"></i>{{ $p->waiting_time }} min</h6>
                                            </div>

                                        </div>
                                    </div>

                           </div>
                            @endforeach
                            @else
                                <h3 class="bg-warning p-3 fw-bold col-6 offset-3  text-center text-danger mt-3"> There is no pizza here </h3>
                            @endif
                        </div>



                    </div>
                </div>
                <!-- Shop Product End -->
            </div>
        </div>
        <!-- Shop End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
    // $.ajax({
    //     type : 'get' ,
    //     url : 'http://127.0.0.1:8000/user/ajax/pizza/list' ,
    //     dataType : 'json' ,
    //     success : function(response){
    //         console.log(response);
    //     }
    // })\

    $('#sortingOption').change(function(){
        $eventOption = $('#sortingOption').val();

        if($eventOption == 'asc'){
           $.ajax({
        type : 'get' ,
        url : 'http://127.0.0.1:8000/user/ajax/pizza/list' ,
        dataType : 'json' ,

        data : { 'status' : 'asc' },
        success : function(response){
            $list = '';

            for($i=0;$i<response.length;$i++){
            //    console.log(`${response[$i].name}`);

               $list += `
               <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
               <div class="product-item bg-light mb-4"  id="myForm">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" alt="" style="height: 220px">
                         <div class="product-action">

                            <a class="btn btn-outline-danger fs-5 mx-2 btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h5 text-decoration-none text-truncate d-block text-danger fs-5 fw-bold" href=""> ${response[$i].name} </a>

                        <div class="d-block  align-items-center justify-content-center mt-2">
                            <h6 ><i class="fa-solid fa-money-bill me-1"></i> ${response[$i].price} kyats</h6>
                            {{-- <h5>{{ $p->price }} kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                            <h6><i class="fa-solid fa-stopwatch me-1"></i>${response[$i].waiting_time} min</h6>
                        </div>

                    </div>
                </div>
            </div>
               `;
            }
            $('#dataList').html($list);
        }
    })
        } else if($eventOption == 'desc'){
            $.ajax({
        type : 'get' ,
        url : '/user/ajax/pizza/list' ,
        dataType : 'json' ,
        data : { 'status' : 'desc' },
        success : function(response){
            $list = '';
            for($i=0;$i<response.length;$i++){
            //    console.log(`${response[$i].name}`);
               $list += `
               <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
               <div class="product-item bg-light mb-4"  id="myForm">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" alt="" style="height: 220px">
                         <div class="product-action">
                            <a class="btn btn-outline-danger fs-5 mx-2 btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-danger fs-5 mx-2 btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h5 text-decoration-none text-truncate d-block text-danger fs-5 fw-bold" href=""> ${response[$i].name} </a>

                        <div class="d-block  align-items-center justify-content-center mt-2">
                            <h6 ><i class="fa-solid fa-money-bill me-1"></i> ${response[$i].price} kyats</h6>
                            {{-- <h5>{{ $p->price }} kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                            <h6><i class="fa-solid fa-stopwatch me-1"></i>${response[$i].waiting_time} min</h6>
                        </div>

                    </div>
                </div>
            </div>
               `;
            }
            $('#dataList').html($list);
        }
    })
        }
    })
});

    </script>
@endsection
