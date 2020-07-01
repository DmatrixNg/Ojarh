<?php
include('../api/config/Database.php');
include('../api/models/session.php');
include('can_access.php');
?>
<?php include 'inc/header.php'; ?>
<div class="app-inner-layout app-inner-layout-page">
	<div class="app-inner-layout__wrapper">
		<div class="app-inner-layout__content">
			<div class="tab-content">
				<div class="container-fluid">

                    <div class="card no-shadow bg-transparent no-border rm-borders mb-3">
                        <div class="card">
                            <div class="container">
                                <div class="row m-5">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="heading heading-2 text-center mb-70">
                                            <h2 class="heading--title">Inactive Adverts</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 48.2px;" aria-sort="ascending" aria-label="Image: activate to sort column descending">Image</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Ads Location: activate to sort column ascending">Ads Location</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 42.2px;" aria-label="Link: activate to sort column ascending">Link</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 56.2px;" aria-label="End date: activate to sort column ascending">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 26.2px;" aria-label="Created on: activate to sort column ascending">Created On</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 56.2px;" aria-label="End date: activate to sort column ascending">End Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 49.2px;" aria-label="Action: activate to sort column ascending">Action</th></tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($userClass->get_inactive_ads() as $key => $value): ?>
                                                <tr role="row" class="odd">
                                                    <?php
                                                    if($value['status']==0){
                                                        $sta = '<span class="badge badge-secondary">Pending</span>';
                                                    }elseif($value['status']==1){
                                                        $sta = '<span class="badge badge-info">Active</span>';
                                                    }elseif($value['status']==2){
                                                        $sta = '<span class="badge badge-warning">Stopped</span>';
                                                    }elseif($value['status']==3){
                                                        $sta = '<span class="badge badge-danger">Rejected</span>';
                                                    }elseif($value['status']==4){
                                                        $sta = '<span class="badge badge-success">Completed</span>';
                                                    }
                                                    ?>
                                                    <td tabindex="0" class="sorting_1"><img src='../public/ads/<?= $value['img'] ?>' width="150" /></td>
                                                    <td><?= $value['ads_location'] ?></td>
                                                    <td><?= $value['link'] ?></td>
                                                    <td><?= $sta ?></td>
                                                    <td><?= $value['created'] ?></td>
                                                    <td><?= $value['end_date'] ?></td>
                                                    <td>
																											<a class="mb-2 btn btn-shadow btn-outline-success btn-sm" href="../api/controllers/ad_review.php?ad_id=<?php echo $value['id'].'&status=1';?>">
														                        Approve</a>
																											<a class="mb-2 btn btn-shadow btn-outline-danger btn-sm" href="../api/controllers/ad_review.php?ad_id=<?php echo $value['id'].'&status=3';?>">
														                        Deactivate</a>
														                    </td>
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
