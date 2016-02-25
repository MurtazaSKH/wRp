      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

      <script type="text/javascript">
        // $(document).ready(function(){

        //     $('#hvr-bounce-to-top').each(function(index) {
              
        //         if(this.href.trim() == window.location)
        //             $(this).addClass("selected");
        //         });
        // });

        $(document).ready(function() {
            $("[href]").each(function() {
              
            if (this.href == window.location.href) {
                //alert("check1");
                $(this).addClass("selectedlink");
                //return;
                }
            });
        });
        </script>

<div id="page">

    <div id="check1">
      <div class="check1-inner">
        <div class="navbar">
          <div class="logo">
            <img src="./rsrc/images/temp.png" /></div>
          <div id="mobile-check2">
            <ul class="mobile-check2">
              <li class="first leaf level-1 check2-link-24791"><a title="" href="index.php"><i class="service-icon fa fa-home" style="font-size:20px;"></i> </a></li>
              <li class="leaf level-1 check2-link-24796"><a title=""  href="view_games.php">Games</a></li>
              <li class="leaf level-1 check2-link-24846"><a title="" href="services.php">Services</a></li>
              <li class="leaf"><a title="" class="hvr-bounce-to-top" id="homebutton" href="portfolio.php">Media</a></li>
              <li class="leaf level-1 check2-link-24841"><a title="" href="aboutus.php">About</a></li>
              <li class="leaf level-1 check2-link-24836"><a title="" href="contactus.php">Contact Us</a></li>
              <!-- <li class="leaf level-1 check2-link-24801"><a title="" href="#">Blog</a></li> -->
              <!-- <li class="last leaf level-1 check2-link-24806"><a title="" href="blog_home.php">Blog</a></li> -->
            </ul>
          </div>
          <div class="check2">
            <ul class="check2">
              <li class="first leaf" id="firstLeaf" style="margin-left: 67px;"><a title="" class="hvr-bounce-to-top" id="homebutton"  href="index.php"><i class="service-icon fa fa-home" style="font-size:20px; "></i> </a></li>
              <li class="leaf"><a title="" class="hvr-bounce-to-top" id="homebutton" href="view_games.php">Games</a></li>
              <li class="leaf video"><a title="" class="hvr-bounce-to-top" id="homebutton" href="services.php">Services</a></li>
              <li class="leaf"><a title="" class="hvr-bounce-to-top" id="homebutton" href="portfolio.php">Media</a></li>
              <li class="leaf "><a title="" class="hvr-bounce-to-top" id="homebutton" href="aboutus.php">About</a></li>
              <li class="leaf"><a title="" class="hvr-bounce-to-top" id="homebutton" href="contactus.php">Contact Us</a></li>
              <!-- <li class="last leaf"><a title="" class="hvr-bounce-to-top" id="homebutton" href="blog_home.php">Blog</a></li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>
    $("#mobile-check2").click(function () {
    $(".mobile-check2").slideToggle("slow");
    });
  </script> 