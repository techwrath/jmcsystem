@extends('dashboard.layout.master')
<head>
    <style>
        
    table.dataTable{
        border: 1px solid #ddd; /* Light grey border for cells */
    }
    .dataTables_wrapper .dataTables_filter {
      
        display: flex;
        justify-content: flex-end; /* Align the search bar to the right */
        flex-wrap: wrap; /* Make the content wrap if needed on smaller screens */
        margin-top: -30px;
    }
    table.dataTable tbody tr:nth-child(odd) {
        background-color: #f9f9f9; /* Light gray for odd rows */
    }

    table.dataTable tbody tr:nth-child(even) {
        background-color: #ffffff; /* White for even rows */
    }

    /* Optional: Add hover effect for better user experience */
    table.dataTable tbody tr:hover {
        background-color: #e0e0e0; /* Light gray for hovered rows */
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 5px 10px; /* Adjust padding inside the buttons */
        border: 1px solid #ddd; /* Optional: Add a border to pagination buttons */
        border-radius: 4px; /* Optional: Rounded corners */
        background-color: #f9f9f9; /* Optional: Light background color */
        color: #007bff; /* Optional: Text color */
    }
    .dataTables_wrapper div.dataTables_paginate{
        margin-top: -20px;
    }
    </style>
</head>
@section('content')

<div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
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
                           
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="card" style="margin-top:15px;">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                 <h4 class="mb-0">CUSTOMERS</h4>
                 <p>DataTable to view, add , edit and delete customers.</p>
                 </div>
                 <div class="col-md-6 align-items-center">
                  <a role="button" href="{{route('add.customer')}}" class="btn btn-secondary float-right d-inline-block d-flex align-items-center" id="">Add New Customer</a>
                </div>
                </div>
            </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <div class="table-responsive">
                {!! $dataTable->table() !!}
                </div>
                <div class = "float-right">
           
            </div> 
              </div>
              <!-- /.card-body -->
            </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
                 
<div class="modal" id="deleteUserModal" tabindex="1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do you really want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger confirmDeleteUserBtn">Delete User</button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

{{ $dataTable->scripts(attributes: ['type' => 'module']) }}


@endpush

<!-- Page specific script -->
<script>
  $(function () {
    $("#customersDataTable").DataTable({
        paging: true,   
         pageLength: 10,
         lengthMenu: [5, 10, 25],
    filter: true,
    deferRender: true,
    scrollY: 200,
    scrollCollapse: true,
    scroller: true,
    searching: true,
      responsive: true,
      autoWidth: false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });
    
});

</script>