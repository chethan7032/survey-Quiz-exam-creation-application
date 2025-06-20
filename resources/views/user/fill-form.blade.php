@extends('layouts.app')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/formiojs@latest/dist/formio.full.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container py-5">
    <h2 class="mb-4">📝 {{ $form->title }}</h2>
    <div id="formRenderer" class="bg-light p-4 rounded shadow-sm"></div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/formiojs@latest/dist/formio.full.min.js"></script>
<script>
    const formSchema = @json($form->schema);

    Formio.createForm(document.getElementById('formRenderer'), formSchema)
        .then(form => {
            form.on('submit', (submission) => {
                fetch('{{ route("user.form.submit", $form->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ form_data: submission.data })
                })
                .then(res => res.json())
                .then(res => {
                    alert("✅ Form submitted successfully!");
                    window.location.href = '{{ route("user.forms") }}';
                })
                .catch(err => alert("❌ Submission failed"));
            });
        });
</script>
@endpush
