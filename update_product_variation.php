<?php

$product_id = $_POST["update_id"];
$variation_id = $_POST["update_variation_id"];
$prezzo = $_POST["update_prezzo"];
$giacenza = $_POST["update_giacenza"];
// Specifica i dati dell'API di WooCommerce
$url = 'https://servizi.wpschool.it/wp-json/wc/v3/products/'. $product_id . '/variations/' . $variation_id;
$username = 'ck_fe204273ad276fc9c7a5e36ad96765b26bbce88b';
$password = 'cs_1ceae7502d5becd86f21d13c215d97f49d8989ff';

$data = array("id" => $id, "regular_price" => $prezzo, "stock_quantity" => $giacenza);
// Crea un'istanza di cURL
$ch = curl_init();

// Imposta le opzioni di cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));

// Esegui la chiamata API
$response = curl_exec($ch);

// Gestisci la risposta dell'API
if ($response === false) {
    $error = curl_error($ch);
    // Gestisci l'errore
} else {
    $products = json_decode($response);
    header("Location: https://wpschool.it/gestionalewoo/calzolari/prodotti.php");
}
// Chiudi la connessione cURL
curl_close($ch);
