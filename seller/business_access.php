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
                    <div class="card no-shadow bg-transparent no-border rm-borders mb-3">
                        <div class="card">
                            <div class="container">
                                <div class="row m-5">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="heading heading-2 text-center mb-70">
                                            <h2 class="heading--title">Business Details Access Control</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                      <?php if(isset($_GET['result'])): ?>
                                        <div class="alert alert-success"><?= $_GET['result'] ?></div>
                                      <?php endif; ?>
                                    <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 48.2px;" aria-sort="ascending" aria-label="User: activate to sort column descending">User name</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Access: activate to sort column ascending">Access Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 26.2px;" aria-label="Date: activate to sort column ascending">Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 49.2px;" aria-label="Action: activate to sort column ascending">Action</th></tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($userClass->get_business_access($_SESSION['userid']) as $key => $value): ?>
                                                <?php $user = $userClass->userDetails($value['userid']) ?>
                                                <tr role="row" class="odd">


                                                    <td tabindex="0" class="sorting_1"><?= $user->fname.' '.$user->lname ?></td>
                                                    <td><?= $value['access'] ?></td>
                                                    <td><?= $value['date'] ?></td>
                                                    <td>
                                                      <a href="../api/controllers/business_access_status.php?id=<?= $value['userid'] ?>&access=1" class="btn btn-success btn-sm">Approve</a>
                                                      <a href="../api/controllers/business_access_status.php?id=<?= $value['userid'] ?>&access=0" class="btn btn-danger btn-sm">Revoke</a>

                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
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
