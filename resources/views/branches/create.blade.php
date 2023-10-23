@extends('layouts.app')
@section('content')
<style>
  
   .main{
    background-color:#823a35;
    height: 100vh;
    
   }
</style>
<div class="main">
<div class="container d-flex align-items-center justify-content-center mt-5">


    <div class="card p-4 m-5" style="width: 500px;">
        <div class="card-body">
            <h1 class="card-title text center">Create New Branch</h1>



            <form method="post" action="{{route('branches.store')}}">
                @csrf
        </div>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>

        <div>
            @error('name')
            <div style="color:red; font-weight:bold">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-warning mb-3" style="width: 200px;">Submit</button>
        </div>

        </form>
    </div>
</div>
</div>
</div>
@endsection