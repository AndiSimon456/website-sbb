<?php 
//untuk outputnya

include_once('koneksi.php');
$result = mysqli_query($koneksi, "SELECT * FROM nama_tabel(atribut tablenya) value ('$namenya','$nameyanglain')");

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach ($data as $row){
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        '.$row['namaAtributnya'].'
    </body>
    </html>
    ';
}

?>

<?php 
if (isset($_POST['submit'])){
    //ambil data dari form

    $data1 = $_POST['data1'];
    $data2 = $_POST['data2'];

    //untuk ambil foto dari form
    $foto = $_FILES['foto']['name'];
    $source =$_FILES['foto']['tmp_name'];
    $folder = '.alamat/gambar/disimpan/'. $foto;

    if(move_uploaded_file($source, $folder)){
        include_once('koneksi.php');
        $result= mysqli_query($koneksi, "SELECT * FROM namaTable(atribut tablenya)value('$variabelnya', '$variabelnyalagi')");

        if ($result){
            echo 'behasil ditambahkan';
        } else {
            echo 'tidak berhasil ditambahkan';
        }
    } else {
        echo 'gagal ditambahkan data';
    }
}

?>
