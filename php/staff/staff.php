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
    $item_per_page =  !empty($_GET['per_page']) ? $_GET['per_page'] : 20;
    $tranghientai = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($tranghientai - 1) * $item_per_page;
    

    if (isset($_POST['submit'])){
        $layid = $_GET['idDM'];
        $Trangthai = $_POST['Trangthai'];

        $upd = mysqli_query($connect,"UPDATE `donmua` SET `Trangthai` = '$Trangthai' WHERE `donmua`.`id` = '$layid';");
        if ($Trangthai=="Đã giao"){
            $upd = mysqli_query($connect,"UPDATE `donmua` SET `Tgiangiao` = '$date' WHERE `donmua`.`id` = '$layid';");
            
            $Layhang = mysqli_query($connect,"select idSP,Sl from thongtindonhang where idDonmua = '$layid'");
            while ($hihi = mysqli_fetch_assoc($Layhang)){
                $idspk = $hihi['idSP'];
                $slk = $hihi['Sl'];
                $Layspham = mysqli_query($connect,"select Luotmua from `sanpham` WHERE `sanpham`.`id` = '$idspk';");
                $haha = mysqli_fetch_assoc($Layspham);
                $Slk = $slk +$haha['Luotmua'];
                $TLM = mysqli_query($connect,"UPDATE `sanpham` SET `Luotmua` = '$Slk' WHERE `sanpham`.`id` = '$idspk';");
                
            }
        }
    }
    $menu = !empty($_GET['menu']) ? $_GET['menu'] : 1;
    if ($menu=="1"){
        $sqlx = mysqli_query($connect,"SELECT * FROM `donmua` where Trangthai = 'Đang chuẩn bị'");
        $sql = mysqli_query($connect,"SELECT * FROM `donmua` where Trangthai = 'Đang chuẩn bị' order by id asc limit ".$item_per_page." offset ".$offset);
        $sodong = $sqlx -> num_rows;
       
        
        $totalpage = ceil($sodong / $item_per_page);
    }
    else if ($menu=="2"){
        $sqlx = mysqli_query($connect,"SELECT * FROM `donmua` where Trangthai = 'Đang giao'");
        $sql = mysqli_query($connect,"SELECT * FROM `donmua` where Trangthai = 'Đang giao' order by id asc limit ".$item_per_page." offset ".$offset);
        $sodong = $sqlx -> num_rows;
       
       
        $totalpage = ceil($sodong / $item_per_page);
    }
    else if ($menu=="3"){
        $sqlx = mysqli_query($connect,"SELECT * FROM `donmua` where Trangthai = 'Đã giao'");
        $sql = mysqli_query($connect,"SELECT * FROM `donmua` where Trangthai = 'Đã giao' order by id desc limit ".$item_per_page." offset ".$offset);
        $sodong = $sqlx -> num_rows;
       
      
        $totalpage = ceil($sodong / $item_per_page);
    }
    else if ($menu=="4"){
        $sqlx = mysqli_query($connect,"SELECT * FROM `donmua` where Trangthai = 'Đã hủy'");
        $sql = mysqli_query($connect,"SELECT * FROM `donmua` where Trangthai = 'Đã hủy' order by id desc limit ".$item_per_page." offset ".$offset);
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
	<title>Nhân viên - GONZ</title>
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
    <p>Xin chào <?php echo $_SESSION['Tentk'] ?></p>
    <form method="POST" action="../TrangChu.php"><button name="btnThoat"> (Đăng xuất)</button></form>



    <table style="border:1px solid;padding:10px;width:100%"> 
        <tr style="text-align: center;font-size:40px"><td colspan="2"><b>TRANG QUẢN LÝ ĐƠN HÀNG GONZ</b></td></tr>
        <tr style="text-align: center;"><td style="border:1px solid;padding:10px;width:100%" colspan="2" ><div style="padding: 15px;font-size:25px">
        <a href="?menu=1" style="font-size: 24px;">Đơn hàng mới</a> <b>-</b>
        <a href="?menu=2" style="font-size: 24px;">Đang giao</a> <b>-</b>
        <a href="?menu=3" style="font-size: 24px;">Đã giao</a> <b>-</b>
        <a href="?menu=4" style="font-size: 24px;">Đã hủy</a>
        
    </div></td></tr>
        <tr>
           
           <td style="padding:15px">

           <div style="text-align: center;">
            <p style="font-size: 32px;margin-left:20px"><?php 
            if ($menu=="1"){
                echo "ĐƠN HÀNG MỚI";
            }
            else if ($menu=="2"){
                echo "ĐANG GIAO";
            }
            else if ($menu=="3"){
                echo "ĐÃ GIAO";
            }
            else if ($menu=="4"){
                echo "ĐÃ HỦY";
            }
            
            ?></p>
           </div>
           <div>
           <?php

while($dong_sp=mysqli_fetch_assoc($sql)){

   

    $idDM =  $dong_sp['id'] ;
?>


<hr>
<div style="width:90%;border-radius:15px;padding:20px;margin:30px;border:3px solid;border-color:#fabbbb">

<button id="inhd<?php echo $idDM ?>"><a href="printbill.php?iddm=<?php echo $idDM ?> " target="_blank" style="font-size:22px">[In hóa đơn]</a></button>

<form method="POST" action="?menu=<?php echo $menu ?>&idDM=<?php echo $idDM ?> " >
    <p style="font-size:22px">* Trạng thái đơn hàng: 
    <select name="Trangthai" id="Trangthai">
        <option value="Đang chuẩn bị" <?php if ($dong_sp['Trangthai']=="Đang chuẩn bị" ) {echo "selected";} ?>>Đang chuẩn bị</option>
        <option value="Đang giao" <?php if ($dong_sp['Trangthai']=="Đang giao" ) {echo "selected";} ?>>Đang giao</option>
        <option value="Đã giao" <?php if ($dong_sp['Trangthai']=="Đã giao" ) {echo "selected";} ?>>Đã giao</option>
        <option value="Đã hủy" <?php if ($dong_sp['Trangthai']=="Đã hủy" ) {echo "selected";} ?>>Đã hủy</option>
    </select>
    
    <button type="submit" name="submit" id="submit1<?php echo $idDM ?>" style="color: red" >LƯU</button>
</p>
</form>

<p style="font-size:22px">Mã đơn hàng: <?php echo $idDM ?></p>
<p style="font-size:22px">Đặt hàng lúc: <?php echo $dong_sp['Tgdathang'] ?> - Giao hàng lúc: <?php if ($dong_sp['Tgiangiao']==NULL) {echo " ";} else{ echo $dong_sp['Tgiangiao'];} ?> </p>
<p style="font-size:22px"><b>Tên người nhận:</b> <?php echo $dong_sp['Tenngnhan'] ?></p>
<p style="font-size:22px"><b>Số điện thoại người nhận:</b> <?php echo $dong_sp['Sdtngnhan'] ?></p>
<p style="font-size:22px"><b>Nơi nhận hàng:</b> <?php echo $dong_sp['Diachingnhan'] ?></p>
<p style="font-size:18px"><b>*Ghi chú của khách hàng:</b> <?php echo $dong_sp['Ghichu'] ?></p>

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
</div>
<?php } ?>
<!---/////////////////////////-->
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