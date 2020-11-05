/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : www_fa_com

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-11-05 10:20:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for fa_admin
-- ----------------------------
DROP TABLE IF EXISTS `fa_admin`;
CREATE TABLE `fa_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '账号',
  `password` varchar(100) DEFAULT NULL COMMENT '密码',
  `password_translation` varchar(100) DEFAULT NULL COMMENT '密码翻译',
  `update_time` int(11) DEFAULT NULL COMMENT '更改时间',
  `del_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `status` tinyint(2) DEFAULT '1' COMMENT '1正常  2删除',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fa_admin
-- ----------------------------
INSERT INTO `fa_admin` VALUES ('1', 'admin', '670b14728ad9902aecba32e22fa4f6bd', '000000', '1604473485', null, '1', null);
INSERT INTO `fa_admin` VALUES ('2', 'majipeng', '670b14728ad9902aecba32e22fa4f6bd', '000000', '1604472237', null, '1', null);
INSERT INTO `fa_admin` VALUES ('3', 'xiaoming', '670b14728ad9902aecba32e22fa4f6bd', '000000', null, null, '1', '1604471216');
INSERT INTO `fa_admin` VALUES ('4', 'xiaofang', '670b14728ad9902aecba32e22fa4f6bd', '000000', null, null, '1', '1604471283');

-- ----------------------------
-- Table structure for fa_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `fa_auth_group`;
CREATE TABLE `fa_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `del_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fa_auth_group
-- ----------------------------
INSERT INTO `fa_auth_group` VALUES ('1', '角色组管理', '1', '6,7,8,11', '1604466955', '1604468669', null);
INSERT INTO `fa_auth_group` VALUES ('2', '权限规则管理', '1', '2,3,4,10', '1604467044', null, null);
INSERT INTO `fa_auth_group` VALUES ('3', '用户管理部分', '1', '19,20,21,22', '1604473736', '1604542473', null);

-- ----------------------------
-- Table structure for fa_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `fa_auth_group_access`;
CREATE TABLE `fa_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fa_auth_group_access
-- ----------------------------
INSERT INTO `fa_auth_group_access` VALUES ('2', '3');
INSERT INTO `fa_auth_group_access` VALUES ('3', '1');
INSERT INTO `fa_auth_group_access` VALUES ('4', '2');

-- ----------------------------
-- Table structure for fa_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `fa_auth_rule`;
CREATE TABLE `fa_auth_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT '',
  `title` char(20) DEFAULT '',
  `type` tinyint(1) DEFAULT '1',
  `status` tinyint(1) DEFAULT '1' COMMENT '1正常  2删除',
  `condition` char(100) DEFAULT '0',
  `pid` int(11) DEFAULT NULL COMMENT '父级ID',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `del_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fa_auth_rule
-- ----------------------------
INSERT INTO `fa_auth_rule` VALUES ('1', 'authgroup', '权限规则', '1', '1', '0', '0', '1604386719', '1604387938', null);
INSERT INTO `fa_auth_rule` VALUES ('2', 'admin/auth/authadd', '权限规则添加', '1', '1', '0', '1', '1604386719', '1604388526', null);
INSERT INTO `fa_auth_rule` VALUES ('3', 'admin/auth/authedit', '权限规则修改', '1', '1', '0', '1', '1604386719', null, null);
INSERT INTO `fa_auth_rule` VALUES ('4', 'admin/auth/authdel', '权限规则删除', '1', '1', '0', '1', '1604386719', null, null);
INSERT INTO `fa_auth_rule` VALUES ('5', 'group', '角色组', '1', '1', '0', '0', '1604386679', null, null);
INSERT INTO `fa_auth_rule` VALUES ('6', 'admin/auth/groupadd', '角色组添加', '1', '1', '0', '5', '1604386719', null, null);
INSERT INTO `fa_auth_rule` VALUES ('7', 'admin/auth/groupedit', '角色组修改', '1', '1', '0', '5', '1604386719', null, null);
INSERT INTO `fa_auth_rule` VALUES ('8', 'admin/auth/groupdel', '角色组删除', '1', '1', '0', '5', '1604386719', null, null);
INSERT INTO `fa_auth_rule` VALUES ('10', 'admin/auth/authindex', '权限规则列表页', '1', '1', '0', '1', '1604386719', null, null);
INSERT INTO `fa_auth_rule` VALUES ('11', 'admin/auth/authgroup', '角色组列表页', '1', '1', '0', '5', '1604386719', null, null);
INSERT INTO `fa_auth_rule` VALUES ('12', 'adminuser', '管理员用户', '1', '1', '0', '0', '1604472701', null, null);
INSERT INTO `fa_auth_rule` VALUES ('13', 'admin/admin/user', '管理员页面', '1', '1', '0', '12', '1604472730', null, null);
INSERT INTO `fa_auth_rule` VALUES ('14', 'admin/admin/add', '管理员添加', '1', '1', '0', '12', '1604472730', null, null);
INSERT INTO `fa_auth_rule` VALUES ('15', 'admin/admin/edit', '管理员修改', '1', '1', '0', '12', '1604472730', null, null);
INSERT INTO `fa_auth_rule` VALUES ('16', 'admin/admin/del', '管理员删除', '1', '1', '0', '12', '1604472730', null, null);
INSERT INTO `fa_auth_rule` VALUES ('17', 'admin/admin/savepassword', '管理员密码重置', '1', '1', '0', '12', '1604472730', null, null);
INSERT INTO `fa_auth_rule` VALUES ('18', 'user', '用户管理', '1', '1', '0', '0', '1604473609', null, null);
INSERT INTO `fa_auth_rule` VALUES ('19', 'admin/user/index', '用户管理列表', '1', '1', '0', '18', '1604473649', null, null);
INSERT INTO `fa_auth_rule` VALUES ('20', 'admin/user/add', '用户管理添加用户', '1', '1', '0', '18', '1604473649', null, null);
INSERT INTO `fa_auth_rule` VALUES ('21', 'admin/user/edit', '用户管理编辑编辑', '1', '1', '0', '18', '1604473649', null, null);
INSERT INTO `fa_auth_rule` VALUES ('22', 'admin/user/del', '用户管理编辑删除', '1', '1', '0', '18', '1604473649', null, null);

-- ----------------------------
-- Table structure for fa_user
-- ----------------------------
DROP TABLE IF EXISTS `fa_user`;
CREATE TABLE `fa_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '用户账号',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `del_time` int(11) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1' COMMENT '1正常  2删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fa_user
-- ----------------------------
INSERT INTO `fa_user` VALUES ('1', 'aa', '1604473332', '1604473528', null, '1');
INSERT INTO `fa_user` VALUES ('2', 'xx', '1604473332', null, null, '1');
INSERT INTO `fa_user` VALUES ('3', '1', '1604479920', null, '1604480191', '2');
