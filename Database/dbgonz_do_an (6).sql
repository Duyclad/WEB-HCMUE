-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2020 at 09:14 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbgonz_do_an`
--

-- --------------------------------------------------------

--
-- Table structure for table `cuahang`
--

CREATE TABLE `cuahang` (
  `id` int(11) NOT NULL,
  `Tendc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Diachi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Codehtml` varchar(2000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cuahang`
--

INSERT INTO `cuahang` (`id`, `Tendc`, `Diachi`, `Codehtml`) VALUES
(1, 'Chi nhánh quận 5, TP.HCM', '280 ADV, phường 4, quận 5, Thành phố Hồ Chí Minh', '<div class=\"mapouter\"><div class=\"gmap_canvas\"><iframe width=\"600\" height=\"500\" id=\"gmap_canvas\" src=\"https://maps.google.com/maps?q=280%20an%20d%C6%B0%C6%A1ng%20v%C6%B0%C6%A1ng%20qu%E1%BA%ADn%205&t=&z=15&ie=UTF8&iwloc=&output=embed\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\"></iframe><a href=\"https://www.embedgooglemap.net\">embed google maps</a></div><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div>'),
(2, 'Chi nhánh Long An', 'TP.Tân An, Long An', '<div class=\"mapouter\"><div class=\"gmap_canvas\"><iframe width=\"600\" height=\"500\" id=\"gmap_canvas\" src=\"https://maps.google.com/maps?q=T%C3%A2n%20An%2C%20Long%20An&t=&z=17&ie=UTF8&iwloc=&output=embed\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\"></iframe><a href=\"https://www.embedgooglemap.net\">embed google maps</a></div><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div>');

-- --------------------------------------------------------

--
-- Table structure for table `donmua`
--

