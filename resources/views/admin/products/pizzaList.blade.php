@extends('admin.layouts.master')



@section('title','Product List Page')

@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Products List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('product#createPage')}}">
                            <button class="btn btn-warning text-white">
                                <i class="fa-solid fa-plus"></i>Add Product
                            </button>
                        </a>
                        <button class="btn btn-warning text-white">
                            CSV download
                        </button>
                    </div>
                </div>
                @if (session('createSuccess'))
                <div class="col-5 offset-7">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session ('createSuccess') }}  <i class="fa-sharp fa-solid fa-square-check"></i></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                @if (session('deleteSuccess'))
                <div class="col-5 offset-7">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session ('deleteSuccess') }}  <i class="fa-sharp fa-solid fa-square-check"></i></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                @if (session('updateSuccess'))
                <div class="col-5 offset-7">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session ('updateSuccess') }}  <i class="fa-sharp fa-solid fa-square-check"></i></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

                <div class="row ">
                    <div class="col-3"><h4>Search key: <span class="text-danger">{{ request('key') }}</span></h4></div>
                <div class="col-3 offset-9">
                    <form action="{{ route('product#list') }}" method="GET" class="d-flex border border-0 rounded-right">
                        @csrf
                        <input type="text" name="key" class="p-2" value="{{ request('key') }}">
                        <button class="btn btn-outline-danger border-0" type="submit" title="Search">
                            <i class="fa-solid fa-magnifying-glass fs-5"></i>
                        </button>
                    </form>
                </div>
                </div>
                <div class="my-2">
                    <div class="col-3 bg-light shadow-sm py-2 px-3 text-center">
                       <h3>Total - ({{ $pizzas->total() }}) </h3>
                    </div>
                </div>

             @if (count($pizzas) != 0)
             <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>

                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>View Count</th>
                            <th></th>

                         </tr>
                    </thead>
                    <tbody>
                        @foreach ($pizzas as $p)
                        <tr class="tr-shadow">

                            <td class="col-2"><img src="{{asset('storage/'.$p->image )}}" class="shadow-sm img-thumbnail"></td>
                            <td class="col-4">{{$p->name }}</td>
                            <td class="col-2">{{ $p->price }}</td>
                            <td class="col-2">{{ $p->category_name}}</td>
                            <td class="col-2">{{ $p->view_count}} <i class="fa-solid fa-eye"></i></td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="{{ route('product#detail',$p->id) }}">
                                        <button class="mx-1 btn btn-outline-danger rounded-circle" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('product#update',$p->id) }}">
                                        <button class="mx-1 btn btn-outline-danger rounded-circle" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('product#delete',$p->id) }}">
                                        <button class="btn btn-outline-danger rounded-circle" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
                               </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $pizzas->links() }}
                </div>
            </div>
             @else
             <H2>There is no Product Here!!</H2>
             @endif

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection
