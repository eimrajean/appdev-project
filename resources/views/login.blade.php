
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
    <img src="{{ asset('images/wave.png') }}" alt="" class="wave">
	<div class="container" >
		<div class="img">
            <img src="{{ asset('images/bg.svg') }}" alt="">
		</div>
		<div class="login-content">
			<form method="POST" action="{{ route('login') }}">
                @csrf
                <i class='bx bx-game bx-sm'></i><img src="{{ asset('images/avatar.svg') }}" alt=""> 
                <h2 style="position:absolute;top:80px;display:flex;color:green">Claim <span style="color:blue">IT</span></h2>

           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		
                              <input type="email" name="email" placeholder="Email" class="input" value="{{ old('email') }}" required />
                            </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	
                           <input type="password" class="input" name="password" placeholder="Password" required />
                        </div>
            	</div>  
              
            	
                <input type="submit" name="submit" value="Login" class="btn solid" />
              
            </form>
            <br>
            <div style="display: flex;position:absolute;margin-top:450px;margin-left:50px">
                <p>Don't have an account? </p>
                <a href="{{ route('register') }}" style="margin-left:5px;margin-top:3px">Sign up</a>
            </div>
        </div>
       
    </div>
    <script src="{{ asset('js/js.js') }}"></script>
</body>
</html>