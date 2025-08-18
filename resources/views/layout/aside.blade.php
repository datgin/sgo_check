 <div class="h-100" data-simplebar>

     <!--- Sidemenu -->
     <div id="sidebar-menu">

         <div class="logo-box">
             <a class='logo logo-dark' href='index.html'>
                 <span class="logo-sm">
                     <img src="{{ showImage(auth()->user()->logo) }}" alt="" height="22">
                 </span>
                 <span class="logo-lg">
                     <img src="{{ showImage(auth()->user()->logo) }}" alt="" height="24">
                 </span>
             </a>
         </div>

         <ul id="side-menu">

             <li class="menu-title">Menu</li>

             <li>
                 <a class='tp-link' href="/{{ Str::slug(auth()->user()->company) }}">
                     <i data-feather="home"></i>
                     <span> Tổng quan </span>
                 </a>
             </li>

             <li class="menu-title">Pages</li>

             <li>
                 <a class='tp-link' href='/{{ Str::slug(auth()->user()->company) }}/clients'>
                     <i data-feather="users"></i>
                     <span> Danh sách khách hàng </span>
                 </a>
             </li>

             <li>
                 <a class="tp-link" href="{{ route('bills.index', ['company' => Str::slug(auth()->user()->company)]) }}">
                     <i data-feather="shopping-cart"></i>
                     <span>Xác nhận mua hàng</span>
                 </a>
             </li>


         </ul>

     </div>
     <!-- End Sidebar -->

     <div class="clearfix"></div>

 </div>
