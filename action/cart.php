<?php

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
