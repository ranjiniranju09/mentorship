@extends('layouts.new_mentee')

@section('content')
<div class="container mt-4"></div>

    <h1>Available Mentorship Slots</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Available Slots Table --}}
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Module</th>
                    <th>Description</th>
                    <th>Slot Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($slots as $slot)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ optional($slot->module)->name ?? 'N/A' }}</td>
                        <td>{{ $slot->descriptions }}</td>
                        <td>{{ \Carbon\Carbon::parse($slot->slot_time)->format('Y-m-d H:i') }}</td>
                        <td>
                            <form action="{{ route('mentee.slots.book', $slot->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Book Slot</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    {{-- Booked Slots Table --}}
    <h2 class="mt-5">My Booked Slots</h2>
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Module</th>
                    <th>Description</th>
                    <th>Slot Time</th>
                    <th>Status</th>
                    <th>Calendar Link</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookedSlots as $slot)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ optional($slot->module)->name ?? 'N/A' }}</td>
                        <td>{{ $slot->descriptions }}</td>
                        <td>{{ \Carbon\Carbon::parse($slot->slot_time)->format('Y-m-d H:i') }}</td>
                        <td>{{ ucfirst($slot->status) }}</td>
                        <td>
                            @if($slot->calendar_link)
                                <a href="{{ $slot->calendar_link }}" target="_blank">Join Session</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if(\Carbon\Carbon::parse($slot->slot_time)->isPast())
                                <!-- Show button only if session is over -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#rescheduleRequestModal{{ $slot->id }}">
                                    <i class="bi bi-pencil-square"></i> Request Reschedule
                                </button>
                            @else
                                <span class="text-muted">Not Eligible</span>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal for Reschedule Request -->
                    <div class="modal fade" id="rescheduleRequestModal{{ $slot->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('mentee.reschedule.request', $slot->id) }}" method="POST" onsubmit="disableButton(this)">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Reschedule Request</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label>Reason for Rescheduling:</label>
                                        <textarea name="reason" class="form-control" required></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary submit-btn">Send Request</button>
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

@push('scripts')
<script>
function disableButton(form) {
    const btn = form.querySelector('.submit-btn');
    btn.disabled = true;
    btn.innerText = 'Sending...'; // Optional: show feedback
}
</script>
@endpush

@endsection

