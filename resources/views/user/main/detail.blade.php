

@extends('user.layouts.master')

@section('title','Product Details Page')

@section('content')

    <!-- Shop Detail Start -->
    <button class="btn btn-warning my-3 m-4  px-3" onclick="history.back()"><i class="fa-sharp fa-solid fa-arrow-left mx-2"></i>
        Back
    </button>
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/'.$pizza->image) }}" alt="Image">
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $pizza->name }}</h3>
                    <div class="d-flex mb-3">
                        {{-- <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div> --}}
                        <small class="pt-1">({{ $pizza->view_count + 1 }}<i class="fa-solid fa-eye ms-1"></i>)</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $pizza->price }} MMK</h3>
                    <p class="mb-4">{{ $pizza->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mx-auto" style="width: 100px;">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-primary btn-minus" >
                                <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" id="orderCount" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger px-3" id="addCart"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                            <input type="text" value="{{ Auth::user()->id }}" id="userId" hidden>
                            <input type="text" value="{{ $pizza->id }}" id="pizzaId" hidden>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
            <div class="row">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $p)
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" style="height: 200px" src="{{ asset('storage/'.$p->image) }}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>

                                <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetails',$p->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{ $p->price }} MMK</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">

                                <small>{{ $p->waiting_time }} min</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
    @endsection

    @section('scriptSource')
    <script>
        $(document).ready(function(){

            //View Count
            $.ajax({
                type : 'get',
                url : '/user/ajax/view/count' ,
                dataType : 'json' ,

                data : {
                    'pizzaId' : $('#pizzaId').val()
                } ,
            })



            //Add to Cart button
            $('#addCart').click(function(){
                $count = $('#countOrder').val();

                $source = {
                    'count' : $('#orderCount').val() ,
                    'userId' : $('#userId').val() ,
                    'pizzaId' : $('#pizzaId').val()
                }
                $.ajax({
                type : 'get' ,
                url : '/user/ajax/addToCart' ,
                dataType : 'json' ,

                data : $source ,
                success : function(response){
                    if(response.status == 'success'){
                        window.location.href = '/user/home';
                    }
                 }
            })
            })
        });
    </script>
@endsection
