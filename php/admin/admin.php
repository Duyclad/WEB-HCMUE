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
       
    header('location:../DangNhap.php');
}
    include("../DB.php");
    mysqli_query($connect,"SET NAMES 'utf8'");

    $item_per_page =  !empty($_GET['per_page']) ? $_GET['per_page'] : 20;
    $tranghientai = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($tranghientai - 1) * $item_per_page;

    $menu = !empty($_GET['menu']) ? $_GET['menu'] : 1;
    $Xoa = !empty($_GET['Xoa']) ? $_GET['Xoa'] : 0;
    if ($Xoa=="1"){
        if ($menu=="2"){
            $Layid = $_GET['id'];
            $Del = mysqli_query($connect,"DELETE FROM `loaisp` WHERE `loaisp`.`idLoai` = '$Layid'");
            if ($Del){
                 echo '<script language="javascript">';
                    echo 'alert("Xóa thành công!")';
                    echo '</script>';
            }
           
        }
        if ($menu=="3"){
            $Layid = $_GET['id'];
            $Del = mysqli_query($connect,"DELETE FROM `sanpham` WHERE id = '$Layid'");
            if ($Del){
                 echo '<script language="javascript">';
                    echo 'alert("Xóa thành công!")';
                    echo '</script>';
            }
           
        }
        if ($menu=="4"){
            $Layid = $_GET['id'];
            $Del = mysqli_query($connect,"DELETE FROM `taikhoan` WHERE Sdt = '$Layid'");
            if ($Del){
                 echo '<script language="javascript">';
                    echo 'alert("Xóa thành công!")';
                    echo '</script>';
            }
           
        }
        if ($menu=="5"){
            $Layid = $_GET['id'];
            $Del = mysqli_query($connect,"DELETE FROM `gioithieu` WHERE id = '$Layid'");
            if ($Del){
                 echo '<script language="javascript">';
                    echo 'alert("Xóa thành công!")';
                    echo '</script>';
            }
           
        }
        if ($menu=="6"){
            $Layid = $_GET['id'];
            $Del = mysqli_query($connect,"DELETE FROM `cuahang` WHERE id = '$Layid'");
            if ($Del){
                 echo '<script language="javascript">';
                    echo 'alert("Xóa thành công!")';
                    echo '</script>';
            }
           
        }
        if ($menu=="7"){
            $Layid = $_GET['id'];
            $Del = mysqli_query($connect,"DELETE FROM `magiamgia` WHERE id = '$Layid'");
            if ($Del){
                 echo '<script language="javascript">';
                    echo 'alert("Xóa thành công!")';
                    echo '</script>';
            }
           
        }
        if ($menu=="8"){
            $Layid = $_GET['id'];
            $Del = mysqli_query($connect,"DELETE FROM `phanhoi` WHERE id = '$Layid'");
            if ($Del){
                 echo '<script language="javascript">';
                    echo 'alert("Xóa thành công!")';
                    echo '</script>';
            }
           
        }

    }
    else if ($Xoa=="2"){ 
        $Layid = $_GET['id'];
        $pass = md5("1");
        $upd = mysqli_query($connect,"UPDATE `taikhoan` SET `Matkhau` = '$pass' WHERE `taikhoan`.`Sdt` = '$Layid';");
        if ($upd){
            echo '<script language="javascript">';
               echo 'alert("Reset thành công!")';
               echo '</script>';
       }
    }
    if ($menu=="1"){
        $sqlx = mysqli_query($connect,"SELECT * FROM `donmua` where Trangthai = 'Đã giao'");
        $sql = mysqli_query($connect,"SELECT * FROM `donmua` where Trangthai = 'Đã giao' order by id desc limit ".$item_per_page." offset ".$offset);
        $sodong = $sqlx -> num_rows;
        $tong = mysqli_query($connect,"SELECT SUM(Tongtien) AS 'Tong' FROM `donmua` where Trangthai = 'Đã giao'");
        $tong=mysqli_fetch_assoc($tong);
        $totalpage = ceil($sodong / $item_per_page);
    }
    else if ($menu=="2"){
        $sqlx = mysqli_query($connect,"SELECT * FROM `loaisp`");
        $sql = mysqli_query($connect,"SELECT * FROM `loaisp` order by idLoai asc limit ".$item_per_page." offset ".$offset);
        $sodong = $sqlx -> num_rows;
        $totalpage = ceil($sodong / $item_per_page);
    }
    else if ($menu=="3"){
        $sqlx = mysqli_query($connect,"SELECT * FROM `sanpham`");
        $sql = mysqli_query($connect,"SELECT * FROM `sanpham` order by id desc limit ".$item_per_page." offset ".$offset);
        $sodong = $sqlx -> num_rows;
        $totalpage = ceil($sodong / $item_per_page);
    }
    else if ($menu=="4"){
        $sqlx = mysqli_query($connect,"SELECT * FROM `taikhoan`");
        $sql = mysqli_query($connect,"SELECT * FROM `taikhoan` order by Ngaydangky asc limit ".$item_per_page." offset ".$offset);
        $sodong = $sqlx -> num_rows;
        $totalpage = ceil($sodong / $item_per_page);
    }
    else if ($menu=="5"){
        $sqlx = mysqli_query($connect,"SELECT * FROM `gioithieu`");
        $sql = mysqli_query($connect,"SELECT * FROM `gioithieu` order by id asc limit ".$item_per_page." offset ".$offset);
        $sodong = $sqlx -> num_rows;
        $totalpage = ceil($sodong / $item_per_page);
    }
    else if ($menu=="6"){
        $sqlx = mysqli_query($connect,"SELECT * FROM `cuahang`");
        $sql = mysqli_query($connect,"SELECT * FROM `cuahang` order by id asc limit ".$item_per_page." offset ".$offset);
        $sodong = $sqlx -> num_rows;
        $totalpage = ceil($sodong / $item_per_page);
    }
    else if ($menu=="7"){
        $sqlx = mysqli_query($connect,"SELECT * FROM `magiamgia`");
        $sql = mysqli_query($connect,"SELECT * FROM `magiamgia` order by id desc limit ".$item_per_page." offset ".$offset);
        $sodong = $sqlx -> num_rows;
        $totalpage = ceil($sodong / $item_per_page);
    }
    else if ($menu=="8"){
        $sqlx = mysqli_query($connect,"SELECT * FROM `phanhoi`");
        $sql = mysqli_query($connect,"SELECT * FROM `phanhoi` order by id desc limit ".$item_per_page." offset ".$offset);
        $sodong = $sqlx -> num_rows;
        $totalpage = ceil($sodong / $item_per_page);
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
    
    <table style="border:1px solid;padding:10px;width:100%"> 
        <tr style="text-align: center;font-size:40px"><td colspan="2"><b>TRANG QUẢN LÝ WEBSITE GONZ</b></td></tr>
        <tr>
           <td  style="border:1px solid; width:15%">

           <div style="padding: 15px;font-size:25px">
        <a href="?menu=1">Doanh thu</a><br>
        <a href="?menu=2">Loại sản phẩm</a><br>
        <a href="?menu=3">Sản phẩm</a><br>
        <a href="?menu=4">Tài khoản</a><br>
        <a href="?menu=5">Giới thiệu</a><br>
        <a href="?menu=6">Cửa hàng</a><br>
        <a href="?menu=7">Mã giảm giá</a><br>
        <a href="?menu=8">Phản hồi</a>
    </div>
           </td>
           <td style="padding:15px">

           <div style="text-align: center;">
            <p style="font-size: 32px;margin-left:20px"><?php 
            if ($menu=="1"){
                echo "DOANH THU";
            }
            else if ($menu=="2"){
                echo "LOẠI SẢN PHẨM";
            }
            else if ($menu=="3"){
                echo "SẢN PHẨM";
            }
            else if ($menu=="4"){
                echo "TÀI KHOẢN";
            }
            else if ($menu=="5"){
                echo "GIỚI THIỆU";
            }
            else if ($menu=="6"){
                echo "CỬA HÀNG";
            }
            else if ($menu=="7"){
                echo "MÃ GIẢM GIÁ";
            }
            else if ($menu=="8"){
                echo "PHẢN HỒI";
            }
            ?></p>
           </div>
           <div>
               <p style="font-size: 18px;">
                   <?php
                   if ($menu=="1"){
                       echo "<b>Số lượng đơn hàng:</b> ".$sodong." - <b>Tổng cộng doanh thu:</b> ".number_format($tong['Tong'])."Đ" ;
                   }
                   else if ($menu=="2"){
                       echo "<a href=\"editloaisanpham.php?Them=1\" style=\"font-size: 22px\">[Thêm Loại Sản phẩm]</a>";
                   }
                   else if ($menu=="2"){
                    echo "<a href=\"editloaisanpham.php?Them=1\" style=\"font-size: 22px\">[Thêm Loại Sản phẩm]</a>";
                }
                else if ($menu=="3"){
                    echo "<a href=\"editsanpham.php?Them=1\" style=\"font-size: 22px\">[Thêm Sản phẩm]</a>";
                }
                else if ($menu=="4"){
                    echo "<a href=\"edittaikhoan.php?Them=1\" style=\"font-size: 22px\">[Thêm Tài khoản]</a>";
                }
                else if ($menu=="5"){
                    echo "<a href=\"editgioithieu.php?Them=1\" style=\"font-size: 22px\">[Thêm Giới thiệu]</a>";
                }
                else if ($menu=="6"){
                    echo "<a href=\"editcuahang.php?Them=1\" style=\"font-size: 22px\">[Thêm Cửa hàng]</a>";
                }
                else if ($menu=="7"){
                    echo "<a href=\"editmagiamgia.php?Them=1\" style=\"font-size: 22px\">[Thêm Mã giảm giá]</a>";
                }
                else if ($menu=="8"){
                    echo "<b>Số lượng phản hồi:</b> ".$sodong ;
                }
                    
                   
                   ?>
            
            </p>
           </div>
           <div>
               <table style="border: 1px solid;margin:0 auto">

               <tr style="border: 1px solid; ">
                   <?php 
                   if ($menu=="1"){ 
                       ?>
                   <th style="border: 1px solid; padding:10px;text-align:center">ID</th>
                   <th style="border: 1px solid; padding:10px;text-align:center">Số điện thoại (tài khoản)</th>
                   <th style="border: 1px solid; padding:10px;text-align:center">Tổng tiền</th>
                   <th style="border: 1px solid; padding:10px;text-align:center">Giảm giá</th>
                   <th style="border: 1px solid; padding:10px;text-align:center">Ngày bán</th>
                   <?php 
                   }

                   else if ($menu=="2"){
                       ?>
                    <th style="border: 1px solid; padding:10px;text-align:center">ID</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Tên loại</th>
                    <th style="border: 1px solid; padding:10px;text-align:center" colspan="2">Chức năng</th>
                   <?php }
                   else if ($menu=="3"){
                   ?>
                   <th style="border: 1px solid; padding:10px;text-align:center">ID</th>
                   <th style="border: 1px solid; padding:10px;text-align:center">Ảnh sản phẩm</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Tên sản phẩm</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Giá sản phẩm</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Loại sản phẩm</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Lượt xem</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Lượt mua</th>
                    <th style="border: 1px solid; padding:10px;text-align:center" colspan="2">Chức năng</th>

<?php }
                   else if ($menu=="4"){
                   ?>

<th style="border: 1px solid; padding:10px;text-align:center">Số điện thoại</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Tên tài khoản</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Địa chỉ</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Vai trò</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Ngày đăng ký</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Quên mật khẩu?</th>
                    <th style="border: 1px solid; padding:10px;text-align:center" colspan="3">Chức năng</th>


                   <?php }
                   else if ($menu=="5"){
                   ?>
<th style="border: 1px solid; padding:10px;text-align:center">ID</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Tiêu đề</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Nội dung</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Hiển thị</th>
                    <th style="border: 1px solid; padding:10px;text-align:center" colspan="2">Chức năng</th>

                   <?php }
                   else if ($menu=="6"){
                   ?>
                   <th style="border: 1px solid; padding:10px;text-align:center">ID</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Tên cửa hàng</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Địa chỉ cửa hàng</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Bản đồ</th>
                    <th style="border: 1px solid; padding:10px;text-align:center" colspan="2">Chức năng</th>
                   <?php }
                   else if ($menu=="7"){
                   ?>
                   <th style="border: 1px solid; padding:10px;text-align:center">ID</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Code</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Giảm giá</th>
                    <th style="border: 1px solid; padding:10px;text-align:center" colspan="2">Chức năng</th>
                   <?php }
                   else if ($menu=="8"){
                   ?>
                   <th style="border: 1px solid; padding:10px;text-align:center">ID</th>
                   <th style="border: 1px solid; padding:10px;text-align:center">Tên</th>
                   <th style="border: 1px solid; padding:10px;text-align:center">Email</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Tiêu đề</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Nội dung</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Trạng thái</th>
                    <th style="border: 1px solid; padding:10px;text-align:center">Ngày gửi phản hồi</th>
                    <th style="border: 1px solid; padding:10px;text-align:center" colspan="1">Chức năng</th>
                   <?php }
                   
                   ?>
               </tr>
           <?php
if($menu=="1"){
while($dong_sp=mysqli_fetch_assoc($sql)){

    $id =  $dong_sp['id'] ;
?>

<tr>
    <td style="border: 1px solid; padding:10px;text-align:center">
        <?php echo $id ?>
    </td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Sdt'] ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo number_format($dong_sp['Tongtien'])."đ"  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo number_format($dong_sp['GiamGia'])."đ" ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Tgiangiao'] ?></td>
</tr>




<?php }}
else if ($menu=="2"){
    while($dong_sp=mysqli_fetch_assoc($sql)){
        $id =  $dong_sp['idLoai'] ;
?>
<tr>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['idLoai'] ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Tenloai']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><a href="editloaisanpham.php?Sua=1&id=<?php echo $id ?>">Sửa</a></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><form action="admin.php?menu=<?php echo $menu ?>&id=<?php echo $id ?>&Xoa=1" method="POST"><button type="button" name="submit2" id="submit2<?php echo $id ?>" style="color: red" >Xóa</button><button type="submit" name="submit" id="submit1<?php echo $id ?>" style="color: red" >Xóa</button></form></td>

        <script>
            $('#submit1<?php echo $id ?>').hide();
            $('#submit2<?php echo $id ?>').click(function(){
                if (confirm("Bạn có chắc muốn xóa?")){ 
                    $('#submit1<?php echo $id ?>').click();
                     }
                else{

                }
            });
        </script>
</tr>
<?php
    }

}
else if ($menu=="3"){
    while($dong_sp=mysqli_fetch_assoc($sql)){
        $id =  $dong_sp['id'] ;

?>
<tr>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['id'] ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><img src="../../images/Sanpham/<?php echo $dong_sp['Linkanh']  ?>" alt="" width="100px" height="100px"></td>
    <td style="border: 1px solid; padding:10px;text-align:left"><?php echo $dong_sp['Tensp']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Giasp']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php
    $idLoaix= $dong_sp['Loaisp']  ;
    $xuatloai=mysqli_query($connect,"select Tenloai from loaisp where idLoai =  '$idLoaix'") ;
    $xuatloai=mysqli_fetch_assoc($xuatloai);
    echo $xuatloai['Tenloai'];
    ?></td>

<td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Luotxem']  ?></td>
<td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Luotmua']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><a href="editsanpham.php?Sua=1&id=<?php echo $id ?>">Sửa</a></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><form action="admin.php?menu=<?php echo $menu ?>&id=<?php echo $id ?>&Xoa=1" method="POST"><button type="button" name="submit2" id="submit2<?php echo $id ?>" style="color: red" >Xóa</button><button type="submit" name="submit" id="submit1<?php echo $id ?>" style="color: red" >Xóa</button></form></td>

        <script>
            $('#submit1<?php echo $id ?>').hide();
            $('#submit2<?php echo $id ?>').click(function(){
                if (confirm("Bạn có chắc muốn xóa?")){ 
                    $('#submit1<?php echo $id ?>').click();
                     }
                else{

                }
            });
        </script>
</tr>
<?php
    }

}
else if ($menu=="4"){
    while($dong_sp=mysqli_fetch_assoc($sql)){
        $id =  $dong_sp['Sdt'] ;

?>
<tr>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Sdt'] ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Tentk']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Diachi']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php if($dong_sp['Vaitro']=="0"){ echo "Khách hàng";}else if ($dong_sp['Vaitro']=="1") {echo "Nhân viên";} else {echo "QUẢN TRỊ";}  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Ngaydangky']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Quenpass']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><form action="admin.php?menu=<?php echo $menu ?>&id=<?php echo $id ?>&Xoa=2" method="POST"><button type="button" name="submit4" id="submit4<?php echo $id ?>" style="color: red" >Reset mật khẩu</button><button type="submit" name="submit3" id="submit3<?php echo $id ?>" style="color: red" >Reset mật khẩu</button></form></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><a href="edittaikhoan.php?Sua=1&id=<?php echo $id ?>">Sửa</a></td>
    <?php 
        if ((string)$_SESSION['Sdt']!=(string)$dong_sp['Sdt'] ){
    ?>
    <td style="border: 1px solid; padding:10px;text-align:center"><form action="admin.php?menu=<?php echo $menu ?>&id=<?php echo $id ?>&Xoa=1" method="POST"><button type="button" name="submit2" id="submit2<?php echo $id ?>" style="color: red" >Xóa</button><button type="submit" name="submit" id="submit1<?php echo $id ?>" style="color: red" >Xóa</button></form></td>
        <?php } ?>
        <script>
            $('#submit1<?php echo $id ?>').hide();
            $('#submit2<?php echo $id ?>').click(function(){
                if (confirm("Bạn có chắc muốn xóa?")){ 
                    $('#submit1<?php echo $id ?>').click();
                     }
                else{

                }
            });
            $('#submit3<?php echo $id ?>').hide();
            $('#submit4<?php echo $id ?>').click(function(){
                if (confirm("Bạn có chắc muốn Reset mật khẩu?")){ 
                    $('#submit3<?php echo $id ?>').click();
                     }
                else{

                }
            });
        </script>
</tr>
<?php
    }

}
else if ($menu=="5"){
    while($dong_sp=mysqli_fetch_assoc($sql)){
        $id =  $dong_sp['id'] ;

?>
<tr>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['id'] ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Tieude']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:left"><?php echo $dong_sp['Noidung']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Showing']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><a href="editgioithieu.php?Sua=1&id=<?php echo $id ?>">Sửa</a></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><form action="admin.php?menu=<?php echo $menu ?>&id=<?php echo $id ?>&Xoa=1" method="POST"><button type="button" name="submit2" id="submit2<?php echo $id ?>" style="color: red" >Xóa</button><button type="submit" name="submit" id="submit1<?php echo $id ?>" style="color: red" >Xóa</button></form></td>

        <script>
            $('#submit1<?php echo $id ?>').hide();
            $('#submit2<?php echo $id ?>').click(function(){
                if (confirm("Bạn có chắc muốn xóa?")){ 
                    $('#submit1<?php echo $id ?>').click();
                     }
                else{

                }
            });
        </script>
</tr>
<?php
    }

}
else if ($menu=="6"){
    while($dong_sp=mysqli_fetch_assoc($sql)){
        $id =  $dong_sp['id'] ;

?>
<tr>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['id'] ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Tendc']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:left"><?php echo $dong_sp['Diachi']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:left"><?php echo $dong_sp['Codehtml']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><a href="editcuahang.php?Sua=1&id=<?php echo $id ?>">Sửa</a></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><form action="admin.php?menu=<?php echo $menu ?>&id=<?php echo $id ?>&Xoa=1" method="POST"><button type="button" name="submit2" id="submit2<?php echo $id ?>" style="color: red" >Xóa</button><button type="submit" name="submit" id="submit1<?php echo $id ?>" style="color: red" >Xóa</button></form></td>

        <script>
            $('#submit1<?php echo $id ?>').hide();
            $('#submit2<?php echo $id ?>').click(function(){
                if (confirm("Bạn có chắc muốn xóa?")){ 
                    $('#submit1<?php echo $id ?>').click();
                     }
                else{

                }
            });
        </script>
</tr>
<?php
    }

}
else if ($menu=="7"){
    while($dong_sp=mysqli_fetch_assoc($sql)){
        $id =  $dong_sp['id'] ;

?>
<tr>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['id'] ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Code']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Giamgia']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><a href="editmagiamgia.php?Sua=1&id=<?php echo $id ?>">Sửa</a></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><form action="admin.php?menu=<?php echo $menu ?>&id=<?php echo $id ?>&Xoa=1" method="POST"><button type="button" name="submit2" id="submit2<?php echo $id ?>" style="color: red" >Xóa</button><button type="submit" name="submit" id="submit1<?php echo $id ?>" style="color: red" >Xóa</button></form></td>

        <script>
            $('#submit1<?php echo $id ?>').hide();
            $('#submit2<?php echo $id ?>').click(function(){
                if (confirm("Bạn có chắc muốn xóa?")){ 
                    $('#submit1<?php echo $id ?>').click();
                     }
                else{

                }
            });
        </script>
</tr>
<?php
    }

}
else if ($menu=="8"){
    while($dong_sp=mysqli_fetch_assoc($sql)){
        $id =  $dong_sp['id'] ;

?>
<tr>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['id'] ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Ten'] ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Email'] ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Tieude']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:left"><?php echo $dong_sp['Noidung']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Trangthai']  ?></td>
    <td style="border: 1px solid; padding:10px;text-align:center"><?php echo $dong_sp['Ngayphanhoi'] ?></td>
   
    <td style="border: 1px solid; padding:10px;text-align:center"><form action="admin.php?menu=<?php echo $menu ?>&id=<?php echo $id ?>&Xoa=1" method="POST"><button type="button" name="submit2" id="submit2<?php echo $id ?>" style="color: red" >Xóa</button><button type="submit" name="submit" id="submit1<?php echo $id ?>" style="color: red" >Xóa</button></form></td>

        <script>
            $('#submit1<?php echo $id ?>').hide();
            $('#submit2<?php echo $id ?>').click(function(){
                if (confirm("Bạn có chắc muốn xóa?")){ 
                    $('#submit1<?php echo $id ?>').click();
                     }
                else{

                }
            });
        </script>
</tr>
<?php
    }

}


?>


</table>
           </div>
           <div style="margin: 20px;text-align:center">
        <?php
        if ($tranghientai > 3) {
            echo "<a href=\"?menu=".$menu."&per_page=" . $item_per_page . "&page=1\" style=\"border: 1px solid;margin:5px;font-size: 24px;padding:10px\">Trang đầu</a>";
        }
        if ($tranghientai > 1) {
            echo "<a href=\"?menu=".$menu."&per_page=" . $item_per_page  ."&page= " . ($tranghientai - 1) . "\" style=\"border: 1px solid;margin:5px;font-size: 24px;padding:10px\">Trang trước</a>";
        }

        for ($i = 1; $i <= $totalpage; $i++) {

            if ($i != $tranghientai) {
                if ($i > $tranghientai - 3 && $i < $tranghientai + 3) {
                    echo "<a href=\"?menu=".$menu."&per_page=" . $item_per_page . "&page=" . $i . "\" style=\"border: 1px solid;margin:5px;font-size: 24px;padding:10px\">$i</a>";
                }
            } else {
                echo "<b><a href=\"?menu=".$menu."&per_page=" . $item_per_page . "&page=" . $i . "\" style=\"border: 1px solid;font-size: 24px;margin:5px;background: lightblue;;padding:10px\">$i</a></b>";
            }
        }
        if ($tranghientai < $totalpage) {
            echo "<a href=\"?menu=".$menu."&per_page=" . $item_per_page  ."&page= " . ($tranghientai + 1) . "\" style=\"border: 1px solid;margin:5px;font-size: 24px;padding:10px\">Trang sau</a>";
        }
        if ($tranghientai < $totalpage - 2) {
            echo "<a href=\"?menu=".$menu."&per_page=" . $item_per_page ."&page= " . $totalpage . "\" style=\"border: 1px solid;margin:5px;font-size: 24px;padding:10px\">Trang cuối</a>";
        }

        ?>

    </div>
           </td>
        </tr>
    </table>
    

    </body>
</html>