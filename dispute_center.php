<?php require_once 'inc/header.php'; ?>

<section id="breadcrumbs" class=" breadcrumbbg">
  <div class="breadcrumbwrapper">
    <div class="container">
      <nav>
        <ol class="breadcrumb">
          <li itemprop="itemlistelement">
            <a href="index.php" title="Back to the frontpage">
              <span itemprop="name">Home</span>
            </a>
            <meta itemprop="position" content="1" />
          </li>
          <li class="active">
            <span itemprop="item"><span>Contact Us</span></span>
            <meta itemprop="position" content="2" />
          </li>
        </ol>
      </nav>
    </div>
  </div>
</section>
<div id="shopify-section-template-contact" class="shopify-section"><div class="container page-contact no-padding">

  <div class="row">
    <div class="contact-form col-12">
      <div class="row form-contact">
        <div class="col-lg-4 col-md-4">
        <h2 class="title-page">Dispute Center</h2>
          <div class="contact-des" style="font-size: 15px;">
            Fill our dispute form if any of our sellers(International or Local), agents, buyers or admins has been found of misconduct and the management will look into it.
          </div>
          <ul class="list-info">
            <li class="item-info main-info">
              <div class="info-content"><i class="fa fa-map-marker"></i>
                <span class="des-info">123 Suspendis mattis, Sollicitudin District, Accums Fringilla</span>
              </div>
            </li>
            <li class="item-info email-info">
              <div class="info-content"><i class="fa fa-envelope"></i>
                Email:
                <span class="des-info"><a href="mailto:support@ojarh.com">support@ojarh.com</a></span>
              </div>
            </li>
            <li class="item-info phone">
              <div class="info-content"><i class="fa fa-phone"></i>
                Phone:
                <span class="des-info"><a href="tel:09030334259">09030334259</a></span>
                <span class="des-info"><a href="tel:09082244668">09082244668</a></span>
              </div>
            </li>
          </ul>
        </div>
        <div class="col-lg-8 col-md-8">
          <div class="title-bonus-page">
            <h2>DISPUTE FORM</h2>
          </div>
          <?php if(isset($_GET['result'])){ ?>
          <div class="contact-form form-vertical">
              <h3>Thank you:</h3>
              <p><?php echo $_GET['result']; ?></p>
          </div>
          <?php }else{ ?>
          <div class="contact-form form-vertical">
            <form method="post" action="api/controllers/public_dispute.php" id="contact_form" accept-charset="UTF-8" class="contact-form"  enctype="multipart/form-data">
            <div class="row">
              <div class="col-12 col-sm-4">
                <label for="complainer_fullname">Your Full Name...</label>
                <input type="text" id="complainer_fullname" name="complainer_fullname" placeholder="type here..." value="">
              </div>
              <div class="col-12 col-sm-4">
                <label for="complainer_email" class="">Your Email...</label>
                <input type="email" id="complainer_email" name="complainer_email" placeholder="type here..." autocorrect="off" autocapitalize="off" value="" class="">
              </div>
              <div class="col-12 col-sm-4">
                <label for="complainer_phone" class="">Your Phone Number...</label>
                <input type="tel" id="complainer_phone" name="complainer_phone"  placeholder="type here..." pattern="[0-9\-]*" value="">
              </div>
            </div>

            <label for="subject_request">Subject of Request...</label>
            <input type="text" id="subject_request" name="subject_request"  placeholder="type here..."  value="">

            <label for="uid">Complaining Against...</label>
            <input class="form-control" type="text" name="uid" id="uid" placeholder="User involved: search  by user id" class="" onfocus="fetch_all_user(this.id);" onkeyup="fetch_all_user(this.id);">

            <label for="message_inform">Message</label>
            <textarea rows="10" id="message_inform" placeholder="Message" name="message_inform"></textarea>

            <hr>
            <label for="sellerid">Upload evidence file if there is any:</label>
            <input type="file" name="evidencefile" id="evidencefile" class="form-control" >

            <input type="submit" class="btn" value="SEND MESSAGE">

            </form>
          </div>
          <?php } ?>
        </div>

      </div>
    </div>
  </div>

</div>
<style>
  /* .main-content{
    padding-bottom: 0 !important;
  } */
</style>
</div>
</div>
<?php require_once 'inc/footer.php'; ?>
