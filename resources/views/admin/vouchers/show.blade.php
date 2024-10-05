<!-- resources/views/admin/comments/show.blade.php -->

@extends('layouts.backend')

@section('content')
    <h1>Comment Details</h1>

    <p><strong>ID:</strong> {{ $comment->id }}</p>
    <p><strong>Author:</strong> {{ $comment->author }}</p>
    <p><strong>Comment:</strong> {{ $comment->body }}</p>
    <p><strong>Created At:</strong> {{ $comment->created_at }}</p>

    <a href="{{ route('admin.comments.index') }}">Back to Comments List</a>
@endsection
