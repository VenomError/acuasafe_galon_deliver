<section class="shop-section centred">
    <div class="auto-container">
        <div class="sec-title">
            <h2>Order History</h2>
        </div>
        <div class="row clearfix  ">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-centered  nowrap" id="order-history-datatable">
                        <thead class="table-light">
                            <tr>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Distance</th>
                                <th class="all">Total Amount</th>
                                <th>Payment Method</th>
                                <th>Confirm Status</th>
                                <th style="width: 85px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = new \App\Models\Order();
                            $costumer_id = auth()->id ?? null;
                            $data = $orders->getByCostumer($costumer_id);
                            ?>
                            <?php foreach ($data as $order) : ?>
                                <tr>
                                    <td><?= dateFormat($order['created_at']) ?></td>
                                    <td><span class="text-<?= orderStatusColor($order['status']) ?>"><?= $order['status'] ?></span></td>
                                    <td><?= $order['distance'] ?> KM</td>
                                    <td><?= RPformat($order['total_amount']) ?></td>
                                    <td><?= $order['payment_method'] ?></td>
                                    <td>
                                        <?php if ($order['is_confirm']) : ?>
                                            <button class="btn btn-sm btn-success">Confirmed</button>
                                        <?php else : ?>
                                            <button class="btn btn-sm btn-danger">Not Confirm</button>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-primary text-white" href="/order_detail?order_id=<?= $order['id'] ?>">
                                                view item
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>