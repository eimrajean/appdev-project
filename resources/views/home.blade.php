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
    .badge-success {
    background-color: #28a745;
    color: white;
}

/* Styles for Not Claimed status */
.badge-secondary {
    background-color: #6c757d;
    color: white;
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
            @unless (auth()->user()->role == 1)
           
                <div class="order bg-white bg-opacity-25 rounded-lg" style="margin:20px;padding:80px">
                    <div class="head text-center">
                        <img src="{{ asset('images/avatar.svg') }}" alt="" style="height:100px"> 
                        <h1 class="text-3xl">Welcome, {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}!</h1><br>
                        <h3 class="text-xl mb-6"style="padding-bottom:20px">Did you lost something?</h3>
                        <a href="/claimIT" class="text-white text-xl px-6 py-2 rounded-md inline-block" style="background-color: #1c40b8b4; width: 180px;padding:20px;border-radius:5px">Claim IT</a>
                    
                        </div>
                </div>
                
       
            @endunless

@unless (auth()->user()->role == 0)
    
    <div class="container mt-5">
        <!-- Flash Messages -->
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

        @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-12">
                <form method="GET" action="{{ route('home') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search items..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <!-- Button to open the Add Item Modal -->
                <button type="button" class="btn btn-primary float-left mb-3" data-toggle="modal" data-target="#addItemModal">
                    Add Item
                </button>
                <br>
                <br>
                
                <!-- Items List -->
                <h2 class="text-left">Items List</h2>
                <table class="table"  style="width:1100px">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th>Date Found</th>
                            <th>Status</th>
                            <th>Claimed By</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td  style="width:100px">{{ $item->description }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->location->name }}</td>
                                <td  style="width:100px">{{ $item->datefound }}</td>
                                <td>
                                    @if($item->status == 1)
                                        <span class="badge badge-success">Claimed</span>
                                    @else
                                        <span class="badge badge-secondary">Not Claimed</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == 1 && $item->user)
                                        {{ $item->user->firstname }} {{ $item->user->lastname }}
                                    @endif
                                </td>
                                <td  style="width:100px"><img src="{{ Storage::url($item->image) }}" alt="Item Image" width="100" height="100" style="object-fit:cover"></td>
                                <td>
                                    <div style="display:flex;gap:5px">
 <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    </div>
                                   
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Item Modal -->
    <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Add Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Item Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                       <div class="form-group">
    <label for="category_id">Category</label>
    <select class="form-control" id="category_id" name="category_id" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="location_id">Location</label>
    <select class="form-control" id="location_id" name="location_id" required>
        @foreach($locations as $location)
            <option value="{{ $location->id }}">{{ $location->name }}</option>
        @endforeach
    </select>
</div>
                        <div class="form-group">
                            <label for="datefound">Date Found</label>
                            <input type="date" class="form-control" id="datefound" name="datefound" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endunless

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
  <script src="{{ asset('js/sidebar.js') }}"></script>
</html>