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
          <h3 class="mb-0">EDIT PRODUCT</h3>
          <p>Please fill the following form to edit a product</p>
        </div>

       <div class="form-panel"> 
        <form method="post" action="{{route('updateProduct', $product->id)}}" enctype="multipart/form-data">
        @csrf
         <div class="row">
            
            <div class="col-auto">
                <label for="inputField" class="col-form-label">Poduct Code: *&nbsp</label>
            </div>
            <div class="col-auto w-25">
                <input type="text" class="form-control" id="productCode" name="productCode" value="{{ old('productCode', $product->productCode) }}" required>
            </div>
           
           </div>
           <br>
           <div class="row">
           
            <div class="col-auto">
                <label for="inputField" class="col-form-label">Poduct Name: *</label>
            </div>
            <div class="col-auto w-25">
                <input type="text" class="form-control" id="productName" name="productName" value="{{ old('productName', $product->productName) }}" required>
            </div>
          
           </div> 
           <br>
          <div class="row">
            <div class="col-auto">
                <label for="productBrand" class="col-form-label">Poduct Brand: *</label>
            </div>
            <div class="col-auto w-25">
                <select class="form-control" id="productBrand" name="productBrand" style="-webkit-appearance: listbox !important;" value="{{ old('productBrand', $product->productBrand) }}" required>
                   <option value="">Select Brand</option>
                    @foreach ($brands as $brand)
                       <option value="Select Brand">{{$brand->brandName}}</option>
                    @endforeach
                </select>
            </div>
           </div>
           
           <br>
          <div class="mb-3 w-50">
            <label for="productDescription" class="form-label">Product Description: *</label>
            <textarea class="form-control" id="productDescription" name="productDescription" rows="5" maxlength="1000" required>{{ old('productDescription', $product->productDescription) }}</textarea>
          </div>
          <div class ="row">
          @if($product->productImage)
            <div style="margin-top: 10px;">
                <label>Current Brand Logo:</label>
                <img src="{{ asset('dist/img/' . $product->productImage) }}" alt="Brand Logo" style="width:100px; height:100px;">
            </div>
          @endif
          </div>
          <div class="row">
            <div class="col-auto">
                <label for="inputField" class="col-form-label">Change Brand Logo: *</label>
            </div>
            <div class="col-auto w-25">
            <input class="form-control" type="file" id="productImage" name="productImage" accept="dist/img/*" value="{{ old('productImage', $product->productImage) }}">
            </div>
           </div>
         
           <div class="image-preview-wrapper" id="imagePreviewWrapper">
              <div class="image-preview text-center" id="imagePreview">
                <span >Uploaded Image Preview</span>
              </div>
              <button type="button" class="remove-image" id="removeImage">&times;</button>
            </div>
          <button type="submit" class="btn btn-save mt-3">Save Product</button>
        </form>
        </div>
      </div>
    </div>
  </div>

   <script>
    const productLogoInput = document.getElementById('productImage');
    const imagePreview = document.getElementById('imagePreview');
    const removeImageButton = document.getElementById('removeImage');

    productLogoInput.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
          const imgElement = document.createElement('img');
          imgElement.src = event.target.result;
          imagePreview.innerHTML = '';
          imagePreview.appendChild(imgElement);
          removeImageButton.style.display = 'block'; // Show the remove button
        };
        reader.readAsDataURL(file);
      }
    });

    removeImageButton.addEventListener('click', function() {
      productLogoInput.value = ''; // Clear the input
      imagePreview.innerHTML = '<span>Uploaded Image Preview</span>'; // Reset the preview
      removeImageButton.style.display = 'none'; // Hide the remove button
    });
  </script>
</body>
</html>


@endsection
