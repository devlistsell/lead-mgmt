@extends('layouts.app')
@section('content')
<h1>Edit Time Interval</h1>
<form action="{{ route('settings.time-intervals.update', $timeInterval->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ $timeInterval->name }}" required>
    </div>
    <div class="form-group">
        <label for="weeks">Weeks</label>
        <input type="number" id="weeks" name="weeks" class="form-control" value="{{ $timeInterval->weeks }}" required min="1">
    </div>
    <div class="form-group">
        <label for="enabled">Enabled</label>
        <select id="enabled" name="enabled" class="form-control">
            <option value="1" {{ $timeInterval->enabled ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ !$timeInterval->enabled ? 'selected' : '' }}>No</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection
