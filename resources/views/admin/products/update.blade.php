@extends('admin.layouts.master')



@section('title','Pizza Update Page')

@section('content')


<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <button class="btn btn-warning my-3 px-3" onclick="history.back()"><i class="fa-sharp fa-solid fa-arrow-left mx-2"></i>
                        Back
                    </button>                </div>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="text-center text-danger">Edit Pizza Details</h3>
                                </div>
                                <div class="col-2 offset-4 text-end">
                                    <button class="btn btn-warning" disabled><h5 class="text-danger"><i class="fa-solid fa-eye me-1 "></i>{{ $pizza->view_count }}</h5></button>
                                </div>
                            </div>

                        </div>

                        <form action="{{ route('product#updateData') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="pizzaId" value="{{ $pizza->id }}" hidden>
                            <div class="row">
                                <div class="col-4 offset-1 text-center">

                                        <img src="{{asset('storage/'.$pizza->image)}}"class="rounded shadow-sm" alt="John Doe" />

                                    <div class="form-group mt-1 text-start">
                                        <label for="control-label" class="">Image</label>
                                        <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror">
                                        @error('pizzaImage')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                    </div>
                                    <div class="">
                                        <button class="btn btn-outline-danger w-100 fw-bold" type="submit">Update<i class="mx-2 fa-solid fa-bolt"></i></button>
                                    </div>
                                </div>
                                <div class="col-6 ">

                                    <div class="form-group">
                                        <label  class="control-label mb-1">Name</label>
                                        <input  name="pizzaName" type="text" class="form-control @error('pizzaName') is-invalid @enderror" value="{{ old('pizzaName',$pizza->name) }}"  aria-required="true" aria-invalid="false" placeholder="Enter New Name...">
                                        @error('pizzaName')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Price</label>
                                        <input  name="pizzaPrice" type="number"  class="form-control @error('pizzaPrice') is-invalid @enderror" value="{{ old('pizzaPrice',$pizza->price) }}" aria-required="true" aria-invalid="false" placeholder="Enter New pizzaPrice...">
                                        @error('pizzaPrice')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Waiting Time</label>
                                        <input  name="pizzaWaitingTime" type="text"  class="form-control @error('pizzaWaitingTime') is-invalid @enderror" value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}" aria-required="true" aria-invalid="false" placeholder="Enter New pizzaWaitingTime...">
                                        @error('pizzaWaitingTime')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Category : </label>
                                        <select name="pizzaCategory" class="w-75" id="">
                                            @foreach ($category as $c)
                                                <option value="{{ $c->id }}" @if ($pizza->category_id == $c->id) selected @endif>{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label  class="control-label mb-1">Description</label>
                                <textarea  name="pizzaDescription" type="text"  class="form-control @error('pizzaDescription') is-invalid @enderror p-1" rows="5" aria-required="true" aria-invalid="false"  placeholder="Enter New pizzaDescription...">{{ old('pizzaDescription',$pizza->description) }}</textarea>
                                @error('pizzaDescription')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
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
