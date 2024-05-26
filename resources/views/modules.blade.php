<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom CSS styles */
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 280px;
            background-color: #343a40;
            overflow-y: auto;
            padding-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .nav-link {
            color: #fff;
            transition: background-color 0.3s, color 0.3s;
        }
        .nav-link:hover {
            background-color: #495057;
            color: #fff;
        }
        .content {
            margin-left: 300px;
            padding: 20px;
        }
        .module-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
        }
        .module-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .module-title {
            color: #343a40;
            font-size: 24px;
            font-weight: bold;
        }
        .chapter-item {
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
            background-color: #f9f9f9;
        }
        .chapter-item:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #f1f1f1;
        }
        .chapter-title {
            font-weight: bold;
            color: #343a40;
        }
        .page-title {
            color: #343a40;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: bold;
        }
        .sidebar-brand {
            font-size: 28px;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }
        .sidebar-brand:hover {
            color: #ccc;
        }
        .alert {
            transition: opacity 0.3s, transform 0.3s;
        }
        .alert.show {
            opacity: 1;
            transform: translateY(0);
        }
        .alert.hide {
            opacity: 0;
            transform: translateY(-20px);
        }
        .chapter-btn {
            display: inline-block;
            margin-top: 10px;
            margin-right: 10px;
            padding: 10px 15px;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-warning {
            background-color: #ffc107;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar (Left side) -->
        <div class="col-md-3">
            <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white">
                <a href="/" class="sidebar-brand mb-4">Mentor Dashboard</a>
                <ul class="nav flex-column mb-auto" id="module-list">
                    <!-- Dummy data for modules -->
                    <li class="nav-item">
                        <a href="#" class="nav-link module-link" data-module-id="1">Module 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link module-link" data-module-id="2">Module 2</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link module-link" data-module-id="3">Module 3</a>
                    </li>
                </ul>
                <a class="d-flex align-items-center text-white text-decoration-none mt-auto" href="#">Sign out</a>
            </div>
        </div>

        <!-- Content (Right side) -->
        <div class="col-md-10">
            <div class="content">
                <!-- Success and Error message alerts -->
                <div class="alert alert-success" style="display: none;">Success message</div>
                <div class="alert alert-danger" style="display: none;">Error message</div>

                <!-- Modules and Chapters -->
                <div class="container mt-3">
                    <h1 class="page-title">Modules and Chapters</h1>

                    <!-- Chapter List -->
                    <div class="chapter-list" id="chapter-list" style="display: none;">
                        <!-- Chapters will be dynamically loaded here -->
                    </div>

                    <!-- Chapter Details -->
                    <div class="module-section" id="chapter-details">
                        <!-- Chapter details will be dynamically loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modules = [
            {
                id: 1,
                title: "Module 1",
                chapters: [
                    { title: "Chapter 1.1", description: "Description for Chapter 1.1" },
                    { title: "Chapter 1.2", description: "Description for Chapter 1.2" },
                    { title: "Chapter 1.3", description: "Description for Chapter 1.3" }
                ]
            },
            {
                id: 2,
                title: "Module 2",
                chapters: [
                    { title: "Chapter 2.1", description: "Description for Chapter 2.1" },
                    { title: "Chapter 2.2", description: "Description for Chapter 2.2" },
                    { title: "Chapter 2.3", description: "Description for Chapter 2.3" }
                ]
            },
            {
                id: 3,
                title: "Module 3",
                chapters: [
                    { title: "Chapter 3.1", description: "Description for Chapter 3.1" },
                    { title: "Chapter 3.2", description: "Description for Chapter 3.2" },
                    { title: "Chapter 3.3", description: "Description for Chapter 3.3" }
                ]
            }
        ];

        // Add event listeners to module links
        document.querySelectorAll('.module-link').forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const moduleId = this.getAttribute('data-module-id');
                loadChapters(moduleId);
            });
        });

        // Function to load chapters
        function loadChapters(moduleId) {
            const selectedModule = modules.find(module => module.id == moduleId);
            const chapterList = document.getElementById('chapter-list');
            chapterList.style.display = 'block'; // Show chapter list
            chapterList.innerHTML = ''; // Clear current chapters

            selectedModule.chapters.forEach(chapter => {
                const chapterItem = document.createElement('div');
                chapterItem.classList.add('chapter-item', 'col-md-12');
                chapterItem.innerHTML = `<dt class="col-sm-3 chapter-title">${chapter.title}</dt>
                                         <dd class="col-sm-9">${chapter.description}</dd>
                                         <a href="{{route('chapters')}}" target="_blank" class="chapter-btn btn-primary"><i class="fas fa-book"></i> View Chapter</a>
                                         <a href="#" target="_blank" class="chapter-btn btn-warning"><i class="fas fa-tasks"></i> Assignments</a>
                                         <a href="{{route('quiz')}}" target="_blank" class="chapter-btn btn-success"><i class="fas fa-question-circle"></i> Quiz</a>`;
                chapterList.appendChild(chapterItem);
            });
        }
    });
</script>
</body>
</html>
