@extends('welcomelayout')
@section('mainpage')
<main class="main">
    <section class="ftco-section w-full servcies-background">
			<div class="container blur-effect rounded">
				<div class="row justify-content-center mb-2 pb-2">
            <div class="col-md-8 text-center heading-section ftco-animate fadeInUp ftco-animated my-5">
                <h1 class="text-2xl font-bold text-shadow-lg">Domicile Certificate</h1>
            </div>
            <div class="px-12 text-justify">
              <p class="text-justify">A Domicile Certificate is a time-bound document. This means that eligibility is assessed based on your current documentation, and you cannot retroactively make yourself eligible by updating or altering documents.
              </p>
              <p>For Example:</p>
              <ul class="list-disc pl-5">
                <li class="text-justify">If your CNIC does not currently show an Islamabad address and you update it to reflect one, you will become eligible for an ICT domicile only after one year from the date of the CNIC update.</li>
                <li class="text-justify">Similarly, if you currently possess a domicile from another district and choose to cancel it in order to apply for an ICT domicile, you will be eligible one year after the date of cancellation.</li>
              </ul>
              <p class="text-justify">This wizard will check your eligiblity to apply for domicile. <a class="font-bold underline" href="{{route('wizard')}}">click here</a></p>
            </div>
            <div class="px-12 mt-2 w-full" >
              <h2 class="font-xl underline underline-offset-4 mb-2">Documents Required</h2>
              <hr>
              <h4>For the applicants who attained the age of 21 years (major)</h4>
              <ul class="list-disc pl-5">
                <li>Copy of CNIC of Applicant (must be 01-year old and contain at least one Islamabad address)</li>
                <li>Copy of Proof of Residence in Islamabad (Allotment letter or Lease agreement or residence certificate)</li>
                <li>One original utility bill (Electricity, Gas or Telephone) of the residence</li>
                <li>NOC from other district (if any one address is other than Islamabad )</li>
                <li>Copy of Form-B (if you have children)</li>
                <li>One Passport size photographs</li>
                <li>Affidavit for domicile</li>
                </ul>
            </div>
            <div class="px-12 my-2 mb-2 w-full">
              <h4>For the applicants who are under 21 years of age (minor)</h4>
              <ul class="list-disc pl-5">
                <li>Copy of CNIC of Applicant (must be 01-year old and contain at least one Islamabad address)</li>
                <li>Copy of Proof of Residence in Islamabad (Allotment letter or Lease agreement or residence certificate)</li>
                <li>One original utility bill (Electricity, Gas or Telephone) of the residence</li>
                <li>NOC from other district (if any one address is other than Islamabad )</li>
                <li>Copy of Form-B (if you have children)</li>
                <li>One Passport size photographs</li>
                <li>Affidavit for domicile</li>
                </ul>
            </div>
            <div class="px-12 mt-2 mb-3 w-full" >
              <h2 class="font-xl underline underline-offset-4 mb-2">Step by step procedure</h2>
              <hr>
              <p class="text-justify">
                <ol class="list-disc pl-5">
                  <li>Each applicant shall have to submit seprate file which include all above documents.</li>
                  <li>Any one can submit documents on behalf of applicant. Applicants presence are requred on second stage after approval for biomatric and live picture in CFC.</li>
                  <li>Upon submission of docments, inital slip for documents reciving will be issued to the applicants, which contains expected approval date (max 3 days)</li>
                  <li>on expected approval date, every applicants needs to be present at CFC.</li>
                  <li>domicile will be issued after due process on same day. </li>
                </ol>
              </p>
            </div>
        </div>
			</div>
		</section>
</main>
@endsection