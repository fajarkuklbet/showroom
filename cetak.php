<?php
include("db_conn.php");
?>

<?php
$id = $_GET['id'];

$sql2 = $conn->query("SELECT * FROM formulir WHERE id='" . $id . "' ");
while ($data2 = $sql2->fetch_assoc()) { 
    $username = $data2['username'];
    $nohp = $data2['nohp'];
    $namamotor = $data2['namamotor'];
    $harga = $data2['harga'];
}
$token = "ugGqTJNe!YXV59WcPDja";
$target = $nohp;

$message = "
Dealer Motor 

Nama: $username

No hp: $nohp

Nama Motor: $namamotor


==================================
Terima kasih ";


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
        'target' => $target,
        'message' => $message,
        'countryCode' => '62', //optional   
    ),
    CURLOPT_HTTPHEADER => array(
        "Authorization: $token" //change TOKEN to your actual token
    ),
));
$response = curl_exec($curl);
if (curl_errno($curl)) {
    $error_msg = curl_error($curl);
    // Jika terjadi kesalahan curl, tampilkan pesan kesalahan
    echo $error_msg;
} else {
    // Jika pengiriman pesan berhasil, lakukan redirect
    echo "<script>alert('Berhasil Mengirim Pesan Whatsapp Ke Nomor Pelanggan');window.location.href='dashboard.php';</script>";
    exit; // Pastikan untuk keluar dari skrip setelah melakukan redirect
}
curl_close($curl);