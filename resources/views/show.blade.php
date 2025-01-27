@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Task Details</h1>

    <table class="table">
        <tr>
            <th>Title</th>
            <td>{{ $task->title }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $task->description }}</td>
        </tr>
        <tr>
            <th>Due Date</th>
            <td>{{ $task->due_date->format('Y-m-d') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $task->status }}</td>
        </tr>
        <tr>
            <th>Priority</th>
            <td>{{ $task->priority }}</td>
        </tr>
    </table>

    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit Task</a>
    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this task?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete Task</button>
    </form>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Task List</a>
</div>
@endsection
