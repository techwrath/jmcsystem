$(document).ready(function () {
   
    $("#addProductBtn").on("click", function () {
        event.preventDefault();
        $("#addProductModal").modal("show");
    });

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#addProductForm").on("submit", function (event) {
        event.preventDefault();
        let formData = new FormData($("#addProductForm")[0]);

        $.ajax({
            type: "POST",
            url: "addProduct",
            enctype: "multipart/form-data",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                alert("Product Added Successfully");
                $("#addProductModal").modal("hide");
                dataTable.ajax.reload();
            },
            error: function (error) {
                alert("Error creating profile");
            },
        });
    });
});



    $(document).ready(function () {
   
    
        $('body').on('click','#deleteBtn', function () {
            $('#deleteProductModal').modal('show');
            var id = $(this).data('id');
            deleteProduct(id);
        }); 
    
    
    function deleteProduct(productId){
      
        $('#deleteUserModal').modal('show');
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.confirmDeleteBtn').on('click', function () {
            
            $.ajax({
                url: 'delete/' + productId,
                type: 'DELETE',
                success: function (response) {
                    alert('Product deleted successfully');
                    var table = $('#productsTable').DataTable();
                    table.draw();
                    $('#deleteUserModal').modal('hide');
                },
                error: function (error) {
                    console.error('Error deleting user:', error);
                }
            });
        });
    }
    });


    $(document).ready(function () {
   
    
        $('body').on('click','#editProductBtn', function () {
            $('#editProductModal').modal('show');
            var id = $(this).data('id');
            getProduct(id);
        }); 
    
    
    function getProduct(productId){
      
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'getProduct/' + productId,
            type: 'GET',
            dataType:'json',
           
            success: function(response) {
               console.log(response);
               $('#productName').val(response.productName);
               $('#productDescription').val(response.productDescription);
               $('#productBrand').val(response.productBrand);
               $('#productImage').val(response.productImage);
             $("#editProductModal").modal("show");
            },
            error: function() {
                console.error('Error fetching user details:',error)
            }
        });
    }
    });

    $(document).ready(function () {
   
    
        $('body').on('click','#notificationBtn', function () {
            $('#changePasswordModal').modal('show');
            var id = $(this).data('id');
            notification(id);
            
        }); 
    
    
    function notification(notificationId){
      
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: 'getNotification/' + notificationId,
            type: 'GET',
            dataType:'json',
           
            success: function(response) {
               console.log(response);
               $('#senderEmail').val(response.senderEmail);
              
             $("#changePasswordModal").modal("show");
            },
            error: function() {
                console.error('Error fetching user details:',error)
            }
        });

        $("#changePasswordForm").on("submit", function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
    
            $.ajax({
                type: "POST",
                url: "changePassword/" + notificationId,
                data: formData,
                success: function (response) {
                    alert("Password Updated Successfully");
                    $("#changePasswordModal").modal("hide");
                },
                error: function (error) {
                    alert("Error Updating Password");
                },
            });
        });
    }
    });

    $(document).ready(function () {
   
    
        $('body').on('click','#deleteBtn', function () {
            $('#deleteBrandModal').modal('show');
            var id = $(this).data('id');
            deleteBrand(id);
        }); 
    
    
    function deleteBrand(brandId){
      
        $('#deleteUserModal').modal('show');
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.confirmDeleteBrandBtn').on('click', function () {
            
            $.ajax({
                url: 'deleteBrand/' + brandId,
                type: 'DELETE',
                success: function (response) {
                    alert('Brand deleted successfully');
                    var table = $('#brandsDatatable').DataTable();
                    table.draw();
                    $('#deleteBrandModal').modal('hide');
                    
                },
                error: function (error) {
                    console.error('Error deleting brand:', error);
                }
            });
        });
    }
    });

    $(document).ready(function () {
   
    
        $('body').on('click','#deleteUserBtn', function () {
            $('#deleteUserModal').modal('show');
            var id = $(this).data('id');
            deleteUser(id);
        }); 
    
    
    function deleteUser(userId){
      
        $('#deleteUserModal').modal('show');
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.confirmDeleteUserBtn').on('click', function () {
            
            $.ajax({
                url: 'deleteUser/' + userId,
                type: 'DELETE',
                success: function (response) {
                    alert('User deleted successfully');
                    var table = $('.usersDataTable').DataTable();
                    table.draw();
                    $('#deleteUserModal').modal('hide');
                },
                error: function (error) {
                    console.error('Error deleting user:', error);
                }
            });
        });
    }
    });
