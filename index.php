<?php
  include '../user_auth.php';
  include '../dbconfig.php';

  if(sessionExistsForService("apr12")){

    //setup photo album
    $photoalbum_dir = "assets/photo album";
    $photoalbum = scandir($photoalbum_dir);

    for($x = 0; $x < count($photoalbum); $x++){
      $photoalbum[$x] = $photoalbum_dir."/".$photoalbum[$x];
    }

    //choose random photos
    $num_random_photos = 2;


    //photos
    if(isset($_POST['photos_submit']) && isset($_POST['numphotos'])){
      $num_random_photos = $_POST['numphotos'];
      $rand_photos = array();
      for($x=0; $x < $num_random_photos; $x++){
        $rand_photos[] = $photoalbum[rand(3,count($photoalbum))-1];
      }
    }elseif(isset($_POST['photos_submit_all'])){
          $num_random_photos = count($photoalbum);
          for($x=3; $x < count($photoalbum); $x++){
            $rand_photos[] = $photoalbum[$x];
          }
    }else {
      $rand_photos = array();
      for($x=0; $x < $num_random_photos; $x++){
        $rand_photos[] = $photoalbum[rand(3,count($photoalbum))-1];
      }
    }

    //Poetry
    $chosen_poem = "https://docs.google.com/document/d/e/2PACX-1vSh4L_EVZHwmkA6LezrnDDkVuo0F8jHksYHOkT4pAuaOeTNpBX0OxdeerSldtGZ52P9sdqhy9HPYvMk/pub?embedded=true";
    if(isset($_POST['image0'])){
      $chosen_poem = "https://docs.google.com/document/d/e/2PACX-1vSh4L_EVZHwmkA6LezrnDDkVuo0F8jHksYHOkT4pAuaOeTNpBX0OxdeerSldtGZ52P9sdqhy9HPYvMk/pub?embedded=true";
    } elseif(isset($_POST['image1'])){
      $chosen_poem = "https://docs.google.com/document/d/e/2PACX-1vQgYoQ9E65Kl7l3PEUJnoclhutlPAZ8Bmy2ffP-HWAD0e2-l48TPrRg4LjnaKIdc5DqOd7LcUVv2GYP/pub?embedded=true";
    } elseif(isset($_POST['image2'])){
      $chosen_poem = "https://docs.google.com/document/d/e/2PACX-1vTU1MaZpB5uLyHfMc6TIOYvl9k03KkqzyM4aCgMP-pTp9Cvmz2cCtuoGxGYy-nmUAJt9IRU9J6thq-Q/pub?embedded=true";
    } elseif(isset($_POST['image3'])){
      $chosen_poem = "https://docs.google.com/document/d/e/2PACX-1vRjvO6LmguriIF1CuzUzMMhCkv_XvSW29ZFv2vInr_VIhBJJi6CxJUtAncne8qB_vA4z5Xv8vayxlrU/pub?embedded=true";
    } elseif(isset($_POST['image4'])){
      $chosen_poem = "https://docs.google.com/document/d/e/2PACX-1vSpR4HlHeNDlR8Bu_X4EWmhmJH1NtbHRahvPyVnLMm9VfyGATh1yPFJYAnNzfkdGdnH_a6Q7EFAAzPI/pub?embedded=true";
    }

    //schedule
    //schedule table ('id', 'u_id', 'activity', 'start', 'end')
    $id = $_SESSION['user_id'];
    $sql = "select id, activity, weekday, start, end from schedule where u_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$id);
    $stmt->bind_result($id, $activity, $weekday, $start, $end);
    $stmt->execute();

    $schedule = "";
    while($stmt->fetch()){
      $schedule = "<tr id='black'><input type='hidden' value='$id' name='id[]'>$weekday</td><td id='black'><input type='text' value='$activity' name='activity[]'>'</td><td id='black'><input type='time' value='$start' name='start[]'></td><td id='black'><input type='time' value='$end' name='end[]'></td><td><input type='checkbox' name='delete[]'> Delete</tr>";
    }

    $stmt->close();

  } else {
    header("Location: login.php");
  }
?>

