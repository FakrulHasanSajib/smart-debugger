@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Smart Debugger Dashboard</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>File</th>
                <th>Line</th>
                <th>Error Message</th>
                <th>Solution (Bangla AI)</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($errors as $error)
                <tr>
                    <td>{{ $error->file }}</td>
                    <td>{{ $error->line }}</td>
                    <td>{{ $error->message }}</td>
                    <td>{{ $error->solution ?? 'No solution yet' }}</td>
                    <td>{{ $error->created_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">কোনো এরর পাওয়া যায়নি।</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
