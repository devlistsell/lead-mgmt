@extends('layout.wrapper')
@section('content')
<h1>Create Time Interval</h1>
<form action="{{ route('settings.time-intervals.create') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="weeks">Weeks</label>
        <input type="number" id="weeks" name="weeks" class="form-control" required min="1">
    </div>
    <div class="form-group">
        <label for="enabled">Enabled</label>
        <select id="enabled" name="enabled" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection