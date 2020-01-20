@extends('layouts.app')
@section('content')
<div class="content_01">
    <div class="card">
        <div class="card-header">{{ __('Information') }}</div>

        <div class="card-body">
            <p>Go to <a href="{{ route('home') }}">Home</a></p>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title">Card One</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem magni quas ex numquam, maxime minus quam molestias corporis quod, ea minima accusamus.</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary btn-sm">More Info</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
