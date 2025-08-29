@extends('welcomelayout')
@section('mainpage')
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
            <a href="{{route('domicile')}}">
						<div class="services-2 text-center ftco-animate fadeInUp ftco-animated">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-business"></span></div>
							<div class="text media-body">
                                <h3><i style="font-size:48px" class="fas fa-passport"></i></h3>
								<h3>Domicile Certificate</h3>
								<p>An essential document for addmission in educational institutions and jobs.</p>
							</div>
						</div>
            </a>
					</div>
					<div class="col-lg-4 d-flex">
            <a href="{{route('idp')}}">
						<div class="services-2 text-center ftco-animate fadeInUp ftco-animated">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-insurance"></span></div>
							<div class="text media-body">
                                <h3><i style="font-size:48px" class="fas fa-id-card"></i></h3>
								<h3>International Driving Permit</h3>
								<p>An important document for traverllers who are visiting abroad.</p>
							</div>
						</div>
            </a>
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
@endsection