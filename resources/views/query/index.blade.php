@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Query Management</h1>

    <div>
        <a href="{{ route('query.animal-lovers') }}" class="btn btn-primary">Animal Lovers with 1 Document</a>
        <a href="{{ route('query.children-sport-lovers') }}" class="btn btn-primary">Children & Sport Lovers</a>
        <a href="{{ route('query.unique-interests-without-documents') }}" class="btn btn-primary">Unique Interests without Documents</a>
        <a href="{{ route('query.people-with-multiple-documents') }}" class="btn btn-primary">People with Multiple Documents</a>
    </div>

    @isset($query)
        @if (!empty($query))
            <h1>Query Result</h1>
            <ul>
                @foreach ($query as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        @else
            <p>No results found.</p>
        @endif
    @else
        <p>No results found.</p>
    @endisset


</div>
@endsection
