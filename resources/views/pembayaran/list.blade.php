@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Keuangan</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Keuangan</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive m-t-10">
                    <table
                        id="myTable"
                        class="table table-bordered table-striped"
                    >
                        <thead>
                            <tr>
                                <th>Nama Customer</th>
                                <th>Paket Booking</th>
                                <th>Pembayaran</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookingList as $booking)
                            <tr>
                                <td>{{ $booking->customer->name }}</td>
                                <td>{{ $booking->bookingPackage->name }}</td>
                                <td>{{ $booking->payment }}</td>
                                @if ($booking->bookingPackage->price <= $booking->payment) 
                                <td>LUNAS</td>
                                @else
                                <td> Kurang: Rp. {{ $booking->bookingPackage->price - $booking->payment }} </td>
                                @endif
                                <td>
                                    <form
                                        action="{{ route('booking.destroy',$booking->id) }}"
                                        method="POST"
                                    >
                                        <a
                                            class="btn btn-success"
                                            href="{{ Route('booking.show',$booking->id) }}"
                                            >Detail</a
                                        >
                                        {{-- <a
                                            class="btn btn-info"
                                            href="{{ Route('booking.edit',$booking->id) }}"
                                            >Edit</a
                                        >

                                        @csrf @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger"
                                        >
                                            Delete
                                        </button> --}}
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <p>No Customer</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection