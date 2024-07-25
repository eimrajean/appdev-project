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
                <a href="/home">
                    <i class='bx bx-home bx-sm'></i>
                    <span class="text">Home</span>
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

        <h1>Edit Item</h1>
        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Item Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ $item->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="location_id">Location</label>
                <select class="form-control" id="location_id" name="location_id" required>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ $item->location_id == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="datefound">Date Found</label>
                <input type="date" class="form-control" id="datefound" name="datefound" value="{{ $item->datefound }}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @if ($item->image)
                    <img src="{{ Storage::url($item->image) }}" alt="Item Image" width="100" class="mt-2">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update Item</button>
        </form>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
  <script src="{{ asset('js/sidebar.js') }}"></script>
</html>
