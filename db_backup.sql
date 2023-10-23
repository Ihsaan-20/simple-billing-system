/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.27-MariaDB : Database - pos_system_php
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pos_system_php` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `pos_system_php`;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varbinary(255) DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL,
  `profile` blob DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `admins` */

insert  into `admins`(`id`,`name`,`email`,`password`,`phone`,`status`,`profile`,`created_at`,`updated_at`) values 
(1,'Irfan Gohar','irfan@gmail.com','$2y$10$muOQ5pxOeXO8zs5GNJq6x.4nJxBn673cQig07pFhdLy6.MDZoQp3W','03163274810','1',NULL,'2023-10-19 16:14:09',NULL),
(4,'Aftab Gohar','aftab@gmail.com','$2y$10$tbp4JElDP6e6IXh3KgHkTOi0VOiqBwkX0czOxeuzp60gEQicJRtiO','03157073692','1',NULL,'2023-10-21 20:31:58',NULL);

/*Table structure for table `brands` */

DROP TABLE IF EXISTS `brands`;

CREATE TABLE `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `brands` */

insert  into `brands`(`id`,`brand_name`,`created_at`,`updated_at`) values 
(1,'My Brand','2023-10-21 20:51:37',NULL),
(2,'Your Brand','2023-10-21 20:51:46',NULL);

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `customer_shop_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `customers` */

insert  into `customers`(`id`,`customer_code`,`customer_name`,`customer_phone`,`customer_address`,`customer_shop_name`,`created_at`,`updated_at`) values 
(1,'CUS-1697732980','Ihsan Chandio','03157073692','Badarabad','Ihsan Kiryana','2023-10-19 19:49:46','2023-10-19 21:29:40'),
(4,'CUS-1697810783','Seth Aftab Chandio','03193722692','Badarabad Colony Dadu','Usman Kiryana','2023-10-20 19:06:23',NULL),
(5,'CUS-1697900900','Javeed Sindhi','03157073692','New Chnowk Thatta','Javeed Kiryana','2023-10-21 01:05:50','2023-10-21 20:08:20'),
(6,'CUS-1697832752','Khuda Bux','03157073692','Near SP chwnk','Sweet Shop','2023-10-21 01:12:32',NULL),
(7,'CUS-1697901145','New Customer','0315','badrabad','naya shop','0000-00-00 00:00:00',NULL),
(8,'CUS-1697902359','Seth Abdullah','03157073692','New Chnowk','Ab Shop','2023-10-21 20:32:39',NULL),
(9,'CUS-1697914465','Tom','0315','naya tom','toomi','2023-10-21 23:54:25',NULL);

/*Table structure for table `invoice_items` */

DROP TABLE IF EXISTS `invoice_items`;

CREATE TABLE `invoice_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `invoice_items` */

insert  into `invoice_items`(`id`,`invoice_id`,`item_id`,`price`,`quantity`,`unit`,`created_at`) values 
(1,1,8,1500,1,'Ptk','2023-10-21 20:54:01'),
(2,2,8,1500,5,'Ptk','2023-10-21 21:24:18'),
(3,3,8,1500,1,'Ctn','2023-10-21 21:43:04'),
(4,4,7,500,3,'Ptk','2023-10-22 00:00:21'),
(5,5,7,500,1,'Ptk','2023-10-22 00:02:51'),
(6,6,7,500,1,'Ctn','2023-10-22 00:13:05'),
(7,7,8,1500,7,'Ctn','2023-10-22 01:00:09'),
(8,8,8,1500,1,'Ptk','2023-10-22 01:07:03'),
(9,9,7,500,1,'Ptk','2023-10-22 01:55:30'),
(10,10,6,150,1,'Ctn','2023-10-22 02:01:22'),
(11,11,6,150,50,'Ctn','2023-10-22 02:03:40'),
(12,12,8,1500,100,'Ctn','2023-10-22 02:05:06'),
(13,13,6,150,1,'Ctn','2023-10-22 02:05:53'),
(14,14,4,350,1,'Ctn','2023-10-22 02:06:26'),
(15,15,5,1500,1,'Ctn','2023-10-22 02:07:24'),
(16,16,5,1500,1,'Ctn','2023-10-22 02:13:06');

