@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Query Management</h1>

    <div class="pb-4">
        <a href="{{ route('query.animal-lovers') }}" class="btn btn-primary">Animal Lovers with 1 Document</a>
        <a href="{{ route('query.children-sport-lovers') }}" class="btn btn-primary">Children & Sport Lovers</a>
        <a href="{{ route('query.unique-interests-without-documents') }}" class="btn btn-primary">Unique Interests without Documents</a>
        <a href="{{ route('query.people-with-multiple-documents') }}" class="btn btn-primary">People with Multiple Documents</a>
    </div>

    @isset($query)
        @if (!empty($query))
            <h1>Query Result</h1>
            <h5>{{ $filter }}</h5>

            <table class="table table-striped">
                <thead>
                    <tr>
                        @if (empty($interestCount))
                            <th>#</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Date Of Birth</th>
                        @else
                            <th>Name</th>
                            <th>Count</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @if (empty($interestCount))
                    @foreach ($query as $detail)
                        <tr>
                            <td>{{ $detail->id}}</td>
                            <td>{{ $detail->name }}</td>
                            <td>{{ $detail->surname}}</td>
                            <td>{{ date('Y-m-d', strtotime($detail->date_of_birth)) }}</td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($query as $detail)
                        <tr>
                            <td>{{ $detail->name }}</td>
                            <td>{{ $detail->count}}</td>
                        </tr>
                    @endforeach
                @endif

                </tbody>
            </table>

            {!! $query->withQueryString()->links('pagination::bootstrap-5') !!}
        @else
            <p>No results found.</p>
        @endif
    @else
        <p>No results found.</p>
    @endisset


</div>
@endsection
