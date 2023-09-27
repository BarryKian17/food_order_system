@extends('admin.layouts.master')



@section('title','Account Info Page')

@section('content')


<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <a href="{{route('category#list')}}"><button class="btn btn-outline-dark my-3 px-3"><i class="fa-sharp fa-solid fa-arrow-left mx-2"></i>Back </button></a>
                </div>
                @if (session('updateSuccess'))
                <div class="col-5 offset-4">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>{{ session ('updateSuccess') }}<i class="fa-sharp fa-solid fa-square-check ms-1"></i></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center text-danger title-2">Account Info</h3>
                        </div>
                        <hr>


                        <div class="row">
                            <div class="col-3 offset-1">
                                @if (Auth::user()->image == null)
                               @if (Auth::user()->gender == 'female')
                                <img src="{{asset('img/girl.png')}}" class="rounded-circle" alt="John Doe" />
                                @else
                                <img src="{{asset('img/user.jpg')}}" class="rounded-circle" alt="John Doe" />
                                @endif
                            @else
                            <img src="{{asset('storage/'.Auth::user()->image)}}"class="rounded shadow-sm" alt="John Doe" />
                            @endif
                            </div>
                            <div class="col-7 ms-5">
                                <h4 class="my-3"><i class="fa-solid fa-user me-3"></i>{{ Auth::user()->name }}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-envelope me-3"></i>{{ Auth::user()->email }}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-mobile me-3"></i>{{ Auth::user()->phone }}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-venus-mars me-3"></i>{{ Auth::user()->gender }}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-location-crosshairs me-3"></i>{{ Auth::user()->address }}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-user-clock me-3"></i>{{ Auth::user()->created_at->format('j-F-Y') }}</h4>
                            </div>
                        </div>

                        <div class="row">
                           <div class="col-4 offset-4 mt-5">
                            <a href="{{ route('admin#edit') }}">
                                <button class="btn btn-outline-danger w-100">
                                    Edit Profile<i class="fa-solid fa-user-pen ms-2"></i>
                                </button>
                            </a>
                           </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection
