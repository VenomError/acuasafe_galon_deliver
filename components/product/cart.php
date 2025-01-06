<?php

// remove cart action
if (request()->remove) {
    unset($_SESSION['cart'][request()->product_id]);
    return redirect('/cart');
}

// update cart action
if (request()->update) {

    foreach ($_GET['cart'] as $id => $value) {
        $_SESSION['cart'][$id]['quantity'] = $value;
    }
    return redirect('/cart');
}
if (request()->checkout) {

    if (!is_null(session('cart'))) {

        foreach ($_GET['cart'] as $id => $value) {
            $_SESSION['cart'][$id]['quantity'] = $value;
        }
        return redirect('/checkout');
    } else {
        set_session('warning', 'tidak ada product dalam cart');
        return redirect_back();
    }
}

?>
<form  method="get">
    <section class="cart-section">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 table-column">
                    <div class="table-outer">
                        <table class="cart-table">
                            <thead class="cart-header">
                                <tr>
                                    <th>&nbsp;</th>
                                    <th class="prod-column">Product Name</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th class="price">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (session('cart') ?? [] as $cart) : ?>
                                    <tr>
                                        <td colspan="4" class="prod-column">
                                            <div class="column-box">
                                                <form action="" method="get">
                                                    <input type="hidden" name="product_id" value="<?= $cart['id'] ?>">
                                                    <button type="submit" name="remove" value="<?= true ?>" class="remove-btn">
                                                        <i class="fal fa-times"></i>
                                                    </button>
                                                </form>
                                                <div class="prod-thumb">
                                                    <img src="<?= $cart['image'] ?>" alt="" width="100px">
                                                </div>
                                                <div class="prod-title">
                                                    <?= ucwords($cart['name']) ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="price">Rp <?= $cart['price'] ?></td>

                                        <td class="qty">
                                            <div class="item-quantity">
                                                <input class="quantity-spinner" type="text" value="<?= $cart['quantity'] ?>" name="cart[<?= $cart['id'] ?>]">
                                            </div>
                                        </td>
                                        <td class="sub-total">Rp <?= number_format(toFloat($cart['price']) * $cart['quantity'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="othre-content clearfix">
                <div class="update-btn pull-right">
                    <button type="submit" name="update" value="<?= true ?>" class="theme-btn btn-two">Update Cart</button>
                </div>
            </div>
            <div class="cart-total">
                <div class="row">
                    <div class="col-xl-5 col-lg-12 col-md-12 offset-xl-7 cart-column">
                        <div class="total-cart-box clearfix">
                            <h6>Total</h6>
                            <ul class="list clearfix">
                                <?php
                                $total = 0;
                                foreach (session('cart') ?? [] as $cart) {
                                    $total += $cart['quantity'] * toFloat($cart['price']);
                                }
                                ?>
                                <li>Order Total:<span>Rp <?= number_format($total, 2) ?></span></li>
                            </ul>
                            <button type="submit" name="checkout" value="<?= $true ?>" class="theme-btn btn-one">Proceed to Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>