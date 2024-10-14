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
          <h3 class="mb-0">ADD CUSTOMER</h3>
          <p>Please fill the following form to add a new customer</p>
        </div>

       <div class="form-panel"> 
        <form method="post" action="{{route('store.customer')}}" enctype="multipart/form-data">
        @csrf
         <div class="row mb-3">
            <label for="inputField" class="col-sm-2 col-form-label">Customer Number: *</label>
           
            <div class="col-sm-3">
                <input type="text" class="form-control" id="customerNumber" name="customerNumber" required>
            </div>
           
         </div>
           <br>
           <div class="row mb-3">
           
                <label for="inputField" class="col-sm-2 col-form-label">Customer Name: *</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="customerName" name="customerName" required>
            </div>
          
           </div> 
           <br>
           <div class="row mb-3">
                <label for="phoneNumber" class="col-sm-2 col-form-label">Phone Number: *</label>
            <div class="col-sm-3">
                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
            </div>
           </div>
           <br>
           <div class="row mb-3">
                <label for="inputField" class="col-sm-2 col-form-label">Area Code: *</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="areaCode" name="areaCode" required>
            </div>
          
           </div> 
            <br>
           <div class="row mb-3">
                <label for="status" class="col-sm-2 col-form-label">Status: *</label>
        
            <div class="col-sm-3">
                <select class="form-control" id="status" name="status" style="-webkit-appearance: listbox !important;">
                    <option value="active" selected>Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
           </div>
         
          <button type="submit" class="btn btn-save mt-3">Save Customer</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>


@endsection
