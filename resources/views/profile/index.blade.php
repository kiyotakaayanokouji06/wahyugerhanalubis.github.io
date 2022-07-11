@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class= "col-md-12">
            <a href="{{ url('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"> Kembali </i></a>
        </div>
        <div class="col-md-12 mt-2" >
            <nav aria-label="breadcrumb">
            	<ol class="breadcrumb">
                  	<li class="breadcrumb-item"><a href="{{ ('home') }}">Home</a></li>
               		 <li class="breadcrumb-item active" aria-current="page">Profile</li>
            	 </ol>
            </nav>
        </div>
		<div class="card">
            <div class="col-md-12" >
                <div class="card-body">
                    <h4><i class="fa fa-user"></i>My Profile</h4>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Nama</td>
                                <td width="10">;</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>;</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td>;</td>
                                <td>{{ $user->nohp }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>;</td>
                                <td>{{ $user->alamat }}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <h4><i class="fa fa-pencil-alt"></i>Edit Profile</h4>
                        <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="NOHP" class="col-md-4 col-form-label text-md-end">{{ __('NOHP') }}</label>

                            <div class="col-md-6">
                                <input id="NOHP" type="text" class="form-control @error('NOHP') is-invalid @enderror" name="NOHP" value="{{ old('NOHP') }}" required autocomplete="NOHP" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="alamat" class="col-md-4 col-form-label text-md-end"> {{ __('alamat') }}</label>

                            <div class="col-md-6">
                                <textarea name="alamat" class="form-control"></textarea>   
                            <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" autofocus>

                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    </div> 
		        </div>
</div>

   	</div>
</div>
@endsection