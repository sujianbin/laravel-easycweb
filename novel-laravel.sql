/*
SQLyog Ultimate v12.08 (64 bit)
MySQL - 5.7.19-log : Database - novel_laravel_c
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`novel_laravel_c` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `novel_laravel_c`;

/*Table structure for table `dd_admin` */

DROP TABLE IF EXISTS `dd_admin`;

CREATE TABLE `dd_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `ip` varchar(100) DEFAULT NULL COMMENT '登陆ip',
  `login_time` datetime DEFAULT NULL COMMENT '登陆时间',
  `role_id` int(10) DEFAULT NULL COMMENT '角色id',
  `create_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='管理员表';

/*Data for the table `dd_admin` */

insert  into `dd_admin`(`id`,`username`,`password`,`ip`,`login_time`,`role_id`,`create_at`,`update_at`) values (1,'admin','$2y$10$T/KHqEuKQker7dCSbdHHju6HN9zOPOEiOXDvbkm8fatMYkDWrIXQG','::1','2018-09-14 23:37:48',1,0,NULL),(3,'admin2','$2y$10$T/KHqEuKQker7dCSbdHHju6HN9zOPOEiOXDvbkm8fatMYkDWrIXQG','127.0.0.1','2017-09-27 09:29:51',2,0,NULL),(4,'wenan','$2y$10$T/KHqEuKQker7dCSbdHHju6HN9zOPOEiOXDvbkm8fatMYkDWrIXQG','','0000-00-00 00:00:00',3,0,NULL),(7,'config','$2y$10$T/KHqEuKQker7dCSbdHHju6HN9zOPOEiOXDvbkm8fatMYkDWrIXQG','','0000-00-00 00:00:00',2,0,NULL);

/*Table structure for table `dd_admin_role` */

DROP TABLE IF EXISTS `dd_admin_role`;

CREATE TABLE `dd_admin_role` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `role_name` varchar(50) NOT NULL COMMENT '角色名称',
  `role_description` varchar(100) NOT NULL COMMENT '角色描述',
  `right` varchar(255) NOT NULL COMMENT '权限列表',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='角色表';

/*Data for the table `dd_admin_role` */

insert  into `dd_admin_role`(`id`,`role_name`,`role_description`,`right`) values (1,'超级管理员','超级管理员','0'),(2,'系统设置','网站基本设置管理和权限分配','3,4,6'),(3,'网站编辑','负责网站前台内容的编辑','1,2,5');

/*Table structure for table `dd_system_menu` */

DROP TABLE IF EXISTS `dd_system_menu`;

CREATE TABLE `dd_system_menu` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `group_id` int(5) DEFAULT NULL COMMENT '分组id',
  `menu_name` varchar(50) DEFAULT NULL COMMENT '菜单名称',
  `menu_route` varchar(50) DEFAULT NULL COMMENT '菜单路由',
  `order_id` decimal(6,0) DEFAULT NULL COMMENT '权重id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

/*Data for the table `dd_system_menu` */

/*Table structure for table `dd_system_menu_group` */

DROP TABLE IF EXISTS `dd_system_menu_group`;

CREATE TABLE `dd_system_menu_group` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `group_name` varchar(50) DEFAULT NULL COMMENT '分组名称',
  `group_en_name` varchar(50) DEFAULT NULL COMMENT '分组英文名称',
  `order_id` decimal(6,0) DEFAULT '1000' COMMENT '权重id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

/*Data for the table `dd_system_menu_group` */

/*Table structure for table `dd_system_right` */

DROP TABLE IF EXISTS `dd_system_right`;

CREATE TABLE `dd_system_right` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `group` varchar(50) DEFAULT NULL COMMENT '分组',
  `right` text COMMENT '权限集合',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '是否展示',
  `type` tinyint(1) DEFAULT '1' COMMENT '模型类型1、admin',
  `order_id` decimal(6,0) DEFAULT '1000' COMMENT '排序id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限列表';

/*Data for the table `dd_system_right` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
