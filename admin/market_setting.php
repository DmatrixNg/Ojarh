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
            <div class="row">
              <div class="col-md-12 col-lg-6 col-xl-6">
                <div class="main-card mb-3 card">
                  <div class="card-body"><h5 class="card-title">Add New Market</h5>
                  <hr>
                  <?php if(isset($_GET['result'])){ echo '<div class="alert alert-success">'.$_GET['result'].'</div>';} ?>
                    <form action="../api/controllers/market_add.php" method="post" enctype="multipart/form-data">
                      <div class="position-relative form-group">
                      <label for="marketname" class="">Market Name</label>
                      <input name="marketname" id="marketname" type="text" class="form-control">
                      </div>
                      <div class="position-relative form-group">
                      <label for="state" class="">Choose State Location of the Market</label>
                      <select class="form-control" name="marketstate" id="marketstate">
                        <option value="" selected="selected">Select State</option>
                        <?php $userClass->fetchStates(); ?>
                      </select>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-12">
                          <label for="exampleEmail5">Product Categories</label>
                          <select multiple="multiple" class="multiselect-dropdown form-control" name="marketcategories[]" id="marketcategories[]" required="required">
                            <?php $userClass->category_dropdown_list(); ?>
                          </select>
                        </div>
                      </div>
                      <div class="position-relative form-group">
                        <label for="marketaddress" class="">Market Address</label>
                        <textarea class="form-control" rows="2" id="marketaddress" name="marketaddress"></textarea>
                      </div>
                      <div class="position-relative form-group">
                      <label for="marketchair" class="">Market Chairman Name</label>
                      <input name="marketchairman" id="marketchairman" type="text" class="form-control">
                      </div>
                      <div class="position-relative form-group">
                      <label for="marketfile" class="">Upload market Image</label>
                      <input name="marketimg" id="marketimg" type="file" class="form-control-file">
                        <p class="form-text text-danger"><em>Icon image must be in png, jpg or gif, and must me 50 X 50 in dimension.</em></p>
                      </div>
                      <button type="submit" class="mt-1 btn btn-primary" id="marketBtn">Create Market</button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-6">
              <div class="main-card mb-3 card">
                <div class="card-header">Market List
                  <span id="intoto"></span>
                </div>
                <ul class="todo-list-wrapper list-group list-group-flush">
                  <?php $userClass->market_list(); ?>
                </ul>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?Php include_once('inc/footer.php'); ?>
