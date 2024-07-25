

<!DOCTYPE html>
<html>
<head>
	<title>ClaimIT</title>
    <link rel="stylesheet" href="{{ asset('css/login2.css') }}" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <img src="{{ asset('images/wave.png') }}" alt="" class="wave">
	<div class="container" >
		<div class="img">
            <img src="{{ asset('images/bg.svg') }}" alt="">
		</div>
		<div class="login-content">
      <form method="POST" action={{ route('register') }}>
                @csrf
              
				<h2 class="title">WELCOME!</h2>

        <div class="input-div one">
          <div class="i">
              <i class="fas fa-user"></i>
          </div>
          <div class="div">
          
              <input type="text" class="input" name="firstname" placeholder="First Name" value="{{ old('firstname') }}"/>
                    </div>
       </div>
       <div class="input-div one">
        <div class="i">
            <i class="fas fa-user"></i>
        </div>
        <div class="div">
           
            <input type="text" class="input" name="lastname" placeholder="Last Name" value="{{ old('lastname') }}"/>
          </div>
     </div>


           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   	
                      <input type="email" class="input" name="email" placeholder="Email" value="{{ old('email') }}" />
                    </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    
                     <input type="password" class="input" name="password" placeholder="Password"  value="{{ old('password') }}" />
                    </div>
            	</div> 
              <div class="input-div pass">
                <div class="i"> 
                   <i class="fas fa-lock"></i>
                </div>
                <div class="div">
               
                   <input type="password" class="input" name="password_confirmation" placeholder="Confirm Password"/>
                  </div>
            </div>  
              
            	
                <input type="submit" name="submit" value="Login" class="btn solid" />
              
            </form>
            <br>
            <div style="display: flex;position:absolute;margin-top:570px;margin-left:50px">
                <p>Have an account? </p>
                <a href={{ route('login') }} style="margin-left:5px;margin-top:3px">Login</a>
            </div>
        </div>
       
    </div>
    <script src="{{ asset('js/js.js') }}"></script>
</body>
</html>
