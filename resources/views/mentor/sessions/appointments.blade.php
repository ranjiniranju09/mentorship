@extends('layouts.mentor')
@section('content')

<div class="container mt-4">

    {{-- Calendar Connection Status --}}
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

    {{-- Calendar Connect / Sync Buttons --}}
    <a href="{{ route('google.connect') }}" class="btn btn-primary mb-3" target="_blank">
        Connect Google Calendar
    </a>
    <a href="{{ route('google.sync') }}" class="btn btn-success mb-3">Sync Calendar Now</a>

    {{-- Success/Error Alerts --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Button to Open Slot Creation Modal --}}
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createSlotModal">
        + Create Mentorship Slots
    </button>

    {{-- Slots Table --}}
    <h2>Created Slots</h2>
    <div class="table-responsive mt-3">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Module Name</th>
                    <th>Description</th>
                    <th>Slot Time</th>
                    <th>Status</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($slots as $slot)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ optional($slot->module)->name ?? 'N/A' }}</td>
                        <td>{{ $slot->descriptions }}</td>
                        <td>{{ \Carbon\Carbon::parse($slot->slot_time)->format('d M Y, H:i A') }}</td>
                        <td class="text-center">
                            @if($slot->status === 'available')
                                <span class="badge bg-success text-white">Available</span>
                            @else
                                <span class="badge bg-info text-dark">{{ ucfirst($slot->status) }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-outline-primary btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editSlotModal{{ $slot->id }}"
                                    @if($slot->status !== 'available') disabled @endif>
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach($slots as $slot)
    <div class="modal fade" id="editSlotModal{{ $slot->id }}" tabindex="-1" aria-labelledby="editSlotModalLabel{{ $slot->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('mentor.slots.update', $slot->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSlotModalLabel{{ $slot->id }}">Edit Mentorship Slot</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <strong>Important:</strong> Once the slot is booked, editing is not allowed.
                        </div>

                        <div class="form-group mb-3">
                            <label>Module</label>
                            <select name="module_id" class="form-control" required>
                                @foreach($modules as $module)
                                    <option value="{{ $module->id }}" {{ $module->id == $slot->module_id ? 'selected' : '' }}>
                                        {{ $module->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>Session Description</label>
                            <textarea name="descriptions" class="form-control" required>{{ $slot->descriptions }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label>Slot Time</label>
                            <input type="datetime-local" name="slot_time" class="form-control" 
                                value="{{ \Carbon\Carbon::parse($slot->slot_time)->format('Y-m-d\TH:i') }}" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Slot</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach


    <h2 class="mt-5">Booked Slots</h2>
    <div class="table-responsive mt-3">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Module Name</th>
                    <th>Description</th>
                    <th>Slot Time</th>
                    <th>Status</th>
                    <th>Calendar Link</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookedSlots as $slot)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ optional($slot->module)->name ?? 'N/A' }}</td>
                        <td>{{ $slot->descriptions }}</td>
                        <td>{{ \Carbon\Carbon::parse($slot->slot_time)->format('d M Y, H:i A') }}</td>
                        <td>
                            <span class="badge bg-primary">Booked</span>
                        </td>
                        <td class="text-center">
                            @if($slot->calendar_link)
                                <a href="{{ $slot->calendar_link }}" target="_blank" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-link-45deg"></i> Join
                                </a>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h2 class="mt-5">Reschedule Requests</h2>
    <div class="table-responsive mt-3">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Mentee Name</th>
                    <th>Module</th>
                    <th>Reason</th>
                    <th>Requested Slot</th>
                    <th>Actions</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($rescheduleRequests as $request)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ optional($request->mentee)->name ?? 'N/A' }}</td>
                    <td>{{ optional(optional($request->session)->module)->name ?? 'N/A' }}</td>
                    <td>{{ $request->reason }}</td>
                    <td>{{ optional($request->session->slot_time) ? \Carbon\Carbon::parse($request->session->slot_time)->format('d M Y, H:i A') : 'N/A' }}</td>
                    <td>
                        <!-- Button to open reschedule modal -->
                        <button type="button" class="btn btn-success btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#rescheduleModal{{ $request->id }}"
                                @if($request->status != 'pending') disabled @endif>
                            Approve & Reschedule
                        </button>

                        <form action="{{ route('mentor.reschedule.reject', $request->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm"
                                    @if($request->status != 'pending') disabled @endif>
                                Reject
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal for this request -->
                <div class="modal fade" id="rescheduleModal{{ $request->id }}" tabindex="-1" aria-labelledby="rescheduleModalLabel{{ $request->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('mentor.reschedule.createSession', $request->id) }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rescheduleModalLabel{{ $request->id }}">
                                        Reschedule Session
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Mentee:</strong> {{ optional($request->mentee)->name ?? 'N/A' }}</p>
                                    <p><strong>Module:</strong> {{ optional(optional($request->session)->module)->name ?? 'N/A' }}</p>
                                    <p><strong>Original Slot:</strong>
                                        {{ optional($request->session->slot_time) ? \Carbon\Carbon::parse($request->session->slot_time)->format('d M Y, H:i A') : 'N/A' }}
                                    </p>

                                    <div class="form-group mb-3">
                                        <label>New Date & Time</label>
                                        <input type="datetime-local" name="new_slot_time" class="form-control" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Session Description</label>
                                        <textarea name="descriptions" class="form-control" required>{{ optional($request->session)->descriptions }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save Rescheduled Slot</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


{{-- Bootstrap Modal for Creating Slots --}}
<div class="modal fade" id="createSlotModal" tabindex="-1" aria-labelledby="createSlotModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('mentor.slots.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createSlotModalLabel">Create Mentorship Slots</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Module</label>
                        <select name="module_id" class="form-control" required>
                            <option value="">------Select Module------</option>
                            @foreach($modules as $module)
                                <option value="{{ $module->id }}">{{ $module->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Session Description</label>
                        <textarea name="descriptions" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Available Date & Time</label>
                        <div id="slot-container-modal">
                            <div class="slot-item mb-2">
                                <input type="datetime-local" name="slot_time[]" class="form-control" required>
                            </div>
                        </div>
                        <button type="button" id="add-slot-modal" class="btn btn-secondary mt-2">+ Add Another Slot</button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Slots</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>




@push('scripts')
<script>
document.getElementById('add-slot-modal').addEventListener('click', function() {
    let container = document.getElementById('slot-container-modal');
    let newField = document.createElement('div');
    newField.classList.add('slot-item', 'mb-2');
    newField.innerHTML = `<input type="datetime-local" name="slot_time[]" class="form-control" required>`;
    container.appendChild(newField);
});
</script>
@endpush

@endsection
