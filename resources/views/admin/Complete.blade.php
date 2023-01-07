@extends('admin.layouts.app')

@section('title')
Complete Order
@endsection

@php
    $page = 'Complete Order';
@endphp

@section('mainpart')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-align-center justify-content-between">
            <h4 class="mt-2 font-weight-bold text-primary">Complete Orders</h4>
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#CreateOrderModal">Create Order</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>SL</th>
                            <th>Order Date</th>
                            <th>Room No</th>
                            <th>Total Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($completes as $sl => $complete)
                            <tr>
                                <td>{{ ++$sl }}</td>
                                <td>{{ $complete->created_at->format('d/m/Y') }}</td>
                                <td>{{ $complete->name }}</td>
                                <td>{{ $complete->amount }}</td>
                                <td>
                                    <div class="d-flex align-middle justify-content-center">
                                        <button class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target="{{ '#Edit' . $complete->id .'CreateModal' }}"><i class="fas fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Order Details view Modal-->
                            <div class="modal fade" id="{{ 'Edit' . $complete->id .'CreateModal' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Room No - {{ $complete->name }} || Order:
                                                @if ($complete->status == '0')
                                                    Pending
                                                @elseif ($complete->status == '1')
                                                    Processing
                                                @else
                                                    Complete
                                                @endif
                                            </h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('complete.update', $complete->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="put">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="complete_description">Order Details</label>
                                                    <textarea readonly class="form-control @error('description') is-invalid @enderror" name="description" rows="5">{{ $complete->description }}</textarea>
                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert" >
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create order Modal-->
    <div class="modal fade" id="CreateOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Order</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('complete.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="complete_name">Room No</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="complete_description">Order Details</label>
                            <textarea class="form-control" name="description" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="complete_name">Amount</label>
                            <input type="text" class="form-control" name="amount">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</a>
                        <button class="btn btn-primary" type="submit">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
