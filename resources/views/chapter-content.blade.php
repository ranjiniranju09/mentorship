<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chapters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding-top: 20px;
            padding-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 270px;
            padding: 5px;
        }
        .breadcrumb-container {
            margin-left: 270px;
            padding: 20px;
            background-color: #f8f9fa;
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
            transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
        }
        .chapter-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            background-color: #f1f1f1;
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
        .chapter-resources {
            margin-bottom: 10px;
        }
        .chapter-link {
            display: inline-block;
            color: #007bff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            transition: background-color 0.3s, color 0.3s;
        }
        .chapter-link:hover {
            background-color: #0056b3;
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h4 class="text-center">Chapters</h4>
    <a href="#chapter1">Chapter 1: Introduction</a>
    <!-- Add more chapter links here -->
</div>

<div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('chapters')}}" onclick="history.back()">Back</a></li>
        </ol>
    </nav>
</div>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-1">
                <div class="chapter-list">
                    <!-- Chapter 1 -->
                    <div class="chapter-item" id="chapter1">
                        <h3 class="chapter-title">Chapter 1: Introduction</h3>
                        <p class="chapter-description">Learn about the basics of our course.</p>
                        <div class="chapter-objectives">
                            <h5>Learning Objectives:</h5>
                            <ul>
                                <li>Understand the course structure</li>
                                <li>Get an overview of the main topics</li>
                                <li>Familiarize yourself with key concepts</li>
                            </ul>
                        </div>
                        <div class="chapter-resources">
                            <h5>Resources:</h5>
                            <ul>
                                <li><a href="resource1.pdf" class="chapter-link">Introduction PDF</a></li>
    </br>
                                <li><a href="video1.mp4" class="chapter-link">Introductory Video</a></li>
                            </ul>
                        </div>
                        <a href="#" class="chapter-link">Read more</a>
                    </div>
                    <!-- Add more chapters here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
