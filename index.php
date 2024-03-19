
<?php
session_start();
include 'init2.php';
?>



<!doctype html>
<html lang="en">
<html>
<head>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

  <!--------style sheets--->
  
  <link rel="stylesheet" href="design/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="design/css/pages/index.css"/>
      <link rel="stylesheet" href="design/css/Animate.css"/>
    <link rel="stylesheet" href="design/icofont/icofont.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <!--------end style sheets--->

    <link rel="shortcut icon" type="image/x-icon" href="design/images/game-controller-1400688-1189016.png">
      <title>EGaming </title>
</head>
<body> 

  <div class="bg"> <!--background-->
    
    <!--navbar--->
<nav class="navbar navbar-expand-lg bg-danger">
  <div class="container-fluid d-flex align-items-center justify-content-between">
    <a class="navbar-brand heartBeat progress-bar-animated" style="color: rgb(124, 19, 19)!important" href="#"><i class="icofont-game-controller" style="font-size:30px "></i></a>
    <button class="navbar-toggler bg-danger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" > 

        
       
        <?php
              if(isset($_SESSION['user_id'])){   
                $stmt = $con->prepare("SELECT username FROM users WHERE ID=?"); 
                $stmt-> execute(array($_SESSION['user_id']));
                $usname=$stmt->fetch();?>
         <li class="nav-item d-flex">
          <a class="nav-link active" aria-current="page" href="#home">Home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about us">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#services">Locations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#bundles">Bundles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?=$usname['username']?>
                </a>
<?php } else{ ?>

  <li class="nav-item d-flex">
          <a class="nav-link active" aria-current="page" href="#home">Home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about us">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#services">Locations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#bundles">Bundles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signup.php">Sign up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="hostreg.php">Become a host</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Log in</a>
        </li>
<?php }?>
          
          <ul class="dropdown-menu bg-dark  " aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item bg-dark" href="profile.php">My Profile</a></li>
            <li><a class="dropdown-item bg-dark" href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>



    <!--end navbar-->

    <!--home-->
<section id="home">
    <div id="home"> 
        <div class="home"> 
    <h3 class="top"><b>EGaming</b></h3>
         <h1 class="bot flash progress-bar-animated">For Real Gamers</h1>
    </div>
   </div>
   </div> 
    </div>
  </section>
     <!--end home-->

     <!-- about us-->

<section id="about us" >  
  <div class="alert alert-light" style="text-align:center;" role="alert">
    <h2> About us </h2>  </div>
  <div class="container">
  <div class="accordion" id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button"type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <b>Business idea</b>
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          We are an online website that books seats for gamers in various internet cafes across the country, by registering on our website and selecting your preferred internet cafe among the top internet cafes in Egypt, then reserving the number of seats you require for the whole number of hours you will play and finally paying to receive the id that will be required to login to the booked computer.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <B>Vision</B>
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          Our vision is to be the first and best internet café booking platform for all gamers, as well as market leaders, in order to make gamers' lives simpler.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <b >Mission</b>
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          We will achieve our aim by being the top internet cafe booking website and the most well-known ones by expanding advertising and creating gorgeous packages for our clients, in addition, our main priority is our clients, and we will make every effort to provide them with the services they require at a competitive price. 
        </div>
      </div>
    </div>
  </div>
</div>
</br>
</br>
</section>   

 <!-- end about us-->
 
<!-- services -->
<section id="services" style="background-color:#f6f6f4 "> 
  <div class="alert alert-light" style="text-align:center;" role="alert">
 <h2> Services </h2>  </div>
<div class="container ">
  <div class="row row-cols-1 row-cols-md-2 g-5">
    <div class="col  d-flex justify-content-center">
    <div class="card" style="background-image:url(design/images/maadi.jpg)">
        <div class="card-body">
          <h5 class="card-title">Maadi</h5>
          <div class="d-grid gap-2 col-6 mx-auto">
          <a style="text-decoration:none"  class="btn btn-danger btn-card" href="locations.php?location=maadi">Explore</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col  d-flex justify-content-center">
      <div class="card" style="background-image:url(design/images/5th.jpg)">
        <div class="card-body">
          <h5 class="card-title">5th settlement</h5>
          <div class="d-grid gap-2 col-6 mx-auto">
            <a style="text-decoration:none"  class="btn btn-danger btn-card" href="locations.php?location=5th settlement">Explore</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col  d-flex justify-content-center">
      <div class="card" style="background-image:url(design/images/zamlek.jpg)">
        <div class="card-body">
          <h5 class="card-title">Zamalek</h5>
          <div class="d-grid gap-2 col-6 mx-auto">
            <a style="text-decoration:none"  class="btn btn-danger btn-card" href="locations.php?location=zamalek">Explore</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col  d-flex justify-content-center">
      <div class="card" style="background-image:url(design/images/nasrcity.jpg)">
        <div class="card-body">
          <h5 class="card-title">Nasr city</h5>
          <div class="d-grid gap-2 col-6 mx-auto">
            <a style="text-decoration:none"  class="btn btn-danger btn-card" href="locations.php?location=nasr city">Explore</a>
          </div>
        </div>
      </div>
    </div>
    
  
      
    </div>
    <div class="col d-flex justify-content-center" style="padding-top: 50px" >
      <div class="card" style="background-image:url(design/images/other.jpg)">
        <div class="card-body">
          <h5 class="card-title" style="color:red" >Other Locations</h5>
          <div class="d-grid gap-2 col-6 mx-auto">
            <a style="text-decoration:none"  class="btn btn-danger btn-card" href="locations.php?location=all">Explore</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div></br>
