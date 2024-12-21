<?php
$order = new \App\Models\Order();
$new = $order->getCount('new');
$otw = $order->getCount('otw');
$cancel = $order->getCount('cancel');
$completed = $order->getCount('completed');
?>
<canvas id="orderChart"></canvas>

<script>
    $(document).ready(function() {
        const ctx = document.getElementById('orderChart');

        const data = {
            labels: [
                'New',
                'OTW',
                'Cancel',
                'Completed'
            ],
            datasets: [{
                label: 'Order Count',
                data: [<?= $new ?>, <?= $otw ?>, <?= $cancel ?>, <?= $completed ?>],
                backgroundColor: [
                    'rgb(255, 205, 86)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)',
                    'rgb(0, 175, 73)'
                ],
                hoverOffset: 4
            }]
        };
        const config = {
            type: 'doughnut',
            data: data,
            options: {
                plugins: {
                    legend: {
                        display: false // Disables the legend
                    }
                }
            }
        };


        new Chart(ctx, config);

    });
</script>