@extends('layouts.app')
@section('content')
<h2>Add a new challenge</h2>
<form method="post" action="{{ route('challenges.store') }}" id="challengeform">
@csrf
    <p>
        <strong>Challenge name:</strong>
        <input type="text" name="name">
    </p>
    <p>
        <strong>Challenge description:</strong>
        <br>
        <textarea form="challengeform" name="description"></textarea>
    </p>
    <p>
        <strong>Difficulty:</strong>
        <select name="difficulty">
            <option value="easy" selected="selected">Easy</option>
            <option value="medium">Medium</option>
            <option value="hard">Hard</option>
        </select>
    </p>
    <p>
        <strong>Author:</strong>
        @if(Auth::user()->hasRole("admin"))<input type="text" name="author" value="{{ Auth::user()->username }}">
        @else
            {{ Auth::user()->username }}
        @endif
    </p>
    <p>
        <strong>Status:</strong>
        <select name="active">
            <option value="true" selected="selected">Enabled</option>
            <option value="false">Disabled</option>
        </select>
    </p>
    <p>
        <strong>Feasible solution (optional):</strong>
        <br>
        <textarea form="challengeform" name="targetSolution"></textarea>
    </p>
    <p>
        <strong>Docker Image ID (optional):</strong>
        <input type="text" name="imageID">
    </p>
    <p>
        <?php //TODO:Implement file upload ?>
        <strong>Attachments (optional):</strong>
            <input type="text" name="attachments">
    </p>
    <p>
        <button type="submit" class="btn btn-success">Submit</button>
        <a href="{{ route('challenges.index') }} " class="btn btn-danger">Cancel</a>
    </p>
</form>
@if(isset($errors) && sizeof($errors) != 0)
    @if(sizeof($errors) > 1)
        <h4>Errors occurred:</h4>
    @else
        <h4>Error occurred:</h4>
    @endif
    <p>
    @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
        </p>
        @endif
@endsection
