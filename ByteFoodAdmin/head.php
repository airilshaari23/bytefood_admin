<!DOCTYPE html>
<html lang="en">
<head>
  <title>ByteFood Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/default.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <?php 
  $_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $segments = explode('/', rtrim($_SERVER['REQUEST_URI_PATH'], '/')); 
  ?>

  <?php if (end($segments) == 'order_list.php' || end($segments) == 'user_update.php') { ?>
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <?php } ?>

  <?php if (end($segments) == 'order_list.php'){ ?>
    <script type="text/javascript">
      $(function () {
          $('.date').datetimepicker({
              format: 'DD-MM-YYYY',
              showTodayButton: true,
              useCurrent: false
          });
  
          $(".date").on("dp.change", function() {
             $('.form').submit();
          });
      });
    </script>
  <?php } ?>

  <?php if (end($segments) == 'menu_add.php' || end($segments) == 'menu_update.php') { ?>
    <script type="text/javascript">
      function show(select_item) {
          if (select_item == "food") {
            hiddenFood.style.visibility='visible';
            hiddenFood.style.display='block';

            hiddenDrink.style.visibility='hidden';
            hiddenDrink.style.display='none';
            Form.fileURL.focus();
          } 
          else{
            hiddenFood.style.visibility='hidden';
            hiddenFood.style.display='none';

            hiddenDrink.style.visibility='visible';
            hiddenDrink.style.display='block';
            Form.fileURL.focus();
          }
      } 
    </script>
  <?php } ?>
  
  <?php if ((end($segments) == 'admin_list.php') || (end($segments) == 'customer_list.php')) { ?>
  <style>
      #myImg {
          border-radius: 5px;
          cursor: pointer;
          transition: 0.3s;
      }

      #myImg:hover {opacity: 0.7;}

      /* The Modal (background) */
      .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          padding-top: 100px; /* Location of the box */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
      }

      /* Modal Content (image) */
      .modal-content {
          margin: auto;
          display: block;
          width: 70%;
          max-width: 600px;
      }

      /* Caption of Modal Image */
      #caption {
          margin: auto;
          display: block;
          width: 80%;
          max-width: 600px;
          text-align: center;
          color: #ccc;
          padding: 10px 0;
          height: 150px;
      }

      /* Add Animation */
      .modal-content, #caption {    
          -webkit-animation-name: zoom;
          -webkit-animation-duration: 0.6s;
          animation-name: zoom;
          animation-duration: 0.6s;
      }

      @-webkit-keyframes zoom {
          from {-webkit-transform:scale(0)} 
          to {-webkit-transform:scale(1)}
      }

      @keyframes zoom {
          from {transform:scale(0)} 
          to {transform:scale(1)}
      }

      /* The Close Button */
      .close {
          position: absolute;
          top: 15px;
          right: 35px;
          color: #f1f1f1;
          font-size: 40px;
          font-weight: bold;
          transition: 0.3s;
      }

      .close:hover,
      .close:focus {
          color: #bbb;
          text-decoration: none;
          cursor: pointer;
      }

      /* 100% Image Width on Smaller Screens */
      @media only screen and (max-width: 700px){
          .modal-content {
              width: 100%;
          }
      }
      </style>

  <?php } ?>
</head>
<body style="background-color:#DCDCDC;">
<nav class="navbar navbar-inverse" style="border-radius:0px">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
       <a  href="menu_list.php?parent=menu"><img src="ByteFoodAdmin2.png"  class="" style="width: 100px;"/></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li <?=$_GET['parent'] == 'menu' ? 'class="active"' : ''?>><a href="menu_list.php?parent=menu">Menu</a></li>
      <li <?=$_GET['parent'] == 'admin' ? 'class="active"' : ''?>><a href="admin_list.php?parent=admin">Administrator</a></li>
      <li <?=$_GET['parent'] == 'customer' ? 'class="active"' : ''?>><a href="customer_list.php?parent=customer">Customer</a></li>
      <li <?=$_GET['parent'] == 'order' ? 'class="active"' : ''?>><a href="order_list.php?parent=order">Order History</a></li>
      <li <?=$_GET['parent'] == 'profile' ? 'class="active dropdown"' : 'class="dropdown"'?>><a class="dropdown-toggle" data-toggle="dropdown" href="user_profile.php?parent=profile">Profile<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="user_profile.php?parent=profile">Profile</a></li>
          <li><a href="user_changepassword.php?parent=profile">Change Password</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Log Out</a></li>
    </ul>
    </div>
  </div>
</nav>
