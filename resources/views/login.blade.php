<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forstu Mentorship login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        }

    </style>
<body>



<div class="login-container mt-3">

  <form action="{{route('logged')}}"  id="loginform" method="post">
    @csrf
    
    <h2>Login In</h2>

      <input type="text" id="username" class="form-control" placeholder="Enter email" name="username" required>

      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    
    <button type="submit" class="btn btn-primary">Submit</button> 

    </form>
</br>
    <a href= "{{route('register2')}}" class="text-decoration-none">Mentor</a> ---------
    <a href= "{{route('register1')}}" class="text-decoration-none">Mentee</a>
    <br>
    <a href= "{{route('admin')}}" class="text-decoration-none">Admin</a>
    
    

</div>
</body>
</html>