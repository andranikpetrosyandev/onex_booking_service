@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Make {{$room->id}} Room Booking For {{Auth::user()->email}}
                </div>

                <div class="card-body">
                    @if (session()->has('error'))
                    <div class="alert alert-danger">{{ session()->get('error') }}</div>
                    @endif
                    
                    <form method="post" action="{{route('booking.store')}}">
                        @csrf
                        <input type="hidden" name="room_id" value="{{$room->id}}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                       
                        <div class="row">
                            <div class="col-md-6">
                            <label for="exampleInputEmail1">CheckIn Date</label>
                                <input name="checkin_date" value="{{request()->get('checkin_date')}}" id="checkInDate" class="form-control" type="date" />
                                @error('checkin_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">CheckOut Date</label>
                                <input name="checkout_date" value="{{request()->get('checkout_date')}}" id="checkOutDate" class="form-control" type="date" />
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