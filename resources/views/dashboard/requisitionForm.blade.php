@extends('dashboard.layout.master')
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
        width: 50%;
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

    .select2-container {
    position: relative;
    width: 300px; /* Adjust width as needed */
}

    .select2-container .select2-selection--single {
        height: 38px;
        padding: 5px 10px;
        box-sizing: border-box;
        border: 1px solid #dee2e6;
        border-radius: 8px;
    }

    .select2-search--dropdown .select2-search__field {
        padding-left: 30px; /* Add padding for search icon */
    }

    .select2-search--dropdown::before {
        content: '\f002'; /* Unicode for search icon if using Font Awesome */
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        left: 10px;
        top: 10px;
        color: #aaa;
    }
    .summary-section {
      width: 25%;
      border: 1px solid #ddd;
      padding: 20px;
      background-color: #f9f9f9;
      position: fixed;
      right: 150px;
      top: 190px;
      border-radius: 8px;
    }
    .summary-header {
      font-weight: bold;
      margin-bottom: 10px;
    }
    .display-quantity {
      font-size: 14px;
      margin-bottom: 10px;
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
                
                    <div class="top-panel">
                        <h3 class="mb-0">Requisition Form </h3>
                        <p>Please fill the following form</p>
                    </div>
                    <div class="top-panel">
                        <form id="requisitionForm" action="{{route('store.order')}}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                   <label for="userName" class="col-sm-2 col-form-label">First Name: *</label>
                                 <div class="col-sm-4">
                                   <input class="form-control" type="text" name="userName" id="userName" value="{{ Auth::user()->firstName." ". Auth::user()->lastName}}" disabled>
                                 </div>
                               
                            </div>

                            <div class="row mb-3">
                                   <label for="date" class="col-sm-2 col-form-label">Date: *</label>
                                 <div class="col-sm-4">
                                    <input class="form-control" type="date" name="date" id="date" min="{{ date('Y-m-d') }}">
                                 </div>
                               
                            </div>
                           
                            <!-- Add Products Section -->
                            <div id="product-section">
                                <div class="product-item">
                                  <div class="row mb-3">
                                      <label for="product_type" class="col-sm-2 col-form-label">Product: *</label>
                                       <div class="col-sm-4">
                                            <select class="form-control select2" name="product_type" id="product_type" style="-webkit-appearance: listbox !important;" placeholder="Select Brand" required>
                                               <option value="">Select Product</option>
                                               @foreach ($products as $product)
                                                  <option value="{{ $product->id }}" data-brand="{{ $product->productBrand }}"  data-weight="{{ $product->weightOfBag }}">
                                                    {{ $product->productType }} -  {{ $product->productBrand }} - {{ $product->productName }} - {{ $product->weightOfBag }}kg - (10)
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                   </div>
                                  
                                   <div class="row mb-3">
                                           <label for="inputField" class="col-sm-2 col-form-label">Quantity: *</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="number" id="quantity" name="quantity" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button to Add Product to the List -->
                            <button type="button" id="addProductBtn" class="btn btn-primary mt-3" onclick="addProduct()">Add Product</button>
                             <br>
                             <br>
                            <!-- Selected Products List -->
                            <h5>Selected Products</h5>
                            <ul id="selected-products"></ul>
                            
                            <!-- Complete Order Button -->
                            <button  type="submit" class="btn btn-save mt-3" id="completeOrderButton">Submit Form</button>
                            <button  type="submit" class="btn btn-save mt-3" id="completeOrderButton">Save As Draft</button>


                        </form>
                    </div>
                    <div class="summary-section">
                        <h5 class="summary-header">Summary</h5>
                        <ul id="total-quantity"></ul>
                        <p id="master-bags"></p>
                    </div>
                          
                
            </div>
           
        </div>
</div>
<script>
    let products = [];
   
    function addProduct() {
        // Capture the product details from the form fields
        const userName = document.getElementById('userName').value;
        const date = document.getElementById('date').value;
        const productType = document.getElementById('product_type').value;
        const productTypeName = document.querySelector(`#product_type option[value="${productType}"]`).textContent;
        const productBrand = document.querySelector(`#product_type option[value="${productType}"]`).dataset.brand;
        const productWeight = parseFloat(document.querySelector(`#product_type option[value="${productType}"]`).dataset.weight);
        const quantity = parseInt(document.getElementById('quantity').value);
        
        //const totalQuantity +=quantity;
       console.log(products);
        // Validate input fields
        if (!date || !userName || !productType || !quantity) {
            alert('Please fill out all fields');
            return;
        }

        // Add the product to the products array
        products.push({ userName, date,  productType, productTypeName, productBrand, quantity, productWeight});

        // Clear the form fields
        // document.getElementById('date').value = date;
        // document.getElementById('product_type').value = '';
        // document.getElementById('quantity').value = '';
    

        // Update the product list display
        displayProducts();
        updateTotalQuantity();
    }

    function displayProducts() {
        const quantity = document.getElementById('quantity').value;
        const productList = document.getElementById('selected-products');
        productList.innerHTML = ''; // Clear the list

        products.forEach((product, index) => {
            const productHTML = `
                <div class="product-card">
                    <div class="product-info">
                        <p><strong>Product:</strong> ${product.productTypeName}</p>
                        <p><strong>Quantity:</strong> ${product.quantity}</p>
                    </div>
                    <div class="product-actions">
                        <a type="button" onclick="editProduct(${index})" class='text-primary'><i class='fas fa-edit'></i></a>
                        <a type="button" onclick="deleteProduct(${index})" class='text-danger'><i class='fas fa-trash'></i></a>
                    </div>
                   
                </div>`
                productList.innerHTML += productHTML;
               
        });
    }

function updateTotalQuantity() {
    let brandWeightQuantities = {};

    // Loop through products and group by brand and weight, summing their quantities
    products.forEach(product => {
        const key = `${product.productBrand}_${product.productWeight}`; // Combine brand and weight as a key

        // Check if the combination of brand and weight exists already
        if (!brandWeightQuantities[key]) {
            brandWeightQuantities[key] = {
                brand: product.productBrand,
                weight: product.productWeight,
                totalQuantity: 0
            };
        }


        // Sum the quantities for products with the same brand and weight
        brandWeightQuantities[key].totalQuantity += product.quantity;
    });
   
    // Display the total quantity for each brand and weight
    const totalQuantityDisplay = document.getElementById('total-quantity');
    totalQuantityDisplay.innerHTML = ''; // Clear the previous display

    // Loop through the grouped brand-weight combinations and display the total quantity
    for (let key in brandWeightQuantities) {
        const { brand, weight, totalQuantity } = brandWeightQuantities[key];
        totalQuantityDisplay.innerHTML += `
            <div class='display-quantity'>
                <strong>Brand:</strong> ${brand}
                <br>
                <strong> Weight Of Bag: </strong>${weight}kg 
                <br>
                <strong> Total Units: </strong>  ${totalQuantity}
                <br>
                <strong>Master Bags: </strong>${totalQuantity} 
                
            </div>
            <br>
            `;
    }

    const masterBagsDisplay = document.getElementById('master-bags');
    masterBagsDisplay.innerHTML = `<p><strong>Total Master Bags: </strong>4`;
}



function editProduct(index) {
    
    // Populate the form with the selected product for editing
    const product = products[index];
    document.getElementById('order_no').value = product.orderNo;
    document.getElementById('product_type').value = product.productType;
    document.getElementById('brand').value = product.brand;
    document.getElementById('container_count').value = product.containerCount;
    document.getElementById('weight').value = product.weight;

    // Set editing index to the current product
    //editingIndex = index;
    products.splice(index,1);
}
function deleteProduct(index) {
        products.splice(index, 1); // Remove product from the array
        displayProducts(); // Refresh the product list
}


$(document).ready(function() {
    // Initial Select2 initialization
    initializeSelect2();

    // Example of reinitializing after AJAX or form submission
   
});
$(document).on('click', '#addProductBtn', function() {
  
     $('#product_type').val(null).trigger('change');
     $('#quantity').val(null).trigger('change');
      //  reinitializeSelect2(); // Reinitialize Select2
    });
function initializeSelect2() {
    $('#product_type').select2({
        placeholder: 'Search Product',
       
    });
}
function reinitializeSelect2() {
        $('#product_type').select2({
            placeholder: "Select Product",
        });
    }
</script>
</body>
@endsection