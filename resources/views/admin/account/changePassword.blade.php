@extends('admin.layouts.master')



@section('title','Change Password Page')

@section('content')


<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <a href="{{route('category#list')}}"><button class="btn btn-outline-dark my-3 px-3"><i class="fa-sharp fa-solid fa-arrow-left mx-2"></i>Back </button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Your Password</h3>
                        </div>
                        <hr>
                        @if (session('changeSuccess'))
                <div class="">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session ('changeSuccess') }}  <i class="fa-sharp fa-solid fa-square-check"></i></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                        <form action="{{route('admin#changePassword')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label  class="control-label mb-1">Old Password</label>
                                <input  name="oldPassword" type="password" value="" class="form-control @if(session('notMatch')) is-invalid @endif @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Old Password...">
                                @error('oldPassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                @if(session('notMatch'))
                                <div class="invalid-feedback">
                                    {{session('notMatch')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">New Password</label>
                                <input  name="newPassword" type="password" value="" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password...">
                                @error('newPassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">Confirm Password</label>
                                <input  name="confirmPassword" type="password" value="" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password...">
                                @error('confirmPassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Change Password</span>
                                    <i class="mx-1 fa-solid fa-lock"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection
