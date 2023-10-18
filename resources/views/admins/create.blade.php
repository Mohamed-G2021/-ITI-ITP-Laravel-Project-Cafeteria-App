@extends('layouts.app')

@section('content')

<div class="container ">
    <div class="row justify-content-center">
        <div class="card" style="width: 400px; height: 500px;">

            <div class="card-body m-3 p-4 mt-4">
            <form method="POST" action="{{ route('admin-users.index') }}" enctype="multipart/form-data">
                @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}" />
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="{{ old('email') }}" />
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation" />
                        @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" value="{{ old('image') }}" />
                        @error('name')
                        <div style="color: red; font-weight: bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="d-flex align-items-center justify-content-center  text-center mt-4" type="submit" class="btn btn-primary btn-block mt-3" style="background-color: #17a2b8; border-color: #17a2b8">
                        Add
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endsection