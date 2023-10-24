@extends('layouts.app')
@section('content')
<style>
    .main{
        background-color:#823a35;
        color:white;
    }
    td{
        background-color:#a1625d;
        padding:10px;
    }

    .row{
    background-color:#a1625d !important;

}
</style>        
<div class="container d-flex flex-column min-vh-100">
    <div>
    <a href="{{route('admin-users.create') }}" class="mb-4 btn btn-warning mt-3 ">Add New User</a>
    </div>
    <div class="row justify-content-center fw-bolder ">
        <div class="col mt-4">
            <table class="table-dark table-striped table-hover m-5 ">
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
                        @if(str_contains( $user->image, 'https'))
                        <td><img src="{{ asset("$user->image") }}" width="50" height="60"> </td>
                        @else
                        <td> <img src="{{asset('images/'.$user->image)}}" width="50" height="60"></td>
                        @endif
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

    </div>
    <div class="text-center p-4 text-white mt-auto" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2023 Copyright:
    <a class="text-reset fw-bold" href="#">Cafeteria.com</a>
  </div>


    @endsection