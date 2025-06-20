@extends('layouts.app')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/formiojs@latest/dist/formio.full.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container py-5">
    <h3 class="mb-3">{{ $form->title }} <small class="badge bg-info">{{ $form->status }}</small></h3>
    <p>{{ $form->description }}</p>
    <div id="formPreview" class="bg-light p-3 rounded shadow"></div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/formiojs@latest/dist/formio.full.min.js"></script>
<script>
    Formio.createForm(document.getElementById('formPreview'), {!! json_encode($form->schema) !!}, { readOnly: true });
</script>
@endpush
