<?php
    require_once 'api/config/Database.php';
    require_once 'api/models/Controller.php';
    $db = getDB();
    $userClass = new Users($db);
    if(isset($_SESSION['userid']))
        {
            $userid=$_SESSION['userid'];
            $userDetails = $userClass->userDetails($_SESSION['userid']);
        }
    if(!isset($_SESSION['cart'])){
        header('Location: carting.php?info=Your cart is empty!');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, user-scalable=0" />
        <meta name="referrer" content="origin" />
        <title>Checkout - OJARH.com - home of wholesalers...</title>
        <meta data-browser="chrome" data-browser-major="81" />
        <link rel="shortcut icon" href="assets/images/logo_120x@3x.png?466" type="image/x-icon"/>
        <meta
            data-body-font-family="-apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, Helvetica, Arial, sans-serif, &#39;Apple Color Emoji&#39;, &#39;Segoe UI Emoji&#39;, &#39;Segoe UI Symbol&#39;"
            data-body-font-type="system"
        />
        <meta id="shopify-digital-wallet" name="shopify-digital-wallet" content="/5131304995/digital_wallets/dialog" />
        <meta name="shopify-checkout-authorization-token" content="3fc3d7b566a78c724292b83643130763" />
        <meta id="shopify-regional-checkout-config" name="shopify-regional-checkout-config" content='{"bugsnag":{"checkoutJSApiKey":"717bcb19cf4dd1ab6465afcec8a8de02","endpoint":"https:\/\/notify.bugsnag.com"}}' />
        <!--[if lt IE 9]>
            <link rel="stylesheet" media="all" href="//cdn.shopify.com/app/services/5131304995/assets/42559406115/checkout_stylesheet/v2-ltr-edge-45c5a0665f17c948dd566c307407b5de-477/oldie" />
        <![endif]-->

        <!--[if gte IE 9]><!-->

        <link href="assets/css/jquery-ui.css" rel="Stylesheet"></link>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" media="all" href="assets/css/v2-ltr-edge-45c5a0665f17c948dd566c307407b5de-477" />
        <!--<![endif]-->
        <script src="assets/js/countries-329a2a9d247036c6736571843df27ba1c1bb345b-1566530998.js?version=edge" crossorigin="anonymous"></script>
        <script src="assets/js/checkout-59c2305d98776f33af6ea09bc4fa171c44d75b8871aad148aed5bad559214a0b.js" crossorigin="anonymous"></script>
        <script>
            window.ShopifyPaypalV4VisibilityTracking = true;
        </script>

        <script type="text/javascript">
            Shopify.clientAttributesCollectionEventName = "client_attributes_checkout";
            var DF_CHECKOUT_TOKEN = "cca60f756796f5ab7f0e33a9e4236315";
        </script>
    </head>
    <body>
        <a href="#main-header" class="skip-to-content">
            Skip to content
        </a>

        <header class="banner" data-header role="banner">
            <div class="wrap">
              <a href="index.php" class="site-header-logo-image logo logo--left">
                  <img src="assets/images/logo_149x.png?v=1566553564"
                        srcset="assets/images/logo_149x.png?v=1566553564"
                        alt="Ojarh.com"
                        itemprop="logo">
              </a>
                <!-- <a class="logo logo--left" href="https://rt-aashop-demo.myshopify.com/"><span class="logo__text heading-1"></span></a> -->

                <h1 class="visually-hidden">
                    Information
                </h1>
            </div>
        </header>

        <div class="content" data-content>
            <div class="wrap">
                <div class="main">
                    <header class="main__header" role="banner">
                        <a href="index.php" class="logo logo--left">
                            <img src="assets/images/logo_149x.png?v=1566553564"
                                srcset="assets/images/logo_149x.png?v=1566553564"
                                alt="Ojarh.com"
                                itemprop="logo">
                        </a>
                        <h1 class="visually-hidden">
                            Information
                        </h1>

                        <nav aria-label="Breadcrumb">
                            <ul class="breadcrumb">
                              <h3 style="font-size: 18px;">Billing Address</h3>
                            </ul>
                        </nav>

                        <div class="shown-if-js" data-alternative-payments></div>
                    </header>
                    <main class="main__content" role="main">
                        <div class="step">
                                <div class="step__sections">
                                    <div class="section section--contact-information">
                                        <div class="section__header">
                                            <div class="layout-flex layout-flex--tight-vertical layout-flex--loose-horizontal layout-flex--wrap">
                                                <h2 class="section__title layout-flex__item layout-flex__item--stretch" id="main-header" tabindex="-1">
                                                    Contact information
                                                </h2>
                                                <?php
                                                if(isset($_SESSION['userid'])){ ?>
                                                  <!-- <p class="layout-flex__item">
                                                      <a href="signin.php">
                                                          <span class="visually-hidden">Use profile details:</span>
                                                          Update with profile address
                                                      </a>
                                                  </p> -->
                                                <?php }else{ ?>

                                                <p class="layout-flex__item">
                                                    <span aria-hidden="true">Already have an account?</span>
                                                    <a href="signin.php">
                                                        <span class="visually-hidden">Already have an account?</span>
                                                        Log in
                                                    </a>
                                                </p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="section__content" data-section="customer-information" data-shopify-pay-validate-on-load="false">
                                            <div class="fieldset">
                                                <div data-email-or-phone-input-wrapper="true" data-shopify-pay-email-flow="false" class="field field--email_or_phone">
                                                    <label class="field__label" for="checkout_email_or_phone">Your Email</label>
                                                    <div class="field__input-wrapper">
                                                        <input value="<?php echo isset($userDetails->email) ? $userDetails->email : ''; ?>" placeholder="Email" class="field__input" type="email" name="checkout_email" id="checkout_email"  required/>
                                                    </div>
                                                </div>
                                                <div data-email-or-phone-input-wrapper="true" data-shopify-pay-email-flow="false" class="field field--email_or_phone">
                                                    <label class="field__label" for="checkout_email_or_phone">Mobile phone number</label>
                                                    <div class="field__input-wrapper">
                                                        <input value="<?php echo isset($userDetails->phone) ? $userDetails->phone : ''; ?>" placeholder="Your Mobile phone number" class="field__input" type="tel" name="checkout_phone" id="checkout_phone"  required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="section section--shipping-address" data-shipping-address>
                                        <div class="section__header">
                                            <h2 class="section__title">
                                                Shipping address
                                            </h2>
                                        </div>

                                        <div class="section__content">
                                            <div class="fieldset">
                                                <div class="address-fields" data-address-fields>
                                                    <div class="field--half field field--optional" data-address-field="first_name">
                                                        <label class="field__label" for="checkout_shipping_address_first_name">First name (optional)</label>
                                                        <div class="field__input-wrapper">
                                                            <input placeholder="First name (optional)" class="field__input" type="text" name="checkout_fname" id="checkout_fname" required value="<?php echo isset($userDetails->fname) ? $userDetails->fname : ''; ?>"
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="field--half field field--required" data-address-field="last_name">
                                                        <label class="field__label" for="checkout_shipping_address_last_name">Last name</label>
                                                        <div class="field__input-wrapper">
                                                            <input placeholder="Last name" class="field__input" type="text" name="checkout_lname" id="checkout_lname" required  value="<?php echo isset($userDetails->lname) ? $userDetails->lname : ''; ?>"/>
                                                        </div>
                                                    </div>
                                                    <div data-address-field="address1" data-autocomplete-field-container="true" class="field field--required">
                                                        <label class="field__label" for="checkout_shipping_address_address1">Address</label>
                                                        <div class="field__input-wrapper">
                                                            <input placeholder="Address" class="field__input" type="text" name="checkout_address" id="checkout_address" required value="<?php echo isset($userDetails->address) ? $userDetails->address : ''; ?>"/>
                                                        </div>
                                                    </div>
                                                    <div data-address-field="city" data-autocomplete-field-container="true" class="field field--required">
                                                        <label class="field__label" for="checkout_shipping_address_city">City/State</label>
                                                        <div class="field__input-wrapper">
                                                            <input placeholder="City" value="<?php echo isset($userDetails->state) ? $userDetails->state : ''; ?>"  class="field__input" type="text" name="checkout_city" id="checkout_city" required />
                                                        </div>
                                                    </div>
                                                    <div class="field--third field field--required">
                                                        <label class="field__label" for="checkout_shipping_address_country">Country/Region</label>
                                                        <div class="field__input-wrapper field__input-wrapper--select">
                                                            <select class="field__input field__input--select" name="checkout_country" id="checkout_country" required >
                                                            <option value="<?php echo $userClass->getRealIpAddr(); ?>" selected="selected"><?php echo $userClass->getRealIpAddr(); ?></option>
                                                              <?php echo $userClass->fetchCountries(); ?>
                                                            </select>
                                                            <div class="field__caret">
                                                                <svg class="icon-svg icon-svg--color-adaptive-lighter icon-svg--size-10 field__caret-svg" role="presentation" aria-hidden="true" focusable="false">
                                                                    <use xlink:href="#caret-down" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="field--third field field--required">
                                                        <label class="field__label" for="checkout_shipping_address_zip">Postal code</label>
                                                        <div class="field__input-wrapper">
                                                            <input placeholder="Postal code" class="field__input field__input--zip" type="text" name="checkout_postal" id="checkout_postal" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="step__footer" data-step-footer>
                                    <!-- <button name="button" type="submit" id="continue_button" class="step__footer__continue-btn btn" aria-busy="false">
                                        <span class="btn__content" data-continue-button-content="true">Submit</span>
                                        <svg class="icon-svg icon-svg--size-18 btn__spinner icon-svg--spinner-button" aria-hidden="true" focusable="false"><use xlink:href="#spinner-button" /></svg>
                                    </button> -->
                                    <a class="step__footer__previous-link" href="carting.php">
                                        <svg focusable="false" aria-hidden="true" class="icon-svg icon-svg--color-accent icon-svg--size-10 previous-link__icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10">
                                            <path d="M8 1L7 0 3 4 2 5l1 1 4 4 1-1-4-4" />
                                        </svg>
                                        <span class="step__footer__previous-link-content">Return to cart</span>
                                    </a>
                                </div>
                        </div>
                    </main>
                    <footer class="main__footer" role="contentinfo">
                        <p class="copyright-text">
                            All rights reserved > OJARH.com
                        </p>
                    </footer>
                </div>
                <aside class="sidebar" role="complementary">
                    <div class="sidebar__content">
                      <h1>PRODUCT DETAILS</h1>
                      <hr>
                      <?php $userClass->payment_page(); ?>
                    </div>
                </aside>
            </div>
        </div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script type="text/javascript">
    function payondelivery(sellerid, totalamount_fname_lname_email_phone_currency){
        // console.log(totalamount_fname_lname_email_phone_currency);

        let info = totalamount_fname_lname_email_phone_currency.split('~');
        let total_amount = info[0];
        let fname = info[1];
        let lname = info[2];
        let email = info[3];
        let phone = info[4];
        let currency = info[5];
        if(currency == 'N'){
            var curr = 'NGN';
        }else{
            var curr = 'USD';
        }

        // console.log(total_amount+' '+fname+' '+lname+' '+email+' '+phone+' '+currency);


        if($('#checkout_email').val() == '' || $('#checkout_phone').val() == '' || $('#checkout_fname').val() == '' || $('#checkout_lname').val() == '' || $('#checkout_address').val() == '' || $('#checkout_city').val() == '' || $('#checkout_country').val() == '' || $('#checkout_postal').val() == ''){
            $('#info_'+sellerid).html('<span class="badge badge-warning">Please fill out the billing address</span>');
            $('#info_'+sellerid).fadeOut(5000);
            return;
        }

        var data = {
            sellerid : sellerid,
            total_amount : total_amount,
            other_info : totalamount_fname_lname_email_phone_currency,
            checkout_email : $('#checkout_email').val(),
            checkout_phone : $('#checkout_phone').val(),
            checkout_fname : $('#checkout_fname').val(),
            checkout_lname : $('#checkout_lname').val(),
            billing_address : $('#checkout_address').val()+', '+$('#checkout_city').val()+', '+$('#checkout_country').val()+', '+$('#checkout_postal').val()
        }

        // if(serialized.indexOf('=&') > -1 || serialized.substr(serialized.length - 1) == '='){
        //     $('#info_'+sellerid).html('<span class="badge badge-warning">Please fill out the billing address</span>');
        //     $('#info_'+sellerid).fadeOut(5000);
        //     return;
        // }

        $.ajax({
            type: 'POST',
            url: 'api/controllers/place_order.php',
            data: data,
            cache: false,
            dataType: 'text',
            success: function (response) {
                console.log(response);
            }
        });
        event.preventDefault();
    }

    function paywithcard(sellerid, totalamount_fname_lname_email_phone_currency){
        var handler = PaystackPop.setup({
            key: 'pk_test_7974282ff9c7f73d5afc1a79fd11746cba653e28',
            first_name: fname,
            last_name: lname,
            email: email,
            amount: total_amount,
            currency: curr,
            ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            metadata: {
                custom_fields: [
                    {
                        display_name: "Mobile Number",
                        variable_name: "mobile_number",
                        value: phone
                    }
                ]
            },
            callback: function(response){
                alert('success. transaction ref is ' + response.message);
                // alert(response.status);
                return;
                // if(response.status == 'success'){
                //     submitUpgrade(userid, useremail);
                // }else{
                //     alert('Error:' + response.message)
                // }
            },
            onClose: function(){
                alert('window closed');
            }
        });
        handler.openIframe();
    }
</script>
    </body>
</html>
