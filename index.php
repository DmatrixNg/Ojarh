<?php require_once 'inc/header.php'; ?>
<?php
// echo '<pre>';
// print_r($_SESSION['cart']);
// echo '</pre>';
// echo '<pre>';
// print_r($_SESSION['order_status']);
// echo '</pre>';
?>
<?php require_once 'inc/brand_sec.php'; ?>
<?php require_once 'inc/top_selection.php'; ?>
<?php require_once 'inc/top_category.php'; ?>
<?php require_once 'inc/video_sec.php'; ?>
<?php require_once 'inc/first_ads.php'; ?>
<?php require_once 'inc/top_sales.php'; ?>
<?php require_once 'inc/second_ads.php'; ?>
<?php require_once 'inc/selling_product.php'; ?>
<?php require_once 'inc/top_seller.php'; ?>
<?php require_once 'inc/top_market.php'; ?>
<?php require_once 'inc/order_form.php'; ?>
<div class="container text-center p-3">
    <h5>“Timely Delivery is guaranteed“</h5>
</div>
<?php require_once 'inc/footer.php'; ?>
<div id="popup-newletter" class="popup-newletter show">
    <div class="module main-newsleter-popup newsletter-wrappers ss_newletter_oca_popup" id="newsletter-wrappers"
         style="display: block;">
        <div class="ss_newletter_custom_popup_bg popup_bg"></div>
        <div class="popup-wraper" style="width: 850px;">
            <button title="Close" type="button" class="popup-close">×</button>
            <div class="ss-custom-popup ss-custom-oca-popup">
                <div class="modcontent">
                    <div class="oca_popup" id="test-popup"
                         style="background : url(assets/images/bg-newsletter_66d46993-1cdb-41c0-8dd4-578105f9e865.png?v=1566789252) no-repeat top center">
                        <div class="popup-content">
                            <div class="wrap-info">
                                <div class="popup-title"><h4>newsletter</h4></div>
                                <div class="short-description">Subscribe to the mailing list to receive updates on new arrivals, special offers </div>
                                    <div class="input-group password__input-group">
                                        <input type="email" value="" placeholder="Join our mailing list" name="sub_email" id="sub_email" class="form-control" aria-label="Join our mailing list">
                                        <span class="input-group__btn">
                                            <button type="submit" class="btn newsletter__submit" name="commit" id="SubscribeBtn">
                                                <span class="newsletter__submit-text--large">Subscribe</span>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="subInfo text-danger text-lg"></div>
                                <label class="hidden-popup">
                                    <input type="checkbox" value="1" name="hidden-popups">
                                    <span class="inline">&nbsp;&nbsp;Don't show this popup again</span>
                                </label>
                                <!-- <div class="socials-popup">
                                    <ul class="social-list">
                                        <li><a href="#" title="title"><i class="fa fa-facebook"></i><span class="hidden">Facebook</span></a></li>
                                        <li><a href="#" title="title"><i class="fa fa-twitter"></i><span class="hidden">Twitter</span></a></li>
                                        <li><a href="#" title="title"><i class="fa fa-google-plus"></i><span class="hidden">Google</span></a></li>
                                        <li><a href="#" title="title"><i class="fa fa-instagram"></i><span class="hidden">Instagram</span></a></li>
                                    </ul>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#SubscribeBtn').on('click', function(){
            $('#SubscribeBtn').html('Please wait...');
            if($('#sub_email').val() == ''){
                alert('Please input you email address.');
                return;
            }else{
                $.ajax({
                    type: 'POST',
                    url: 'api/controllers/subscription.php',
                    data: {
                        sub_email : $("#sub_email").val()
                    },
                    cache: false,
                    dataType: 'text',
                    success: function (response) {
                        $('.subInfo').html('<span class="alert alert-danger>'+response+'</span>');
                        setTimeout(function () {
                            $('.popup-close').click();
                            alert("You have successfully subscribe to our newsletter, enjoy your stay on OJARH.com!")
                        }, 3000);
                    }
                });
                event.preventDefault();
            }
        });
    });
</script>
