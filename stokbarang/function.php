<?php
session_start();
$conn = mysqli_connect("localhost","root","","stokbarang");

//menambah barang
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];

    $addtotable = mysqli_query($conn, "insert into stok (namabarang, deskripsi, stok)values('$namabarang','$deskripsi','$stok')");
    if($addtotable){
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location:index.php');
    }

};

//menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $supplier = $_POST['supplier'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "select * from stok where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];
    $tambahkanstoksekarangdenganquantity = $stoksekarang+$qty;

    $addtomasuk = mysqli_query($conn,"insert into masuk (idbarang, keterangan, qty)values('$barangnya','$supplier','$qty')");
    $updatestokmasuk = mysqli_query($conn, "update stok set stok='$tambahkanstoksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtomasuk&&$updatestokmasuk){
        header('location:masuk.php');
    } else {
        echo 'gagal';
        header('location:masuk.php');
    }
}

//menambah barang keluar
if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $customer = $_POST['customer'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "select * from stok where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];

    if($stoksekarang >= $qty){
    //kalau barangnya cukup
    $tambahkanstoksekarangdenganquantity = $stoksekarang-$qty;

    $addtokeluar = mysqli_query($conn,"insert into keluar (idbarang, customer, qty)values('$barangnya','$customer','$qty')");
    $updatestokmasuk = mysqli_query($conn, "update stok set stok='$tambahkanstoksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtokeluar&&$updatestokmasuk){
        header('location:keluar.php');
    } else {
        echo 'gagal';
        header('location:keluar.php');
        }
    } else {
        //kalau barang tidak cukup
        echo '
       <script>
       alert("Stock saat ini tidak mencukupi");
       window.location.href="keluar.php";
       </script>
        ';
    }
}

//update barang stok
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];

    $update = mysqli_query($conn, "update stok set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang = '$idb'");
    if($update){
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location:index.php');
    }
}


//hapus barang dari stok
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "delete from stok where idbarang='$idb'");
    if($hapus){
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location:index.php');
    }
}

//edit data barang masuk
if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $deskripsi = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstok = mysqli_query($conn, "select * from stok where idbarang='$idb'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stokskrg = $stoknya['stok']; 

    $qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty-$qtyskrg;
        $kurangin = $stokskrg + $selisih;
        $kurangistoknya = mysqli_query($conn, "update stok set stok='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");
        if($kurangistoknya&&$updatenya){
            header('location:masuk.php');
        } else {
            echo 'gagal';
            header('location:masuk.php');
        }

    } else {
        $selisih = $qtyskrg-$qty;
        $kurangin = $stokskrg - $selisih;
        $kurangistoknya = mysqli_query($conn, "update stok set stok='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");
        if($kurangistoknya&&$updatenya){
            header('location:masuk.php');
        } else {
            echo 'gagal';
            header('location:masuk.php');
        }
    }
}

//menghapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

$getdatastok = mysqli_query($conn,"select * from stok where idbarang='$idb'");
$data = mysqli_fetch_array($getdatastok);
$stok = $data['stok'];

$selisih = $stok-$qty;

$update = mysqli_query($conn, "update stok set stok='$selisih' where idbarang='$idb'");
$hapusdata = mysqli_query($conn, "delete from masuk  where idmasuk='$idm'");

if($update&&$hapusdata){
    header('localtion.masuk.php');
} else {
    header('localtion.masuk.php');
    }
}

//edit data keluar
if(isset($_POST['updatebarangkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $customer = $_POST['customer'];
    $qty = $_POST['qty'];

    $lihatstok = mysqli_query($conn, "select * from stok where idbarang='$idb'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stokskrg = $stoknya['stok']; 

    $qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty-$qtyskrg;
        $kurangin = $stokskrg - $selisih;
        $kurangistoknya = mysqli_query($conn, "update stok set stok='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', customer='$customer' where idkeluar='$idk'");
        if($kurangistoknya&&$updatenya){
            header('location:keluar.php');
        } else {
            echo 'gagal';
            header('location:keluar.php');
        }

    } else {
        $selisih = $qtyskrg-$qty;
        $kurangin = $stokskrg + $selisih;
        $kurangistoknya = mysqli_query($conn, "update stok set stok='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', customer='$customer' where idkeluar='$idk'");
        if($kurangistoknya&&$updatenya){
            header('location:keluar.php');
        } else {
            echo 'gagal';
            header('location:keluar.php');
        }
    }
}

//menghapus barang keluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

$getdatastok = mysqli_query($conn,"select * from stok where idbarang='$idb'");
$data = mysqli_fetch_array($getdatastok);
$stok = $data['stok'];

$selisih = $stok+$qty;

$update = mysqli_query($conn, "update stok set stok='$selisih' where idbarang='$idb'");
$hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

if($update&&$hapusdata){
    header('localtion.keluar.php');
} else {
    header('localtion.keluar.php');
    }
}

//menambah admin
if(isset($_POST['addadmin'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $queryinsert = mysqli_query($conn, "insert into login (email, password) values ('$email','$password')");

    if($queryinsert){
        //if berhasil
        header('location:admin.php');

    } else {
        //kalau gagal insert ke database
        header('location:admin.php');
    }
}



//edit data admin
if(isset($_POST['updateadmin'])){
    $emailbaru = $_POST['emailadmin'];
    $passwordbaru = $_POST['passwordbaru'];
    $idnya = $_POST['id'];

    $queryupdate = mysqli_query($conn, "update login set email='$emailbaru', password='$passwordbaru' where iduser='$idnya'");

    if($queryupdate){
        header('location:admin.php');

    } else {
        header('location:admin.php');
    }
}

//hapus admin
if(isset($_POST['hapusadmin'])){
    $id = $_POST['id'];

    $querydelete = mysqli_query($conn, "delete from login where iduser='$id'");

    if($querydelete){
        header('location:admin.php');
    } else {
        header('location:admin.php');
    }
}

?>