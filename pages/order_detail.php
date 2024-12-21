<?php

use App\Models\OrderItem;

if (is_null(request()->order_id)) {
    redirect("/");
}
$orderItem = new OrderItem();
$data = $orderItem->getByOrder(request()->order_id);
$order =  (new \App\Models\Order())->find(request()->order_id);
?>

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
                            <?php foreach ($data ?? [] as $item) : ?>
                                <tr>
                                    <td colspan="4" class="prod-column">
                                        <div class="column-box">
                                            <div class="prod-thumb">
                                                <img src="<?= $item['product_image'] ?>" alt="" width="100px">
                                            </div>
                                            <div class="prod-title">
                                                <?= ucwords($item['product_name']) ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price"><?= RPformat($item['product_price']) ?></td>

                                    <td class="text-center text-dark">
                                        <?= $item['quantity'] ?>
                                    </td>
                                    <td class="sub-total">Rp <?= number_format(toFloat($item['amount']) * $item['quantity'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="othre-content clearfix">
            <div class="update-btn pull-right">
            </div>
        </div>
        <div class="cart-total">
            <div class="row">
                <div class="col-xl-5 col-lg-12 col-md-12 offset-xl-7 cart-column">
                    <div class="total-cart-box clearfix">
                        <h6>Total</h6>
                        <ul class="list clearfix">
                            <li>Order Total:<span><?= RPformat($order->total_amount) ?></span></li>
                        </ul>
                        <?php if ($order->status == 'new') : ?>
                            <div class="text-center">
                                <button type="button" onclick="cancelOrder(<?= $order->id ?>)" class="btn-danger btn  rounded w-100 ">Cancel Order</button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function cancelOrder(id) {

        $.ajax({
            type: "POST",
            url: "/action/order/updateStatus.php",
            data: {
                id: id,
                status: 'cancel'
            },
            dataType: "json",
            success: function(res) {
                if (res.status == 'success') {
                    toastr.success(res.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error(res.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Display a generic error message if available
                toastr.error(jqXHR.responseJSON ? jqXHR.responseJSON.message : 'An error occurred');

                // Log detailed error information to the console for debugging
                console.error('Error Status:', textStatus);
                console.error('Error Thrown:', errorThrown);
                console.error('Response Text:', jqXHR.responseText);
            }
        });

    }
</script>