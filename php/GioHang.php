<?php
session_start();

if (!isset($_SESSION['Sdt'])) {

    header('location:DangNhap.php');
}

if (isset($_SESSION["Vaitro"])){
    if ($_SESSION['Vaitro']=="1"){
        header('location:./staff/staff.php');
    }
    else if ($_SESSION['Vaitro']=="2"){
        header('location:./admin/admin.php');
    }
}

include("DB.php");
mysqli_query($connect, "SET NAMES 'utf8'");

$sql_loaisp = "select * from loaisp";
$query = mysqli_query($connect, $sql_loaisp);

$Sdt = $_SESSION['Sdt'];
date_default_timezone_set("Asia/Bangkok");
    $timestamp = time();
    $date = date("Y-m-d H:i:s", $timestamp);


if (isset($_POST["dathang"])) {
    
    if ($_POST['Tenngnhan']==''){
        
            echo '<script language="javascript">';
            echo 'alert("Bạn chưa nhập tên người nhận!")';
            echo '</script>';
        
    }
    else if($_POST['Sdtngnhan'] == ''){
        echo '<script language="javascript">';
            echo 'alert("Bạn chưa nhập Số điện thoại người nhận!")';
            echo '</script>';
    }
    else if ($_POST['Dchingnhan']==''){
        echo '<script language="javascript">';
            echo 'alert("Bạn chưa nhập Địa chỉ nhận hàng!")';
            echo '</script>';
    }
    else{
        $Tienduocgiam = 0;
    $Code = $_POST['CodeGG'];

    $Tenngnhan = $_POST['Tenngnhan'];
    $Sdtngnhan = $_POST['Sdtngnhan'];
    $Dchingnhan = $_POST['Dchingnhan'];
    $Ghichu = $_POST['Ghichu'];

    if ($Code !=''){
        $giamgiax = mysqli_query($connect, "select * from magiamgia where Code = '$Code'");
        if ($giamgiax->num_rows > 0) {
            $giamgiax = mysqli_fetch_assoc($giamgiax);
        $Tienduocgiam= $giamgiax['Giamgia'];
        }
        
    }
    
$giohangx = mysqli_query($connect, "select * from giohang where Sdt = '$Sdt'");

$giohangx = mysqli_fetch_assoc($giohangx);
$TongTien= $giohangx['Tongtien'];
$idGH = $giohangx['id'];

    $insertDM = mysqli_query($connect,"INSERT INTO `donmua` (`id`, `Sdt`, `Tongtien`, `GiamGia`, `Tenngnhan`, `Sdtngnhan`, `Diachingnhan`, `Ghichu`, `Tgdathang`, `Tgiangiao`, `Trangthai`) VALUES ('$idGH', '$Sdt', '$TongTien', '$Tienduocgiam', '$Tenngnhan', '$Sdtngnhan', '$Dchingnhan', '$Ghichu', '$date', NULL, 'Đang chuẩn bị');");
    

    $thongtingiohang = mysqli_query($connect,"SELECT thongtingiohang.idsp, thongtingiohang.Sl , sanpham.tensp,sanpham.Giasp from thongtingiohang,sanpham where  thongtingiohang.idsp = sanpham.id and thongtingiohang.idGiohang = '$idGH';"); 
    while($chuyen=mysqli_fetch_assoc($thongtingiohang))
    
    {

        $idsp = $chuyen['idsp'];
        $Tensp = $chuyen['tensp'];
        $Sl = $chuyen['Sl'];
        $Giasp = $chuyen['Giasp'];
        $Thanhtien = $Sl * $Giasp;
        $luu = mysqli_query($connect,"INSERT INTO `thongtindonhang` (`id`, `idSP`, `Tensp`, `Dongia`, `Sl`, `Thanhtien`, `idDonmua`) VALUES (NULL, '$idsp', '$Tensp', '$Giasp', '$Sl', '$Thanhtien', '$idGH');") ;
    }
    $delGH = mysqli_query($connect,"DELETE FROM `giohang` WHERE `giohang`.`id` = $idGH");
    echo '<script language="javascript">';
            echo 'alert("Đặt hàng thành công!")';
            echo '</script>';
    }
    
    }



