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
  <h2 class="title-page">Contact Us</h2>
  <div class="row">
    <div class="info-contacts col-12">
      <div class="contact-map-wrap">
        <div class="block-map">
          <div class="block-content">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.8850042990534!2d6.908156814420951!3d6.010524530582236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1043bd36b800ffd5%3A0x20bdaaafe5ab4e57!2sNnewi%20Anambra%20state!5e0!3m2!1sen!2sng!4v1590605911094!5m2!1sen!2sng" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>
        </div>

      </div>
    </div>
    <div class="contact-form col-12">
      <div class="row form-contact">
        <div class="col-lg-4 col-md-4">
          <div class="title-bonus-page">
            <h2>CONTACT US</h2>
          </div>
          <div class="contact-des">
          </div>
          <ul class="list-info">
            <li class="item-info main-info">
              <div class="info-content"><i class="fa fa-map-marker"></i>
                <span class="des-info">Nnewi, Anambra state, Nigeria</span>
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
                <span class="des-info"><a href="tel:0123456789">09030334259</a></span>
                <span class="des-info"><a href="tel:0123456789">09082244668</a></span>
              </div>
            </li>
          </ul>
        </div>
        <div class="col-lg-8 col-md-8">
          <div class="title-bonus-page">
            <h2>SEND YOUR COMMENTS</h2>
          </div>
          <?php if(isset($_GET['result'])): ?>
            <div class="alert alert-success"><?= $_GET['result'] ?></div>
          <?php endif; ?>
          <div class="contact-form form-vertical">
            <form method="post" action="<?= BASE_URL ?>api/controllers/contact.php" id="contact_form" accept-charset="UTF-8" class="contact-form"><input type="hidden" name="form_type" value="contact" /><input type="hidden" name="utf8" value="✓" />
            <div class="row">
              <div class="col-12 col-sm-6">
                <label class="hidden" for="ContactFormName">Your Name...</label>
                <input type="text" id="ContactFormName" name="name" placeholder="Your Name..." value="">
              </div>
              <div class="col-12 col-sm-6">
                <label class="hidden" for="ContactFormEmail" class="">Your Email...</label>
                <input type="email" id="ContactFormEmail" name="email" placeholder="Your Email..." autocorrect="off" autocapitalize="off" value="" class="">
              </div>
            </div>

            <label class="hidden" for="ContactFormPhone">Your Phone Number...</label>
            <input type="tel" id="ContactFormPhone" name="phone"  placeholder="Your Phone Number..." pattern="[0-9\-]*" value="">

            <label class="hidden" for="ContactFormMessage">Message</label>
            <textarea rows="10" id="ContactFormMessage" placeholder="Message" name="body"></textarea>

            <input type="submit" class="btn" value="SEND MESSAGE">

            </form>
          </div>
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
