/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : tickets

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2014-09-16 09:40:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_empresa
-- ----------------------------
DROP TABLE IF EXISTS `tb_empresa`;
CREATE TABLE `tb_empresa` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `ruc_empresa` char(11) NOT NULL,
  `nombre_empresa` varchar(100) NOT NULL,
  PRIMARY KEY (`id_empresa`),
  UNIQUE KEY `ruc_empresa_UNIQUE` (`ruc_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_empresa
-- ----------------------------
INSERT INTO `tb_empresa` VALUES ('1', '20427497888', 'COMERCIAL DENIA S.A.C.');
INSERT INTO `tb_empresa` VALUES ('2', '20168544252', 'EURO MOTORS S.A.');
INSERT INTO `tb_empresa` VALUES ('3', '20523470761', 'LA POSITIVA SANITAS S.A. - EPS.');
INSERT INTO `tb_empresa` VALUES ('4', '20553617627', 'SERVICIO EDUCATIVO EMPRESARIAL S.A.C.');

-- ----------------------------
-- Table structure for tb_linea_negocio
-- ----------------------------
DROP TABLE IF EXISTS `tb_linea_negocio`;
CREATE TABLE `tb_linea_negocio` (
  `id_linea` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_linea` varchar(45) NOT NULL,
  `nombre_linea` varchar(70) NOT NULL,
  PRIMARY KEY (`id_linea`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_linea_negocio
-- ----------------------------
INSERT INTO `tb_linea_negocio` VALUES ('1', '91', '01-OUTSOURCING CONTABLE');
INSERT INTO `tb_linea_negocio` VALUES ('2', '92', '02-SERVICIOS ESPECIALES');
INSERT INTO `tb_linea_negocio` VALUES ('3', '93', '03-NOMINA');
INSERT INTO `tb_linea_negocio` VALUES ('4', '94', '04-SERVIC. ADMINISTR');
INSERT INTO `tb_linea_negocio` VALUES ('5', '95', '05-CAPACITACION');
INSERT INTO `tb_linea_negocio` VALUES ('6', '96', '06-TRIBUTOS');
INSERT INTO `tb_linea_negocio` VALUES ('7', '97', '07-NIIF');
INSERT INTO `tb_linea_negocio` VALUES ('8', '98', '08-SELECCIÓN');
INSERT INTO `tb_linea_negocio` VALUES ('9', '99', '09-SOFTWARE');

-- ----------------------------
-- Table structure for tb_soporte
-- ----------------------------
DROP TABLE IF EXISTS `tb_soporte`;
CREATE TABLE `tb_soporte` (
  `id_soporte` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_soporte` varchar(45) NOT NULL,
  PRIMARY KEY (`id_soporte`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_soporte
-- ----------------------------
INSERT INTO `tb_soporte` VALUES ('1', 'Soporte sistemas');
INSERT INTO `tb_soporte` VALUES ('2', 'Soporte_TI ');
INSERT INTO `tb_soporte` VALUES ('3', 'Soporte_SAP');

-- ----------------------------
-- Table structure for tb_soporte_detalle
-- ----------------------------
DROP TABLE IF EXISTS `tb_soporte_detalle`;
CREATE TABLE `tb_soporte_detalle` (
  `id_soporte_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `detalle_soporte` varchar(75) DEFAULT NULL,
  `tb_soporte_id_soporte_ti` int(11) NOT NULL,
  PRIMARY KEY (`id_soporte_detalle`,`tb_soporte_id_soporte_ti`),
  KEY `fk_tb_soporte_detalle_tb_soporte1_idx` (`tb_soporte_id_soporte_ti`),
  CONSTRAINT `fk_tb_soporte_detalle_tb_soporte1` FOREIGN KEY (`tb_soporte_id_soporte_ti`) REFERENCES `tb_soporte` (`id_soporte`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_soporte_detalle
-- ----------------------------
INSERT INTO `tb_soporte_detalle` VALUES ('1', 'contable', '1');
INSERT INTO `tb_soporte_detalle` VALUES ('2', 'tesoreria', '1');
INSERT INTO `tb_soporte_detalle` VALUES ('3', 'Kardex', '1');
INSERT INTO `tb_soporte_detalle` VALUES ('5', 'Planilla', '1');
INSERT INTO `tb_soporte_detalle` VALUES ('7', 'instalaciones', '1');
INSERT INTO `tb_soporte_detalle` VALUES ('8', 'correo', '2');
INSERT INTO `tb_soporte_detalle` VALUES ('10', 'pc', '2');
INSERT INTO `tb_soporte_detalle` VALUES ('11', 'laptop', '2');
INSERT INTO `tb_soporte_detalle` VALUES ('12', 'telefono', '2');
INSERT INTO `tb_soporte_detalle` VALUES ('13', 'internet', '2');
INSERT INTO `tb_soporte_detalle` VALUES ('15', 'movil', '2');
INSERT INTO `tb_soporte_detalle` VALUES ('16', 'instalaciones', '2');
INSERT INTO `tb_soporte_detalle` VALUES ('17', 'Instalacion', '3');
INSERT INTO `tb_soporte_detalle` VALUES ('18', 'mantenimiento', '3');
INSERT INTO `tb_soporte_detalle` VALUES ('19', 'Capacitacion', '3');

-- ----------------------------
-- Table structure for tb_tickets
-- ----------------------------
DROP TABLE IF EXISTS `tb_tickets`;
CREATE TABLE `tb_tickets` (
  `id_tickets` int(11) NOT NULL AUTO_INCREMENT,
  `asunto` varchar(150) NOT NULL,
  `detalle` varchar(225) NOT NULL,
  `prioridad` varchar(45) NOT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL,
  `fecha_solucion` date DEFAULT NULL,
  `archivo_adjunto` char(1) DEFAULT NULL,
  `detalle_solucion` varchar(225) DEFAULT NULL,
  `origen_incidencia` varchar(45) DEFAULT NULL,
  `tb_linea_negocio_id_linea` int(11) NOT NULL,
  `tb_usuarios_id` int(11) NOT NULL,
  `tb_soporte_detalle_id_soporte_detalle` int(11) NOT NULL,
  `tb_soporte_detalle_tb_soporte_id_soporte_ti` int(11) NOT NULL,
  `hora_emision` time NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `tb_empresa_id` int(11) DEFAULT NULL,
  `usuario_soporte` varchar(11) DEFAULT NULL,
  `prioridad_admin` varchar(45) DEFAULT NULL,
  `usuario_ticket` varchar(11) DEFAULT '',
  `hora_inicio` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `hora_fin` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tickets`),
  KEY `fk_tb_tickets_tb_linea_negocio1_idx` (`tb_linea_negocio_id_linea`),
  KEY `fk_tb_tickets_tb_usuarios1_idx` (`tb_usuarios_id`),
  KEY `fk_tb_tickets_tb_soporte_detalle1_idx` (`tb_soporte_detalle_id_soporte_detalle`,`tb_soporte_detalle_tb_soporte_id_soporte_ti`),
  CONSTRAINT `fk_tb_tickets_tb_linea_negocio1` FOREIGN KEY (`tb_linea_negocio_id_linea`) REFERENCES `tb_linea_negocio` (`id_linea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_tickets_tb_soporte_detalle1` FOREIGN KEY (`tb_soporte_detalle_id_soporte_detalle`, `tb_soporte_detalle_tb_soporte_id_soporte_ti`) REFERENCES `tb_soporte_detalle` (`id_soporte_detalle`, `tb_soporte_id_soporte_ti`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_tickets_tb_usuarios1` FOREIGN KEY (`tb_usuarios_id`) REFERENCES `tb_usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_tickets
-- ----------------------------
INSERT INTO `tb_tickets` VALUES ('37', 'No funiona mi telefono', 'Buenos dias no funciona mi telefono', 'media', 'Cerrado', '0000-00-00', null, null, 'Se soluciono, cambiando de cable', null, '3', '21', '12', '2', '15:41:22', '2014-09-04 15:47:52', '2014-09-04 15:47:52', '2', '20', 'alta', '', '2014-09-04 15:47:52', '2014-09-04 15:47:52');
INSERT INTO `tb_tickets` VALUES ('41', 'problemas en el sistema', 'Error en el sistema', 'media', 'Cerrado', '0000-00-00', null, null, null, null, '2', '10', '12', '2', '16:44:23', '2014-08-19 12:46:50', '2014-08-19 12:46:50', '3', null, null, '', '2014-08-19 12:46:50', '2014-08-19 12:46:50');
INSERT INTO `tb_tickets` VALUES ('42', 'ffsdfdsf', 'dfsdfdsfdsfds', 'media', 'Cerrado', '0000-00-00', null, null, null, null, '4', '10', '10', '2', '16:51:08', '2014-08-19 12:46:50', '2014-08-19 12:46:50', '2', null, null, '', '2014-08-19 12:46:50', '2014-08-19 12:46:50');
INSERT INTO `tb_tickets` VALUES ('43', 'fedfsdfds', 'fsdfdsfsdf', 'media', 'Cerrado', '0000-00-00', null, '1', null, null, '1', '10', '10', '2', '17:25:35', '2014-08-19 12:46:49', '2014-08-19 12:46:49', '1', null, null, '', '2014-08-19 12:46:49', '2014-08-19 12:46:49');
INSERT INTO `tb_tickets` VALUES ('44', 'fddfsdf', 'sdfdsfsdf', 'media', 'Cerrado', '0000-00-00', null, '1', null, null, '4', '10', '10', '2', '17:25:52', '2014-08-19 12:46:48', '2014-08-19 12:46:48', '1', null, null, '', '2014-08-19 12:46:48', '2014-08-19 12:46:48');
INSERT INTO `tb_tickets` VALUES ('45', 'fdsfsdf', 'fsdfdsfsdfdgragfagvrAGARVBARBARB', 'media', 'Cerrado', '0000-00-00', null, null, null, null, '5', '10', '10', '2', '17:26:12', '2014-08-19 12:46:46', '2014-08-19 12:46:46', '3', null, null, '', '2014-08-19 12:46:46', '2014-08-19 12:46:46');
INSERT INTO `tb_tickets` VALUES ('47', 'jisdjgirhi', 'jdifjwoirhqoanuo', 'alta', 'Cerrado', '0000-00-00', null, null, null, null, '2', '10', '10', '2', '17:52:06', '2014-08-20 10:50:39', '2014-08-20 10:50:39', '3', null, null, '', '2014-08-20 10:50:39', '2014-08-20 10:50:39');
INSERT INTO `tb_tickets` VALUES ('48', 'Prueba', 'Prueba del sistema de tickets', 'alta', 'Cerrado', '0000-00-00', null, null, null, null, '4', '10', '10', '2', '20:39:21', '2014-08-20 10:50:46', '2014-08-20 10:50:46', '4', null, null, '', '2014-08-20 10:50:46', '2014-08-20 10:50:46');
INSERT INTO `tb_tickets` VALUES ('51', 'prueba', 'ticket de prueba del sistema', 'alta', 'Cerrado', '0000-00-00', null, null, null, null, '1', '10', '3', '1', '20:42:06', '2014-08-20 10:50:48', '2014-08-20 10:50:48', '1', null, null, '', '2014-08-20 10:50:48', '2014-08-20 10:50:48');
INSERT INTO `tb_tickets` VALUES ('52', 'Prueba de sistema de tickets', 'prueba del sistema de ticket', 'media', 'Cerrado', '0000-00-00', null, null, null, null, '3', '10', '2', '1', '21:06:46', '2014-08-20 10:50:47', '2014-08-20 10:50:47', '4', null, null, '', '2014-08-20 10:50:47', '2014-08-20 10:50:47');
INSERT INTO `tb_tickets` VALUES ('53', 'Prueba del sistema', 'Prueba del sistema ', 'alta', 'Cerrado', '0000-00-00', null, null, null, null, '3', '10', '1', '1', '21:08:55', '2014-08-20 10:50:44', '2014-08-20 10:50:44', '3', null, null, '', '2014-08-20 10:50:44', '2014-08-20 10:50:44');
INSERT INTO `tb_tickets` VALUES ('54', 'prueba', 'Prueba del sistema', 'media', 'Cerrado', '0000-00-00', null, null, null, null, '3', '10', '8', '2', '21:24:57', '2014-08-20 10:50:42', '2014-08-20 10:50:42', '2', null, null, '', '2014-08-20 10:50:42', '2014-08-20 10:50:42');
INSERT INTO `tb_tickets` VALUES ('55', 'fdsfsd', 'fsdfsdf', 'media', 'Cerrado', '0000-00-00', null, null, null, null, '4', '10', '11', '2', '21:30:26', '2014-08-20 10:50:40', '2014-08-20 10:50:40', '2', null, null, '', '2014-08-20 10:50:40', '2014-08-20 10:50:40');
INSERT INTO `tb_tickets` VALUES ('56', 'Prueba de sistema de tickets', 'prueba del sistema', 'media', 'Cerrado', '0000-00-00', null, null, null, null, '3', '10', '2', '1', '15:49:07', '2014-08-20 10:50:40', '2014-08-20 10:50:40', '2', null, null, '', '2014-08-20 10:50:40', '2014-08-20 10:50:40');
INSERT INTO `tb_tickets` VALUES ('58', 'problemas en el sistema', 'Ticket de PRUEBA', 'alta', 'Cerrado', '0000-00-00', null, null, null, null, '2', '10', '3', '1', '18:14:41', '2014-08-20 13:21:48', '2014-08-20 13:21:48', '3', null, null, '', '2014-08-20 13:21:48', '2014-08-20 13:21:48');
INSERT INTO `tb_tickets` VALUES ('59', 'fewfwe', 'wqdeiwjiawr', 'alta', 'Cerrado', '0000-00-00', null, null, null, null, '3', '10', '2', '1', '18:22:54', '2014-08-20 13:26:47', '2014-08-20 13:26:47', '2', null, null, '', '2014-08-20 13:26:47', '2014-08-20 13:26:47');
INSERT INTO `tb_tickets` VALUES ('60', 'vsdvdsvds', 'vdsvsdvsddsv', 'alta', 'Cerrado', '0000-00-00', null, null, null, null, '1', '10', '10', '2', '18:29:22', '2014-08-20 13:32:11', '2014-08-20 13:32:11', '1', null, null, '', '2014-08-20 13:32:11', '2014-08-20 13:32:11');
INSERT INTO `tb_tickets` VALUES ('61', 'dfasdsa', 'dsadsad', 'media', 'Cerrado', '0000-00-00', null, null, null, null, '5', '10', '8', '2', '18:35:52', '2014-08-20 13:36:49', '2014-08-20 13:36:49', '3', null, null, '', '2014-08-20 13:36:49', '2014-08-20 13:36:49');
INSERT INTO `tb_tickets` VALUES ('62', 'fdsfdsf', 'sfdfsdf', 'alta', 'Cerrado', '0000-00-00', null, null, null, null, '4', '10', '10', '2', '18:36:54', '2014-08-20 13:37:34', '2014-08-20 13:37:34', '3', null, null, '', '2014-08-20 13:37:34', '2014-08-20 13:37:34');
INSERT INTO `tb_tickets` VALUES ('63', 'fdfdsf', 'sdfdsfd', 'baja', 'Cerrado', '0000-00-00', null, null, null, null, '1', '10', '1', '1', '18:39:50', '2014-08-20 13:42:00', '2014-08-20 13:42:00', '1', null, null, '', '2014-08-20 13:42:00', '2014-08-20 13:42:00');
INSERT INTO `tb_tickets` VALUES ('64', 'dsadsa', 'sadsadsa', 'baja', 'Cerrado', '0000-00-00', null, null, null, null, '3', '10', '2', '1', '18:41:06', '2014-08-20 13:41:16', '2014-08-20 13:41:16', '3', null, null, '', '2014-08-20 13:41:16', '2014-08-20 13:41:16');
INSERT INTO `tb_tickets` VALUES ('65', 'no funcionna', 'prueba de correo', 'alta', 'Cerrado', '0000-00-00', null, '1', null, null, '3', '10', '2', '1', '15:34:33', '2014-09-02 12:01:35', '2014-09-02 12:01:35', '3', null, null, '', '2014-09-02 12:01:35', '2014-09-02 12:01:35');
INSERT INTO `tb_tickets` VALUES ('67', 'efrewfsd', 'fdsfdsfdsf', 'alta', 'Abierto', '0000-00-00', null, '1', null, null, '3', '10', '10', '2', '15:51:36', '2014-09-02 10:54:46', '2014-09-02 10:54:46', '2', null, null, '', '2014-09-02 10:54:46', '2014-09-02 10:54:46');
INSERT INTO `tb_tickets` VALUES ('68', 'efrewfsd', 'fdsfdsfdsf', 'alta', 'Abierto', '0000-00-00', null, '1', null, null, '3', '10', '10', '2', '15:51:36', '2014-09-02 10:55:15', '2014-09-02 10:55:15', '2', null, null, '', '2014-09-02 10:55:15', '2014-09-02 10:55:15');
INSERT INTO `tb_tickets` VALUES ('69', 'efrewfsd', 'fdsfdsfdsf', 'alta', 'Abierto', '0000-00-00', null, '1', null, null, '3', '10', '10', '2', '15:51:36', '2014-09-02 10:56:11', '2014-09-02 10:56:11', '2', null, null, '', '2014-09-02 10:56:11', '2014-09-02 10:56:11');
INSERT INTO `tb_tickets` VALUES ('70', 'efdsfds', 'wqfdsfadfgag', 'media', 'Abierto', '0000-00-00', null, '1', null, null, '2', '10', '1', '1', '16:12:19', '2014-09-02 11:12:35', '2014-09-02 11:12:35', '3', null, null, '', '2014-09-02 11:12:35', '2014-09-02 11:12:35');
INSERT INTO `tb_tickets` VALUES ('71', 'dsfdsfds', 'dsfsdfdsffdsfdsf', 'alta', 'Abierto', '0000-00-00', null, '1', null, null, '1', '10', '2', '1', '16:13:06', '2014-09-02 11:13:23', '2014-09-02 11:13:23', '1', null, null, '', '2014-09-02 11:13:23', '2014-09-02 11:13:23');
INSERT INTO `tb_tickets` VALUES ('72', 'fdsfsd', 'dsfsdfdsf', 'baja', 'Abierto', '0000-00-00', null, null, null, null, '2', '10', '11', '2', '16:13:31', '2014-09-02 16:13:43', '2014-09-02 16:13:43', '3', null, null, '', null, null);
INSERT INTO `tb_tickets` VALUES ('73', 'dsfdsf', 'dsfdsfdsfds', 'baja', 'Abierto', '0000-00-00', null, null, null, null, '2', '10', '11', '2', '16:13:31', '2014-09-02 16:14:02', '2014-09-02 16:14:02', '3', null, null, '', null, null);
INSERT INTO `tb_tickets` VALUES ('74', 'gfdg', 'fdgdfgfdgf', 'alta', 'Abierto', '0000-00-00', null, '1', null, null, '3', '10', '10', '2', '16:21:09', '2014-09-02 11:21:28', '2014-09-02 11:21:28', '2', null, null, '', '2014-09-02 11:21:28', '2014-09-02 11:21:28');
INSERT INTO `tb_tickets` VALUES ('75', '452542', '452452542', 'media', 'Abierto', '0000-00-00', null, null, null, null, '1', '10', '13', '2', '16:22:53', '2014-09-02 16:23:08', '2014-09-02 16:23:08', '2', null, null, '', null, null);
INSERT INTO `tb_tickets` VALUES ('76', '5254254', 'ytuytuytutyu', 'media', 'Abierto', '0000-00-00', null, '1', null, null, '4', '10', '12', '2', '16:23:13', '2014-09-02 11:23:39', '2014-09-02 11:23:39', '3', null, null, '', '2014-09-02 11:23:39', '2014-09-02 11:23:39');
INSERT INTO `tb_tickets` VALUES ('77', 'gfdgfdg', 'dfgfdgfdgfd', 'media', 'Cerrado', '0000-00-00', null, null, null, null, '2', '10', '2', '1', '16:31:18', '2014-09-02 15:27:11', '2014-09-02 15:27:11', '2', null, null, '', '2014-09-02 15:27:11', '2014-09-02 15:27:11');
INSERT INTO `tb_tickets` VALUES ('78', 'gfhfgh', 'fghgfhg', 'media', 'Cerrado', '0000-00-00', null, null, null, null, '1', '10', '2', '1', '16:31:40', '2014-09-02 15:34:35', '2014-09-02 15:34:35', '1', null, null, '', '2014-09-02 15:34:35', '2014-09-02 15:34:35');
INSERT INTO `tb_tickets` VALUES ('79', 'gfgfdg', 'fdgfdgfdgdfg', 'media', 'Abierto', '0000-00-00', null, null, null, null, '3', '10', '2', '1', '16:34:03', '2014-09-02 16:34:13', '2014-09-02 16:34:13', '3', null, null, '', null, null);
INSERT INTO `tb_tickets` VALUES ('80', 'fdfg', 'sdfdsfdsfdsf', 'media', 'Abierto', '0000-00-00', null, null, null, null, '2', '10', '10', '2', '16:34:49', '2014-09-02 16:35:01', '2014-09-02 16:35:01', '3', null, null, '', null, null);
INSERT INTO `tb_tickets` VALUES ('81', 'fdfds', 'fsdfsdfds', 'alta', 'Cerrado', '0000-00-00', null, null, null, null, '3', '10', '2', '1', '16:40:06', '2014-09-02 15:34:00', '2014-09-02 15:34:00', '2', null, null, '', '2014-09-02 15:34:00', '2014-09-02 15:34:00');
INSERT INTO `tb_tickets` VALUES ('82', 'yfrgdf', 'gfdgfdg', 'media', 'Abierto', '0000-00-00', null, null, null, null, '3', '10', '17', '3', '16:42:04', '2014-09-02 16:42:13', '2014-09-02 16:42:13', '2', null, null, '', null, null);
INSERT INTO `tb_tickets` VALUES ('83', 'dsarfdsf', 'dsfdsfds', 'alta', 'Abierto', '0000-00-00', null, null, null, null, '3', '10', '2', '1', '16:43:35', '2014-09-02 16:43:43', '2014-09-02 16:43:43', '2', null, null, '', null, null);
INSERT INTO `tb_tickets` VALUES ('84', 'sdfasd', 'dsadsadsad', 'media', 'Cerrado', '0000-00-00', null, null, null, null, '3', '10', '2', '1', '16:47:28', '2014-09-02 15:34:55', '2014-09-02 15:34:55', '2', null, null, '', '2014-09-02 15:34:55', '2014-09-02 15:34:55');
INSERT INTO `tb_tickets` VALUES ('85', 'hgfdsgdsg', 'dfgdfgfdg', 'media', 'Pendiente', '0000-00-00', null, null, null, null, '3', '10', '18', '3', '16:47:54', '2014-09-04 15:41:40', '2014-09-04 15:41:40', '3', '21', 'media', '', '2014-09-04 15:41:40', '2014-09-04 15:41:40');
INSERT INTO `tb_tickets` VALUES ('86', 'kjkhjk', 'jkjhkhjk', 'baja', 'Pendiente', '0000-00-00', null, null, null, null, '4', '10', '10', '2', '16:51:30', '2014-09-04 19:59:54', '2014-09-04 19:59:54', '3', '21', 'baja', '', '2014-09-04 19:59:54', '2014-09-04 19:59:54');
INSERT INTO `tb_tickets` VALUES ('87', 'sdf', 'fdsfdsfds', 'baja', 'Cerrado', '0000-00-00', null, null, null, null, '3', '10', '11', '2', '16:53:16', '2014-09-02 15:16:20', '2014-09-02 15:16:20', '3', null, null, '', '2014-09-02 15:16:20', '2014-09-02 15:16:20');
INSERT INTO `tb_tickets` VALUES ('88', 'fdsfdsfds', 'dfdsfds', 'alta', 'Cerrado', '0000-00-00', null, null, null, null, '3', '10', '10', '2', '16:54:10', '2014-09-02 12:01:38', '2014-09-02 12:01:38', '3', null, null, '', '2014-09-02 12:01:38', '2014-09-02 12:01:38');
INSERT INTO `tb_tickets` VALUES ('89', 'no funcionna', 'Pruewba', 'baja', 'Cerrado', '0000-00-00', null, null, null, null, '2', '10', '5', '1', '16:55:36', '2014-09-02 12:01:37', '2014-09-02 12:01:37', '2', null, null, '', '2014-09-02 12:01:37', '2014-09-02 12:01:37');
INSERT INTO `tb_tickets` VALUES ('90', 'no funciona', 'fdsfdsfsdfsdf', 'media', 'Cerrado', '0000-00-00', null, null, null, null, '4', '10', '5', '1', '16:57:43', '2014-09-02 12:01:36', '2014-09-02 12:01:36', '3', null, null, '', '2014-09-02 12:01:36', '2014-09-02 12:01:36');

-- ----------------------------
-- Table structure for tb_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `tb_usuarios`;
CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` char(8) NOT NULL,
  `nombres` varchar(70) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `correo` varchar(70) NOT NULL,
  `password` varchar(225) NOT NULL,
  `tipo_usuario` char(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni_UNIQUE` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_usuarios
-- ----------------------------
INSERT INTO `tb_usuarios` VALUES ('10', '46401994', 'jorge', 'Lopez Rojas', 'jorge.lopez@gruposiglo.net', '$2y$10$xdw.xYFeCV.I2oIJSWqr1uywTzcmM7j/MjY85vu.8Oeq0qVGIz/ha', 'A', '2014-04-20 06:27:12', '2014-04-20 06:27:12');
INSERT INTO `tb_usuarios` VALUES ('20', '44672524', 'suzy', 'Gonzalez Perez', 'suzy.gonzalez@gruposiglo.net', '$2y$10$iT6mDWKn7Y2tQdgiHPPt8eXir03O2bD8Jxuc1cj.nV0z6DD9TJolS', 'S', '2014-06-25 15:35:27', '2014-06-25 15:35:27');
INSERT INTO `tb_usuarios` VALUES ('21', '41596094', 'olga', 'Espinoza Campos', 'olga.espinoza@gruposiglo.net', '$2y$10$oqChx3BHUCifKbeKIzSF6ezpxn1j6WooN7VVuRA.KwjearYx14hWW', 'S', '2014-06-25 15:40:57', '2014-06-25 15:40:57');

-- ----------------------------
-- Table structure for tb_usuario_empresa
-- ----------------------------
DROP TABLE IF EXISTS `tb_usuario_empresa`;
CREATE TABLE `tb_usuario_empresa` (
  `tb_usuarios_id` int(11) NOT NULL,
  `tb_empresa_id_empresa` int(11) NOT NULL,
  PRIMARY KEY (`tb_usuarios_id`,`tb_empresa_id_empresa`),
  KEY `fk_tb_usuario_empresa_tb_empresa1_idx` (`tb_empresa_id_empresa`),
  CONSTRAINT `fk_tb_usuario_empresa_tb_empresa1` FOREIGN KEY (`tb_empresa_id_empresa`) REFERENCES `tb_empresa` (`id_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_usuario_empresa_tb_usuarios1` FOREIGN KEY (`tb_usuarios_id`) REFERENCES `tb_usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_usuario_empresa
-- ----------------------------

-- ----------------------------
-- View structure for view_asignarsoporte
-- ----------------------------
DROP VIEW IF EXISTS `view_asignarsoporte`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `view_asignarsoporte` AS select a.id_tickets as id_tickets, a.created_at as created_at,a.asunto as asunto,
a.detalle as detalle,e.nombre_linea as tb_linea_negocio_id_linea,
b.nombre_empresa as tb_empresa_id, c.tipo_soporte as tipo_soporte,a.prioridad as prioridad,
f.detalle_soporte as tb_soporte_detalle_tb_soporte_id_soporte_ti,
a.estado as estado,a.tb_usuarios_id as usuario, d.apellidos as usuario_soporte from tb_tickets a 
inner join tb_empresa b on a.tb_empresa_id=b.id_empresa
inner join tb_soporte c on a.tb_soporte_detalle_tb_soporte_id_soporte_ti=c.id_soporte
left join tb_usuarios d on a.usuario_soporte =d.id
left join tb_linea_negocio e on e.id_linea=a.tb_linea_negocio_id_linea
left join tb_soporte_detalle f on f.id_soporte_detalle=a.tb_soporte_detalle_id_soporte_detalle
order by  a.id_tickets DESC ;

-- ----------------------------
-- View structure for view_cerrarticket
-- ----------------------------
DROP VIEW IF EXISTS `view_cerrarticket`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `view_cerrarticket` AS select a.id_tickets as id_tickets, a.created_at as created_at,a.asunto as asunto,
a.detalle as detalle,e.nombre_linea as tb_linea_negocio_id_linea,
b.nombre_empresa as tb_empresa_id, c.tipo_soporte as tipo_soporte,a.prioridad as prioridad,
f.detalle_soporte as tb_soporte_detalle_tb_soporte_id_soporte_ti,
a.estado as estado,a.tb_usuarios_id as usuario, d.apellidos as usuario_soporte,
a.prioridad_admin as prioridad_admin, a.detalle_solucion,a.usuario_soporte as soporte_id
from tb_tickets a 
inner join tb_empresa b on a.tb_empresa_id=b.id_empresa
inner join tb_soporte c on a.tb_soporte_detalle_tb_soporte_id_soporte_ti=c.id_soporte
left join tb_usuarios d on a.usuario_soporte =d.id
left join tb_linea_negocio e on e.id_linea=a.tb_linea_negocio_id_linea
left join tb_soporte_detalle f on f.id_soporte_detalle=a.tb_soporte_detalle_id_soporte_detalle
order by  a.id_tickets DESC ;

-- ----------------------------
-- View structure for view_tickets
-- ----------------------------
DROP VIEW IF EXISTS `view_tickets`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `view_tickets` AS select a.id_tickets as id_ticket, a.asunto as asunto, a.detalle as detalle, b.nombre_empresa as empresa ,c.tipo_soporte as tipo_soporte,a.prioridad as prioridad, a.estado as estado,a.tb_usuarios_id as usuario from tb_tickets a 
inner join tb_empresa b on a.tb_empresa_id=b.id_empresa
inner join tb_soporte c on a.tb_soporte_detalle_tb_soporte_id_soporte_ti=c.id_soporte order by a.id_tickets desc ;

-- ----------------------------
-- View structure for view_ticketsadministrador
-- ----------------------------
DROP VIEW IF EXISTS `view_ticketsadministrador`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `view_ticketsadministrador` AS select a.id_tickets as id_ticket,CONCAT(e.apellidos,', ',e.nombres) as usuario , a.asunto as asunto, a.detalle as detalle, b.nombre_empresa as empresa ,c.tipo_soporte as tipo_soporte,a.prioridad as prioridad, a.estado as estado, CONCAT(f.apellidos,', ',f.nombres) as usuario_soporte,
a.hora_inicio as hora_inicio
from tb_tickets a 
inner join tb_empresa b on a.tb_empresa_id=b.id_empresa
inner join tb_soporte c on a.tb_soporte_detalle_tb_soporte_id_soporte_ti=c.id_soporte
left join tb_usuarios e on a.tb_usuarios_id=e.id
left join tb_usuarios f on a.usuario_soporte=f.id
order by a.id_tickets desc ;
