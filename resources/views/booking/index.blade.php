@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Bookings
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th>User Email</th>
                                <th>Room Number</th>
                                <th>Room Type</th>
                                <th>CheckIn Date</th>
                                <th>CheckOut Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking )
                            <tr>
                                <th scope="row">{{$booking->id}}</th>
                                <td>{{$booking->user->email}}</td>
                                <td>
                                    #{{$booking->room->id}}
                                </td>
                                <td>
                                    {{$booking->room->type->name}}
                                </td>
                                <td>
                                    {{$booking->checkin_date}}
                                </td>
                                <td>
                                    {{$booking->checkout_date}}
                                </td>
                                <td>
                                <a  style="margin-right:5px"  class="btn btn-warning" href="{{route('booking.edit',$booking->id)}}">Edit</a>
                                <form style="display:inline-block" method="post" action="{{route('booking.destroy',$booking->id)}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger" type="submit">Remove</button>
                                    </form>
                            </td>
                            </tr>
                            @endforeach



                        </tbody>
                    </table>
                    <div style="float:right">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection