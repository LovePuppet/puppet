/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : puppet

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-07-21 17:42:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `admin_name` varchar(40) NOT NULL DEFAULT '' COMMENT '用户名',
  `real_name` varchar(40) DEFAULT '' COMMENT '真实姓名',
  `password` char(32) NOT NULL COMMENT '密码',
  `mobile` char(11) DEFAULT '' COMMENT '手机号',
  `head_img` varchar(200) DEFAULT '' COMMENT '头像',
  `role_id` int(11) NOT NULL COMMENT '角色编号',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '修改时间',
  `last_login_time` int(11) NOT NULL COMMENT '最后登录时间',
  `power` tinyint(3) DEFAULT '0' COMMENT '权限',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '状态（-1.已删除 0.已关闭 1.启用）',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'puppet', '郭钊林', '92b27e00386b3a5b91ad9bb1d1bd98d7', '15021074383', '', '1', '1490937855', '1490937855', '1490937855', '10', '1');
INSERT INTO `admin` VALUES ('2', 'admin', 'admin', '5740ae6b11cd6be72875501b4e5b17ad', '15012345678', '', '1', '1491478757', '1500630036', '1491478757', '8', '1');

-- ----------------------------
-- Table structure for admin_action
-- ----------------------------
DROP TABLE IF EXISTS `admin_action`;
CREATE TABLE `admin_action` (
  `admin_action_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户编号',
  `admin_id` int(11) NOT NULL COMMENT '管理员编号',
  `content` text NOT NULL COMMENT '行为内容',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`admin_action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员行为记录表';

-- ----------------------------
-- Records of admin_action
-- ----------------------------

-- ----------------------------
-- Table structure for admin_limit
-- ----------------------------
DROP TABLE IF EXISTS `admin_limit`;
CREATE TABLE `admin_limit` (
  `admin_limit_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限编号',
  `limit_name` varchar(40) NOT NULL COMMENT '权限名',
  `limit_url` varchar(200) NOT NULL COMMENT '请求路由',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '状态（-1.已删除 1.启用）',
  PRIMARY KEY (`admin_limit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='管理员角色功能权限表';

-- ----------------------------
-- Records of admin_limit
-- ----------------------------
INSERT INTO `admin_limit` VALUES ('1', '管理员列表', '/admin/list', '1');
INSERT INTO `admin_limit` VALUES ('2', '管理员添加', '/admin/create', '1');
INSERT INTO `admin_limit` VALUES ('3', '管理员修改', '/admin/edit', '1');
INSERT INTO `admin_limit` VALUES ('4', '管理员查看', '/admin/view', '1');
INSERT INTO `admin_limit` VALUES ('5', '管理员权限列表', '/admin/limit/list', '1');
INSERT INTO `admin_limit` VALUES ('6', '管理员权限添加', '/admin/limit/create', '1');
INSERT INTO `admin_limit` VALUES ('7', '管理员权限修改', '/admin/limit/edit', '1');
INSERT INTO `admin_limit` VALUES ('8', '管理员权限查看', '/admin/limit/view', '1');
INSERT INTO `admin_limit` VALUES ('9', '管理员角色列表', '/admin/role/list', '1');
INSERT INTO `admin_limit` VALUES ('10', '管理员角色添加', '/admin/role/create', '1');
INSERT INTO `admin_limit` VALUES ('11', '管理员角色修改', '/admin/role/edit', '1');
INSERT INTO `admin_limit` VALUES ('12', '管理员角色查看', '/admin/role/view', '1');
INSERT INTO `admin_limit` VALUES ('13', '管理员删除', '/admin/delete', '1');
INSERT INTO `admin_limit` VALUES ('14', '管理员权限删除', '/admin/limit/delete', '1');
INSERT INTO `admin_limit` VALUES ('15', '管理员角色删除', '/admin/role/delete', '1');

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role` (
  `admin_role_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色编号',
  `role_name` varchar(40) NOT NULL,
  `limits_ids` text NOT NULL COMMENT '权限编号',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '状态（-1.已删除 0.已关闭 1.启用）',
  PRIMARY KEY (`admin_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员角色表';

-- ----------------------------
-- Records of admin_role
-- ----------------------------
INSERT INTO `admin_role` VALUES ('1', '超级管理员', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\"]', '1');
INSERT INTO `admin_role` VALUES ('2', '普通管理员', '[\"1\",\"4\",\"5\",\"8\"]', '1');
