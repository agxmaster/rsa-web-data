<?php
error_reporting(1);
ini_set('display_errors','on');

include 'vendor/autoload.php';
use \ParagonIE\EasyRSA\KeyPair;
use \ParagonIE\EasyRSA\EasyRSA;
//$keyPair = KeyPair::generateKeyPair(4096);
//$secretKey = $keyPair->getPrivateKey();
//$publicKey = $keyPair->getPublicKey();
//echo $publicKey->getKey();
//echo "<br>";
//echo $secretKey->getKey();exit;
$pukey = '-----BEGIN PUBLIC KEY----- MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAw6pW3DLoa9AzGpcu+DfD Vjg+4Fj2kOf6i1Z4RoYHbSvQYiRFb5opCr9+pOBnINUihxanhpKA6W7DRUvkjD5C 3GmCuLflHTL/jzltDXs+SR/lh+PyAB7acMvnk9tqOPUQQmhDfbmK/4dM3Dtjm4vr d69EVFMjmryExPXhYcQQzeF3tNvlxFUZFYqbV3aD3v7PmaQBNt7h0DxrrfNyRAGY X6EDvlwLnxCoC/MtHQkhPuVL92nsAEmWWtLYpsYXsIg/Ps2FS3HD2jahr7KNF10B syrK+dfIsv6NKKmttCDm7DXpVrQaJCRPbhyhjYzX2qtFh0apbIMi7g+n4ZZBQFlt FvalnvKW3N9E1cHID/REEIabyd5/zdTxfkClnImXHFrHzbG4Pq8pNUIr/9TDa+gB gv5Z1n23au53xds5K5N190oProE39i9BSE7bGU93iySOWRj9YzYWGZ57Qei/da5a bFUNwqRJrmZF9CgUjx3+TqEDW5WNufZiaNRbD7uvoa4LxqE5PoDFedEIg6HpOwt/ IXIJPbDWVyqXbB7T+Q9AhSXhU+FqeS3oUyUGbvrZQiJ+Fw2xaEPZ5HB1OXmx6oUH i0pZwlf0vuH7drlPDFen/bSzt+TzcQnedtgpZem63q7MMaW9yKPjTezY9ulZPQ1M bV/eQHHbKyPFh117XSzqK0MCAwEAAQ== -----END PUBLIC KEY-----';
$prkey = '-----BEGIN RSA PRIVATE KEY----- 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 -----END RSA PRIVATE KEY-';
$publicKey = new \ParagonIE\EasyRSA\PublicKey($pukey);
$secretKey = new  \ParagonIE\EasyRSA\PrivateKey($prkey);

$_POST = json_encode([
    'a' => 1,
    'b' => [
        'c' => 2
    ]
]);
$ciphertext = EasyRSA::encrypt($_POST, $publicKey);
$plaintext = EasyRSA::decrypt($ciphertext, $secretKey);
$signature = EasyRSA::sign($_POST, $secretKey);

if (EasyRSA::verify($_POST, $signature, $publicKey)) {
    // Signature is valid!
    echo "success";
}
echo $signature;
echo "<br>";
print_r(json_decode($plaintext,true));exit;