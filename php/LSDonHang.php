<?php 
    session_start();

    if (isset($_SESSION["Vaitro"])){
        if ($_SESSION['Vaitro']=="1"){
            header('location:./staff/staff.php');
        }
        else if ($_SESSION['Vaitro']=="2"){
            header('location:./admin/admin.php');
        }
    }

	if(!isset($_SESSION['Sdt'])){
       
		header('location:DangNhap.php');
	}
    $item_per_page =  !empty($_GET['per_page']) ? $_GET['per_page'] : 10;
    $tranghientai = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($tranghientai - 1) * $item_per_page;

    date_default_timezone_set("Asia/Bangkok");
        $timestamp = time();
        $datehour = date("H", $timestamp);
        $datemin = date("i", $timestamp);

    include("DB.php");
    mysqli_query($connect,"SET NAMES 'utf8'");
    $sql_loaisp="select * from loaisp";
    $query=mysqli_query($connect,$sql_loaisp);
    $Sdt = $_SESSION['Sdt'];
   

            if (isset($_POST['submit'])){
                $phut = $_POST['phut'];
                $gio = $_POST['gio'];
                $iddm = $_POST['iddm'];
                if ($datehour==$gio && $datemin <= $phut+5){
                    $upDM = mysqli_query($connect,"UPDATE `donmua` SET `Trangthai` = 'Đã hủy' WHERE `donmua`.`id` = '$iddm';");
                    echo '<script language="javascript">';
                    echo 'alert("Hủy đơn hàng thành công!")';
                    echo '</script>';
                }
                else if ($datehour==$gio+1 && $datemin+60 <= $phut+5){
                    $upDM = mysqli_query($connect,"UPDATE `donmua` SET `Trangthai` = 'Đã hủy' WHERE `donmua`.`id` = '$iddm';");
                    echo '<script language="javascript">';
                    echo 'alert("Hủy đơn hàng thành công!")';
                    echo '</script>';
                }
                else {
                    echo '<script language="javascript">';
                    echo 'alert("Không thể hủy đơn hàng vì đã quá thời gian cho phép!")';
                    echo '</script>';
                }
            }

            $truyvan ="SELECT * FROM `donmua` where Sdt = '$Sdt' order by id desc limit " . $item_per_page . " offset ". $offset;
            $donhang=mysqli_query($connect,$truyvan);   
            $donhangx = mysqli_query($connect,"SELECT * FROM `donmua` where Sdt = '$Sdt'");
            $totalsp = $donhangx->num_rows;

        $totalpage = ceil($totalsp / $item_per_page);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <LINK REL="SHORTCUT ICON" HREF="../images/Gonz.ico">
	<title>Lịch sử đơn hàng - GONZ</title>
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
<hr>
<h3 style="text-align: center;">LỊCH SỬ MUA HÀNG</h3>
<?php 
    if ($totalsp=="0"){
        echo "<h3 style=\"text-align:left;padding-left:50px\">Bạn chưa có đơn hàng nào!</h3>";
    }
