@extends('admin.layouts.master')



@section('title','User Message Page')

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
                            <h2 class="title-1">User's Message</h2>

                        </div>
                    </div>

                </div>
                @if (session('delete'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session ('delete') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                <div class="row ">
                    <div class="col-3"><h4>Search key: <span class="text-danger">{{ request('key') }}</span></h4></div>
                <div class="col-3 offset-9">
                    <form action="{{ route('admin#contactPage') }}" method="GET" class="d-flex border border-0 rounded-right">
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
                       <h3>Total -  ({{ $message->total() }})</h3>
                    </div>
                </div>
              @if (count($message) != 0)
              <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th class="text-danger">User Name</th>
                            <th class="text-danger">User Email</th>

                            <th class="text-danger">User's Message</th>
                            <th class="text-danger">Date</th>
                         </tr>
                    </thead>
                    <tbody>
                       @foreach ($message as $m)
                       <tr class="tr-shadow">
                            <td class="col-2">{{ $m->name }}</td>
                            <td class="col-2">{{ $m->email }}</td>
                            <td class="col-5">{{ $m->message }}</td>
                            <td class="col-2">{{ $m->created_at->format('j-F-Y') }}</td>
                            <td>
                                <a href="{{ route('admin#contactDelete',$m->id) }}">
                                    <button class="btn btn-danger rounded">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </a>
                            </td>
                       </tr>
                       @endforeach

                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $message->appends(request()->query())->links() }}
                </div>
            </div>
              @else
                 <H2>There is no Message Here!!</H2>
              @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection
