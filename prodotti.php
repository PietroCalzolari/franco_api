<?php
session_start();
if($_SESSION["islogged"] == false)
{
    header("location: https://wpschool.it/prova190423/PietroCalzolari/login.php");
}
include('./phpqrcode/qrlib.php');
// Specifica i dati dell'API di WooCommerce
$url = 'https://servizi.wpschool.it/wp-json/wc/v3/products';
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
    $products = json_decode($response);
}
// Chiudi la connessione cURL
curl_close($ch);
$title = 'Prodotti';
require_once './liblayout.php';
$content_filter[] = 'adjust_markup';

?>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Sku</th>
            <th scope="col">Name</th>
            <th scope="col">Descrizione</th>
            <th scope="col">Prezzo</th>
            <th scope="col">Stock</th>
            <th scope="col">Operazioni</th>
            <th scope="col">QrCode</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($products as $product) {
        ?>

            <tr>
                <th scope="row"><?php echo $product->id; ?></th>
                <td><?php echo $product->sku; ?></td>
                <td><?php echo $product->name; ?></td>
                <td><?php echo $product->description; ?></td>
                <td>&euro;<?php echo $product->price; ?></td>
                <td><?php echo $product->stock_quantity; ?></td>
                <td>
                    <form method="POST" action="./generate_pdf.php">
                        <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                        <button type="submit" class="delete text-danger" title="Create PDF" data-toggle="tooltip"><i class="material-icons">picture_as_pdf</i></button>
                    </form>
                </td>
                <?php
                $sku = $product->sku; // remember to sanitize that - it is user input!
                $new_sku = str_replace(' ', '', $sku);
                $paramimg = $new_sku . '.png';
                QRcode::png('./qr_code/' . $new_sku, $paramimg, 1, 2);
                // output del QR Code per il browser
                echo '<td><img src="' . $paramimg . '"></td>';
                ?>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>