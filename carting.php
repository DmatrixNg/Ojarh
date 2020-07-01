<?php require_once 'inc/header.php'; ?>
<?php if(!isset($_SESSION['userid']))
  header("Location: ".BASE_URL."signin.php?redirect=".$_SERVER['REQUEST_URI']);
?>
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
            <span>Your Checkout Page</span>
          </li>
        </ol>
      </nav>
    </div>
  </div>
</section>


<div id="shopify-section-cart-template" class="shopify-section">
<div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
    <div class="page-carts">
      <h1 class="title-cart">Cart List</h1>
      <?php if(isset($_GET['info'])){ echo '<span class="pull-right">'.$_GET['info'].'</span>'; } ?>
    </div>
    <div novalidate class="cart">
      <!-- <table>
        <thead class="cart__row cart__header">
          <th class="text-left" colspan="2">Product</th>
          <th>Price</th>
          <th class="text-left">Quantity</th>
          <th class="text-left">Total</th>
        </thead>
        <tbody> -->

            <form action="<?= BASE_URL ?>api/controllers/checkout.php" method="POST">
                <?php $userClass->process_checkout2(); ?>
            </form>

            <!-- <tr class="cart__row border-bottom line1 cart-flex border-top">
              <td class="cart__image-wrapper cart-flex-item">
                <a href="#">
                  <img class="cart__image" src="//cdn.shopify.com/s/files/1/0051/3130/4995/products/1_50x50@2x.png?v=1569379414" alt="Turkey venison briske">
                </a>
              </td>
              <td class="cart__meta small--text-left cart-flex-item">
                <div class="list-view-item__title">
                  <a href="#">
                    Turkey venison briske
                  </a>
                </div>
              </td>
              <td class="cart__price-wrapper cart-flex-item">
                <span class=money>$45.00</span>
              </td>
              <td class="cart__update-wrapper cart-flex-item text-left">
                <div class="cart__qty">
                  <label class="cart__qty-label">Quantity</label>
                  <input class="cart__qty-input" type="number" name="updates[]" id="updates_15553234534435:96513f41c8ee964c5cbf57fca7642020" value="1" min="0" pattern="[0-9]*">
                </div>
                <a href="#" class="btn btn--small btn--secondary cart__remove medium-up--hide">Remove</a>
                <input type="submit" name="update" class="btn btn--small cart__update medium-up--hide" value="Update">
              </td>
              <td class="text-left small--hide">
                <div>
                  <span class=money>$45.00</span>
                </div>
              </td>
            </tr> -->
        <!-- </tbody>
      </table> -->
      <!-- <footer class="cart__footer">
        <div class="row">
          <div class="col-sm-6 col-12 medium-up--one-half cart-note">
            <div class="cart_border">
              <label for="CartSpecialInstructions" class="cart-note__label small--text-center"><span>Note</span>Add a note to your order</label>
              <textarea rows="6" name="note" id="CartSpecialInstructions" class="cart-note__input"></textarea>
            </div>
          </div>
          <div class="col-sm-6 col-12 text-right small--text-center medium-up--one-half">
            <div class="cart_border">
              <div>
                <span class="cart__subtotal-title"><span id="bk-cart-subtotal-label">Subtotal</span></span>
                <span class="cart__subtotal"><span id="bk-cart-subtotal-price"><span class=money>$218.00</span></span></span>
              </div>
              <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div>
              <a href="collections/all" class="btn btn--secondary cart__update cart__continue--large small--hide" >Continue shopping</a>
              <input type="submit" name="update" class="btn btn--secondary cart__update cart__update--large small--hide" value="Update">
              <input type="submit" name="checkout" class="btn btn--small-wide" value="Check out">
            </div>
          </div>
        </div>
      </footer> -->
    </div>

</div>


</div>


        </div>
<?php require_once 'inc/footer.php'; ?>
