<?php 
    session_start();

    $connect = mysqli_connect("localhost","root","","dbgonz_do_an");
                mysqli_query($connect,"SET NAMES 'utf8'");

                if (isset($_POST['submit'])){
                    $Sdt = mysqli_real_escape_string($connect,$_POST['username']);
                    
                    $Matkhau = mysqli_real_escape_string($connect,$_POST['pass']);
                    
                    $Matkhau = md5($Matkhau);

                    $check = mysqli_query($connect,"SELECT * FROM `taikhoan` where Sdt='$Sdt' and Matkhau='$Matkhau'");

                    if($check->num_rows > 0 ){
                        $row = mysqli_fetch_array($check);
                        $_SESSION["Sdt"]= $row['Sdt'];
                        $_SESSION["Tentk"]= $row['Tentk'];
                        $_SESSION["Diachi"]= $row['Diachi'];
                        $_SESSION["Vaitro"]= $row['Vaitro'];
                    }
                    else{
                        echo '<script language="javascript">';
                        echo 'alert("Sai số điện thoại hoặc mật khẩu!")';
                        echo '</script>';
                    }
            }
?>
<?php 
    if (isset($_POST["btnThoat"])){
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
	<title>Trang chủ - Gonz</title>
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
        .menu_ngang{
width:130px; height:50px; background-color:#CCC;
z-index: 10;
}
.menu_ngang ul{
margin:0; padding:0; list-style:none; float:left;
}
.menu_ngang ul li{
float:left; 
position:relative;
}
.menu_ngang ul li a{
text-decoration:none; color:#333; padding:0 20px;
line-height:50px; 
}
.menu_ngang ul li ul{
    position:absolute;
background-color:#ccc;
display:none; width:105%;
}
.menu_ngang ul li ul li a{
border-right:none; border-bottom:1px solid #FFF;
line-height:30px; display:block;
text-align:left; width:100%;
}
.menu_ngang ul li ul li a:hover{ font-weight:bold; }
.menu_ngang ul li:hover ul{ display:block; }
    </style>
</head>
<body>
    <header class="header sticky-top " style="background-color: rgba(245, 125, 125, 0.521);">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> duy3271@gmail.com</li>
                                <li>FREE ship toàn khu vực Quận 5</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <div class="header__cart">
                                    <ul>
                                        <li><a href="../html/GioHang.html"><i class="fa fa-cart-plus"></i> </a></li>
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
                <div class="col-md-1">
                    <div class="header__logo">
                        <a href="../html/TrangChu.html"><img src="../images/Gonz.png" alt=""></a>
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
                              <a class="nav-link active" href="../html/TrangChu.html">Trang chủ</a>
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
                <div class="col-md-4" >
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
<h1 style="text-align: center;">Trang chủ</h1>

<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>Sản phẩm nổi bật</h2>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg">
                        <img src="../images/featured/feature-2.jpg"/>
                        <ul class="featured__item__pic__hover" >
                            <li><a href="#"><i class="fa fa-shopping-cart " style="font-size: 24px;"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Chuối </a></h6>
                        <h5>80.000đ</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg">
                        <img src="../images/featured/feature-2.jpg"/>
                        <ul class="featured__item__pic__hover" >
                            <li><a href="#"><i class="fa fa-shopping-cart " style="font-size: 24px;"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Chuối </a></h6>
                        <h5>80.000đ</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg">
                        <img src="../images/featured/feature-2.jpg"/>
                        <ul class="featured__item__pic__hover" >
                            <li><a href="#"><i class="fa fa-shopping-cart " style="font-size: 24px;"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Chuối </a></h6>
                        <h5>80.000đ</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg">
                        <img src="../images/featured/feature-2.jpg"/>
                        <ul class="featured__item__pic__hover" >
                            <li><a href="#"><i class="fa fa-shopping-cart " style="font-size: 24px;"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Chuối </a></h6>
                        <h5>80.000đ</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg">
                        <img src="../images/featured/feature-2.jpg"/>
                        <ul class="featured__item__pic__hover" >
                            <li><a href="#"><i class="fa fa-shopping-cart " style="font-size: 24px;"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Chuối </a></h6>
                        <h5>80.000đ</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg">
                        <img src="../images/featured/feature-2.jpg"/>
                        <ul class="featured__item__pic__hover" >
                            <li><a href="#"><i class="fa fa-shopping-cart " style="font-size: 24px;"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Chuối </a></h6>
                        <h5>80.000đ</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg">
                        <img src="../images/featured/feature-2.jpg"/>
                        <ul class="featured__item__pic__hover" >
                            <li><a href="#"><i class="fa fa-shopping-cart " style="font-size: 24px;"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Chuối </a></h6>
                        <h5>80.000đ</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg">
                        <img src="../images/featured/feature-2.jpg"/>
                        <ul class="featured__item__pic__hover" >
                            <li><a href="#"><i class="fa fa-shopping-cart " style="font-size: 24px;"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Chuối </a></h6>
                        <h5>80.000đ</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="../images/banner/banner-1.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="../images/banner/banner-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>Blog nổi bật</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="../images/blog/blog-1.jpg" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Cách ăn cam không bỏ vỏ</a></h5>
                        <p>Cách bỏ vỏ khi ăn cam </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="../images/blog/blog-2.jpg" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Cách ăn cam không bỏ vỏ</a></h5>
                        <p>Cách bỏ vỏ khi ăn cam </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="../images/blog/blog-3.jpg" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">VCách ăn cam không bỏ vỏ</a></h5>
                        <p>Cách bỏ vỏ khi ăn cam </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<hr>
<footer>
	<div class="container-fluid padding">	
		<div class="row text-center ">
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