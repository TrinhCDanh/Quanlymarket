-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 113.161.49.17    Database: admin_qlchodbdev
-- ------------------------------------------------------
-- Server version	5.5.5-10.2.14-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cho`
--

DROP TABLE IF EXISTS `cho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) NOT NULL,
  `dia_chi` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cho`
--

LOCK TABLES `cho` WRITE;
/*!40000 ALTER TABLE `cho` DISABLE KEYS */;
INSERT INTO `cho` VALUES (1,'TTTM DV AN ĐÔNG','Phường 9, Quận 5, Hồ Chí Minh, Việt Nam'),(2,'CHỢ HÒA BÌNH','37 Bạch Vân, phường 5, Hồ Chí Minh, Việt Nam'),(3,'CHỢ BÀU SEN','381/28 An Dương Vương, P.3, Q.5, TP. HCM'),(4,'CHỢ PHÙNG HƯNG','214c Phùng Hưng, P.14, Q.5, TP. HCM'),(5,'CHỢ SẮT HÀ TÔN QUYỀN','167/17 Tân Thành, phường 15, quận 5, TP.HCM'),(6,'CHỢ XÃ TÂY','36 Nguyễn Trãi, phường 11, quận 5, Hồ Chí Minh, Việt Nam'),(7,'CHỢ CAO ĐẠT','Quận 5, Hồ Chí Minh, Việt Nam');
/*!40000 ALTER TABLE `cho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_so_cc`
--

DROP TABLE IF EXISTS `co_so_cc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `co_so_cc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) DEFAULT NULL,
  `sdt` text DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_so_cc`
--

