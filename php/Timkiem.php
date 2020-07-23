<?php
session_start();


include("DB.php");
mysqli_query($connect, "SET NAMES 'utf8'");

$ndungtim = !empty($_GET['ndungtim'])?$_GET['ndungtim']:' ' ;

if (isset($_POST["search"])) {
    $ndungtim = $_POST['ndungtim'];
}



$sql_loaisp = "select * from loaisp";
$query = mysqli_query($connect, $sql_loaisp);

$SX = !empty($_GET['SX']) ? $_GET['SX'] : 0;

$idLoai = !empty($_GET['idLoai']) ? $_GET['idLoai'] : 1;
$phanloai = mysqli_query($connect, "select * from loaisp where idLoai = '$idLoai'");

$ploai =  mysqli_fetch_array($phanloai);
$item_per_page =  !empty($_GET['per_page']) ? $_GET['per_page'] : 9;
$tranghientai = !empty($_GET['page']) ? $_GET['page'] : 1;
$offset = ($tranghientai - 1) * $item_per_page;
if ($SX=="1"){
    $sql_sptnc = "select * from sanpham where `Tensp` LIKE '%$ndungtim%'  order by Giasp  desc limit " . $item_per_page . " offset " . $offset;
    $querytnc = mysqli_query($connect, $sql_sptnc);
    $totalsp =  mysqli_query($connect, "select * from sanpham where `Tensp` LIKE '%$ndungtim%'");
$totalsp = $totalsp->num_rows;

$totalpage = ceil($totalsp / $item_per_page);
}
else if($SX=="2"){
    $sql_sptnc = "select * from sanpham where `Tensp` LIKE '%$ndungtim%'  order by Giasp asc limit " . $item_per_page . " offset " . $offset;
    $querytnc = mysqli_query($connect, $sql_sptnc);
    $totalsp =  mysqli_query($connect, "select * from sanpham where `Tensp` LIKE '%$ndungtim%'");
$totalsp = $totalsp->num_rows;

$totalpage = ceil($totalsp / $item_per_page);
}
else {
    
    $sql_sptnc = "select * from sanpham where `Tensp` LIKE '%$ndungtim%'  order by id desc limit " . $item_per_page . " offset " . $offset;
    $querytnc = mysqli_query($connect, $sql_sptnc);
    $totalsp =  mysqli_query($connect, "select * from sanpham where `Tensp` LIKE '%$ndungtim%'");
$totalsp = $totalsp->num_rows;

$totalpage = ceil($totalsp / $item_per_page);
} 





