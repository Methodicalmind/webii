<html>
  <head>
    <?php include 'head.php'; ?>
    <title>CS 313</title>
  </head>
  <body>
    <div class="container">
      <?php include 'nav.php'; ?>
      <div id="myCarousel" class="carousel slide span12" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="images/temple.jpg" alt="temple wedding">
          </div>
          <div class="item">
            <img src="images/bike_4.jpg" alt="bike_4">
          </div>
          <div class="item">
            <img src="images/bike_1.jpg" alt="bike_1">
          </div>
          <div class="item">
            <img src="images/bike_ty.jpg" alt="bike_ty">
          </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <div class="jumbotron span12">
        <h1>All Your Base Are Belong To Us</h1>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <h2>Hobbies</h2>
          <ul class="style-list">
            <li>Motorcycles</li>
            <li>Cars</li>
            <li>Sports</li>
            <li>Computers</li>
            <li>Gaming</li>
          </ul>
          <h2>Details</h2>
          <p class="larger-font">On the right my buddy Ty and I are following
          each other closely in provo canyon. I put my knee very close to the
          camera and got it to shake as we zoomed by. Below is my
          engagement video that went viral on facebook and
          got over 7 or 8 million views. It actually is posted now and again to
          different sites and my wife/I will get random friend request from
          Disney people that are obsessed with everything Disney. Below I posted
          the youtube link.</p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <video width="100%" controls autoplay loop muted>
            <source src="video/close.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
          </video>
        </div>
      </div>
      <h2>Viral Engagement Video</h2>
      <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item"
        src="https://youtube.com/embed/Zffz_QPtcVs"> </iframe>
      </div>
      </br>
      <footer>
        <p>End-Of-Line</p>
      </footer>
    </div>
  </body>
</html>
