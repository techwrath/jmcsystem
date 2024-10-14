@extends('dashboard.layout.master')
@section('content')


     <!-- /.content-header -->

    <!-- Main content -->
<head>
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container {
    }
    .top-panel {
      background-color: white;
      padding: 15px;
      margin-top: 5px;
      margin-bottom: 5px;
      border: 1px solid #ddd;
    }
    .form-panel {
      border: 1px solid #ddd;
      padding: 20px;
      background-color: #ffffff;
    }
    .form-label {
      font-weight: bold;
    }
    .form-control {
      border-radius: 0.5rem;
    }
    .image-preview-wrapper {
      position: relative;
      width: 150px;
      height: 150px;
      border: 1px solid #ddd;
      border-radius: 0.5rem;
      background-color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 10px;
    }
    .image-preview img {
      width: 150px;
      height: 150px;
      border-radius: 0.5rem;
    }
    .remove-image {
      position: absolute;
      top: -10px;
      right: -10px;
      background-color: #ff6b6b;
      color: white;
      border: none;
      border-radius: 50%;
      width: 25px;
      height: 25px;
      font-size: 14px;
      cursor: pointer;
      display: none;
    }
    .btn-save {
      background-color: #e53935;
      color: white;
      border-radius: 0.5rem;
    }
  </style>
</head>
<body>
  <div class="container">
        @if ($errors->any())
            <div class="row mb-3">
                <div class="col-md-12 alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                        {{ $errors->first() }}
                </div>
            </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('success') }}
        </div>
        @endif
    <div class="row">
      
      <div class="col-md-12">
        <!-- Top Panel -->
        <div class="top-panel">
          <h3 class="mb-0">ADD USER</h3>
          <p>Please fill the following form to add a new user</p>
        </div>

       <div class="form-panel"> 
        <form method="post" action="{{route('addUser')}}" enctype="multipart/form-data">
        @csrf
         <div class="row">
            
            <div class="col-auto">
                <label for="inputField" class="col-form-label">First Name: *</label>
            </div>
            <div class="col-auto w-25">
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
           
           </div>
           <br>
           <div class="row">
           
            <div class="col-auto">
                <label for="inputField" class="col-form-label">Last Name: *</label>
            </div>
            <div class="col-auto w-25">
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
          
           </div> 
           <br>
          <div class="row">
            <div class="col-auto">
                <label for="email" class="col-form-label">Email: *&nbsp &nbsp &nbsp &nbsp &nbsp</label>
            </div>
            <div class="col-auto w-25">
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
           </div>
           <br>
           <div class="row">
            <div class="col-auto">
                <label for="password" class="col-form-label">Password: *&nbsp &nbsp </label>
            </div>
            <div class="col-auto w-25">
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
           </div>
         
          <button type="submit" class="btn btn-save mt-3">Save User</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>


@endsection
