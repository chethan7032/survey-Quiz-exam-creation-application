{{-- @extends('layouts.app')

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
@endsection --}}




@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">📃 Available Forms</h2>

    @if($forms->count())
        <div class="row">
            @foreach($forms as $form)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $form->title }}</h5>
                            <p class="card-text">{{ $form->description }}</p>
                            <a href="{{ route('user.form.view', $form->id) }}" class="btn btn-primary">📝 Fill Form</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">No forms published yet.</div>
    @endif
</div>
@endsection
