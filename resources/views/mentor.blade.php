<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Provided CSS styles */
    .sidebar {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      width: 280px;
      background-color: #343a40;
      overflow-y: auto;
    }
    .nav-link {
      color: #fff;
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
    <div class="col-md-3">
      <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white">
        <a href="/" class="d-flex align-items-center mb-3 text-white text-decoration-none">
          <span class="fs-4">Mentor</span>
        </a>
        <ul class="nav flex-column mb-auto">
          <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Home</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Profile</a>
          </li>
          <li class="nav-item">
            <a href="{{route('mentor')}}" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Scholarships</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Mentorship</a>
          </li>
          <li class="nav-item">
            <a href="{{route('session')}}" class="nav-link " aria-current="page">
              Add session
            </a>
          </li>
          <li class="nav-item">
          <a href="{{ route('ShowTask') }}" class="nav-link active" aria-current="page">
              Assign Task
            </a>
          </li>
        </ul>
        <a class="d-flex align-items-center text-white text-decoration-none" href="{{route('login')}}">Sign out</a>
      </div>
    </div>
     
    <!-- Content (Right side) -->
    <div class="col-md-9">
      <div class="content">
          <!-- Notice Board -->
            <div class="notice-board">
              <h3 class="mb-4">Notice Board</h3>
              <div class="notice">
              @if($pastSessions->isNotEmpty())
              <h4><u>Past Sessions</u></h4>
              @foreach ($pastSessions as $session)
                  <div class="notice">
                      <p>{{ $session->name }} - {{ $session->date }}</p>
                  </div>
              @endforeach
          @endif

          @if($upcomingSessions->isNotEmpty())
              <h5><u>Upcoming Sessions</u></h5>
              @foreach ($upcomingSessions as $session)
                  <div class="notice">
                      <p>{{ $session->name }} - {{ $session->date }}</p>
                  </div>
              @endforeach
          @endif
              </div>
              <!-- Add more notices as needed -->
            </div>
        </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
