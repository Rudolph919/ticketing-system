@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ticket Search Report Form</h1>

    <form action="{{ route('reports.search') }}" method="GET">
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" id="start_date" name="start_date" class="form-control">
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" id="end_date" name="end_date" class="form-control">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}">
                        {{ $status->status_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
                <label for="order_by" class="form-label">Order By</label>
                <select name="order_by" id="order_by" class="form-select">
                    <option value="date_logged" selected>Date Logged</option>
                    <option value="first_name">First Name</option>
                    <option value="last_name">Last Name</option>
                    <option value="ticket_status">Ticket Status</option>
                    <option value="category">Category</option>
                </select>
            </div>

        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    @isset($tickets)
        @if (!empty($tickets))
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ticket Number</th>
                        <th>Subject</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Date Created</th>
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No tickets found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {!! $tickets->withQueryString()->links('pagination::bootstrap-5') !!}
        @else
            <p>No tickets found.</p>
        @endif
    @else
        <p>No tickets found.</p>
    @endisset


</div>
@endsection


