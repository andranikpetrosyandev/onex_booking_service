@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Room Type') }}
                    <a class="btn btn-success" style="float:right" href="{{route('admin.roomtype.create')}}">Add new Room Type</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($room_types as $type )
                            <tr>
                                <th scope="row">{{$type->id}}</th>
                                <td>{{$type->name}}</td>
                                <td>{{$type->description}}</td>
                                <td>
                                    <a style="margin-right:5px" class="btn btn-warning" href="{{route('admin.roomtype.edit',$type->id)}}">Edit</a>
                                    <form  style="display:inline-block"method="post" action="{{route('admin.roomtype.destroy',$type->id)}}">
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
                   {{ $room_types->links() }}
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection