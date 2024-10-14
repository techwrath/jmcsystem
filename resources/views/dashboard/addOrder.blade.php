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
          <h3 class="mb-0">ADD NEW ORDER</h3>
          <p>Please fill the following form to add a new order</p>
        </div>

       <div class="form-panel"> 
        <form method="post" action="{{route('store.customer')}}" enctype="multipart/form-data">
        @csrf
         <div class="row mb-3">
            <label for="inputField" class="col-sm-2 col-form-label">Order Number: *</label>
           
            <div class="col-sm-3">
                <input type="text" class="form-control" id="orderNumber" name="orderNumber" required>
            </div>
           
         </div>
           
           <br>
           <div class="row mb-3">
            
                <label for="productBrand" class="col-sm-2 col-form-label">Poduct Type: *</label>
            <div class="col-sm-3">
                <select class="form-control" id="productBrand" name="productBrand" style="-webkit-appearance: listbox !important;" placeholder="Select Brand" required >
                        <option value="" class="text-muted">Select Product</option> 
                    @foreach ($products as $product)
                       <option value="{{$product->brandName}}">{{$product->productName}}</option>
                    @endforeach
                </select>
            </div>
           </div>
           <br>
           <div class="row mb-3">
            
                <label for="productBrand" class="col-sm-2 col-form-label">Brand: *</label>
            
            <div class="col-sm-3">
                <select class="form-control" id="productBrand" name="productBrand" style="-webkit-appearance: listbox !important;" placeholder="Select Brand" required >
                        <option value="" class="text-muted">Select Brand</option> 
                    @foreach ($brands as $brand)
                       <option value="{{$brand->brandName}}">{{$brand->brandName}}</option>
                    @endforeach
                </select>
            </div>
           </div>
            <br>

           
           <div class="row mb-3">
            
                <label for="productBrand" class="col-sm-2 col-form-label">Weight of Bag: *</label>
            
            <div class="col-sm-3">
                <select class="form-control" id="productBrand" name="productBrand" style="-webkit-appearance: listbox !important;" placeholder="Select Brand" required >
                        <option value="" class="text-muted">Select Weight of Bag</option> 
                   
                       <option>1 X 35kg</option>
                       <option>2 X 19kg</option>
                       <option>4 X 10kg</option>
                       <option>8 X 5kg</option>
                       <option>16 X 2.5kg</option>
                      
                   
                </select>
            </div>
           </div>
           <br>
            <div class="row mb-3">
           
                   <label for="inputField" class="col-sm-2 col-form-label">No of Containers: *</label>
                 <div class="col-sm-3">
                    <input type="number" class="form-control" id="numberOfContainers" name="numberOfContainers" required>
                </div>
     
            </div> 
            <br>

            <h4>Selected Products</h4>
                <ul id="selected-products-list">
                    <!-- Selected products will appear here dynamically -->
                </ul>
         
          <button type="submit" class="btn btn-save mt-3">Save Order</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>


@endsection
