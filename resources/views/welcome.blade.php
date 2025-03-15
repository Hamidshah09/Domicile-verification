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
        <link rel="stylesheet" href="{{asset('build/fontawesome/css/all.min.css')}}">
        <!-- Styles / Scripts -->
        <link rel="stylesheet" href="{{asset('build/assets/animate.css')}}">
        <link rel="stylesheet" href="{{asset('build/assets/style.css')}}">
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{asset('build/assets/welcome.css')}}">
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

        <main class="main">
        <section class="main-title">
            <p class="lighter-font ml-5 text-white">Wellcome</p>
            <p class="bigger-font ml-5 text-white">Citizen Facilitation Center</p>
        </section>
        
        <section class="ftco-section w-full servcies-background">
			<div class="container blur-effect rounded">
				<div class="row justify-content-center mb-2 pb-2">
                    <div class="col-md-8 text-center heading-section ftco-animate fadeInUp ftco-animated my-5">
                        <h2 class="mb-2">Our Services</h2>
                        <p>Citizen Facilitation Center offers multiple services under one roof</p>
                    </div>
                </div>
				<div class="row no-gutters">
					<div class="col-lg-4 d-flex">
						<div class="services-2 noborder-left text-center ftco-animate fadeInUp ftco-animated">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-analysis"></span></div>
							<div class="text media-body">
                                <h3><i style="font-size:48px" class="fas fa-shield-alt"></i></h3>
								<h3>Arms Licenses</h3>
								<p>Renewal of Arms license were never easy before.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-flex">
						<div class="services-2 text-center ftco-animate fadeInUp ftco-animated">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-business"></span></div>
							<div class="text media-body">
                                <h3><i style="font-size:48px" class="fas fa-passport"></i></h3>
								<h3>Domicile Certificate</h3>
								<p>An essential document for addmission in educational institutions and jobs.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-flex">
						<div class="services-2 text-center ftco-animate fadeInUp ftco-animated">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-insurance"></span></div>
							<div class="text media-body">
                                <h3><i style="font-size:48px" class="fas fa-id-card"></i></h3>
								<h3>International Driving Permit</h3>
								<p>An important document for traverllers who are visiting abroad.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-flex">
						<div class="services-2 noborder-left noborder-bottom text-center ftco-animate fadeInUp ftco-animated">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-money"></span></div>
							<div class="text media-body">
                                <h3><i style="font-size:48px" class="fas fa-file-contract"></i></h3>
								<h3>Birth/Death  Certificate</h3>
								<p>Digital event certificate, required for visa.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-flex">
						<div class="services-2 text-center noborder-bottom ftco-animate fadeInUp ftco-animated">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-rating"></span></div>
							<div class="text media-body">
                                <h3><i style="font-size:48px" class="fas fa-file-alt"></i></h3>
								<h3>Marriage/Divorce Certificate</h3>
								<p>Digital event certificate, required for visa</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-flex">
						<div class="services-2 text-center noborder-bottom ftco-animate fadeInUp ftco-animated">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-search-engine"></span></div>
							<div class="text media-body">
                                <h3><i style="font-size:48px" class="fas fa-file-invoice"></i></h3>
								<h3>Police Character Certificate</h3>
								<p>A digital verification document for individuals which serves many purposes.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
        <section class="ftco-intro ftco-no-pb img w-full">
            <div class="container">
                <div class="row justify-content-center mb-5">
              <div class="col-md-10 text-center heading-section heading-section-white ftco-animate fadeInUp ftco-animated">
                <h2 class="mb-0">You Always Get the Best Guidance</h2>
              </div>
            </div>	
            </div>
        </section>
        <section class="ftco-counter w-full" id="section-counter">
            <div class="container">
                <div class="row d-md-flex align-items-center justify-content-center">
                    <div class="wrapper">
                        <div class="row d-md-flex align-items-center">
                      <div class="col-md d-flex justify-content-center counter-wrap ftco-animate fadeInUp ftco-animated">
                        <div class="block-18">
                            <div class="icon"><span class="flaticon-doctor"></span></div>
                          <div class="text">
                            <strong class="number" data-number="705">705</strong>
                            <span>Daily Visitors</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md d-flex justify-content-center counter-wrap ftco-animate fadeInUp ftco-animated">
                        <div class="block-18">
                            <div class="icon"><span class="flaticon-doctor"></span></div>
                          <div class="text">
                            <strong class="number" data-number="695">695</strong>
                            <span>Domicile issued</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md d-flex justify-content-center counter-wrap ftco-animate fadeInUp ftco-animated">
                        <div class="block-18">
                            <div class="icon"><span class="flaticon-doctor"></span></div>
                          <div class="text">
                            <strong class="number" data-number="335">120</strong>
                            <span>IDP Issued</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md d-flex justify-content-center counter-wrap ftco-animate fadeInUp ftco-animated">
                        <div class="block-18">
                            <div class="icon"><span class="flaticon-doctor"></span></div>
                          <div class="text">
                            <strong class="number" data-number="35">35</strong>
                            <span>Marriage Certificates</span>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
            </div>
        </section>
        </main>
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
