/*
Navicat MySQL Data Transfer

Source Server         : Ayomikun
Source Server Version : 100122
Source Host           : localhost:3306
Source Database       : diagnose

Target Server Type    : MYSQL
Target Server Version : 100122
File Encoding         : 65001

Date: 2017-10-26 07:30:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for diseases
-- ----------------------------
DROP TABLE IF EXISTS `diseases`;
CREATE TABLE `diseases` (
  `disease_id` int(11) NOT NULL AUTO_INCREMENT,
  `diseases_name` varchar(255) NOT NULL,
  PRIMARY KEY (`disease_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of diseases
-- ----------------------------
INSERT INTO `diseases` VALUES ('1', 'Malaria');
INSERT INTO `diseases` VALUES ('2', 'Cholera');
INSERT INTO `diseases` VALUES ('3', 'Tetanus');
INSERT INTO `diseases` VALUES ('4', 'Hepatitis');
INSERT INTO `diseases` VALUES ('5', 'Typhoid Fever');
INSERT INTO `diseases` VALUES ('6', 'Tuberculosis');
INSERT INTO `diseases` VALUES ('7', 'Influenza (Flu)');
INSERT INTO `diseases` VALUES ('8', 'Whooping Cough');
INSERT INTO `diseases` VALUES ('9', 'Measles');
INSERT INTO `diseases` VALUES ('10', 'Chicken Pox');

-- ----------------------------
-- Table structure for patient_hospital_history
-- ----------------------------
DROP TABLE IF EXISTS `patient_hospital_history`;
CREATE TABLE `patient_hospital_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_ref_no` int(11) DEFAULT NULL,
  `hosp_no` int(11) DEFAULT NULL,
  `admission_status` varchar(255) DEFAULT NULL,
  `date_of_admission` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `name_of_doctor` varchar(255) DEFAULT NULL,
  `symptoms` varchar(255) DEFAULT NULL,
  `doctors_diagnosis` varchar(255) DEFAULT NULL,
  `date_of_discharge` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status_upon_discharge` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of patient_hospital_history
-- ----------------------------
INSERT INTO `patient_hospital_history` VALUES ('8', '369', '854', 'OUT', '2017-10-25 22:52:53', 'Dr. Sauna Samuel', 'Abdominal pain, Alternating chill and perspiration, Body aches, Breath has bad smell, Cramps in the legs, Difficulty in chewing and swallowing, Dry white coated tongue', 'Typhoid Fever, Malaria', '2017-10-25 23:52:53', 'Fully Recovered');
INSERT INTO `patient_hospital_history` VALUES ('9', '711', '115', 'IN', '2017-10-25 22:56:21', 'Dr. Sauna Samuel', 'Abdominal pain, Cramps in the legs, Rash in mouth and throat, Spasm of muscles of jaw and face, Vomiting', 'Typhoid Fever, Cholera', null, null);
INSERT INTO `patient_hospital_history` VALUES ('10', '294', '854', 'OUT', '2017-10-25 23:00:18', 'Dr. Sauna Samuel', 'Abdominal pain, Stiff neck, Sudden onset of severe, watery diarrhea, Vomiting, Yellowish tinge in eyes', 'Typhoid Fever, Cholera, Hepatitis', '2017-10-26 00:00:18', 'Fully Recovered');

-- ----------------------------
-- Table structure for patient_lab_info
-- ----------------------------
DROP TABLE IF EXISTS `patient_lab_info`;
CREATE TABLE `patient_lab_info` (
  `lab_ref_no` int(11) NOT NULL AUTO_INCREMENT,
  `case_ref_no` int(100) DEFAULT NULL,
  `hosp_no` int(100) DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `rhfactor` varchar(255) DEFAULT NULL,
  `allergy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lab_ref_no`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of patient_lab_info
-- ----------------------------
INSERT INTO `patient_lab_info` VALUES ('13', '369', '854', 'O+', 'Rh Positive', 'Peanut');
INSERT INTO `patient_lab_info` VALUES ('14', '711', '115', 'O+', 'Rh Positive', 'Peanut');
INSERT INTO `patient_lab_info` VALUES ('15', '294', '854', 'B-', 'Rh Positive', 'Peanut');

-- ----------------------------
-- Table structure for patient_personal_info
-- ----------------------------
DROP TABLE IF EXISTS `patient_personal_info`;
CREATE TABLE `patient_personal_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hosp_no` int(11) DEFAULT NULL,
  `sname` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `date_of_birth` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `sex` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `home_add` varchar(255) DEFAULT NULL,
  `state_of_origin` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `name_of_nok` varchar(255) DEFAULT NULL,
  `relationship_to_nok` varchar(255) DEFAULT NULL,
  `add_of_nok` varchar(255) DEFAULT NULL,
  `name_of_sponsor` varchar(255) DEFAULT NULL,
  `add_of_sponsor` varchar(255) DEFAULT NULL,
  `dated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of patient_personal_info
-- ----------------------------
INSERT INTO `patient_personal_info` VALUES ('18', '854', 'David', 'James', '1997-12-31 00:00:00', 'Male', 'Maried', '42, Adebayo Street', 'Ogun', 'Nigeria', 'Lecturer', 'Lawson James', 'Father', '42, Adebayo Street', 'Lawson James', '42, Adebayo Street', '2017-10-25 23:52:04');
INSERT INTO `patient_personal_info` VALUES ('19', '115', 'Samuel', 'Sauna', '1996-11-25 00:00:00', 'Male', 'Maried', '42, Adebayo Street', 'Lagos', 'Nigeria', 'Lawyer', 'Samuel Mark', 'Father', '42, Adebayo Street', 'Samuel Henry', '42, Adebayo Street', '2017-10-25 23:55:19');

-- ----------------------------
-- Table structure for symptoms
-- ----------------------------
DROP TABLE IF EXISTS `symptoms`;
CREATE TABLE `symptoms` (
  `symptom_id` int(11) NOT NULL AUTO_INCREMENT,
  `disease_id` int(11) DEFAULT NULL,
  `symptom_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`symptom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of symptoms
-- ----------------------------
INSERT INTO `symptoms` VALUES ('1', '1', 'Fever', null);
INSERT INTO `symptoms` VALUES ('2', '1', 'Alternating chill and perspiration', null);
INSERT INTO `symptoms` VALUES ('3', '1', 'Headache', null);
INSERT INTO `symptoms` VALUES ('4', '1', 'Nausea', null);
INSERT INTO `symptoms` VALUES ('5', '1', 'Vomiting', null);
INSERT INTO `symptoms` VALUES ('6', '2', 'Sudden onset of severe, watery diarrhea', null);
INSERT INTO `symptoms` VALUES ('7', '2', 'Vomiting', null);
INSERT INTO `symptoms` VALUES ('8', '2', 'Cramps in the legs', null);
INSERT INTO `symptoms` VALUES ('9', '2', 'Feels very thirsty', null);
INSERT INTO `symptoms` VALUES ('10', '3', 'Slight fever', null);
INSERT INTO `symptoms` VALUES ('11', '3', 'Difficulty in chewing and swallowing', null);
INSERT INTO `symptoms` VALUES ('12', '3', 'Stiff neck', null);
INSERT INTO `symptoms` VALUES ('13', '3', 'Restlessness', null);
INSERT INTO `symptoms` VALUES ('14', '3', 'Spasm of muscles of jaw and face', null);
INSERT INTO `symptoms` VALUES ('15', '3', 'Severe pain', null);
INSERT INTO `symptoms` VALUES ('16', '4', 'High fever', null);
INSERT INTO `symptoms` VALUES ('17', '4', 'Distaste for alcohol', null);
INSERT INTO `symptoms` VALUES ('18', '4', 'Dark yellow urine', null);
INSERT INTO `symptoms` VALUES ('19', '4', 'Jaundice', null);
INSERT INTO `symptoms` VALUES ('20', '4', 'Yellowish tinge in eyes', null);
INSERT INTO `symptoms` VALUES ('21', '5', 'Severe headache', null);
INSERT INTO `symptoms` VALUES ('22', '5', 'Abdominal pain', null);
INSERT INTO `symptoms` VALUES ('23', '5', 'Fever with low pulse', null);
INSERT INTO `symptoms` VALUES ('24', '5', 'Dry white coated tongue', null);
INSERT INTO `symptoms` VALUES ('25', '6', 'Breath has bad smell', null);
INSERT INTO `symptoms` VALUES ('26', '6', 'Chest pain', null);
INSERT INTO `symptoms` VALUES ('27', '6', 'Rapid pulse', null);
INSERT INTO `symptoms` VALUES ('28', '6', 'Excessive weakness', null);
INSERT INTO `symptoms` VALUES ('29', '6', 'Loss of weight', null);
INSERT INTO `symptoms` VALUES ('30', '6', 'Persistent cough', null);
INSERT INTO `symptoms` VALUES ('31', '7', 'Fever', null);
INSERT INTO `symptoms` VALUES ('32', '7', 'Cold', null);
INSERT INTO `symptoms` VALUES ('33', '7', 'Body aches', null);
INSERT INTO `symptoms` VALUES ('34', '7', 'Nausea', null);
INSERT INTO `symptoms` VALUES ('35', '8', 'Sore eyes', null);
INSERT INTO `symptoms` VALUES ('36', '8', 'Fever', null);
INSERT INTO `symptoms` VALUES ('37', '8', 'Runny nose', null);
INSERT INTO `symptoms` VALUES ('38', '8', 'Sneezing', null);
INSERT INTO `symptoms` VALUES ('39', '8', 'Cold', null);
INSERT INTO `symptoms` VALUES ('40', '9', 'Severe Cough', null);
INSERT INTO `symptoms` VALUES ('41', '9', 'Loss of Appetite', null);
INSERT INTO `symptoms` VALUES ('42', '9', 'Spots all over body, including mouth and throat', null);
INSERT INTO `symptoms` VALUES ('43', '10', 'Slight fever', null);
INSERT INTO `symptoms` VALUES ('44', '10', 'Rash in mouth and throat', null);
INSERT INTO `symptoms` VALUES ('45', '10', 'Itching', null);
INSERT INTO `symptoms` VALUES ('46', '8', 'Cough', null);
INSERT INTO `symptoms` VALUES ('47', '9', 'Fever', null);
INSERT INTO `symptoms` VALUES ('48', '7', 'Headache', null);
INSERT INTO `symptoms` VALUES ('49', '7', 'Cough', null);
INSERT INTO `symptoms` VALUES ('50', '7', 'Sneezing', null);
INSERT INTO `symptoms` VALUES ('51', '6', 'Loss of Appetite', null);
INSERT INTO `symptoms` VALUES ('52', '5', 'Loss of Appetite', null);
INSERT INTO `symptoms` VALUES ('53', '5', 'Vomiting', null);
INSERT INTO `symptoms` VALUES ('54', '4', 'Nausea', null);
INSERT INTO `symptoms` VALUES ('55', '4', 'Vomiting', null);
INSERT INTO `symptoms` VALUES ('56', '4', 'Loss of Appetite', null);
INSERT INTO `symptoms` VALUES ('57', '4', 'Headache', null);
INSERT INTO `symptoms` VALUES ('58', '4', 'Body aches', null);
INSERT INTO `symptoms` VALUES ('59', '1', 'Body aches', null);
INSERT INTO `symptoms` VALUES ('60', '3', 'Muscles aches', null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sname` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Samuel', 'Sauna', 'sonia', 'd31cb1e2b7902e8e9b4d1793e94c38a0');
