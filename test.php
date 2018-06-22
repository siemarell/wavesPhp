<?php
require_once('vendor/autoload.php');
use kornrunner\Keccak;
$base58 = new StephenHill\Base58();

function hex2str($hex) {
    $str = '';
    for($i=0;$i<strlen($hex);$i+=2) $str .= chr(hexdec(substr($hex,$i,2)));
    return $str;
}

function accountSeedFromSeed($seed){

    //$encodedSeed = $base58->encode($seed);

    $nonce = array(0,0,0,0);
    $nonceAndSeed = implode(array_map("chr", $nonce)) . $seed;
    //$encodedNonceAndSeed = $base58->encode($nonceAndSeed);

    $blake = blake2($nonceAndSeed,32,null,true);
    //$encodedBlake2 = $base58->encode($blake);

    $keccak = hex2str(Keccak::hash($blake, 256));
    //$encodedKeccak = $base58->encode($keccak);
    return $keccak;
}
$seed = 'manage manual recall harvest series desert melt police rose hollow moral pledge kitten position add';


print $base58->encode(accountSeedFromSeed($seed));
?>
