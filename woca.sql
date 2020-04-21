/*
SQLyog Ultimate v8.6 Beta2
MySQL - 5.5.5-10.1.26-MariaDB : Database - cis_development
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cis_development` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cis_development`;

/*Table structure for table `dimx_dim` */

DROP TABLE IF EXISTS `dimx_dim`;

CREATE TABLE `dimx_dim` (
  `dim_id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(8) NOT NULL DEFAULT '',
  `no_usm` varchar(15) NOT NULL DEFAULT '',
  `jalur` varchar(20) DEFAULT NULL,
  `user_name` varchar(10) DEFAULT NULL,
  `kbk_id` varchar(20) DEFAULT NULL,
  `ref_kbk_id` int(11) DEFAULT NULL,
  `kpt_prodi` varchar(10) DEFAULT NULL,
  `id_kur` int(4) NOT NULL DEFAULT '0',
  `tahun_kurikulum_id` int(11) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `gol_darah` char(2) DEFAULT NULL,
  `golongan_darah_id` int(11) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `jenis_kelamin_id` int(11) DEFAULT NULL,
  `agama` varchar(30) DEFAULT NULL,
  `agama_id` int(11) DEFAULT NULL,
  `alamat` text,
  `kabupaten` varchar(50) DEFAULT NULL,
  `kode_pos` varchar(5) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `hp2` varchar(50) DEFAULT NULL,
  `no_ijazah_sma` varchar(100) DEFAULT NULL,
  `nama_sma` varchar(50) DEFAULT NULL,
  `asal_sekolah_id` int(11) DEFAULT NULL,
  `alamat_sma` text,
  `kabupaten_sma` varchar(100) DEFAULT NULL,
  `telepon_sma` varchar(50) DEFAULT NULL,
  `kodepos_sma` varchar(8) DEFAULT NULL,
  `thn_masuk` int(11) DEFAULT NULL,
  `status_akhir` varchar(50) DEFAULT 'Aktif',
  `nama_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `no_hp_ayah` varchar(50) DEFAULT NULL,
  `no_hp_ibu` varchar(50) DEFAULT NULL,
  `alamat_orangtua` text,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ayah_id` int(11) DEFAULT NULL,
  `keterangan_pekerjaan_ayah` text,
  `penghasilan_ayah` varchar(50) DEFAULT NULL,
  `penghasilan_ayah_id` int(11) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu_id` int(11) DEFAULT NULL,
  `keterangan_pekerjaan_ibu` text,
  `penghasilan_ibu` varchar(50) DEFAULT NULL,
  `penghasilan_ibu_id` int(11) DEFAULT NULL,
  `nama_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali_id` int(11) DEFAULT NULL,
  `keterangan_pekerjaan_wali` text,
  `penghasilan_wali` varchar(50) DEFAULT NULL,
  `penghasilan_wali_id` int(11) DEFAULT NULL,
  `alamat_wali` text,
  `telepon_wali` varchar(20) DEFAULT NULL,
  `no_hp_wali` varchar(50) DEFAULT NULL,
  `pendapatan` varchar(50) DEFAULT NULL,
  `ipk` float DEFAULT '0',
  `anak_ke` tinyint(4) DEFAULT NULL,
  `dari_jlh_anak` tinyint(4) DEFAULT NULL,
  `jumlah_tanggungan` tinyint(4) DEFAULT NULL,
  `nilai_usm` float DEFAULT NULL,
  `score_iq` tinyint(4) DEFAULT NULL,
  `rekomendasi_psikotest` varchar(4) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `kode_foto` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`dim_id`),
  UNIQUE KEY `NIM_UNIQUE` (`nim`),
  KEY `NIM` (`nim`),
  KEY `FK_dimx_dim_thn_krkm` (`tahun_kurikulum_id`),
  KEY `FK_dimx_dim_user` (`user_id`),
  KEY `FK_dimx_dim_ref_kbk` (`ref_kbk_id`),
  KEY `FK_dimx_dim_asal_sekolah` (`asal_sekolah_id`),
  KEY `FK_dimx_dim_golongan_darah` (`golongan_darah_id`),
  KEY `FK_dimx_dim_jenis_kelamin` (`jenis_kelamin_id`),
  KEY `FK_dimx_dim_agama` (`agama_id`),
  KEY `FK_dimx_dim_pekerjaan_ayah` (`pekerjaan_ayah_id`),
  KEY `FK_dimx_dim_penghasilan_ayah` (`penghasilan_ayah_id`),
  KEY `FK_dimx_dim_pekerjaan_ibu` (`pekerjaan_ibu_id`),
  KEY `FK_dimx_dim_penghasilan_ibu` (`penghasilan_ibu_id`),
  KEY `FK_dimx_dim_pekerjaan_wali` (`pekerjaan_wali_id`),
  KEY `FK_dimx_dim_penghasilan_wali_id` (`penghasilan_wali_id`),
  CONSTRAINT `FK_dimx_dim_agama` FOREIGN KEY (`agama_id`) REFERENCES `mref_r_agama` (`agama_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_asal_sekolah` FOREIGN KEY (`asal_sekolah_id`) REFERENCES `mref_r_asal_sekolah` (`asal_sekolah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_golongan_darah` FOREIGN KEY (`golongan_darah_id`) REFERENCES `mref_r_golongan_darah` (`golongan_darah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_jenis_kelamin` FOREIGN KEY (`jenis_kelamin_id`) REFERENCES `mref_r_jenis_kelamin` (`jenis_kelamin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_pekerjaan_ayah` FOREIGN KEY (`pekerjaan_ayah_id`) REFERENCES `mref_r_pekerjaan` (`pekerjaan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_pekerjaan_ibu` FOREIGN KEY (`pekerjaan_ibu_id`) REFERENCES `mref_r_pekerjaan` (`pekerjaan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_pekerjaan_wali` FOREIGN KEY (`pekerjaan_wali_id`) REFERENCES `mref_r_pekerjaan` (`pekerjaan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_penghasilan_ayah` FOREIGN KEY (`penghasilan_ayah_id`) REFERENCES `mref_r_penghasilan` (`penghasilan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_penghasilan_ibu` FOREIGN KEY (`penghasilan_ibu_id`) REFERENCES `mref_r_penghasilan` (`penghasilan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_penghasilan_wali_id` FOREIGN KEY (`penghasilan_wali_id`) REFERENCES `mref_r_penghasilan` (`penghasilan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_ref_kbk` FOREIGN KEY (`ref_kbk_id`) REFERENCES `inst_prodi` (`ref_kbk_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_thn_krkm` FOREIGN KEY (`tahun_kurikulum_id`) REFERENCES `krkm_r_tahun_kurikulum` (`tahun_kurikulum_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_user` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `dimx_dim` */

insert  into `dimx_dim`(`dim_id`,`nim`,`no_usm`,`jalur`,`user_name`,`kbk_id`,`ref_kbk_id`,`kpt_prodi`,`id_kur`,`tahun_kurikulum_id`,`nama`,`tgl_lahir`,`tempat_lahir`,`gol_darah`,`golongan_darah_id`,`jenis_kelamin`,`jenis_kelamin_id`,`agama`,`agama_id`,`alamat`,`kabupaten`,`kode_pos`,`email`,`telepon`,`hp`,`hp2`,`no_ijazah_sma`,`nama_sma`,`asal_sekolah_id`,`alamat_sma`,`kabupaten_sma`,`telepon_sma`,`kodepos_sma`,`thn_masuk`,`status_akhir`,`nama_ayah`,`nama_ibu`,`no_hp_ayah`,`no_hp_ibu`,`alamat_orangtua`,`pekerjaan_ayah`,`pekerjaan_ayah_id`,`keterangan_pekerjaan_ayah`,`penghasilan_ayah`,`penghasilan_ayah_id`,`pekerjaan_ibu`,`pekerjaan_ibu_id`,`keterangan_pekerjaan_ibu`,`penghasilan_ibu`,`penghasilan_ibu_id`,`nama_wali`,`pekerjaan_wali`,`pekerjaan_wali_id`,`keterangan_pekerjaan_wali`,`penghasilan_wali`,`penghasilan_wali_id`,`alamat_wali`,`telepon_wali`,`no_hp_wali`,`pendapatan`,`ipk`,`anak_ke`,`dari_jlh_anak`,`jumlah_tanggungan`,`nilai_usm`,`score_iq`,`rekomendasi_psikotest`,`foto`,`kode_foto`,`user_id`,`deleted`,`deleted_at`,`deleted_by`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (1,'11317027','',NULL,NULL,NULL,NULL,NULL,0,NULL,'Friska Sianturi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Aktif',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(2,'11317012','',NULL,NULL,NULL,NULL,NULL,0,NULL,'Jhon Panjaitan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Aktif',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(3,'11317003','',NULL,NULL,NULL,NULL,NULL,0,NULL,'William Lumbantobing',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Aktif',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(4,'11317038','',NULL,NULL,NULL,NULL,NULL,0,NULL,'Melisa Pangaribuan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Aktif',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `invt_pic_barang` */

DROP TABLE IF EXISTS `invt_pic_barang`;

CREATE TABLE `invt_pic_barang` (
  `pic_barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengeluaran_barang_id` int(11) DEFAULT NULL COMMENT 'id distribusi barang',
  `pegawai_id` int(11) DEFAULT NULL COMMENT 'pegawai PIC barang',
  `tgl_assign` date DEFAULT NULL,
  `keterangan` text,
  `is_unassign` tinyint(1) DEFAULT '0',
  `tgl_unassign` date DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pic_barang_id`),
  KEY `FK_invt_pic_barang` (`pengeluaran_barang_id`),
  KEY `FK_invt_pic_barang_pegawai` (`pegawai_id`),
  CONSTRAINT `FK_invt_pic_barang` FOREIGN KEY (`pengeluaran_barang_id`) REFERENCES `invt_pengeluaran_barang` (`pengeluaran_barang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_pic_barang_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `invt_pic_barang` */

/*Table structure for table `krkm_kuliah_prodi` */

DROP TABLE IF EXISTS `krkm_kuliah_prodi`;

CREATE TABLE `krkm_kuliah_prodi` (
  `krkm_kuliah_prodi_id` int(11) NOT NULL AUTO_INCREMENT,
  `kuliah_id` int(11) DEFAULT NULL,
  `ref_kbk_id` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`krkm_kuliah_prodi_id`),
  KEY `FK_krkm_kuliah_prodi` (`kuliah_id`),
  KEY `FK_krkm_kuliah_prodi_ref_kbk` (`ref_kbk_id`),
  CONSTRAINT `FK_krkm_kuliah_prodi` FOREIGN KEY (`kuliah_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_krkm_kuliah_prodi_ref_kbk` FOREIGN KEY (`ref_kbk_id`) REFERENCES `inst_prodi` (`ref_kbk_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `krkm_kuliah_prodi` */

/*Table structure for table `woca_kompetisi` */

DROP TABLE IF EXISTS `woca_kompetisi`;

CREATE TABLE `woca_kompetisi` (
  `kompetisi_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kompetisi` varchar(100) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `tingkatan_kompetisi_id` int(11) NOT NULL,
  `jumlah_peserta` int(10) DEFAULT NULL,
  `penyelenggara` varchar(32) DEFAULT NULL,
  `deskripsi` varchar(300) DEFAULT NULL,
  `status_kegiatan_id` int(11) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kompetisi_id`),
  KEY `NewIndex1` (`tingkatan_kompetisi_id`),
  KEY `FK_woca_status_kompetisi` (`status_kegiatan_id`),
  CONSTRAINT `FK_woca_status_kompetisi` FOREIGN KEY (`status_kegiatan_id`) REFERENCES `woca_r_status_kegiatan` (`status_kegiatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

/*Data for the table `woca_kompetisi` */

insert  into `woca_kompetisi`(`kompetisi_id`,`nama_kompetisi`,`tahun`,`tingkatan_kompetisi_id`,`jumlah_peserta`,`penyelenggara`,`deskripsi`,`status_kegiatan_id`,`deleted`,`deleted_at`,`deleted_by`,`created_at`,`created_by`,`updated_at`,`updated_by`) values (63,'INC',20180801,3,2,NULL,NULL,1,1,NULL,NULL,'2019-05-27 14:14:28','guest','2019-05-27 14:14:28','guest'),(71,'Compfest',20180803,1,2,NULL,NULL,1,1,NULL,NULL,'2019-06-06 06:10:39','guest','2019-06-06 06:10:39','guest'),(72,'Ideafuse',20180804,2,2,NULL,NULL,1,1,NULL,NULL,'2019-06-06 06:12:25','guest','2019-06-06 06:12:25','guest'),(73,'Vocompfets',20170804,1,2,NULL,NULL,1,1,NULL,NULL,'2019-06-06 06:13:06','guest','2019-06-06 06:13:06','guest'),(74,'Blala',20180804,4,2,NULL,NULL,1,1,NULL,NULL,'2019-06-06 06:15:24','guest','2019-06-06 06:15:24','guest'),(75,'Infest',20190606,1,2,NULL,NULL,1,1,NULL,NULL,'2019-06-06 06:15:48','guest','2019-06-06 06:15:48','guest'),(76,'PSM',20190606,1,2,NULL,NULL,1,1,NULL,NULL,'2019-06-06 06:27:17','guest','2019-06-06 06:27:17','guest'),(77,'INC',20190607,3,2,NULL,NULL,1,1,NULL,NULL,'2019-06-07 05:05:05','guest','2019-06-07 05:05:05','guest'),(78,'Arkavidia',20190607,1,2,NULL,'Perlombaan ini sangat membantu meningkatkan kreativitas mahasiswa',1,1,NULL,NULL,'2019-06-07 06:00:55','guest','2019-06-07 06:00:55','guest'),(79,'Compfest',20190607,1,4,NULL,'Perlombaan ini sangat membantu meningkatkan kreativitas mahasiswa',1,1,NULL,NULL,'2019-06-07 06:04:29','guest','2019-06-07 06:04:29','guest'),(80,'Ideafuse',20190610,3,4,NULL,NULL,1,1,NULL,NULL,'2019-06-10 18:09:27','guest','2019-06-10 18:09:27','guest'),(81,'INC',20190613,1,2,NULL,'Perlombaan ini sangat membantu meningkatkan kreativitas mahasiswa',1,1,NULL,NULL,'2019-06-12 06:20:18','guest','2019-06-12 06:20:18','guest'),(82,'Himasti COding Callenge',20190612,2,1,NULL,NULL,1,1,NULL,NULL,'2019-06-12 06:25:15','guest','2019-06-12 06:25:15','guest'),(83,'INC',20190614,2,2,NULL,'Perlombaan ini sangat membantu meningkatkan kreativitas mahasiswa',1,1,NULL,NULL,'2019-06-12 06:29:36','guest','2019-06-12 06:29:36','guest'),(84,'Google Hash Code',20190613,2,1,NULL,NULL,1,1,NULL,NULL,'2019-06-12 07:35:08','guest','2019-06-12 07:35:08','guest'),(85,'',NULL,0,1,NULL,NULL,1,1,NULL,NULL,'2019-06-12 07:38:30','guest','2019-06-12 07:38:30','guest'),(86,'Google Hash Code',2019,2,1,NULL,'Perlombaan ini sangat membantu meningkatkan kreativitas mahasiswa',1,1,NULL,NULL,'2019-06-12 07:50:35','guest','2019-06-12 07:50:35','guest'),(87,'Google Hash Code',2019,1,4,'Google','Dimulai sekarang sampe besok',2,0,NULL,NULL,'2019-06-14 20:32:51','guest','2019-06-18 23:08:03','guest'),(88,'KRI',2019,1,2,'Resdikti','Perlombaan ini sangat membantu meningkatkan kreativitas mahasiswa',2,0,NULL,NULL,'2019-06-14 22:29:57','guest','2019-06-18 23:07:31','guest'),(89,'KRI',2019,4,1,'Resdikti','perlombaan Hebat',3,0,NULL,NULL,'2019-06-14 22:33:12','guest','2019-06-18 23:07:46','guest'),(90,'Google Hash Code',2019,1,1,'Resdikti','hjgh',2,0,NULL,NULL,'2019-06-15 16:12:16','guest','2019-06-15 16:12:18','guest'),(91,'Google Hash Code',2019,1,1,'Resdikti','Hebat',2,0,NULL,NULL,'2019-06-18 14:40:21','guest','2019-06-18 23:07:13','guest'),(92,'Google Hash Code',2019,1,1,'Resdikti','Di jakarta',3,0,NULL,NULL,'2019-06-18 14:45:11','guest','2019-06-18 23:07:03','guest'),(93,'Code Like a Woman',2019,1,2,'Hackkerank','Dilakukan secara online',2,0,NULL,NULL,'2019-06-18 23:05:49','guest','2019-06-18 23:06:51','guest');

/*Table structure for table `woca_laporan_workshop_file` */

DROP TABLE IF EXISTS `woca_laporan_workshop_file`;

CREATE TABLE `woca_laporan_workshop_file` (
  `laporan_workshop_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_file` varchar(200) DEFAULT NULL,
  `lokasi_file` varchar(200) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`laporan_workshop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

/*Data for the table `woca_laporan_workshop_file` */

insert  into `woca_laporan_workshop_file`(`laporan_workshop_id`,`nama_file`,`lokasi_file`,`deleted`,`deleted_at`,`deleted_by`,`created_at`,`created_by`,`updated_at`,`updated_by`) values (12,'test','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/bi.docx',0,NULL,NULL,'2019-06-04 00:46:58','guest','2019-06-04 00:46:58','guest'),(13,'For_IB_50134.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50134.pdf',0,NULL,NULL,'2019-06-04 00:50:14','guest','2019-06-04 00:50:14','guest'),(14,'Form_IB_50134.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50134.pdf',0,NULL,NULL,'2019-06-04 00:52:05','guest','2019-06-04 00:52:05','guest'),(15,'IBnatal.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/IBnatal.pdf',0,NULL,NULL,'2019-06-04 00:53:19','guest','2019-06-04 00:53:19','guest'),(16,'IBnatal.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/IBnatal.pdf',0,NULL,NULL,'2019-06-04 00:55:51','guest','2019-06-04 00:55:51','guest'),(17,'Form_IB_50130.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50130.pdf',0,NULL,NULL,'2019-06-04 00:57:42','guest','2019-06-04 00:57:42','guest'),(18,'Form_IB_50130.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50130.pdf',0,NULL,NULL,'2019-06-04 00:59:23','guest','2019-06-04 00:59:23','guest'),(19,'Form_IB_50130.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50130.pdf',0,NULL,NULL,'2019-06-04 01:02:59','guest','2019-06-04 01:02:59','guest'),(20,'bi.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/bi.docx',0,NULL,NULL,'2019-06-04 01:31:36','guest','2019-06-04 01:31:36','guest'),(21,'bi.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/bi.docx',0,NULL,NULL,'2019-06-05 03:53:26','guest','2019-06-05 03:53:26','guest'),(22,'bibi.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/bi.docx',0,NULL,NULL,'2019-06-05 03:53:36','guest','2019-06-05 03:53:36','guest'),(23,'Form_IB_50130.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50130.pdf',0,NULL,NULL,'2019-06-06 04:43:01','guest','2019-06-06 04:43:01','guest'),(24,'kriipto.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/kriipto.pdf',0,NULL,NULL,'2019-06-10 18:08:32','guest','2019-06-10 18:08:32','guest'),(28,'Form_IB_50130.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50130.pdf',0,NULL,NULL,'2019-06-14 22:39:54','guest','2019-06-14 22:39:54','guest'),(30,'01._IntroductiontoTA1.ppt','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/01._IntroductiontoTA1.ppt',0,NULL,NULL,'2019-06-16 19:46:39','guest','2019-06-16 19:46:39','guest'),(31,'01._IntroductiontoTA1.ppt','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/01._IntroductiontoTA1.ppt',0,NULL,NULL,'2019-06-16 19:49:00','guest','2019-06-16 19:49:00','guest'),(32,'02.SOP Program Abang dan Kakak Asuh.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/02.SOP Program Abang dan Kakak Asuh.pdf',0,NULL,NULL,'2019-06-16 19:58:44','guest','2019-06-16 19:58:44','guest'),(33,'02.SOP Program Abang dan Kakak Asuh.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/02.SOP Program Abang dan Kakak Asuh.pdf',0,NULL,NULL,'2019-06-16 20:03:10','guest','2019-06-16 20:03:10','guest'),(34,'02.SOP Program Abang dan Kakak Asuh.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/02.SOP Program Abang dan Kakak Asuh.pdf',0,NULL,NULL,'2019-06-16 20:04:52','guest','2019-06-16 20:04:52','guest'),(35,'02.SOP Program Abang dan Kakak Asuh.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/02.SOP Program Abang dan Kakak Asuh.pdf',0,NULL,NULL,'2019-06-16 20:07:17','guest','2019-06-16 20:07:17','guest'),(36,'02.SOP Program Abang dan Kakak Asuh.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/02.SOP Program Abang dan Kakak Asuh.pdf',0,NULL,NULL,'2019-06-16 20:07:37','guest','2019-06-16 20:07:37','guest'),(37,'02.SOP Program Abang dan Kakak Asuh.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/02.SOP Program Abang dan Kakak Asuh.pdf',0,NULL,NULL,'2019-06-16 20:07:50','guest','2019-06-16 20:07:50','guest'),(38,'02.SOP Program Abang dan Kakak Asuh.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/02.SOP Program Abang dan Kakak Asuh.pdf',0,NULL,NULL,'2019-06-16 20:09:38','guest','2019-06-16 20:09:38','guest'),(39,'02.SOP Program Abang dan Kakak Asuh.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/02.SOP Program Abang dan Kakak Asuh.pdf',0,NULL,NULL,'2019-06-16 20:10:09','guest','2019-06-16 20:10:09','guest'),(40,'Form_IB_50134.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50134.pdf',0,NULL,NULL,'2019-06-16 20:10:54','guest','2019-06-16 20:10:54','guest'),(42,'Form_IB_50130.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50130.docx',0,NULL,NULL,'2019-06-16 20:58:56','guest','2019-06-16 20:58:56','guest'),(43,'Form_IB_50130.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50130.docx',0,NULL,NULL,'2019-06-16 21:02:42','guest','2019-06-16 21:02:42','guest'),(44,'Form_IB_50130.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50130.docx',0,NULL,NULL,'2019-06-16 21:02:52','guest','2019-06-16 21:02:52','guest'),(45,'Form_IB_50130.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50130.docx',0,NULL,NULL,'2019-06-16 21:04:07','guest','2019-06-16 21:04:07','guest'),(46,'Form_IB_50130.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50130.pdf',0,NULL,NULL,'2019-06-16 21:10:47','guest','2019-06-16 21:10:47','guest'),(47,'02.SOP Program Abang dan Kakak Asuh.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/02.SOP Program Abang dan Kakak Asuh.pdf',0,NULL,NULL,'2019-06-16 21:11:01','guest','2019-06-16 21:11:01','guest'),(48,'FORMULIR PENDAFTARAN ABANG DAN KAKAK ASUH.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/FORMULIR PENDAFTARAN ABANG DAN KAKAK ASUH.docx',0,NULL,NULL,'2019-06-16 21:11:19','guest','2019-06-16 21:11:19','guest'),(49,'02.SOP Program Abang dan Kakak Asuh.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/02.SOP Program Abang dan Kakak Asuh.pdf',0,NULL,NULL,'2019-06-16 21:12:53','guest','2019-06-16 21:12:53','guest'),(50,'IBnatal.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/IBnatal.pdf',0,NULL,NULL,'2019-06-17 11:00:37','guest','2019-06-17 11:00:37','guest'),(51,'bi.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/bi.docx',0,NULL,NULL,'2019-06-17 11:01:34','guest','2019-06-17 11:01:34','guest'),(52,'Form_IB_50134.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50134.pdf',0,NULL,NULL,'2019-06-17 11:01:54','guest','2019-06-17 11:01:54','guest'),(53,'Form_IB_50134.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50134.pdf',0,NULL,NULL,'2019-06-17 11:03:02','guest','2019-06-17 11:03:02','guest'),(54,'Form_IB_50134.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\fileWorkshop/Form_IB_50134.pdf',0,NULL,NULL,'2019-06-17 11:18:11','guest','2019-06-17 11:18:11','guest');

/*Table structure for table `woca_peserta` */

DROP TABLE IF EXISTS `woca_peserta`;

CREATE TABLE `woca_peserta` (
  `peserta_id` int(11) NOT NULL AUTO_INCREMENT,
  `kompetisi_id` int(11) DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`peserta_id`),
  KEY `id_kompetisi` (`kompetisi_id`),
  KEY `FK_woca_peserta` (`dim_id`),
  CONSTRAINT `FK_woca_peserta` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `woca_peserta_ibfk_1` FOREIGN KEY (`kompetisi_id`) REFERENCES `woca_kompetisi` (`kompetisi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

/*Data for the table `woca_peserta` */

insert  into `woca_peserta`(`peserta_id`,`kompetisi_id`,`dim_id`,`deleted`,`deleted_at`,`deleted_by`,`created_at`,`created_by`,`updated_at`,`updated_by`) values (1,63,1,0,NULL,NULL,'2019-05-27 14:14:28','guest','2019-05-27 14:14:28','guest'),(2,63,2,0,NULL,NULL,'2019-05-27 14:14:28','guest','2019-05-27 14:14:28','guest'),(3,71,1,0,NULL,NULL,'2019-06-06 06:10:40','guest','2019-06-06 06:10:40','guest'),(4,71,2,0,NULL,NULL,'2019-06-06 06:10:40','guest','2019-06-06 06:10:40','guest'),(5,72,1,0,NULL,NULL,'2019-06-06 06:12:25','guest','2019-06-06 06:12:25','guest'),(6,72,1,0,NULL,NULL,'2019-06-06 06:12:25','guest','2019-06-06 06:12:25','guest'),(7,73,1,0,NULL,NULL,'2019-06-06 06:13:06','guest','2019-06-06 06:13:06','guest'),(8,73,1,0,NULL,NULL,'2019-06-06 06:13:06','guest','2019-06-06 06:13:06','guest'),(9,74,1,0,NULL,NULL,'2019-06-06 06:15:25','guest','2019-06-06 06:15:25','guest'),(10,74,1,0,NULL,NULL,'2019-06-06 06:15:25','guest','2019-06-06 06:15:25','guest'),(11,75,1,0,NULL,NULL,'2019-06-06 06:15:49','guest','2019-06-06 06:15:49','guest'),(12,75,1,0,NULL,NULL,'2019-06-06 06:15:49','guest','2019-06-06 06:15:49','guest'),(13,76,1,0,NULL,NULL,'2019-06-06 06:27:17','guest','2019-06-06 06:27:17','guest'),(14,76,1,0,NULL,NULL,'2019-06-06 06:27:17','guest','2019-06-06 06:27:17','guest'),(15,77,1,0,NULL,NULL,'2019-06-07 05:05:06','guest','2019-06-07 05:05:06','guest'),(16,77,2,0,NULL,NULL,'2019-06-07 05:05:06','guest','2019-06-07 05:05:06','guest'),(17,78,4,0,NULL,NULL,'2019-06-07 06:00:56','guest','2019-06-07 06:00:56','guest'),(18,78,3,0,NULL,NULL,'2019-06-07 06:00:56','guest','2019-06-07 06:00:56','guest'),(19,78,2,0,NULL,NULL,'2019-06-07 06:00:56','guest','2019-06-07 06:00:56','guest'),(20,79,1,0,NULL,NULL,'2019-06-07 06:04:29','guest','2019-06-07 06:04:29','guest'),(21,79,3,0,NULL,NULL,'2019-06-07 06:04:29','guest','2019-06-07 06:04:29','guest'),(22,79,2,0,NULL,NULL,'2019-06-07 06:04:29','guest','2019-06-07 06:04:29','guest'),(23,79,4,0,NULL,NULL,'2019-06-07 06:04:29','guest','2019-06-07 06:04:29','guest'),(24,80,1,0,NULL,NULL,'2019-06-10 18:09:27','guest','2019-06-10 18:09:27','guest'),(25,80,2,0,NULL,NULL,'2019-06-10 18:09:27','guest','2019-06-10 18:09:27','guest'),(26,80,3,0,NULL,NULL,'2019-06-10 18:09:27','guest','2019-06-10 18:09:27','guest'),(27,80,4,0,NULL,NULL,'2019-06-10 18:09:27','guest','2019-06-10 18:09:27','guest'),(28,81,3,0,NULL,NULL,'2019-06-12 06:20:18','guest','2019-06-12 06:20:18','guest'),(29,81,2,0,NULL,NULL,'2019-06-12 06:20:18','guest','2019-06-12 06:20:18','guest'),(30,82,1,0,NULL,NULL,'2019-06-12 06:25:15','guest','2019-06-12 06:25:15','guest'),(31,NULL,3,0,NULL,NULL,'2019-06-12 06:29:36','guest','2019-06-12 06:29:36','guest'),(32,NULL,4,0,NULL,NULL,'2019-06-12 06:29:36','guest','2019-06-12 06:29:36','guest'),(33,84,1,0,NULL,NULL,'2019-06-12 07:35:08','guest','2019-06-12 07:35:08','guest'),(34,85,1,0,NULL,NULL,'2019-06-12 07:38:30','guest','2019-06-12 07:38:30','guest'),(35,86,1,0,NULL,NULL,'2019-06-12 07:50:35','guest','2019-06-12 07:50:35','guest'),(36,87,1,0,NULL,NULL,'2019-06-14 20:32:51','guest','2019-06-14 20:32:51','guest'),(37,87,2,0,NULL,NULL,'2019-06-14 20:32:51','guest','2019-06-14 20:32:51','guest'),(38,87,3,0,NULL,NULL,'2019-06-14 20:32:51','guest','2019-06-14 20:32:51','guest'),(39,87,4,0,NULL,NULL,'2019-06-14 20:32:51','guest','2019-06-14 20:32:51','guest'),(40,88,1,0,NULL,NULL,'2019-06-14 22:29:57','guest','2019-06-14 22:29:57','guest'),(41,88,4,0,NULL,NULL,'2019-06-14 22:29:57','guest','2019-06-14 22:29:57','guest'),(42,89,1,0,NULL,NULL,'2019-06-14 22:33:13','guest','2019-06-14 22:33:13','guest'),(43,90,2,0,NULL,NULL,'2019-06-15 16:12:17','guest','2019-06-15 16:12:17','guest'),(44,91,2,0,NULL,NULL,'2019-06-18 14:40:22','guest','2019-06-18 14:40:22','guest'),(45,92,2,0,NULL,NULL,'2019-06-18 14:45:11','guest','2019-06-18 14:45:11','guest'),(46,93,3,0,NULL,NULL,'2019-06-18 23:05:50','guest','2019-06-18 23:05:50','guest'),(47,93,1,0,NULL,NULL,'2019-06-18 23:05:50','guest','2019-06-18 23:05:50','guest');

/*Table structure for table `woca_prestasi` */

DROP TABLE IF EXISTS `woca_prestasi`;

CREATE TABLE `woca_prestasi` (
  `prestasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_prestasi_id` int(11) DEFAULT NULL,
  `nama_kompetisi` varchar(32) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `pelaksana` varchar(32) DEFAULT NULL,
  `status_kegiatan_id` int(11) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`prestasi_id`),
  KEY `FK_woca_prestasi` (`status_prestasi_id`),
  KEY `FK_woca_kegiatan_prestasi` (`status_kegiatan_id`),
  CONSTRAINT `FK_woca_kegiatan_prestasi` FOREIGN KEY (`status_kegiatan_id`) REFERENCES `woca_r_status_kegiatan` (`status_kegiatan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_woca_prestasi` FOREIGN KEY (`status_prestasi_id`) REFERENCES `woca_r_status_peserta` (`status_prestasi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `woca_prestasi` */

insert  into `woca_prestasi`(`prestasi_id`,`status_prestasi_id`,`nama_kompetisi`,`tahun`,`pelaksana`,`status_kegiatan_id`,`deleted`,`deleted_at`,`deleted_by`,`created_at`,`created_by`,`updated_at`,`updated_by`) values (1,1,'INC',2019,'ICPC',4,0,NULL,NULL,'2019-06-08 00:06:46','guest','2019-06-18 10:24:27','guest'),(2,2,'Compfet',2016,'ICPC',4,0,NULL,NULL,'2019-06-08 00:57:17','guest','2019-06-18 11:28:39','guest'),(3,5,'Compfest X',2017,'ICPC',2,0,NULL,NULL,'2019-06-08 00:58:57','guest','2019-06-18 11:42:10','guest'),(4,4,'Compfest',2018,'ICPC',3,0,NULL,NULL,'2019-06-08 01:00:01','guest','2019-06-18 11:42:20','guest'),(5,1,'Arkabividia',2019,'ICPC',2,0,NULL,NULL,'2019-06-08 01:02:59','guest','2019-06-19 16:03:20','guest'),(6,1,'Compfest',2019,'ICPC',3,0,NULL,NULL,'2019-06-14 14:51:07','guest','2019-06-19 16:04:55','guest'),(7,2,'Compfest',2019,'ICPC',1,0,NULL,NULL,'2019-06-14 14:52:00','guest','2019-06-14 14:52:00','guest'),(9,2,'INC',2019,'Mikroskil',1,0,NULL,NULL,'2019-06-14 16:52:16','guest','2019-06-14 16:52:16','guest'),(15,1,'Compfest',2019,'ICPC',1,0,NULL,NULL,'2019-06-18 11:27:18','guest','2019-06-18 12:31:49','guest');

/*Table structure for table `woca_proposal_kompetisi_file` */

DROP TABLE IF EXISTS `woca_proposal_kompetisi_file`;

CREATE TABLE `woca_proposal_kompetisi_file` (
  `proposal_kompetisi_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_proposal` varchar(32) DEFAULT NULL,
  `lokasi_proposal` varchar(100) DEFAULT NULL,
  `kompetisi_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`proposal_kompetisi_file_id`),
  KEY `FK_woca_proposal_kompetisi_file` (`kompetisi_id`),
  CONSTRAINT `FK_woca_proposal_kompetisi_file` FOREIGN KEY (`kompetisi_id`) REFERENCES `woca_kompetisi` (`kompetisi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `woca_proposal_kompetisi_file` */

insert  into `woca_proposal_kompetisi_file`(`proposal_kompetisi_file_id`,`file_proposal`,`lokasi_proposal`,`kompetisi_id`,`deleted`,`deleted_at`,`deleted_by`,`created_at`,`created_by`,`updated_at`,`updated_by`) values (1,'bi.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/bi.docx',NULL,0,NULL,NULL,'2019-06-06 06:10:40','guest','2019-06-06 06:10:40','guest'),(2,'bi.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/bi.docx',NULL,0,NULL,NULL,'2019-06-06 06:12:25','guest','2019-06-06 06:12:25','guest'),(3,'bi.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/bi.docx',NULL,0,NULL,NULL,'2019-06-06 06:13:06','guest','2019-06-06 06:13:06','guest'),(4,'bi.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/bi.docx',NULL,0,NULL,NULL,'2019-06-06 06:15:24','guest','2019-06-06 06:15:24','guest'),(5,'Form_IB_50130.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/Form_IB_50130.docx',NULL,0,NULL,NULL,'2019-06-06 06:15:49','guest','2019-06-06 06:15:49','guest'),(6,'Form_IB_50130.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/Form_IB_50130.docx',NULL,0,NULL,NULL,'2019-06-06 06:27:17','guest','2019-06-06 06:27:17','guest'),(7,'Formulir_IB_50134.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/Form_IB_50134.pdf',77,0,NULL,NULL,'2019-06-07 05:05:06','guest','2019-06-07 05:05:06','guest'),(8,'IBnatal.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/IBnatal.pdf',78,0,NULL,NULL,'2019-06-07 06:00:55','guest','2019-06-07 06:00:55','guest'),(9,'Form_IB_50130.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/Form_IB_50130.pdf',79,0,NULL,NULL,'2019-06-07 06:04:29','guest','2019-06-07 06:04:29','guest'),(10,'bi.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/bi.docx',80,0,NULL,NULL,'2019-06-10 18:09:27','guest','2019-06-10 18:09:27','guest'),(11,'Form_IB_50130.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/Form_IB_50130.pdf',81,0,NULL,NULL,'2019-06-12 06:20:18','guest','2019-06-12 06:20:18','guest'),(12,'Form_IB_50130.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/Form_IB_50130.pdf',82,0,NULL,NULL,'2019-06-12 06:25:15','guest','2019-06-12 06:25:15','guest'),(13,'kriipto.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/kriipto.pdf',84,0,NULL,NULL,'2019-06-12 07:35:08','guest','2019-06-12 07:35:08','guest'),(14,'Jurnal data v.2.doc','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/Jurnal data v.2.doc',86,0,NULL,NULL,'2019-06-12 07:50:35','guest','2019-06-12 07:50:35','guest'),(15,'bii.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/bi.docx',87,0,NULL,NULL,'2019-06-14 20:32:51','guest','2019-06-14 20:32:51','guest'),(16,'Form_IB_.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/Form_IB_50134.pdf',88,0,NULL,NULL,'2019-06-14 22:29:57','guest','2019-06-14 22:29:57','guest'),(17,'bi.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/bi.docx',89,0,NULL,NULL,'2019-06-14 22:33:12','guest','2019-06-14 22:33:12','guest'),(18,'bi.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/bi.docx',90,0,NULL,NULL,'2019-06-15 16:12:17','guest','2019-06-15 16:12:17','guest'),(19,'ERD.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/ERD.docx',91,0,NULL,NULL,'2019-06-18 14:40:22','guest','2019-06-18 14:40:22','guest'),(20,'ERD.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/ERD.docx',92,0,NULL,NULL,'2019-06-18 14:45:11','guest','2019-06-18 14:45:11','guest'),(21,'ERD.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\FileKompetisi/ERD.docx',93,0,NULL,NULL,'2019-06-18 23:05:50','guest','2019-06-18 23:05:50','guest');

/*Table structure for table `woca_r_status_kegiatan` */

DROP TABLE IF EXISTS `woca_r_status_kegiatan`;

CREATE TABLE `woca_r_status_kegiatan` (
  `status_kegiatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_kegiatan` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`status_kegiatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `woca_r_status_kegiatan` */

insert  into `woca_r_status_kegiatan`(`status_kegiatan_id`,`status_kegiatan`,`deleted`,`deleted_at`,`deleted_by`,`created_at`,`created_by`,`updated_at`,`updated_by`) values (1,'pending',0,NULL,NULL,NULL,NULL,NULL,NULL),(2,'setuju',0,NULL,NULL,NULL,NULL,NULL,NULL),(3,'tolak',0,NULL,NULL,NULL,NULL,NULL,NULL),(4,'cancel',0,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `woca_r_status_peserta` */

DROP TABLE IF EXISTS `woca_r_status_peserta`;

CREATE TABLE `woca_r_status_peserta` (
  `status_prestasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_prestasi_peserta` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `creted_by` varchar(32) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`status_prestasi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `woca_r_status_peserta` */

insert  into `woca_r_status_peserta`(`status_prestasi_id`,`status_prestasi_peserta`,`deleted`,`deleted_at`,`deleted_by`,`created_at`,`creted_by`,`update_at`,`update_by`) values (1,'Juara  I',0,NULL,NULL,NULL,NULL,NULL,NULL),(2,'Juara II',0,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Juara III',0,NULL,NULL,NULL,NULL,NULL,NULL),(4,'Juara Harapan  I',0,NULL,NULL,NULL,NULL,NULL,NULL),(5,'Juara Harapan II',0,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `woca_r_tingkatan_kompetisi` */

DROP TABLE IF EXISTS `woca_r_tingkatan_kompetisi`;

CREATE TABLE `woca_r_tingkatan_kompetisi` (
  `tingkatan_kompetisi_id` int(11) NOT NULL AUTO_INCREMENT,
  `tingkatan` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`tingkatan_kompetisi_id`),
  CONSTRAINT `FK_woca_r_tingkatan_kompetisi` FOREIGN KEY (`tingkatan_kompetisi_id`) REFERENCES `woca_kompetisi` (`tingkatan_kompetisi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `woca_r_tingkatan_kompetisi` */

insert  into `woca_r_tingkatan_kompetisi`(`tingkatan_kompetisi_id`,`tingkatan`,`deleted`,`deleted_at`,`deleted_by`,`created_at`,`created_by`,`updated_at`,`updated_by`) values (1,'Internasional',0,NULL,NULL,NULL,NULL,NULL,NULL),(2,'Provinsi',0,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Kabupaten',0,NULL,NULL,NULL,NULL,NULL,NULL),(4,'Nasional',0,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `woca_sertifikat_file` */

DROP TABLE IF EXISTS `woca_sertifikat_file`;

CREATE TABLE `woca_sertifikat_file` (
  `sertifikat_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `sertifikat_file` varchar(32) DEFAULT NULL,
  `lokasi_file` varchar(200) DEFAULT NULL,
  `prestasi_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`sertifikat_file_id`),
  KEY `FK_woca_sertifikat_file` (`prestasi_id`),
  CONSTRAINT `FK_woca_sertifikat_file` FOREIGN KEY (`prestasi_id`) REFERENCES `woca_prestasi` (`prestasi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `woca_sertifikat_file` */

insert  into `woca_sertifikat_file`(`sertifikat_file_id`,`sertifikat_file`,`lokasi_file`,`prestasi_id`,`deleted`,`deleted_at`,`deleted_by`,`created_at`,`created_by`,`updated_at`,`updated_by`) values (1,'IBnatl.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\foldersertifikat/IBnatal.pdf',1,0,NULL,NULL,'2019-06-08 00:05:42','guest','2019-06-08 00:05:42','guest'),(2,'IBnatal.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\foldersertifikat/IBnatal.pdf',NULL,0,NULL,NULL,'2019-06-08 00:06:46','guest','2019-06-08 00:06:46','guest'),(3,'Form_IB_50130.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\foldersertifikat/Form_IB_50130.pdf',3,0,NULL,NULL,'2019-06-08 00:57:17','guest','2019-06-08 00:57:17','guest'),(4,'IBnatal.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\foldersertifikat/IBnatal.pdf',4,0,NULL,NULL,'2019-06-08 00:58:58','guest','2019-06-08 00:58:58','guest'),(5,'IBnatal.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\foldersertifikat/IBnatal.pdf',2,0,NULL,NULL,'2019-06-08 01:00:01','guest','2019-06-08 01:00:01','guest'),(6,'Form_IB_50130.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\foldersertifikat/Form_IB_50130.pdf',5,0,NULL,NULL,'2019-06-08 01:02:59','guest','2019-06-08 01:02:59','guest'),(7,'bi.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\foldersertifikat/bi.docx',6,0,NULL,NULL,'2019-06-14 14:51:08','guest','2019-06-14 14:51:08','guest'),(8,'bi.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\foldersertifikat/bi.docx',7,0,NULL,NULL,'2019-06-14 14:52:00','guest','2019-06-14 14:52:00','guest'),(9,'bi.docx','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\foldersertifikat/bi.docx',9,0,NULL,NULL,'2019-06-14 16:52:16','guest','2019-06-14 16:52:16','guest'),(10,'Form_IB_50130.pdf','C:\\xampp1\\htdocs\\cis-lite\\backend\\File\\foldersertifikat/Form_IB_50130.pdf',15,0,NULL,NULL,'2019-06-18 11:27:18','guest','2019-06-18 11:27:18','guest');

/*Table structure for table `woca_tingkatan` */

DROP TABLE IF EXISTS `woca_tingkatan`;

CREATE TABLE `woca_tingkatan` (
  `tingkatan_kompetisi_id` int(11) DEFAULT NULL,
  `tingkatan` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `woca_tingkatan` */

/*Table structure for table `woca_workshop` */

DROP TABLE IF EXISTS `woca_workshop`;

CREATE TABLE `woca_workshop` (
  `workshop_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_kegiatan_id` int(11) DEFAULT '1',
  `laporan_workshop_id` int(11) DEFAULT NULL,
  `judul_workshop` varchar(32) DEFAULT NULL,
  `tanggal_mulai` datetime DEFAULT NULL,
  `tanggal_berakhir` datetime DEFAULT NULL,
  `pelaksana` varchar(32) DEFAULT NULL,
  `pembicara` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`workshop_id`),
  KEY `FK_woca_workshop` (`laporan_workshop_id`),
  KEY `FK_woca_workshop_status` (`status_kegiatan_id`),
  CONSTRAINT `FK_woca_workshop` FOREIGN KEY (`laporan_workshop_id`) REFERENCES `woca_laporan_workshop_file` (`laporan_workshop_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_woca_workshop_status` FOREIGN KEY (`status_kegiatan_id`) REFERENCES `woca_r_status_kegiatan` (`status_kegiatan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

/*Data for the table `woca_workshop` */

insert  into `woca_workshop`(`workshop_id`,`status_kegiatan_id`,`laporan_workshop_id`,`judul_workshop`,`tanggal_mulai`,`tanggal_berakhir`,`pelaksana`,`pembicara`,`deleted`,`deleted_at`,`deleted_by`,`created_at`,`created_by`,`updated_at`,`updated_by`) values (50,2,22,'Artificial Inteligence in Life','2019-06-14 11:35:00','2019-06-17 12:00:00','IDN','Jhon',0,NULL,NULL,'2019-06-05 03:53:36','guest','2019-06-19 15:42:34','guest'),(51,3,23,'Artificial Inteligence in Life','2019-06-14 11:35:00','2019-06-17 12:00:00','IDN','William',0,NULL,NULL,'2019-06-06 04:43:01','guest','2019-06-19 15:42:43','guest'),(56,1,28,'Artificial Inteligence in Life','2019-06-14 11:35:00','2019-06-17 12:00:00','Gojek','Melisa',0,NULL,NULL,'2019-06-14 22:39:53','guest','2019-06-14 22:39:54','guest'),(65,2,53,'Artificial Inteligence in Life','2019-06-14 11:35:00','2019-06-17 12:00:00','IDN','Friska L Sianturi',0,NULL,NULL,'2019-06-16 21:02:41','guest','2019-06-17 16:16:17','guest'),(66,4,44,'Artificial Inteligence in Life','2019-06-14 11:35:00','2019-06-17 12:00:00','IDN','Friska L Sianturi',0,NULL,NULL,'2019-06-16 21:02:52','guest','2019-06-17 11:22:19','guest'),(67,1,49,'Artificial Inteligence in  ALife','2019-06-14 11:35:00','2019-06-17 12:00:00','IDN','Friska L Sianturi',0,NULL,NULL,'2019-06-16 21:04:07','guest','2019-06-17 15:18:08','guest'),(68,1,54,'Robotic','2019-06-17 11:00:00','2019-06-17 12:00:00','Resdikti','V',0,NULL,NULL,'2019-06-17 11:18:11','guest','2019-06-17 16:16:00','guest');

/* Procedure structure for procedure `create_syllabus_by_komposisi_nilai` */

/*!50003 DROP PROCEDURE IF EXISTS  `create_syllabus_by_komposisi_nilai` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`cis_db_admin`@`%` PROCEDURE `create_syllabus_by_komposisi_nilai`()
BEGIN
DECLARE ta_syllabus VARCHAR(10);
declare _id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id varchar(10);
declare rows_count,i, syllabus_count int;
DECLARE curs1 CURSOR FOR SELECT count(a.ta)
FROM `nlai_komposisi_nilai` a
LEFT OUTER JOIN `prkl_kurikulum_syllabus` b
ON a.`kurikulum_syllabus_id` = b.`kurikulum_syllabus_id`
INNER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
DECLARE curs2 cursor for SELECT b.ta,a.id_kur,a.kode_mk,a.ta,a.sem_ta,c.kuliah_id,d.ta_id
FROM `nlai_komposisi_nilai` a
LEFT OUTER JOIN `prkl_kurikulum_syllabus` b
ON a.`kurikulum_syllabus_id` = b.`kurikulum_syllabus_id`
INNER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
open curs1;
	fetch curs1 into rows_count;
close curs1;
open curs2;
Set i=1;
REPEAT
    FETCH curs2 INTO ta_syllabus,_id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id;
    if ta_syllabus is null then
    
	Select count(*) into syllabus_count FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	if syllabus_count=0 then
		insert into `prkl_kurikulum_syllabus` (`id_kur`,`kode_mk`,`ta`,`sem_ta`,`kuliah_id`,`ta_id`) values(_id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id);
	end if;
		
	update `nlai_komposisi_nilai`
	set `kurikulum_syllabus_id`=(select `kurikulum_syllabus_id` from `prkl_kurikulum_syllabus` where `id_kur`=_id_kur and `kode_mk`=_kode_mk and `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `prkl_materi`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `prkl_praktikum`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_nilai`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_nilai_praktikum`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_nilai_quis`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_nilai_tugas`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_nilai_uas`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_nilai_uts`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_rentang_nilai`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
    end if;
    set i=i+1;
UNTIL i>rows_count END REPEAT;
close curs2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `create_syllabus_by_nilai` */

/*!50003 DROP PROCEDURE IF EXISTS  `create_syllabus_by_nilai` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`cis_db_admin`@`%` PROCEDURE `create_syllabus_by_nilai`()
BEGIN
DECLARE syllabus_id VARCHAR(10);
DECLARE _id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id VARCHAR(10);
DECLARE rows_count,i, syllabus_count INT;
DECLARE curs1 CURSOR FOR SELECT COUNT(a.ta)
FROM `nlai_nilai` a
LEFT OUTER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
DECLARE curs2 CURSOR FOR SELECT a.kurikulum_syllabus_id,a.id_kur,a.kode_mk,a.ta,a.sem_ta,c.kuliah_id,d.ta_id
FROM `nlai_nilai` a
LEFT OUTER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
OPEN curs1;
	FETCH curs1 INTO rows_count;
CLOSE curs1;
OPEN curs2;
SET i=1;
REPEAT
    FETCH curs2 INTO syllabus_id,_id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id;
    IF syllabus_id IS NULL THEN
    
	SELECT COUNT(*) INTO syllabus_count FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	IF syllabus_count=0 THEN
		INSERT INTO `prkl_kurikulum_syllabus` (`id_kur`,`kode_mk`,`ta`,`sem_ta`,`kuliah_id`,`ta_id`) VALUES(_id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id);
	END IF;
			
	UPDATE `nlai_nilai`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_rentang_nilai`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
    END IF;
    SET i=i+1;
UNTIL i>rows_count END REPEAT;
CLOSE curs2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `create_syllabus_by_prkl_materi` */

/*!50003 DROP PROCEDURE IF EXISTS  `create_syllabus_by_prkl_materi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`cis_db_admin`@`%` PROCEDURE `create_syllabus_by_prkl_materi`()
BEGIN
DECLARE syllabus_id VARCHAR(10);
DECLARE _id_kur,_kode_mk,_ta,_sem,_kuliah_id,_ta_id VARCHAR(10);
DECLARE rows_count,i, syllabus_count,_sem_ta INT;
DECLARE curs1 CURSOR FOR SELECT COUNT(a.ta)
FROM `prkl_materi` a
LEFT OUTER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
DECLARE curs2 CURSOR FOR SELECT a.`kurikulum_syllabus_id`,a.id_kur,a.kode_mk,a.ta,c.sem,c.kuliah_id,d.ta_id
FROM `prkl_materi` a
LEFT OUTER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
OPEN curs1;
	FETCH curs1 INTO rows_count;
CLOSE curs1;
OPEN curs2;
SET i=1;
REPEAT
    FETCH curs2 INTO syllabus_id,_id_kur,_kode_mk,_ta,_sem,_kuliah_id,_ta_id;
    IF syllabus_id IS NULL THEN
    
	SELECT COUNT(*) INTO syllabus_count FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	IF (_sem MOD 2)=0 THEN
		SET _sem_ta=2;
	ELSE
		SET _sem_ta=1;
	END IF;
	
	
	IF syllabus_count=0 THEN
		INSERT INTO `prkl_kurikulum_syllabus` (`id_kur`,`kode_mk`,`ta`,`sem_ta`,`kuliah_id`,`ta_id`) VALUES(_id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id);
	END IF;
		
	UPDATE `prkl_materi`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
    END IF;
    SET i=i+1;
UNTIL i>rows_count END REPEAT;
CLOSE curs2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `create_syllabus_by_prkl_praktikum` */

/*!50003 DROP PROCEDURE IF EXISTS  `create_syllabus_by_prkl_praktikum` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`cis_db_admin`@`%` PROCEDURE `create_syllabus_by_prkl_praktikum`()
BEGIN
DECLARE syllabus_id VARCHAR(10);
DECLARE _id_kur,_kode_mk,_ta,_sem,_kuliah_id,_ta_id VARCHAR(10);
DECLARE rows_count,i, syllabus_count,_sem_ta INT;
DECLARE curs1 CURSOR FOR SELECT COUNT(a.ta)
FROM `prkl_praktikum` a
LEFT OUTER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
DECLARE curs2 CURSOR FOR SELECT a.`kurikulum_syllabus_id`,a.id_kur,a.kode_mk,a.ta,c.sem,c.kuliah_id,d.ta_id
FROM `prkl_praktikum` a
LEFT OUTER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
OPEN curs1;
	FETCH curs1 INTO rows_count;
CLOSE curs1;
OPEN curs2;
SET i=1;
REPEAT
    FETCH curs2 INTO syllabus_id,_id_kur,_kode_mk,_ta,_sem,_kuliah_id,_ta_id;
    IF syllabus_id IS NULL THEN
    
	SELECT COUNT(*) INTO syllabus_count FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	IF (_sem MOD 2)=0 THEN
		SET _sem_ta=2;
	ELSE
		SET _sem_ta=1;
	END IF;
	
	
	IF syllabus_count=0 THEN
		INSERT INTO `prkl_kurikulum_syllabus` (`id_kur`,`kode_mk`,`ta`,`sem_ta`,`kuliah_id`,`ta_id`) VALUES(_id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id);
	END IF;
		
	UPDATE `prkl_praktikum`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
    END IF;
    SET i=i+1;
UNTIL i>rows_count END REPEAT;
CLOSE curs2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `migrate_data_to_kuliah_prodi` */

/*!50003 DROP PROCEDURE IF EXISTS  `migrate_data_to_kuliah_prodi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`cis_db_admin`@`%` PROCEDURE `migrate_data_to_kuliah_prodi`()
BEGIN
DECLARE _kuliah_id, _ref_kbk_id, _sem INT;
DECLARE krkm_kuliah_count, i, j, max_prodi INT;
DECLARE curs_krkm_kuliah CURSOR FOR SELECT `kuliah_id`, `ref_kbk_id`, `sem` FROM `krkm_kuliah`;
DECLARE curs_krkm_kuliah_count CURSOR FOR SELECT COUNT(*) FROM `krkm_kuliah`;
OPEN curs_krkm_kuliah_count;
	FETCH curs_krkm_kuliah_count INTO krkm_kuliah_count;
CLOSE curs_krkm_kuliah_count;
OPEN curs_krkm_kuliah;
	SET i=1;
	REPEAT
	FETCH curs_krkm_kuliah INTO _kuliah_id, _ref_kbk_id, _sem;
	IF _ref_kbk_id=11 THEN
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 1, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 2, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 3, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 4, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 5, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 6, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 7, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 8, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 9, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 10, _sem);
	ELSEIF _ref_kbk_id=12 THEN
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 1, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 2, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 3, _sem);
	ELSEIF _ref_kbk_id=13 THEN
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 4, _sem);
	ELSEIF _ref_kbk_id=14 THEN
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 6, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 7, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 8, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 9, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 10, _sem);
	ELSE
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, _ref_kbk_id, _sem);
	END IF;
	SET i=i+1;
	UNTIL i>krkm_kuliah_count END REPEAT;
CLOSE curs_krkm_kuliah;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
