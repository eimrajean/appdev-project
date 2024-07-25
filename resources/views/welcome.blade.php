
<!DOCTYPE html>
<html>
<head>
	<title>ClaimIT</title>
    <link rel="stylesheet" href="{{ asset('css/login2.css') }}" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <style>
       
        body {
            font-family: 'figtree', sans-serif;
            /* background-image: url('background.png'); */
           
            background-size: cover;
            background-position: center;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #3182ce;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #2c5282;
        }

        .btn-secondary {
            background-color: #f56565;
        }

        .btn-secondary:hover {
            background-color: #e53e3e;
        }
    </style>
    <img src="{{ asset('images/wave.png') }}" alt="" class="wave">
	<div class="container" >
		<div class="img">
            <img src="{{ asset('images/bg.svg') }}" alt="">
		</div>
		<div class="login-content">
            
            <div style="display:flex;position:absolute;top:70px;margin-left:130px">
                <h1 style="position:absolute;top:140px;display:flex;color:green;margin-left:30px">Claim <span style="color:blue">IT</span></h1>
                 <i class='bx bx-game bx-sm'></i><img src="{{ asset('images/avatar.svg') }}" alt="" style="height:130px"> <br>
           
            </div>
             <p class="text-xl mt-4" style="font-size:35px">Find what you've <span style="color:red">lost</span>, <br> recover what you've <span style="color:green">found</span></p>
           
            <div class="flex justify-center items-center">
               
                    <div class="fixed p-6 text-right z-10" style="position:absolute;margin-top:30px;margin-right:100px">
               
                            <a href="{{ route('login') }}" class="btn">Log in</a>
            
                           
                                <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                          
                    </div>
              
            
             
            </div>
         
        </div>
       
    </div>
    <script src="{{ asset('js/js.js') }}"></script>
</body>
</html>
