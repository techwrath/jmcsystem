@extends('dashboard.layout.master')
@section('content')
@section('content')
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
   
    .btn-save {
      background-color: #e53935;
      color: white;
      border-radius: 0.5rem;
    }
    .product-card {
        height: 50%;
        width: 42%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 0;
        padding: 10px;
        margin-left: -30px;
    }

    .product-info {
        display: flex;
        flex-direction: column;
        font-size: 14px;
    }

    .product-actions {
        display: flex;
        gap: 10px;
    }

    .product-actions button {
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px 10px;
        cursor: pointer;
    }

    .product-actions button:hover {
        background-color: #e0e0e0;
    }
    .product-info p {
        margin: 0; /* Remove line spacing */
        font-size: 14px;
    }

    .product-actions {
        display: flex;
        gap: 10px;
    }

  </style>
</head>
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
            <div class="top-panel">
                <h3 class="mb-0">EDIT ORDER</h3>
                <p>Please fill the following form to edit order</p>
            </div>

        <div class="top-panel">
            <form id="orderForm" action="{{ route('update.order', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="order_no" class="col-sm-2 col-form-label">Order Number: *</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="order_no" id="order_no" value="{{ $order->order_no }}" required>
                    </div>
                </div>

                <!-- Product Form Section -->
                <div class="product-item">
                    <div class="row mb-3">
                        <label for="product_type" class="col-sm-2 col-form-label">Product Type: *</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="product_type" id="product_type" style="-webkit-appearance: listbox !important;" required>
                                @foreach($products as $product)
                                    <option value="{{ $product->productName }}">{{ $product->productName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="brand" class="col-sm-2 col-form-label">Brand: *</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="brand" id="brand" style="-webkit-appearance: listbox !important;" required>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->brandName }}">{{ $brand->brandName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="weight" class="col-sm-2 col-form-label">Weight of Bag: *</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="weight" id="weight" style="-webkit-appearance: listbox !important;" required>
                                <option>Select Weight of Bag</option>
                                <option>1 X 35kg</option>
                                <option>2 X 19kg</option>
                                <option>4 X 10kg</option>
                                <option>8 X 5kg</option>
                                <option>16 X 2.5kg</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="container_count" class="col-sm-2 col-form-label">No of Containers: *</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="number" id="container_count" name="container_count" required>
                        </div>
                    </div>
                </div>

                <!-- Add Product Button -->
                <button type="button" class="btn btn-success mt-3" onclick="addProduct()">Add Product</button>
                <br>
                <br>
                <!-- Selected Products List -->
                <h5>Selected Products</h5>
                <ul id="selected-products">
                    @foreach($order->products as $product)
                        <div class="product-card">
                            <div class="product-info">
                                <p><strong>{{ $product->productType }}</strong></p>
                                <p>Brand: {{ $product->brand }}</p>
                                <p>Weight: {{ $product->weightOfBag }}</p>
                                <p>Containers: {{ $product->numberOfContainers }}</p>
                            </div>
                            <div class="product-actions">
                                <a type="button" onclick="editProduct({{ $loop->index }})" class='text-primary'><i class='fas fa-edit'></i></a>
                                <a type="button" onclick="deleteProduct({{ $loop->index }})" class='text-danger'><i class='fas fa-trash'></i></a>
                            </div>
                        </div>
                    @endforeach
                </ul>

                <!-- Update Order Button -->
                <button type="submit" class="btn btn-save mt-3">Update Order</button>
            </form>
        </div>
        </div>
    </div>
</div>

<script>
    let products = @json($order->products);

    function addProduct() {
        const productType = document.getElementById('product_type').value;
        const brand = document.getElementById('brand').value;
        const weight = document.getElementById('weight').value;
        const containerCount = document.getElementById('container_count').value;

        // Validate input fields
        if (!productType || !brand || !containerCount || !weight) {
            alert('Please fill out all fields');
            return;
        }

        // Add the product to the products array
        products.push({ productType, brand, weight, containerCount });

        // Clear the form fields
        document.getElementById('product_type').value = '';
        document.getElementById('brand').value = '';
        document.getElementById('weight').value = '';
        document.getElementById('container_count').value = '';

        // Update the product list display
        displayProducts();
    }

    function displayProducts() {
        const productList = document.getElementById('selected-products');
        productList.innerHTML = ''; // Clear the list

        products.forEach((product, index) => {
            const productHTML = `
                <div class="product-card">
                    <div class="product-info">
                        <p><strong>${product.productType}</strong></p>
                        <p>Brand: ${product.brand}</p>
                        <p>Weight: ${product.weight}</p>
                        <p>Containers: ${product.containerCount}</p>
                    </div>
                    <div class="product-actions">
                        <a type="button" onclick="editProduct(${index})" class='text-primary'><i class='fas fa-edit'></i></a>
                        <a type="button" onclick="deleteProduct(${index})" class='text-danger'><i class='fas fa-trash'></i></a>
                    </div>
                </div>`;
            productList.innerHTML += productHTML;
        });
    }

    function deleteProduct(index) {
        products.splice(index, 1); // Remove product from the array
        displayProducts(); // Refresh the product list
    }

    function editProduct(index) {
        // Get the product data from the products array
        const product = products[index];

        // Populate the form fields with the product data
        document.getElementById('product_type').value = product.productType;
        document.getElementById('brand').value = product.brand;
        document.getElementById('weight').value = product.weight;
        document.getElementById('container_count').value = product.containerCount;

        // Remove the product from the array, so it can be updated
        products.splice(index, 1);

        // Refresh the product list display
        displayProducts();

        // Optionally, you can set a flag to indicate that the form is in edit mode
    }
</script>

@endsection
