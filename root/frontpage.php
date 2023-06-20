<!doctype html>
<html lang="en">

<head>
  <title>Frontpage</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <link rel="stylesheet" href="Admin/css/mdb.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="Admin/img/batangascitylogo.png" type="image/x-icon">
	<link rel="shortcut icon" href="Admin/img/batangascitylogo.png" type="image/x-icon">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <main class="main">
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <button class="navbar-toggler text-light" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <a class="navbar-brand mt-2 mt-lg-0" href="#">
            <img src="Admin/img/batangascitylogo.png" height="45" alt="CDRRMO Logo" loading="lazy" />
          </a>
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-light" href="#about-us">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="#maps">Map</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="#how-to">How to donate?</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="#contact-us">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!--Navbar-->
    <!--Section 1-->
    <section class="Homepage d-block justify-content-center" id="Homepage">
      <div id="cddrrmo" class="carousel slide carousel-fade" data-mdb-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-mdb-target="#cddrrmo" data-mdb-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-mdb-target="#cddrrmo" data-mdb-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-mdb-target="#cddrrmo" data-mdb-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="Admin/img/photo1.png" class="d-block w-100 carousel-image" alt="Photo 1" />
          </div>
          <div class="carousel-item">
            <img src="Admin/img/photo2.jpg" class="d-block w-100 carousel-image" alt="Photo 2" />
          </div>
          <div class="carousel-item">
            <img src="Admin/img/photo3.jpg" class="d-block w-100 carousel-image" alt="Photo 3" />
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-mdb-target="#cddrrmo" data-mdb-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#cddrrmo" data-mdb-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <div class="pt-3">
        <h1 class="text-success text-center fw-bold">City Risk Reduction Management Office</h1>
        <h3 class="text-success text-center mb-0 pb-5">in Batangas City</h3>
      </div>
    </section>
    <!--Section 1-->

    <!--Section 2-->
    <section class="mission-vision d-block">
      <div class="d-flex justify-content-start ms-5 me-5 pb-5">
        <div class="mt-5 me-2">
          <h3>Mission</h3>
          <p class="text-wrap fs-6 fw-light text-muted lead">The Batangas City Disaster Risk Reduction Management Office aims to advance policy, reduce disaster risks,
            manage and analyze the casual factors of disaster, reduce exposure to hazards, lessen vulnerability of
            people and property, wise management of land and the environment, and improved preparedness in developing
            and implementing best practices in disaster risk reduction and mitigation program.
            <br>The office aims to continue the development, minimize the risk and vulnerabilities, limit the adverse
            impact of hazards, ensure the safety and security of Batangueños, and to enhance the contributions of
            City Disaster Risk Reduction and Management Office, in a more cost-effective, systematic and sustainable manner,
            towards the protection of lives, livelihoods and property, through enhanced capabilities and cooperation in the field
            of disaster risk reduction.
          </p>
        </div>
        <div>
          <img src="Admin/img/batangascitylogo.png" class="bg-image img-thumbnail mt-5 img-fluid h-75 w-100" alt="Logo">
        </div>
      </div>
      <div class="d-flex justify-content-start ms-5 me-5">
        <div>
          <img src="Admin/img/photo4.jpg" class="bg-image img-thumbnail  img-fluid h-75 mt-5 w-100" alt="Photo 4">
        </div>
        <div class="pt-5 ms-4">
          <h3>Vision</h3>
          <p class="text-wrap fs-6 fw-light text-muted lead">The Batangas City Disaster Risk Reduction and Management Office seeks
            to provide an effective approach in disaster management towards the protection of lives, livelihoods and property caused
            by both natural and human induced hazards through innovation, coordination and partnership, and build a safe, adaptive
            and resilient Batangas City.</p>
        </div>
      </div>
    </section>
    <!--Section 2-->

    <!--Section 3-->
    <section class="how-to-donate pt-5" id="how-to">
      <div class="pb-5">
        <h1 class="mb-0 ms-5">How to donate?</h1>
        <p class=" mb-0 ms-5 me-5 text-muted fs-6 lead pt-2">Please be aware that if you want to donate, we no longer accept used clothing,
          used shoes, baby formula milks, and anything that can't be kept for an extended amount of time. Before visiting the relief hub,
          you can complete out this form that you can download. Your donation will be encoded using this form.</p>
        <div class="pt-3 ms-5">
          <ul class="list-unstyled">
            <li class="mb-1 lead"><i class="fa-solid fa-check text-success"></i></i> <strong>Step 1.</strong> Fill up the form provided</li>
            <li class="mb-1 lead"><i class="fa-solid fa-check text-success"></i></i> <strong>Step 2.</strong> Write down every item you want to give under its respective category.</li>
            <li class="mb-1 lead"><i class="fa-solid fa-check text-success"></i></i> <strong>Step 3.</strong> Visit the CDRRMO office at Brgy. Bolbok, Batangas City, and hand in your donation and form.</li>
          </ul>
        </div>
        <div class="d-flex justify-content-center">
          <a href="include/Form.docx" class="btn btn-success float-end" download>Download</a>
        </div>
      </div>
    </section>
    <!--Section 3-->

    <!--Section 4-->
    <section class="about-us pt-5" id="about-us">
      <h2 class="text-success text-center fw-bold">About Us</h2>
      <p class="text-center fs-6 text-wrap text-muted lead me-5  ms-5 pb-3">Batangas City's City Disaster Risk Reduction and Management Office (CDRRMO) is a
        government agency for disaster risk reduction that is overseen by  Mayor Beverly Dimacuha. Bolbok barangay in Batangas City is
        where our office is situated. Donations of canned goods, noodles, hygiene essentials, ppe, pharmaceuticals, meat, grains,
        drinking water, and baby supplies are also welcome. In addition, we operate a facility called the relief hub, where we receive
        and keep donations.
      </p>
      <div class="pb-5">
        <img src="Admin/img/organizational-chart.jpg" class="w-100" alt="Org Chart">
        <figcaption class="blockquote-footer text-end me-3">
          Source: <cite title="Source Title">https://www.batangascity.gov.ph/</cite>
        </figcaption>
      </div>
    </section>
    <!--Section 4-->

    <!--Section 5-->
    <section class="contact-us pt-5" id="contact-us">
      <h2 class="text-success text-center fw-bold pb-4">Contact Us <i class="fa-solid fa-phone"></i></h2>
      <div class="pb-5 d-flex justify-content-center">
        <form class="border rounded p-4 shadow bg-light" id="contact_us">
          <div class="row">
            <div class="col">
              <div class="form-outline mb-4">
                <input type="text" id="firstname" class="form-control" />
                <label class="form-label" for="firstname">First Name</label>
              </div>
            </div>
            <div class="col">
              <div class="form-outline mb-4">
                <input type="text" id="lastname" class="form-control" />
                <label class="form-label" for="lastname">Last Name</label>
              </div>
            </div>
          </div>
          <div class="form-outline mb-4">
            <input type="email" id="email" class="form-control" />
            <label class="form-label" for="email">Email address</label>
          </div>
          <div class="form-outline mb-4">
            <textarea class="form-control" id="message" rows="4"></textarea>
            <label class="form-label" for="message">Message</label>
          </div>
          <div class="g-recaptcha pb-4 d-flex justify-content-center" data-sitekey="6LddXa4mAAAAALVtpP0nf7GZsDF1SRf052K9Xzk8"></div>
          <button type="submit" class="btn btn-success btn-block mb-4">
            <span class="submit-text">Send</span>
            <span class="spinner-border spinner-border-sm  d-none" aria-hidden="true"></span>
          </button>
        </form>
      </div>
    </section>
    <!--Section 5-->

    <!--Section 6-->
    <section class="contact-information">
      <div class="mb-0 text-center">
        <ul class="list-unstyled pt-3 mb-0 pb-5">
          <li class="lead fs-6 mb-2"><i class="fa-solid fa-location-dot"></i> Brgy. Bolbok 4200, Batangas City</li>
          <li class="lead fs-6 mb-2"><i class="fa-solid fa-phone"></i> (043)- 984-4300 /(043)-727-2768</li>
          <li class="lead fs-6 mb-2"><i class="fa-solid fa-envelope"></i> cdrrmobatangas@yahoo.com.ph</li>
        </ul>
      </div>
      <div class="text-center pb-5">
        <button class="no-border text-success" type="button" id="goToFacebook"><i class="fa-brands fa-facebook fs-1 me-2"></i></button>
        <button class="no-border text-success"><i class="fa-brands fa-square-instagram fs-1 me-2"></i></button>
        <button class="no-border text-success"><i class="fa-brands fa-twitter fs-1 me-2"></i></button>
        <button class="no-border text-success"><i class="fa-solid fa-envelope fs-1 me-2"></i></button>
      </div>
    </section>
    <!--Section 7-->

    <!--Section 8-->
    <section class="maps pb-5 pt-5" id="maps">
      <h2 class="text-success ms-5 pb-4 fw-bold"><i class="fa-solid fa-location-dot"></i> Maps</h2>
      <div class="me-5 ms-5 rounded border shadow" id="map"></div>
    </section>
    <!--Section 8-->

    <div class="go-up mb-0 pb-5 me-3">
      <button id="go-up-button" class="btn btn-success btn-floating btn-lg float-end"><i class="fa-solid fa-arrow-up"></i></button>
    </div>

    <div id="toastContainer"></div>

    <footer class="bg-success h-100">
      <div class="text-center pt-5">
        <img src="Admin/img/logo.png" alt="">
      </div>
      <div class="text-center pb-3">
        <p class="copyright-text text-light lead fs-6">Copyright &copy; 2022 All Rights Reserved
      </div>
    </footer>
  </main>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="Admin/scripts/mdb.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script>
    $("#goToFacebook").click(() => {
      window.location.href = "https://www.facebook.com/profile.php?id=100064680010464";
    });
    $(window).scroll(function() {
      let goUpContainer = $(".go-up");
      if ($(window).scrollTop() > 100) {
        goUpContainer.addClass("show");
      } else {
        goUpContainer.removeClass("show");
      }
    });

    $("#go-up-button").click(function() {
      $("html, body").animate({
        scrollTop: 0
      }, "slow");
    });

    const goToTop = () => {
      $("html, body").animate({
        scrollTop: 0
      }, "slow");
    }
    // Initialize the map
    let map = L.map('map').setView([13.77, 121.05], 15);
    // Add a tile layer from OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data © OpenStreetMap contributors',
    }).addTo(map);
    L.marker([13.77, 121.05]).addTo(map)
      .bindPopup('Our office is located here')
      .openPopup()
    const showToast = (content, status) => {
      const toastContainer = $('#toastContainer');

      // Create toast element
      const toast = $('<div class="toast"></div>').text(content);

      // Set background color based on status
      if (status === 'Error') {
        toast.addClass('bg-danger');
      } else {
        toast.addClass('bg-success');
      }

      // Add toast to container
      toastContainer.append(toast);

      // Show toast
      toast.addClass('show');

      // Automatically hide toast after 3 seconds
      setTimeout(() => {
        toast.removeClass('show');
        // Remove toast from container after animation
        setTimeout(() => {
          toast.remove();
        }, 300);
      }, 3000);
    };
    $(document).submit('#contact_us', (e) => {
      e.preventDefault();

      let firstname = $("#firstname").val();
      let lastname = $("#lastname").val();
      let email = $("#email").val();
      let message = $("#message").val();
      let name = `${firstname} ${lastname}`;
      let recaptchaResponse = grecaptcha.getResponse();
      if (recaptchaResponse == '') {
        console.log("capcha error");
      }
      let data = {
        submitBtn: "",
        name: name,
        email: email,
        message: message,
        recaptchaResponse: recaptchaResponse // Get the reCAPTCHA response
      };
      const resetBtnLoadingState = () => {
        $('button[type="submit"]').prop("disabled", false);
        $(".submit-text").text("Send");
        $(".spinner-border").addClass("d-none");
      };

      $.ajax({
        url: "include/SendEmail.php",
        method: "POST",
        dataType: "json",
        data: data,
        beforeSend: () => {
          $('button[type="submit"]').prop("disabled", true);
          $(".submit-text").text("Sending...");
          $(".spinner-border").removeClass("d-none");
        },
        success: (response) => {
          if (response.status === "Success") {
            setTimeout(() => {
              showToast(response.message, response.status);
              $("#firstname").val("");
              $("#lastname").val("");
              $("#email").val("");
              $("#message").val("");
              grecaptcha.reset()
              resetBtnLoadingState();
            }, 1000);
          } else {
            setTimeout(() => {
              showToast(response.message, response.status);
              $("#firstname").val("");
              $("#lastname").val("");
              $("#email").val("");
              $("#message").val("");
              grecaptcha.reset()
              resetBtnLoadingState();
            }, 1000);
          }
        }
      });
    });
  </script>

</body>

</html>