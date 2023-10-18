@extends('layouts.app')
@section('content')
    <div class="container d-flex align-items-center justify-content-center " >
        <div class="m-3 p-3 mt-5">
            <a href="{{ route('admin-users.create') }}" class="btn btn-success mx-2">Add New User</a>
      
            <table class="table table-light table-striped text-center  table-bordered my-4" style="width: 600px">
    <thead>
        <tr><th>Image</th> <th>Name</th> <th>Email</th> <th>Edit</th> <th>Delete</th></tr>
    </thead>
    <tbody>
            @foreach($users as $user)

<div class="container ">
  <a href="{{route('admin-users.create') }}" class="btn btn-success mt-3">Add New User</a>
    <div class="row justify-content-center fw-bolder">
    <div class="col mt-4">
        <table class="table">
            <thead>
                <tr class="table-secondary">
                    <th>Name</th>
                    <th>Image</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                     <td> {{$user->name}}</td>
                    <td> <img src="{{asset('images/users_images/'.$user->image)}}" width="50" height="60"></td>

                    <td> {{$user->email}}</td>

                    <td> <a href="{{ route('admin-users.edit', $user->id) }}" class="btn btn-warning"> Edit </a></td>
                    <td>
                        <form action="{{ route('admin-users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
   </div>
   <div class="d-flex pagination">
    {!! $users->links() !!}
     </div>
    </div>
   
        @endsection

