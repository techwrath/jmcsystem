@extends('dashboard.layout.master')
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
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div id="example1_filter" class="dataTables_filter float-left">
                                <label>
                                    Search:
                                  <input type="search" class="form-control form-control-sm" placeholder aria-controls="example1">
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div id="example1_filter" class="dataTables_filter float-right">
                            <span>Records Found: {{$totalCustomers}} </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped " id="customersDataTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Number</th>
                        <th>Customer Name</th>
                        <th>Phone Number</th>
                        <th>Area Code</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($customers as $key => $customer)
                    
                    <tr>
                    <td>{{ $key + 1 }}</td> 
                       <td>{{$customer->customerNo}}</td>
                        <td>{{$customer->customerName}}</td>
                        <td>{{$customer->phoneNumber}}</td>
                        <td>{{$customer->areaCode}}</td>
                        <td>{{$customer->status}}</td>
                        <td>
                            <div>
                                <a href="{{ route('getUser', $customer->id) }}" id='editCustomerBtn' type='button' data-id='{{$customer->id}}'   class='text-primary'><i class='fas fa-edit'></i></a>
                                <a type="button" id='deleteCustomerBtn' data-id='{{$customer->id}}'  class='text-danger'><i class='fas fa-trash'></i></a>
                                @if($customer->status == 'ACTIVE')
                           
                                  <a title="Deactivate Customer"  href="" id='editCustomerBtn' type='button' data-id='{{$customer->id}}'   class='text-danger'><i class='fas fa-ban'></i></a>
                                @else
                                   <a title="Activate Customer" href="" id='editCustomerBtn' type='button' data-id='{{$customer->id}}'   class='text-success'><i class='fas fa-check-circle'></i></a>
                                
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                         
                    </tbody>
                    <tfoot>
                  
                    </tfoot>
                    </table>
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