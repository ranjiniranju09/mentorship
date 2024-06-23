<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forstu Mentorship login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<title></title>
    <style>
        input {
            width:100%;
            padding: 15px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: none;
            outline: none;
            border:1px;
            border-radius: 5px;
            background-color: transparent;
            color: #fff;
        }
        button {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: none;
            border-radius: 4px;
            background-color: #e50914;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            margin-top: 5%;
        }
        body{
            font-family: arial, sans-serif;
            /* background-image: url('/Downloads/bg1.jpg'); */
            background-color: burlywood;
            background-size: cover;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .login-container{
            background-color: black;
            padding: 5%;
            border-radius: 8px;
            text-align: center;           
            max-width: 400px;
            height: 55%;
            width: 100%;
            border: 0.5px solid white;
            box-shadow: #000;
        }
        .input-group {
            position: relative;
        }
        .input-group .form-control {
            padding-right: 2.5rem;
        }
        .input-group-append {
            position: absolute;
            right: 5px;
            top: 35%;
            transform: translateY(-50%);
            cursor: pointer;
            background: transparent;
            border: none;
        }
        .input-group-text {
            background: transparent;
            border: none;
        }
        .input-group-text i {
            font-size: 1.2rem; /* Adjust icon size as needed */
            color: #6c757d; /* Adjust icon color as needed */
        }
    </style>
<body>
<div class="login-container mt-3">
        <form action="{{route('logged')}}" id="loginform" method="post">
            @csrf
            <span><h2>Login In</h2></span>

            <input type="text" id="username" class="form-control" placeholder="Enter email" name="username" required>

            <div class="input-group mb-3">
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                <div class="input-group-append">
                    <span class="input-group-text" id="togglePassword">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
        <a href="{{route('register2')}}" class="text-decoration-none">Mentor</a> ---------
        <a href="{{route('register1')}}" class="text-decoration-none">Mentee</a>
        <br>
        <a href="{{route('admin')}}" class="text-decoration-none">Admin</a>
    </div>

     <!-- Bootstrap Icons JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <!-- JavaScript to toggle password visibility -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>


</body>
</html>