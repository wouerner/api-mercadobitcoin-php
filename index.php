<?php
require __DIR__ . '/vendor/autoload.php';

use Wouerner\MercadoBitcoin\Api as MercadoBitcoin;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$id = getenv('ID');
$secredo = getenv('SECREDO');

$mcb = new MercadoBitcoin($id, $secredo);

$info = $mcb->getAccountInfo();

$balances = $info['response_data']['balance'];

foreach($balances as $key => $balance){
    $aux[$key]['total'] = (float)$balance['total'];
    if($key != 'brl'){
        $aux[$key]['ticker'] = (float)$mcb->ticker(strtoupper($key))['ticker']['last'];
    }
}

foreach($aux as $key => $balance){
    if($key != 'brl'){
        $aux[$key]['valor'] = (float)($balance['total'] * $balance['ticker']);
    }
}

$valorTotal = array_sum(array_column($aux, 'valor')) + $aux['brl']['total'];

$aux['valorTotal'] = ($valorTotal);

header('Content-type: application/json');
echo json_encode($aux);
