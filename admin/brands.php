<?php
include('../api/config/Database.php');
include('../api/models/session.php');
include('can_access.php');
?>
<?Php include_once('inc/header.php'); ?>
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
                      <h2 class="heading--title">Brand List</h2>
                    </div>
                    <div id="result"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-lg-4">
                      <div class="main-card mb-3 card">
                          <div class="card-body">
                          <h5 class="card-title">Add New Brand</h5>
                          <hr>
                          <?php if(isset($_GET['result'])): ?>
                          <div class="alert alert-success"><?= $_GET['result'] ?></div>
                          <?php endif; ?>
                              <form action="../api/controllers/brand_add.php" method="post" enctype="multipart/form-data">
                                  <div class="position-relative form-group">
                                  <label for="brandname" class="">Title</label>
                                  <input name="brandname" id="brandname" type="text" class="form-control">
                                  </div>
                                  <div class="position-relative form-group">
                                  <label for="marketfile" class="">Upload market Image</label>
                                  <input name="brandimg" id="brandimg" type="file" class="form-control-file">
                                  </div>
                                  <button type="submit" class="mt-1 btn btn-primary" id="marketBtn">Add Brand</button>
                              </form>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-12 col-lg-8">
                    <div class="main-card mb-3 card">
                      <div class="card-body">
                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Image</th>
                              <th>Brand</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($userClass->getBrands() as $key => $value): ?>
                            <tr>
                              <td>
                              <img src="images/brands/<?= $value['img']; ?>" width="100" />
                              </td>
                              <td>
                              <?= $value['title'] ?>
                              </td>
                              <td>
                              <a class="btn btn-danger" href="../api/controllers/brand_delete.php?brandid=<?= $value['id'] ?>&brandtitle=<?= $value['title'] ?>&brandimg=<?= $value['img'] ?>">
                                Delete
                              </a>
                              </td>
                            </tr>
                            <?php endforeach; ?>
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
  </div>
</div>
<?Php include_once('inc/footer.php'); ?>
