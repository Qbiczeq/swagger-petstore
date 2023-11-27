@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add pet</h1>
        <form method="POST" action="{{ url('/pets') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="available">Available</option>
                    <option value="pending">Pending</option>
                    <option value="sold">Sold</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add pet</button>
        </form>
    </div>
@endsection
