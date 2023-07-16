<?php
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
include('header.php');
?>


<div class=" container table-responsive pt-3">
    <div class="table-wrapper">
        <?php
        if ($response === false) {
            $error = curl_error($ch);
            // Gestisci l'errore
        } else {
            $products = json_decode($response);
            //crea la tabella HTML
        ?>
            <table id="my-table" class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Taglia</th>
                        <th scope="col">Magazzino</th>
                        <th>Azioni</th>
                        <th>QrCode</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) { ?>
                        <tr>
                            <?php
                            if ($product->type == "variable") {
                                $name = $product->name;
                                $a = $product->id;

                                $url = 'https://servizi.wpschool.it/wp-json/wc/v3/products/' . $a . '/variations';
                                $username = 'ck_fe204273ad276fc9c7a5e36ad96765b26bbce88b';
                                $password = 'cs_1ceae7502d5becd86f21d13c215d97f49d8989ff';

                                $chi = curl_init();

                                curl_setopt($chi, CURLOPT_URL, $url);
                                curl_setopt($chi, CURLOPT_USERPWD, $username . ':' . $password);
                                curl_setopt($chi, CURLOPT_RETURNTRANSFER, true);


                                $response = curl_exec($chi);
                                $products = json_decode($response);

                                foreach ($products as $product) {
                            ?>
                                    <td><?php echo $product->id; ?></td>
                                    <td><?php echo $product->sku; ?></td>
                                    <td><?php echo $product->name; ?></td>
                                    <td><?php echo $product->price; ?></td>
                                    <td><?php echo $product->attributes[0]->option ?></td>
                                    <td><?php echo $product->stock_quantity; ?></td>
                                    <td>
                                        <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                        <a <?php echo 'href="./delete_product.php?id=' . $product->id . '"' ?> class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                                    </td>
                                    <td>
                                        <?php
                                        $sku = $product->sku;
                                        $newsku = str_replace(' ', '', $sku);
                                        $qrimage = $product->sku . ".png";;
                                        QRCODE::png("./products_qr/" . $newsku, $qrimage, 1, 2);
                                        ?>
                                        <img src="<?php echo $qrimage ?>" />
                                    </td>
                        </tr>
                    <?php
                                }
                            } else {
                    ?>
                    <tr>
                        <td><?php echo $product->id; ?></td>
                        <td><?php echo $product->sku; ?></td>
                        <td><?php echo $product->name; ?></td>
                        <td><?php echo $product->price; ?></td>
                        <td><?php echo $product->attributes->option ?></td>
                        <td><?php echo $product->stock_quantity; ?></td>
                        <td>
                            <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a <?php echo 'href="./delete_product.php?id=' . $product->id . '"' ?> class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                        <td>
                            <?php
                                $sku = $product->sku;
                                $newsku = str_replace(' ', '', $sku);
                                $qrimage = $newsku . ".png";
                                QRCODE::png("./products_qr/" . $newsku, $qrimage, 1, 2);
                            ?>
                            <img src="<?php echo $qrimage ?>" />
                        </td>
                    </tr>
        <?php
                            }
                        }
                    }
                    curl_close($ch);

        ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <div id="pagination"></div>
                        </td>
                    </tr>
                </tfoot>
            </table>
    </div>
</div>

<?php
include('footer.php');
?>