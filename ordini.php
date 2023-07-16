<?php
// Specifica i dati dell'API di WooCommerce
$url = 'https://servizi.wpschool.it/wp-json/wc/v3/orders?';
$username = 'ck_fe204273ad276fc9c7a5e36ad96765b26bbce88b';
$password = 'cs_1ceae7502d5becd86f21d13c215d97f49d8989ff';


// Crea un'istanza di cURL
$ch = curl_init();

// Imposta le opzioni di cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Esegui la chiamata API
$response = curl_exec($ch);

// Gestisci la risposta dell'API
if ($response === false) {
    $error = curl_error($ch);
    // Gestisci l'errore
} else {
    $orders = json_decode($response);
}
// Chiudi la connessione cURL
curl_close($ch);
$title = 'Ordini';
require_once './liblayout.php';
$content_filter[] = 'adjust_markup';
?>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">Numero Ordine</th>
            <th scope="col">Totale</th>
            <th scope="col">Metodo di pagamento</th>
            <th scope="col">Status</th>
            <th scope="col">Operazioni</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($orders as $order) {
        ?>
            <tr>
                <td scope="row"><?php echo $order->number; ?></td>
                <td><?php echo $order->total; ?></td>
                <td><?php echo $order->payment_method_title; ?></td>
                <td><?php echo $order->status; ?></td>
                <td>
                    <a href="#" class="edit" title="Edit" data-toggle="modal" data-target="#exampleModal[<?php echo $order->id; ?>]"><i class="material-icons">&#xE254;</i></a>
                    <!-- Modal per la modifica-->
                    <div class="modal fade" id="exampleModal[<?php echo $order->id; ?>]" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Aggiorna Ordini</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="./update_order.php" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="update_id" value="<?php echo $order->id; ?>">
                                        <div class="row ml-3">
                                            <label for="price">Stato</label>
                                            <select class="ml-2" name="update_status">
                                                <option value="pending" <?php if($order->status == 'pending') echo "selected"; ?>>Pending</option>
                                                <option value="processing" <?php if($order->status == 'processing') echo "selected"; ?>>Processing</option>
                                                <option value="on-hold" <?php if($order->status == 'on-hold') echo "selected"; ?>>On Hold</option>
                                                <option value="completed" <?php if($order->status == 'completed') echo "selected"; ?>>Completed</option>
                                                <option value="cancelled" <?php if($order->status == 'cancelled') echo "selected"; ?>>Cancelled</option>
                                                <option value="refunded" <?php if($order->status == 'refunded') echo "selected"; ?>>Refunded</option>
                                                <option value="failed" <?php if($order->status == 'failed') echo "selected"; ?>>Failed</option>
                                                <option value="trash" <?php if($order->status == 'trash') echo "selected"; ?>>Trash</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                                        <button type="submit" class="btn btn-primary">Aggiorna</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a class="delete text-danger" title="Delete" data-toggle="tooltip" <?php echo 'href="./delete_order.php?id=' . $order->id . '"' ?>><i class="material-icons">&#xE872;</i></a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>