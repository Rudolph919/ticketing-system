@extends('layouts.app')

@section('content')
<div class="container">
<h1>File Manipulation</h1>

<form method="POST" action="{{ route('file.upload') }}" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="file">Choose File:</label>
        <input type="file" id="file" name="file" accept=".csv, .txt, .xlsx">
    </div>

    <div>
        <label for="order">Select Order:</label>
        <select id="order" name="order">
            <option value="alphabetical">Alphabetical</option>
            <option value="length">String Length</option>
        </select>
    </div>

    <div>
        <button type="submit">Upload</button>
    </div>
</form>
</div>

@endsection
