<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    /* Custom styles for achieving desired layout */
    .sidebar {
        width: 280px;
        height: 100vh; /* Full height of the viewport */
        background-color: #343a40; /* Dark background color */
    }
    .nav-link {
        color: #fff; /* White text color for navbar links */
        transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition effect */
        padding: 10px; /* Add padding for spacing */
    }
    .nav-link:hover {
        background-color: #0d6efd; /* Darker background color on hover */
        color: #fff; /* White text color on hover */
        text-decoration: none; /* Remove underline on hover */
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
    th {
        color: #fff; /* White text color for table headers */
        background-color: #343a40; /* Dark background color for table headers */
    }
    td {
        color: #212529; /* Dark text color for table data */
    }
    .content {
        margin-left: 120px; /* Adjust margin to accommodate sidebar */
        padding: 20px; /* Add some padding for content */
    }
</style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar (Left side) -->
    <div class="sidebar d-flex flex-column p-3 text-white bg-dark">
      <a href="/" class="d-flex align-items-center mt-3 mb-md text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Admin</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="{{route('admindash')}}" class="nav-link" aria-current="page">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
            Home
          </a>
        </li>
        <li>
          <a href="{{route('adminprofile')}}" class="nav-link">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
            Profile
          </a>
        </li>
        <li>
          <a href="{{route('admindash')}}" class="nav-link active">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
             Achievers
          </a>
        </li>
        <li>
          <a href="{{route('mentorassign')}}" class="nav-link">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
            Assign Mentor
          </a>
        </li>
        <li>
        <a href="{{route('addmentor')}}" class="nav-link">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
           Add Mentor
          </a>
        </li>
      </ul>
      <hr>
      <div >
          <strong><a href="{{route('login')}}" class="d-flex align-items-center text-white text-decoration-none" >Sign out</a></strong>
      </div>
    </div>

    <!-- Right side content -->
    <div class="col-md-9">
      <div class="content p-4">
            <h2>Mentorship</h2>
            <br>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#view">View Modules</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#add">Add Modules</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#edit">Edit Modules</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#delete">Delete Modules</a>
                </li>
            </ul>

              <!-- Tab panes -->
              <div class="tab-content">

              <!--  View assigned students tab -->
                <div id="view" class="container tab-pane  active"><br>

                <h2>Achievers List</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Achiever's Name</th>
                                <th>Program</th>
                                <th>Scholarship</th>
                                <th>Contact Info</th>
                            </tr>
                        </thead>
                        <tbody>
                       @foreach ($achievers as $achiever)
                          <tr>
                              <td>{{ $achiever->name }}</td>
                              <td>{{ $achiever->program }}</td>
                              <td>{{ $achiever->scholarship }}</td>
                              <td>{{ $achiever->mobile }}</td>
                          </tr>
                      @endforeach
                      @if (count($achievers) === 0)
                        <tr>
                            <td colspan="3">No achievers found.</td>
                        </tr>
                      @endif 
                        </tbody>
                    </table>
                </div>
              <!--  View assigned students tab -->
                <div id="add" class="container tab-pane "><br>
   
                    <form action="{{route('storeachiever')}}" method="POST">
                        @csrf
                        <div class="row">
                          <div class="col-md-6">
                              <div class="mb-3">
                                  <label for="name" class="form-label">Achiever's Name</label>
                                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter achiever's name">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3">
                                  <label for="scholarship" class="form-label">Scholarship</label>
                                  <input type="text" class="form-control" id="scholarship" name="scholarship" placeholder="Enter scholarship">
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="mb-3">
                                  <label for="program" class="form-label">Program</label>
                                  <input type="text" class="form-control" id="program" name="program" placeholder="Enter program">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3">
                                  <label for="contact" class="form-label">Contact</label>
                                  <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter contact info">
                              </div>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Add Achiever</button>
                    </form>
                </div>

               

                <div class="tab-content">
              <!--  edit assigned students tab -->
                <div id="edit" class="container tab-pane "><br>
                <h2>Achievers List</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Achiever's Name</th>
                                <th>Program</th>
                                <th>scholarship</th>
                                <th>Contact Info</th>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($achievers->isEmpty())
                          <tr>
                              <td colspan="4">No achievers found.</td>
                          </tr>
                      @else
                          @foreach ($achievers as $achiever)
                              <tr>
                                  <td>{{ $achiever->name }}</td>
                                  <td>{{ $achiever->program }}</td>
                                  <td>{{ $achiever->scholarship }}</td>
                                  <td>{{ $achiever->mobile }}</td>
                                  <td>
                                      <a href="{{ route('editachiever', $achiever->aid) }}" onclick="return confirm('Are you sure you want to edit this achiever?');"> 
                                          <i class="fa-solid fa-pen"></i>
                                      </a>
                                  </td>
                              </tr>
                          @endforeach
                      @endif 

                        </tbody>
                    </table>
                </div>


                <div id="delete" class="container tab-pane "><br>
                    <h3>Delete Session</h3>
                    <!-- Content for deleting mentors -->
                    @csrf
                    <table class="table table-bordered">
                    <thead>
                            <tr>
                                <th>Achiever's Name</th>
                                <th>Program</th>
                                <th>Scholarship</th>
                                <th>mobile</th>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($achievers as $achiever)
                            <tr>
                                <td>{{ $achiever->name }}</td>
                                <td>{{ $achiever->program }}</td>
                                <td>{{ $achiever->scholarship }}</td>
                                <td>{{ $achiever->mobile }} </td>
                                <td>
                                    <a href="{{ route('achieverdelete', $achiever->aid) }}" onclick="return confirm('Are you sure you want to delete this session?');"> 
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                </td>
                            </tr>
                      @endforeach 

                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
   
  </div>
</div>
</body>
</html>
