@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">📥 All Form Submissions</h2>

    <table class="table table-bordered table-hover bg-white">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Form Title</th>
                <th>User</th>
                <th>Submitted At</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($submissions as $submission)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $submission->form->title ?? 'Deleted Form' }}</td>
                    <td>{{ $submission->user->name ?? 'Guest' }}</td>
                    <td>{{ $submission->submitted_at }}</td>
                    <td>
                        <pre class="bg-light p-2 rounded small">{{ json_encode($submission->form_data, JSON_PRETTY_PRINT) }}</pre>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No submissions yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
