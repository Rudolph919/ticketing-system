@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Tickets</h1>
        <a href="{{ route('tickets.create') }}" class="btn btn-primary">Create Ticket</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ticket Number</th>
                <th>Subject</th>
                <th>Category</th>
                <th>Status</th>
                <th>Name</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->ticket_number}}</td>
                    <td>{{ $ticket->ticket_subject }}</td>
                    <td>{{ $ticket->ticketCategory->category_name }}</td>
                    <td>{{ $ticket->ticketStatus->status_name }}</td>
                    <td>{{ $ticket->name }} {{ $ticket->surname }}</td>
                    <td>{{ date('Y-m-d', strtotime($ticket->created_at)) }}</td>
                    <td>
                        <div style="width: max-content;">
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-primary">View</a>
                        @can('edit-ticket')
                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-success">Edit</a>
                        @endcan

                        @can('delete-ticket')
                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this ticket?')">Delete</button>
                            </form>
                        @endcan
                        </div>



                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No tickets found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {!! $tickets->withQueryString()->links('pagination::bootstrap-5') !!}

    <!-- <div class="d-flex justify-content-center">
        {{ $tickets->links() }}
    </div> -->
</div>
@endsection
