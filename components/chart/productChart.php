  <?php

    $order = new \App\Models\OrderItem();
    $product = new \App\Models\Produk();

    $data = [
        'labels' => [],
        'data' => [],
    ];
    foreach ($product->all() as $item) {
        $data['labels'][] = $item['name'];
        $data['data'][] = $order->getSumQuantityByProduct($item['id']);
    }

    $labels = json_encode($data['labels']);
    $dataset = json_encode($data['data']);
    ?>


  <canvas id="productChart"></canvas>
  <script>
      $(document).ready(function() {

          const ctx = document.getElementById('productChart');

          new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: <?= $labels ?>,
                  datasets: [{
                      label: 'Order Quantity',
                      data: <?= $dataset ?>,
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      y: {
                          beginAtZero: true
                      }
                  }
              }
          });

      });
  </script>