<html>
  <head>
    <title>Fiance Services</title>
    <script src='../jquery.js'></script>
    <style>
      body {
      }
      .banner {
        display: inline-block;
        width: 100%;
        height: 110px;
        background-image: url("assets/happy_bday.png");
        background-repeat: repeat-x;
      }
      .subheader, .header {
        display: block;
        width: 100%;
        background-color:purple;
        color:white;
        padding-bottom: 20px;
      }
      .subheader {
        text-align:center;
        width:100%;
      }
      .subheader > h2 {
        padding-top:30px;
      }
      .header > a {
        color: white;
        text-decoration:none;
        padding-left: 10px;
      }
      #white {
        color:white;
        text-decoration:none;
        border: 1px solid white;
        padding:1px;
        border-collapse: collapse;
      }
      #black {
        color:black;
        border: 1px solid black;
        border-collapse: collapse;
      }
      .hbody {
        display: block;
        width: 100%;
        padding-top: 10px;
      }
      #rand_photo > img {
        transform: rotate(90deg);
        width: 360px;
        height: 275px;
        display: inline-block;
        padding-top: 100px;
      }
      #rand_photo{
        text-align: center;
        padding-top: 50px;
      }

    </style>
  </head>
  <body>
    <div class='banner'>
    </div>
    <div class='header'>
      <table><tr><td><a id='white' href='logout.php'>Logout</a></td><td><a id='white' href='#photoalbum'>photo album</a></td><td><a id='white' href='#poetry'>poetry</a></td</tr></table>
      <div style='text-align:center;width:100%;'><h1>I love you, Brighid</h1></div>
    </div>
    <div class='subheader'>
      <h2>What is this?</h2>
    </div>
    <div class='hbody'>
      <p>Dear Brighid,</p>
      <p>I love you with all my heart. I wanted to make something for you and this is what I came up with. I hope you like it! Right now it's a compedium of moments in the form of the poems I have written for you and photos of us together (we need more of these).</p>
      <p>I hope to add more poems and more photos as time goes on.</p>
      <p>I hope to add new things to this for you to enjoy!</p>
      <p>love,</p>
      <p>Robby</p>
    </div>
    <div class='subheader' id='photoalbum'>
      <h2>Photo Album</h2>
    </div>
    <div class='hbody' id='rand_photo'>
      <?php
        for($x=0; $x<count($rand_photos); $x++){
          echo <<<HTML
            <img src='$rand_photos[$x]'>
HTML;
        }
      ?>
    </div>
    <div class='header'>
      <form action='index.php#photoalbum' method='post'>
        <table >
          <tr><th id='white'># photos you wish to view:</th><td><input type='number' name='numphotos' placeholder='ex. 2'></td><td><input type='submit' name='photos_submit' value='submit'></td></tr>
          <tr><th id='white'>view all photos:</th><td colspan=2><input type='submit' name='photos_submit_all' value='View All'></td></tr>
        </table>
      </form>
    </div>
    <div class='subheader' id='poetry'>
      <h2>Poetry</h2>
    </div>
    <div class='hbody' style='text-align:center;'>
      <iframe style='display:inline-block;width: 50%;height:300px;' src='<?php echo $chosen_poem ?>'></iframe>
    </div>
    <div class='header'>
      <table>
        <form action='index.php#poetry' method='post'>
          <tr><th id='white'>Title</th><th id='white'>View</th></tr>
          <tr><td id='white'>Every time you shed a tear</td><td><input type='submit' value='view' name='image0'></td></tr>
          <tr><td id='white'>It's 8 o'clock</td><td><input type='submit' value='view' name='image1'></td></tr>
          <tr><td id='white'>Star Eyes</td><td><input type='submit' value='view' name='image2'></td></tr>
          <tr><td id='white'>The Card Game</td><td><input type='submit' value='view' name='image3'></td></tr>
          <tr><td id='white'>Trap Hole</td><td><input type='submit' value='view' name='image4'></td></tr>
        </form>
      </table>
    </div>

    <div class='subheader'>
      <h2>My Schedule</h2>
    </div>
    <div class='hbody'>
      <form action='save_schedule.php'>
        <table id='black'>
          <tr id='black'><th id='black'>Weekday</th><th id='black'>Activity</th><th id='black'>Start</th><th id='black'>End</th><th>delete</th></tr>
          <?php echo $schedule; ?>
          <!-- add new-entry row -->
        </table>
        <input type='submit' value='Save Changes' name='submit_schedule' />
      </form>
    </div>
  </body>
  <footer>
  </footer>
</html>
