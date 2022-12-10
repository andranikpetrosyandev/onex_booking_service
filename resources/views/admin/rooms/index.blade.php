@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Rooms') }}
                    <a class="btn btn-success" style="float:right" href="{{route('admin.rooms.create')}}">Add new Room</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Number</th>
                                <th>Type</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($rooms as $room )
                            <tr>
                                <th scope="row">{{$room->id}}</th>
                                <td>{{$room->type->name}}</td>
                                <td>
                                    <a  style="margin-right:5px"  class="btn btn-warning" href="{{route('admin.rooms.edit',$room->id)}}">Edit</a>
                                    <form style="display:inline-block" method="post" action="{{route('admin.rooms.destroy',$room->id)}}">
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
                   {{ $rooms->links() }}
                   </div>
                
            </div>
        </div>
    </div>
</div>
@endsection