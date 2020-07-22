<?php 
    session_start();

    

	if(!isset($_SESSION['Sdt'])){
       
		header('location:DangNhap.php');
	}



    include("DB.php");
    mysqli_query($connect,"SET NAMES 'utf8'");

    $sql_loaisp="select * from loaisp";
    $query=mysqli_query($connect,$sql_loaisp);
    if (isset($_POST['submit'])){
        if($_POST['password'] == "" && $_POST['new_password']=="" && $_POST['re_password']==""){
            $Sdt = mysqli_real_escape_string($connect,$_POST['phone']);
                    $Tentk = mysqli_real_escape_string($connect,$_POST['name']);

                    $Diachi = mysqli_real_escape_string($connect,$_POST['address']);

            $update = mysqli_query($connect,"UPDATE `taikhoan` SET `Tentk` = '$Tentk', `Diachi` = '$Diachi' WHERE `taikhoan`.`Sdt` = '$Sdt'");

            $check = mysqli_query($connect,"SELECT * FROM `taikhoan` where Sdt='$Sdt'");
            $row = mysqli_fetch_array($check);
            $_SESSION["Sdt"]= $row['Sdt'];
                        $_SESSION["Tentk"]= $row['Tentk'];
                        $_SESSION["Diachi"]= $row['Diachi'];
                        $_SESSION["Vaitro"]= $row['Vaitro'];
                        echo '<script language="javascript">';
                        echo 'alert("Cập nhật thành công!")';
                        echo '</script>';
        }
        else if (($_POST['password'] != "" || $_POST['new_password'] !="" || $_POST['re_password'] !="") && ($_POST['password'] == "" || $_POST['new_password']=="" || $_POST['re_password']=="")){
            echo '<script language="javascript">';
                        echo 'alert("Bạn chưa nhập đầy đủ mật khẩu!")';
                        echo '</script>';
        }
        else if($_POST['new_password'] != $_POST['re_password']){
            echo '<script language="javascript">';
                        echo 'alert("Mật khẩu mới không trùng khớp!")';
                        echo '</script>';
        }
        else{
            $Sdt = mysqli_real_escape_string($connect,$_POST['phone']);
                    $Tentk = mysqli_real_escape_string($connect,$_POST['name']);

                    $Diachi = mysqli_real_escape_string($connect,$_POST['address']);
                    $Matkhau = mysqli_real_escape_string($connect,$_POST['password']);
                    $newMatkhau = mysqli_real_escape_string($connect,$_POST['new_password']);
                    $Matkhau = md5($Matkhau);
                    $newMatkhau = md5($newMatkhau);

                    $check = mysqli_query($connect,"SELECT * FROM `taikhoan` where Sdt='$Sdt' and Matkhau='$Matkhau'");

                    if($check->num_rows > 0 ){
$update = mysqli_query($connect,"UPDATE `taikhoan` SET `Tentk` = '$Tentk', `Diachi` = '$Diachi' , Matkhau = '$newMatkhau' WHERE `taikhoan`.`Sdt` = '$Sdt'");

                        $recheck = mysqli_query($connect,"SELECT * FROM `taikhoan` where Sdt='$Sdt'");
            $row = mysqli_fetch_array($recheck);
            $_SESSION["Sdt"]= $row['Sdt'];
                        $_SESSION["Tentk"]= $row['Tentk'];
                        $_SESSION["Diachi"]= $row['Diachi'];
                        $_SESSION["Vaitro"]= $row['Vaitro'];

                        echo '<script language="javascript">';
                        echo 'alert("Cập nhật thành công!")';
                        echo '</script>';
                    }
                    else {
                        echo '<script language="javascript">';
                        echo 'alert("Mật khẩu hiện tại của bạn không đúng!")';
                        echo '</script>';
                    }


            

            
        }
    }
    if (isset($_SESSION["Vaitro"])){
        if ($_SESSION['Vaitro']=="1"){
            header('location:./staff/staff.php');
        }
        else if ($_SESSION['Vaitro']=="2"){
            header('location:./admin/admin.php');
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <LINK REL="SHORTCUT ICON" HREF="../images/Gonz.ico">
	<title>Thông tin tài khoản - GONZ</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">       
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">  
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="../css/style.css" rel="stylesheet">
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
                <div class="col-lg-4" >
                    <div class="hero__search" >
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
<div class="main">

    <section class="signup">
       
        <div class="container">
            <div class="signup-content">
                              <div style="text-align:right">
                                   <a href="LSDonHang.php"><button style="border:1px solid; background-color:#f727c3;color:white;padding:5px;border-radius:10px ">Lịch sử mua hàng</button></a>
                              </div>
               
                <form method="POST" id="signup-form" class="signup-form" action="EditInfo.php">
                    <h2 class="form-title" style="margin-bottom: 20px;">Thông tin tài khoản</h2>
                    <div class="form-group">
                        <input type="text" class="form-input" name="name" maxlength="100" id="name" placeholder="Họ và tên" value="<?php echo $_SESSION["Tentk"]?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" name="phone" id="phone" maxlength="15" placeholder="Số điện thoại" value="<?php echo $_SESSION["Sdt"]?>" readonly="true"/>
                    </div>
                 
                    <div class="form-group">
                        <input type="text" class="form-input" name="address" maxlength="200" id="address" placeholder="Địa chỉ" value="<?php echo $_SESSION["Diachi"]?>"/>
                    </div>
                    <h3 style="margin-bottom: 10px;">Đổi mật khẩu</h3>
                    <div class="form-group">
                        <input type="text" class="form-input" name="password" id="password" placeholder="Mật khẩu hiện tại" maxlength="200"/>
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" maxlength="200" name="new_password" id="new_password" placeholder="Mật khẩu mới"/>
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" maxlength="200" name="re_password" id="re_password" placeholder="Nhập lại mật khẩu mới"/>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="form-submit" value="Xác nhận thay đổi"/>
                    </div>
                </form>
                
            </div>
        </div>
    </section>

</div><hr>
  
<footer>
	<div class="container-fluid padding">	
		<div class="row text-center ">
			<div class="col-md-4" >
				<img src="../images/Gonz.png" width=" 50" height="50">
				
				<p>0977-4090-00</p>
                <p>mymail@gmail.com</p>
                <p><a href="https://www.facebook.com/GONZ-108189827644660" target="_blank"><i class="fa fa-facebook-square" style="font-size: 19px;color:white"> Facebook </i></a></p>
				<p>280 ADV, phường 4, quận 5, Thành phố Hồ Chí Minh</p>
			</div>
			<div class="col-md-4">				
				<hr class="light"  style="width:100%">
				<h3>Giờ làm việc</h3>
				<hr class="light"  style="width:100%">
				<p>Thứ 2 - Thứ 7: 7h-22h</p>
				<p>Cuối tuần: 7h-19h</p>
			</div>
            <div class="col-md-4" >
           			
				<hr class="light" style="width:100%" >
				<h3>Dịch vụ</h3>
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


