@extends('layouts.mentor')
@section('content')

<div class="container mt-4">

    {{-- Display Connection Status --}}
    @php
        $mentor = Auth::user()->mentor;
        $isConnected = $mentor && $mentor->google_access_token && now()->lt($mentor->google_token_expires);
    @endphp

    <div class="mb-3">
        @if($isConnected)
            <span class="badge bg-success">
                <i class="bi bi-calendar-check-fill"></i> Calendar Connected
            </span>
        @else
            <span class="badge bg-danger">
                <i class="bi bi-calendar-x-fill"></i> Calendar Disconnected
            </span>
        @endif
    </div>

    {{-- Slot Creation Form --}}
    <h1>Create Mentorship Slots</h1>
    <form action="{{ route('mentor.slots.store') }}" method="POST">
        @csrf

        <div>
            <label>Module</label>
            <select name="module_id" class="form-control" required>
                @foreach($modules as $module)
                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Session Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label>Available Date & Time</label>
            <div id="slot-container">
                <div class="slot-item mb-2">
                    <input type="datetime-local" name="slot_time[]" class="form-control" required>
                </div>
            </div>
            <button type="button" id="add-slot" class="btn btn-secondary mt-2">+ Add Another Slot</button>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Slots</button>
    </form>

    {{-- Created Slots Table --}}
    <h2 class="mt-5">Created Slots</h2>
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Module Name</th>
                    <th>Description</th>
                    <th>Slot Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($slots as $slot)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $slot->module_name }}</td>
                        <td>{{ $slot->description }}</td>
                        <td>{{ \Carbon\Carbon::parse($slot->slot_time)->format('Y-m-d H:i') }}</td>
                        <td>{{ ucfirst($slot->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('add-slot').addEventListener('click', function() {
    let container = document.getElementById('slot-container');
    let newField = document.createElement('div');
    newField.classList.add('slot-item', 'mb-2');
    newField.innerHTML = `<input type="datetime-local" name="slot_time[]" class="form-control" required>`;
    container.appendChild(newField);
});
</script>
@endpush

@endsection
