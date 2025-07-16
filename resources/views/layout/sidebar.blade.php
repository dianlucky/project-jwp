 <!-- ========== Left Sidebar Start ========== -->
 <div class="left side-menu">
     <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
         <i class="mdi mdi-close"></i>
     </button>

     <!-- LOGO -->
     <div class="topbar-left">
         <div class="text-center">
             <a href="{{ url('/')}}" class="logo">
                 {{-- <img src="{{ url('assets/images/logo-rautama.png')}}" alt="" class="w-50" /> --}}
             </a>
         </div>
     </div>

     <div class="sidebar-inner slimscrollleft" id="sidebar-main">
         <div id="sidebar-menu">
             <ul>
                 <li>
                     <a href="{{ url('/')}}" class="waves-effect">
                         <i class="mdi mdi-view-dashboard"></i>
                         <span>
                             Dashboard
                         </span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ url('/sales')}}" class="waves-effect">
                         <i class="mdi mdi-cash-usd"></i>
                         <span> Penjualan </span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ url('/product')}}" class="waves-effect">
                         <i class="mdi mdi-cube"></i>
                         <span> Produk </span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ url('/category')}}" class="waves-effect">
                         <i class="mdi mdi-database"></i>
                         <span> Kategori </span>
                     </a>
                 </li>
             </ul>
         </div>
         <div class="clearfix"></div>
     </div>
     <!-- end sidebarinner -->
 </div>
 <!-- Left Sidebar End -->