?>
<?php

							  while($dong_sp=mysqli_fetch_assoc($donhang)){

                                  $timex = $dong_sp['Tgdathang'];
                                  
                                  
                                  $time_stampmin = date("i", strtotime($timex));
                                  $time_stamphour = date("H", strtotime($timex));
                                  
                                  
                              
                              
                                  $idDM =  $dong_sp['id'] ;
                              ?>
                              
    <div style="width:90%;border-radius:15px;padding:20px;margin:30px;border:3px solid;border-color:#fabbbb">
    <?php 
        if ($datehour==$time_stamphour && $datemin <= $time_stampmin+5 && $dong_sp['Trangthai'] != "Đã hủy"){
            ?>
            <form action="LSDonHang.php" method="POST">
                <input type="text"  name="phut" id="phut<?php echo $idDM ?>" value="<?php echo $time_stampmin ?>"/>
                <input type="text"  name="gio" id="gio<?php echo $idDM ?>" value="<?php echo $time_stamphour ?>"/>
                <input type="text"  name="iddm" id="iddm<?php echo $idDM ?>" value="<?php echo $idDM ?>"/>
                
                <button type="button" name="submit2" id="submit2<?php echo $idDM ?>" style="color: red" >[Hủy đơn hàng]</button>
                <button type="submit" name="submit" id="submit1<?php echo $idDM ?>" style="color: red" >[Hủy đơn hàng]</button>
                <p>*Bạn có thể hủy đơn hàng trong vòng 5 phút kể từ lúc đặt hàng!</p>
                <script>
                    $('#phut<?php echo $idDM ?>').hide();
                    $('#gio<?php echo $idDM ?>').hide();
                    $('#iddm<?php echo $idDM ?>').hide();

                    $('#submit1<?php echo $idDM ?>').hide();
                    $('#submit2<?php echo $idDM ?>').click(function(){
                        if (confirm("Bạn có chắc muốn xóa đơn hàng này?")) {
                            $('#submit1<?php echo $idDM ?>').click();
                        }
                        else{}
                    });
                    
                </script>
                <hr>

            </form>
            <?php
        }
        else if ($datehour==$time_stamphour+1 && $datemin+60 <= $time_stampmin+5 &&$dong_sp['Trangthai']!="Đã hủy"){
            ?>
                <form action="LSDonHang.php" method="POST">
                <input type="text"  name="phut" id="phut" value="<?php echo $time_stampmin ?>"/>
                <script>
                    $('#phut').hide();
                </script>
                <button type="submit" name="submit" id="submit" style="color: red" >[Hủy đơn hàng]</button>
                <p>*Bạn có thể hủy đơn hàng trong vòng 5 phút kể từ lúc đặt hàng!</p>
                <hr>
            </form>
            <?php
        }
    ?>
    <p style="font-size:22px"><b>Mã đơn hàng:</b> <?php echo $idDM ?></p>
    <p style="font-size:22px"><b>Đặt hàng lúc:</b> <?php echo $dong_sp['Tgdathang'] ?> - Giao hàng lúc: <?php if ($dong_sp['Tgiangiao']==NULL) {echo " ";} else{ echo $dong_sp['Tgiangiao'];} ?> - Trạng thái đơn hàng:  <?php if ($dong_sp['Trangthai']=="Đang chuẩn bị"){ echo "<b style={\"color:yellow\"}>".$dong_sp['Trangthai']."</b>";} else if ($dong_sp['Trangthai']=="Đang giao"){ echo "<b style={\"color:blue\"}>".$dong_sp['Trangthai']."</b>";} else if ($dong_sp['Trangthai']=="Đã giao"){ echo "<b style={\"color:green\"}>".$dong_sp['Trangthai']."</b>";} else { echo "<b style={\"color:red\"}>".$dong_sp['Trangthai']."</b>";} ?></p>
    <p style="font-size:22px"><b>Tên người nhận:</b> <?php echo $dong_sp['Tenngnhan'] ?></p>
    <p style="font-size:22px"><b>Số điện thoại người nhận:</b> <?php echo $dong_sp['Sdtngnhan'] ?></p>
    <p style="font-size:22px"><b>Nơi nhận hàng:</b> <?php echo $dong_sp['Diachingnhan'] ?></p>
    <p style="font-size:18px"><b>*Ghi chú của bạn:</b> <?php echo $dong_sp['Ghichu'] ?></p>
    <div id="chitiet<?php echo $dong_sp['id'] ?>">
    
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
      <?php  $ttdonhang = mysqli_query($connect,"SELECT * FROM `thongtindonhang` where idDonmua = '$idDM'");
        while($dong_spx=mysqli_fetch_assoc($ttdonhang)){
      ?>

<tr >
                                            <td class="shoping__cart__item">
                                                
                                                <h5><?php echo $dong_spx['Tensp'] ?></h5>
                                            </td>
                                            <td class="shoping__cart__price" >
                                                <?php echo number_format($dong_spx['Dongia']) . "đ"; ?>
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty" style="width:130px">
                                                        
                                                        <input aria-label="quantity" class="input-qty" min="1" name="" readonly="true" type="number" value="<?php echo $dong_spx['Sl'] ?>"  style="width:40px">
                                                        
                                                    </div>
                                                </div>
                                            </td>




                                            <td class="shoping__cart__total" >
                                            <?php echo number_format($dong_spx['Thanhtien']) . "đ"; ?>
                                            </td>




        <?php } ?>
        </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </div>
<p style="font-size:22px"><b>Tổng tiền: <?php echo number_format($dong_sp['Tongtien'])."Đ"  ?></b></p>
<p style="font-size:22px"><b>Giảm giá: <?php echo number_format($dong_sp['GiamGia'])."Đ"  ?></b></p>
<p style="font-size:22px"><b>Sau khi giảm giá: <?php echo number_format($dong_sp['Tongtien']-$dong_sp['GiamGia'])."Đ"  ?></b></p>

<p id="xemct<?php echo $dong_sp['id'] ?>">(Xem chi tiết)</p>
</div>
<script>
    $('#chitiet<?php echo $dong_sp['id'] ?>').hide();
    
    $('#xemct<?php echo $dong_sp['id'] ?>').click(function(){
        if ($('#xemct<?php echo $dong_sp['id'] ?>').html()=="(Xem chi tiết)"){
            $('#chitiet<?php echo $dong_sp['id'] ?>').show();
        $('#xemct<?php echo $dong_sp['id'] ?>').html("(Thu gọn)");
    }
    else {
        $('#chitiet<?php echo $dong_sp['id'] ?>').hide();
        $('#xemct<?php echo $dong_sp['id'] ?>').html("(Xem chi tiết)");
    }
        
    });
</script>
                              <?php } ?>

                              <div style="margin: 20px;text-align:center">
        <?php
        if ($tranghientai > 3) {
            echo "<a href=\"?per_page=" . $item_per_page . "&page=1\" style=\"border: 1px solid;margin:5px;font-size: 24px;padding:10px\">Trang đầu</a>";
        }
        if ($tranghientai > 1) {
            echo "<a href=\"?per_page=" . $item_per_page ."&page= " . ($tranghientai - 1) . "\" style=\"border: 1px solid;margin:5px;font-size: 24px;padding:10px\">Trang trước</a>";
        }

        for ($i = 1; $i <= $totalpage; $i++) {

            if ($i != $tranghientai) {
                if ($i > $tranghientai - 3 && $i < $tranghientai + 3) {
                    echo "<a href=\"?per_page=" . $item_per_page . "&page=" . $i . "\" style=\"border: 1px solid;margin:5px;font-size: 24px;padding:10px\">$i</a>";
                }
            } else {
                echo "<b><a href=\"?per_page=" . $item_per_page . "&page=" . $i . "\" style=\"border: 1px solid;font-size: 24px;margin:5px;background: lightblue;;padding:10px\">$i</a></b>";
            }
        }
        if ($tranghientai < $totalpage) {
            echo "<a href=\"?per_page=" . $item_per_page ."&page= " . ($tranghientai + 1) . "\" style=\"border: 1px solid;margin:5px;font-size: 24px;padding:10px\">Trang sau</a>";
        }
        if ($tranghientai < $totalpage - 2) {
            echo "<a href=\"?per_page=" . $item_per_page ."&page= " . $totalpage . "\" style=\"border: 1px solid;margin:5px;font-size: 24px;padding:10px\">Trang cuối</a>";
        }

        ?>

    </div>
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


