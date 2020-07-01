<?php include 'inc/header.php'; ?>
                <div class="app-inner-layout app-inner-layout-page">
                    <div class="app-inner-layout__wrapper">
                        <div class="app-inner-layout__content pt-1">
                            <div class="tab-content">
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
                                        <div class="col-md-12 col-lg-6 col-xl-4">
                                            <div class="card-shadow-primary profile-responsive card-border mb-3 card">
                                                <div class="dropdown-menu-header">
                                                    <div class="dropdown-menu-header-inner bg-primary">
                                                        <div class="menu-header-content">
                                                        <div class=" btn-hover-shine mb-2 " >
                                                                <?php $profilepicD = $userClass->readProfilePix($userid); ?>
                                                                <!-- <img src="images/avatars/avatar.jpg" width="250" class="img-thumbnail" alt="Profile Picture"> -->
                                                            </div>
                                                            <div><h5 class="menu-header-title"><?php echo ucfirst($userDetails->username); ?></h5></div>
                                                            <!-- <div class="menu-header-btn-pane pt-2">
                                                                <div role="group" class="btn-group text-center">
                                                                    <div class="nav">
                                                                        <a href="#tab-2-eg1" data-toggle="tab"
                                                                           class="active btn btn-dark">Update profile picture</a>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-5">
                                                                    <i class="fa fa-user fa-2x"></i>
                                                                </div>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading"><?php echo ucfirst($userDetails->lname) . ' ' . ucfirst($userDetails->fname); ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-5">
                                                                    <i class="fa fa-envelope fa-2x"></i>
                                                                </div>
                                                                <div class="widget-content-left" style="margin-left: -15px !important;">
                                                                    <div class="widget-heading"><?php echo $userDetails->email; ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-5">
                                                                    <i class="fa fa-mobile fa-2x"></i>
                                                                </div>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading"><?php echo $userDetails->phone; ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-5">
                                                                    <i class="fa fa-map-pin fa-2x"></i>
                                                                </div>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading"><?php echo $userDetails->address; ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="card-shadow-primary profile-responsive card-border mb-3 card">
                                                <!-- <form id="uploadForm" action="../api/controllers/profileuload.php" method="post" enctype="multipart/form-data"> -->
                                                <form action="../api/controllers/profileupload.php" method="post" enctype="multipart/form-data">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper text-center">
                                                                    <div class="widget-content-center">
                                                                        <div class="widget-heading" id="image_preview"><img id="previewing" src="noimage.png" /></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-12">
                                                                            <label for="exampleEmail5">Upload profile picture here.</label>
                                                                            <input type="file" name="file" id="file" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row text-danger text-sm" id="message"></div>
                                                                <button type="submit" class="active btn btn-dark btn-sm submit" id="profileBtn">Update profile picture</button>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-8">
                                            <div class="main-card mb-3 card">
                                                <div id="pfBody" class="card-body">
                                                    <div class="forms-wizard-vertical">
                                                        <div class="card-body">
                                                            <h3>Profile Information</h3>
                                                            <div class="divider"></div>
                                                            <?php if(isset($_GET['result'])){ echo "<div class='alert alert-warning alert-sm'>".$_GET['result']."</div>"; } ?>
                                                            <div class="form-group">
                                                                <label for="exampleEmail5">Username</label>
                                                                <input type="text" id="username" name="username"
                                                                       value="<?php echo $userDetails->username; ?>"
                                                                       class="form-control" disabled>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label for="exampleEmail5">First Name</label>
                                                                    <input type="text" id="fname" name="fname"
                                                                       value="<?php echo $userDetails->fname; ?>"
                                                                       class="form-control">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="exampleEmail5">Last Name</label>
                                                                    <input type="text" id="lname" name="lname"
                                                                       value="<?php echo $userDetails->lname; ?>"
                                                                       class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label for="exampleEmail5">Email</label>
                                                                    <input type="text" id="email" name="email"
                                                                       value="<?php echo $userDetails->email; ?>"
                                                                       class="form-control" disabled>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="exampleEmail5">Phone</label>
                                                                    <input type="number" id="phone" name="phone"
                                                                       value="<?php echo $userDetails->phone; ?>"
                                                                       class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label for="exampleEmail5">Address</label>
                                                                    <textarea id="address" name="address" rows="1" class="form-control"><?php echo $userDetails->address; ?></textarea>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="exampleEmail5">State</label>
                                                                    <select class="form-control" name="state" id="state" required="required">
                                                                        <option value="<?php echo $userDetails->state; ?>" selected="selected"><?php echo $userDetails->state; ?></option>
                                                                        <option value="Abia" label="Abia">Abia</option>
                                                                        <option value="Abuja" label="Abuja">Abuja</option>
                                                                        <option value="Adamawa" label="Adamawa">Adamawa</option>
                                                                        <option value="Akwa Ibom" label="Akwa Ibom">Akwa Ibom</option>
                                                                        <option value="Anambra" label="Anambra">Anambra</option>
                                                                        <option value="Bauchi" label="Bauchi">Bauchi</option>
                                                                        <option value="Bayelsa" label="Bayelsa">Bayelsa</option>
                                                                        <option value="Benue" label="Benue">Benue</option>
                                                                        <option value="Borno" label="Borno">Borno</option>
                                                                        <option value="Cross River" label="Cross River">Cross River</option>
                                                                        <option value="Delta" label="Delta">Delta</option>
                                                                        <option value="Ebonyi" label="Ebonyi">Ebonyi</option>
                                                                        <option value="Edo" label="Edo">Edo</option>
                                                                        <option value="Ekiti" label="Ekiti">Ekiti</option>
                                                                        <option value="Enugu" label="Enugu">Enugu</option>
                                                                        <option value="Gombe" label="Gombe">Gombe</option>
                                                                        <option value="Imo" label="Imo">Imo</option>
                                                                        <option value="Jigawa" label="Jigawa">Jigawa</option>
                                                                        <option value="Kaduna" label="Kaduna">Kaduna</option>
                                                                        <option value="Kano" label="Kano">Kano</option>
                                                                        <option value="Katsina" label="Katsina">Katsina</option>
                                                                        <option value="Kebbi" label="Kebbi">Kebbi</option>
                                                                        <option value="Kogi" label="Kogi">Kogi</option>
                                                                        <option value="Kwara" label="Kwara">Kwara</option>
                                                                        <option value="Lagos" label="Lagos">Lagos</option>
                                                                        <option value="Nasarawa" label="Nasarawa">Nasarawa</option>
                                                                        <option value="Niger" label="Niger">Niger</option>
                                                                        <option value="Ogun" label="Ogun">Ogun</option>
                                                                        <option value="Ondo" label="Ondo">Ondo</option>
                                                                        <option value="Osun" label="Osun">Osun</option>
                                                                        <option value="Oyo" label="Oyo">Oyo</option>
                                                                        <option value="Plateau" label="Plateau">Plateau</option>
                                                                        <option value="Rivers" label="Rivers">Rivers</option>
                                                                        <option value="Sokoto" label="Sokoto">Sokoto</option>
                                                                        <option value="Taraba" label="Taraba">Taraba</option>
                                                                        <option value="Yobe" label="Yobe">Yobe</option>
                                                                        <option value="Zamfara" label="Zamfara">Zamfara</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="exampleEmail5">Country</label>
                                                                    <input id="country" name="country" value="<?php echo $userDetails->country; ?>" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="messer"></div>
                                                    <div class="divider"></div>
                                                    <div class="clearfix">
                                                        <button type="button" id="updatePersonal" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary"> Update Info </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="main-card mb-3 card">
                                                <div id="pfBody" class="card-body">
                                                    <div class="forms-wizard-vertical">
                                                        <div class="card-body">
                                                            <h3>Change Password</h3>
                                                            <div class="divider"></div>
                                                            <div class="form-group">
                                                                <label for="exampleEmail5">Old Password</label>
                                                                <input type="text" id="oldpass" name="oldpass" class="form-control">
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label for="exampleEmail5">New Password</label>
                                                                    <input type="text" id="newpass" name="newpass" class="form-control">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="exampleEmail5">Confirm New Password</label>
                                                                    <input type="text" id="newconfirmpass" name="newconfirmpass" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="messer"></div>
                                                    <div class="divider"></div>
                                                    <div class="clearfix">
                                                        <button type="button" id="updatePassword" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary"> Update Password </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php include 'inc/footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function (e) {
        $("#updatePersonal").on('click', function () {
                document.getElementById('updatePersonal').innerHTML = "Updating...";
                document.getElementById('updatePersonal').disabled = true;
                if ($("#fname").val() !== "" && $("#lname").val() !== "" && $("#phone").val() !== "" && $("#address").val() !== "" && $("#state").val() !== "") {

                    $.ajax({
                        type: 'POST',
                        url: '../api/controllers/update_personal.php',
                        data: {
                            fname : $("#fname").val(),
                            lname : $("#lname").val(),
                            phone : $("#phone").val(),
                            address : $("#address").val(),
                            state : $("#state").val(),
                            country : $("#country").val()
                        },
                        cache: false,
                        dataType: 'text',
                        success: function (response) {
                            console.log(response);
                            // return;
                            if(response == 'success'){
                                document.getElementById('updatePersonal').innerHTML = 'Update Info';
                                document.getElementById('updatePersonal').disabled = false;
                                 document.getElementById('messer').innerHTML = '<p class="alert alert-success">Update successful!</p>';
                                setTimeout(function () {
                                    window.location.reload();
                                }, 3000);
                                return false;
                            }else{
                                 document.getElementById('updatePersonal').innerHTML = 'Update Info';
                                 document.getElementById('messer').innerHTML = '<p class="alert alert-danger">Error trying to update your profile, contact our customer care representative!</p>';
                                document.getElementById('updatePersonal').disabled = false;
                                setTimeout(function () {
                                    window.location.reload();
                                }, 3000);
                                return false;
                            }
                        }
                    });
                    event.preventDefault();
                } else {
                    document.getElementById('messer').innerHTML = '<p class="alert alert-danger">Please fill in your information.</p>';
                    document.getElementById('updatePersonal').innerHTML = "Retry";
                    document.getElementById('updatePersonal').disabled = false;
                }
            });
        // $("#updatePersonal").on('click',(function(e) {
        //     e.preventDefault();
        //     $("#result").empty();
        //     document.getElementById('updatePersonal').innerHTML = 'Updating';
        //     document.getElementById('updatePersonal').disabled = true;
        //     $.ajax({
        //         url: "../api/controllers/update_personal.php", // Url to which the request is send
        //         type: "POST",             // Type of request to be send, called as method
        //         data: {
        //             fname : $("#fname").val(),
        //             lname : $('#lname').val(),
        //             phone : $('#phone').val(),
        //             address : $('#address').val(),
        //             state : $('#state').val()

        //         }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        //         contentType: false,       // The content type used when sending data to the server.
        //         cache: false,             // To unable request pages to be cached
        //         processData:false,        // To send DOMDocument or non processed data file it is set to false
        //         success: function(data)   // A function to be called if request succeeds
        //         {
        //             alert(data);
        //             return;
        //             document.getElementById('updatePersonal').innerHTML = 'Update Info';
        //             $("#result").html(data);
        //             setTimeout(function () {
        //                 $('#result').fadeOut();
        //                 window.location.reload();
        //             }, 2000);

        //         }
        //     });
        // }));

// Function to preview image after validation
    $(function() {
        $("#file").change(function() {
            $("#message").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match= ["image/jpeg","image/png","image/jpg"];
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
            {
                $('#previewing').attr('src','noimage.png');
                $("#message").html("<p id='error' class='text-sm'>Please Select A valid Image File.<br>Only jpeg, jpg and png Images type allowed</p>");
                return false;
            }
            else
            {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    function imageIsLoaded(e) {
        $("#file").css("color","green");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '250px');
        $('#previewing').attr('height', '230px');
    };
});
</script>