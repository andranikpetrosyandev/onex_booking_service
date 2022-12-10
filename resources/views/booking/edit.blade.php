@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Update
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('booking.update', $booking->id)}}">
                        @csrf

                        <div class="row">
                            <input type="hidden" name="user_id" value="{{$booking->user_id}}">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">Room</label>

                                <select class="form-select" name="room_id" aria-label="Default select example">
                                    @foreach ($rooms as $room )
                                    @if($booking->room_id == $room->id)
                                    <option selected value="{{$room->id}}"> number {{$room->id}}</option>
                                    @else
                                    <option value="{{$room->id}}">number {{$room->id}}</option>
                                    @endif
                                    @endforeach
                                    @error('type_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">CheckIn Date</label>
                                <input name="checkin_date" id="checkInDate" value="{{$booking->checkin_date}}" class="form-control" type="date" />
                                @error('checkin_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">CheckOut Date</label>
                                <input name="checkout_date" value="{{$booking->checkout_date}}" id="checkOutDate" class="form-control" type="date" />
                                @error('checkout_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Reserve</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection