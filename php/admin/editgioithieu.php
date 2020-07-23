<?php

session_start();
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
        $tieude = $_POST['tieude'];
        $noidung = $_POST['noidung'];

        
        $show = $_POST['show'];
        if (isset($_POST['id'])){
            $Layid = $_POST['id'];
            $sql=mysqli_query($connect,"UPDATE `gioithieu` SET `Tieude` = '$tieude', Noidung = '$noidung', Showing = '$show' WHERE `id` = $Layid;");
        }
        else {
            $sql=mysqli_query($connect,"INSERT INTO `gioithieu` (Tieude,Noidung,Showing) VALUES ('$tieude','$noidung','$show');");
        }
        echo '<script language="javascript">';
        echo 'alert("Lưu thành công!")';
        echo '</script>';
    }
    if ($Them=="1"){

    }
    else{
        $id = $_GET['id'];
        $layloai = mysqli_query($connect,"select * from gioithieu where id = $id; ");
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
            <a href="admin.php?menu=5" style="font-size: 24px;">[Quay về trang quản lý]</a>
        </div>
    <form  method="POST" action="editgioithieu.php?Them=<?php echo $Them ?>&Sua=<?php echo $Sua ?><?php if ($Sua=="1"){echo "&id=".$id;} ?>">
        <div style="text-align: center;">
            <div style="text-align: center;"><p style="font-size: 42px;"><?php if ($Them=="1") {
                echo "THÊM GIỚI THIỆU";
            } else{
                echo "SỬA GIỚI THIỆU";
            }?></p></div>
        <p style="font-size:24px">Tiêu đề: </p>
        <input maxlength="100" type="text"  name="tieude" style="width:200px;height:30px;margin:20px;padding:10px;border:1px solid" <?php if ($Sua=="1") {echo "value=\"".$layloai['Tieude']."\"";} ?>/>
        <?php if ($Sua=="1"){ ?>
        <input type="text"  name="id" id="id" style="width:200px;height:30px;margin:20px;padding:10px;border:1px solid" value="<?php echo $id ?>"/>
        <script>
            $('#id').hide();
        </script>

        <?php } ?>
        <p style="font-size:24px">Nội dung: </p>
        <textarea placeholder="Nội dung" name="noidung" maxlength="5000" rows="10" cols="100" style="border: 1px solid;"><?php if ($Sua=="1") {echo $layloai['Noidung'];} ?></textarea>
        
        <p style="font-size:24px">Hiển thị: </p>
        <select name="show" id="show">
            <option value="NO" selected>NO</option>
            <option value="YES">YES</option>
        </select>
            <br><br>
        <button type="submit" name="submit" id="submit1<?php echo $idDM ?>" style="color: red" >LƯU</button>
        
    </div>
    </form>
    

    </body>
</html>