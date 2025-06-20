@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow border-0">
        <div class="card-body text-center">
            <h2 class="text-success fw-bold">📝 Available Forms</h2>
            <p class="mt-3">Welcome, {{ Auth::user()->name }}!</p>
            <p class="text-muted">Browse and fill forms published by admin. Your submissions will be saved securely.</p>
            <a href="#" class="btn btn-primary mt-3">📄 View Forms</a>
        </div>
    </div>
</div>
@endsection
