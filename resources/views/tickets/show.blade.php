@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ticket Details</h1>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="card-title">{{ $ticket->ticket_subject }}</h5>
                    <p class="card-text"><strong>Status:</strong> {{ $ticket->ticketStatus->status_name }}</p>
                </div>

                <p class="card-text">{{ $ticket->ticket_description }}</p>
                <p class="card-text"><strong>Category:</strong> {{ $ticket->ticketCategory->category_name }}</p>
                <p class="card-text"><strong>Name:</strong> {{ $ticket->name }}</p>
                <p class="card-text"><strong>Surname:</strong> {{ $ticket->surname }}</p>
                <p class="card-text"><strong>Email:</strong> {{ $ticket->email }}</p>
                <p class="card-text"><strong>Phone:</strong> {{ $ticket->phone_number }}</p>
                <p class="card-text"><strong>Created At:</strong> {{ $ticket->created_at }}</p>
                <p class="card-text"><strong>Last updated:</strong> {{ $ticket->updated_at }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('tickets.index') }}" class="btn btn-primary">Back to Tickets</a>
        </div>
    </div>
@endsection
