<?php require_once 'inc/header.php'; ?>
<?php
    isset($_COOKIE['cart']) ? '' : header('Location: index.php');
 ?>
<div id="shopify-section-cart-template" class="shopify-section">
<div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
    <div class="page-carts">
      <h1 class="title-cart">Billing &amp; Payment</h1>
      <?php if(isset($_GET['info'])){ echo '<span class="pull-right">'.$_GET['info'].'</span>'; } ?>
    </div>
    <div novalidate class="cart row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="main">
                <main class="main__content" role="main">
                    <div class="step">
                            <div class="step__sections">
                                <div class="section section--contact-information">
                                    <div class="section__header">
                                        <div class="layout-flex layout-flex--tight-vertical layout-flex--loose-horizontal layout-flex--wrap">
                                            <h3 class="section__title layout-flex__item layout-flex__item--stretch" id="main-header" tabindex="-1">
                                                Contact information
                                            </h3>
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
                                            <div class="form-group pt-2">
                                                <label class="field__label" for="checkout_email_or_phone">Your Email</label>
                                                <div class="field__input-wrapper">
                                                    <input value="<?php echo isset($userDetails->email) ? $userDetails->email : ''; ?>" placeholder="Email" class="form-control" type="email" name="checkout_email" id="checkout_email"  required style="height: 50px;"/>
                                                </div>
                                            </div>
                                            <div class="form-group pt-2">
                                                <label class="field__label" for="checkout_email_or_phone">Mobile phone number</label>
                                                <div class="field__input-wrapper">
                                                    <input value="<?php echo isset($userDetails->phone) ? $userDetails->phone : ''; ?>" placeholder="Your Mobile phone number" class="form-control" type="tel" name="checkout_phone" id="checkout_phone"  required style="height: 50px;"//>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="section section--shipping-address">
                                    <div class="section__header">
                                        <h3 class="section__title">
                                            Shipping address
                                        </h3>
                                    </div>

                                    <div class="section__content">
                                        <div class="fieldset">
                                            <div class="address-fields" data-address-fields>
                                                <div class="form-group pt-2">
                                                    <label class="field__label" for="checkout_shipping_address_first_name">First name (optional)</label>
                                                    <div class="field__input-wrapper">
                                                        <input placeholder="First name (optional)" class="form-control" type="text" name="checkout_fname" id="checkout_fname" required value="<?php echo isset($userDetails->fname) ? $userDetails->fname : ''; ?>"
                                                        style="height: 50px;"/>
                                                    </div>
                                                </div>
                                                <div class="form-group pt-2">
                                                    <label class="field__label" for="checkout_shipping_address_last_name">Last name</label>
                                                    <div class="field__input-wrapper">
                                                        <input placeholder="Last name" class="form-control" type="text" name="checkout_lname" id="checkout_lname" required  value="<?php echo isset($userDetails->lname) ? $userDetails->lname : ''; ?>" style="height: 50px;"/>
                                                    </div>
                                                </div>
                                                <div class="form-group pt-2">
                                                    <label class="field__label" for="checkout_shipping_address_address1">Address</label>
                                                    <div class="field__input-wrapper">
                                                        <input placeholder="Address" class="form-control" type="text" name="checkout_address" id="checkout_address" required value="<?php echo isset($userDetails->address) ? $userDetails->address : ''; ?>" style="height: 50px;"/>
                                                    </div>
                                                </div>
                                                <div class="form-group pt-2">
                                                    <label class="field__label" for="checkout_shipping_address_city">City/State</label>
                                                    <div class="field__input-wrapper">
                                                        <input placeholder="City" value="<?php echo isset($userDetails->state) ? $userDetails->state : ''; ?>"  class="form-control" type="text" name="checkout_city" id="checkout_city" required style="height: 50px;"/>
                                                    </div>
                                                </div>
                                                <div class="form-group pt-2">
                                                    <label class="field__label" for="checkout_shipping_address_country">Country/Region</label>
                                                    <div class="field__input-wrapper field__input-wrapper--select">
                                                        <select class="form-control" name="checkout_country" id="checkout_country" required  style="height: 50px;">
                                                        <option value="<?php echo $userClass->getRealIpAddr(); ?>" selected="selected"><?php echo $userClass->getRealIpAddr(); ?></option>
                                                            <?php echo $userClass->fetchCountries(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group pt-2">
                                                    <label class="field__label" for="checkout_shipping_address_zip">Postal code</label>
                                                    <div class="field__input-wrapper">
                                                        <input placeholder="Postal code" class="form-control" type="text" name="checkout_postal" id="checkout_postal" required  style="height: 50px;"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="step__footer p-5">
                                <!-- <button name="button" type="submit" id="continue_button" class="step__footer__continue-btn btn" aria-busy="false">
                                    <span class="btn__content" data-continue-button-content="true">Submit</span>
                                    <svg class="icon-svg icon-svg--size-18 btn__spinner icon-svg--spinner-button" aria-hidden="true" focusable="false"><use xlink:href="#spinner-button" /></svg>
                                </button> -->
                                <a class="btn btn-danger btn-sm" href="carting.php">
                                    <i class="fa fa-angle-left"></i>
                                    <span class="step__footer__previous-link-content">Return to cart</span>
                                </a>
                            </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            <aside class="sidebar pt-5" role="complementary">
                <div class="sidebar__content">
                    <h1>PRODUCT DETAILS</h1>
                    <hr>
                <?php $userClass->payment_page2(); ?>
                </div>

            </aside>
        </div>
    </div>

</div>


</div>


        </div>
<?php require_once 'inc/footer.php'; ?>
<script>
function paypal(id) {

let info = $('#paypal-button-container'+id).attr('details').split('~');
$('#'+id).hide();
paypal_sdk.Buttons({

    env: "sandbox",

    client: {
      sandbox : "AbQqKqx2I6b8xNiBrMNhLRoaivIykxYyauyoHq9Hn6iD98uYTNSfdD8JtxvlVSwfo_H5RSdgDILGxiGm",
      production : ""
    },


    createOrder: function(data, actions) {
    return actions.order.create({

      intent: "CAPTURE",

      purchase_units: [
      {
        payer: $('#checkout_fname').val()+" "+$('#checkout_lname').val(),
        amount: {
        currency_code: "USD",
        value: info[0]
      },
        custom_id: id,
        payee: {
          email: $('#checkout_email').val()
        }
        ,
        shiping: {
          address: $('#checkout_address').val()+', '+$('#checkout_city').val()+', '+$('#checkout_country').val()+', '+$('#checkout_postal').val()
        }
      }
    ]
        });
      },
  onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        // This function shows a transaction success message to your buyer.
        alert('Transaction completed by ' + details.payer.name.given_name);
        // console.log(details);
        // console.log(details.payer);
        var data = {
            sellerid : id,
            total_amount : info[0],
            other_info : $('#paypal-button-container'+id).attr('details'),
            productid : $('#paypal-button-container'+id).attr('productid'),
            qty : $('#paypal-button-container'+id).attr('qty'),
            checkout_email : $('#checkout_email').val(),
            checkout_phone : $('#checkout_phone').val(),
            checkout_fname : $('#checkout_fname').val(),
            checkout_lname : $('#checkout_lname').val(),
            billing_address : $('#checkout_address').val()+', '+$('#checkout_city').val()+', '+$('#checkout_country').val()+', '+$('#checkout_postal').val(),
            details : details,
            status : 'Pay with Card',
            pay_status : details.status,
            location: details.purchase_units[0].shipping.address
        }

        $.ajax({
            type: 'POST',
            url: 'api/controllers/place_order.php',
            data: data,
            cache: false,
            dataType: 'text',
            success: function (response) {
                // console.log(response);
                $('#success'+id).show();
                $('#POD'+id).hide();
                AddCartmini(id, $('#paypal-button-container'+id).attr('productid'),0);

                window.location.reload();

            }
        });
      });
    }
}).render('#paypal-button-container'+id);
}
 </script>
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


        if($('#checkout_email').val() == '' ||
        $('#checkout_phone').val() == '' ||
        $('#checkout_fname').val() == '' ||
        $('#checkout_lname').val() == '' ||
        $('#checkout_address').val() == '' ){
            $('#info_'+sellerid).html('<span class="badge badge-warning">Please fill out the billing address</span>');
            // $('#info_'+sellerid).fadeOut(5000);
            return;
        }

