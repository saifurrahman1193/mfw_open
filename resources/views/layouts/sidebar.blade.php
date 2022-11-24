{{-- https://simplelineicons.github.io/ --}}
@section('sidebar_content')
<style>
  .icon-menu{cursor: pointer;}
</style>
  <nav class="sidebar sidebar-offcanvas" id="sidebar" style="z-index: 1000">
    <ul class="nav">
      @if (in_array('1', $usermodules))
        <li class="nav-item"> 
          <a class="nav-link" href="{{ route('home') }}">
            <i class=" icon-home menu-icon"></i>
            <span class="menu-title">Home</span>
          </a>
        </li>
      @endif

      @if (in_array('100', $usermodules))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Super_Admin"  aria-expanded="false" aria-controls="Super_Admin">
              <i class="icon-user menu-icon"></i>
              <span class="menu-title">Super Admin</span>
            </a>
            <div class="collapse" id="Super_Admin">
              <ul class="nav flex-column sub-menu">
                @if (in_array('101', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('user.index') }}"> Users </a></li>
                @endif
                @if (in_array('102', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('role.index') }}"> Roles </a></li>
                @endif
                @if (in_array('103', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('superadminconfig') }}"> Dashboard </a></li>
                @endif

                @if (in_array('104', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('systemEnvironment') }}"> System Environment </a></li>
                @endif

                @if (in_array('105', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('dbAutomatedBackupManagement') }}"> DB Automated Backups Management </a></li>
                @endif

                @if (in_array('106', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('blockList') }}"> Block List Management </a></li>
                @endif

                @if (in_array('107', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('logManagement') }}"> Log Management </a></li>
                @endif

              </ul>
            </div>
          </li>
      @endif

      @if (in_array('200', $usermodules))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#customer_panel"  aria-expanded="false" aria-controls="customer_panel">
              <i class="icon-user menu-icon"></i>
              <span class="menu-title">Customers</span>
            </a>
            <div class="collapse" id="customer_panel">
              <ul class="nav flex-column sub-menu">
                @if (in_array('201', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('customers.customers') }}"> Customers </a></li>
                @endif
                @if (in_array('202', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('productPricesForUsers') }}"> Product Prices For Users</a></li>
                @endif
                @if (in_array('203', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('offerManagement') }}"> Offer Management</a></li>
                @endif
              </ul>
            </div>
          </li>
      @endif

      @if (in_array('300', $usermodules))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#generics"  aria-expanded="false" aria-controls="generics">
              <i class="icon-drop  menu-icon"></i>
              <span class="menu-title">Generics</span>
            </a>
            <div class="collapse" id="generics">
              <ul class="nav flex-column sub-menu">
                @if (in_array('301', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('generics.settings.index') }}"> Generic Settings </a></li>
                @endif 
                @if (in_array('302', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('generics.generics.index') }}"> Generics </a></li>
                @endif 
                @if (in_array('303', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('generics.genericBrandListIndex.index') }}"> Generic Brands </a></li>
                @endif 
                @if (in_array('304', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('genericBrandPriceListIndex') }}"> Generic Brand Prices</a></li>
                @endif 
                @if (in_array('305', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('filesListIndex') }}"> Add Files</a></li>
                @endif 

                @if (in_array('306', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('genericforallproduct') }}"> Show Product By Generic </a></li>
                @endif 

              </ul>
            </div>
          </li>
      @endif


      @if (in_array('400', $usermodules))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#suppliers"  aria-expanded="false" aria-controls="suppliers">
              <i class="icon-handbag  menu-icon"></i>
              <span class="menu-title">Suppliers</span>
            </a>
            <div class="collapse" id="suppliers">
              <ul class="nav flex-column sub-menu">
                @if (in_array('401', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('postions') }}"> Positions</a></li>
                @endif
                @if (in_array('402', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('supplier.index') }}"> Suppliers</a></li>
                @endif

              </ul>
            </div>
          </li>
      @endif


        @if (in_array('500', $usermodules))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#frontend"  aria-expanded="false" aria-controls="frontend">
              <i class=" icon-size-fullscreen    menu-icon"></i>
              <span class="menu-title">Frontend</span>
            </a>
            <div class="collapse" id="frontend">
              <ul class="nav flex-column sub-menu">
                
                @if (in_array('501', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('new_products_slider_index') }}"> New Products Slider</a></li>
                @endif
                @if (in_array('502', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('best_selling_products_slider_index') }}"> Best Selling Products Slider</a></li>
                @endif

                @if (in_array('503', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('main_slider_Index') }}"> Main Slider</a></li>
                @endif
                
                @if (in_array('504', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('frontend_main_navbar_index') }}"> Main Navbar Categories</a></li>
                @endif
                
                @if (in_array('505', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('testimonial_Index') }}"> Testimonial Setup</a></li>
                @endif

                @if (in_array('505', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('testimonial_client_contact_request') }}"> Testimonial Client Contact Request</a></li>
                @endif

                @if (in_array('506', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('currency_Index') }}"> Currency Setup</a></li>
                @endif

                @if (in_array('507', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('top_brands_index') }}"> Top Brands Setup</a></li>
                @endif

                
                
                @if (in_array('508', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('banner_index') }}"> Banner </a></li>
                @endif

                @if (in_array('509', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('seodefault') }}"> SEO Default </a></li>
                @endif

                @if (in_array('510', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('socialmedias') }}"> Social Medias</a></li>
                @endif
                @if (in_array('511', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('customerReviews') }}"> Approve Reviews</a></li>
                @endif

                @if (in_array('512', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('contact_with_product_reviewer_requests') }}"> Contact with product reviewer requests</a></li>
                @endif

                @if (in_array('513', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('customer_to_admin_contacts') }}"> Customer to admin contacts</a></li>
                @endif


              </ul>
            </div>
          </li>
          @endif
          
          
          
          @if (in_array('600', $usermodules))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#pages"  aria-expanded="false" aria-controls="pages">
              <i class="  icon-docs     menu-icon"></i>
              <span class="menu-title">Pages</span>
            </a>
            <div class="collapse" id="pages">
              <ul class="nav flex-column sub-menu">
                @if (in_array('601', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('pages') }}"> Pages</a></li>
                @endif
              </ul>
            </div>
          </li>
          @endif
          
          
          @if (in_array('700', $usermodules))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#footer"  aria-expanded="false" aria-controls="footer">
              <i class="fa fa-window-minimize  menu-icon " style="color:#00000069;"></i>
              <span class="menu-title">Footer</span>
            </a>
            <div class="collapse" id="footer">
              <ul class="nav flex-column sub-menu">
                  @if (in_array('701', $usermodules))
                    <li class="nav-item"> <a class="nav-link" href="{{ route('footer.thirdFourthPortion') }}"> Top of Footer (3rd+4th portion)</a></li>
                  @if (in_array('702', $usermodules))@endif
                    <li class="nav-item"> <a class="nav-link" href="{{ route('footer.portion1') }}"> Portion 1</a></li>
                  @if (in_array('703', $usermodules))@endif
                    <li class="nav-item"> <a class="nav-link" href="{{ route('footer.portion1socials') }}"> Portion 1 Socials</a></li>
                  @if (in_array('704', $usermodules))@endif
                    <li class="nav-item"> <a class="nav-link" href="{{ route('footer.portion2pages') }}"> Portion 2 Pages</a></li>
                  @if (in_array('705', $usermodules))@endif
                    <li class="nav-item"> <a class="nav-link" href="{{ route('footer.portion3categories') }}"> Portion 3 Categories</a></li>
                  @endif
                  @if (in_array('706', $usermodules))
                    <li class="nav-item"> <a class="nav-link" href="{{ route('footer.portion4') }}"> Portion 4</a></li>
                  @if (in_array('707', $usermodules))@endif
                    <li class="nav-item"> <a class="nav-link" href="{{ route('footer.portion4socials') }}"> Portion 4 Socials</a></li>
                  @if (in_array('708', $usermodules))@endif
                    <li class="nav-item"> <a class="nav-link" href="{{ route('footer.bottomFooter') }}">Bottom Footer</a></li>
                  @endif
              </ul>
            </div>
          </li>
          @endif
          
          
          @if (in_array('800', $usermodules))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Carts"  aria-expanded="false" aria-controls="Carts">
              <i class=" icon-basket-loaded   menu-icon"></i>
              <span class="menu-title">Carts</span>
            </a>
            <div class="collapse" id="Carts">
              <ul class="nav flex-column sub-menu">
                @if (in_array('801', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('cartListAdmin') }}"> Carts</a></li>
                @endif 
                @if (in_array('802', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('createmanualcart') }}"> Create Manual Cart</a></li>
                @endif 
                @if (in_array('803', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('cart.default.reasons') }}"> Default Reasons & Solutions</a></li>
                @endif 
                @if (in_array('804', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('mail.settings') }}"> Mail Settings </a></li>
                @endif 
                
                @if (in_array('805', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('paymentsettings') }}"> Payment Settings</a></li>
                @endif 
                @if (in_array('806', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('deliverysettings') }}"> Delivery Settings</a></li>
                @endif 
                @if (in_array('807', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('invoiceCommonSettings') }}"> Invoice Settings</a></li>
                @endif 
                @if (in_array('808', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('proformaInvoiceCompany') }}"> Proforma Invoice Settings</a></li>
                @endif 
              </ul>
            </div>
          </li>
          @endif

          @if (in_array('900', $usermodules))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Reports"  aria-expanded="false" aria-controls="Reports">
              <i class=" icon-book-open    menu-icon"></i>
              <span class="menu-title">Reports</span>
            </a>
            <div class="collapse" id="Reports">
              <ul class="nav flex-column sub-menu">
                @if (in_array('901', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('report.casehistory') }}">Case History</a></li>
                @endif  
                @if (in_array('902', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('report.priceinquiryreport') }}">Price Inquiry Report</a></li>
                @endif  
                @if (in_array('903', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('report.paymentconfirmationreport') }}">Payment Confirmation Report</a></li>
                @endif  
                @if (in_array('904', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('report.allcustomersdata') }}">All Cusomers Data Report</a></li>
                @endif  
                @if (in_array('905', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('report.productsreport') }}">Products Report</a></li>
                @endif  
                @if (in_array('906', $usermodules))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('uploadingthirdpartdataindex') }}">Uploading third party data</a></li>
                @endif  
              </ul>
            </div>
          </li>
          @endif


          @if (in_array('1000', $usermodules))
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#blogs"  aria-expanded="false" aria-controls="blogs">
                <i class=" fa fa-pencil-square-o     menu-icon"></i>
                <span class="menu-title">Blogs</span>
              </a>
              <div class="collapse" id="blogs">
                <ul class="nav flex-column sub-menu">
                  @if (in_array('1001', $usermodules))
                    <li class="nav-item"> <a class="nav-link" href="{{ route('blogManagement') }}">Blog Management</a></li>
                  @endif  
                </ul>
              </div>
            </li>
          @endif
          
          

    </ul>
  </nav>
@endsection