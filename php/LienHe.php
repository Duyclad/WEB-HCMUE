<?php 
    session_start();
 
        
    include("DB.php");
    mysqli_query($connect,"SET NAMES 'utf8'");

    $sql_loaisp="select * from loaisp";
    $query=mysqli_query($connect,$sql_loaisp);

    if (isset($_POST['submit'])){
        $Ten = mysqli_real_escape_string($connect,$_POST['yourname']);
        $Email = mysqli_real_escape_string($connect,$_POST['email']);
        $Tieude= mysqli_real_escape_string($connect,$_POST['title']);
        $Noidung = mysqli_real_escape_string($connect,$_POST['ndung']);
        date_default_timezone_set("Asia/Bangkok");
        $timestamp = time();
        $date = date("Y-m-d H:i:s", $timestamp);
        if ($Ten =="" || $Email =="" || $Tieude =="" || $Noidung == "" ){
            echo '<script language="javascript">';
                        echo 'alert("Bạn chưa nhập đủ tất cả thông tin!")';
                        echo '</script>';
        }
        else{
          $result=mysqli_query($connect,"INSERT INTO `phanhoi` (`Ten`, `Email`, `Tieude`,`Noidung`,Ngayphanhoi) VALUES ('$Ten', '$Email', '$Tieude','$Noidung','$date');") ;

        echo '<script language="javascript">';
                        echo 'alert("Nội dung của bạn đã được gửi!")';
                        echo '</script>';  
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
	<title>Liên Hệ - GONZ</title>
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
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Liên hệ với chúng tôi</h2>
                </div>
            </div>
        </div>
        <form action="LienHe.php" method="POST">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <input type="text" placeholder="Tên của bạn" name="yourname" id="name" maxlength="50">
                </div>
                <div class="col-lg-6 col-md-6">
                    <input type="text" placeholder="Email" name="email" id="email" maxlength="100">
                </div>
                <div class="col-lg-12 col-md-12">
                    <input type="text" placeholder="Tiêu đề" name="title" id="Tieude" maxlength="50">
                </div>
                <div class="col-lg-12 text-center">
                    <textarea placeholder="Nội dung" name="ndung" id="Noidung" maxlength="2000"></textarea>
                    <b style="font-size: 24px;" id="123"></b><br>
                    <button type="submit" class="site-btn" name="submit" id="submit">Phản hồi</button>
                </div>
            </div>
        </form>
    </div>
</div><hr>
<script type="text/javascript"> 
$('#submit').attr('disabled','disabled');
$('#submit').css("background-color", "#999");
$('#email').change(function(){
    if ($('#name').val() =="" || $('#email').val()=="" || $('#Tieude')=="" || $('#Noidung').val()==""){
        $('#123').html("Chưa nhập đủ nội dung!");
             $('#submit').attr('disabled','disabled');
            $('#submit').css("background-color", "#999");
    }
    else {
        var email = document.getElementById('email'); 
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
    if (!filter.test(email.value)) { 
             $('#123').html("Email không hợp lệ!");
             $('#submit').attr('disabled','disabled');
            $('#submit').css("background-color", "#999");
             email.focus; 
             return false; 
    }
    else{ 
        $('#123').html("")
            $('#submit').removeAttr('disabled');
        $('#submit').css("background-color", "#f727c3");
    } 
    }
    
});

$('#name').change(function(){
    if ($('#name').val() =="" || $('#email').val()=="" || $('#Tieude')=="" || $('#Noidung').val()==""){
        $('#123').html("Chưa nhập đủ nội dung!");
             $('#submit').attr('disabled','disabled');
            $('#submit').css("background-color", "#999");
    }
    else {
        var email = document.getElementById('email'); 
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
    if (!filter.test(email.value)) { 
             $('#123').html("Email không hợp lệ!");
             $('#submit').attr('disabled','disabled');
            $('#submit').css("background-color", "#999");
             email.focus; 
             return false; 
    }
    else{ 
        $('#123').html("")
            $('#submit').removeAttr('disabled');
        $('#submit').css("background-color", "#f727c3");
    } 
    }
    
});
$('#Tieude').change(function(){
    if ($('#name').val() =="" || $('#email').val()=="" || $('#Tieude')=="" || $('#Noidung').val()==""){
        $('#123').html("Chưa nhập đủ nội dung!");
             $('#submit').attr('disabled','disabled');
            $('#submit').css("background-color", "#999");
    }
    else {
        var email = document.getElementById('email'); 
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
    if (!filter.test(email.value)) { 
             $('#123').html("Email không hợp lệ!");
             $('#submit').attr('disabled','disabled');
            $('#submit').css("background-color", "#999");
             email.focus; 
             return false; 
    }
    else{ 
        $('#123').html("")
            $('#submit').removeAttr('disabled');
        $('#submit').css("background-color", "#f727c3");
    } 
    }
    
});
$('#Noidung').change(function(){
    if ($('#name').val() =="" || $('#email').val()=="" || $('#Tieude')=="" || $('#Noidung').val()==""){
        $('#123').html("Chưa nhập đủ nội dung!");
             $('#submit').attr('disabled','disabled');
            $('#submit').css("background-color", "#999");
    }
    else {
        var email = document.getElementById('email'); 
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
    if (!filter.test(email.value)) { 
             $('#123').html("Email không hợp lệ!");
             $('#submit').attr('disabled','disabled');
            $('#submit').css("background-color", "#999");
             email.focus; 
             return false; 
    }
    else{ 
        $('#123').html("")
            $('#submit').removeAttr('disabled');
        $('#submit').css("background-color", "#f727c3");
    } 
    }
    
});

</script>
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


