<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
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
          <span class="fs-4">Mentees</span>
        </a>
        <ul class="nav flex-column mb-auto">
          <li class="nav-item">
            <a href="#" class="nav-link" aria-current="page">Home</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Profile</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Sessions</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('showchat') }}" class="nav-link">Chat Room</a>
          </li>
        </ul>
        <a class="d-flex align-items-center text-white text-decoration-none" href="{{ route('login') }}">Sign out</a>
      </div>
    </div>
    
    <!-- Content (Right side) -->
    <div class="col-md-9">
      <div class="content">
        <div class="container mt-5">
          <h1 class="mt-4 mb-4">Resources </h1>
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
          @endif
          <table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
            <!-- Add other columns as needed -->
        </tr>
    </thead>
    <tbody>
        @foreach ($mentorResources as $resource)
            <tr>
                <td>{{ $resource->title }}</td>
                <td>{{ $resource->description }}</td>
                <td>
                    <a href="{{ $resource->link }}" target="_blank" class="btn btn-primary">Link</a>
                    <a href="{{ $resource->file_path }}" download class="btn btn-success">Download</a>
                </td>
                <!-- Add other columns as needed -->
            </tr>
        @endforeach

        @foreach ($publicResources as $resource)
            <tr>
                <td>{{ $resource->title }}</td>
                <td>{{ $resource->description }}</td>
                <td>
                    <a href="{{ $resource->link }}" target="_blank" class="btn btn-primary">link</a>
                    <a href="{{ $resource->file_path }}" download class="btn btn-success">Download</a>
                </td>
                <!-- Add other columns as needed -->
            </tr>
        @endforeach

        <!-- No resources found -->
        @if($mentorResources->isEmpty() && $publicResources->isEmpty())
            <tr>
                <td colspan="4">No resources found.</td>
            </tr>
        @endif
    </tbody>
</table>


        </div>
      </div> 
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
