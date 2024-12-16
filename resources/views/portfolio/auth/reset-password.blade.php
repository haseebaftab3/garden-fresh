 <html class="no-js" lang="en">



 <head>
     <meta charset="utf-8">
     <meta http-equiv="x-ua-compatible" content="ie=edge">
     <title>Reset Password | Pets Medic</title>
     <meta name="description" content="Reset Password | Pets Medic">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
     <!-- Place favicon.ico in the root directory -->

     <!-- CSS here -->
     <!-- CSS here -->
     <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/flaticon_pet_care.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/odometer.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
 </head>

 <body>

     <!--Preloader-->
     <div id="preloader">
         <div id="loader" class="loader">
             <div class="loader-container">
                 <div class="loader-icon"><img src="{{ asset('assets/img/logo/preloader.svg') }}" alt="Preloader">
                 </div>
             </div>
         </div>
     </div>
     <div id="sticky-header" class="tg-header__area tg-header__area-three">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12 py-4">
                     <div class="tgmenu__wrap">
                         <div class="row align-items-center">

                             <div class="col-xl-2 col-md-4">
                                 <div class="logo text-center">
                                     <a href="/"><img src="{{ asset('assets/img/logo/w_logo.png') }}"
                                             alt="Logo"></a>
                                 </div>
                             </div>

                         </div>

                     </div>


                 </div>
             </div>
         </div>
     </div>

     <!--Preloader-end -->
     <section class="contact__area">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6 offset-3">
                     <div class="contact__form-wrap">
                         <form method="POST" action="{{ route('password.store') }}" class="contact__form">
                             @csrf

                             <!-- Password Reset Token -->
                             <input type="hidden" name="token" value="{{ $request->route('token') }}">

                             <h2 class="title text-center mb-4">Reset Password</h2>

                             <!-- Email Address -->
                             <div class="form-grp mb-3">
                                 <label for="email" class="form-label">{{ __('Email') }}</label>
                                 <input id="email" class="form-control @error('email') is-invalid @enderror"
                                     type="email" name="email" :value="old('email', $request - > email)" required
                                     autofocus autocomplete="username">
                                 @error('email')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>

                             <!-- Password -->
                             <div class="form-grp mb-3">
                                 <label for="password" class="form-label">{{ __('Password') }}</label>
                                 <input id="password" class="form-control @error('password') is-invalid @enderror"
                                     type="password" name="password" required autocomplete="new-password">
                                 @error('password')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>

                             <!-- Confirm Password -->
                             <div class="form-grp mb-3">
                                 <label for="password_confirmation"
                                     class="form-label">{{ __('Confirm Password') }}</label>
                                 <input id="password_confirmation" class="form-control" type="password"
                                     name="password_confirmation" required autocomplete="new-password">
                             </div>

                             <div class="d-flex justify-content-end mt-4">
                                 <button type="submit" class="btn btn-primary">
                                     {{ __('Reset Password') }}
                                 </button>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>

         </div>
     </section>

     <!-- JS here -->
     <!-- JS here -->
     <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
     <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
     <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
     <script src="{{ asset('assets/js/jquery.odometer.min.js') }}"></script>
     <script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
     <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
     <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
     <script src="{{ asset('assets/js/svg-inject.min.js') }}"></script>
     <script src="{{ asset('assets/js/select2.min.js') }}"></script>
     <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
     <script src="{{ asset('assets/js/ajax-form.js') }}"></script>
     <script src="{{ asset('assets/js/wow.min.js') }}"></script>
     <script src="{{ asset('assets/js/aos.js') }}"></script>
     <script src="{{ asset('assets/js/main.js') }}"></script>

     <script>
         SVGInject(document.querySelectorAll("img.injectable"));
     </script>
 </body>

 </html>
