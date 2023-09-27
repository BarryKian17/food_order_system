@extends('user.layouts.master')

@section('title','User Home Page')

@section('content')

<div class="col-6 offset-2">
    @if (session('success'))
    <div class="">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session ('success') }}  <i class="fa-sharp fa-solid fa-square-check"></i></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    </div>
    @endif
    <form action="{{ route('user#contactMessage') }}" method="POST">
        @csrf
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control-plaintext" id="staticEmail" name="userName" value="{{ Auth::user()->name }}">
            </div>
          </div>
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control-plaintext" id="staticEmail" name="userEmail" value="{{ Auth::user()->email }}">
            </div>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Message</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="userMessage" required></textarea>
          </div>
          <div class=" text-center">
            <button class="btn btn-danger w-25">
                Send <i class="fa-solid fa-paper-plane ms-2"></i>
              </button>
          </div>
    </form>
</div>

@endsection
