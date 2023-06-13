@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Ticket</h1>

    <form action="/tickets/{{ $ticket->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" value="{{ $ticket->ticket_subject }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5" required>{{ $ticket->ticket_description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ $status->id === $ticket->status_id ? 'selected' : '' }}>
                        {{ $status->status_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-select">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id === $ticket->category_id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $ticket->name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" class="form-control" id="surname" name="surname" value="{{ $ticket->surname }}" readonly>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $ticket->email }}" readonly>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $ticket->phone_number }}" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
