@extends('layouts.app')
@section('content')

    <div class="container d-flex align-items-center justify-content-center " >
        <div class="m-3 p-3 mt-5">
            <a href="{{ route('admins.create') }}" class="btn btn-success mx-2">Add New User</a>
      
            <table class="table table-light table-striped text-center  table-bordered my-4" style="width: 600px">
    <thead>
        <tr><th>Image</th> <th>Name</th> <th>Email</th> <th>Edit</th> <th>Delete</th></tr>
    </thead>
    <tbody>
            @foreach($users as $user)
                <tr>
                    <td> <img src="{{asset('images/users_images/'.$user->image)}}" width="70" height="70"></td>
                    <td> {{$user->name}}</td>
                     <td> {{$user->email}}</td> 

                    <td> <a href="{{ route('admins.edit', $user->id) }}" class="btn btn-warning"> Edit </a></td>
                    <td>
                        <form action="{{ route('admins.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit"   class="btn btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>


            @endforeach

        </tbody>
    </table>
 
@endsection