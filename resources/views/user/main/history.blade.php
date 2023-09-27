@extends('user.layouts.master')

@section('title','User Cart History')

@section('content')
<button class="btn btn-warning my-3 m-4 mx-5 px-3" onclick="history.back()"><i class="fa-sharp fa-solid fa-arrow-left mx-2"></i>
    Back
</button>
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="table-dark">
                        <tr>

                            <th>Date</th>
                            <th>Order Code</th>
                            <th>Total</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody class="align-middle">
                      @foreach ($order as $o)
                      <tr>
                        <td class="">{{ $o->created_at->format('j-F-Y') }}</td>

                        <td class="">{{ $o->order_code }}</td>

                        <td class="">{{ $o->total_price }}</td>

                        <td>
                            @if ($o->status == 0)
                                <span class="text-warning fw-bold">Pending <i class="fa-solid fa-hourglass-half ms-1"></i></span>
                            @elseif ( $o->status == 1)
                                <span class="text-success fw-bold">Success <i class="fa-solid fa-circle-check ms-1"></i></span>
                            @else
                                <span class="text-danger fw-bold">Reject<i class="fa-solid fa-triangle-exclamation ms-2"></i></span>
                            @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
                <div class="my-3">
                    {{ $order->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    @endsection


