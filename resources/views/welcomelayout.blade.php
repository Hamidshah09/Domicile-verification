<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CFC App</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('customassets/fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('customassets/custom.css')}}">
        <!-- Styles / Scripts -->
        <link rel="stylesheet" href="{{asset('customassets/animate.css')}}">
        <link rel="stylesheet" href="{{asset('customassets/style.css')}}">
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{asset('customassets/welcome.css')}}">
        @endif
    </head>
    <body>
        <header>
            @if (Route::has('login'))
                <nav class="flex flex-1 justify-end blur-effect p-2">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        
        @yield('mainpage')
        
        <footer class="ftco-footer ftco-bg-dark ftco-section">
            <div class="container">
              <div class="row mb-2">
                <div class="col-md-6 col-lg-6">
                  <div class="ftco-footer-widget mb-2">
                      <h2 class="ftco-heading-2">Have a Questions?</h2>
                      <div class="block-23 mb-3">
                        <ul>
                          <li><i class="fas fa-map-marker-alt mx-2"></i><span class="text">ICT Complex, Mauve Area, G-11/4, Islamabad </span></li>
                          <li><a href="#"><i class="fas fa-phone mx-2"></i></span><span class="text">+920518899611</span></a></li>
                          <li><a href="#"><i class="fas fa-envelope mx-2"></i><span class="text">citizenfacalitationcenter@gmail.com</span></a></li>
                        </ul>
                      </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6">
                  <div class="ftco-footer-widget mb-5 ml-md-4">
                    <h2 class="ftco-heading-2">Usefull Links</h2>
                    <ul class="list-unstyled">
                      <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>ICT Administraion</a></li>
                      <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Excise & Taxation Department, Islamabad</a></li>
                      
                    </ul>
                  </div>
                </div>
              
              </div>
              <div class="row">
                <div class="col-md-12 text-center">
      
                  <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright ©<script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script><script>document.write(new Date().getFullYear());</script> All rights reserved  by ICT Administration
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
              </div>
            </div>
          </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="{{asset('build/assets/jquery.min.js')}}"></script>
        <script src="{{asset('build/assets/jquery.animateNumber.min.js')}}"></script>
        <script src="{{asset('build/assets/scrollax.min.js')}}"></script>
    </body>
</html>