if (isset($_SESSION["Vaitro"])){
    if ($_SESSION['Vaitro']=="1"){
        header('location:./staff/staff.php');
    }
    else if ($_SESSION['Vaitro']=="2"){
        header('location:./admin/admin.php');
    }
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tìm kiếm - GONZ</title>
    <LINK REL="SHORTCUT ICON" HREF="../images/Gonz.ico">
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
    </style>
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
                    <div class="col-md-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> Gonz@gmail.com</li>
                                <li>FREE ship toàn khu vực Quận 5</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-6">
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
                                if (!isset($_SESSION["Sdt"])) {
                                    echo "<a href=\"DangNhap.php\"><i class=\"fa fa-user\"></i> Đăng nhập</a>";
                                } else {
                                    echo "
                                       
                                        
                                            <a href=\"EditInfo.php\"> <i class=\"fa fa-user\"></i> " . $_SESSION["Tentk"] . "</a>
                                            
                                           
                                                <form method=\"POST\" action=\"TrangChu.php\"><button name=\"btnThoat\"> (Đăng xuất)</button></form>
                                            
                                            
                                        
                                        
                                       ";
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
                <div class="col-md-1">
                    <div class="header__logo">
                        <a href="TrangChu.php"><img src="../images/Gonz.png" alt=""></a>
                    </div>
                </div>

                <div class="col-md-7">
                    <nav class="navbar navbar-expand-md bg-dark navbar-light bg-transparent">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Navbar links -->
                        <div class="collapse navbar-collapse" id="collapsibleNavbar">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" href="TrangChu.php">Trang chủ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="GioiThieu.php">Giới thiệu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="CuaHang.php">Cửa hàng</a>
                                </li>
                                <li class="nav-item" style="position: relative;">
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
                <div class="col-md-4">
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
    <h1 style="text-align: center;margin: 10px;">KẾT QUẢ TÌM KIẾM</h1>

    <?php 
        if($totalsp>0){

        
    ?>
    <p style="font-size: 24px;">Sắp xếp theo: <a href="<?php echo "Timkiem.php?ndungtim=".$ndungtim."&SX=2" ?>" style="font-size: 24px;<?php if ($SX=="2") {echo "font-weight: bold;";}; ?>">Giá tăng dần</a> - <a href="<?php echo "Timkiem.php?ndungtim=".$ndungtim."&SX=1" ?>" style="font-size: 24px;<?php if ($SX=="1") {echo "font-weight: bold;";}; ?>">Giá giảm dần</a></p>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="container-fluid padding">
        <div class="row padding">
            <?php
            while ($xuatsp = mysqli_fetch_assoc($querytnc)) {
            ?>


                <div class="col-md-4">

                    <div class="card">
                        <a href="ChiTietSanPham.php?idsp=<?php echo $xuatsp['id']; ?>">
                            <img class="card-img-top" src="../images/Sanpham/<?php echo $xuatsp['Linkanh']; ?>">
                            <div class="card-body">
                                <h4 class="card-title" style="color:#000"><b><?php echo $xuatsp['Tensp']; ?></b></h4>
                                <p style="font-size: 26px; color:#000">Giá: <?php echo number_format($xuatsp['Giasp']) . "đ"; ?></p>

                        </a>
                        <div class="featured__item__pic set-bg">

                            <ul class="featured__item__pic__hover">
                                <li><button id="add<?php echo $xuatsp['id']; ?>" style="background-color: #fabbbb; padding: 10px"> <a style="font-size: 24px;"><i class="fa fa-cart-plus " style="font-size: 24px;"></i> Thêm vào giỏ hàng</a></button></li>
                            </ul>
                        </div>

                    </div>
                </div>
        </div>
        <script>
            $(document).ready(function() {
                
                    $("#add<?php echo $xuatsp['id']; ?>").click(function() {
                        <?php 
                        if (!isset($_SESSION["Sdt"])){
                            echo "alert(\"Bạn phải đăng nhập!\");";
                        }
                            else{
                            //$("#test").load("ajaxThemGioHang.php");
                            echo "$.get(\"ajaxThemGioHang.php\",{Sdt:\"". $_SESSION['Sdt']."\",idsp:\"".$xuatsp['id']."\",Sl: 1,Giasp:\"".$xuatsp['Giasp']."\"});";
                            echo "alert(\"Thêm vào giỏ hàng thành công!\")";
                            
                        }

                        
                        
                        
                        ?>
                             
                    }
                )
            }

            )
        </script>

    <?php
            }
    ?>
    </div>
    </div>
    <div style="margin: 20px;text-align:center">
        <?php
        if ($tranghientai > 3) {
            echo "<a href=\"?per_page=" . $item_per_page ."&SX=".$SX."&ndungtim=".$ndungtim . "&page=1\" style=\"border: 1px solid;margin:5px;font-size: 24px;padding:10px\">Trang đầu</a>";
        }
        if ($tranghientai > 1) {
            echo "<a href=\"?per_page=" . $item_per_page ."&SX=".$SX."&ndungtim=".$ndungtim ."&page= " . ($tranghientai - 1) . "\" style=\"border: 1px solid;margin:5px;font-size: 24px;padding:10px\">Trang trước</a>";
        }

        for ($i = 1; $i <= $totalpage; $i++) {

            if ($i != $tranghientai) {
                if ($i > $tranghientai - 3 && $i < $tranghientai + 3) {
                    echo "<a href=\"?per_page=" . $item_per_page ."&SX=".$SX."&ndungtim=".$ndungtim . "&page=" . $i . "\" style=\"border: 1px solid;margin:5px;font-size: 24px;padding:10px\">$i</a>";
                }
            } else {
                echo "<b><a href=\"?per_page=" . $item_per_page ."&SX=".$SX."&ndungtim=".$ndungtim . "&page=" . $i . "\" style=\"border: 1px solid;font-size: 24px;margin:5px;background: lightblue;;padding:10px\">$i</a></b>";
            }
        }
        if ($tranghientai < $totalpage) {
            echo "<a href=\"?per_page=" . $item_per_page ."&SX=".$SX. "&ndungtim=".$ndungtim ."&page= " . ($tranghientai + 1) . "\" style=\"border: 1px solid;margin:5px;font-size: 24px;padding:10px\">Trang sau</a>";
        }
        if ($tranghientai < $totalpage - 2) {
            echo "<a href=\"?per_page=" . $item_per_page ."&SX=".$SX. "&ndungtim=".$ndungtim ."&page= " . $totalpage . "\" style=\"border: 1px solid;margin:5px;font-size: 24px;padding:10px\">Trang cuối</a>";
        }

        ?>

    </div>

<?php

    }
    else{
        echo "<p style=\"font-size: 50px; margin:20px\">Không có kết quả phù hợp!</p>";
    }

    ?>

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
    <div id="test"></div>

</body>

</html>