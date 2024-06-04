<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chapters</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- FullCalendar CSS -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    
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
            margin-left: 270px;
            padding: 20px;
        }
        .icon-title {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .icon-title i {
            margin-right: 10px;
        }
        .breadcrumb-container {
            margin-left: 270px;
            padding: 20px;
            background-color: #f8f9fa;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .breadcrumb-container a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }
        .breadcrumb-container a:hover {
            color: #0056b3;
        }
        .chapter-list {
            padding: 20px;
        }
        .chapter-item {
            margin-bottom: 15px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative; /* Added for positioning progress bar and quiz button */
        }
        .chapter-title {
            font-weight: bold;
            color: #343a40;
            margin-bottom: 10px;
        }
        .chapter-description {
            color: #6c757d;
            margin-bottom: 10px;
        }
        .chapter-objectives {
            margin-bottom: 10px;
        }
        .chapter-objectives h5 {
            color: #17a2b8;
        }
        .chapter-resources {
            margin-bottom: 10px;
        }
        .chapter-resources h5 {
            color: #28a745;
        }
        .chapter-link {
            display: inline-block;
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #007bff;
            transition: background-color 0.3s, color 0.3s, transform 0.3s;
            margin-right: 10px;
        }
        .chapter-link:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .progress-bar {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 5px; /* Width of the progress bar */
            background-color: #ffc107; /* Color of the progress bar */
            border-radius: 5px;
        }
       
        .btn-warning {
            background-color: #ffc107;
        }
</style>
</head>
<body>
<div class="sidebar">
    <a href="#">
        <span class="icon">
            <i class="fa-solid fa-circle-user fa-2xl"></i> &nbsp;
        </span> 
        <span class="title"> Mentee </span>
    </a>
    <div class="icon-title">
        <h4 class="text" style="color: #fff; margin: 0;">1. JavaScript Introduction</h4>
    </div>
    <a href="#chapter1">Chapter 1.1 : Introduction </a>
    <a href="#chapter2">Chapter 1.2 : JavaScript Functions and Events </a>
    <a href="#chapter3">Chapter 1.3: Advanced Topics</a>
    <a href="#chapter4">Chapter 1.4: Summary</a>
</div>

<div class="breadcrumb-container">
    <a href="{{route('chapters')}}" onclick="history.back()">Back</a>
    <a href="#nextChapter">Next</a>
</div>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-1">
                <div> 
                    <h2>JavaScript Introduction</h2>
                    <hr>
                </div>
                <div class="chapter-list">
                    <!-- Chapter 1 -->
                    <div class="chapter-item" id="chapter1">
                        <div class="progress-bar"></div> <!-- Progress bar added here -->
                        <h3 class="chapter-title">Chapter 1.1: JavaScript Introduction</h3>
                        <p class="chapter-description">Learn about the basics of our course.</p>
                        <div class="chapter-objectives">
                            <h5>Learning Objectives:</h5>
                            <ul>
                                <h6>JavaScript is one of the 3 languages all web developers must learn: </h6> 

                                <li>1. HTML to define the content of web pages</li> 

                                <li> 2. CSS to specify the layout of web pages</li>    

                                <li> 3. JavaScript to program the behavior of web pages</li>
                            </ul>
                        </div>
                        <!-- <div class="chapter-resources">
                            <h5>Resources:</h5>
                            <ul>
                                <li><a href="resource1.pdf" class="chapter-link">Introduction PDF</a></li><br>
                                <li><a href="video1.mp4" class="chapter-link">Introductory Video</a></li>
                            </ul>
                        </div> -->
                        <!-- <a href="{{route('JsIntro')}}" class="chapter-link">Read more</a> -->
                        <a href="{{route('quizJsIntro')}}" target="_blank" class="chapter-link btn btn-warning"><i class="fas fa-question-circle"></i> Quiz</a></button> <!-- Quiz button added here -->
                    </div>
                    
                    <!-- Chapter 2 -->
                    <div class="chapter-item" id="chapter2">
                        <div class="progress-bar"></div>
                        <h3 class="chapter-title">Chapter 1.2 : JavaScript Functions and Events </h3>
                        <p class="chapter-description">Dive into the basic concepts.</p>
                        <div class="chapter-objectives">
                            <!-- <h5>Learning Objectives:</h5> -->
                            <ul>
                                A JavaScript function is a block of JavaScript code, that can be executed when "called" for.
                                For example, a function can be called when an event occurs, like when the user clicks a button.
                            </ul>
                            <ul>
                                Example : 

                            </ul>

                        </div>
                        <!-- <div class="chapter-resources">
                            <h5>Resources:</h5>
                            <ul>
                                <li><a href="resource2.pdf" class="chapter-link">Basics PDF</a></li><br>
                                <li><a href="video2.mp4" class="chapter-link">Basics Video</a></li>
                            </ul>
                        </div> -->
                        <!-- <a href="#" class="chapter-link">Read more</a> -->
                        <button type="button" class="chpater-link btn btn-warning">Quiz</button> <!-- Quiz button added here -->

                    </div>
                    
                    <!-- Chapter 3 -->
                    <div class="chapter-item" id="chapter3">
                    <div class="progress-bar"></div> <!-- Progress bar added here -->

                        <h3 class="chapter-title">Chapter 3: Advanced Topics</h3>
                        <p class="chapter-description">Explore advanced topics.</p>
                        <div class="chapter-objectives">
                            <h5>Learning Objectives:</h5>
                            <ul>
                                <li>Understand advanced concepts</li>
                                <li>Apply advanced techniques</li>
                                <li>Work on complex projects</li>
                            </ul>
                        </div>
                        <!-- <div class="chapter-resources">
                            <h5>Resources:</h5>
                            <ul>
                                <li><a href="resource3.pdf" class="chapter-link">Advanced Topics PDF</a></li><br>
                                <li><a href="video3.mp4" class="chapter-link">Advanced Topics Video</a></li>
                            </ul>
                        </div> -->
                        <!-- <a href="#" class="chapter-link">Read more</a> -->
                        <button type="button" class="chpater-link btn btn-warning">Quiz</button> <!-- Quiz button added here -->

                    </div>
                    
                    <!-- Chapter 4 -->
                    <div class="chapter-item" id="chapter4">
                    <div class="progress-bar"></div> <!-- Progress bar added here -->
                        <h3 class="chapter-title">Chapter 4: Summary</h3>
                        <p class="chapter-description">Summary of the course.</p>
                        <div class="chapter-objectives">
                            <h5>Learning Objectives:</h5>
                            <ul>
                                <li>Recap of main topics</li>
                                <li>Review key concepts</li>
                                <li>Prepare for assessments</li>
                            </ul>
                        </div>
                        <!-- <div class="chapter-resources">
                            <h5>Resources:</h5>
                            <ul>
                                <li><a href="resource4.pdf" class="chapter-link">Summary PDF</a></li><br>
                                <li><a href="video4.mp4" class="chapter-link">Summary Video</a></li>
                            </ul>
                        </div> -->
                        <!-- <a href="#" class="chapter-link">Read more</a> -->
                             <a href="{{route('quiz')}}" target="_blank" class="chapter-link btn-success"><i class="fas fa-question-circle"></i> Quiz</a></button> <!-- Quiz button added here -->

                    </div>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all chapter items
        const chapters = document.querySelectorAll(".chapter-item");

        // Hide all chapters except Chapter 1
        for (let i = 1; i < chapters.length; i++) {
            chapters[i].style.display = "none";
        }

        // Add click event listener to each sidebar link
        document.querySelectorAll(".sidebar a").forEach(function(link) {
            link.addEventListener("click", function(event) {
                // Prevent default link behavior
                event.preventDefault();

                // Get the target chapter id from href
                const targetChapterId = link.getAttribute("href").substring(1);

                // Show only the selected chapter, hide others
                chapters.forEach(function(chapter) {
                    if (chapter.id === targetChapterId) {
                        chapter.style.display = "block";
                    } else {
                        chapter.style.display = "none";
                    }
                });
            });
        });
    });
</script>


</body>
</html>
