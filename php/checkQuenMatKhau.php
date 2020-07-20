
<?php
    session_start();
	if(isset($_SESSION['Sdt'])){
       
		header('location:TrangChu.php');
	}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Đăng kí - Gonz</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">       
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">  
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <header class="header sticky-top " style="background-color: rgba(245, 125, 125, 0.521);">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> duy3271@gmail.com</li>
                                <li>FREE ship toàn khu vực Quận 5</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <div class="header__cart">
                                    <ul>
                                        <li><a href="../html/GioHang.html"><i class="fa fa-cart-plus"></i> </a></li>
                                    </ul>
                                </div>
                            </div>
                          
                            <div class="header__top__right__auth">
                                <a href="DangNhap.php"><i class="fa fa-user"></i> Đăng nhập</a>
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
                       <a href="../html/TrangChu.html"><img src="../images/Gonz.png" alt=""></a>
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
                              <a class="nav-link" href="../html/TrangChu.html">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="../html/GioiThieu.html">Giới thiệu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../html/CuaHang.html">Cửa hàng</a>
                              </li>
                            <li class="nav-item">
                              <a class="nav-link" href="../html/ThucDon.html">Thực đơn</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../html/TinTuc.html">Tin tức</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="../html/LienHe.html">Liên hệ</a>
                              </li>
                              
                          </ul>
                        </div>
                      </nav>
                </div>
                <div class="col-lg-4" >
                    <div class="hero__search" >
                        <div class="hero__search__form" style="margin-top: 5px;">
                            <form action="#">
                                <input type="text" placeholder="Tìm kiếm">
                                <button type="submit" class="site-btn">SEARCH</button>
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
			<div class="carousel-caption">
				<h1 class="display-2">Sản phẩm mới</h1>
				<h3>Giá ưu đãi</h3>
				<button type="button" class="btn btn-outline-light btn-md">
					Chi tiết sản phẩm
				</button>
			</div>
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
<div class="main" >

    <section class="signup">
       
        <div class="container">
            <div class="signup-content">
                
            <?php
                include("DB.php");
                mysqli_query($connect,"SET NAMES 'utf8'");

                if (isset($_POST['submit'])){
                    $Sdt = mysqli_real_escape_string($connect,$_POST['phone']);
                    
                    
                    $check = mysqli_query($connect,"SELECT * FROM `taikhoan` where Sdt='$Sdt'");
                    
                    if($check->num_rows > 0 ){
                        echo "<p style=\"font-size:40px\">Thành công! Chúng tôi sẽ gửi mật khẩu mới cho bạn trong thời gian sớm nhất.</p>";
                        $capnhat=mysqli_query($connect,"UPDATE `taikhoan` SET `Quenpass` = 'YES' WHERE `taikhoan`.`Sdt` = '$Sdt'");
                    }
                    else{
                        
                        echo "<p style=\"font-size:40px\">Lỗi! Số điện thoại này không tồn tại trong hệ thống.</p>";
                        
                    }

                    
                }
            ?>


            </div>
        </div>
    </section>

</div><hr>

<footer>
	<div class="container-fluid padding">	
		<div class="row text-center">
			<div class="col-md-4">
				<img src="../images/Gonz.png" width=" 50" height="50">
				
				<p>0977-4090-00</p>
				<p>mymail@gmail.com</p>
				<p>280 ADV, phường 4, quận 5, Thành phố Hồ Chí Minh</p>
			</div>
			<div class="col-md-4">				
				<hr class="light">
				<h3>Giờ làm việc</h3>
				<hr class="light">
				<p>Thứ 2 - Thứ 7: 7h-22h</p>
				<p>Cuối tuần: 7h-19h</p>
			</div>
			<div class="col-md-4">				
				<hr class="light">
				<h3>Dịch vụ</h3>
				<hr class="light">
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


</body>
</html>

