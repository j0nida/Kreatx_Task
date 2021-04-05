<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Employee Dashboard</title>

  <link href="{{asset('vendor\fontawesome\css\all.css')}}" rel="stylesheet" type="text/css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">  <link href="{{asset('css/admin.css')}}" rel="stylesheet">
  
  <style>
    .chat {
      list-style: none;
      margin: 0;
      padding: 0;
      overflow-y: scroll;
      height: 350px;
    }

  .chat li {
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
  }

  .chat li .chat-body p {
    margin: 0;
    color: #777777;
  }

  

  ::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
  }
  </style>

</head>

<body>

  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"  id="accordionSidebar" >

      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('login') }}">
        <div class="sidebar-brand-text mx-3">Employee</div>
      </a>

      <hr class="sidebar-divider my-0">

      <li class="nav-item">
        <a class="nav-link" href="{{route('employee')}}">
          <i class="fas fa-home"></i>
          <span>Dashboard</span></a>
      </li>

      <hr class="sidebar-divider">


      
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('employee.profile',Auth::user()->id)}}">
          <i class="fas fa-user-circle"></i>
          <span>Account Settings</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="#" >
          <i class="fas fa-comments"></i>
          <span>Chat</span>
        </a>
       
      </li>

      <hr class="sidebar-divider">
    
    </ul>
    <div id="content-wrapper" class="d-flex flex-column" >

      <div id="content" >

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <ul class="navbar-nav ml-auto">
            @guest
                  @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown no-arrow">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }} </span>
                                  <img class="img-profile rounded-circle" src="{{ asset('storage/images/'.Auth::user()->photo) }}">
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                  <a class="dropdown-item" href="{{route('employee.profile',Auth::user()->id)}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                  </a>
                                  <div class="dropdown-divider"></div>

                                  <a class="dropdown-item" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                   <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                   {{ __('Logout') }}
                               </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                           
                        @endguest



          </ul>

        </nav>

       <div class="container-fluid" >
          
        @yield("content")
       
        </div>

      </div>


    </div>
    <div id="chat-overlay" class="row"></div>

  </div>
  
  <footer class="sticky-footer  py-3 mt-auto " style="background-color: #224abe !important;color: #d0d5f2;"  >
    <div class="container my-auto"  >
      <div class="copyright text-center my-auto">
        <span>Copyright &copy; EMS 2021</span>
      </div>
    </div>
  </footer>




  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
    @yield('scripts')
  </body>

</html>