</br>
</section>

<!-- end services-->


<!-- bundle -->

<section id="bundles" style="background-color:#f6f6f4 "> 
  <div class="alert alert-light" style="text-align:center;" role="alert">
 <h2> Bundles </h2>  </div>
<div class="container ">
  
  <div class="row row-cols-1 row-cols-md-2 g-5">
    <div class="col  d-flex justify-content-center" style="width: 180%">
      <div class="card" style="background-image:url(design/images/bundle.jpg); width: 190%;">
        <div class="card-body"> 
          <div class="d-grid gap-2 col-6 mx-auto">
            <a style="text-decoration:none"  class="btn btn-danger btn-card" href="bundles.php">EGaming Bundles </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div></br>
</br>
</section>

<!-- end bundle-->


<!-- Footer -->
<footer id="contact">
<footer class="text-center text-lg-start bg-dark text-light "  >
  <!-- Section: Social media -->
  <section
    class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
  >
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Get connected with us on social networks:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="https://www.facebook.com/" class="me-4 text-reset">
        <i class="fab fa-facebook"></i>
      </a>
      <a href="https://twitter.com/home" class="me-4 text-reset">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="https://mail.google.com/mail/u/0/#inbox?compose=NZVHFspLRwHWRLdtHgQsMJQGjkzsHMSwwlbNhkMQxpnjlmQHpJXlmgWNGTBhlqBkwMZcSV" class="me-4 text-reset">
        <i class="fab fa-google"></i>
      </a>
      <a href="https://www.instagram.com/" class="me-4 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="https://www.linkedin.com/" class="me-4 text-reset">
        <i class="fab fa-linkedin"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section>
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-4">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl- mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas  me-3">
            </br> </br></br> 
              <i class="icofont-game-controller"> EGaming</i>
            </i>
          </h6>
          <p>
            Best service provider for real gamers.
          </p>
        </div>
        <!-- Grid column -->
        
        <!-- Grid column -->
        <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Contact
          </h6>
          <p><i class="fas fa-home me-3"></i> Cairo, maadi , miraag</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
                  EGaming.egy@gmail.com
          </p>
          <p><i class="fas fa-phone me-3"></i> +201017677673</p>
          </div>
        <!-- Grid column -->
          <!-- Grid column -->
          <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4" style="text-align:center">
              Location
            </h6>
            <iframe class="w-100"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3456.247782997279!2d31.30658518450069!3d29.97230822893084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583855ea259e01%3A0x6b150a11b5344d25!2zQWJ1IEJha3IgRWwgU2VkZGlxLCDYp9mE2KjYs9in2KrZitmGINin2YTYtNix2YLZitip2Iwg2YLYs9mFINin2YTYqNiz2KfYqtmK2YbYjCDZhdit2KfZgdi42Kkg2KfZhNmC2KfZh9ix2KnigKw!5e0!3m2!1sar!2seg!4v1654111859995!5m2!1sar!2seg"  height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </br>
        </br>
            </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
      <!-- Grid column -->
    </div>
      </div>
      <!-- Grid row -->
    </div>
    <!-- Grid column -->
  </div>
  <!-- Grid row -->
</div>
  </section>

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.4); color: aliceblue;">
    © 2022 Copyright:
    <a class="text-reset fw-bold" href=#home>www.egaming.com</a>
  </div>

  <!--  end Copyright -->
</footer>
    <!-- end Footer -->
      <!-------- scripts-->
      <script src="design/js/jquery.min.js"></script>
<script src="design/js/popper.min.js"></script>
<script src="design/js/popper.js"></script>  
<script src="design/js/bootstrap.bundle.min.js"></script>  
<script src="design/js/index.js"></script> 
      <!-------- end scripts-------->
    </footer>
</body> 
</html> 