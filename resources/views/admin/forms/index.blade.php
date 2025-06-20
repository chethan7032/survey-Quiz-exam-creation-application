@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-primary">📚 All Forms</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover align-middle shadow-sm">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Status</th>
                <th>Created&nbsp;At</th>
                <th class="text-center" style="width:180px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forms as $i => $form)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $form->title }}</td>
                    <td>
                        <span class="badge {{ $form->status === 'published' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($form->status) }}
                        </span>
                    </td>
                    <td>{{ $form->created_at->format('d M Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.forms.preview',$form) }}" class="btn btn-sm btn-info">Preview</a>

                        <form action="{{ route('admin.forms.toggle',$form) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-warning">
                                {{ $form->status === 'published' ? 'Unpublish' : 'Publish' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.forms.destroy',$form) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this form?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @unless(count($forms))
                <tr><td colspan="5" class="text-center py-4">No forms created yet.</td></tr>
            @endunless
        </tbody>
    </table>
</div>
@endsection
