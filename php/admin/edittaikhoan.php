<?php

session_start();
date_default_timezone_set("Asia/Bangkok");
    $timestamp = time();
    $date = date("Y-m-d H:i:s", $timestamp);
if (isset($_SESSION["Vaitro"])){
    if ($_SESSION['Vaitro']=="1"){
        header('location: ../staff/staff.php');
    }
    else if ($_SESSION['Vaitro']=="0"){
        header('location:../TrangChu.php');
    }
}
if(!isset($_SESSION['Sdt'])){
       
    header('location:DangNhap.php');
}
    include("../DB.php");
    mysqli_query($connect,"SET NAMES 'utf8'");

    $item_per_page =  !empty($_GET['per_page']) ? $_GET['per_page'] : 20;
    $tranghientai = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($tranghientai - 1) * $item_per_page;

    $Them = !empty($_GET['Them']) ? $_GET['Them'] : 0;
    $Sua = !empty($_GET['Sua']) ? $_GET['Sua'] : 0;

    

    if (isset($_POST['submit'])){
        $Sdt= $_POST['Sdt'];
        $Tentk = $_POST['Tentk'];
        $Diachi = $_POST['Diachi'];


   
        $Vaitro = $_POST['Vaitro'];
        if (isset($_POST['id'])){
            $Layid = $_POST['id'];
            if(isset($_POST['pass'])){
                $Laypass = $_POST['pass'];
                $Laypass = md5($Laypass);
                $sql=mysqli_query($connect,"UPDATE `taikhoan` SET `Sdt` = '$Sdt', `Tentk` = '$Tentk', `Diachi` = '$Diachi', `Matkhau` = '$Laypass', `Vaitro` = '$Vaitro' WHERE `taikhoan`.`Sdt` = '$Layid';");
            }
            else{
                $sql=mysqli_query($connect,"UPDATE `taikhoan` SET `Sdt` = '$Sdt', `Tentk` = '$Tentk', `Diachi` = '$Diachi', `Vaitro` = '$Vaitro' WHERE `taikhoan`.`Sdt` = '$Layid';");
            }
            
            
        }
        else {
            $Laypass = $_POST['pass'];
            $Laypass = md5($Laypass);
            $sql=mysqli_query($connect,"INSERT INTO `taikhoan` (`Sdt`, `Tentk`, `Diachi`, `Matkhau`, `Vaitro`, `Ngaydangky`, `Quenpass`) VALUES ('$Sdt', '$Tentk', '$Diachi', '$Laypass', '$Vaitro', '$date', NULL);");
        }
        echo '<script language="javascript">';
        echo 'alert("Lưu thành công!")';
        echo '</script>';
    }
    if ($Them=="1"){

    }
    else{
        $id = $_GET['id'];
        if (isset($_POST['submit'])){
            if (isset($_POST['Sdt'])){
                $id = $_POST['Sdt'];
            }
        }
        $layloai = mysqli_query($connect,"select * from taikhoan where Sdt = '$id'; ");
        $layloai = mysqli_fetch_assoc($layloai);
    }
    
?>
<!DOCTYPE html>
<html>
    
    <head>
    <meta charset="utf-8">
    
    <LINK REL="SHORTCUT ICON" HREF="../../images/Gonz.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Quản trị - GONZ</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">       
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="../../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
    <style>

        #collapsibleNavbar ul li:hover .sub-menu { display: block; }
      
        .sub-menu{
            display: none;
            position: absolute;
            width: 300px;
            background-color: #fabbbb;
            padding: 10px;
        }
              
            
    </style>

    </head>
    <body>
        <div style="text-align: right;margin:30px">
            <p>Xin chào <?php echo $_SESSION['Tentk'] ?></p>
    <form method="POST" action="../TrangChu.php"><button name="btnThoat"> (Đăng xuất)</button></form>
        </div>
        <div>
            <a href="admin.php?menu=4" style="font-size: 24px;">[Quay về trang quản lý]</a>
        </div>
    <form  method="POST" action="edittaikhoan.php?Them=<?php echo $Them ?>&Sua=<?php echo $Sua ?><?php if ($Sua=="1"){echo "&id=".$id;} ?>">
        <div style="text-align: center;">
            <div style="text-align: center;"><p style="font-size: 42px;"><?php if ($Them=="1") {
                echo "THÊM TÀI KHOẢN";
            } else{
                echo "SỬA TÀI KHOẢN";
            }?></p></div>
        <p style="font-size:24px">Số điện thoại: </p>
        <input maxlength="15" type="text"  name="Sdt" style="width:200px;height:30px;margin:20px;padding:10px;border:1px solid" <?php if ($Sua=="1") {echo "value=\"".$layloai['Sdt']."\"";} ?>/>
        <?php if ($Sua=="1"){ ?>
        <input type="text"  name="id" id="id" style="width:200px;height:30px;margin:20px;padding:10px;border:1px solid" value="<?php echo $id ?>"/>
        <script>
            $('#id').hide();
        </script>

        <?php } ?>
        <p style="font-size:24px">Tên tài khoản: </p>
        <input maxlength="100" type="text"  name="Tentk" style="width:200px;height:30px;margin:20px;padding:10px;border:1px solid" <?php if ($Sua=="1") {echo "value=\"".$layloai['Tentk']."\"";} ?>/>
        <p style="font-size:24px">Địa chỉ: </p>
        <input maxlength="500" type="text"  name="Diachi" style="width:200px;height:30px;margin:20px;padding:10px;border:1px solid" <?php if ($Sua=="1") {echo "value=\"".$layloai['Diachi']."\"";} ?>/>
        <?php if ($Sua=="0" || ($Sua=="1" && $layloai['Vaitro']=="1")||($Sua=="1" && $layloai['Vaitro']=="2")){ ?>
            <p style="font-size:24px">Mật khẩu: </p>
        <input type="password"  name="pass" id="pass" style="width:200px;height:30px;margin:20px;padding:10px;border:1px solid" value="<?php echo $id ?>"/>
       

        <?php } ?>
        
        <p style="font-size:24px">Vai trò: </p>
        <select name="Vaitro" id="Vaitro">
            <option value="0" selected>Khách hàng</option>
            <option value="1">Nhân viên</option>
            <option value="2">Quản trị</option>
        </select>
            <br><br>
        <button type="submit" name="submit" id="submit1<?php echo $idDM ?>" style="color: red" >LƯU</button>
        
    </div>
    </form>
    

    </body>
</html>