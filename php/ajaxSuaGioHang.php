<?php 
    include("DB.php");
    mysqli_query($connect, "SET NAMES 'utf8'");

    $idsp = $_GET['idsp'];
    $idGH = $_GET['idGH'];
    $Gia = $_GET['Gia'];

    $check=$_GET['check'];
if ($check==0){
     $query = mysqli_query($connect,"DELETE FROM `thongtingiohang` WHERE idsp='$idsp' and idGiohang = '$idGH'");
    $queryx = mysqli_query($connect,"SELECT * from giohang where id='$idGH'");
    $row = mysqli_fetch_array($queryx);

    $tienconlai = $row['Tongtien'] - $Gia;
    

    if ($tienconlai > 0){
        $queryk = mysqli_query($connect,"UPDATE `giohang` SET  `Tongtien` = '$tienconlai' WHERE `giohang`.`id` = '$idGH';");
        echo "$tienconlai";
    }
    else{
        $queryk = mysqli_query($connect,"DELETE FROM giohang where id = '$idGH'");
        echo "0";
    }
}
else{
    $query = mysqli_query($connect,"SELECT * from `thongtingiohang`  WHERE `thongtingiohang`.`idGiohang` = '$idGH' and idsp = '$idsp' ;");
    
    $row = mysqli_fetch_array($query);

    $Slcu = $row['Sl'];
    $Sl = $_GET['Sl'];
    
    $Giasp = $Gia;

    if($Slcu<$Sl){
        $Giamoi = ($Sl - $Slcu) * $Giasp;

        $queryx = mysqli_query($connect,"SELECT * from giohang where id='$idGH'");
    $rowx = mysqli_fetch_array($queryx);

    $tientanglen = $rowx['Tongtien'] + $Giamoi;
    $queryk = mysqli_query($connect,"UPDATE `giohang` SET  `Tongtien` = '$tientanglen' WHERE `giohang`.`id` = '$idGH';");
    echo "$tientanglen";


    }
    else{
        $Giamoi = ($Slcu - $Sl) * $Giasp;

        $queryx = mysqli_query($connect,"SELECT * from giohang where id='$idGH'");
    $rowx = mysqli_fetch_array($queryx);

    $tiengiamdi = $rowx['Tongtien'] - $Giamoi;
    $queryk = mysqli_query($connect,"UPDATE `giohang` SET  `Tongtien` = '$tiengiamdi' WHERE `giohang`.`id` = '$idGH';");
    echo "$tiengiamdi";
    }

    
    $queryk = mysqli_query($connect,"UPDATE `thongtingiohang` SET  `Sl` = '$Sl' WHERE `thongtingiohang`.`idGiohang` = '$idGH' and idsp = '$idsp';");

}
   
?>
