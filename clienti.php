<?php
// Specifica i dati dell'API di WooCommerce
$url = 'https://servizi.wpschool.it/wp-json/wc/v3/customers';
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
    $clients = json_decode($response);
}
// Chiudi la connessione cURL
curl_close($ch);
$title = 'Clienti';
require_once './liblayout.php';
$content_filter[] = 'adjust_markup';
?>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Cognome</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($clients as $client) {
        ?>
            <tr>
                <th scope="row"><?php echo $client->id; ?></th>
                <td><?php echo $client->first_name; ?></td>
                <td><?php echo $client->last_name; ?></td>
                <td><?php echo $client->email; ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>