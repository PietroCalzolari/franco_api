<?php
session_start();
if($_SESSION["islogged"] == false)
{
    header("location: https://wpschool.it/prova190423/PietroCalzolari/login.php");

}
$title = 'Home';
require_once './liblayout.php';
$content_filter[] = 'adjust_markup';
?>

<div class="container">
    <h2>HOME</h2>
    <p>Benvenuti nel nostro sito di vendita di prodotti hardware per PC! Siamo entusiasti di potervi offrire una vasta gamma di prodotti per migliorare le prestazioni del vostro computer, sia che siate appassionati di giochi, professionisti del settore o semplici utenti alla ricerca di un aggiornamento.</p>

    <p>
        Qui di seguito troverete una panoramica dei prodotti che offriamo e delle loro caratteristiche principali.
    </p>
    <p>
        Processori:
    </p>
    <p>
        Il processore è il cuore del vostro computer e determina in larga misura le sue prestazioni. Offriamo una vasta gamma di processori dalle prestazioni elevate, tra cui i più recenti modelli di Intel e AMD.
    </p>
    <p>
        Schede Madri:
    </p>
    <p>
        La scheda madre è il componente principale del computer, che connette tutti gli altri componenti tra loro. Offriamo una vasta gamma di schede madri compatibili con i più recenti processori Intel e AMD.
    </p>
    <p>
        Schede Video:
    </p>
    <p>
        Se siete appassionati di giochi o lavorate con grafica ad alta risoluzione, una scheda video dedicata è essenziale. Offriamo una vasta gamma di schede video di alta qualità, tra cui quelle di Nvidia e AMD.
    </p>
    <p>
        Speriamo che queste informazioni vi siano state utili per trovare i prodotti hardware di cui avete bisogno per il vostro computer. Inoltre, vi invitiamo a contattarci se avete domande o se avete bisogno di assistenza nell’acquisto dei nostri prodotti. Grazie per averci scelto!

    </p>
</div>