<?php 
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    $timestamp = time();
    $date = date("Y-m-d H:i:s", $timestamp);
    if(!isset($_SESSION['Sdt'])){
       
		header('location:../DangNhap.php');
	}
    if (isset($_SESSION["Vaitro"])){
        if ($_SESSION['Vaitro']=="0"){
            header('location:../TrangChu.php');
        }
        
    }
    include("../DB.php");
    mysqli_query($connect,"SET NAMES 'utf8'");
    

    
    $Layiddh = $_GET['iddm'];
    $sql = mysqli_query($connect,"SELECT * FROM `donmua` where id = '$Layiddh'");
    
    
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    
    <LINK REL="SHORTCUT ICON" HREF="../../images/Gonz.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>PrintBill - GONZ</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">       
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="../../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    </head>
    <body>



<div style="text-align: center;">
    <img src="../../images/Gonz.png" alt="" width="250px" height="250px">
</div>
<div style="text-align:center;">
<p style="font-size: 18px;margin-left:20px">280 ADV, phường 4, quận 5, Thành phố Hồ Chí Minh</p>
<p style="font-size: 18px;margin-left:20px">SĐT: 0977-4090-60</p>
<p style="font-size: 18px;margin-left:20px">Email: gonz@gmail.com</p>
<p style="font-size: 18px;margin-left:20px">Website: gonz.epizy.com</p>

</div>
    <table style="margin: 0 auto;padding:10px;width:90%"> 
        
       
        <tr>
           
           <td style="padding:15px">

           <div style="text-align: center;">
            <p style="font-size: 32px;margin-left:20px" ><b>HÓA ĐƠN BÁN HÀNG</b> </p>
           </div>
           <div>

           </div>
          
           <div>
           <?php

while($dong_sp=mysqli_fetch_assoc($sql)){

   

    $idDM =  $dong_sp['id'] ;
?>
<div>
              <table style="width:90%; margin: 0 auto">
                  <tr>
                      <td>
                          <p style="font-size:22px"><b>Tên người nhận:</b> <?php echo $dong_sp['Tenngnhan'] ?></p>
<p style="font-size:22px"><b>Số điện thoại người nhận:</b> <?php echo $dong_sp['Sdtngnhan'] ?></p>
<p style="font-size:22px"><b>Nơi nhận hàng:</b> <?php echo $dong_sp['Diachingnhan'] ?></p>
<p style="font-size:18px"><b>*Ghi chú của khách hàng:</b> <?php echo $dong_sp['Ghichu'] ?></p>
                      </td>
                  </tr>
              </table>
          </div>
          <hr>
<div>
              <table style="width:90%; margin: 0 auto">
                  <tr>
                      <td>
                        <p style="font-size: 22px;">Ngày xuất hóa đơn: <?php echo $date ?></p>
                      </td>
                  </tr>
                  <tr>
                      <td style="width:50%"><p style="font-size: 22px;">Tên nhân viên: <?php echo $_SESSION['Tentk'] ?></p></td>
                      <td style="width:50%;text-align:right"><p style="font-size: 22px;;">Số hóa đơn: <?php echo $Layiddh ?> </p> </td>
                  </tr>
                  <tr>
                      <td  style="width:50%">
                          <p  style="font-size:22px">Đặt hàng lúc: <?php echo $dong_sp['Tgdathang'] ?> </p>
                          
                      </td>
                      <td style="width:50%;text-align:right">
                          <p  style="font-size:22px">Giao hàng lúc: <?php if ($dong_sp['Tgiangiao']==NULL) {echo " ";} else{ echo $dong_sp['Tgiangiao'];} ?>  </p>
                      </td>
                  </tr>

              </table>
          </div>
<hr>

<div style="width:90%;padding:20px;margin:30px;">





<div id="chitiet<?php echo $dong_sp['id'] ?>">

<div class="row">
<div class="col-lg-12">
<div class="shoping__cart__table">
<table style="margin: 0 auto">
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

<table style="width:100%; margin: 0 auto">
    <tr>
        <td style="width:50%">
        <p style="font-size:22px"><b>Tổng tiền: </b></p>
        </td>
        <td style="width:50%;text-align:right">
        <p style="font-size:22px"><b> <?php echo number_format($dong_sp['Tongtien'])."Đ"  ?></b></p>
        </td>
    </tr>
    <tr>
        <td style="width:50%">
        <p style="font-size:22px"><b>Giảm giá:</b></p>
        </td>
        <td style="width:50%;text-align:right">
        <p style="font-size:22px"><b> <?php echo number_format($dong_sp['GiamGia'])."Đ"  ?></b></p>
        </td>
    </tr>
    <tr>
        <td style="width:50%">
        <p style="font-size:22px"><b>Sau khi giảm giá: </b></p>
        </td>
        <td style="width:50%;text-align:right">
        <p style="font-size:22px"><b><?php echo number_format($dong_sp['Tongtien']-$dong_sp['GiamGia'])."Đ"  ?></b></p>
        </td>
    </tr>
</table>
<br><br>
<div style="text-align:center">
<p style="font-size:22px"><b><i>Chúc quý khách vui vẻ, hẹn gặp lại!</i> </b></p>
</div>


</div>

</div>
<?php } ?>
<!---/////////////////////////-->
           </div>
           
           </td>
        </tr>
    </table>


    <script>
        window.print();
    </script>
    </body>
</html>
