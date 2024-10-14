 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4 bg-secondary" >
    <!-- Brand Logo -->
    <a class="brand-link link-underline-opacity-0">
      <img src="{{ asset('dist/img/JamalLogo.png') }}?v=1.0" alt="AdminLTE Logo" class="shadow-none brand-image img-circle elevation-3 bg-white" style="background: none;" >
      <span class="brand-text text-wrap" style="font-size: 18px; text-decoration: none;">JMC System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="font-size: 16px;">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active bg-danger">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" >
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fas fa-users fa-10x nav-icon" style="color:white; font-size:14px;"></i>
                  <p style="color:white;">Users <i class="right fas fa-angle-left" style="color:white; font-size:14px;"></i></p>
                </a>
                <ul class="nav nav-treeview" >
                  <li class="nav-item">
                   
                    <a href="{{route('users')}}" class="nav-link">
                    &nbsp
                    &nbsp
                    &nbsp
                    &nbsp
                      <i class=" fa-10x nav-icon" style="color:white; font-size:14px;"></i>
                      <p style="color:white;">
                        Add Users
                      </p>
                    </a>
                  </li>
                </ul>

              </li>

              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fas fa-users fa-10x nav-icon" style="color:white; font-size:14px;"></i>
                  <p style="color:white;">Customers <i class="right fas fa-angle-left" style="color:white; font-size:14px;"></i></p>
                </a>
                <ul class="nav nav-treeview" >
                  <li class="nav-item">
                   
                    <a href="{{route('customers')}}" class="nav-link">
                    &nbsp
                    &nbsp
                    &nbsp
                    &nbsp
                      <i class=" fa-10x nav-icon" style="color:white; font-size:14px;"></i>
                      <p style="color:white;">
                        Add Customers
                      </p>
                    </a>
                  </li>
                </ul>

              </li>

              
              <li class="nav-item">
                <a href="{{route('brands')}}" class="nav-link">
                  <i class="fas fa-angle-right fa-10x nav-icon" style="color:white; font-size:14px;"></i>
                  <p style="color:white;">Brands <i class="right fas fa-angle-left" style="color:white; font-size:14px;"></i></p>
                </a>
                <ul class="nav nav-treeview" >
                  <li class="nav-item">
                   
                    <a href="{{route('brands')}}" class="nav-link">
                    &nbsp
                    &nbsp
                    &nbsp
                    &nbsp
                      <i class=" fa-10x nav-icon" style="color:white; font-size:14px;"></i>
                      <p style="color:white;">
                        Add Brands
                      </p>
                    </a>
                  </li>
                </ul>

              </li>
              <li class="nav-item">
                <a href="{{route('products')}}" class="nav-link">
                  <i class="fas fa-angle-right fa-10x nav-icon" style="color:white; font-size:14px;"></i>
                  <p style="color:white;">Products<i class="right fas fa-angle-left" style="color:white; font-size:14px;"></i></p>
                </a>
                <ul class="nav nav-treeview" >
                  <li class="nav-item">
                   
                    <a href="{{route('products')}}" class="nav-link">
                    &nbsp
                    &nbsp
                    &nbsp
                    &nbsp
                      <i class=" fa-10x nav-icon" style="color:white; font-size:14px;"></i>
                      <p style="color:white;">
                        Add Products
                      </p>
                    </a>
                  </li>
                </ul>

              </li>
              <li class="nav-item">
                <a href="{{route('orders')}}" class="nav-link">
                  <i class="fas fa-angle-right fa-10x nav-icon" style="color:white; font-size:14px;"></i>
                  <p style="color:white;">Orders<i class="right fas fa-angle-left" style="color:white; font-size:14px;"></i></p>
                </a>
                <ul class="nav nav-treeview" >
                  <li class="nav-item">
                   
                    <a href="{{route('orders')}}" class="nav-link">
                    &nbsp
                    &nbsp
                    &nbsp
                    &nbsp
                      <i class=" fa-10x nav-icon" style="color:white; font-size:14px;"></i>
                      <p style="color:white;">
                        Add Orders
                      </p>
                    </a>
                  </li>
                </ul>

              </li>
              <li class="nav-item">
                <a href="{{route('requisition.datatable')}}" class="nav-link">
                  <i class="fas fa-angle-right fa-10x nav-icon" style="color:white; font-size:14px;"></i>
                  <p style="color:white;">Requisition Forms<i class="right fas fa-angle-left" style="color:white; font-size:14px;"></i></p>
                </a>
                <ul class="nav nav-treeview" >
                  <li class="nav-item">
                   
                    <a href="{{route('requisition.datatable')}}" class="nav-link">
                    &nbsp
                    &nbsp
                    &nbsp
                    &nbsp
                      <i class=" fa-10x nav-icon" style="color:white; font-size:14px;"></i>
                      <p style="color:white;">
                        Add Requisition Forms
                      </p>
                    </a>
                  </li>
                </ul>

              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
