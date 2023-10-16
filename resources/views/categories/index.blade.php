@extends('layouts.app')
@section('content')
<div class="container d-flex align-items-center justify-content-center " >
    <div class="m-3 p-3 mt-5">
        <a href="{{ route('categories.create') }}" class="btn btn-success mx-2">Add New Category</a>
  
        <table class="table table-light table-striped text-center  table-bordered my-4" style="width: 600px">
            <thead >
                <tr >
                 
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                   
                        <td>{{ $category->name }}</td>
                        <td>
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
@endsection