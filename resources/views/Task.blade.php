<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task</title>
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
            cursor: pointer;
        }
        .user img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .greeting {
            font-size: 24px;
            color: #333;
            font-weight: bold;
            color: green;
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
    
        .academic-record,.assigned-tasks, .calendar, .mentor-details, .Resources, .recent-activities, .meetings {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: transform 0.3s;
        }
        .academic-record:hover, .calendar:hover, .mentor-details:hover, .Resources:hover, .recent-activities:hover, .meetings:hover {
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
        .calendar-item, .Resources-item, .mentor-detailsitems, .activity-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            transition: all 0.3s ease-in-out;
        }
        .calendar-item:last-child, .Resources-item:last-child, .activity-item:last-child {
            border-bottom: none;
        }
        .calendar-item:hover, .Resources-item:hover, .activity-item:hover {
            background-color: #f0f0f0;
            transform: scale(1.02);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .calendar-time, .Resources-time, .activity-time {
            font-size: 18px;
            color: #333;
            display: block;
            font-weight: bold;
        }
        .calendar-event, .Resources-event, .activity-event,.mentor-event {
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

        /* To-Do List Styles */
        .todo-list {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .todo-list h6 {
            color: #333;
            font-weight: bold;
        }
        .todo-list .form-control {
            border: 1px solid #ccc;
            box-shadow: none;
        }
        .todo-list .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .todo-list .btn-primary:hover {
            background-color: #0056b3;
        }
        .todo-list .form-check-input {
            margin: 0;
        }
        .todo-list .list-group-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .todo-list .list-group-item .btn-sm {
            font-size: 0.8rem;
        }
        .task {
            color: orangered;
        }
        .submitted-badge {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
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
            <a href="{{route('calender')}}"><i class="fa-solid fa-calendar-days"></i>&nbsp; Calendar</a>
            <a href="{{route('taskmentee')}}"><i class="fas fa-tasks card-icon"></i>&nbsp; Task</a>
            <a href="{{route('tickets')}}"><i class="fa-solid fa-ticket"></i>&nbsp; Ticket</a></a>
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
                                <span class="greeting">Hi, Chisom</span>
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
                     <!-- Calendar Section
                     <div class="calendar">
                        <h4>Calendar</h4>
                        <div id='calendar'></div>
                    </div> -->
                    <div class="assigned-tasks">
                        <h5 class="task">Assigned Tasks</h5>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center" data-description="Complete the math exercises from chapter 5" data-due-date="2024-06-05" data-task-id="1" onclick="showTaskDetails(this)">
                                <div>
                                    <label style="margin-right: 20px;"><input class="form-check-input m-0" type="checkbox"></label>
                                    <strong>Assignment 1:</strong> Math Homework <span class="badge bg-primary">New</span>
                                </div>
                                <span class="badge badge-primary badge-pill">2024-06-05</span>
                                <a href="{{route('dashboardmentee')}}" target="_blank"><i class="fa-solid fa-book-open-reader"></i></a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" data-description="Prepare a model for the science fair" data-due-date="2024-06-10" data-task-id="2" onclick="showTaskDetails(this)">
                                <div>
                                    <label style="margin-right: 20px;"><input class="form-check-input m-0" type="checkbox"></label>
                                    <strong>Project:</strong> Science Fair
                                </div>
                                <span class="badge badge-primary badge-pill">2024-06-10</span>
                                <a href="#" target="_blank"><i class="fa-solid fa-book-open-reader"></i></a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" data-description="Write an essay about the history of ancient Egypt" data-due-date="2024-06-15" data-task-id="3" onclick="showTaskDetails(this)">
                                <div>
                                    <label style="margin-right: 20px;"><input class="form-check-input m-0" type="checkbox"></label>
                                    <strong>Essay:</strong> History of Ancient Egypt
                                </div>
                                <span class="badge badge-primary badge-pill">2024-06-15</span>
                                <a href="#" target="_blank"><i class="fa-solid fa-book-open-reader"></i></a>
                            </li>
                        </ul>

                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="uploadFile">
                        </div>
                        
                        <button class="btn btn-primary w-100" type="submit">Submit</button>
                    </div>
                   
                    <!-- <div class="Resources">
                        <h4>Related Resources</h4>
                        <div class="notification-item">
                            <span class="Resources-time">10:00</span>
                            <span class="Resources-event">Assignment due</span>
                        </div>
                        <div class="Resources-item">
                            <span class="Resources-time">13:00</span>
                            <span class="Resources-event">New lecture available</span>
                        </div>
                    </div> -->
                </div>
                <div class="col-md-4">
                    <div class="mentor-details" style="background-color:#ffc107;">
                        <h4>Assigned Mentor</h4>
                        <div class="mentor-detailsitems">
                            <span class="mentor-event"> Mentor name: Rahul Parakh</span>
                        </div>
                    </div>
                    <div class="todo-list">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Notes</h6>
                            <a href="#" class="text-primary">Show All</a>
                        </div>
                        <div class="d-flex mb-2">
                            <input class="form-control" type="text" placeholder="Enter task">
                            <button type="button" class="btn btn-primary ms-2">Add</button>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item d-flex align-items-center">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm btn-outline-danger ms-auto"><i class="fa fa-times"></i></button>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm btn-outline-danger ms-auto"><i class="fa fa-times"></i></button>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm btn-outline-primary ms-auto"><i class="fa fa-times"></i></button>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm btn-outline-danger ms-auto"><i class="fa fa-times"></i></button>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm btn-outline-danger ms-auto"><i class="fa fa-times"></i></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Task Detail Modal -->
    <div class="modal fade" id="taskDetailModal" tabindex="-1" aria-labelledby="taskDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskDetailModalLabel">Task Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Description:</strong> <span id="taskDescription"></span></p>
                    <p><strong>Due Date:</strong> <span id="taskDueDate"></span></p>
                    <textarea class="form-control" rows="4" placeholder="Enter task details here..."></textarea>
                    <div class="input-group mt-3">
                        <input type="file" class="form-control" id="uploadTaskFile">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitTask()">Submit</button>
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
        // $(document).ready(function() {
        //     $('#calendar').fullCalendar({
        //         header: {
        //             left: 'prev,next today',
        //             center: 'title',
        //             right: 'month,agendaWeek,agendaDay'
        //         },
        //         editable: true,
        //         events: [
        //             {
        //                 title: 'Mathematics Meeting',
        //                 start: '2024-06-01T09:00:00'
        //             },
        //             {
        //                 title: 'Science Meeting',
        //                 start: '2024-06-05T12:00:00'
        //             },
        //             {
        //                 title: 'History Meeting',
        //                 start: '2024-06-10T15:00:00'
        //             },
        //             {
        //                 title: 'Geography Lecture',
        //                 start: '2024-06-15T14:00:00'
        //             }
        //         ]
        //     });
        // });

        function showTaskDetails(element) {
            const description = element.getAttribute('data-description');
            const dueDate = element.getAttribute('data-due-date');
            const taskId = element.getAttribute('data-task-id');
            
            document.getElementById('taskDescription').innerText = description;
            document.getElementById('taskDueDate').innerText = dueDate;
            document.getElementById('taskDetailModal').setAttribute('data-task-id', taskId);
            
            $('#taskDetailModal').modal('show');
        }

        function submitTask() {
            const taskId = document.getElementById('taskDetailModal').getAttribute('data-task-id');
            const taskElement = document.querySelector(`[data-task-id="${taskId}"]`);
            const submittedBadge = document.createElement('span');
            submittedBadge.classList.add('badge', 'submitted-badge');
            submittedBadge.innerText = 'Submitted';
            taskElement.appendChild(submittedBadge);

            $('#taskDetailModal').modal('hide');
        }
    </script>
</body>
</html>