$giohang = mysqli_query($connect, "SELECT giohang.Tongtien, sanpham.id, sanpham.Tensp, sanpham.Giasp,thongtingiohang.Sl,sanpham.Linkanh,thongtingiohang.idGiohang FROM sanpham, giohang,thongtingiohang WHERE giohang.Sdt='$Sdt' AND thongtingiohang.idsp = sanpham.id and thongtingiohang.idGiohang = giohang.id");

$giohangx = mysqli_query($connect, "select * from giohang where Sdt = '$Sdt'");

$giohangx = mysqli_fetch_assoc($giohangx);



$giohangxy = mysqli_query($connect, "select * from giohang where Sdt = '$Sdt'");
$check = 0;
if ($giohangxy->num_rows > 0) {
    $check = 1;
}


if (isset($_POST["btnThoat"])) {
    unset($_SESSION["Sdt"]);
    unset($_SESSION["Tentk"]);
    unset($_SESSION["Diachi"]);
    unset($_SESSION["Vaitro"]);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <LINK REL="SHORTCUT ICON" HREF="../images/Gonz.ico">
    <title>Giỏ hàng - GONZ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">       
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <style>
        #collapsibleNavbar ul li:hover .sub-menu {
            display: block;
        }

        .sub-menu {
            display: none;
            position: absolute;
            width: 300px;
            background-color: #fabbbb;
            padding: 10px;
        }

        .buttons_added {
            opacity: 1;
            display: inline-block;
            display: -ms-inline-flexbox;
            display: inline-flex;
            white-space: nowrap;
            vertical-align: top;
        }

        .is-form {
            overflow: hidden;
            position: relative;
            background-color: #f9f9f9;
            height: 2.2rem;
            width: 1.9rem;
            padding: 0;
            text-shadow: 1px 1px 1px #fff;
            border: 1px solid #ddd;
        }

        .is-form:focus,
        .input-text:focus {
            outline: none;
        }

        .is-form.minus {
            border-radius: 4px 0 0 4px;
        }

        .is-form.plus {
            border-radius: 0 4px 4px 0;
        }

        .input-qty {
            background-color: #fff;
            height: 2.2rem;
            text-align: center;
            font-size: 1rem;
            display: inline-block;
            vertical-align: top;
            margin: 0;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            border-left: 0;
            border-right: 0;
            padding: 0;
        }

        .input-qty::-webkit-outer-spin-button,
        .input-qty::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    <script>

    </script>
</head>

