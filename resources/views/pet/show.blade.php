@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pet details</h1>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ $pet->name ?? '' }}</h2>
                <p class="card-text"><strong>ID:</strong> {{ $pet->id }}</p>
                <p class="card-text"><strong>Status:</strong> {{ $pet->status }}</p>
                <p class="card-text"><strong>Category:</strong> {{ $pet->category->name ?? '---' }}</p>
                <p class="card-text"><strong>Tags:</strong>
                    @if(isset($pet->tags) && is_array($pet->tags))
                        @foreach($pet->tags as $tag)
                            <span class="badge badge-secondary">{{ $tag->name }}</span>
                        @endforeach
                    @else
                        ---
                    @endif
                </p>
            </div>
        </div>
        <a href="{{ url('/pets') }}" class="btn btn-primary mt-3">Go back</a>
    </div>
@endsection
