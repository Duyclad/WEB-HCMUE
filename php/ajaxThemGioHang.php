
<?php
$Sdt = $_GET['Sdt'];
$idsp = $_GET["idsp"];

$Sl = $_GET['Sl'];
$Giasp = $_GET['Giasp'];
include("DB.php");
mysqli_query($connect, "SET NAMES 'utf8'");

date_default_timezone_set("Asia/Bangkok");
    $timestamp = time();
    $date = date("Y-m-d H:i:s", $timestamp);

    $Timgiohang = mysqli_query($connect,"SELECT * FROM `giohang` where Sdt='$Sdt'");
    $Giamoi = $Giasp * $Sl;
    if($Timgiohang->num_rows > 0 ){
        $row = mysqli_fetch_array($Timgiohang);
        $updateTongtien = $row['Tongtien'] + $Giasp * $Sl;
        $updatengay = mysqli_query($connect,"UPDATE `giohang` SET `Tongtien` = '$updateTongtien', `Cnhatlancuoi` = '$date' WHERE `giohang`.`Sdt` = $Sdt;");
        $idgiohang = $row['id'];
        $checkthongtingiohang = mysqli_query($connect,"SELECT * FROM `thongtingiohang` WHERE idGiohang = '$idgiohang' and idsp = '$idsp'");


        if($checkthongtingiohang->num_rows > 0 ){
            $rowx = mysqli_fetch_array($checkthongtingiohang);
            $Slhientai = $rowx['Sl'] + $Sl;
            $updateSL = mysqli_query($connect,"UPDATE `thongtingiohang` SET `Sl` = '$Slhientai' , Cnhatlancuoi = '$date' WHERE idGiohang = '$idgiohang' and idsp = '$idsp';
            ");

        }
        else{
            $themmoi = mysqli_query($connect,"INSERT INTO `thongtingiohang` ( `idsp`, `Sl`, `Tgiantao`, `Cnhatlancuoi`, `idGiohang`) VALUES ('$idsp', '$Sl', '$date', '$date', '$idgiohang');");
        }
    }
    else{
        $themgiohangmoi = mysqli_query($connect,"INSERT INTO `giohang` (`Sdt`,  `Tongtien`, `Tgiantao`, `Cnhatlancuoi`) VALUES ('$Sdt',  '$Giamoi', '$date', '$date');");

        $Timgiohang = mysqli_query($connect,"SELECT * FROM `giohang` where Sdt='$Sdt'");

        $row = mysqli_fetch_array($Timgiohang);
        $idgiohang = $row['id'];

        $themthongtinGH = mysqli_query($connect,"INSERT INTO `thongtingiohang` ( `idsp`, `Sl`, `Tgiantao`, `Cnhatlancuoi`, `idGiohang`) VALUES ( '$idsp', '$Sl', '$date', '$date', '$idgiohang');
            ");


    }

                        ?>