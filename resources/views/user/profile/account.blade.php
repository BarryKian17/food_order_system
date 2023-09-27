@extends('user.layouts.master')

@section('title','User Account Page')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-1 ">
                    <a href="{{route('user#home')}}"><button class="btn btn-outline-danger fw-bold w- my-3 px-3"><i class="fa-sharp fa-solid fa-arrow-left mx-2"></i>Back </button></a>
                </div>
                @if (session('updateSuccess'))
                <div class="col-4 offset-3">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <h4 class="mt-1 text-danger fw-bold">{{ session ('updateSuccess') }}<i class="fa-sharp fa-solid fa-square-check ms-1"></i></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
            </div>
            <div class="col-lg-9 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center text-danger title-2">Account Info</h3>
                        </div>
                        <hr>


                        <div class="row ">
                          <div class="d-flex">
                            <div class="col-3 offset-1 ">
                                @if (Auth::user()->image == null)
                               @if (Auth::user()->gender == 'female')
                                <img src="{{asset('img/girl.png')}}" class="rounded-circle" alt="John Doe" />
                                @else
                                <img src="{{asset('img/user.jpg')}}" class="rounded-circle" alt="John Doe" />
                                @endif
                            @else
                            <img src="{{asset('storage/'.Auth::user()->image)}}"class="rounded w-100" alt="John Doe" />
                            @endif
                            </div>
                            <div class="col-6 offset-2 ms-5">
                                <h4 class="my-3"><i class="text-danger fa-solid fa-user me-3"></i>{{ Auth::user()->name }}</h4>
                                <h4 class="my-3"><i class="text-danger fa-solid fa-envelope me-3"></i>{{ Auth::user()->email }}</h4>
                                <h4 class="my-3"><i class="text-danger fa-solid fa-mobile me-3"></i>{{ Auth::user()->phone }}</h4>
                                <h4 class="my-3"><i class="text-danger fa-solid fa-venus-mars me-3"></i>{{ Auth::user()->gender }}</h4>
                                <h4 class="my-3"><i class="text-danger fa-solid fa-location-crosshairs me-3"></i>{{ Auth::user()->address }}</h4>
                                <h4 class="my-3"><i class="text-danger fa-solid fa-user-clock me-3"></i>{{ Auth::user()->created_at->format('j-F-Y') }}</h4>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                           <div class="col-4 offset-4 mt-5">
                            <a href="{{ route('user#editPage') }}">
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
@endsection
