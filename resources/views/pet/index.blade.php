@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pets list</h1>
        <a href="/pets/create">Create pet</a>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($pets as $pet)
                <tr>
                    <td>{{ $pet->id ?? '' }}</td>
                    <td>{{ $pet->name ?? '' }}</td>
                    <td>{{ $pet->status ?? '' }}</td>
                    <td style="display: flex">
                        <a href="{{ url('/pets/' . $pet->id) }}" class="btn btn-primary">Details</a>
                        <a href="{{ url('/pets/'. $pet->id) . '/edit' }}" class="btn btn-primary">Edit</a>
                        <form action="{{ url('/pets/' . $pet->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
