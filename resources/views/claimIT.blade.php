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
<style>
    body{

    }
    .card{
        width:320px;
        height:500px;
        border-radius:20px;
        overflow:hidden;
        border:2px solid white;
        position:relative;
    }
    .card-img{
        height:3%;
        width:348px;
        object-fit:cover;
        border-radius:15px
    }
    .card-body{
        width:100%;
        height:100%;
        top:0;
        right:-100%;
        position:absolute;
        background: #1f3d4738;
        backdrop-filter:blur(5px);
        border-radius:15px;
        padding:30px;
        display:flex;
        flex-direction:column;
        justify-content:center;
        transition:2s;


    }
    .card:hover .card-body{
        right:0;
    }
    .card-title{
        text-transform:uppercase;
        font-size:40px;
        font-weight:500;
    }
    .card-sub-title{
        text-transform:capitalize;
        font-size:14px;
        font-weight:300;
    }
    .card-info{
        font-size:16px;
        line-height:25px;
        margin: 40px 0;
        font-weight:400;
    }
    .card-btn{
        color:#1f3d47;
        background:#8fabba;
        padding: 10px 20px;
        border-radius: 5px;
        text-transform: capitalize;
        border:none;
        outline:none;
        font-weight:500;
        cursor:pointer;
        width:120px
    }

</style>
<body style="background-color: rgba(96, 182, 204, 0.171);">
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
 @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h1>Items</h1>
        <br>

        <div class="row mb-4">
            <div class="col-md-12">
                <form method="GET" action="{{ route('claimIT') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search items..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
<div class="container">
    <div class="row">
        @foreach ($items as $item)
        <div class="col-md-4 mb-4">
            <div class="card" style="border-radius:50px">
                <img src="{{ Storage::url($item->image) }}" class="card-img-top" alt="Item Image" style="height:500px;width:348px;object-fit:cover;border-radius:50px 50px 0 0">
                <div class="card-body">
                    <h5 class="card-title"><b>{{ $item->name }}</b></h5>
                    <p class="card-text">{{ $item->description }}</p>
                    <p class="card-text">Date Found: <b>{{ $item->datefound }}</b></p>
                    <p class="card-text">Category: <b>{{ $item->category->name }}</b></p>
                        <p class="card-text">Location: <b>{{ $item->location->name }}</b></p>
@if ($item->status == 0)
                <form action="{{ route('claim.item', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="card-btn">ClaimIT</button>
                </form>
            @else
                <p class="text-success">Claimed by: {{ $item->user->firstname }} {{ $item->user->lastname }}</p>
            @endif             
 </div>
            </div>
        </div>
        @endforeach
    </div>
</div>




    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
  <script src="{{ asset('js/sidebar.js') }}"></script>
</html>