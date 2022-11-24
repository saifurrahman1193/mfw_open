

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MFW | @yield('pageTitle')</title>

    {{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

    {{-- meta tags --}}
    {{-- meta tags --}}
    <meta property="og:image"         content="{{ asset('frontend/img/logo.png') }}" />
    <meta property="og:url"           content="{{ route('home') }}" />
    <meta property="og:title"         content="Medicine For World" />
    <meta property="og:description"   content="Most user friendly medicine e-commerce in the world." />
    {{-- meta tags --}}
    {{-- meta tags --}}



    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">

    <!-- Styles -->
    <!-- Styles -->
    <!-- Styles -->
    
    <meta name="description" content="&amp;lt;img src=&amp;quot;{{ asset('frontend/img/logo.png') }}&amp;quot; alt=&amp;quot;review&amp;quot;...">
    <meta name="robots" content="noindex, follow" />
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />

    <link rel="stylesheet" media="all" href="{{ asset('css/style.css') }}" />
    {{-- <link rel="stylesheet" media="all" href="{{ asset('css/style1.css') }}" /> --}}
    {{-- <link rel="stylesheet" media="all" href="{{ asset('css/style2.css') }}" /> --}}


    <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      {{-- <title>CZKCL</title> --}}
      <!-- plugins:css -->
      {{-- <link rel="stylesheet" href="{{ asset('css/materialdesignicons.min.css') }}"> --}}
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.0.39/css/materialdesignicons.min.css">

      {{-- <link rel="stylesheet" href="{{ asset('css/simple-line-icons.css') }}"> --}}
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
      {{-- <link rel="stylesheet" href="{{ asset('css/flag-icon.min.css') }}"> --}}
      {{-- <link rel="stylesheet" href="{{ asset('css/perfect-scrollbar.min.css') }}"> --}}
      <!-- endinject -->
      <!-- plugin css for this page -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
      {{-- file input --}}
      <link rel="stylesheet"  href="{{ asset('frontend/css/fileinput.min.css') }}"/>
      <link rel="stylesheet"  href="{{ asset('frontend/css/fileinput_theme.min.css') }}"/>
      {{-- <link rel="stylesheet" href="{{ asset('css/fontawesome-stars.css') }}"> --}}
      {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/themes/fontawesome-stars.css"> --}}
      <!-- End plugin css for this page -->



      {{-- pages  css --}}
      {{-- table  --}}
      {{-- data --}}
      {{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}"> --}}
      <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" >
      {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> --}}
      {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> --}}




      
      <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/tooltipster.bundle.min.css') }}">

 



      

      <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">

       <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" >


       





      

      <!-- endinject -->
      <link rel="shortcut icon" href="{{ asset('frontend/img/favicon-icon.png') }}" />


      {{-- input fields background color setting --}}
      <style>
          .card input[type="text"], input[type="number"], input[type="date"], input[type="email"], input[type="select"], input[type="password"], .card select , .card textarea, select {
            /* background-color: #c8c8d1; */
            background-color: #e6e6fa;
          }
          /* pop up input fields */
          .form-group input[type="text"], input[type="number"], input[type="date"], input[type="email"], input[type="select"], input[type="password"], .card select , .form-group textarea, select {
            background-color: #e6e6fa;
          }
          .card input[type="text"]:read-only, input[type="number"]:read-only, input[type="date"]:read-only, input[type="email"]:read-only, input[type="password"]:read-only , .card textarea:read-only {
            /* background-color: #c8c8d1; */
            background-color: white;
          }
          
      </style>


      {{-- datatables --}}
      {{-- datatables --}}
      <style>

        /* edit buttons stylle */
        .fa{
          margin-top: -5px;
        }

        /* search start*/

        div.dataTables_wrapper div.dataTables_filter input{

            border: 1px solid #00B4CC;
            padding: 5px;
            height: 20px;
            border-radius: 3px;
            outline: none;
            width: 30vw;
            padding: 13px;

        }

        /* div.dataTables_wrapper div.dataTables_length
        {
            max-width: 150px;
            margin-bottom: -40px;
        } */

        /* search end*/

         .current{
            padding: 3px 7px;
            font-weight: bold;
            background: #03a9f3 !important;
            border: 1px solid #ddd;
            color: white !important;
            cursor: pointer;
            border-radius: 20px;
        }

        .dataTables_wrapper:hover .dataTables_paginate:hover .paginate_button:hover, .dataTables_wrapper:focus .dataTables_paginate:focus .paginate_button:focus{
            padding: 5px 9px;
            font-weight: bold;
            background: #03a9f3 !important;
            border: 1px solid #ddd;
            color: white !important;
            cursor: pointer;
            border-radius: 20px;
            margin: 0px 3px;
        }


        .dataTables_wrapper .dataTables_paginate .paginate_button {
            text-decoration: none;
            padding: 3px 7px;
            background: white;
            border-color: #03a9f3;
            color: black;
        }



        /* datatable action buttons */
        #tdtableaction
        {
          /* padding: 0px 20px; */
          padding:  0px;
          font-size: 25px;
          text-align: center;
        }

        </style>

        <style type="text/css" media="screen">
            .form-group.required .control-label:after {
              content:"*";
              color:red;
            }
        </style>

        {{-- select 2 width=100% on modal  --}}
        <style type="text/css" media="screen">
         .select2-container {
              width: 100% !important;
              padding: 0;
          }
        </style>
        {{-- select 2 width=100% on modal  --}}


        

        <link rel="stylesheet"  type="text/css"  href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">
        <style>
            table.fixedHeader-floating {
                margin-top: 57px !important;
            }
        </style>

        <style>
          .mb-80{
            margin-bottom: 80px !important;
          }
        </style>


</head>
<body @yield('pageOnLoad')>

<div class="pre-loader " style="z-index: 1000">
  <div class="sk-fading-circle ">
    <div class="sk-circle1 sk-circle "></div>
    <div class="sk-circle2 sk-circle"></div>
    <div class="sk-circle3 sk-circle"></div>
    <div class="sk-circle4 sk-circle"></div>
    <div class="sk-circle5 sk-circle"></div>
    <div class="sk-circle6 sk-circle"></div>
    <div class="sk-circle7 sk-circle"></div>
    <div class="sk-circle8 sk-circle"></div>
    <div class="sk-circle9 sk-circle"></div>
    <div class="sk-circle10 sk-circle"></div>
    <div class="sk-circle11 sk-circle"></div>
    <div class="sk-circle12 sk-circle"></div>
  </div>
</div>







{{-- start container here --}}
{{-- start container here --}}

<div class="container-scroller">


    <!-- partial:partials/_navbar.blade.php -->
    @yield('navbar_content')










    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">


        <!-- partial:partials/_settings-panel.html -->
        {{-- <div class="theme-setting-wrapper">
          <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
          <div id="theme-settings" class="settings-panel">
            <i class="settings-close mdi mdi-close"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
            <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
              <div class="tiles primary"></div>
              <div class="tiles success"></div>
              <div class="tiles warning"></div>
              <div class="tiles danger"></div>
              <div class="tiles pink"></div>
              <div class="tiles info"></div>
              <div class="tiles dark"></div>
              <div class="tiles default"></div>
            </div>
          </div>
        </div> --}}



        {{-- <div id="right-sidebar" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <ul class="nav nav-tabs" id="setting-panel" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
            </li>
          </ul>
          <div class="tab-content" id="setting-content">
            <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
              <div class="add-items d-flex px-3 mb-0">
                <form class="form w-100">
                  <div class="form-group d-flex">
                    <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                    <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                  </div>
                </form>
              </div>
              <div class="list-wrapper px-3">
                <ul class="d-flex flex-column-reverse todo-list">
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox">
                        Team review meeting at 3.00 PM
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox">
                        Prepare for presentation
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox">
                        Resolve all the low priority tickets due today
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked>
                        Schedule meeting for next week
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked>
                        Project review
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                </ul>
              </div>
              <div class="events py-4 border-bottom px-3">
                <div class="wrapper d-flex mb-2">
                  <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                  <span>Feb 11 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
                <p class="text-gray mb-0">build a js based app</p>
              </div>
              <div class="events pt-4 px-3">
                <div class="wrapper d-flex mb-2">
                  <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                  <span>Feb 7 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                <p class="text-gray mb-0 ">Call Sarah Graves</p>
              </div>
            </div>
            <!-- To do section tab ends -->
            <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
              <div class="d-flex align-items-center justify-content-between border-bottom">
                <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
              </div>
              <ul class="chat-list">
                <li class="list active">
                  <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Thomas Douglas</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">19 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                  <div class="info">
                    <div class="wrapper d-flex">
                      <p>Catherine</p>
                    </div>
                    <p>Away</p>
                  </div>
                  <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                  <small class="text-muted my-auto">23 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Daniel Russell</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">14 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                  <div class="info">
                    <p>James Richardson</p>
                    <p>Away</p>
                  </div>
                  <small class="text-muted my-auto">2 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Madeline Kennedy</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">5 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Sarah Graves</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">47 min</small>
                </li>
              </ul>
            </div>
            <!-- chat tab ends -->
          </div>
        </div> --}}













        <!-- partial -->




        <!-- partial:partials/_sidebar.blade.php -->
        @yield('sidebar_content')




        
        {{-- individual page body --}}
        {{-- individual page body --}}
        @yield('page_content')















    



          





        <!-- partial -->
      </div>
      <!-- row-offcanvas ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->


{{-- end container here --}}
{{-- end container here --}}


          <script src="{{ asset('js/jquery.min.js') }}"></script>
          <script src="{{ asset('js/jquery-ui.min.js') }}"></script>

          <script src="{{ asset('js/tooltipster.bundle.min.js') }}"></script>
          
          {{-- <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script> --}}
          
          {{-- <script src="{{ asset('js/jquery-2.1.0.min.js') }}"></script> --}}

          {{-- <script src="{{ asset('js/jquery.barrating.min.js') }}"></script> --}}
          {{-- <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script> --}}
          {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
          {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}
          <script src="{{ asset('js/bootstrap.min.js') }}"></script>
          <script src="{{ asset('frontend/js/fileinput.min.js') }}"></script>
          <script src="{{ asset('frontend/js/file_input_theme.min.js') }}"></script>

          <script type="text/javscript" src="{{ asset('js/bootstrap-confirmation.js') }}"></script>
          <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>

          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/material.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/ripples.min.js"></script> 


          <script src="https://cdn.tiny.cloud/1/ls7t67kq8gdo7ceru3ihvtu1i5o95xh40t179n8faik3h5ic/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


          {{-- <script type="text/javascript" >$.material.init()</script> --}}
          
    
          <!-- plugins:js -->
          <script src="{{ asset('js/popper.min.js') }}"></script>
        {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> --}}
          <!-- endinject -->
          <!-- Plugin js for this page-->
          {{-- <script src="{{ asset('js/Chart.min.js') }}"></script> --}}
          <script src="{{ asset('js/raphael.min.js') }}"></script>
          {{-- <script src="{{ asset('js/morris.min.js') }}"></script> --}}
          <!-- End plugin js for this page-->
          <!-- inject:js -->
          <script src="{{ asset('js/off-canvas.js') }}"></script>
          <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
          <script src="{{ asset('js/misc.js') }}"></script>
          <script src="{{ asset('js/settings.js') }}"></script>
          {{-- <script src="{{ asset('js/todolist.js') }}"></script> --}}
          <!-- endinject -->
          <!-- Custom js for this page-->
          <script src="{{ asset('js/dashboard.js') }}"></script>
           <script type="text/javascript" src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
          
          <!-- End custom js for this page-->













<script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"bam.nr-data.net","errorBeacon":"bam.nr-data.net","licenseKey":"fcf8d519de","applicationID":"13909","transactionName":"NTU0DRQNDwshOmIZBRM3dR8TDg84Nys/FRQYBSoLAxQKAjM=","queueTime":0,"applicationTime":24,"agent":"","atts":"DXgvW1wZQRQtPChSS1QOMhwLByUINi0+BFNaeCkKCkBZASUkPhVdVCg/CBMHEBMbOD8fBRk5NRVEWEEPMDw9Sl5ZeHZbDxJBXWZ5fUNfQGp0SFFQTVZ3cG9cUwMpPws5AwQCKjxvSlM7NSAQCg4CSHFmfVBZITM0HQkVEEcKHG1BQVhqYVkxLTRRcGFtMQEGNj8uAwAoDjBneENGWGlsWU4pKzMJBGFQHR8xP1khBwAMK2FtMxkENTccSVdWSXRmf0hJRXRtTEYxAgElOiRfREVtdEpQQi4GPDwlHx9Zb3RISFRNVHR4fVJdVCg/Dw8RCggqandSQU9iPh9fUUEaOQ=="}</script>

    <script src="{{ asset('js/huge.js') }}" type="text/javascript"></script>
    <meta http-equiv="X-UA-Compatible" content="chrome=1">








    {{-- <script type="text/javascript" src="js/script1.js"></script> --}}

    <script>
      //function to fix height of iframe!
      var calcHeight = function() {
        var headerDimensions = $('.preview__header').height();
        $('.full-screen-preview__frame').height($(window).height() - headerDimensions);
      }

      $(document).ready(function() {
        calcHeight();
      });

      $(window).resize(function() {
        calcHeight();
      }).load(function() {
        calcHeight();
      });
    </script>

    {{-- <script>$(function(){viewloader.execute(Views);});</script> --}}

      {{-- <script>
          // Google Analytics Tracking Code
          (function () {
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })

              (window,document,'script','//www.google-analytics.com/analytics.js','ga');

            var ACCOUNTS = ["m"];
            window._envGaTrackerNames = ACCOUNTS;

            ga("create", "UA-11834194-7", {"name":"m","allowLinker":true});

            for (var i = 0; i < ACCOUNTS.length; i++) {
              t = ACCOUNTS[i];

              ga(t+'.require', 'linker');
              ga(t+'.linker:autoLink', ["activeden.net","audiojungle.net","themeforest.net","videohive.net","graphicriver.net","3docean.net","codecanyon.net","photodune.net","market.styleguide.envato.com","elements.envato.com","build.envatohostedservices.com","author.envato.com","tutsplus.com","sites.envato.com"]);

              ga(t+'.require', 'ec');

              ga(t+'.require', 'displayfeatures');

              ga(t+'.require', 'linkid', 'linkid.js');

              ga(t+'.set', 'dimension20', 'other')



              if ('') {
                ga(t+'.send', {
                  hitType: 'pageview',
                  page: ''
                });
              } else if ('') {
                // append the analytics_suffix to the page path so the flash alert/error type can be tracked
                var analyticsSuffix = $.trim('').replace(/([A-Z])/g, '$1').replace(/[-_\s]+/g, '-').toLowerCase();
                var uri = URI(window.location.pathname + window.location.search);
                uri.path(uri.path() + '/' + analyticsSuffix);
                var tracking_path = uri.path() + uri.search();
                ga(t+'.send', {
                  hitType: 'pageview',
                  page: tracking_path,
                });
              } else {
                ga(t+'.send', 'pageview');
              }
            }
          }());

          
        </script> --}}


          
        {{-- <script>
        // GA: universal analytics link wrapper
        (function(){
            window._envTrkrs = [["m", "UA-11834194-7"]];

            var debug = false;
            var MAX_RETRIES = 10;

            /*
               The script needs to wait until the Analytics script
               has been downloaded from Google before initializing
            */
            var waitForAnalytics = function(){
                this.count = this.count || 0;

                if (window.ga && ga.getByName) {
                    e.init();
                } else {
                    if (count < MAX_RETRIES) { setTimeout(waitForAnalytics, 250); }
                    count++;
                }
            };

            var e = {
                _envArray: [],
                _envTrkrs: (window._envTrkrsCust && window._envTrkrsCust.length) ? window._envTrkrs.concat(window._envTrkrsCust) : window._envTrkrs,
                init: function() {
                    for (var i=0; i < _envTrkrs.length; i++) {
                      if(!ga.getByName(_envTrkrs[i][0])) {
                        ga("create", _envTrkrs[i][1], "auto", {name: _envTrkrs[i][0], allowLinker: true});
                      }
                    }

                    document.addEventListener('DOMContentLoaded', function(){
                        e.wrapperInit();
                    });

                    if (debug) {console.log('Initiated');}
                },
                wrapperInit: function() {
                    if (typeof window._envIsRunning != 'undefined' || window._envIsRunning == true) {
                        return
                    }
                    window._envIsRunning = true;

                    if (document.addEventListener) {
                        document.addEventListener('click', function(event){
                            var target = event.target;
                            if (target && target.tagName === 'A') {
                                e._envLinksTracker(event);
                            }
                        });
                    }
                },
                isInArray: function(e, t) {
                    for (var n = 0; n < t.length; n++) {
                        var r = new RegExp(t[n], 'i');
                        if (r.test(e)) {
                            return n
                        }
                    }
                    return -1
                },
                _envTrackevent: function(e, t, n, r) {
                    for (var i = 0; i < this._envTrkrs.length; i++) {
                        var s = this._envTrkrs[i][0].length == 0 ? '' : this._envTrkrs[i][0] + '.';
                        r.length == 0 ? ga(s + 'send', 'event', e, t, n) : ga(s + 'send', 'event', e, t, n, r)
                    }
                },
                _envTrackpageview: function(e, t) {
                    t = t.charAt(0) == '/' ? t : '/' + t;
                    for (var n = 0; n < this._envTrkrs.length; n++) {
                        var r = this._envTrkrs[n][0].length == 0 ? '' : this._envTrkrs[n][0] + '.';
                        ga(r + 'send', 'pageview', e + t);
                    }
                },
                _envLinksTracker: function(t) {
                    var r = false;
                    var i = {
                        outbound: {
                            run: true,
                            useEvent: true
                        },
                        download: {
                            run: true,
                            useEvent: true,
                            reg: ''
                        },
                        self: {
                            run: false,
                            useEvent: true
                        },
                        mail: {
                            run: true,
                            useEvent: true
                        },
                        ext: /\.(doc.?|xls.?|ppt.?|exe|zip|rar|gz|tar|tgz|dmg|csv|pdf|xpi|txt|mp3)$/i
                    };
                    var s = t.srcElement ? t.srcElement : this;
                    if (t.srcElement) {
                        r = true
                    }
                    while (s.tagName != 'A') {
                        s = s.parentNode
                    }
                    if (s.href == undefined || s.href == null) {
                        return true
                    }
                    var o = s.href;
                    if (o.length == 0) return;
                    var u = s.hostname.toLowerCase();
                    var a = s.pathname;
                    if (a.length == 0) {
                        a = '/'
                    } else if (a.substr(0, 1) != '/') {
                        a = '/' + a
                    }
                    var f = s.protocol;
                    var l = s.search;
                    var c = location.hostname;
                    c = c.replace(/^www\./i, '').toLowerCase();
                    u = u.replace(/^www\./i, '').toLowerCase();
                    if (o.match(/^#/)) {
                        if (i.self.run) {
                            i.self.useEvent ? e._envTrackevent('self', 'click - ' + c, o, '') : e._envTrackpageview('/virtual/self', '/' + o);
                            return true
                        }
                    } else if (f.match(/^mailto:/i)) {
                        if (i.mail.run) {
                            o = o.replace(/^mailto:/i, '');
                            i.mail.useEvent ? e._envTrackevent('mailto', 'click - ' + c, o, '') : e._envTrackpageview('/virtual/mailto', o);
                            return true
                        }
                    } else if ((new RegExp(i.ext)).test(a)) {
                        if (i.download.run) {
                            o = o.replace(/^https?:\/\//i, '');
                            i.download.useEvent ? e._envTrackevent('download', 'click - ' + c, o, '') : e._envTrackpageview('/virtual/download', o);
                            return true
                        }
                    } else if (u == undefined || u.length == 0 || f.match(/^javascript:/i)) {
                        return
                    } else if ((new RegExp(c + '$', 'i')).test(u) || (new RegExp(u + '$', 'i')).test(c)) {
                        if (i.download.run && i.download.reg.length != 0) {
                            if ((new RegExp(i.download.reg, 'i')).test(a + l)) {
                                o = o.replace(/^https?:\/\//i, '');
                                i.download.useEvent ? e._envTrackevent('download', 'click - ' + c, o, '') : e._envTrackpageview('/virtual/download', o);
                                return true
                            }
                        }
                    } else if (u != c) {
                        if (e.isInArray(u, e._envArray) == -1) {
                            if (i.outbound.run) {
                                i.outbound.useEvent ? e._envTrackevent('outbound', 'click - ' + c, u + a + l, '') : e._envTrackpageview('/virtual/outbound', u + a);
                                return true
                            }
                        } else if (e.isInArray(u, e._envArray) != -1) {
                            var h = s.target;
                            if (h != null && h == '_blank') {
                                if ((new RegExp(/_utma=/)).test(l)) {
                                    return true
                                }
                                var p = e._envTrkrs[0][0].length == 0 ? '' : _envTrkrs[0][0] + '.';
                                return true
                            } else {
                                return false
                            }
                        }
                    }
                }
            };

            waitForAnalytics();
        })()
        </script> --}}




        <script>
          // Set New Relic custom attributes
          (function () {
            if (typeof newrelic !== 'undefined') {
              newrelic.setCustomAttribute('pageType', 'other')
            }
          })()
        </script>

 {{--        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-585RXMV');</script> --}}
        
        



















      {{-- <script type="text/javscript" src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script> --}}
      

      <script type="text/javscript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

      
      {{-- <script type="text/javscript" src="{{ asset('js/jquery-3.3.1.js') }}"></script> --}}


      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
  



            {{-- bootstrap data table --}}
      {{-- https://datatables.net/examples/styling/bootstrap4 --}}
      <script>
        // $(document).ready(function() {
        //     $('#datatable1').DataTable();

        // } );

        $(document).ready(function() {

            $('#datatable1,#datatable2,#datatable3,#datatable4,#datatable5,#datatable6,#datatable7,#datatable8').DataTable( {
                "pagingType": "simple_numbers",
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                },
                lengthMenu: [
                [ 10, 25, 50, 100, 500,-1 ],
                    [ '10 rows', '25 rows', '50 rows','100 rows', '500 rows','Show all' ]
                ]
            } );


            // with sxrol-x
            $('#datatable1WScroll, #datatable2WScroll,#datatable3WScroll,#datatable4WScroll,#datatable5WScroll,#datatable6WScroll,#datatable7WScroll,#datatable8WScroll').DataTable( {
                "pagingType": "simple_numbers",
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                },
                "scrollX": true,
                "scrollY": false,
                // "ordering": false,
                "responsive": true,
                "autoWidth": false,
                lengthMenu: [
                [ 10, 25, 50, 100, 500,-1 ],
                    [ '10 rows', '25 rows', '50 rows','100 rows', '500 rows','Show all' ]
                ]

            } );


            
        } );


      </script>


  
    {{-- notification --}}
    {{-- notification --}}
    <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert#alert-success").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    </script>


    <script src="{{ asset('js/sweetalert.min.js') }}" type="text/javascript" charset="utf-8" async defer></script>
    <script src="{{ asset('js/select2.min.js') }}" type="text/javascript" charset="utf-8"></script>

   

    

    <script>
        $('.tooltipster').tooltipster({
            theme: 'tooltipster-punk',
            contentAsHTML: true
        });
    </script>

    <style>
      .tooltipster-box{
        background-color: whitesmoke !important;
      }

      .tooltipster-content{
        color: black !important;
      }

      .tooltipster{
        cursor: pointer; 
      }

      .tooltipster-content li{
        list-style-type: square;
        padding: 4px 0px;
      }

      
    </style>




    
    


    {{-- preloader --}}
    <script type="text/javascript">
                (function($){
                  'use strict';
                    $(window).on('load', function () {
                        if ($(".pre-loader").length > 0)
                        {
                            $(".pre-loader").fadeOut("slow");
                        }
                    });
                })(jQuery)
    </script>



    {{-- accordion --}}


<script type="text/javascript">

  
  $(document).ready(function(){
 
    $("#heading1").click(function(){
      if ($('#heading1 i').attr('class')=='fa fa-plus-square') {
        $("#heading1 i").removeClass('fa fa-plus-square');
        $("#heading1 i").addClass("fa fa-minus-square");
      }else {
        $("#heading1 i").removeClass("fa fa-minus-square");
        $("#heading1 i").addClass('fa fa-plus-square');
      }
    });


    $("#heading2").click(function(){
      if ($('#heading2 i').attr('class')=='fa fa-plus-square') {
        $("#heading2 i").removeClass('fa fa-plus-square');
        $("#heading2 i").addClass("fa fa-minus-square");
      }else {
        $("#heading2 i").removeClass("fa fa-minus-square");
        $("#heading2 i").addClass('fa fa-plus-square');
      }
    });

    $("#heading3").click(function(){
      if ($('#heading3 i').attr('class')=='fa fa-plus-square') {
        $("#heading3 i").removeClass('fa fa-plus-square');
        $("#heading3 i").addClass("fa fa-minus-square");
      }else {
        $("#heading3 i").removeClass("fa fa-minus-square");
        $("#heading3 i").addClass('fa fa-plus-square');
      }
    });


    $("#heading4").click(function(){
      if ($('#heading4 i').attr('class')=='fa fa-plus-square') {
        $("#heading4 i").removeClass('fa fa-plus-square');
        $("#heading4 i").addClass("fa fa-minus-square");
      }else {
        $("#heading4 i").removeClass("fa fa-minus-square");
        $("#heading4 i").addClass('fa fa-plus-square');
      }
    });

    $("#heading5").click(function(){
      if ($('#heading5 i').attr('class')=='fa fa-plus-square') {
        $("#heading5 i").removeClass('fa fa-plus-square');
        $("#heading5 i").addClass("fa fa-minus-square");
      }else {
        $("#heading5 i").removeClass("fa fa-minus-square");
        $("#heading5 i").addClass('fa fa-plus-square');
      }
    });

    $("#heading6").click(function(){
      if ($('#heading6 i').attr('class')=='fa fa-plus-square') {
        $("#heading6 i").removeClass('fa fa-plus-square');
        $("#heading6 i").addClass("fa fa-minus-square");
      }else {
        $("#heading6 i").removeClass("fa fa-minus-square");
        $("#heading6 i").addClass('fa fa-plus-square');
      }
    });
   
  });
</script>


{{-- lazy image loading --}}
<script src="{{ asset('frontend/js/lozad.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        const observer = lozad();
        observer.observe();
    });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.magnificPopup').magnificPopup({type:'image'});
  });
</script>




<!--Modal Popup starts-->
<div class="modal fade" id="hugeDataModal" tabindex="-1" role="dialog" aria-labelledby="hugeDataModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="min-height: 250px;">
      <div class="modal-header">
        <h3 class="modal-title col-md-11"  id="hugeDataModal-title"></h3>
        <button type="button" class="close col-md-1" data-dismiss="modal" aria-label=""><span>×</span></button>
      </div>
      <div class="modal-body" >
        <div class="row">
            <p id="hugeDataModal-body" style="word-wrap: break-word; max-width: 100%;"></p>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(function(){
        $('#hugeDataModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) ;

            var title = button.data('title') ;
            var body = button.data('body') ;

            var modal = $(this);

            modal.find('.modal-header #hugeDataModal-title').text(title);
            document.getElementById('hugeDataModal-body').innerHTML = body
        });
    });