LOCK TABLES `co_so_cc` WRITE;
/*!40000 ALTER TABLE `co_so_cc` DISABLE KEYS */;
INSERT INTO `co_so_cc` VALUES (1,'Cơ sở cấp trứng','1111111113','Phường 11'),(2,'Cơ sở cấp thủy hải sản','1111111114','Phường 11'),(3,'Cơ sở cấp rau củ quả','1111111115','Phường 11'),(4,'Cơ sở cấp hàng tạp hóa','1111111116','Phường 11'),(5,'Cơ sở cấp thực phẩm từ bột','1111111117','Phường 11'),(6,'Cơ sở cấp hương liệu','1111111118','Phường 11'),(7,'Cơ sở cấp bánh mứt kẹo','1111111119','Phường 11');
/*!40000 ALTER TABLE `co_so_cc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `danh_sach_mat_hang_kd`
--

DROP TABLE IF EXISTS `danh_sach_mat_hang_kd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `danh_sach_mat_hang_kd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) NOT NULL,
  `id_ho_kd` int(11) NOT NULL COMMENT 'cặp khóa',
  `id_sap` int(255) DEFAULT NULL COMMENT 'cặp khóa',
  `id_co_so_cc` int(11) NOT NULL,
  `luong_hang_bq_nhap` varchar(255) NOT NULL,
  `id_don_vi` int(11) NOT NULL,
  `ghi_chu` varchar(255) DEFAULT NULL,
  `ten_giay_chung_nhan` varchar(255) NOT NULL COMMENT 'giấy chứng minh nguồn gốc',
  `url_giay_chung_nhan` varchar(255) DEFAULT NULL,
  `id_nganh_kd` int(255) DEFAULT NULL,
  `ngay_dang_ky` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `danh_sach_mat_hang_kd`
--

LOCK TABLES `danh_sach_mat_hang_kd` WRITE;
/*!40000 ALTER TABLE `danh_sach_mat_hang_kd` DISABLE KEYS */;
INSERT INTO `danh_sach_mat_hang_kd` VALUES (1,'Trứng bắc thảo',1,1,1,'1000',4,NULL,'Vệ sinh ATTP',NULL,1,'2018-07-31'),(2,'Trứng vịt',1,1,1,'2000',4,NULL,'Vệ sinh ATTP',NULL,1,'2018-07-31'),(3,'Trứng gà',1,1,1,'3000',4,NULL,'abc',NULL,1,'2018-07-31'),(4,'Trứng bắc thảo',1,2,1,'0',4,NULL,'a',NULL,1,'2018-08-02'),(5,'Tôm càng xanh',10,13,2,'100',3,NULL,'Hàng tươi',NULL,2,'2018-07-31'),(6,'Cua hoàng đế',10,14,2,'50',3,NULL,'a',NULL,2,'2018-07-31'),(7,'Nghêu sò ốc hến',10,14,2,'1',8,NULL,'a',NULL,2,'2018-07-31'),(8,'Trứng gia cầm các loại',2,5,1,'1000',4,NULL,'a',NULL,1,'2018-07-31'),(9,'Trái cây miền tây',3,6,3,'100',3,NULL,'a',NULL,4,'2018-07-31'),(10,'fsdfsdf',7,10,4,'100',5,'fsdfs','sfsfsdf',NULL,7,'2018-08-02'),(11,'gdfgdfg',10,15,2,'2000',3,'fsdfsdf','fsdfsdfsdf',NULL,2,'2018-08-02');
/*!40000 ALTER TABLE `danh_sach_mat_hang_kd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `don_vi_tinh`
--

DROP TABLE IF EXISTS `don_vi_tinh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `don_vi_tinh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `don_vi_tinh`
--

LOCK TABLES `don_vi_tinh` WRITE;
/*!40000 ALTER TABLE `don_vi_tinh` DISABLE KEYS */;
INSERT INTO `don_vi_tinh` VALUES (1,'Hộp'),(2,'Thùng'),(3,'Kilogram'),(4,'Quả'),(5,'Gói'),(7,'Lít'),(8,'Tấn');
/*!40000 ALTER TABLE `don_vi_tinh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ho_kinh_doanh`
--

DROP TABLE IF EXISTS `ho_kinh_doanh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ho_kinh_doanh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_so_ho_kd` varchar(255) DEFAULT NULL COMMENT 'mã giấy cn đăng ký kd',
  `ten_ho_kd` varchar(255) DEFAULT NULL,
  `id_cho` int(11) DEFAULT NULL COMMENT 'dùng để làm địa chỉ của hộ kd',
  `tang` varchar(255) DEFAULT NULL,
  `sdt_ho_kd` varchar(255) DEFAULT NULL,
  `fax_ho_kd` varchar(255) DEFAULT NULL,
  `email_ho_kd` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `id_nganh_kd` int(11) DEFAULT NULL,
  `von_kd` varchar(255) DEFAULT NULL,
  `ho_chu_ho_kd` varchar(11) DEFAULT NULL,
  `ten_chu_ho_kd` varchar(255) DEFAULT NULL,
  `gioi_tinh` int(255) DEFAULT NULL COMMENT '1: Nam, 2: Nữ',
  `ngay_sinh` date DEFAULT NULL,
  `dan_toc` varchar(255) DEFAULT NULL,
  `quoc_tich` varchar(255) DEFAULT NULL,
  `sdt_chu_ho_kd` varchar(255) DEFAULT NULL,
  `loai_giay_to` int(255) DEFAULT 1 COMMENT '1: CMND, 2: CCCD',
  `ma_so_giay_to` varchar(255) DEFAULT NULL,
  `ngay_cap_giay_to` date DEFAULT NULL,
  `noi_cap` varchar(255) DEFAULT NULL,
  `dia_chi_thuong_tru` varchar(255) DEFAULT NULL,
  `dia_chi_tam_tru` varchar(255) DEFAULT NULL,
  `ngay_dang_ki_1st` date DEFAULT NULL,
  `so_lan_thay_doi` int(255) DEFAULT NULL,
  `ngay_thay_doi` date DEFAULT NULL,
  `giay_ATTP_Status` int(1) DEFAULT 0 COMMENT '0: Chưa làm 1:Đang làm 2:Đã làm  3:Đã cấp',
  `ma_so_giay_ATTP` varchar(255) DEFAULT NULL,
  `thoi_gian_hieu_luc_ATTP` date DEFAULT NULL,
  `kham_suc_khoe` int(11) DEFAULT 0 COMMENT '0: không, 1:có',
  `giay_xac_nhan_kien_thuc` int(11) DEFAULT 0 COMMENT '0: không, 1:có',
  `GCN_du_dieu_kien` int(11) DEFAULT 0 COMMENT '0: không, 1:có',
  `ban_cam_ket_dam_bao` int(11) DEFAULT 0 COMMENT '0: không, 1:có',
  `nguoi_cap` varchar(255) DEFAULT NULL,
  `File_Upload` varchar(255) DEFAULT NULL,
  `noi_cap_giay_ATTP` varchar(255) DEFAULT NULL,
  `ngay_cap_giay_ATTP` date DEFAULT NULL,
  `so_lao_dong` varchar(255) DEFAULT NULL,
  `delete_at` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ho_kinh_doanh`
--

LOCK TABLES `ho_kinh_doanh` WRITE;
/*!40000 ALTER TABLE `ho_kinh_doanh` DISABLE KEYS */;
INSERT INTO `ho_kinh_doanh` VALUES (1,'HKD-01','Nguyễn Thanh Thiên 1',1,NULL,'0123951753','test fax 1','test@gmail.com','www.google.com',1,'100000000','Vương Thúy','Vân 1',2,'1997-02-08','Hoa','Việt Nam','01234567890',2,'AK47','2018-03-26','Nha Trang','123 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','951 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-04',0,'ATTP 01','2019-03-23',1,0,1,1,'Nguyễn Du','File_Upload','Bạch Đằng','2018-02-23',NULL,0),(2,'HKD-02','Nguyễn Thanh Thiên 2',2,NULL,'0123951754','test fax 2','test@gmail.com','www.google.com',1,'200000000','Vương Thúy','Vân 2',2,'1997-02-09','Hoa','Việt Nam','01234567891',2,'AK48','2018-03-27','Nha Trang','124 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','952 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',0,'ATTP 02','2019-03-23',0,1,0,0,'Nguyễn Huệ',NULL,'Khổng Tử','2018-02-23',NULL,0),(3,'HKD-03','Nguyễn Thanh Thiên 3',2,NULL,'0123951755','test fax 3','test@gmail.com','www.google.com',4,'300000000','Vương Thúy','Vân 3',2,'1997-02-10','Hoa','Việt Nam','01234567892',2,'AK49','2018-03-28','Nha Trang','125 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','953 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',2,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'',NULL,NULL,0),(4,'HKD-04','Nguyễn Thanh Thiên 4',2,NULL,'0123951756','test fax 4','test@gmail.com','www.google.com',4,'400000000','Vương Thúy','Vân 4',2,'1997-02-11','Hoa','Việt Nam','01234567893',2,'AK50','2018-03-29','Nha Trang','126 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','954 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-01',1,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'',NULL,NULL,0),(5,'HKD-05','Nguyễn Thanh Thiên 5',2,NULL,'0123951757','test fax 5','test@gmail.com','www.google.com',4,'500000000','Vương Thúy','Vân 5',2,'1997-02-12','Hoa','Việt Nam','01234567894',2,'AK51','2018-03-30','Nha Trang','127 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','955 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-02',0,'ATTP 03','2019-03-23',1,0,1,1,'Nguyễn Du','File_Upload','Bạch Đằng','2018-02-23',NULL,0),(6,'HKD-06','Nguyễn Thanh Thiên 6',3,NULL,'0123951758','test fax 6','test@gmail.com','www.google.com',7,'600000000','Vương Thúy','Vân 6',2,'1997-02-13','Hoa','Việt Nam','01234567895',2,'AK52','2018-03-31','Nha Trang','128 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','956 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',2,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'',NULL,NULL,0),(7,'HKD-07','Nguyễn Thanh Thiên 7',3,NULL,'0123951759','test fax 7','test@gmail.com','www.google.com',7,'700000000','Vương Thúy','Vân 7',2,'1997-02-14','Hoa','Việt Nam','01234567896',2,'AK53','2018-04-01','Nha Trang','129 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','957 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',1,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'',NULL,NULL,0),(8,'HKD-08','Nguyễn Thanh Thiên 8',3,NULL,'0123951760','test fax 8','test@gmail.com','www.google.com',2,'800000000','Vương Thúy','Vân 8',2,'1997-02-15','Hoa','Việt Nam','01234567897',2,'AK54','2018-04-02','Nha Trang','130 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','958 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',0,'ATTP 04','2019-03-23',1,0,1,1,'Nguyễn Du',NULL,'Bạch Đằng','2018-02-23',NULL,0),(9,'HKD-09','Nguyễn Thanh Thiên 9',3,NULL,'0123951761','test fax 9','test@gmail.com','www.google.com',2,'900000000','Vương Thúy','Vân 9',2,'1997-02-16','Hoa','Việt Nam','01234567898',2,'AK55','2018-04-03','Nha Trang','131 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','959 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',2,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'',NULL,NULL,0),(10,'HKD-10','Nguyễn Thanh Thiên 10',4,NULL,'0123951762','test fax 10','test@gmail.com','www.google.com',2,'900000000','Vương Thúy','Vân 10',2,'1997-02-17','Hoa','Việt Nam','01234567899',2,'AK56','2018-04-04','Nha Trang','132 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','960 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',1,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'',NULL,NULL,0),(11,'123','123',5,NULL,NULL,'123',NULL,NULL,1,'123','123','123',1,NULL,NULL,NULL,NULL,1,'123',NULL,NULL,NULL,NULL,'2018-08-03',12,'2018-08-03',0,NULL,NULL,1,1,1,0,NULL,NULL,NULL,NULL,NULL,0),(12,'15012','Sơn Nguyễn',5,'10','0258951753','test fax','baby@gmail.com','www.fb.com',5,'1000000000','Vương Thúy','Kiều',1,'1997-09-03','Kinh','Việt Nam','0123852951',1,'MDH004','2015-05-23','Biên Hòa','167/17 Tân Thành, phường 15, quận 5, TP.HCM','753 Bình Hòa, P.Bình Hòa, Q. Bình Hòa, TP. HCM','2018-02-23',1,'2018-03-15',2,'MBH123','2018-03-23',1,0,1,1,'Nguyễn Du',NULL,'Bạch Đằng','2018-02-23',NULL,0),(13,'15013','Nguyễn Sơn',5,'12','0123951753','test fax 1','test@gmail.com','www.google.com',7,'20000000000','Vương Thúy','Vân',2,'1997-02-08','Hoa','Mỹ','0123852753',2,'AK47','2018-03-26','Nha Trang','167/17 Tân Thành, phường 15, quận 5, TP.HCM','951 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-02-18',2,'2018-03-18',0,'MKH456','2018-05-15',0,1,0,0,'Nguyễn Huệ',NULL,'Khổng Tử','2018-01-12',NULL,0),(14,'15014','Sơn Thanh',5,'10','0258951753','test fax','baby@gmail.com','www.fb.com',5,'1000000000','Vương Thúy','Kiều',1,'1997-09-03','Kinh','Việt Nam','0123852951',1,'MDH004','2015-05-23','Biên Hòa','167/17 Tân Thành, phường 15, quận 5, TP.HCM','753 Bình Hòa, P.Bình Hòa, Q. Bình Hòa, TP. HCM','2018-02-23',1,'2018-03-15',2,'MBH123','2018-03-23',1,0,1,1,'Nguyễn Du',NULL,'Bạch Đằng','2018-02-23','12',0),(15,'15015','Thanh Sơn',5,'12','0123951753','test fax 1','test@gmail.com','www.google.com',7,'20000000000','Vương Thúy','Vân',2,'1997-02-08','Hoa','Mỹ','0123852753',2,'AK47','2018-03-26','Nha Trang','167/17 Tân Thành, phường 15, quận 5, TP.HCM','951 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-02-18',2,'2018-03-18',0,'MKH456','2018-05-15',0,1,0,0,'Nguyễn Huệ',NULL,'Khổng Tử','2018-01-12','18',0),(16,'15016','Sơn Thanh Nguyễn',5,'10','0258951753','test fax','baby@gmail.com','www.fb.com',5,'1000000000','Vương Thúy','Kiều',1,'1997-09-03','Kinh','Việt Nam','0123852951',1,'MDH004','2015-05-23','Biên Hòa','167/17 Tân Thành, phường 15, quận 5, TP.HCM','753 Bình Hòa, P.Bình Hòa, Q. Bình Hòa, TP. HCM','2018-02-23',1,'2018-03-15',2,'MBH123','2018-03-23',1,0,1,1,'Nguyễn Du',NULL,'Bạch Đằng','2018-02-23','12',0),(17,'15017','Thanh Sơn Nguyễn',5,'12','0123951753','test fax 1','test@gmail.com','www.google.com',7,'20000000000','Vương Thúy','Vân',2,'1997-02-08','Hoa','Mỹ','0123852753',2,'AK47','2018-03-26','Nha Trang','167/17 Tân Thành, phường 15, quận 5, TP.HCM','951 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-02-18',2,'2018-03-18',0,'MKH456','2018-05-15',0,1,0,0,'Nguyễn Huệ',NULL,'Khổng Tử','2018-01-12','18',0),(18,'12','hao',4,NULL,NULL,NULL,NULL,NULL,1,'2000000','nguyen','Duy Hao',1,NULL,NULL,NULL,NULL,1,'0123456789',NULL,NULL,NULL,NULL,'2018-08-06',1,'2018-08-06',0,NULL,NULL,0,0,0,0,NULL,'1533521684.env',NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `ho_kinh_doanh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ho_kinh_doanh_log_detail`
--

DROP TABLE IF EXISTS `ho_kinh_doanh_log_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ho_kinh_doanh_log_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ho_kinh_doanh` int(11) DEFAULT NULL,
  `ma_so_ho_kd` varchar(255) DEFAULT NULL,
  `ten_ho_kd` varchar(255) DEFAULT NULL,
  `id_cho` int(11) DEFAULT NULL,
  `tang` int(255) DEFAULT NULL,
  `sdt_ho_kd` varchar(255) DEFAULT NULL,
  `fax_ho_kd` varchar(255) DEFAULT NULL,
  `email_ho_kd` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `id_nganh_kd` int(11) DEFAULT NULL,
  `von_kd` varchar(255) DEFAULT NULL,
  `ho_chu_ho_kd` varchar(255) DEFAULT NULL,
  `ten_chu_ho_kd` varchar(45) DEFAULT NULL,
  `gioi_tinh` int(11) DEFAULT 1,
  `ngay_sinh` varchar(255) DEFAULT NULL,
  `dan_toc` varchar(255) DEFAULT NULL,
  `quoc_tich` varchar(255) DEFAULT NULL,
  `sdt_chu_ho_kd` varchar(255) DEFAULT NULL,
  `loai_giay_to` int(11) DEFAULT 1,
  `ma_so_giay_to` varchar(255) DEFAULT NULL,
  `ngay_cap_giay_to` date DEFAULT NULL,
  `noi_cap` varchar(255) DEFAULT NULL,
  `dia_chi_thuong_tru` varchar(255) DEFAULT NULL,
  `dia_chi_tam_tru` varchar(255) DEFAULT NULL,
  `ngay_dang_ki_1st` date DEFAULT NULL,
  `so_lan_thay_doi` int(11) DEFAULT NULL,
  `ngay_thay_doi` date DEFAULT NULL,
  `giay_ATTP_Status` int(11) DEFAULT 0,
  `ma_so_giay_ATTP` varchar(255) DEFAULT NULL,
  `thoi_gian_hieu_luc_ATTP` date DEFAULT NULL,
  `nguoi_cap` varchar(255) DEFAULT NULL,
  `noi_cap_giay_ATTP` varchar(255) DEFAULT NULL,
  `File_Upload` varchar(255) DEFAULT NULL,
  `kham_suc_khoe` int(11) DEFAULT 0,
  `giay_xac_nhan_kien_thuc` int(11) DEFAULT 0,
  `GCN_du_dieu_kien` int(11) DEFAULT 0,
  `ban_cam_ket_dam_bao` int(11) DEFAULT 0,
  `ngay_cap_giay_ATTP` date DEFAULT NULL,
  `so_lao_dong` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ho_kinh_doanh_log_detail`
--

LOCK TABLES `ho_kinh_doanh_log_detail` WRITE;
/*!40000 ALTER TABLE `ho_kinh_doanh_log_detail` DISABLE KEYS */;
INSERT INTO `ho_kinh_doanh_log_detail` VALUES (1,1,'HKD-01','Nguyễn Thanh Thiên 1',1,NULL,'0123951753','test fax 1','test@gmail.com','www.google.com',1,'100000000','Vương Thúy','Vân 1',2,'1997-02-08','Hoa','Việt Nam','01234567890',2,'AK47','2018-03-26','Nha Trang','123 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','951 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',0,'ATTP 01','2019-03-23','Nguyễn Du','Bạch Đằng',NULL,1,0,1,1,'2018-02-23',NULL),(2,2,'HKD-02','Nguyễn Thanh Thiên 2',2,NULL,'0123951754','test fax 2','test@gmail.com','www.google.com',1,'200000000','Vương Thúy','Vân 2',2,'1997-02-09','Hoa','Việt Nam','01234567891',2,'AK48','2018-03-27','Nha Trang','124 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','952 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',0,'ATTP 02','2019-03-23','Nguyễn Huệ','Khổng Tử',NULL,0,1,0,0,'2018-02-23',NULL),(3,3,'HKD-03','Nguyễn Thanh Thiên 3',2,NULL,'0123951755','test fax 3','test@gmail.com','www.google.com',4,'300000000','Vương Thúy','Vân 3',2,'1997-02-10','Hoa','Việt Nam','01234567892',2,'AK49','2018-03-28','Nha Trang','125 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','953 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',2,NULL,NULL,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,4,'HKD-04','Nguyễn Thanh Thiên 4',2,NULL,'0123951756','test fax 4','test@gmail.com','www.google.com',4,'400000000','Vương Thúy','Vân 4',2,'1997-02-11','Hoa','Việt Nam','01234567893',2,'AK50','2018-03-29','Nha Trang','126 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','954 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',1,NULL,NULL,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,5,'HKD-05','Nguyễn Thanh Thiên 5',2,NULL,'0123951757','test fax 5','test@gmail.com','www.google.com',4,'500000000','Vương Thúy','Vân 5',2,'1997-02-12','Hoa','Việt Nam','01234567894',2,'AK51','2018-03-30','Nha Trang','127 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','955 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',0,'ATTP 03','2019-03-23','Nguyễn Du','Bạch Đằng',NULL,1,0,1,1,'2018-02-23',NULL),(6,6,'HKD-06','Nguyễn Thanh Thiên 6',3,NULL,'0123951758','test fax 6','test@gmail.com','www.google.com',7,'600000000','Vương Thúy','Vân 6',2,'1997-02-13','Hoa','Việt Nam','01234567895',2,'AK52','2018-03-31','Nha Trang','128 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','956 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',2,NULL,NULL,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,7,'HKD-07','Nguyễn Thanh Thiên 7',3,NULL,'0123951759','test fax 7','test@gmail.com','www.google.com',7,'700000000','Vương Thúy','Vân 7',2,'1997-02-14','Hoa','Việt Nam','01234567896',2,'AK53','2018-04-01','Nha Trang','129 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','957 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',1,NULL,NULL,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,8,'HKD-08','Nguyễn Thanh Thiên 8',3,NULL,'0123951760','test fax 8','test@gmail.com','www.google.com',2,'800000000','Vương Thúy','Vân 8',2,'1997-02-15','Hoa','Việt Nam','01234567897',2,'AK54','2018-04-02','Nha Trang','130 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','958 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',0,'ATTP 04','2019-03-23','Nguyễn Du','Bạch Đằng',NULL,1,0,1,1,'2018-02-23',NULL),(9,9,'HKD-09','Nguyễn Thanh Thiên 9',3,NULL,'0123951761','test fax 9','test@gmail.com','www.google.com',2,'900000000','Vương Thúy','Vân 9',2,'1997-02-16','Hoa','Việt Nam','01234567898',2,'AK55','2018-04-03','Nha Trang','131 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','959 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',2,NULL,NULL,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,10,'HKD-10','Nguyễn Thanh Thiên 10',4,NULL,'0123951762','test fax 10','test@gmail.com','www.google.com',2,'900000000','Vương Thúy','Vân 10',2,'1997-02-17','Hoa','Việt Nam','01234567899',2,'AK56','2018-04-04','Nha Trang','132 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','960 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-03',1,NULL,NULL,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,1,'HKD-01','Nguyễn Thanh Thiên 1',1,NULL,'0123951753','test fax 1','test@gmail.com','www.google.com',1,'100000000','Vương Thúy','Vân 1',2,'1997-02-08','Hoa','Việt Nam','01234567890',2,'AK47','2018-03-26','Nha Trang','123 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','951 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-04',0,'ATTP 01','2019-03-23','Nguyễn Du','Bạch Đằng','File_Upload',1,0,1,1,NULL,NULL),(12,4,'HKD-04','Nguyễn Thanh Thiên 4',2,NULL,'0123951756','test fax 4','test@gmail.com','www.google.com',4,'400000000','Vương Thúy','Vân 4',2,'1997-02-11','Hoa','Việt Nam','01234567893',2,'AK50','2018-03-29','Nha Trang','126 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','954 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-01',1,NULL,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL),(13,5,'HKD-05','Nguyễn Thanh Thiên 5',2,NULL,'0123951757','test fax 5','test@gmail.com','www.google.com',4,'500000000','Vương Thúy','Vân 5',2,'1997-02-12','Hoa','Việt Nam','01234567894',2,'AK51','2018-03-30','Nha Trang','127 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','955 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-02',0,'ATTP 03','2019-03-23','Nguyễn Du','Bạch Đằng','File_Upload',1,0,1,1,NULL,NULL),(14,1,'HKD-01','Nguyễn Thanh Thiên 1',1,NULL,'0123951753','test fax 1','test@gmail.com','www.google.com',1,'100000000','Vương Thúy','Vân 1',2,'1997-02-08','Hoa','Việt Nam','01234567890',2,'AK47','2018-03-26','Nha Trang','123 Bánh Bèo, P.Hậu Cần, Q.4, TP. HCM','951 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-07-31',0,'2018-08-04',0,'ATTP 01','2019-03-23','Nguyễn Du','Bạch Đằng','File_Upload',1,0,1,1,NULL,NULL),(16,12,'15012','Sơn Nguyễn',5,10,'0258951753','test fax','baby@gmail.com','www.fb.com',5,'1000000000','Vương Thúy','Kiều',2,'1997-09-03','Kinh','Việt Nam','0123852951',2,'MDH004','2015-05-23','Biên Hòa','167/17 Tân Thành, phường 15, quận 5, TP.HCM','753 Bình Hòa, P.Bình Hòa, Q. Bình Hòa, TP. HCM','2018-02-23',1,'2018-03-15',2,'MBH123','2018-03-23','Nguyễn Du','Bạch Đằng',NULL,1,0,1,1,'2018-02-23',NULL),(17,13,'15013','Nguyễn Sơn',5,12,'0123951753','test fax 1','test@gmail.com','www.google.com',7,'20000000000','Vương Thúy','Vân',2,'1997-02-08','Hoa','Mỹ','0123852753',2,'AK47','2018-03-26','Nha Trang','167/17 Tân Thành, phường 15, quận 5, TP.HCM','951 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-02-18',2,'2018-03-18',0,'MKH456','2018-05-15','Nguyễn Huệ','Khổng Tử',NULL,0,1,0,0,'2018-01-12',NULL),(18,14,'15014','Sơn Thanh',5,10,'0258951753','test fax','baby@gmail.com','www.fb.com',5,'1000000000','Vương Thúy','Kiều',2,'1997-09-03','Kinh','Việt Nam','0123852951',2,'MDH004','2015-05-23','Biên Hòa','167/17 Tân Thành, phường 15, quận 5, TP.HCM','753 Bình Hòa, P.Bình Hòa, Q. Bình Hòa, TP. HCM','2018-02-23',1,'2018-03-15',2,'MBH123','2018-03-23','Nguyễn Du','Bạch Đằng',NULL,1,0,1,1,'2018-02-23','12'),(19,15,'15015','Thanh Sơn',5,12,'0123951753','test fax 1','test@gmail.com','www.google.com',7,'20000000000','Vương Thúy','Vân',2,'1997-02-08','Hoa','Mỹ','0123852753',2,'AK47','2018-03-26','Nha Trang','167/17 Tân Thành, phường 15, quận 5, TP.HCM','951 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-02-18',2,'2018-03-18',0,'MKH456','2018-05-15','Nguyễn Huệ','Khổng Tử',NULL,0,1,0,0,'2018-01-12','18'),(20,16,'15016','Sơn Thanh Nguyễn',5,10,'0258951753','test fax','baby@gmail.com','www.fb.com',5,'1000000000','Vương Thúy','Kiều',2,'1997-09-03','Kinh','Việt Nam','0123852951',2,'MDH004','2015-05-23','Biên Hòa','167/17 Tân Thành, phường 15, quận 5, TP.HCM','753 Bình Hòa, P.Bình Hòa, Q. Bình Hòa, TP. HCM','2018-02-23',1,'2018-03-15',2,'MBH123','2018-03-23','Nguyễn Du','Bạch Đằng',NULL,1,0,1,1,'2018-02-23','12'),(21,17,'15017','Thanh Sơn Nguyễn',5,12,'0123951753','test fax 1','test@gmail.com','www.google.com',7,'20000000000','Vương Thúy','Vân',2,'1997-02-08','Hoa','Mỹ','0123852753',2,'AK47','2018-03-26','Nha Trang','167/17 Tân Thành, phường 15, quận 5, TP.HCM','951 Long Bình, P.Long Bình, Q.Long Bình, TP. HCM','2018-02-18',2,'2018-03-18',0,'MKH456','2018-05-15','Nguyễn Huệ','Khổng Tử',NULL,0,1,0,0,'2018-01-12','18'),(22,18,'12','hao',4,NULL,NULL,NULL,NULL,NULL,1,'2000000','nguyen','Duy Hao',1,NULL,NULL,NULL,NULL,1,'0123456789',NULL,NULL,NULL,NULL,'2018-08-06',1,'2018-08-06',0,NULL,NULL,NULL,NULL,'1533521684.env',0,0,0,0,NULL,NULL);
/*!40000 ALTER TABLE `ho_kinh_doanh_log_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nganh_kd`
--

DROP TABLE IF EXISTS `nganh_kd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nganh_kd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_nganh` varchar(255) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nganh_kd`
--

LOCK TABLES `nganh_kd` WRITE;
/*!40000 ALTER TABLE `nganh_kd` DISABLE KEYS */;
INSERT INTO `nganh_kd` VALUES (1,'Trứng gia cầm'),(2,'Thủy hải sản'),(4,'Rau củ quả trái cây'),(5,'Ăn uống'),(6,'Các sản phẩm từ bột, tinh bột (bún, mì, tương, đậu hủ...) và TP chế biến'),(7,'Tạp hóa'),(8,'Hương liệu, phụ gia thực phẩm'),(9,'Bánh mứt kẹo'),(10,'Mặt hàng khác: thực phẩm công nghiệp, gia vị, tạp phô...');
/*!40000 ALTER TABLE `nganh_kd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('dao.nguyen@vitopmedia.com','$2y$10$V1TZZznf2FZJm4.rcgWZiusfOhKmqNDrZG3RmbbVANAeneGgGBGBy','2018-07-19 01:52:29'),('admin@gmail.com','$2y$10$kjskKVVX/.0lF2lvpAI8P.9kLnPOi.PlJZXSOTjtxycwwz5c2rVi2','2018-07-26 03:42:14');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phuong`
--

DROP TABLE IF EXISTS `phuong`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phuong` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) NOT NULL,
  `id_quan` int(11) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phuong`
--

LOCK TABLES `phuong` WRITE;
/*!40000 ALTER TABLE `phuong` DISABLE KEYS */;
INSERT INTO `phuong` VALUES (1,'Phường 10',1);
/*!40000 ALTER TABLE `phuong` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quan`
--

DROP TABLE IF EXISTS `quan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quan` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quan`
--

LOCK TABLES `quan` WRITE;
/*!40000 ALTER TABLE `quan` DISABLE KEYS */;
INSERT INTO `quan` VALUES (1,'Quận 5');
/*!40000 ALTER TABLE `quan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sap`
--

DROP TABLE IF EXISTS `sap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_so_sap` varchar(255) DEFAULT NULL,
  `ten` varchar(255) DEFAULT NULL,
  `id_ho_kinh_doanh` int(255) DEFAULT NULL,
  `id_cho` int(255) DEFAULT NULL,
  `delete_at` int(1) DEFAULT NULL COMMENT '0: chưa xóa; 1:đã xóa',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sap`
--

LOCK TABLES `sap` WRITE;
/*!40000 ALTER TABLE `sap` DISABLE KEYS */;
INSERT INTO `sap` VALUES (1,'AD01','Sạp AD 1',1,1,0),(2,'AD02','Sạp AD 2',1,1,0),(3,'AD03','Sạp AD 3',1,1,0),(4,'AD04','Sạp AD 4',1,1,0),(5,'HB01','Sạp HB 1',2,2,0),(6,'HB02','Sạp HB 2',3,2,0),(7,'HB03','Sạp HB 3',4,2,0),(8,'HB04','Sạp HB 4',5,2,0),(9,'BS01','Sạp BS 1',6,3,0),(10,'BS02','Sạp BS 2',7,3,0),(11,'BS03','Sạp BS 3',8,3,0),(12,'BS04','Sạp BS 4',9,3,0),(13,'PH01','Sạp PH 1',10,4,0),(14,'PH02','Sạp PH 2',10,4,0),(15,'PH03','Sạp PH 3',10,4,0),(16,'PH04','Sạp PH 4',18,4,0),(17,'TQ01','Sạp TQ 1',16,5,0),(18,'TQ02','Sạp TQ 2',11,5,0),(19,'TQ03','Sạp TQ 3',17,5,0),(20,'TQ04','Sạp TQ 4',12,5,0);
/*!40000 ALTER TABLE `sap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permission` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` VALUES (1,'Administrator','[\"admin\",\"admin.user.add\",\"admin.user.edit\",\"admin.user.list\",\"admin.user.save\",\"admin.user.update\",\"admin.user.delete\",\"admin.user.get_profile\",\"admin.user.save_profile\",\"admin.group.list\",\"admin.group.add\",\"admin.group.edit\",\"admin.group.permission\",\"admin.group.delete\",\"admin.thong_ke.tinh_hinh_ke_khai_theo_nhom_nganh\",\"admin.thong_ke.ke-khai-mhkd-tai-cho-truyen-thong\",\"admin.ho_kinh_doanh.list\",\"admin.ho_kinh_doanh.add\",\"admin.ho_kinh_doanh.edit\",\"admin.ho_kinh_doanh.update\",\"admin.ho_kinh_doanh.delete\",\"admin.ho_kinh_doanh.create\",\"admin.ho_kinh_doanh.show\",\"admin.ho_kinh_doanh.search\",\"admin.sap.list\",\"admin.sap.create\",\"admin.sap.store\",\"admin.sap.show\",\"admin.sap.edit\",\"admin.sap.update\",\"admin.sap.destroy\",\"admin.co_so_cung_cap.list\",\"admin.co_so_cung_cap.create\",\"admin.co_so_cung_cap.store\",\"admin.co_so_cung_cap.show\",\"admin.co_so_cung_cap.edit\",\"admin.co_so_cung_cap.update\",\"admin.co_so_cung_cap.destroy\",\"admin.nganh_kinh_doanh.list\",\"admin.nganh_kinh_doanh.create\",\"admin.nganh_kinh_doanh.store\",\"admin.nganh_kinh_doanh.show\",\"admin.nganh_kinh_doanh.edit\",\"admin.nganh_kinh_doanh.update\",\"admin.nganh_kinh_doanh.destroy\",\"admin.cho.list\",\"admin.cho.add\",\"admin.cho.edit\",\"admin.cho.update\",\"admin.cho.delete\",\"admin.thongke.mhkd.list\",\"admin.thongke.mhkd.export\",\"admin.thongke.mhkd.exportpdf\",\"admin.quanly.hoso.attp\",\"admin.quanly.hoso.attp.export\",\"admin.ho_kd.list\",\"admin.mat_hang_kinh_doanh.list\",\"admin.mat_hang_kinh_doanh.create\",\"admin.mat_hang_kinh_doanh.edit\",\"admin.mat_hang_kinh_doanh.delete\",\"admin.mat_hang_kinh_doanh.export\",\"admin.ATTP.list\",\"admin.don-vi-tinh.list\",\"admin.don-vi-tinh.create\",\"admin.don-vi-tinh.store\",\"admin.don-vi-tinh.show\",\"admin.don-vi-tinh.edit\",\"admin.don-vi-tinh.update\",\"admin.don-vi-tinh.destroy\"]',1,NULL,'2018-01-12 01:30:46'),(2,'kỹ thuật','[\"admin.pnc.article.article\",\"admin.pnc.article.article.add\",\"admin.pnc.article.article.edit\",\"admin.pnc.article.article.delete\",\"admin.pnc.article.article.filter\",\"admin.pnc.category.category\",\"admin.pnc.category.category.add\",\"admin.pnc.category.category.edit\",\"admin.pnc.category.postajax\",\"admin.pnc.category.category.delete\",\"admin.pnc.category.category.filter\",\"admin.pnc.director.director\",\"admin.pnc.director.director.add\",\"admin.pnc.director.director.edit\",\"admin.pnc.director.director.delete\",\"admin.pnc.department.department\",\"admin.pnc.department.department.add\",\"admin.pnc.department.department.edit\",\"admin.pnc.department.postajax\",\"admin.pnc.department.department.delete\",\"admin.pnc.department.department.filter\",\"admin.pnc.recruitment.recruitment\",\"admin.pnc.recruitment.recruitment.add\",\"admin.pnc.recruitment.recruitment.edit\",\"admin.pnc.recruitment.postajax\",\"admin.pnc.recruitment.recruitment.delete\",\"admin.pnc.recruitment.recruitment.filter\",\"admin.pnc.recruitment.recruitment.cv\",\"admin.pnc.company.company\",\"admin.pnc.company.company.add\",\"admin.pnc.company.company.edit\",\"admin.pnc.company.company.delete\",\"admin.pnc.company.company.update\",\"admin.pnc.library.library\",\"admin.pnc.library.library.add\",\"admin.pnc.library.library.edit\",\"admin.pnc.library.library.delete\",\"admin.pnc.library.library.filter\",\"admin.pnc.library.librarycategory\",\"admin.pnc.library.librarycategory.add\",\"admin.pnc.library.librarycategory.edit\",\"admin.pnc.library.librarycategory.delete\",\"admin.pnc.library.librarycategory.filter\",\"admin.pnc.contact.contact\",\"admin.pnc.contact.contact.edit\",\"admin.pnc.contact.contact.delete\",\"admin.pnc.contact.contact.filter\",\"admin.pnc.contact.contact.status\",\"admin.pnc.footer.category\",\"admin.pnc.footer.category.edit\",\"admin.pnc.footer.footer\",\"admin.pnc.footer.footer.add\",\"admin.pnc.footer.footer.edit\",\"admin.pnc.footer.footer.delete\",\"admin.pnb.article.article\",\"admin.pnb.article.article.add\",\"admin.pnb.article.article.edit\",\"admin.pnb.article.article.delete\",\"admin.pnb.article.article.filter\",\"admin.pnb.category.category\",\"admin.pnb.category.category.add\",\"admin.pnb.category.category.edit\",\"admin.pnb.category.category.delete\",\"admin.pnb.category.category.filter\",\"admin.pnb.category.postajax\",\"admin.pnb.idea.idea\",\"admin.pnb.idea.idea.edit\",\"admin.pnb.idea.idea.delete\",\"admin.pnb.idea.idea.status\",\"admin.pnb.contact.contact\",\"admin.pnb.contact.contact.edit\",\"admin.pnb.contact.contact.delete\",\"admin.pnb.contact.contact.filter\",\"admin.pnb.contact.contact.status\",\"admin.pnb.footer.category\",\"admin.pnb.footer.category.edit\",\"admin.pnb.footer.footer\",\"admin.pnb.footer.footer.add\",\"admin.pnb.footer.footer.edit\",\"admin.pnb.footer.footer.delete\",\"admin.pnf.article\",\"admin.pnf.article.add\",\"admin.pnf.article.edit\",\"admin.pnf.article.delete\",\"admin.pnf.article.filter\",\"admin.pnf.category\",\"admin.pnf.category.add\",\"admin.pnf.category.edit\",\"admin.pnf.category.delete\",\"admin.pnf.category.filter\",\"admin.pnf.category.postajax\",\"admin.pnf.film\",\"admin.pnf.film.add\",\"admin.pnf.film.edit\",\"admin.pnf.film.delete\",\"admin.pnf.film.update_order\",\"admin.pnf.film.change_order\",\"admin.pnf.filmcategory\",\"admin.pnf.filmcategory.add\",\"admin.pnf.filmcategory.edit\",\"admin.pnf.filmcategory.delete\",\"admin.pnf.contact.contact\",\"admin.pnf.contact.contact.edit\",\"admin.pnf.contact.contact.delete\",\"admin.pnf.contact.contact.filter\",\"admin.pnf.contact.contact.status\",\"admin.pnf.footer.category\",\"admin.pnf.footer.category.edit\",\"admin.pnf.footer.footer\",\"admin.pnf.footer.footer.add\",\"admin.pnf.footer.footer.edit\",\"admin.pnf.footer.footer.delete\",\"admin.pnf.musiccategory\",\"admin.pnf.musiccategory.add\",\"admin.pnf.musiccategory.edit\",\"admin.pnf.musiccategory.delete\",\"admin.pnf.music\",\"admin.pnf.music.add\",\"admin.pnf.music.edit\",\"admin.pnf.music.delete\",\"admin.pnf.music.update_order\",\"admin.pnf.music.change_order\",\"admin.pnf.author\",\"admin.pnf.author.add\",\"admin.pnf.author.edit\",\"admin.pnf.author.delete\",\"admin.pnf.singer\",\"admin.pnf.singer.add\",\"admin.pnf.singer.edit\",\"admin.pnf.singer.delete\",\"admin.pnf.musician\",\"admin.pnf.musician.add\",\"admin.pnf.musician.edit\",\"admin.pnf.musician.delete\",\"admin.pnf.partner\",\"admin.pnf.partner.add\",\"admin.pnf.partner.edit\",\"admin.pnf.partner.delete\",\"admin.pnf.musicdetail.list\",\"admin.pnf.musicdetail.add\",\"admin.pnf.musicdetail.edit\",\"admin.pnf.musicdetail.delete\",\"admin.pnf.actor\",\"admin.pnf.actor.add\",\"admin.pnf.actor.edit\",\"admin.pnf.actor.delete\",\"admin.pnf.director\",\"admin.pnf.director.add\",\"admin.pnf.director.edit\",\"admin.pnf.director.delete\",\"admin.pnf.filmmanufacturer\",\"admin.pnf.filmmanufacturer.add\",\"admin.pnf.filmmanufacturer.edit\",\"admin.pnf.filmmanufacturer.delete\"]',1,'2018-05-04 02:17:18','2018-01-04 04:16:20'),(3,'editor',NULL,1,'2018-05-05 19:52:41','2018-04-05 19:52:41'),(4,'Test','[\"admin\",\"admin.ho_kinh_doanh.list\",\"admin.ho_kinh_doanh.search\"]',1,'2018-06-19 03:28:24','2018-07-12 22:18:30');
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_group` int(2) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@gmail.com','$2y$10$y12vzPdwPQp7/dw4r6PEZeAUTvS/DC6zFSzclbn7BnVKuEtNCrQRe','Znd7wSCC6DJJm3WECt1LF0AlE5JUHT3K3I3yHdIxpT08E7hkYpN5R3nWdcHg',0,NULL,NULL,'2018-07-19 03:42:35'),(2,'bachnguyen91','nguyenthanhbach09087941@gmail.com','$2y$10$HW0KdLshRGzwk.p7LeKegevzxCrvbUhK8xY0e4Zz5YGcnprzwY46i',NULL,1,NULL,'2018-07-01 21:19:16','2018-07-01 23:52:01'),(5,'root','root@gmail.com','$2y$10$y12vzPdwPQp7/dw4r6PEZeAUTvS/DC6zFSzclbn7BnVKuEtNCrQRe','T3hl24ZZZFvgUkyjqNgNJCdH4ipex3QTrCnyp8gYKnlhKA7n2ar3pmXCD8G3',4,NULL,'2018-07-12 22:09:07','2018-07-20 03:22:38'),(6,'Tester Vitop','dao.nguyen@vitopmedia.com','$2y$10$jry9lhRSNfRkTGzeNBBOSuGdlRDb7kzer/dPZXnx8DHVf6U3RaHBS','9l1ZIV5uQYVFn4lCabBMXYxz4zX8xR5qKDWI8qhlV2lSEZWFpe3jNqxGUF4A',0,NULL,'2018-07-19 01:44:07','2018-07-19 03:33:10'),(7,'hao','admin123456@gmail.com','$2y$10$qAFrIDjDcsoQ/0bYXMwsw.1tssmy6Kh8nLslhMr1Yjl4djnM6ae2O','ALO7POrVAxkQCwrTfZKMNjRh69RC9gUNdpcdrSkBjjTPHTNhcSmM12wRKotz',1,NULL,'2018-07-19 03:38:50','2018-07-19 03:42:40'),(8,'Tester Vitop','dao.nguyen.vt@synova-solutions.com','$2y$10$Jdx7ZXnffGb5nE4Il/d9MOwh3WeQYnTLuEUuSWn3.hoBQQDLLJKKm','21iFyuNQaIFSDIZZkwaOfOayZ1cwjZLE6OUxA0IzYRf0iqGugsIMCOw0mHd2',3,NULL,'2018-07-19 03:40:48','2018-07-20 03:22:44'),(9,'Admin 123','ntanhdao176@gmail.com','$2y$10$2l7vjs8HhczuRyfz/QQIOeC0mb8hZIBjQnxD77bhQvX5ibtrzp8Ge','GGQP8VmYTR5E95J0K53iC6KXW2N0HOMNLMQgVwio2USd7DUFr12rUlPskJjb',1,NULL,'2018-07-19 03:42:04','2018-07-20 03:21:21'),(10,'Demo 1','guest@gmail.com','$2y$10$BDRNKtcSIbqOU45s.64LMeu/NylcvRPzj.JZ/7gduJtznHmgiqikW','QxVCVMMGlLkwEKjXvaBWXIjwq8UTluxsbTvJPjpF6Udx6TOJCMK7gkGIEo2u',0,NULL,'2018-07-19 03:49:05','2018-07-20 03:21:26'),(11,'L.b.trang','lebaotrang1810@gmail.com','$2y$10$ZcyB.XJffakOjzIGXYfUiOysuJ8eJy6qlV/9sawxr2JeW4amd4gbq',NULL,1,NULL,'2018-07-19 03:59:56','2018-07-19 18:36:20'),(12,'Demo 2','elizabethnguyen6368@gmail.com','$2y$10$TK4PcPJmjo9NKchzC1gE1uhhDWEXQ.1yPssGBEzyy.Bmvvzc/FJdG','Oot8cUtrsBsV3kAPOQo7jaebwPqZj4upINmI2NsOZQJoDVO4cIg7LNnt350b',1,NULL,'2018-07-19 04:08:06','2018-07-20 03:21:30'),(13,'L.b.trang','lebaotrang@gmail.com','$2y$10$LKaxajm8j7ZFaJxhR26DCeghi4NQLLXl5gudq2kKD9ssXLF1dzatS',NULL,3,NULL,'2018-07-19 18:39:27','2018-07-19 18:42:01');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-06 10:02:50