CREATE TABLE `donmua` (
  `id` int(11) NOT NULL,
  `Sdt` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Tongtien` int(11) NOT NULL,
  `GiamGia` int(11) NOT NULL DEFAULT 0,
  `Tenngnhan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Sdtngnhan` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Diachingnhan` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Ghichu` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Tgdathang` datetime NOT NULL,
  `Tgiangiao` datetime DEFAULT NULL,
  `Trangthai` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Đang chuẩn bị'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `id` int(11) NOT NULL,
  `Sdt` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Tongtien` int(11) NOT NULL,
  `Tgiantao` datetime NOT NULL,
  `Cnhatlancuoi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gioithieu`
--

CREATE TABLE `gioithieu` (
  `id` int(11) NOT NULL,
  `Tieude` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Noidung` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `Showing` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gioithieu`
--

INSERT INTO `gioithieu` (`id`, `Tieude`, `Noidung`, `Showing`) VALUES
(1, 'CÂU CHUYỆN THƯƠNG HIỆU', 'Tên gọi GONZ xuất phát từ ý nghĩa trong tiếng Hoa là Trà cung đình. Thời xưa, các loại trà tốt nhất thường được các vị hoàng thân quý tộc ngự dùng. Ngày nay, GONZ mong muốn phục vụ các loại trà tốt nhất cho thực khách, cũng như chính tên gọi của thương hiệu. Kể từ khi được thành lập vào năm 2006 tại Đài Loan, chuỗi cửa hàng GONZ đã mở rộng trên khắp 19 quốc gia với 1.500 cửa hàng và con số này vẫn tiếp tục tăng trưởng không ngừng. Qua nhiều năm nỗ lực phát triển, GONZ đã trở nên phổ biến với khách hàng từ nhiều quốc gia và trở thành một trong những thương hiệu trà đáng tin cậy hàng đầu trên thế giới.', 'YES'),
(2, 'GONZ VIỆT NAM', 'Thương hiệu GONZ được công ty TNHH FIT-HCMUE chính thức đưa vào hoạt động tại thị trường Việt Nam từ ngày 23/7/2020. Trải qua hơn năm năm hoạt động thử nghiệm, công ty TNHH FIT-HCMUE – đơn vị nhượng quyền độc quyền của GONZ tại Việt Nam, đã đưa thương hiệu phát triển nhanh chóng và trở thành một trong những điểm đến thân thuộc của các bạn trẻ yêu thích văn hóa trà sữa và mong muốn trải nghiệm sản phẩm trà uy tín chất lượng với nguồn gốc xuất xứ rõ ràng.', 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `loaisp`
--

CREATE TABLE `loaisp` (
  `idLoai` int(11) NOT NULL,
  `Tenloai` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loaisp`
--

INSERT INTO `loaisp` (`idLoai`, `Tenloai`) VALUES
(1, 'Trà nguyên chất'),
(2, 'Trà sữa'),
(3, 'Latteseries'),
(4, 'Thức uống đá xay'),
(5, 'Thức uống sáng tạo');

-- --------------------------------------------------------

--
-- Table structure for table `magiamgia`
--

CREATE TABLE `magiamgia` (
  `id` int(11) NOT NULL,
  `Code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Giamgia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `magiamgia`
--

INSERT INTO `magiamgia` (`id`, `Code`, `Giamgia`) VALUES
(1, 'GIAM10K', 10000),
(2, 'GIAM20K', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `phanhoi`
--

CREATE TABLE `phanhoi` (
  `id` int(11) NOT NULL,
  `Ten` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Tieude` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Noidung` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Ngayphanhoi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `Tensp` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Giasp` int(11) NOT NULL,
  `Loaisp` int(11) NOT NULL,
  `Linkanh` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Luotxem` int(11) NOT NULL DEFAULT 0,
  `Luotmua` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id`, `Tensp`, `Giasp`, `Loaisp`, `Linkanh`, `Luotxem`, `Luotmua`) VALUES
(2, 'Trà sữa Cà phê', 49000, 2, 'Trasua/Ca-Phe.png', 3, 5),
(3, 'Trà sữa Chocolate', 55000, 2, 'Trasua/Chocolate.png', 0, 0),
(4, 'Trà sữa Earl Grey', 53000, 2, 'Trasua/Earl-Grey.png', 3, 2),
(5, 'Trà Alisan chanh dây', 39000, 5, 'Thucuongsangtao/Alisan-chanh-dây.png', 0, 0),
(6, 'Trà Alisan vải', 35000, 5, 'Thucuongsangtao/Alisan-vải-2.png', 1, 50),
(7, 'Trà Alisan xoài', 35000, 5, 'Thucuongsangtao/Alisan-xoài-2.png', 0, 1),
(8, 'Trà Alisan', 29000, 1, 'Tra/Tra-Alisan-2.png', 3, 0),
(9, 'Trà Bí đao', 29000, 1, 'Tra/Tra-Bi-Dao-2.png', 6, 31),
(10, 'Trà Bí đao Alisan', 32000, 1, 'Tra/Tra-Bi-Dao-Alisan-2.png', 11, 0),
(11, 'Sữa tươi OKINAWA', 53000, 3, 'Latteseries/Hinh-Web-OKINAWA-SUA-TUOI.png', 0, 0),
(12, 'Okinawa Latte', 57000, 3, 'Latteseries/Hinh-Web-OKINAWA-LATTE.png', 0, 0),
(13, 'Chocolate đá xay', 49000, 4, 'Thucuongdaxay/Chocolate-đá-xay-2.png', 0, 0),
(14, 'Khoai môn đá xay', 45000, 4, 'Thucuongdaxay/Khoai-môn-đá-xay-2.png', 1, 0),
(15, 'Matcha đá xay', 45000, 4, 'Thucuongdaxay/Matcha-đá-xay-2.png', 0, 0),
(16, 'Trà sữa Hokkaido', 55000, 2, 'Trasua/Hokkaido.png', 0, 0),
(17, 'Trà sữa khoai môn', 49000, 2, 'Trasua/Khoai-Mon.png', 0, 1),
(18, 'Trà sữa Xoài', 45000, 2, 'Trasua/Mango-Milktea.png', 0, 0),
(19, 'Trà sữa Matcha đậu đỏ', 57000, 2, 'Trasua/Matcha-dau-do.png', 0, 0),
(20, 'Trà sữa OKINAWA', 59000, 2, 'Trasua/OKINAWA.png', 2, 0),
(21, 'Trà sữa Ô Long', 47000, 2, 'Trasua/Oo-Long.png', 0, 0),
(22, 'Trà sữa Ô Long 3J', 63000, 2, 'Trasua/Oolong-3J-2.png', 0, 0),
(23, 'Mango Matcha Latte', 57000, 3, 'Latteseries/Mango-Matcha-Latte.png', 0, 0),
(24, 'Strawberry Oreo Smoothie', 69000, 4, 'Thucuongdaxay/Strawberry-Oreo-Smoothie.png', 0, 0),
(25, 'Xoài đá xay', 39000, 4, 'Thucuongdaxay/Xoài-đá-xay-2.png', 0, 0),
(26, 'Trà đen', 25000, 1, 'Tra/Tra-Den-2.png', 3, 0),
(27, 'Trà Earl Grey', 35000, 1, 'Tra/Trà-Earl-Grey.png', 1, 0),
(28, 'Trà Ô Long', 33000, 1, 'Tra/Tra-Oolong-2.png', 30, 0),
(29, 'Trà sữa Pudding đậu đỏ', 53000, 2, 'Trasua/Pudding-dau-do.png', 1, 1),
(30, 'Trà sữa Sương sáo', 49000, 2, 'Trasua/Suong-Sao.png', 0, 0),
(31, 'Trà Xanh sữa', 39000, 2, 'Trasua/Tra-Xanh.png', 0, 0),
(32, 'Chanh Aiyu trân châu trắng', 53000, 5, 'Thucuongsangtao/Chanh-Aiyu-trân-châu-trắng-2.png', 0, 0),
(33, 'Đào hồng mận hột é', 59000, 5, 'Thucuongsangtao/Đào-hồng-mận-hột-é-1.png', 0, 0),
(34, 'Đen đào', 39000, 5, 'Thucuongsangtao/Đen-đào-2.png', 0, 0),
(35, 'Ô Long Vải', 39000, 5, 'Thucuongsangtao/Oolong-vải-2.png', 0, 0),
(36, 'QQ Trà xanh chanh dây', 49000, 5, 'Thucuongsangtao/QQ-Trà-xanh-chanh-dây-2.png', 0, 0),
(37, 'Yakult đá xay', 43000, 4, 'Thucuongdaxay/Yakult-đá-xay-2.png', 0, 0),
(38, 'Trà Xanh', 29000, 1, 'Tra/Tra-Xanh-2.png', 10, 0),
(39, 'Trà sữa Truyền thống', 39000, 2, 'Trasua/Truyen-Thong.png', 0, 1),
(40, 'Trà sữa Truyền thống Trân châu', 49000, 2, 'Trasua/Truyen-Thong-Tran-Chau.png', 3, 2),
(41, 'Trà Xanh Đào', 43000, 5, 'Thucuongsangtao/Xanh-đào-2.png', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `Sdt` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Tentk` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Diachi` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `Matkhau` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Vaitro` int(11) NOT NULL DEFAULT 0,
  `Ngaydangky` datetime NOT NULL,
  `Quenpass` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`Sdt`, `Tentk`, `Diachi`, `Matkhau`, `Vaitro`, `Ngaydangky`, `Quenpass`) VALUES
('0123456789', 'ADMIN', 'GONZ address', '202cb962ac59075b964b07152d234b70', 2, '2020-07-21 23:57:29', NULL),
('0987654321', 'Staff 1 ', 'GONZ Staff', '202cb962ac59075b964b07152d234b70', 1, '2020-07-22 00:07:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `thongtindonhang`
--

CREATE TABLE `thongtindonhang` (
  `id` int(11) NOT NULL,
  `idSP` int(11) NOT NULL,
  `Tensp` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Dongia` int(11) NOT NULL,
  `Sl` int(11) NOT NULL,
  `Thanhtien` int(11) NOT NULL,
  `idDonmua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thongtingiohang`
--

CREATE TABLE `thongtingiohang` (
  `id` int(11) NOT NULL,
  `idsp` int(11) NOT NULL,
  `Sl` int(11) NOT NULL,
  `Tgiantao` datetime NOT NULL,
  `Cnhatlancuoi` datetime NOT NULL,
  `idGiohang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuahang`
--
ALTER TABLE `cuahang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donmua`
--
ALTER TABLE `donmua`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Sdt` (`Sdt`);

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `giohang_ibfk_1` (`Sdt`);

--
-- Indexes for table `gioithieu`
--
ALTER TABLE `gioithieu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`idLoai`);

--
-- Indexes for table `magiamgia`
--
ALTER TABLE `magiamgia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phanhoi`
--
ALTER TABLE `phanhoi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Loaisp` (`Loaisp`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`Sdt`);

--
-- Indexes for table `thongtindonhang`
--
ALTER TABLE `thongtindonhang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSP` (`idSP`),
  ADD KEY `idDonmua` (`idDonmua`);

--
-- Indexes for table `thongtingiohang`
--
ALTER TABLE `thongtingiohang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idGiohang` (`idGiohang`),
  ADD KEY `idsp` (`idsp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuahang`
--
ALTER TABLE `cuahang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donmua`
--
ALTER TABLE `donmua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `gioithieu`
--
ALTER TABLE `gioithieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loaisp`
--
ALTER TABLE `loaisp`
  MODIFY `idLoai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `magiamgia`
--
ALTER TABLE `magiamgia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `phanhoi`
--
ALTER TABLE `phanhoi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `thongtindonhang`
--
ALTER TABLE `thongtindonhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `thongtingiohang`
--
ALTER TABLE `thongtingiohang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donmua`
--
ALTER TABLE `donmua`
  ADD CONSTRAINT `donmua_ibfk_1` FOREIGN KEY (`Sdt`) REFERENCES `taikhoan` (`Sdt`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`Sdt`) REFERENCES `taikhoan` (`Sdt`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`Loaisp`) REFERENCES `loaisp` (`idLoai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thongtindonhang`
--
ALTER TABLE `thongtindonhang`
  ADD CONSTRAINT `thongtindonhang_ibfk_1` FOREIGN KEY (`idSP`) REFERENCES `sanpham` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `thongtindonhang_ibfk_2` FOREIGN KEY (`idDonmua`) REFERENCES `donmua` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thongtingiohang`
--
ALTER TABLE `thongtingiohang`
  ADD CONSTRAINT `thongtingiohang_ibfk_1` FOREIGN KEY (`idGiohang`) REFERENCES `giohang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thongtingiohang_ibfk_2` FOREIGN KEY (`idsp`) REFERENCES `sanpham` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