/*Table structure for table `invoices` */

DROP TABLE IF EXISTS `invoices`;

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `order_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `invoices` */

insert  into `invoices`(`id`,`customer_id`,`invoice_number`,`order_number`,`payment_method`,`total_amount`,`order_by`,`created_at`) values 
(1,7,'INV-1697903637','ORD-1697903637','cash',1500,'Irfan Gohar','2023-10-21 20:54:01'),
(2,8,'INV-1697905454','ORD-1697905454','cash',7500,'Irfan Gohar','2023-10-21 21:24:18'),
(3,6,'INV-1697906582','ORD-1697906582','cash',1500,'Irfan Gohar','2023-10-21 21:43:04'),
(4,7,'INV-1697914817','ORD-1697914817','online',1500,'Irfan Gohar','2023-10-22 00:00:21'),
(5,7,'INV-1697914968','ORD-1697914968','online',500,'Irfan Gohar','2023-10-22 00:02:51'),
(6,6,'INV-1697915576','ORD-1697915576','cash',500,'Irfan Gohar','2023-10-22 00:13:05'),
(7,8,'INV-1697918407','ORD-1697918407','online',10500,'Irfan Gohar','2023-10-22 01:00:09'),
(8,6,'INV-1697918821','ORD-1697918821','online',1500,'Irfan Gohar','2023-10-22 01:07:03'),
(9,8,'INV-1697921727','ORD-1697921727','online',500,'Irfan Gohar','2023-10-22 01:55:30'),
(10,7,'INV-1697922080','ORD-1697922080','online',150,'Irfan Gohar','2023-10-22 02:01:22'),
(11,6,'INV-1697922217','ORD-1697922217','online',7500,'Irfan Gohar','2023-10-22 02:03:40'),
(12,4,'INV-1697922303','ORD-1697922303','online',150000,'Irfan Gohar','2023-10-22 02:05:06'),
(13,5,'INV-1697922349','ORD-1697922349','online',150,'Irfan Gohar','2023-10-22 02:05:53'),
(14,6,'INV-1697922381','ORD-1697922381','cash',350,'Irfan Gohar','2023-10-22 02:06:26'),
(15,5,'INV-1697922442','ORD-1697922442','cash',1500,'Irfan Gohar','2023-10-22 02:07:24'),
(16,5,'INV-1697922784','ORD-1697922784','cash',1500,'Irfan Gohar','2023-10-22 02:13:06');

/*Table structure for table `items` */

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) DEFAULT NULL,
  `item_code` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `items` */

insert  into `items`(`id`,`brand_id`,`item_code`,`item_name`,`price`,`qty`,`created_at`,`updated_at`) values 
(1,7,'ITEM-1697746905','Green Nimko',250,NULL,'2023-10-20 01:16:44','2023-10-20 01:21:45'),
(2,7,'ITEM-1697746894','Mazeedar Daal 2',150,NULL,'2023-10-20 01:17:04','2023-10-20 01:21:34'),
(3,4,'ITEM-1697747046','Khata metha',300,NULL,'2023-10-20 01:24:06','2023-10-21 20:54:32'),
(4,3,'ITEM-1697749296','Matan Pulao',350,NULL,'2023-10-20 02:01:36','2023-10-21 20:54:30'),
(5,5,'ITEM-1697900968','Mehanga wala nimko',1500,NULL,'2023-10-21 19:56:07','2023-10-21 20:09:28'),
(6,7,'ITEM-1697900982','koi item',150,NULL,'2023-10-21 20:09:42','2023-10-21 20:54:28'),
(7,9,'ITEM-1697902491','aSDAS',500,NULL,'2023-10-21 20:34:51','2023-10-21 20:54:25'),
(8,2,'ITEM-1697903554','ye loo nimko',1500,NULL,'2023-10-21 20:52:26','2023-10-21 20:52:34');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
