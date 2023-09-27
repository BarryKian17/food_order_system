@extends('admin.layouts.master')



@section('title','Product Details Page')

@section('content')


<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <button class="btn btn-warning my-3 px-3" onclick="history.back()"><i class="fa-sharp fa-solid fa-arrow-left mx-2"></i>
                        Back
                    </button>
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
                            <h3 class="text-center title-2">Pizza Details</h3>
                        </div>
                        <hr>


                        <div class="row">
                            <div class="col-3 offset-1">


                            <img src="{{asset('storage/'.$pizza->image)}}"class="rounded shadow-sm" alt="John Doe" />

                            </div>
                            <div class="col-7 ms-5">
                                <button class="bg-warning px-2 rounded" style=" pointer-events: none;"><h4 class="my-2 text-danger"><i class="fa-solid fa-pizza-slice me-3 "></i>{{ $pizza->name }}</h4></button>
                                <h4 class="my-2"><i class="fa-sharp fa-solid fa-tags me-2"></i>{{ $pizza->category_name }}</h4>
                                <h4 class="my-2"><i class="fa-solid fa-money-bill me-3 "></i>{{ $pizza->price }} MMK</h4>
                                <h4 class="my-2"><i class="fa-solid fa-eye me-3 "></i>{{ $pizza->view_count }}</h4>
                                <h4 class="my-2"><i class="fa-solid fa-stopwatch me-3 "></i>{{ $pizza->waiting_time }} min</h4>
                                <h4 class="my-2"><i class="fa-solid fa-calendar me-3 "></i>{{ $pizza->created_at->format('j-F-Y') }}</h4>
                            </div>
                        </div>
                        <div class="text-muted mt-2">
                            <p>{{ $pizza->description }}</p>
                        </div>

                        {{-- <div class="row">
                           <div class="col-4 offset-4 mt-5">
                            <a href="{{ route('admin#edit') }}">
                                <button class="btn btn-danger w-100">
                                    Edit Profile<i class="fa-solid fa-user-pen ms-2"></i>
                                </button>
                            </a>
                           </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection
