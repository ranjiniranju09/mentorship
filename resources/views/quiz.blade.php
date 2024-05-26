<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
        .quiz-container {
            margin-top: 50px;
            margin-bottom: 50px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .quiz-title {
            margin-bottom: 20px;
            text-align: center;
            color: #343a40;
        }
        .quiz-question {
            margin-bottom: 20px;
        }
        .quiz-option {
            margin-bottom: 10px;
        }
        .quiz-option input[type="radio"] {
            margin-right: 10px;
        }
        .btn-group {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .submit-btn, .back-btn {
            width: 48%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .submit-btn {
            background-color: #007bff;
            color: #fff;
        }
        .submit-btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .back-btn {
            background-color: #6c757d;
            color: #fff;
        }
        .back-btn:hover {
            background-color: #5a6268;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-md-8 offset-md-2 quiz-container">
            <h2 class="quiz-title">Quiz Title</h2>
            <form method="POST" action="#">
                @csrf
                <!-- Question 1 -->
                <div class="quiz-question">
                    <h5>Question 1: What is the capital of France?</h5>
                    <div class="quiz-option">
                        <input type="radio" id="q1a" name="question1" value="Paris">
                        <label for="q1a">Paris</label>
                    </div>
                    <div class="quiz-option">
                        <input type="radio" id="q1b" name="question1" value="London">
                        <label for="q1b">London</label>
                    </div>
                    <div class="quiz-option">
                        <input type="radio" id="q1c" name="question1" value="Berlin">
                        <label for="q1c">Berlin</label>
                    </div>
                    <div class="quiz-option">
                        <input type="radio" id="q1d" name="question1" value="Madrid">
                        <label for="q1d">Madrid</label>
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="quiz-question">
                    <h5>Question 2: Which planet is known as the Red Planet?</h5>
                    <div class="quiz-option">
                        <input type="radio" id="q2a" name="question2" value="Mars">
                        <label for="q2a">Mars</label>
                    </div>
                    <div class="quiz-option">
                        <input type="radio" id="q2b" name="question2" value="Venus">
                        <label for="q2b">Venus</label>
                    </div>
                    <div class="quiz-option">
                        <input type="radio" id="q2c" name="question2" value="Jupiter">
                        <label for="q2c">Jupiter</label>
                    </div>
                    <div class="quiz-option">
                        <input type="radio" id="q2d" name="question2" value="Saturn">
                        <label for="q2d">Saturn</label>
                    </div>
                </div>

                <!-- Button Group -->
                <div class="btn-group">
                    <button type="button" class="back-btn" onclick="history.back()">Back</button>
                    <button type="submit" class="submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
