@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow">
                <div class="card-header bg-primary text-white fw-bold">
                    🧱 Drag & Drop Form Builder
                </div>
                <div class="card-body bg-light">
                    <form id="formBuilderForm" method="POST" action="{{ route('admin.forms.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Form Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description (optional)</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>

                        <input type="hidden" name="schema" id="formSchemaInput">

                        <div class="mb-4 bg-white p-3 rounded" id="builder" style="min-height: 500px;"></div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4 py-2">💾 Save Form</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/formiojs@latest/dist/formio.full.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/formiojs@latest/dist/formio.full.min.js"></script>
<script>
    let builder;
    Formio.builder(document.getElementById('builder'), {}).then(instance => {
        builder = instance;
    });

    document.getElementById('formBuilderForm').addEventListener('submit', function (e) {
        const schema = builder.schema;
        document.getElementById('formSchemaInput').value = JSON.stringify(schema);
    });
</script>
@endpush