<body>
      <!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v7.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="108189827644660"
  theme_color="#ff5ca1"
  logged_in_greeting="Chào bạn! Bạn cần GONZ giúp gì không?"
  logged_out_greeting="Chào bạn! Bạn cần GONZ giúp gì không?">
      </div>
    <header class="header sticky-top " style="background-color: rgba(245, 125, 125, 0.521);">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> Gonz@gmail.com</li>
                                <li>FREE ship toàn khu vực Quận 5</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <div class="header__cart">
                                    <ul>
                                    <li><a href="GioHang.php"><i class="fa fa-shopping-cart " style="font-size: 32px";></i> </a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="header__top__right__auth">
                            <?php 
                                    if (!isset($_SESSION["Sdt"])){
                                        echo "<a href=\"DangNhap.php\"><i class=\"fa fa-user\"></i> Đăng nhập</a>";

                                    }
                                    else{
                                        echo "
                                       
                                        
                                            <a href=\"EditInfo.php\"> <i class=\"fa fa-user\"></i> ".$_SESSION["Tentk"]."</a>
                                            
                                           
                                                <form method=\"POST\" action=\"TrangChu.php\"><button name=\"btnThoat\"> (Đăng xuất)</button></form>
                                            
                                            
                                        
                                        
                                       "
                                         ;
                                        
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container ">
            <div class="row ">
                <div class="col-lg-1">
                    <div class="header__logo">
                        <a href="TrangChu.php"><img src="../images/Gonz.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <nav class="navbar navbar-expand-md bg-dark navbar-light bg-transparent">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Navbar links -->
                        <div class="collapse navbar-collapse" id="collapsibleNavbar">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="TrangChu.php">Trang chủ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="GioiThieu.php">Giới thiệu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="CuaHang.php">Cửa hàng</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" >Sản phẩm</a>
                              <ul class="sub-menu">
                              <?php
							  while($dong_sp=mysqli_fetch_assoc($query)){
							  ?>
                                                            		<li><a href="<?php echo "sanpham.php?idLoai=".$dong_sp['idLoai']; ?>"><?php echo $dong_sp['Tenloai']; ?></a></li>
                                                                    <?php
							  }
                              ?>         
                              </ul>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link" href="LienHe.php">Liên hệ</a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-4">
                    <div class="hero__search">
                        <div class="hero__search__form" style="margin-top: 5px;">
                        <form action="Timkiem.php"  method="POST">
                                <input type="text" placeholder="Tìm kiếm sản phẩm" name="ndungtim" maxlength="50">
                                <button type="submit" name="search" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <div id="slides" class="carousel slide" style="text-align: center;" data-ride="carousel">
        <ul class="carousel-indicators">
            <li data-target="#slides" data-slide-to="0" class="active"></li>
            <li data-target="#slides" data-slide-to="1"></li>
            <li data-target="#slides" data-slide-to="2"></li>
            <li data-target="#slides" data-slide-to="3"></li>
        </ul>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../images/banner01.jfif">

            </div>
            <div class="carousel-item">
                <img src="../images/banner02.png">
            </div>
            <div class="carousel-item">
                <img src="../images/banner03.png">
            </div>
            <div class="carousel-item">
                <img src="../images/banner04.jpg">
            </div>
        </div>
    </div>
    <hr>

    <h1 style="text-align: center;">Giỏ hàng</h1>
    <div id="xuatTB"> <?php if ($check == 0) {
                            echo "<p style=\"font-size: 50px; margin:20px\">Giỏ hàng của bạn đang trống!</p>";
                        } ?></div>

    <?php if ($check == 1) { ?>
        <section class="shoping-cart spad" id="XuatGH">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>

                                        <th class="shoping__product">Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 0;
                                    while ($xuatgiohang = mysqli_fetch_assoc($giohang)) {

                                    ?>

                                        <tr id="hide<?php echo $i ?>">
                                            <td class="shoping__cart__item">
                                                <img src="../images/Sanpham/<?php echo $xuatgiohang['Linkanh']; ?>" alt="" style="width:100px;height:100px">
                                                <h5><?php echo $xuatgiohang['Tensp'] ?></h5>
                                            </td>
                                            <td class="shoping__cart__price" id="Giasanpham<?php echo $i ?>">
                                                <?php echo number_format($xuatgiohang['Giasp']) . "đ"; ?>
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty" style="width:130px">
                                                        <input class="minus is-form" type="button" value="-" style="width:40px" id="tru<?php echo $i ?>">
                                                        <input aria-label="quantity" class="input-qty" min="1" name="" type="number" value="<?php echo $xuatgiohang['Sl'] ?>" id="SLSP<?php echo $i ?>" style="width:40px">
                                                        <input class="plus is-form" type="button" value="+" style="width:40px" id="cong<?php echo $i ?>">
                                                    </div>
                                                </div>
                                            </td>




                                            <td class="shoping__cart__total" id="Thanhtien<?php echo $i ?>">

                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <span id="Xoa<?php echo $xuatgiohang['id'] ?>">X</span>
                                            </td>


                                            <script>
                                                function formatNumber(val) {

                                                    const value = val.toString();

                                                    if (value.length < 7) {
                                                        return `${value.substring(0, value.length - 3)},${value.substring(value.length - 3, value.length)}`;
                                                    } else {
                                                        return `${value.substring(0, value.length - 6)},${value.substring(value.length - 6, value.length - 3)},${value.substring(value.length - 3, value.length)}`;
                                                    }
                                                    //15 295 000
                                                }
                                                var giatri<?php echo $i ?> = $('#SLSP<?php echo $i ?>').val();
                                                var thanhtien<?php echo $i ?> = <?php echo $xuatgiohang['Giasp'] ?> * $('#SLSP<?php echo $i ?>').val();
                                                $('#Thanhtien<?php echo $i ?>').html(formatNumber(thanhtien<?php echo $i ?>) + "đ");

                                                $('#SLSP<?php echo $i ?>').change(function() {
                                                    if ($('#SLSP<?php echo $i ?>').val() < 1) {
                                                        $('#SLSP<?php echo $i ?>').val(1);
                                                        thanhtien<?php echo $i ?> = <?php echo $xuatgiohang['Giasp'] ?> * $('#SLSP<?php echo $i ?>').val();
                                                        $('#Thanhtien<?php echo $i ?>').html(formatNumber(thanhtien<?php echo $i ?>) + "đ");
                                                    } else {
                                                        thanhtien<?php echo $i ?> = <?php echo $xuatgiohang['Giasp'] ?> * $('#SLSP<?php echo $i ?>').val();
                                                        $('#Thanhtien<?php echo $i ?>').html(formatNumber(thanhtien<?php echo $i ?>) + "đ");
                                                    }
                                                    giatri<?php echo $i ?> = $('#SLSP<?php echo $i ?>').val();
                                                    var url = "ajaxSuaGioHang.php?idsp=" + <?php echo $xuatgiohang['id']  ?> + "&idGH=" + <?php echo $xuatgiohang['idGiohang']  ?> + "&Gia=" + <?php echo $xuatgiohang['Giasp']; ?> + "&check=1" + "&Sl=" + $('#SLSP<?php echo $i ?>').val();
                                                    $.get(url, {}, function(data) {

                                                        TTien = data;
                                                        $('#TTien').html(formatNumber(data) + "Đ");
                                                        $('#Saukhigiam').html(formatNumber(TTien - GGia) + "Đ");

                                                    });
                                                })
                                                $('#tru<?php echo $i ?>').click(function() {
                                                    if ($('#SLSP<?php echo $i ?>').val() == 1) {
                                                        if (confirm("Bạn có chắc muốn xóa sản phẩm này?")) {
                                                            var url = "ajaxSuaGioHang.php?idsp=" + <?php echo $xuatgiohang['id']  ?> + "&idGH=" + <?php echo $xuatgiohang['idGiohang']  ?> + "&Gia=" + $('#SLSP<?php echo $i ?>').val() * <?php echo $xuatgiohang['Giasp'] ?> + "&check=0";
                                                            $.get(url, {}, function(data) {
                                                                if (data == "0") {
                                                                    $('#xuatTB').html("<p style=\"font-size: 50px; margin:20px\">Giỏ hàng của bạn đang trống!</p>");
                                                                    $('#XuatGH').hide();

                                                                } else {
                                                                    TTien = data;
                                                                    $('#TTien').html(formatNumber(data) + "Đ");
                                                                    $('#Saukhigiam').html(formatNumber(TTien - GGia) + "Đ");
                                                                }
                                                            });
                                                            $('#hide<?php echo $i ?>').hide();


                                                        } else {

                                                        }
                                                    }
                                                    if ($('#SLSP<?php echo $i ?>').val() > 1) {
                                                        giatri<?php echo $i ?>--;
                                                        $('#SLSP<?php echo $i ?>').val(giatri<?php echo $i ?>);
                                                        var thanhtien<?php echo $i ?> = <?php echo $xuatgiohang['Giasp'] ?> * $('#SLSP<?php echo $i ?>').val();

                                                        $('#Thanhtien<?php echo $i ?>').html(formatNumber(thanhtien<?php echo $i ?>) + "đ");
                                                    }


                                                    var url = "ajaxSuaGioHang.php?idsp=" + <?php echo $xuatgiohang['id']  ?> + "&idGH=" + <?php echo $xuatgiohang['idGiohang']  ?> + "&Gia=" + <?php echo $xuatgiohang['Giasp']; ?> + "&check=1" + "&Sl=" + $('#SLSP<?php echo $i ?>').val();
                                                    $.get(url, {}, function(data) {

                                                        TTien = data;
                                                        $('#TTien').html(formatNumber(data) + "Đ");
                                                        $('#Saukhigiam').html(formatNumber(TTien - GGia) + "Đ");

                                                    });

                                                });
                                                $('#cong<?php echo $i ?>').click(function() {
                                                    giatri<?php echo $i ?>++;
                                                    $('#SLSP<?php echo $i ?>').val(giatri<?php echo $i ?>);
                                                    var thanhtien<?php echo $i ?> = <?php echo $xuatgiohang['Giasp'] ?> * $('#SLSP<?php echo $i ?>').val();
                                                    $('#Thanhtien<?php echo $i ?>').html(formatNumber(thanhtien<?php echo $i ?>) + "đ");
                                                    var url = "ajaxSuaGioHang.php?idsp=" + <?php echo $xuatgiohang['id']  ?> + "&idGH=" + <?php echo $xuatgiohang['idGiohang']  ?> + "&Gia=" + <?php echo $xuatgiohang['Giasp']; ?> + "&check=1" + "&Sl=" + $('#SLSP<?php echo $i ?>').val();
                                                    $.get(url, {}, function(data) {

                                                        TTien = data;
                                                        $('#TTien').html(formatNumber(data) + "Đ");
                                                        $('#Saukhigiam').html(formatNumber(TTien - GGia) + "Đ");

                                                    });
                                                });

                                                $('#Xoa<?php echo $xuatgiohang['id'] ?>').click(function() {
                                                    if (confirm("Bạn có chắc muốn xóa sản phẩm này?")) {
                                                        var url = "ajaxSuaGioHang.php?idsp=" + <?php echo $xuatgiohang['id']  ?> + "&idGH=" + <?php echo $xuatgiohang['idGiohang']  ?> + "&Gia=" + $('#SLSP<?php echo $i ?>').val() * <?php echo $xuatgiohang['Giasp'] ?> + "&check=0";
                                                        $.get(url, {}, function(data) {
                                                            if (data == "0") {
                                                                $('#xuatTB').html("<p style=\"font-size: 50px; margin:20px\">Giỏ hàng của bạn đang trống!</p>");
                                                                $('#XuatGH').hide();

                                                            } else {
                                                                TTien = data;
                                                                $('#TTien').html(formatNumber(data) + "Đ");
                                                                $('#Saukhigiam').html(formatNumber(TTien - GGia) + "Đ");
                                                            }
                                                        });
                                                        $('#hide<?php echo $i ?>').hide();


                                                    } else {

                                                    }




                                                });
                                            </script>
                                        </tr>


                                    <?php
                                        $i++;
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                

                
                <form method="POST" action="GioHang.php">
                <div class="row">

                    <div class="col-lg-6">
                        <div style="width:400px">


                            <h5 style="margin-top: 45px;margin-bottom:10px">Tên người nhận: (Vui lòng nhập chính xác)</h5>

                            <div class="wrap-input100 validate-input m-b-16">
                                <input class="input100" type="text" maxlength="100" name="Tenngnhan" value="<?php echo $_SESSION['Tentk'] ?>">
                                <span class="focus-input100"></span>
                            </div>
                            <h5 style="margin-top: 10px;margin-bottom:10px">Số điện thoại người nhận: (Vui lòng nhập chính xác)</h5>

                            <div class="wrap-input100 validate-input m-b-16">
                                <input class="input100" type="text" maxlength="15" name="Sdtngnhan" value="<?php echo $_SESSION['Sdt'] ?>"> 
                                <span class="focus-input100"></span>
                            </div>
                        

                        <h5 style="margin-top: 10px;margin-bottom:10px">Địa chỉ nhận hàng: (Vui lòng nhập chính xác)</h5>

                        <div class="wrap-input100 validate-input m-b-16">
                                <input class="input100" type="text" maxlength="200" name="Dchingnhan" value="<?php echo $_SESSION['Diachi'] ?>">
                                <span class="focus-input100"></span>
                            </div>
                        <h5 style="margin-top: 10px;margin-bottom:10px">Ghi chú cho người bán:</h5>

                        <div class="wrap-input100 validate-input m-b-16">
                                <input class="input100" type="text" name="Ghichu" maxlength="1000">
                                <span class="focus-input100"></span>
                            </div>


                    </div></div>
                    <div class="col-lg-6">
                        <div class="shoping__discount">
                                <h5>Mã giảm giá</h5>

                                <input type="text" placeholder="Nhập mã giảm giá" style="border: 1px solid; height: 40px" id="Code" name="CodeGG" maxlength="15">
                                <button class="primary-btn" id="GG"  type="button">Dùng</button>

                            </div>


                        <div class="shoping__checkout">
                        <div class="shoping__continue" >
                            

                        </div>
                            <h5>Giá trị giỏ hàng</h5>
                            <ul>
                                <li>Tổng tiền <span id="TTien"><?php echo number_format($giohangx['Tongtien']) . "Đ"; ?></span></li>
                                <li>Số tiền được giảm <span id="Giam">0Đ</span></li>
                                <li>Sau khi giảm giá<span id="Saukhigiam"><?php echo number_format($giohangx['Tongtien']) . "Đ"; ?></span></li>
                            </ul>
                            <button style="width:100%" id="dathang" name="dathang" class="primary-btn">Đặt hàng</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </section>
    <?php } ?>
    <script>
        var TTien = <?php echo $giohangx['Tongtien']; ?>;
        var GGia = 0;
        $("#GG").click(function() {
            if ($("#Code").val() == "") {
                alert("Bạn chưa nhập mã giảm giá!");
            } else {
                var url = "ajaxMaGiamGia.php?Code=" + $("#Code").val();
                $.get(url, {}, function(data) {
                    if (data == "NOT") {
                        alert("Mã giảm giá không tồn tại!");
                    } else {
                        GGia = data;
                        $('#Giam').html(formatNumber(data) + "Đ");
                        $('#Saukhigiam').html(formatNumber(TTien - data) + "Đ");
                    }
                })
            }

        })
    </script>
    <hr>

    <footer>
	<div class="container-fluid padding">	
		<div class="row text-center ">
			<div class="col-md-4" >
            <hr class="light"  style="width:100%">
            <h3 style=" color : #CCFFCC">Liên hệ</h3>
            <hr class="light"  style="width:100%">
				
				<p>SĐT: 0977-4090-60</p>
                <p>Email: Gonz@gmail.com</p>
                <p><a href="https://www.facebook.com/GONZ-108189827644660" target="_blank"><i class="fa fa-facebook-square" style="font-size: 19px;color:white"> Fanpgage Gonz </i></a></p>
				<p>280 ADV, phường 4, quận 5, Thành phố Hồ Chí Minh</p>
			</div>
			<div class="col-md-4">				
				<hr class="light"  style="width:100%">
				<h3 style=" color : #CCFFCC">Giờ làm việc</h3>
				<hr class="light"  style="width:100%">
				<p>Thứ 2 - Thứ 7: 7h-22h</p>
				<p>Cuối tuần: 7h-19h</p>
			</div>
            <div class="col-md-4" >
           			
				<hr class="light" style="width:100%" >
				<h3 style=" color : #CCFFCC">Dịch vụ</h3>
				<hr class="light"  style="width:100%">
				<p>Trà sữa</p>
				<p>Thức uống theo yêu cầu</p>
			</div>
			<div class="col-12">
				<hr class="light-100">
				<h5>&copy; GONZ</h5>
			</div>
		</div>
	</div>
</footer>

</body>

</html>