<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


  <!-- Favicons -->
  <!-- <link href="public/Admin/assets/img/favicon.png" rel="icon"> -->
  <!-- <link href="public/Admin/assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="{{ asset('public/js/main.js') }}" defer></script>


  <!-- Vendor CSS Files -->
  <link href="public/Admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="public/Admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="public/Admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="public/Admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="public/Admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="public/Admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="public/Admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="{{ asset('public/css/login_page.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="public/Admin/assets/css/style.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('/admin') }}" class="logo text-center">
	  	<img src="{{asset('public/logo/logo.png')}}" alt="logo">
        <!-- <span class="d-none d-lg-block">NiceAdmin</span> -->
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">



        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!-- <img src="public/Admin/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
            <span class="d-none d-md-block dropdown-toggle ps-2"> {{ Auth::user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6> {{ Auth::user()->name }}</h6>
              <span>Admin</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
				<!-- <a class="dropdown-item d-flex align-items-center" href="#">
					<i class="bi bi-box-arrow-right"></i>
					<span>Sign Out</span>

				</a> -->
				<a class="dropdown-item" href="{{ route('logout') }}"
					onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">
					<i class="bi bi-box-arrow-right"></i> {{ __('Logout') }}
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
					@csrf
				</form>
            </li>

			<li>
				
			</li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link active" href="{{url('/admin')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link " href="{{url('/admin')}}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li> -->
	  <!-- End Profile Page Nav -->


    </ul>

  </aside><!-- End Sidebar-->

	<main id="main" class="main">

		<section class="section dashboard">
			<div class="row">
				@yield('content')
			</div>
		</section>

	</main><!-- End #main -->

 

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->


  <script src="public/Admin/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="public/Admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="public/Admin/assets/vendor/chart.js/chart.min.js"></script>
  <script src="public/Admin/assets/vendor/echarts/echarts.min.js"></script>
  <script src="public/Admin/assets/vendor/quill/quill.min.js"></script>
  <script src="public/Admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="public/Admin/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="public/Admin/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="public/Admin/assets/js/main.js"></script>

</body>

</html>