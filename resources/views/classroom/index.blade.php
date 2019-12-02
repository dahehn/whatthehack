@extends('layouts.app')
@section('content')
    <h2>All classrooms</h2>
    <body>

        @if(sizeof($classrooms) > 0)
            <table border="1">
                <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Owner</th>
                <th>Edit general information</th>
                <th>Add/delete members</th>
                <th>Add/delete challenges</th>
                </thead>
                <tbody>
                @foreach($classrooms as $classroom)
                    <tr>
                        <td>{{ $classroom->id }}</td>
                        <td>{{ $classroom->classroom_name }}</td>
                        <td>{{ $classroom->classroom_owner }}</td>
                        <td>
                            <a href="{{ route('classroom.edit', $classroom->id) }}" class="btn bg-light btn-outline-dark">Edit</a>
                             </td>
                        <td>
                            <a href="{{ route('', $classroom->id) }}" class="btn bg-light btn-outline-dark">Edit</a>
                        </td>
                        <td>
                            <a href="{{ route('', $classroom->id) }}" class="btn bg-light btn-outline-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h3>No classrooms yet!</h3>
        @endif
        <br>
        @if(Auth::user()->isTeacher(Auth::user()->userrole)==true || Auth::user()->isAdmin(Auth::user()->userrole)==true)
            <a href="{{route('classroom.create')}}" class="btn btn-success">Add new classroom</a>
        @endif

    </body>

@endsection
