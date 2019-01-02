<?php
require __DIR__ . '/vendor/autoload.php';

use Wouerner\MercadoBitcoin as MercadoBitcoin;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$id = getenv('ID');
$secredo = getenv('SECREDO');

$mcb = new MercadoBitcoin($id, $secredo);

$info = $mcb->getAccountInfo();
echo "<pre>";
var_dump($info);
