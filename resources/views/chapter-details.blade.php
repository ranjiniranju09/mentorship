<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chapters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS styles */
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
        .chapter-list {
            padding: 20px;
            margin-top: 20px;
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
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="chapter-list">
                <!-- Chapter 1 -->
                <div class="chapter-item">
                    <h3 class="chapter-title">Chapter 1: Introduction</h3>
                    <p class="chapter-description">Learn about the basics of our course.</p>
                    <a href="{{route('chapterscontent')}}" class="chapter-link">Read more</a>
                </div>

                <!-- Chapter 2 -->
                <div class="chapter-item">
                    <h3 class="chapter-title">Chapter 2: Getting Started</h3>
                    <p class="chapter-description">Setting up your environment and tools.</p>
                    <a href="#" class="chapter-link">Read more</a>
                </div>

                <!-- Add more chapters here -->
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
