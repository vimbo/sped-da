<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../../bootstrap.php';

use NFePHP\DA\CTe\Dacte;

$xml = file_get_contents(__DIR__ . '/fixtures/cte_hom_com_prot.xml');
$logo = 'data://text/plain;base64,' . base64_encode(file_get_contents('../images/logo.jpg'));

try {
    $dacte = new Dacte($xml);
    $dacte->debugMode(true);
    $dacte->creditsIntegratorFooter('WEBNFe Sistemas - http://www.webenf.com.br');
    $dacte->monta($logo);
    $pdf = $dacte->render();
    //o pdf porde ser exibido como view no browser
    //salvo em arquivo
    //ou setado para download forçado no browser 
    //ou ainda gravado na base de dados
    header('Content-Type: application/pdf');
    echo $pdf;
} catch (InvalidArgumentException $e) {
    echo "Ocorreu um erro durante o processamento :" . $e->getMessage();
}    
