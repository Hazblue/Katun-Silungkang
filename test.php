<?php
//$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
//
//function encryptthis($data, $key) {
//    $encryption_key = base64_decode($key);
//    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
//    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
//    return base64_encode($encrypted . '::' . $iv);
//}
function decRSA($C) {
    $data[0] = 1;
    for($i = 0; $i <= 7; $i++) {
        $rest[$i] = pow($C,1)%123;
        if($data[$i]>123) {
            $data[$i+1] = $data[$i]*$rest[$i]%123;
        }
        else {
            $data[$i+1] = $data[$i]*$rest[$i];
        }
    }
    $get = $data[7]%123;
    return $get;
}

function encRSA($M) {
    $data[0] = 1;
    for($i = 0; $i <= 23; $i++) {
        $rest[$i] = pow($M,1)%123;
        if($data[$i]>123) {
            $data[$i+1] = $data[$i]*$rest[$i]%123;
        }
        else {
            $data[$i+1] = $data[$i]*$rest[$i];
        }
    }
    $get = $data[23]%123;
//    echo sizeof($data).'<br>';
//    foreach($data as $elemen){
//        echo $elemen.PHP_EOL;
//    }
    return $get;
}

//$sentence = 'The quick brown fox jumps over the lazy dog';
$sentence = 'BRI BNI';
$enc = "";
$dec = "";
//encrypt
for($i = 0; $i < strlen($sentence); $i++) {
    $m = ord($sentence[$i]);
    if($m <= 123) {
        $enc = $enc.chr(encRSA($m));
    }
    else {
        $enc = $enc.$sentence[$i];
    }
}

//decrypt
for($i = 0; $i < strlen($sentence); $i++) {
    $m = ord($enc[$i]);
    if($m <= 123) {
        $dec = $dec.chr(decRSA($m));
    }
    else {
        $dec = $dec.$enc[$i];
    }
}

// $message : pesan yang akan dienkripsi
function encrypt($message, $enc = ""){
    for($i = 0; $i < strlen($message); $i++) {
        $m = ord($message[$i]);
        if($m <= 123) {
            $enc = $enc.chr(encRSA($m));
        }
        else {
            $enc = $enc.$message[$i];
        }
    }
    return $enc;
}

//$enc : pesan yang akan didekripsi
function decrypt($enc, $dec = ""){
    for($i = 0; $i < strlen($enc); $i++) {
        $m = ord($enc[$i]);
        if($m <= 123) {
            $dec = $dec.chr(decRSA($m));
        }
        else {
            $dec = $dec.$enc[$i];
        }
    }
    return $dec;
}

//$b = encRSA(99);
//$c = decRSA($b);
//echo $b.'<br/>'.$c;
//echo '<br>'.$enc.'<br>'.$dec;
//$coba = strlen('hitung');
//$kata = "hitung";
//$u = 1;
//$print = $kata[$u];
//echo '<br>'.$print;
//echo '<br>'.$coba;