<?php 
    session_start();
 
        
    include("DB.php");
    mysqli_query($connect,"SET NAMES 'utf8'");

    
$sql_loaisp = "select * from loaisp";
$query = mysqli_query($connect, $sql_loaisp);

	$sqlsp="select * from sanpham where id =".$_GET['idsp'];
    $querysp=mysqli_query($connect,$sqlsp);
    
    

    $sp=mysqli_fetch_assoc($querysp);
    $Luotxem= $sp['Luotxem']+1;
    $idsp = $_GET['idsp'];
    $updateluotxem  =mysqli_query($connect,"UPDATE `sanpham` SET `Luotxem` = '$Luotxem' WHERE `sanpham`.`id` = $idsp;");

    

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
    <LINK REL="SHORTCUT ICON" HREF="../images/Gonz.ico">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Chi tiết sản phẩm - GONZ</title>
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
       
.buttons_added {
    opacity:1;
    display:inline-block;
    display:-ms-inline-flexbox;
    display:inline-flex;
    white-space:nowrap;
    vertical-align:top;
}
.is-form {
    overflow:hidden;
    position:relative;
    background-color:#f9f9f9;
    height:2.2rem;
    width:1.9rem;
    padding:0;
    text-shadow:1px 1px 1px #fff;
    border:1px solid #ddd;
}
.is-form:focus,.input-text:focus {
    outline:none;
}
.is-form.minus {
    border-radius:4px 0 0 4px;
}
.is-form.plus {
    border-radius:0 4px 4px 0;
}
.input-qty {
    background-color:#fff;
    height:2.2rem;
    text-align:center;
    font-size:1rem;
    display:inline-block;
    vertical-align:top;
    margin:0;
    border-top:1px solid #ddd;
    border-bottom:1px solid #ddd;
    border-left:0;
    border-right:0;
    padding:0;
}
.input-qty::-webkit-outer-spin-button,.input-qty::-webkit-inner-spin-button {
    -webkit-appearance:none;
    margin:0;
}

              
            
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
                                    <li><a href="GioHang.php"><i class="fa fa-shopping-cart " style="font-size: 32px";></i> </a></li>
                                    </ul>
                                </div>
                            </div>
                          
                            <div class="header__top__right__auth" >
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
                <div class="col-md-4" >
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
<div class="row">
    <div class="col-md-6" style="text-align: center;">
    <img  style="width:500px" src="../images/Sanpham/<?php echo $sp['Linkanh']; ?>">
    </div>
    <div class="col-md-6">
        
            <h4 class="card-title" style="color:#000; margin-top:40px;font-size:32px"><b><?php echo $sp['Tensp']; ?></b></h4>
            <p style="font-size: 26px; color:#000">Giá: <?php echo number_format($sp['Giasp']) . "đ"; ?></p>
          
                
    <div class="buttons_added">
        <p style="font-size: 26px; color:#000">Số lượng: &nbsp;&nbsp;</p>
  <input class="minus is-form" type="button" value="-">
  <input aria-label="quantity" class="input-qty" max ="100" min="1" name="" type="number" value="1"  id="SLSP">
  <input class="plus is-form" type="button" value="+">
            
            
</div>

    <li><button style="background-color: #fabbbb; padding: 10px" id="add"><a  style="font-size: 24px;"><i class="fa fa-cart-plus " style="font-size: 24px;"></i> Thêm vào giỏ hàng</a></button></li>
       
    
    
    
    </div>
</div>

<script>
            $(document).ready(function() {
                    
                    $("#add").click(function() {
                      
                      
                        <?php 
                        if (!isset($_SESSION["Sdt"])){
                            echo "alert(\"Bạn phải đăng nhập!\");";
                        }
                        else{
                            ?>
                            var url = "ajaxThemGioHang.php?Sl=" + $("#SLSP").val();
                            
                            //$("#test").load("ajaxThemGioHang.php");
                           $.get(url,{Sdt: "<?php echo $_SESSION['Sdt']; ?> ",idsp:" <?php echo $idsp ;?>",Giasp:"<?php echo $sp['Giasp'] ;?>"});
                            <?php 
                            echo "alert(\"Thêm vào giỏ hàng thành công!\")";
                           
                        }
                        ?>
                   }          
                    
                )
            }

            )
        </script>

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
<script>//<![CDATA[
$('input.input-qty').each(function() {
  var $this = $(this),
    qty = $this.parent().find('.is-form'),
    min = Number($this.attr('min')),
    max = Number($this.attr('max'))
  if (min == 0) {
    var d = 0
  } else d = min
  $(qty).on('click', function() {
    if ($(this).hasClass('minus')) {
      if (d > min) d += -1
    } else if ($(this).hasClass('plus')) {
      var x = Number($this.val()) + 1
      if (x <= max) d += 1
    }
    $this.attr('value', d).val(d)
  })
})


$('#SLSP').change(function(){
    if ($('#SLSP').val() <1){
        $('#SLSP').val(1);
    }
    else if ($('#SLSP').val()>100){
        $('#SLSP').val(100);
    }
});
//]]></script>
</body>
</html>	

