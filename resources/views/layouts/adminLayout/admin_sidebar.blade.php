<?php $url =  url()->current();?>
<!--sidebar-menu-->

<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>

  <ul>

<li <?php if(preg_match("/dashboard/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/dashboard') }}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li class="submenu" > <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <span class="label label-important">2</span></a>
       <ul <?php if(preg_match("/categor/i", $url)){ ?> style="display:block;" <?php } ?>>
          <li <?php if(preg_match("/add_category/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/add_category') }}">Add Category</a></li>
          <li  <?php if(preg_match("/view_categories/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view_categories') }}">View Categories</a></li>
        </ul> 
      </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Products</span> <span class="label label-important">2</span></a>
      <ul <?php if(preg_match("/produc/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li <?php if(preg_match("/add_product/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/add_product') }}">Add Product</a></li>
        <li <?php if(preg_match("/view_products/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view_products') }}">View Products</a></li>
      </ul> 
    </li>

    <li class="submenu" > <a href="#"><i class="icon icon-th-list"></i> <span>Coupons</span> <span class="label label-important">2</span></a>
       <ul <?php if(preg_match("/coupo/i", $url)){ ?> style="display:block;" <?php } ?>>
          <li <?php if(preg_match("/add_coupon/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/add_coupon') }}">Add Coupon</a></li>
          <li <?php if(preg_match("/view_coupons/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view_coupons') }}">View Coupons</a></li>
        </ul> 
      </li>

      <li class="submenu" > <a href="#"><i class="icon icon-th-list"></i> <span>Order Status</span> <span class="label label-important">2</span></a>
       <ul <?php if(preg_match("/ordSta/i", $url)){ ?> style="display:block;" <?php } ?>>
          <li <?php if(preg_match("/add_order_status/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/add_order_status') }}">Add Order Status</a></li>
          <li <?php if(preg_match("/view_order_status/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view_order_status') }}">View Order Status</a></li>
        </ul> 
      </li>

      <li class="submenu" > <a href="#"><i class="icon icon-th-list"></i> <span>Orders</span> <span class="label label-important">1</span></a>
       <ul <?php if(preg_match("/orders/i", $url)){ ?> style="display:block;" <?php } ?>>
          <li <?php if(preg_match("/view_orders/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view_orders') }}">View Orders</a></li>
        </ul> 
      </li>


      <li class="submenu" > <a href="#"><i class="icon icon-th-list"></i> <span>Banners</span> <span class="label label-important">2</span></a>
       <ul <?php if(preg_match("/banne/i", $url)){ ?> style="display:block;" <?php } ?>>
          <li <?php if(preg_match("/add_banner/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/add_banner') }}">Add Banner</a></li>
          <li <?php if(preg_match("/view_banners/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view_banners') }}">View Banners</a></li>
        </ul> 
      </li>

      <li class="submenu" > <a href="#"><i class="icon icon-th-list"></i> <span>Users</span> <span class="label label-important">1</span></a>
       <ul <?php if(preg_match("/users/i", $url)){ ?> style="display:block;" <?php } ?>>
          <li <?php if(preg_match("/view_users/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view_users') }}">View Users</a></li>
        </ul> 
      </li>

      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>CMS Pages</span> <span class="label label-important">2</span></a>
      <ul <?php if(preg_match("/cms/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li <?php if(preg_match("/add_cms_page/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/add_cms_page') }}">Add CMS Page</a></li>
        <li <?php if(preg_match("/view_cms_pages/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view_cms_pages') }}">View CMS Pages</a></li>
      </ul> 
    </li>

  </ul>
</div>
<!--sidebar-menu-->

