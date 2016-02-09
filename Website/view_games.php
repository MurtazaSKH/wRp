<!DOCTYPE html>
<!-- saved from url=(0062)# -->
<html>
   <!--<![endif]-->
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta charset="utf-8">
      <title>we.R.play | Games</title>
      <meta name="description" content="Multipurpose and creative template">
      <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <![endif]-->
      
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <link rel="stylesheet" href="./rsrc/plugins.min.css">
      <link rel="stylesheet" href="./rsrc/layerslider.css">
      <link rel="stylesheet" href="./rsrc/style.css">
      <link href="./rsrc/hover.css" rel="stylesheet" media="all">
      <!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="all"> -->
      <script type="text/javascript" charset="utf-8" async="" src="https://platform.twitter.com/js/button.b059c0eb61ea902a882e5c5b3c66a17a.js"></script>
      <link href="./rsrc/responsivemenu.css" rel="stylesheet" type="text/css">
      <!-- <link rel="icon" type="image/png" href="#themes/legendstatic/assets/./rsrc/images/icons/favicon.png">
      <link rel="apple-touch-icon" sizes="57x57" href="#themes/legendstatic/assets/./rsrc/images/icons/faviconx57.png">
      <link rel="apple-touch-icon" sizes="72x72" href="#themes/legendstatic/assets/./rsrc/images/icons/faviconx72.png"> -->
      <link rel="stylesheet" href="./rsrc/skin.css" type="text/css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
   </head>
   <body >

      
         <header class="header">
            <!-- Header here -->

            <?php 

            include ('header.php'); 

            ?>
            
         </header>
         <div class="main">
            <div class="page-header" style="padding-top:172px; background-image: url(./rsrc/images/games/all_games.jpg);">
               <!-- <div class="container">
                  <h1>Games</h1>
                  <p>Blah Blah Games</p>
               </div> -->
            </div>
            <div class="breadcrumb-container">
               <div class="container">
                  <ol class="breadcrumb">
                     <li><a href="index.php">Home</a></li>
                     <li class="active">Games</li>
                  </ol>
               </div>
            </div>
            <?php 
                     
                  include ('connection.php'); 

                  if(isset($_GET["gameid"]) ){
                     $game = trim($_GET["gameid"]);

                     $sql = "SELECT * FROM games_info where game_id=$game";
                     $result = mysqli_query($conn, $sql);
                     // echo "selected";

                     $sql = "SELECT * FROM games_info where game_id!=$game";
                     $result2 = mysqli_query($conn, $sql);

                  }
                  else{
                     $sql = "SELECT * FROM games_info";
                     $result = mysqli_query($conn, $sql);
                  }

                  // $sql = "SELECT id, firstname, lastname FROM MyGuests";
                  // $result = mysqli_query($conn, $sql);
                  $count=0;
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result))
                      {
                          
                     if($count==0)
                     {
                        echo '<div class="portfolio-post-container dark fullwidth">
                        <div class="row">
                           <div class="col-md-6">
                              <figure class="portfolio-post-media"><img src="./rsrc/images/games/'.$row["img_src"].'" alt="portfolio item"></figure>
                           </div>
                           
                           <div class="col-md-6">
                              <div class="portfolio-post-content">
                                 <h2 class="portfolio-title">'.$row["title"].'</h2>
                                 <p>'.$row["description"].'</p>
                                 <ul class="portfolio-post-meta-list">
                                    <!-- <li><span>Client:</span> Company Name</li> -->
                                    <li><span>Categories:</span> Endless Runner</li>
                                    <!-- <li><span>Budget:</span> $800 - $1200</li> -->
                                    <li><span>Playstore:</span> <a href="https://play.google.com/store/apps/details?id=com.werplay.runsheedarun&hl=en" title="themeforest.com">Playstore apps - Run Sheeda Run</a></li>
                                    <li><span>Appstore:</span> <a href="#">Coming Soon!</a></li>
                                    <li><span>Website:</span> <a href="runsheedarun.werplay.com/">runsheedarun.werplay.com</a></li>
                                    <li><span>Price:</span> Free</li>


                                 </ul>
                                 <footer>
                                    <div class="portfolio-tags"><a href="#">Games</a>, <a href="#">Endless Runner</a></div>
                                    <!-- <a class="portfolio-like" href="#" title="12 Like"><i class="fa fa-heart"></i>158</a> -->
                                 </footer>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div id="portfolio-item-container" class="max-col-4" data-layoutmode="fitRows" style="position: relative; height: 916.668px;">
                     ';
                     $count++;
                     }
                   else {
                      
                      echo '<div class="portfolio-item overlay-item fonts artworks" style="position: absolute; left: 0px; top: 0px;">
                              <figure><img src="./rsrc/images/games/'.$row["img_src"].'" alt="portfolio item"></figure>
                              <div class="portfolio-meta">
                                 <h3 class="portfolio-title"><a href="view_games.php?gameid='.$row["game_id"].'">'.$row["title"].'</a></h3>
                                 <p class="portfolio-desc">'.$row["brief"].'</p>
                              </div>
                           </div>';


                  }
                  if(!is_null(result2))
                  {
                     while($row = mysqli_fetch_assoc($result2))
                      {
                           echo '<div class="portfolio-item overlay-item fonts artworks" style="position: absolute; left: 0px; top: 0px;">
                              <figure><img src="./rsrc/images/games/'.$row["img_src"].'" alt="portfolio item"></figure>
                              <div class="portfolio-meta">
                                 <h3 class="portfolio-title"><a href="view_games.php?gameid='.$row["game_id"].'">'.$row["title"].'</a></h3>
                                 <p class="portfolio-desc">'.$row["brief"].'</p>
                              </div>
                           </div>';
                      }
                  }
               }
            }
                  
            ?>
            
            <!-- <div id="portfolio-item-container" class="max-col-4" data-layoutmode="fitRows" style="position: relative; height: 916.668px;"> -->
               <!-- <div class="portfolio-item overlay-item fonts artworks" style="position: absolute; left: 0px; top: 0px;">
                  <figure><img src="./rsrc/images/games/hex.png" alt="portfolio item"></figure>
                  <div class="portfolio-meta">
                     <h3 class="portfolio-title"><a href="#">HEX:99</a></h3>
                     <p class="portfolio-desc">Mercilessly Difficult, Daringly Addictive! HEX:99 can be explained with a simple equation : (simple controls + awesome music) x insane difficulty + frenzied action = SUPER ADDICTIVE.</p>
                  </div>
               </div>
               <div class="portfolio-item overlay-item awesome wordpress" style="position: absolute; left: 395px; top: 0px;">
                  <figure><img src="./rsrc/images/games/lt2.png" alt="portfolio item"></figure>
                  <div class="portfolio-meta">
                     <h3 class="portfolio-title"><a href="#">Lost Twins</a></h3>
                     <p class="portfolio-desc">Poor little Ben and Abi! They are left adrift in a magical room, hopeless and lost. Never fear, for you can reunite them! Guide the young siblings by matching up rooms and directing them to the magical red door!</p>
                  </div>
               </div>
               <div class="portfolio-item overlay-item web-design wordpress" style="position: absolute; left: 791px; top: 0px;">
                  <figure><img src="./rsrc/item3.jpg" alt="portfolio item"></figure>
                  <div class="portfolio-meta">
                     <h3 class="portfolio-title"><a href="#">Lorem ipsum dolor</a></h3>
                     <p class="portfolio-desc">The European languages are members of the same family. Their separate existence is a myth. For scienc vocabulary. The languages only differ in their gramm But I must explain .</p>
                     <footer>
                        <div class="portfolio-tags"><a href="#">Logo</a>, <a href="#">Design</a></div>
                        <a class="portfolio-like" href="#" title="12 Like"><i class="fa fa-heart"></i></a>
                     </footer>
                  </div>
               </div> -->
               <!-- <div class="portfolio-item overlay-item graphic-design marketing" style="position: absolute; left: 0px; top: 305px;">
                  <figure><img src="./rsrc/item4.jpg" alt="portfolio item"></figure>
                  <div class="portfolio-meta">
                     <h3 class="portfolio-title"><a href="#">Lorem ipsum dolor</a></h3>
                     <p class="portfolio-desc">The European languages are members of the same family. Their separate existence is a myth. For scienc vocabulary. The languages only differ in their gramm But I must explain .</p>
                     <footer>
                        <div class="portfolio-tags"><a href="#">Logo</a>, <a href="#">Design</a></div>
                        <a class="portfolio-like" href="#" title="12 Like"><i class="fa fa-heart"></i></a>
                     </footer>
                  </div>
               </div>
               <div class="portfolio-item overlay-item graphic-design web-design" style="position: absolute; left: 395px; top: 305px;">
                  <figure><img src="./rsrc/item5.jpg" alt="portfolio item"></figure>
                  <div class="portfolio-meta">
                     <h3 class="portfolio-title"><a href="#">Lorem ipsum dolor</a></h3>
                     <p class="portfolio-desc">The European languages are members of the same family. Their separate existence is a myth. For scienc vocabulary. The languages only differ in their gramm But I must explain .</p>
                     <footer>
                        <div class="portfolio-tags"><a href="#">Logo</a>, <a href="#">Design</a></div>
                        <a class="portfolio-like" href="#" title="12 Like"><i class="fa fa-heart"></i></a>
                     </footer>
                  </div>
               </div>
               <div class="portfolio-item overlay-item fonts awesome" style="position: absolute; left: 791px; top: 305px;">
                  <figure><img src="./rsrc/item6.jpg" alt="portfolio item"></figure>
                  <div class="portfolio-meta">
                     <h3 class="portfolio-title"><a href="#">Lorem ipsum dolor</a></h3>
                     <p class="portfolio-desc">The European languages are members of the same family. Their separate existence is a myth. For scienc vocabulary. The languages only differ in their gramm But I must explain .</p>
                     <footer>
                        <div class="portfolio-tags"><a href="#">Logo</a>, <a href="#">Design</a></div>
                        <a class="portfolio-like" href="#" title="12 Like"><i class="fa fa-heart"></i></a>
                     </footer>
                  </div>
               </div>
               <div class="portfolio-item overlay-item marketing wordpress" style="position: absolute; left: 0px; top: 611px;">
                  <figure><img src="./rsrc/item7.jpg" alt="portfolio item"></figure>
                  <div class="portfolio-meta">
                     <h3 class="portfolio-title"><a href="#">Lorem ipsum dolor</a></h3>
                     <p class="portfolio-desc">The European languages are members of the same family. Their separate existence is a myth. For scienc vocabulary. The languages only differ in their gramm But I must explain .</p>
                     <footer>
                        <div class="portfolio-tags"><a href="#">Logo</a>, <a href="#">Design</a></div>
                        <a class="portfolio-like" href="#" title="12 Like"><i class="fa fa-heart"></i></a>
                     </footer>
                  </div>
               </div>
               <div class="portfolio-item overlay-item graphic-design artworks web-design" style="position: absolute; left: 395px; top: 611px;">
                  <figure><img src="./rsrc/item8.jpg" alt="portfolio item"></figure>
                  <div class="portfolio-meta">
                     <h3 class="portfolio-title"><a href="#">Lorem ipsum dolor</a></h3>
                     <p class="portfolio-desc">The European languages are members of the same family. Their separate existence is a myth. For scienc vocabulary. The languages only differ in their gramm But I must explain .</p>
                     <footer>
                        <div class="portfolio-tags"><a href="#">Logo</a>, <a href="#">Design</a></div>
                        <a class="portfolio-like" href="#" title="12 Like"><i class="fa fa-heart"></i></a>
                     </footer>
                  </div>
               </div> -->
            </div>
            
         </div>
         <footer class="footer">
            
            <?php include ('footer.php'); ?>
         </footer>
      </div>
      <a id="scroll-top" href="#top" title="Scroll top" class=""><i class="fa fa-angle-up"></i></a><script src="./rsrc/plugins.min.js"></script><script src="./rsrc/jquery.tweet.min.js"></script><script src="./rsrc/main.js"></script>
   </body>
</html>