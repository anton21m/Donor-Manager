<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Dashboard | Alone</title>
    <!-- Material Icon CDN -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Materialize CSS CDN -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <!-- Your custom styles -->
      <link rel="stylesheet" href="css/style.css">
    <!-- Used as an example only to position the footer at the end of the page.
    You can delete these styles or move it to your custom css file -->
    <style>
      body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
        }
      main {
        flex: 1 0 auto;
      }
    </style>
  </head>
  <?php
    
    require_once("db-connection.php");
    $id=$_SESSION['id'];
    $sql = "SELECT * FROM `donations` WHERE `donor_id`=$id";
    $result = mysqli_query($conn,$sql);
    
    
 
  ?>
  <body>
    <header>
      <nav class="black">
        <div class="nav-wrapper">
          <div class="container">
            <a href="/index.php" class="brand-logo pink-text">Alone</a>
            <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
              <li><a href="/index.php">Home</a></li>
              <li><a href="/events.php">Events</a></li>
              <?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) )
                {
              ?>
              <li><a href="<?php if($id=='1'){echo "admin/admin_dashboard.php";}
            else echo "/dashboard.php"; ?>" class="active">Dashboard</a></li>
              <li><a href="logout.php">Logout</a></li>
                <?php }else{ ?>
                  <li><a href="login.php">Login</a></li>
                   <li><a href="register.php">Register</a></li>
                <?php } ?>
              <li><a href="/contact.php">Contact us</a></li>

            </ul>
          </div>
        </div>
      </nav>
 
      <div class="sidenav">
            
            <a href="<?php if($_SESSION['id']=='1'){echo "/admin/admin_dashboard.php";}
            else echo "/dashboard.php"; ?>" >Dashboard</a>
            <a href="/edit_user.php">Edit Profile</a>
            <a href="<?php if($_SESSION['id']=='1'){echo "/all_donation.php";}
            else echo "/donation_history.php"; ?>">Past Donation</a>
            <?php if($_SESSION['id']=='1'){ 
              ?>
            <a href="/event_list.php">Manage Events</a>
            <a href="/user_list.php">Manage Users</a>
            <a href="/org_list.php">Manage Organization</a>
            <?php }
            ?>
      </div>
    </header>
      <main>
      <section >
        <div class="container">
            <div class="row ">
                <div class="col s12">
                  <ul class="tabs">
                    <li class="tab col s6"><a class="active green-text" href="#test1">Donations Made</a></li>
                  

                  </ul>
                </div>
                <div id="test1" class="col s12">
                    <table class="grey lighten-4">
                        <thead>
                          <tr>
                              <th class="black-text">Donation ID</th>
                              <th class="black-text">Event ID</th>
                              <th class="black-text">Date</th>
                              <th class="black-text">Donation Amount</th>
                          </tr>
                        </thead>
                
                        <tbody>
                      <?php
                      if ($result->num_rows > 0) {
                        while($donation = $result->fetch_assoc()) {
                        
                          echo "<tr>";
                          echo "<td>" . $donation['donation_id'] . "</td>";
                          echo "<td>" . $donation['event_id'] . "</td>";
                          echo "<td>" . $donation['date'] . "</td>";
                          echo "<td>" . $donation['donation_amt'] . " ₹</td>";
                          echo "</tr>";
                      }
                      }
                      echo "</table>";
                      ?>
                </div>
               
              </div>
        </div>
      </section>
    </main>
    <?php require('footer.php'); ?>
    <!-- jQuery CDN -->
      <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Materialize JS CDN -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script>
      $("document").ready(function(){
        $(".button-collapse").sideNav();
      });
      $(document).ready(function(){
    $('.carousel').carousel();
  });
  $('.carousel.carousel-slider').carousel({
    fullWidth: true
  });
  $(document).ready(function(){
    $('.tabs').tabs();
  });
    </script>
  </body>
</html>