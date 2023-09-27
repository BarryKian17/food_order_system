@extends('admin.layouts.master')



@section('title','Category Page')

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
                            <h2 class="title-1">User List</h2>

                        </div>
                    </div>
                </div>
                @if (session('createSuccess'))
                <div class="col-6 offset-3">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session ('createSuccess') }}  <i class="fa-solid fa-circle-xmark ms-1"></i></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                @if (session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session ('deleteSuccess') }}  <i class="fa-sharp fa-solid fa-square-check"></i></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                @if (session('updateSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session ('updateSuccess') }}  <i class="fa-sharp fa-solid fa-square-check"></i></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

                <div class="row ">
                    <div class="col-3"><h4 class="text-danger">Search key: <span class="bg-danger text-warning p-1 rounded">{{ request('key') }}</span></h4></div>
                <div class="col-3 offset-9">
                    <form action="{{ route('admin#userList') }}" method="GET" class="d-flex border border-0 rounded-right">
                        @csrf
                        <input type="text" name="key" class="p-2" value="{{ request('key') }}">
                        <button class="btn btn-outline-danger  border-0" type="submit" title="Search">
                            <i class="fa-solid fa-magnifying-glass fs-5"></i>
                        </button>
                    </form>
                </div>
                </div>
                <div class="my-2">
                    <div class="col-3 bg-light shadow-sm py-2 px-3 text-center">
                       <h3>Total -  ({{ $userList->total() }})</h3>
                    </div>
                </div>
              @if (count($userList) != 0)
              <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th class="text-danger">Image</th>
                            <th class="text-danger"> ID</th>
                            <th class="text-danger"> Name</th>
                            <th class="text-danger">Email</th>
                            <th class="text-danger">Gender</th>
                            <th class="text-danger">Phone</th>

                            <th class="text-danger">Address</th>
                            <th class="text-danger">Role</th>
                         </tr>
                    </thead>
                    <tbody>
                       @foreach ($userList as $a)
                       <tr class="tr-shadow">
                        <td class="col-2">
                        @if ($a->image == null)
                            @if ($a->gender == 'female')
                            <img src="{{asset('img/girl.png')}}" class="rounded-circle" alt="John Doe" />
                            @else
                            <img src="{{asset('img/user.jpg')}}" class="rounded-circle" alt="John Doe" />
                            @endif

                        @else
                        <img src="{{asset('storage/'.$a->image)}}"class="rounded shadow-sm" alt="John Doe" />
                        @endif
                        </td>

                        <td class="col-1 userId">{{ $a->id }}</td>
                        <td class="col-2">{{ $a->name }}</td>
                        <td class="col-2">{{ $a->email }}</td>
                        <td class="col-1">{{ $a->gender }}</td>
                        <td class="col-2">{{ $a->phone }}</td>
                        <td class="col-2">{{ $a->address }}</td>

                        <td>
                            <select class="p-2 fw-bold statusChange" id="">
                                <option value="admin">Admin</option>
                                <option value="user" selected>User</option>
                            </select>
                        </td>
                        <td class="">
                            <div class="table-data-feature">
                                <a href="{{ route('admin#userDelete',$a->id)}}">
                                    <button class="btn btn-outline-danger rounded-circle" data-toggle="tooltip" data-placement="top" title="Delete" @if (Auth::user()->id == $a->id) hidden @endif >
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
                    {{ $userList->appends(request()->query())->links() }}
                </div>
            </div>
              @else
                 <H2>There is no User List!!</H2>
              @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection

@section('scriptSource')
    <script>
        $('document').ready(function(){

        //change status
        $('.statusChange').change(function(){
        $currentStatus = $(this).val();
        $parentNode = $(this).parents("tr");
        $userId = $parentNode.find('.userId').text();
        $data = {'userId' : $userId , 'role' : $currentStatus};
        console.log($data);
        $.ajax({
        type : 'get' ,
        url : '/user/ajax/role/change' ,
        dataType : 'json' ,

        data : $data

        })
        location.reload();

    })

})
    </script>
@endsection
