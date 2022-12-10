@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Create Rooms') }}
                </div>

                <div class="card-body">


                    <form method="post" action="{{route('admin.rooms.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Room Type</label>
                            <select class="form-select" name="room_type_id" aria-label="Default select example">
                                <option selected>Select Room Type Please</option>
                                @foreach ($roomTypes as $type )
                                <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                                @error('type_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection