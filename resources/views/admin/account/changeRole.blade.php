@extends('admin.layouts.master')



@section('title','Account Info Edit Page')

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
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center text-danger title-2">Change Role</h3>
                        </div>

                        <form action="{{ route('admin#change',$account->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1 text-center">

                                    @if ($account->image == null)
                                    @if ($account->gender == 'female')
                                    <img src="{{asset('img/girl.png')}}" class="rounded-circle" alt="John Doe" />
                                    @else
                                    <img src="{{asset('img/user.jpg')}}" class="rounded-circle" alt="John Doe" />
                                    @endif
                                    @else
                                        <img src="{{asset('storage/'.$account->image)}}"class="rounded shadow-sm" alt="John Doe" />
                                    @endif
                                    <div class="form-group mt-1 text-start">
                                        <label for="control-label" class="">Image</label>
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" disabled>
                                        @error('image')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                    </div>
                                    <div class="">
                                        <button class="btn btn-outline-danger w-100 fw-bold" type="submit">Change Role<i class="mx-2 fa-solid fa-bolt"></i></button>
                                    </div>
                                </div>
                                <div class="col-6 ">

                                    <div class="form-group">
                                        <label  class="control-label mb-1">Name</label>
                                        <input  name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$account->name) }}"  aria-required="true" aria-invalid="false" placeholder="Enter New Name..." disabled>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Role</label>
                                        <select name="role" class="form-control" id="">

                                            <option value="admin" @if ($account->role == 'admin' ) selected @endif >admin</option>
                                            <option value="user" @if ($account->role == 'user' ) selected @endif>user</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Email</label>
                                        <input  name="email" type="email"  class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$account->email) }}" aria-required="true" aria-invalid="false" placeholder="Enter New Email..." disabled>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Phone</label>
                                        <input  name="phone" type="text"  class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone',$account->phone) }}" aria-required="true" aria-invalid="false" placeholder="Enter New Phone..." disabled>
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Gender</label>
                                        <select name="gender" id="" class="form-control " disabled>

                                            <option value="male" @if ($account->gender == 'male' ) selected @endif >Male</option>
                                            <option value="female" @if ($account->gender == 'female' ) selected @endif>Female</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label  class="control-label mb-1">Address</label>
                                        <textarea  name="address" type="text"  class="form-control @error('address') is-invalid @enderror p-1" rows="3" aria-required="true" aria-invalid="false"  placeholder="Enter New Address..." disabled>{{ old('address',$account->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection
