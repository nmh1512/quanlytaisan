 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="index3.html" class="nav-link">Home</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="#" class="nav-link">Contact</a>
         </li>
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         {{-- Language  --}}
         <li class="nav-item">
             <a style="width: 50px; height: 32px" class="language-change nav-link pr-2" href="#" role="button"
                 data-lang="vi">
                 {{-- <i class="icon flag-vn"></i> --}}
                 <img class="w-100 h-100" src="{{ asset('main/images/vn.png') }}" alt="Tiếng Việt">
             </a>
         </li>
         <li class="nav-item">
             <a style="width: 50px; height: 32px" class="language-change nav-link pl-2" href="#" role="button"
                 data-lang="en">
                 {{-- <i class="icon flag-us"></i> --}}
                 <img class="w-100 h-100" src="{{ asset('main/images/us.png') }}" alt="English">
             </a>
         </li>

         <!-- Navbar Search -->
         <li class="nav-item">
             <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                 <i class="fas fa-search"></i>
             </a>
             <div class="navbar-search-block">
                 <form class="form-inline">
                     <div class="input-group input-group-sm">
                         <input class="form-control form-control-navbar" type="search" placeholder="Search"
                             aria-label="Search">
                         <div class="input-group-append">
                             <button class="btn btn-navbar" type="submit">
                                 <i class="fas fa-search"></i>
                             </button>
                             <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                 <i class="fas fa-times"></i>
                             </button>
                         </div>
                     </div>
                 </form>
             </div>
         </li>

         <!-- Messages Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-comments"></i>
                 <span class="badge badge-danger navbar-badge">3</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <a href="#" class="dropdown-item">
                     <!-- Message Start -->
                     <div class="media">
                         <img src="{{ asset('home/dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                             class="img-size-50 mr-3 img-circle">
                         <div class="media-body">
                             <h3 class="dropdown-item-title">
                                 Brad Diesel
                                 <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                             </h3>
                             <p class="text-sm">Call me whenever you can...</p>
                             <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                         </div>
                     </div>
                     <!-- Message End -->
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <!-- Message Start -->
                     <div class="media">
                         <img src="{{ asset('home/dist/img/user8-128x128.jpg') }}" alt="User Avatar"
                             class="img-size-50 img-circle mr-3">
                         <div class="media-body">
                             <h3 class="dropdown-item-title">
                                 John Pierce
                                 <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                             </h3>
                             <p class="text-sm">I got your message bro</p>
                             <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                         </div>
                     </div>
                     <!-- Message End -->
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <!-- Message Start -->
                     <div class="media">
                         <img src="{{ asset('home/dist/img/user3-128x128.jpg') }}" alt="User Avatar"
                             class="img-size-50 img-circle mr-3">
                         <div class="media-body">
                             <h3 class="dropdown-item-title">
                                 Nora Silvester
                                 <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                             </h3>
                             <p class="text-sm">The subject goes here</p>
                             <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                         </div>
                     </div>
                     <!-- Message End -->
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
             </div>
         </li>
         <!-- Notifications Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-bell"></i>
                 <span class="badge badge-warning navbar-badge">{{ $notifications['unread']->count() }}</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 @if ($notifications['unread']->count() != 0)
                    @foreach ($notifications['list'] as $notification)
                    <a href="{{ $notification->data['link'] }}" class="dropdown-item">
                        <i class="fas fa-clipboard-list mr-2"></i> {!! $notification->data['message'] !!}
                        <span class="d-block text-right text-muted text-sm">{{ $notification->created_at }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    @endforeach
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                 @else
                    <p class="dropdown-item dropdown-footer">Không có thông báo nào</p>
                 @endif
             </div>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                 <i class="fas fa-expand-arrows-alt"></i>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                 role="button">
                 <i class="fas fa-th-large"></i>
             </a>
         </li>
     </ul>
 </nav>
 <!-- /.navbar -->

 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
         <img src="{{ asset('home/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">AdminLTE 3</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ asset('home/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                     alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block">Alexander Pierce </a>
             </div>
             <a href="{{ route('logout') }}" class="d-flex align-items-center text-white ml-auto mr-1"
                 onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                 <i class="fas fa-power-off"></i>
             </a>

             <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                 {{ csrf_field() }}
             </form>
         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                     aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                 <li class="nav-item">
                     <a href="/" class="nav-link">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                             {{-- <span class="right badge badge-danger">New</span> --}}
                         </p>
                     </a>
                 </li>
                 @canany(['category assets view','type assets view','suppliers view|orders view'])
                     <li class="nav-header">DANH MỤC</li>
                 @endcanany

                 @can('category assets view')
                     <li class="nav-item">
                         <a href="{{ route('home.category_assets_index') }}" class="nav-link">
                             <i class="nav-icon fas fa-th"></i>
                             <p>
                                 Loại tài sản
                                 {{-- <span class="right badge badge-danger">New</span> --}}
                             </p>
                         </a>
                     </li>
                 @endcan
                 @can('type assets view')
                     <li class="nav-item">
                         <a href="{{ route('home.type_assets_index') }}" class="nav-link">
                             <i class="nav-icon fas fa-th"></i>
                             <p>
                                 Chủng loại tài sản
                                 {{-- <span class="right badge badge-danger">New</span> --}}
                             </p>
                         </a>
                     </li>
                 @endcan
                 @can('suppliers view')
                     <li class="nav-item">
                         <a href="{{ route('home.suppliers_index') }}" class="nav-link">
                             <i class="nav-icon fas fa-th"></i>
                             <p>
                                 Nhà cung cấp
                                 {{-- <span class="right badge badge-danger">New</span> --}}
                             </p>
                         </a>
                     </li>
                 @endcan
                 @can('orders view')
                     <li class="nav-item">
                         <a href="{{ route('home.orders_index') }}" class="nav-link">
                             <i class="nav-icon fas fa-clipboard-list"></i>
                             <p>
                                 Đơn đặt hàng
                                 {{-- <span class="right badge badge-danger">New</span> --}}
                             </p>
                         </a>
                     </li>
                 @endcan

                 @canany(['users view','roles view'])
                     <li class="nav-header">NGƯỜI DÙNG</li>
                 @endcanany

                 @can('users view')
                     <li class="nav-item">
                         <a href="{{ route('home.users_index') }}" class="nav-link">
                             <i class="nav-icon fas fa-users"></i>
                             <p>
                                 Danh sách người dùng
                                 {{-- <span class="right badge badge-danger">New</span> --}}
                             </p>
                         </a>
                     </li>
                 @endcan

                 @can('roles view')
                     <li class="nav-item">
                         <a href="{{ route('home.roles_index') }}" class="nav-link">
                             <i class="nav-icon fas fa-user-tag"></i>
                             <p>
                                 Danh sách chức vụ
                                 {{-- <span class="right badge badge-danger">New</span> --}}
                             </p>
                         </a>
                     </li>
                 @endcan

                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             Layout Options
                             <i class="fas fa-angle-left right"></i>
                             <span class="badge badge-info right">6</span>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="pages/layout/top-nav.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Top Navigation</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Top Navigation + Sidebar</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/boxed.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Boxed</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Fixed Sidebar</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Fixed Sidebar <small>+ Custom Area</small></p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/fixed-topnav.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Fixed Navbar</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/fixed-footer.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Fixed Footer</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Collapsed Sidebar</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-chart-pie"></i>
                         <p>
                             Charts
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="pages/charts/chartjs.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>ChartJS</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/charts/flot.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Flot</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/charts/inline.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Inline</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/charts/uplot.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>uPlot</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-tree"></i>
                         <p>
                             UI Elements
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="pages/UI/general.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>General</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/UI/icons.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Icons</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/UI/buttons.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Buttons</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/UI/sliders.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Sliders</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/UI/modals.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Modals & Alerts</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/UI/navbar.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Navbar & Tabs</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/UI/timeline.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Timeline</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/UI/ribbons.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Ribbons</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-edit"></i>
                         <p>
                             Forms
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="pages/forms/general.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>General Elements</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/forms/advanced.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Advanced Elements</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/forms/editors.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Editors</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/forms/validation.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Validation</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             Tables
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="pages/tables/simple.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Simple Tables</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/tables/data.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>DataTables</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/tables/jsgrid.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>jsGrid</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-header">EXAMPLES</li>
                 <li class="nav-item">
                     <a href="pages/calendar.html" class="nav-link">
                         <i class="nav-icon far fa-calendar-alt"></i>
                         <p>
                             Calendar
                             <span class="badge badge-info right">2</span>
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="pages/gallery.html" class="nav-link">
                         <i class="nav-icon far fa-image"></i>
                         <p>
                             Gallery
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="pages/kanban.html" class="nav-link">
                         <i class="nav-icon fas fa-columns"></i>
                         <p>
                             Kanban Board
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon far fa-envelope"></i>
                         <p>
                             Mailbox
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="pages/mailbox/mailbox.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Inbox</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/mailbox/compose.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Compose</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/mailbox/read-mail.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Read</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-book"></i>
                         <p>
                             Pages
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="pages/examples/invoice.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Invoice</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/profile.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Profile</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/e-commerce.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>E-commerce</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/projects.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Projects</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/project-add.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Project Add</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/project-edit.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Project Edit</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/project-detail.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Project Detail</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/contacts.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Contacts</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/faq.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>FAQ</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/contact-us.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Contact us</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon far fa-plus-square"></i>
                         <p>
                             Extras
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>
                                     Login & Register v1
                                     <i class="fas fa-angle-left right"></i>
                                 </p>
                             </a>
                             <ul class="nav nav-treeview">
                                 <li class="nav-item">
                                     <a href="pages/examples/login.html" class="nav-link">
                                         <i class="far fa-circle nav-icon"></i>
                                         <p>Login v1</p>
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="pages/examples/register.html" class="nav-link">
                                         <i class="far fa-circle nav-icon"></i>
                                         <p>Register v1</p>
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="pages/examples/forgot-password.html" class="nav-link">
                                         <i class="far fa-circle nav-icon"></i>
                                         <p>Forgot Password v1</p>
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="pages/examples/recover-password.html" class="nav-link">
                                         <i class="far fa-circle nav-icon"></i>
                                         <p>Recover Password v1</p>
                                     </a>
                                 </li>
                             </ul>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>
                                     Login & Register v2
                                     <i class="fas fa-angle-left right"></i>
                                 </p>
                             </a>
                             <ul class="nav nav-treeview">
                                 <li class="nav-item">
                                     <a href="pages/examples/login-v2.html" class="nav-link">
                                         <i class="far fa-circle nav-icon"></i>
                                         <p>Login v2</p>
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="pages/examples/register-v2.html" class="nav-link">
                                         <i class="far fa-circle nav-icon"></i>
                                         <p>Register v2</p>
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="pages/examples/forgot-password-v2.html" class="nav-link">
                                         <i class="far fa-circle nav-icon"></i>
                                         <p>Forgot Password v2</p>
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="pages/examples/recover-password-v2.html" class="nav-link">
                                         <i class="far fa-circle nav-icon"></i>
                                         <p>Recover Password v2</p>
                                     </a>
                                 </li>
                             </ul>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/lockscreen.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Lockscreen</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Legacy User Menu</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/language-menu.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Language Menu</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/404.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Error 404</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/500.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Error 500</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/pace.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Pace</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/examples/blank.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Blank Page</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="starter.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Starter Page</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-search"></i>
                         <p>
                             Search
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="pages/search/simple.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Simple Search</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/search/enhanced.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Enhanced</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-header">MISCELLANEOUS</li>
                 <li class="nav-item">
                     <a href="iframe.html" class="nav-link">
                         <i class="nav-icon fas fa-ellipsis-h"></i>
                         <p>Tabbed IFrame Plugin</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="https://adminlte.io/docs/3.1/" class="nav-link">
                         <i class="nav-icon fas fa-file"></i>
                         <p>Documentation</p>
                     </a>
                 </li>
                 <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="fas fa-circle nav-icon"></i>
                         <p>Level 1</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-circle"></i>
                         <p>
                             Level 1
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Level 2</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>
                                     Level 2
                                     <i class="right fas fa-angle-left"></i>
                                 </p>
                             </a>
                             <ul class="nav nav-treeview">
                                 <li class="nav-item">
                                     <a href="#" class="nav-link">
                                         <i class="far fa-dot-circle nav-icon"></i>
                                         <p>Level 3</p>
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="#" class="nav-link">
                                         <i class="far fa-dot-circle nav-icon"></i>
                                         <p>Level 3</p>
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="#" class="nav-link">
                                         <i class="far fa-dot-circle nav-icon"></i>
                                         <p>Level 3</p>
                                     </a>
                                 </li>
                             </ul>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Level 2</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="fas fa-circle nav-icon"></i>
                         <p>Level 1</p>
                     </a>
                 </li>
                 <li class="nav-header">LABELS</li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon far fa-circle text-danger"></i>
                         <p class="text">Important</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon far fa-circle text-warning"></i>
                         <p>Warning</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon far fa-circle text-info"></i>
                         <p>Informational</p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
