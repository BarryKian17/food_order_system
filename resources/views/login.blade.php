@extends('layouts.master')

@section('title','Login Page')

@section('content')

@endsection
<nav class="navbar bg-warning sticky-top" style=" box-shadow: 10px 10px 50px rgb(0, 0, 0);">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
       <span class="mx-2 text-danger fs-2 fw-bold"> Red Devil's Pizzeria</span>
       <i class="fa-solid fa-pizza-slice text-danger"></i>
      </a>
    </div>
  </nav>
<div class="row gx-lg-5 align-items-center">
    <div class="col-lg-5 mb-5 mb-lg-0 shadow-lg">
                <div class="login-box">

                    <form class="shadow-lg mt-5" action="{{ route('login') }}" method="POST" style="height: 500px">
                        @csrf
                        <h2 class="text-warning">Login for Pizza Bliss!</h2><br>
                      <div class="user-box mx-5">
                        <input type="email" name="email"  >
                        <label>Your Email</label>
                        @error('email')
                            <p class="text-warning">*{{ $message }}*</p>
                        @enderror
                      </div>
                      <div class="user-box mx-5">
                        <input type="password" name="password" >
                        <label>Password</label>
                        @error('password')
                        <p class="text-warning">*{{ $message }}*</p>
                    @enderror
                      </div>
                   <div class="submit-box mt-3">
                    <button type="submit" class="rounded fw-bold">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Login
                      </button>
                   </div>
                   <h5 class="text-center mt-5 text-warning fs-4">Don't have an account?</h5>
                   <div class="submit-box">
                    <a href="{{ url('/registerPage') }}">
                        <button type="button" class="rounded fw-bold">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Register Here
                        </button>
                    </a>
                   </div>
                    </form>
                  </div>
    </div>
    <div class="col-lg-7 mb-5 mb-lg-0">
        <h1 class="my-3 display-3 fw-bold ls-tight text-warning">
            Crave. Order. Enjoy. <br />

        </h1>
        <p style="color: hsl(0, 0%, 100%)">
            Experience pizza perfection with our mouthwatering creations: fresh, quality ingredients; perfect crust; irresistible flavors. Indulge in the ultimate pizza satisfaction. Taste the difference, and elevate your pizza game today!
        </p>
      </div>
</div>
