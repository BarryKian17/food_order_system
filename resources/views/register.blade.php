{{-- @extends('layouts.master')

@section('content')
<div class="login-form">
    <form action="{{route('register')}}" method="POST">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <input class="au-input au-input--full" type="text" name="name" placeholder="Username">
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label>phone</label>
            <input class="au-input au-input--full" type="text" name="phone" placeholder="Username">
        </div>
        <div class="form-group">
            <label>address</label>
            <input class="au-input au-input--full" type="text" name="address" placeholder="Username">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password">
        </div>

        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

    </form>
    <div class="register-link">
        <p>
            Already have account?
            <a href="{{ url('loginPage') }}">Sign In</a>
        </p>
    </div>
</div>
@endsection --}}

@extends('layouts.master')

@section('title','Register Page')

@section('content')

@endsection
<nav class="navbar bg-warning sticky-top" style=" box-shadow: 10px 10px 50px rgb(0, 0, 0);">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
       <span class="mx-2 text-danger fs-2 fw-bold">Red Devil's Pizzeria</span>
       <i class="fa-solid fa-pizza-slice text-danger"></i>
      </a>
    </div>
  </nav>
<div class="row gx-lg-5 align-items-center">
    <div class="col-lg-5 mb-5 mb-lg-0 shadow-lg">
                <div class="login-box">

                    <form class="shadow-lg mt-5" action="{{ route('register') }}" method="POST">
                        @csrf
                        <h2 class="text-warning">Register for Pizza Bliss!</h2><br>
                        <div class="user-box mx-5">
                            <input type="text" name="name"  value="{{ old('name') }}" >
                            <label>Your Name</label>
                            @error('name')
                                <p class="text-warning">*{{ $message }}*</p>
                            @enderror
                          </div>
                      <div class="user-box mx-5">
                        <input type="email" name="email"  value="{{ old('email') }}" >
                        <label>Your Email</label>
                        @error('email')
                            <p class="text-warning">*{{ $message }}*</p>
                        @enderror
                      </div>
                      <div class="user-box mx-5">
                        <input type="number" name="phone" value="{{ old('phone') }}"  >
                        <label>Your Phone</label>
                        @error('phone')
                            <p class="text-warning">*{{ $message }}*</p>
                        @enderror
                      </div>
                      <div class="container mx-5">
                        <div class="form-group w-50 mb-4">
                            {{-- <label for="gender" class="text-light">Gender</label> --}}
                            <select class="form-control text-white" name="gender" style="background: transparent ">
                                <option value="" class="" style="background: black ">Choose Your Gender....</option>
                              <option value="male" class="" style="background: black " >Male</option>
                              <option value="female" class="" style="background: black " >Female</option>
                            </select>
                          </div>
                          @error('gender')
                          <p class="text-warning">*{{ $message }}*</p>
                      @enderror
                      </div>
                      <div class="user-box mx-5">
                        <input type="text" name="address"  value="{{ old('address') }}" >
                        <label>Your Address</label>
                        @error('address')
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
                      <div class="user-box mx-5">
                        <input type="password" name="password_confirmation" >
                        <label>Confirm Password</label>
                        @error('password_confirmation')
                        <p class="text-warning">*{{ $message }}*</p>
                    @enderror
                      </div>
                      <div class="submit-box mt-3">
                        <button type="submit" class="rounded fw-bold">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Register
                          </button>
                       </div>
                   <h5 class="text-center mt-5 text-warning fs-4">Don't have an account?</h5>
                   <div class="submit-box">
                    <a href="{{ url('loginPage') }}">
                        <button type="button" class="rounded fw-bold">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Login Here
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

