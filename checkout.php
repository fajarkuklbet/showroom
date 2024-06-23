<?php

if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $whatsapp = $_POST["whatsapp"];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'target' => $whatsapp,
            'message' => "Terimakasih $nama sudah order.",
            'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: dy4AgYCNVtqJYryXeqyh' //change TOKEN to your actual token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if (isset($response)) {
        $result = json_decode($response, true);
        $alert = $result["status"] ? $result["detail"] : $result["reason"]; ?>
        <script>
            alert("<?= $alert ?>")
        </script>
    <?php }
    ?>

    <div style="width: 100%;max-width: 600px;margin: auto;border-radius: 10px;box-shadow: 0px 0px 10px -7px;padding: 20px;">
        <h2 style="
    text-align: center;
">Form Pembelian</h2>
        <form action="" method="POST">
            <div style="
    width: 100%;
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
">
                <label for="nama" style="
    margin-bottom: 5px;
">Nama</label>
                <input type="text" name="nama" style="
    border: none;
    border-bottom: 2px groove;
    padding: 8px;
">
            </div>
            <div style="
    width: 100%;
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
">
                <label for="alamat" style="
    margin-bottom: 5px;
">Alamat</label>
                <textarea name="alamat" rows="5" style="
    border: none;
    border-bottom: 2px groove;
    padding: 8px;
"></textarea>
            </div>
            <div style="width: 100%;display: flex;flex-direction: column;margin-bottom: 20px;">
                <label for="whatsapp" style="
    margin-bottom: 5px;
">Whatsapp</label>
                <input type="text" name="whatsapp" style="
    border: none;
    border-bottom: 2px groove;
    padding: 8px;
">
            </div>
            <div style="
    display: flex;
    justify-content: end;
"><button type="submit" name="submit" style="
    background: lightseagreen;
    padding: 12px 48px;
    border: none;
    color: white;
    border-radius: 10px;
    cursor: pointer;
    margin: 20px 0;
">Submit</button></div>
        </form>
    </div>
</body>

</html>











