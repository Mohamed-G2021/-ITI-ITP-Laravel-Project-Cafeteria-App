@extends('layouts.app')
@section('content')
<style>
      td{
    background-color:#a1625d !important;
    color:white;
   }
   .main{
    background-color:#823a35;
    height:100vh;
   }
</style>
<div class="main">
<div class="container">
    <h1 class="fw-bolder fs-1">All Branches</h1>
    <a href="{{ route('branches.create') }}" class="btn btn-warning p-2 mt-3">Add New Branch</a>
    <div class="row justify-content-center mt-3">
        <div class="col">
            <table class="table fw-bolder text-capitalize">
                <thead class="thead-light">
                    <tr class="table-secondary ">
                        <th>Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($branches as $branch)
                    <tr>

                        <td>{{ $branch->name }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-warning mx-1">Edit</a>
                                <form action="{{ route('branches.destroy', $branch->id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger mx-1">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection