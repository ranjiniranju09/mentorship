<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opportunities</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            display: block;
            width: 100%;
            text-decoration: none;
            color: white;
            padding: 15px 10px;
            margin-bottom: 10px;
            transition: background-color 0.3s, color 0.3s;
        }
        .sidebar a:hover {
            color: #cc66ff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.5s;
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 60px;
            padding: 0 10px;
        }
        .greeting {
            font-size: 24px;
            color: green;
            font-weight: bold;
        }
        .jobs {
            display: flex;
            color: #0400ff;
            justify-content: space-between;
        }
        .jobs h2 {
            margin: 0;
            flex: 1;
        }
        .search {
            width: 400px;
            position: relative;
            flex: 1;
            text-align: right;
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
        .filter-btns {
            text-align: center;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .filter-btn {
            padding: 10px 10px;
            background-color: white;
            color: black;
            border: none;
            border-radius: 30%;
            width: 10%;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .filter-btn:hover {
            background-color: #2196f3;
        }
        .filter-btn.active {
            background-color: #2196f3;
        }
        .opportunity-list {
            list-style: none;
            padding: 0;
        }
        .opportunity-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s;
        }
        .opportunity-item:hover {
            background-color: #f0f0f0;
        }
        .opportunity-info {
            display: flex;
            align-items: center;
        }
        .opportunity-icon {
            font-size: 36px;
            margin-right: 20px;
        }
        .opportunity-action {
            text-align: right;
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
        @media (max-width: 768px) {
            .sidebar {
                width: 250px;
                height: 100%;
                position: fixed;
                left: -250px;
                z-index: 1000;
            }
            .sidebar.active {
                left: 0;
            }
            .content {
                margin-left: 0;
            }
            .toggle {
                display: block;
            }
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
            <a href="{{route('taskmentee')}}"><i class="fa-solid fa-list"></i>&nbsp; Task</a>
            <a href="{{route('calender')}}"><i class="fa-solid fa-calendar-days"></i>&nbsp; Calendar</a>
            <a href="{{route('tickets')}}"><i class="fa-solid fa-ticket"></i>&nbsp; Ticket</a>
            <a href="#"><i class="fa-solid fa-bell"></i>&nbsp; Notifications</a>
            <a href="#"><i class="fa-solid fa-right-from-bracket fa-flip-horizontal"></i>&nbsp; Sign Out</a>
        </div>
        <div class="container content">
            <div class="row">
                <div class="col-md-12">
                    <div class="dashboard-header-wrapper">
                        <div class="topbar">
                            <div class="dashboard-header">
                                <i class="fa-solid fa-graduation-cap fa-beat fa-2xl"></i>
                                <span class="greeting">Hi, Chisom</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="jobs">
                        <h2>Opportunities for you</h2>
                        <div class="search">
                            <label>
                                <input type="text" placeholder="Search here">
                            </label>
                        </div>
                        <hr>
                    </div>
                    <div class="filter-btns rounded">
                      <button class="filter-btn active" onclick="filterOpportunities('all')">All</button>
                      <button class="filter-btn" onclick="filterOpportunities('job')">Jobs</button>
                      <button class="filter-btn" onclick="filterOpportunities('internship')">Internships</button>
                      <button class="filter-btn" onclick="filterOpportunities('fellowship')">Fellowships</button>
                    </div>
                    <hr>
                    <ul class="opportunity-list">
                        <li class="opportunity-item job">
                            <div class="opportunity-info">
                                <i class="fa-brands fa-js opportunity-icon" style="color: #FFD43B;"></i>
                                <h5>Software Engineer</h5>
                            </div>
                            <div class="opportunity-action">
                                <a href="#" class="start-btn">Explore</a>
                            </div>
                        </li>
                        <li class="opportunity-item internship">
                            <div class="opportunity-info">
                                <i class="fa-brands fa-html5 opportunity-icon" style="color: #ff9500;"></i>
                                <h5>Frontend Developer Intern</h5>
                            </div>
                            <div class="opportunity-action">
                                <a href="#" class="start-btn">Explore</a>
                            </div>
                        </li>
                        <li class="opportunity-item fellowship">
                            <div class="opportunity-info">
                                <i class="fa-brands fa-css3-alt opportunity-icon" style="color: #3dabff;"></i>
                                <h5>UX Research Fellow</h5>
                            </div>
                            <div class="opportunity-action">
                                <a href="#" class="start-btn">Explore</a>
                            </div>
                        </li>
                        <li class="opportunity-item job">
                            <div class="opportunity-info">
                                <i class="fa-brands fa-php opportunity-icon" style="color: #002970;"></i>
                                <h5>Backend Developer</h5>
                            </div>
                            <div class="opportunity-action">
                                <a href="#" class="start-btn">Explore</a>
                            </div>
                        </li>
                        <li class="opportunity-item internship">
                            <div class="opportunity-info">
                                <i class="fa-brands fa-react opportunity-icon" style="color: #0400ff;"></i>
                                <h5>React Developer Intern</h5>
                            </div>
                            <div class="opportunity-action">
                                <a href="#" class="start-btn">Explore</a>
                            </div>
                        </li>
                        <li class="opportunity-item fellowship">
                            <div class="opportunity-info">
                                <i class="fa-solid fa-database opportunity-icon" style="color: #00348f;"></i>
                                <h5>Data Science Fellow</h5>
                            </div>
                            <div class="opportunity-action">
                                <a href="#" class="start-btn">Explore</a>
                            </div>
                        </li>
                        <li class="opportunity-item job">
                            <div class="opportunity-info">
                                <i class="fa-brands fa-java opportunity-icon" style="color: #fa8500;"></i>
                                <h5>Java Developer</h5>
                            </div>
                            <div class="opportunity-action">
                                <a href="#" class="start-btn">Explore</a>
                            </div>
                        </li>
                        <li class="opportunity-item internship">
                            <div class="opportunity-info">
                                <i class="fa-brands fa-python opportunity-icon" style="color: #1e8fe6;"></i>
                                <h5>Python Developer Intern</h5>
                            </div>
                            <div class="opportunity-action">
                                <a href="#" class="start-btn">Explore</a>
                            </div>
                        </li>
                    </ul>
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
    <!-- Custom JavaScript -->
    <script>
        function filterOpportunities(type) {
            const items = document.querySelectorAll('.opportunity-item');
            items.forEach(item => {
                if (type === 'all') {
                    item.style.display = 'flex';
                } else if (item.classList.contains(type)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector(`.filter-btn[onclick="filterOpportunities('${type}')"]`).classList.add('active');
        }
    </script>
    <script>
    $(document).ready(function() {
        // Toggle sidebar on hamburger menu click
        $('#toggle-btn').click(function() {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
</body>
</html>
