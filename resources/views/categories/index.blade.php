@extends('layouts.app')
@section('content')
<div class="container" >
    <h1 class="fw-bolder fs-1">All Categories</h1>
<a href="{{ route('categories.create') }}" class="btn btn-success p-2 mt-3">Add New Category</a>
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
                @foreach($categories as $category)
                    <tr>
                   
                        <td>{{ $category->name }}</td>
                        <td  class="text-center">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info mx-1">Show</a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning mx-1">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="post" style="display: inline;">
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
@endsection