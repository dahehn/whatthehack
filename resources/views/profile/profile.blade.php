@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header font-weight-bold">{{ __('My Profile') }}</div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right font-weight-bold">
                                {{ __('Username:') }}
                            </label>
                            <label class="col-md-4 col-form-label text-md-center">{{ $user->username }}</label>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right font-weight-bold">
                                {{ __('E-Mail:') }}
                            </label>
                            <label class="col-md-4 col-form-label text-md-center">{{ $user->email }}</label>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right font-weight-bold">
                                {{ __('Userrole:') }}
                            </label>
                            <label class="col-md-4 col-form-label text-md-center">{{ $user->userrole }}</label>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right font-weight-bold">
                                {{ __('Points:') }}
                            </label>
                            <label class="col-md-4 col-form-label text-md-center">0</label>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-sm text-md-center">
                                    <a href="{{ route('profile.showChangePWForm') }}" class="btn bg-light btn-outline-dark">Change Password</a>
                                </div>
                                <div class="col-sm text-md-center">
                                    <a href="{{ route('profile.showChangeEMForm') }}" class="btn bg-light btn-outline-dark">Change E-Mail</a>
                                </div>
                                <form method="POST" action="{{ route('profile.delete', $user->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn bg-danger btn-outline-dark" onclick="return confirm('Do you really want to delete your user account?')">Delete Account</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection