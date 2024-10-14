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
                 <h4 class="mb-0">USERS</h4>
                 <p>DataTable to view, add , edit and delete users.</p>
                 </div>
                 <div class="col-md-6 align-items-center">
                  <a role="button" href="{{route('addUserView')}}" class="btn btn-secondary float-right d-inline-block d-flex align-items-center" id="">Add New User</a>
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
                            <span>Records Found: {{$totalUsers}} </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped usersDataTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $key => $user)
                    
                    <tr>
                    <td>{{ $key + 1 }}</td> 

                        <td>{{$user->firstName}}</td>
                        <td>{{$user->lastName}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <div>
                                <a href="{{ route('getUser', $user->id) }}" id='editUserBtn' type='button' data-id='{{$user->id}}'   class='text-primary'><i class='fas fa-edit'></i></a>
                                <a type="button" id='deleteUserBtn' data-id='{{$user->id}}'  class='text-danger'><i class='fas fa-trash'></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                    </tbody>
                    <tfoot>
                    <tr>
                    
                    </tr>
                    </tfoot>
                    </table>
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
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#brandsDatatable").DataTable({
         pageLength: 10,
    filter: true,
    deferRender: true,
    scrollY: 200,
    scrollCollapse: true,
    scroller: true,
    "searching": true,
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
});
</script>