</script>
<!--Modal Popup ends-->



<!--Modal Popup starts-->
<div class="modal fade" id="normal-modal" tabindex="-1" role="dialog" aria-labelledby="normal-modal" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content" style="min-height: 250px;">
      <div class="modal-header">
        <h3 class="modal-title col-md-11"  id="normal-modal-title"></h3>
        <button type="button" class="close col-md-1" data-dismiss="modal" aria-label=""><span>×</span></button>
      </div>
      <div class="modal-body" >
        <div class="row">
            <p id="normal-modal-body" style="word-wrap: break-word; max-width: 100%;"></p>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(function(){
        $('#normal-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) ;

            var title = button.data('title') ;
            var body = button.data('body') ;

            var modal = $(this);

            modal.find('.modal-header #normal-modal-title').text(title);
            modal.find('.modal-body #normal-modal-body').text(body);
        });
    });
</script>
<!--Modal Popup ends-->

<style >
  .image-hover-cursor-change{
      cursor:zoom-in;
  }
</style>



<script>


  {{-- var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches; --}}
   tinymce.init({
     selector: '.tinymce-editor',
     plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
     imagetools_cors_hosts: ['picsum.photos'],
     menubar: 'file edit view insert format tools table help',
     toolbar: 'code | undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
     toolbar_sticky: true,
     autosave_ask_before_unload: true,
     autosave_interval: '30s',
     autosave_prefix: '{path}{query}-{id}-',
     autosave_restore_when_empty: false,
     autosave_retention: '2m',
     image_advtab: true,
     link_list: [
       { title: 'MFW', value: 'https://medicineforworld.com.bd' }
     ],
     image_list: [
       { title: 'No Image', value: 'https://medicineforworld.com.bd/no_image.png' }
     ],
     image_class_list: [
       { title: 'img-responsive', value: 'img-responsive' }
     ],
     importcss_append: true,
     file_picker_callback: function (callback, value, meta) {
       /* Provide file and text for the link dialog */
       if (meta.filetype === 'file') {
         callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
       }
   
       /* Provide image and alt text for the image dialog */
       if (meta.filetype === 'image') {
         callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
       }
   
       /* Provide alternative source and posted for the media dialog */
       if (meta.filetype === 'media') {
         callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
       }
     },
     templates: [
           { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
       { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
       { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
     ],
     template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
     template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
     insertdatetime_formats: ['%d-%m-%Y %I:%M %p','%H:%M:%S', '%Y-%m-%d', '%I:%M:%S %p', '%D'],
     image_caption: true,
     quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
     noneditable_noneditable_class: 'mceNonEditable',
     toolbar_mode: 'sliding',
     contextmenu: 'link image imagetools table',
     // skin: useDarkMode ? 'oxide-dark' : 'oxide',
     // content_css: useDarkMode ? 'dark' : 'default',
     content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
   
   </script>

   
   
</body>
</html>
