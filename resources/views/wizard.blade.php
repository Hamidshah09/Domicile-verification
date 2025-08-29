<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Slide Presentation</title>
    <style>
        * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body,
html {
  height: 100%;
  font-family: "Segoe UI", sans-serif;
  overflow: hidden;
}

#slideshow {
  height: 100vh;
  width: 100vw;
  position: relative;
}

.slide {
  position: absolute;
  height: 100%;
  width: 100%;
  padding: 50px;
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: white;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  opacity: 0;
  transform: translateX(100%);
  transition: all 0.7s ease;
  z-index: 0;
}

.slide.active {
  opacity: 1;
  transform: translateX(0);
  z-index: 1;
}

.heading {
  font-size: 3rem;
  margin-bottom: 20px;
  animation: fadeInUp 1s ease;
}

.para {
  font-size: 1.5rem;
  animation: fadeInUp 1.2s ease;
  text-align: justify;
}

.footer {
  border: 1px solid black;
  width: 100%;
  min-height: auto;
  display: flex;
  justify-content: end;
}

/* CSS */
.button-15 {
  margin-top: 10px;
  border-radius: 4px;
  box-sizing: border-box;
  color: #ffffff;
  cursor: pointer;
  direction: ltr;
  display: block;
  font-family: "SF Pro Text", "SF Pro Icons", "AOS Icons", "Helvetica Neue",
    Helvetica, Arial, sans-serif;
  font-size: 17px;
  font-weight: 400;
  letter-spacing: -0.022em;
  line-height: 1.47059;
  min-width: 70px;
  overflow: visible;
  padding: 4px 15px;
  text-align: center;
  /* vertical-align: baseline; */
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  white-space: nowrap;
  transition: box-shadow 0.3s ease, transform 0.2s ease;
  animation: fadeInUp 1.4s ease;
}
.button-15.primary {
  background-image: linear-gradient(135deg, #667eea, #4b4ba2);
  border: 1px solid #0077cc;
}
.button-15.secondary {
  background-image: linear-gradient(135deg, #ea7e66, #e03535);
  border: 1px solid #cc0000;
}
.button-15:disabled {
  cursor: default;
  opacity: 0.3;
}

.button-15:active {
  background-image: linear-gradient(#3d94d9, #0067b9);
  border-color: #006dbc;
  outline: none;
}

.button-15.primary:hover,
.button-15.primary:focus-visible {
  background-image: linear-gradient(#51a9ee, #147bcd);
  border-color: #1482d0;
}

.button-15.secondary:hover,
.button-15.secondary:focus-visible {
  background-image: linear-gradient(#ee5151, #cd1414);
  border-color: #d01414;
}
.content-div {
  width: 50%;
}
.button-div {
  margin-top: 20px;
  display: flex;
  justify-content: space-around;
}
.justified-text {
  text-align: justify;
}
.d-flex {
  display: flex;
}
.flex-row {
  flex-direction: row;
}
.flex-col {
  flex-direction: column;
}
.justify-content-center {
  justify-content: center;
}
.align-items-center {
  align-items: center;
}
.mx-1 {
  margin-top: 1rem;
  margin-bottom: 1rem;
}
.mt-1 {
  margin-top: 1rem;
}
.mt-2 {
  margin-top: 2rem;
}
.list {
  margin-top: 10px;
  margin-left: 30px;
  font-size: 1rem;
  font-weight: bold;
}
.sub-list {
  margin-left: 20px;
  font-size: 1rem;
  font-weight: normal;
}
@keyframes fadeInUp {
  from {
    transform: translateY(40px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

    </style>
  </head>
  <body>
    <div id="slideshow">
      <section class="slide active" id="slide1">
        <h1 class="heading"><a style="text-decoration: none;color:white" href="/">Citizen Facilition Center</a></h1>
        <p class="para">Determination of Domicile Eligiblity</p>
        <button
          id="start"
          onclick="showSlide(1)"
          class="button-15 primary mt-2"
          role="button"
        >
          Start
        </button>
      </section>
      <!-- Slide 0 end -->
      <!-- Slide 1 start -->
      <section class="slide">
        <div class="content-div">
          <h1 class="heading">Age</h1>
        </div>
        <div class="content-div">
          <p class="para">Are you 21 years old, on todays date?</p>
        </div>
        <div class="content-div button-div">
          <button
            onclick="showSlide(13)"
            class="button-15 secondary"
            role="button"
          >
            No
          </button>
          <button
            onclick="showSlide(2)"
            class="button-15 primary"
            role="button"
          >
            Yes
          </button>
        </div>
      </section>
      <!-- slide 1 end -->
      <!-- Slide 2 start -->
      <section class="slide">
        <div class="content-div">
          <h1 class="heading">CNIC</h1>
        </div>
        <div class="content-div">
          <p class="para">
            Does your CNIC contains a present or permanent address in Islamabad?
          </p>
        </div>
        <div class="content-div button-div">
          <button
            onclick="showSlide(3)"
            class="button-15 secondary"
            role="button"
          >
            No
          </button>
          <button
            onclick="showSlide(4)"
            class="button-15 primary"
            role="button"
          >
            Yes
          </button>
        </div>
      </section>
      <!-- slide 2 end -->
      <!-- slide 3 start -->
      <section class="slide" id="no_address">
        <div class="content-div">
          <h1 class="heading">Sorry!</h1>
        </div>
        <div class="content-div">
          <p class="para">
            You can not apply for the domicile due to conflict with clause 1 of
            SOP. Accoridng to clause 1 of SOP, applicant must have at least one
            address(present or permanent) of islamabad on his CNIC.
          </p>
        </div>
        <div class="content-div button-div">
          <button
            onclick="showSlide(0)"
            class="button-15 primary"
            role="button"
          >
            Back to Start
          </button>
        </div>
      </section>
      <!-- slide 3 end -->
      <!-- slide 4 start -->
      <section class="slide">
        <div class="content-div">
          <h1 class="heading">CNIC</h1>
        </div>
        <div class="content-div">
          <p class="para">
            Is the date of issue on your CNIC is at least one year old?
          </p>
        </div>
        <div class="content-div button-div mt-1">
          <button
            onclick="showSlide(5)"
            class="button-15 secondary"
            role="button"
          >
            No
          </button>
          <button
            onclick="showSlide(6)"
            class="button-15 primary"
            role="button"
          >
            Yes
          </button>
        </div>
      </section>
      <!-- slide 4 end -->
      <!-- slide 5 start -->
      <section class="slide" id="no_address">
        <div class="content-div">
          <h1 class="heading">Sorry!</h1>
        </div>
        <div class="content-div">
          <p class="para">
            You can not apply for the domicile due to conflict with clause 1 of
            SOP. Accoridng to clause 1 of SOP, applicant must have at least one
            year old cnic issued.
          </p>
        </div>
        <div class="content-div button-div">
          <button
            onclick="showSlide(0)"
            class="button-15 primary"
            role="button"
          >
            Back to Start
          </button>
        </div>
      </section>
      <!-- slide 5 end -->

      <!-- Slide 6 start -->
      <section class="slide">
        <div class="content-div">
          <h1 class="heading">Addresses</h1>
        </div>
        <div class="content-div">
          <p class="para">
            Do you have any of following one year old documentation, for the
            address mentioned on your cnic?
          </p>
          <div class="content-div">
            <ul class="list">
              <li>
                Ownership documents
                <ul class="sub-list">
                  <li>on your name</li>
                  <li>on your father name</li>
                  <li>on your mother name</li>
                  <li>on your sister name</li>
                  <li>on your uncle name</li>
                </ul>
              </li>
              <li>
                Rent Agreement
                <ul class="sub-list">
                  <li>with the consent of Owner of the House.</li>
                </ul>
              </li>
              <li>
                Residence Certificate
                <ul class="sub-list">
                  <li>
                    if living in govt aquired land (issued from Union Councel).
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <div class="content-div button-div">
          <button
            onclick="showSlide(7)"
            class="button-15 secondary"
            role="button"
          >
            No
          </button>
          <button
            onclick="showSlide(8)"
            class="button-15 primary"
            role="button"
          >
            Yes
          </button>
        </div>
      </section>
      <!-- Slide 6 end -->
      <!-- slide 7 start -->
      <section class="slide" id="no_address">
        <div class="content-div">
          <h1 class="heading">Sorry!</h1>
        </div>
        <div class="content-div">
          <p class="para">
            You can not apply for the domicile due to conflict with clause 6 of
            SOP. Accoridng to clause 6 of SOP, applicant will provide residece
            prof for the address mentioned on cnic.
          </p>
        </div>
        <div class="content-div button-div">
          <button
            onclick="showSlide(0)"
            class="button-15 primary"
            role="button"
          >
            Back to Start
          </button>
        </div>
      </section>
      <!-- slide 7 end -->
      <!-- slide 8 start -->
      <section class="slide">
        <div class="content-div">
          <h1 class="heading">Addresses</h1>
        </div>
        <div class="content-div">
          <p class="para">
            Does your CNIC contains both addresses (present and permanent) of
            Islamabad?
          </p>
        </div>
        <div class="content-div button-div">
          <button
            onclick="showSlide(9)"
            class="button-15 secondary"
            role="button"
          >
            No
          </button>
          <button
            onclick="showSlide(11)"
            class="button-15 primary"
            role="button"
          >
            Yes
          </button>
        </div>
      </section>
      <!-- slide 8 end -->
      <!-- slide 9 start -->
      <section class="slide">
        <div class="content-div">
          <h1 class="heading">NOC</h1>
        </div>
        <div class="content-div">
          <p class="para">
            If your cnic contains any other district address, we will required a
            verification report from concerned district wether you obtain
            domicile from that district or not. Remember, if you are holding a
            domicile from any other district, do not cancel it. Becuase
            according to clause 6 of SOP, you will have to wait one year from
            date of cancellation of domicile. Did you get that NOC/verification
            letter from concerned district?
          </p>
        </div>
        <div class="content-div button-div">
          <button
            onclick="showSlide(10)"
            class="button-15 secondary"
            role="button"
          >
            No
          </button>
          <button
            onclick="showSlide(11)"
            class="button-15 primary"
            role="button"
          >
            Yes
          </button>
        </div>
      </section>
      <!-- slide 9 end -->
      <!-- slide 10 start -->
      <section class="slide" id="no_address">
        <div class="content-div">
          <h1 class="heading">Sorry!</h1>
        </div>
        <div class="content-div">
          <p class="para">
            You can not apply for the domicile due to conflict with clause 5 of
            SOP. Accoridng to clause 5 of SOP, applicant will provide
            NOC/verification report from concerned district.
          </p>
        </div>
        <div class="content-div button-div">
          <button
            onclick="showSlide(0)"
            class="button-15 primary"
            role="button"
          >
            Back to Start
          </button>
        </div>
      </section>
      <!-- slide 10 end -->
      <!-- slide 11 start -->
      <section class="slide" id="no_address">
        <div class="content-div">
          <h1 class="heading">Congratulations!</h1>
        </div>
        <div class="content-div">
          <p class="para">
            You are eligible to apply for domicile. Please bring following
            documents to apply for the domicile:-
          </p>
          <ul class="list">
            <li>Copy of CNIC</li>
            <li>Form P (duly filled)</li>
            <li>1 Passport Size Picture</li>
            <li>Residence Prof for the given address</li>
            <li>utlitiy bill</li>
            <li>
              Copy of father's/mother's domicile if applicant age is under 21
            </li>
            <li>Affidavit</li>
          </ul>
        </div>
        <div class="content-div button-div">
          <button
            onclick="showSlide(0)"
            class="button-15 primary"
            role="button"
          >
            Back to Start
          </button>
        </div>
      </section>
      <!-- slide 11 end -->
      <!-- slide 12 start -->
      <section class="slide">
        <div class="content-div">
          <h1 class="heading">Congratulations!</h1>
        </div>
        <div class="content-div">
          <p class="para">
            You are eligible to apply for domicile. Please bring following
            documents to apply for the domicile:-
          </p>
          <ul class="list">
            <li>Copy of CNIC</li>
            <li>Form P (duly filled)</li>
            <li>1 Passport Size Picture</li>
            <li>NOC from other district (in orignal)</li>
            <li>Residence Prof for the given address</li>
            <li>
              Copy of father's/mother's domicile if applicant age is under 21
            </li>
            <li>utlitiy bill</li>
            <li>Affidavit</li>
          </ul>
        </div>
        <div class="content-div button-div">
          <button
            onclick="showSlide(0)"
            class="button-15 primary"
            role="button"
          >
            Back to Start
          </button>
        </div>
      </section>
      <!-- slide 12 end -->
      <!-- slide 13 start -->
      <section class="slide">
        <div class="content-div">
          <h1 class="heading">Parents Domicile</h1>
        </div>
        <div class="content-div">
          <p class="para">
            If your age is less than 21 years. It means you are minor and you
            are dependent on your parents under the law. You can only apply to
            that district where you parents are domiciled. Therefore, any one
            from your parents shall have Islamabad domicile or they may also
            apply for the domicile if they don't have one. This wizard will be
            continued for you considering that any one from your parents have
            Islamabad domiicle.
          </p>
        </div>
        <div class="content-div button-div">
          <button
            onclick="showSlide(2)"
            class="button-15 primary"
            role="button"
          >
            Continue
          </button>
        </div>
      </section>
      <!-- slide 13 end -->
    </div>

    <script>
        const slides = document.querySelectorAll(".slide");

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.remove("active");
  });
  slides[index].classList.add("active");
}

    </script>
  </body>
</html>
