<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Management</title>
     <link rel="stylesheet" href="{{ asset('css/page.css') }}" />
    <!-- Bootstrap CSS -->
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: rgba(96, 182, 204, 0.171);">

    <style>
        .card-header {
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
}

.card-body {
    padding: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}
    </style>
    <section id="sidebar" class="hide" style="background-color:#49f064d2">
       
        <ul class="side-menu top">
          
<li></li>
<li></li>

             <li>
                <a href="/home">
                    <i class='bx bx-home bx-sm'></i>
                    <span class="text">Home</span>
                </a>
            </li>

@unless (auth()->user()->role == 1)
<li>
    <a href="/claimIT">
        <i class='bx bx-game bx-sm'></i>
        <span class="text">ClaimIT</span>
    </a>
</li>

<li>
    <a href="/claimeditems">
        <i class='bx bxs-briefcase bx-sm'></i>
        <span class="text">Claimed Items</span>
    </a>
</li>

            @endunless 

             <li>
                <a href="/profile">
                    <i class='bx bx-user-circle bx-sm'></i>
                    <span class="text">Profile</span>
                </a>
            </li>
           

           
           
        </ul>
        <ul class="side-menu">
           
           
          
            <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                
                <a href="/login" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class='bx bx-log-out bx-sm'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav >
            <i class='bx bx-menu bx-sm'></i>
            <h1 style="display:flex;color:green"> <i class='bx bx-game bx-sm'></i>Claim <span style="color:blue">IT</span></h1>


            <form action="#">
                <div class="form-input">

                </div>
            </form>


        </nav>
        <main>

    
            <h1>Profile</h1>
            <br>

   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Profile') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname', $user->firstname) }}" required autofocus>

                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname', $user->lastname) }}" required>

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Add more fields here if needed -->

                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
  <script src="{{ asset('js/sidebar.js') }}"></script>
</html>