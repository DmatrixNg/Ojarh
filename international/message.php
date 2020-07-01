<?php
include('../api/config/Database.php');
include('../api/models/session.php');
if(!isset($_SESSION['role']) || empty($_SESSION['role'])  || $_SESSION['role']!='International')
{
  session_destroy();
  session_unset();
  header("Location: " . BASE_URL);
}
?>
<?php include 'inc/header.php'; ?>
  <div class="app-inner-layout__wrapper">
    <div class="app-inner-layout__content">
          <?php
          if($acctType->account_type == 'Starter'){
            echo '<div class="card-body row">
            <div class="alert alert-danger show col-md-12" role="alert">
            You can do more when you upgrade your account to BASIC &amp; PREMIUM!
            <a href="#"><button class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#exampleModal">Upgrade Now!</button></a>
            </div>
            </div>';
          }elseif($acctType->account_type == 'Basic'){
            echo '<div class="card-body row">
            <div class="alert alert-danger show col-md-12" role="alert">
            You can do more when you upgrade your account to PREMIUM!
            <a href="#"><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal">Upgrade Now!</button></a>
            </div>
            </div>';
          }
          ?>
          <?php
          if($acctType->account_type == 'Premium' && $userClass->bizDetails($userid) == 'empty'){
            echo '<div class="card-body row">
            <div class="alert alert-danger show col-md-12" role="alert">
            You have to update your business information <a href="business_setting.php"><button class="btn btn-info btn-sm">Update business profile</button></a>
            </div>
            </div>';
          }else{

          }
          ?>
          <?php
          if($userAcctType != 'Starter'){ ?>
            <div class="container-fluid">
                <?php include("../app/message_view.php"); ?>

            </div>
            <?php }else{ ?>
              <div class="card no-shadow bg-transparent no-border rm-borders mb-3">
                <div class="main-card mb-3 card">
                  <div class="card-body"><h5 class="card-title">You have to upgrade your account to enjoy most of our features</h5></div>
                </div>
              </div>
            <?php } ?>
          </div>

    </div>

  <?php include 'inc/footer.php'; ?>
  <script>
    $.ajax({
      type: 'GET',
      url: '../api/controllers/get_message_view.php',
      data: {
        view : "inbox"
      },
      cache: false,
      dataType: 'text',
      success: function (response) {
        $('#view').html(response)

      },
      error: function (response) {

      }
    });
  </script>
