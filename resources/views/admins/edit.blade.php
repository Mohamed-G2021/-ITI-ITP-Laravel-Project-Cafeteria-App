@extends('layouts.app')

@section('content')

<div class="container ">
    <div class="row justify-content-center">
        <div class="card shadow" style="width: 400px; height: 500px;">

            <div class="card-body m-3 p-4 mt-4">
                <form method="POST" action="{{ route('admin-users.update', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control py-2" id="name" name="name" placeholder="Name" value="{{ old('name') ?? $user->name }}" />
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control py-2 " id="email" name="email" placeholder="Email address" value="{{ old('email')  ?? $user->email  }}" />
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control py-2" id="password" name="password" placeholder="Password" value="{{$user->password}}" />
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control py-2" id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation" value="{{$user->password}}" />
                        @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control py-2" value="{{ old('image')  ?? $user->image }}" />
                        @error('image')
                        <div style="color: red; font-weight: bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        update
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endsection