<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentee Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- FullCalendar CSS -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <!-- Custom CSS -->
    <style>
        body {
            font-family: "Ubuntu", sans-serif;
            background-color: #f4f7f6;
        }
        .sidebar {
            position: fixed;
            width: 250px;
            height: 100%;
            background: linear-gradient(to bottom, #000000, #4ca1af);
            transition: 0.5s;
            overflow: hidden;
        }
        .sidebar a {
            position: relative;
            display: block;
            width: 100%;
            text-decoration: none;
            color: white;
            padding: 15px 10px;
            margin-bottom: 10px;
            align-content: center;
            transition: background-color 0.3s, color 0.3s;
        }
        .sidebar a:hover {
            color: #cc66ff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .hovered a {
            color: blue;
        }
        .sidebar a i {
            margin-right: 15px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.5s;
        }
        .topbar, .dashboard-header-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .topbar {
            width: 100%;
            height: 60px;
            padding: 0 10px;
        }
        .toggle {
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2.5rem;
            cursor: pointer;
        }
        .search {
            width: 400px;
            margin: 0 10px;
            position: relative;
        }
        .search label {
            width: 100%;
        }
        .search label input {
            width: 100%;
            height: 40px;
            border-radius: 40px;
            padding: 5px 20px;
            padding-left: 35px;
            font-size: 18px;
            outline: none;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .search label ion-icon {
            position: absolute;
            top: 50%;
            left: 10px;
            font-size: 1.2rem;
            transform: translateY(-50%);
        }
        .user {
            width: 50px;
            height: 50px;
            /* border-radius: 50%; */
            /* overflow: hidden; */
            cursor: pointer;
            /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
        }
        .user img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .greeting {
            font-size: 24px;
            color: green;
            font-weight: bold;
        }
        .start-btn {
            background-color: #5cb85c;
            color: #fff;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 18px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .start-btn:hover {
            background-color: #4cae4c;
        }
        .dashboard-header-wrapper {
            margin-bottom: 30px;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .sidebar a {
                text-align: center;
                float: none;
            }
            .content {
                margin-left: 0;
            }
        }
        .academic-record, .assigned-tasks, .calendar, .mentor-details, .notifications, .recent-activities, .meetings {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: transform 0.3s;
        }
        .academic-record:hover, .assigned-tasks:hover, .mentor-details:hover, .notifications:hover, .recent-activities:hover, .meetings:hover {
            transform: translateY(-5px);
        }
        .progress {
            height: 20px;
            border-radius: 10px;
        }
        .module-name {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }
        .calendar-item, .notification-item, .mentor-detailsitems, .activity-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            transition: all 0.3s ease-in-out;
        }
        .calendar-item:last-child, .notification-item:last-child, .activity-item:last-child {
            border-bottom: none;
        }
        .calendar-item:hover, .notification-item:hover, .activity-item:hover {
            background-color: #f0f0f0;
            transform: scale(1.02);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .calendar-time, .notification-time, .activity-time {
            font-size: 18px;
            color: #333;
            display: block;
            font-weight: bold;
        }
        .calendar-event, .notification-event, .activity-event {
            font-size: 16px;
            color: #666;
            display: block;
        }
        .top-performer {
            text-align: center;
            margin-top: 30px;
        }
        .top-performer img {
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .top-performer h3 {
            margin-top: 10px;
            font-size: 18px;
            color: #333;
            font-weight: bold;
        }
        .top-performer p {
            color: #666;
        }
        .card-icon {
            font-size: 36px;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .custom-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
            transition: transform 0.3s;
        }
        .custom-card:hover {
            transform: translateY(-5px);
        }
        .custom-card.project {
            border-left: 5px solid #007bff;
        }
        .custom-card.task {
            border-left: 5px solid #28a745;
        }
        .custom-card.quizzes {
            border-left: 5px solid #ffc107;
        }
        .custom-card.project .card-icon {
            color: #007bff;
        }
        .custom-card.task .card-icon {
            color: #28a745;
        }
        .custom-card.quizzes .card-icon {
            color: #ffc107;
        }
        /* FullCalendar overrides */
        #calendar {
            max-width: 100%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="sidebar">
            <a href="#">
                <span class="icon">
                    <i class="fa-solid fa-circle-user fa-2xl"></i> &nbsp;
                </span> 
                <span class="title"> Mentee </span>
            </a>
            <a href="{{route('dashboardmentee')}}"><i class="fa-solid fa-house"></i>&nbsp; Home</a>
            <a href="#"><i class="fa-solid fa-user"></i>&nbsp; Profile</a>
            <a href="{{route('modules')}}"><i class="fa-solid fa-book"></i>&nbsp; Modules</a>
            <a href="{{route('taskmentee')}}"><i class="fas fa-tasks card-icon"></i>&nbsp; Task</a>
            <a href="{{route('calender')}}"><i class="fa-solid fa-calendar-days"></i>&nbsp; Calendar</a>
            <a href="{{route('menteeticket')}}"><i class="fa-solid fa-ticket"></i>&nbsp; Ticket</a></a>
            <a href="#"><i class="fa-solid fa-bell"></i>&nbsp; Notifications</a>
            <a href="#"><i class="fa-solid fa-right-from-bracket fa-flip-horizontal"></i>&nbsp; Sign Out</a>
        </div>
        <div class="container content">
            <div class="row">
                <div class="col-md-8">
                    <div class="dashboard-header-wrapper">
                        <div class="topbar">
                            <div class="dashboard-header">
                            <i class="fa-solid fa-graduation-cap fa-beat fa-2xl"></i>
                                <span class="greeting">Hi, Chisom
                            </div>
                            <div class="toggle">
                                <ion-icon name="menu-outline"></ion-icon>
                            </div>
                            <div class="search">
                                <label>
                                    <input type="text" placeholder="Search here">
                                    <ion-icon name="search-outline"></ion-icon>
                                </label>
                            </div>
                            
                        </div>
                    </div>
                    <div class="top-performer">
                        <h3>Mariya Bestcity</h3>
                        <p>Top Performer - Mean Score: 192</p>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="custom-card project">
                            <a href="{{route('modules')}}"><i class="fas fa-project-diagram card-icon"></i></a>
                                <h5>Modules</h5>
                                <p>Details about the project progress and submissions.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-card task">
                               <a href="{{route('taskmentee')}}"> <i class="fas fa-tasks card-icon"></i></a>
                                <h5>Task</h5>
                                <p>Overview of upcoming tasks and deadlines.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-card quizzes">
                            <a href="{{route('publicresources')}}"><i class="fas fa-clipboard-list card-icon"></i></a>
                                <h5>Resources</h5>
                                <p>Information on General Resources .</p>
                            </div>
                        </div>
                    </div>
                    <div class="academic-record">
                        <h4>Academic Record</h4>
                        <div class="module-name">Module 1</div>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80%</div>
                        </div>
                        <div class="module-name">Module 2</div>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                        </div>
                        <div class="module-name">Module 3</div>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                        </div>
                        <div class="module-name">Module 4</div>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                        </div>
                    </div>
                    <!-- <div class="assigned-tasks">
                        <h4>Assigned Tasks</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Assigned Task</th>
                                    <th scope="col">Submission Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Assignment 1: Math Homework</td>
                                    <td>2024-06-05</td>
                                </tr>
                                <tr>
                                    <td>Project: Science Fair</td>
                                    <td>2024-06-10</td>
                                </tr>
                                <tr>
                                    <td>Essay: History of Ancient Egypt</td>
                                    <td>2024-06-15</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="meetings">
                                <h4>Meetings</h4>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Module Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Mathematics</td>
                                            <td>Scheduled</td>
                                            <td>2024-06-01</td>
                                            <td><a href="#" class="btn btn-primary">Join</a></td>
                                        </tr>
                                        <tr>
                                            <td>Science</td>
                                            <td>Scheduled</td>
                                            <td>2024-06-05</td>
                                            <td><a href="#" class="btn btn-primary">Join</a></td>
                                        </tr>
                                        <tr>
                                            <td>History</td>
                                            <td>Scheduled</td>
                                            <td>2024-06-10</td>
                                            <td><a href="#" class="btn btn-primary">Join</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            Calendar Section
                            <div class="calendar">
                                <h4>Calendar</h4>
                                <div id='calendar'></div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-md-4">
                <div class="mentor-details" style="background-color:#ffc107;">
                        <h4>Assigned Mentor</h4>
                        <div class="mentor-detailsitems">
                            <span class="notification-event"> Mentor name: Rahul Parakh</span>
                        </div>
                       
                    </div>
                    <div class="notifications">
                        <h4>Notifications</h4>
                        <div class="notification-item">
                            <span class="notification-time">10:00</span>
                            <span class="notification-event">Assignment due</span>
                        </div>
                        <div class="notification-item">
                            <span class="notification-time">13:00</span>
                            <span class="notification-event">New lecture available</span>
                        </div>
                    </div>
                    <div class="recent-activities">
                        <h4>Recent Activities</h4>
                        <div class="activity-item">
                            <span class="activity-time">Yesterday</span>
                            <span class="activity-event">Completed Assignment 1</span>
                        </div>
                        <div class="activity-item">
                            <span class="activity-time">2 days ago</span>
                            <span class="activity-event">Joined new course: Biology</span>
                        </div>
                    </div>
                    <!-- Calendar Section -->
                    <div class="calendar">
                        <h4>Calendar</h4>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.16/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- FullCalendar JS -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                events: [
                    {
                        title: 'Mathematics Meeting',
                        start: '2024-06-01T09:00:00'
                    },
                    {
                        title: 'Science Meeting',
                        start: '2024-06-05T12:00:00'
                    },
                    {
                        title: 'History Meeting',
                        start: '2024-06-10T15:00:00'
                    },
                    {
                        title: 'Geography Lecture',
                        start: '2024-06-15T14:00:00'
                    }
                ]
            });
        });
    </script>
</body>
</html>
