@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @foreach ( $room_types as $type)
                    <div class="card" style="width: 18rem; float:left; margin-left:5px">
                        <div class="card-body">
                            <h5 class="card-title">{{$type->name}}</h5>
                            <h6>{{$type->rooms_count}}</h3>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection