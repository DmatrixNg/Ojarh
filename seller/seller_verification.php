<?php
include('../api/config/Database.php');
include('../api/models/session.php');
if(!isset($_SESSION['role']) || empty($_SESSION['role'])  || $_SESSION['role']!='Seller')
    {
        session_destroy();
        session_unset();
        header("Location: " . BASE_URL);
    }
?>
<?php include 'inc/header.php'; ?>
                <div class="app-inner-layout app-inner-layout-page">
                    <div class="app-inner-layout__wrapper">
                        <div class="app-inner-layout__content">
                                    <div class="container-fluid">
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
                                        <div class="row">
                                                <div class="mb-3 card">
                                                    <?php
                                                        $noo = $userClass->accountdetails($userid);
                                                        if($noo == 1){
                                                    ?>
                                                    <?php include ('../app/seller_verification.php'); ?>
                                                <?php } else{ ?>
                                                    <div class="card-body row">
                                                        <div class="col-md-12 text-center">
                                                            <div class="divider"></div>
                                                            <div class="alert alert-warning">NB: You have to update your account details to be able to add product.</div>
                                                            <a href="account_details.php" class="btn btn-danger">Update Account Details</a>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
<?php include 'inc/footer.php'; ?>
<!--
market
product_category
-->

<script type="text/javascript">
    $(document).ready(function() {
        $("#market").change(function(){
            var selectedloc = $("#market option:selected").val();
            $("#product_category").html("<option value=''>Select Product Category</option>");
            $.ajax({
                type: 'POST',
                url: '../api/controllers/process-loc.php',
                data: {
                    loc : selectedloc
                },
                cache: false,
                dataType: 'text',
                success: function (response) {
                    var obj = JSON.parse(response);
                    var areaOption = "<option value=''>Select Product Category</option>";
                    for (var i = 0; i < obj.length; i++) {
                        areaOption += '<option value="' + obj[i] + '">' + obj[i] + '</option>'
                    }
                    $("#product_category").html(areaOption);
                }
            });
            event.preventDefault();
        });
    });
</script>