<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Dashmix - Bootstrap 5 Admin Template &amp; UI Framework</title>
    <meta name="description" content="Dashmix - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Dashmix - Bootstrap 5 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="Dashmix">
    <meta property="og:description" content="Dashmix - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('admin/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('admin/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin/media/favicons/apple-touch-icon-180x180.png') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" id="css-main" href="{{ asset('admin/css/dashmix.min.css') }}">
  </head>

  <body>
    <div id="page-container">
      <main id="main-container">
        <div class="bg-image" style="background-image: url('{{ asset('admin/media/photos/photo16@2x.jpg') }}');">
          <div class="row g-0 justify-content-center bg-black-75">
            <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
              <!-- Reminder Block -->
              <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
                  <!-- Header -->
                  <div class="mb-2 text-center">
                    <a class="link-fx fw-bold fs-1" href="index.html">
                      <span class="text-dark">Dash</span><span class="text-primary">mix</span>
                    </a>
                    <p class="text-uppercase fw-bold fs-sm text-muted">Quên mật khẩu</p>
                  </div>
                  @if (session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                  @endif

                  @if (session('error'))
                      <div class="alert alert-danger">
                          {{ session('error') }}
                      </div>
                  @endif
                  <form class="js-validation-reminder" action="{{ route('admin.send-otp') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                      <div class="input-group input-group-lg">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="reminder-credential" name="email" placeholder="Email" value="{{ old('email') }}" >
                        <span class="input-group-text">
                          <i class="fa fa-user-circle"></i>
                        </span>
                      </div>
                      @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-center mb-4">
                      <button type="submit" class="btn btn-hero btn-primary">
                        <i class="fa fa-fw fa-reply opacity-50 me-1"></i> Reset Password
                      </button>
                    </div>
                  </form>
                  <!-- END Reminder Form -->
                </div>
              </div>
              <!-- END Reminder Block -->
            </div>
          </div>
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->
    </div>

    <!-- Scripts -->
    <script src="{{ asset('admin/js/dashmix.app.min.js') }}"></script>

    <!-- jQuery (required for jQuery Validation plugin) -->
    <script src="{{ asset('admin/js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('admin/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('admin/js/pages/op_auth_reminder.min.js') }}"></script>
  </body>
</html>
