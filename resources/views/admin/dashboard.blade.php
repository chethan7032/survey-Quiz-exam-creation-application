@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow border-0">
        <div class="card-body text-center">
            <h2 class="text-primary fw-bold">👑 Admin Dashboard</h2>
            <p class="mt-3">Welcome, {{ Auth::user()->name }}!</p>
            <p class="text-muted">Here you can build and manage forms, view submissions, and publish them for users.</p>
            <a href="#" class="btn btn-warning mt-3">🛠️ Create New Form</a>
        </div>
    </div>
</div>
@endsection
