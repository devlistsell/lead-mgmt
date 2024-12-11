@extends('layout.wrapper')
@section('content')
<h1>Time Intervals</h1>
<button class="btn btn-primary" data-toggle="modal" data-target="#addTimeIntervalModal">Add Time Interval</button>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Weeks</th>
            <th>Enabled</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($timeIntervals as $timeInterval)
        <tr>
            <td>{{ $timeInterval->id }}</td>
            <td>{{ $timeInterval->name }}</td>
            <td>{{ $timeInterval->weeks }}</td>
            <td>{{ $timeInterval->enabled ? 'Yes' : 'No' }}</td>
            <td>
                <button class="btn btn-warning edit-btn" data-id="{{ $timeInterval->id }}" data-name="{{ $timeInterval->name }}" data-weeks="{{ $timeInterval->weeks }}" data-enabled="{{ $timeInterval->enabled }}" data-toggle="modal" data-target="#editTimeIntervalModal">Edit</button>
                <form action="{{ route('settings.time-intervals.destroy', $timeInterval->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Add Time Interval Modal -->
<div class="modal fade" id="addTimeIntervalModal" tabindex="-1" role="dialog" aria-labelledby="addTimeIntervalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTimeIntervalModalLabel">Add Time Interval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('settings.time-intervals.create') }}" method="POST">
                @csrf
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Time Interval Modal -->
<div class="modal fade" id="editTimeIntervalModal" tabindex="-1" role="dialog" aria-labelledby="editTimeIntervalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTimeIntervalModalLabel">Edit Time Interval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-name">Name</label>
                        <input type="text" id="edit-name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-weeks">Weeks</label>
                        <input type="number" id="edit-weeks" name="weeks" class="form-control" required min="1">
                    </div>
                    <div class="form-group">
                        <label for="edit-enabled">Enabled</label>
                        <select id="edit-enabled" name="enabled" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-btn');
        const editForm = document.getElementById('editForm');
        const editName = document.getElementById('edit-name');
        const editWeeks = document.getElementById('edit-weeks');
        const editEnabled = document.getElementById('edit-enabled');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const weeks = this.getAttribute('data-weeks');
                const enabled = this.getAttribute('data-enabled');

                editForm.action = `/settings/time-intervals/${id}`;
                editName.value = name;
                editWeeks.value = weeks;
                editEnabled.value = enabled;
            });
        });
    });
</script>
@endsection