// console.log("here");

                        var data = {
                            sellerid : sellerid,
                            total_amount : info[0],
                            other_info : totalamount_fname_lname_email_phone_currency,
                            checkout_email : $('#checkout_email').val(),
                            checkout_phone : $('#checkout_phone').val(),
                            checkout_fname : $('#checkout_fname').val(),
                            checkout_lname : $('#checkout_lname').val(),
                            billing_address : $('#checkout_address').val()+', '+$('#checkout_city').val()+', '+$('#checkout_country').val()+', '+$('#checkout_postal').val(),
                            status : 'Pay on delivery',
                            productid : info[6],
                            qty : info[7],
                            details : totalamount_fname_lname_email_phone_currency,
                            location: $('#checkout_address').val()+', '+$('#checkout_city').val()+', '+$('#checkout_country').val()+', '+$('#checkout_postal').val(),
                            pay_status : "ON DELIVERY"

                        }
                        // console.log(data);

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
                AddCartmini(sellerid, info[6],0);
                window.location.reload()

            }
        });
        event.preventDefault();
    }

    const API_publicKey = "FLWPUBK-3b29aead2d77c278f651c8325b3fcbb7-X";

    function payWithRave(sellerid, totalamount_fname_lname_email_phone_currency) {
      let info = totalamount_fname_lname_email_phone_currency.split('~');

      if (info[5] == "N") {
        var currency = "NGN";

      }
      if (info[5] == "$") {
        var currency = "USD";

      }
        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: info[3],
            amount: info[0],
            customer_phone: info[4],
            currency: currency,
            txref: "rave-"+Math.floor((Math.random() * 1000000000) + 1),
            meta: [{
                metaname: "flightID",
                metavalue: "AP1234"
            }],
            onclose: function() {},
            callback: function(response) {
                var txref = response.data.txRef; // collect txRef returned and pass to a                    server page to complete status check.
                // console.log("This is the response returned after a charge", response);
                // console.log(response.respcode);
                if (
                    response.data.chargeResponseCode == "00" ||
                    response.data.chargeResponseCode == "0" ||
                    response.respcode =="00"
                ) {
                  var data = {
                      sellerid : sellerid,
                      total_amount : info[0],
                      other_info : totalamount_fname_lname_email_phone_currency,
                      checkout_email : $('#checkout_email').val(),
                      checkout_phone : $('#checkout_phone').val(),
                      checkout_fname : $('#checkout_fname').val(),
                      checkout_lname : $('#checkout_lname').val(),
                      billing_address : $('#checkout_address').val()+', '+$('#checkout_city').val()+', '+$('#checkout_country').val()+', '+$('#checkout_postal').val(),
                      status : 'Pay with Card'

                  }



                  $.ajax({
                      type: 'POST',
                      url: 'api/controllers/place_order.php',
                      data: data,
                      cache: false,
                      dataType: 'text',
                      success: function (response) {
                          console.log(response);
                          window.location.reload()
                      }
                  });
                } else {
                    // redirect to a failure page.
                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });
    }

    function paywithcard(sellerid, totalamount_fname_lname_email_phone_currency){

      let info = totalamount_fname_lname_email_phone_currency.split('~');
      // console.log(info);
      if (info[5] == "N") {
        var currency = "NGN";
      }else {
        var currency = "NGN";

      }
       num = parseFloat(info[0]) * 100;
       // console.log(num);
        var handler = PaystackPop.setup({
            key: 'pk_test_7974282ff9c7f73d5afc1a79fd11746cba653e28',
            amount: num,
            first_name: info[1],
            last_name: info[2],
            email: info[3],
            currency: currency,
            ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            metadata: {
                custom_fields: [
                    {
                        display_name: "Mobile Number",
                        variable_name: "mobile_number",
                        value: info[4]
                    }
                ]
            },
            callback: function(response){
                alert('success. transaction ref is ' + response.message);

                var data = {
                    sellerid : sellerid,
                    total_amount : info[0],
                    other_info : totalamount_fname_lname_email_phone_currency,
                    checkout_email : $('#checkout_email').val(),
                    checkout_phone : $('#checkout_phone').val(),
                    checkout_fname : $('#checkout_fname').val(),
                    checkout_lname : $('#checkout_lname').val(),
                    billing_address : $('#checkout_address').val()+', '+$('#checkout_city').val()+', '+$('#checkout_country').val()+', '+$('#checkout_postal').val(),
                    status : 'Pay with Card',
                    productid : info[6],
                    qty : info[7],
                    details : totalamount_fname_lname_email_phone_currency,
                    location: $('#checkout_address').val()+', '+$('#checkout_city').val()+', '+$('#checkout_country').val()+', '+$('#checkout_postal').val(),
                    pay_status : "COMPLETED"

                }

                // console.log(data);


                $.ajax({
                    type: 'POST',
                    url: 'api/controllers/place_order.php',
                    data: data,
                    cache: false,
                    dataType: 'text',
                    success: function (response) {
                        // console.log(response);
                        AddCartmini(sellerid, info[6],0);

                        window.location.reload()
                    }
                });
                return;
            },
            onClose: function(){
                alert('window closed');
            }
        });
        handler.openIframe();
    }
</script>
