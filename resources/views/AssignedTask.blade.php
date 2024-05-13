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
            <a href="#" class="nav-link active" aria-current="page">
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

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <h3>Add Task</h3>
        <form action="{{ route('StoreTask', ['mentorId' => $mentorId]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Task Title">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Enter Task Description"></textarea>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Upload File</label>
                <input type="file" class="form-control" id="file" name="file">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>

        <div class="col-md-9">
          <div class="content">
  </br>
              <h3>Task List</h3>
              <table class="table">
                  <thead>
                      <tr>
                          <th>Title</th>
                          <th>Description</th>
                          <th>File</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <!-- Iterate through tasks -->
                    {{--  @foreach($tasks as $task)
                      <tr>
                          <td>{{ $task->title }}</td>
                          <td>{{ $task->description }}</td>
                          <td>{{ $task->file }}</td>
                          <td>
                              <!-- Add action buttons here (edit, delete, etc.) -->
                          </td>
                      </tr>
                      @endforeach --}}
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
