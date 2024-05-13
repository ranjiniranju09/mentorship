<!-- resources/views/raise-ticket.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    /* Custom styles for achieving desired layout */
    .sidebar {
      position: fixed; /* Fixed position to ensure full height */
      top: 0; /* Align to the top of the viewport */
      bottom: 0; /* Align to the bottom of the viewport */
      left: 0; /* Align to the left of the viewport */
      width: 280px; /* Fixed width */
      background-color: #343a40; /* Dark background color */
      overflow-y: auto; /* Enable vertical scrolling if content exceeds height */
    }
    .nav-link {
      color: #fff; /* White text color for navbar links */
    }
    .dropdown-item {
      color: #212529; /* Dark text color for dropdown items */
    }
    .dropdown-item:hover {
      background-color: #f8f9fa; /* Light background color on hover for dropdown items */
    }
    h2 {
      color: #212529; /* Dark text color for headings */
      margin-top: 20px; /* Add some space at the top */
    }
    .card {
      border: none; /* Remove border from the cards */
      height: 200px;
      text-align: center;
      border-radius: 15px; /* Rounded corners for the cards */
      background-color: #f8f9fa; /*Light gray background color*/
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add shadow to the cards */
      transition: all 0.3s ease; /* Smooth transition for hover effect */
    }
    .card:hover {
      transform: translateY(-5px); /* Move the card up slightly on hover */
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Add a stronger shadow on hover */
    }
    .card-title {
      color: #212529; /* Dark text color for card title */
      font-weight: bold; /* Bold font weight for card title */
      margin-top: 20px; /* Add space at the top of the card title */
    }
    .card-text {
      color: #6c757d; /* Dark gray text color for card content */
    }
    .btn {
      background-color: #007bff; /* Blue button color */
      border: none; /* Remove button border */
      border-radius: 5px; /* Rounded button corners */
    }
    .btn:hover {
      background-color: #0056b3; /* Darker blue color on hover */
    }
    .notice-board {
        margin-top: 20px;
    }

    .notice {
        background-color: #f0f0f0;
        padding: 10px;
        margin-bottom: 10px;
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Navbar (Left side) -->
    <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white bg-dark">
      <a href="/" class="d-flex align-items-center mt-3 mb-md text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Student</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="#" class="nav-link active" aria-current="page">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
            Home
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
            Profile
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
             Dashboard
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
            Scholarships
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
           Mentorship
          </a>
        </li>
        <li>
         <a href="#" class="nav-link">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
           Feedback
          </a>
        </li>
      </ul>
      <hr>
      <div class="dropdown">
          <strong>
        <a class="d-flex align-items-center text-white text-decoration-none " href="#">Sign out</a></strong>
       
      </div>
    </div>
    
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Raise a Ticket</div>

                <div class="card-body">
                   {{-- @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif --}}

                   {{-- <form method="POST" action="{{ route('raise-ticket') }}"> --}}
                        @csrf

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required autocomplete="subject" autofocus>
                          {{--  @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror --}}
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" rows="4">{{ old('description') }}</textarea>
                           {{-- @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror --}}
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}

        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>





