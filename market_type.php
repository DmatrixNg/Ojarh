<?php require_once 'inc/header.php'; ?>
<?php //$catDetails = $userClass->categoryDetails($_GET['search_type']); ?>
                <section id="breadcrumbs" class=" breadcrumbbg">
                    <div class="breadcrumbwrapper">
                        <div class="container">
                            <nav>
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="index.php" title="Back to the frontpage"><span>Home</span></a>
                                    </li>
                                    <li class="active">
                                        <span><span><?php echo $_GET['type']; ?> Market</span></span>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </section>

                <div class="container mb-5">
                    <div class="col-main col-full">
                        <div id="shopify-section-collection-infos" class="shopify-section">
                            <div class="collection-info banners row">
                                <div class=" col-md-9">
                                    <h1 class="collection-tille"><?php echo $_GET['type']; ?> Market</h1>
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" type="text" name="search" id="search" placeholder="Search seller..." />
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="row ml-2">
                            <?php $userClass->location_market($_GET['type']); ?>
                        </div>
                    </div>

                </div>

            </div>

<?php require_once 'inc/footer.php'; ?>
<script type="text/javascript">

function openForm(id) {
  // console.log(id);
  document.getElementById("myForm-"+id).style.display = "block";
}

function closeForm(id) {
  document.getElementById("myForm-"+id).style.display = "none";
}
</script>
