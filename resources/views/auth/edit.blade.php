@extends('layouts.app')

@section('content')
<div class="container ">
        <div class="row justify-content-center mt-3">
                <div class="card shadow col-lg-6 fw-bolder p-3">

                        <div class="card-body">
                                <form method="POST" action="{{ route('user.update', ['user' => $user]) }}" enctype="multipart/form-data" >
                                        @csrf
                                        @method('PUT') 
                                        <div class="form-group mb-3">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control py-2" id="name" name="name" value="{{ old('name') ?? $user->name }}" />
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="form-group  mb-3">
                                                <label for="email">Email address</label>
                                                <input type="email" class="form-control py-2" id="email" name="email" value="{{ old('email') ?? $user->email }}" />
                                                @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="form-group  mb-3">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control py-2" id="password" name="password" value="{{ old('password') }}">
                                                @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="form-group  mb-3">
                                                <label for="password_confirmation">Confirm Password</label>
                                                <input type="password" class="form-control py-2" id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation" />
                                                @error('password_confirmation')
                                                <span class=" text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="form-group  mb-3">
                                                <label class="form-label">Image</label>
                                                <input type="file" name="image" class="form-control py-2" value="{{ old('image') }}" />
                                                @error('name')
                                                <div style="color: red; font-weight: bold">{{ $message }}</div>
                                                @enderror
                                        </div>



                                        <button class="btn btn-primary" type="submit">
                                         Edit Profile
                                        </button>
                                </form>
                        </div>
                </div>
        </div>
        @endsection