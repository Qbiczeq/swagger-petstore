@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit pet</h1>

        <form action="{{ url('/pets/' . $pet->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $pet->name }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status">
                    <option value="available" {{ $pet->status == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="pending" {{ $pet->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="sold" {{ $pet->status == 'sold' ? 'selected' : '' }}>Sold</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save changes</button>
            <a href="{{ url('/pets') }}" class="btn btn-primary">Go back</a>

        </form>
    </div>
@endsection
