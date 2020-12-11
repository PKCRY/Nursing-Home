DROP DATABASE IF EXISTS `nursing_home`;

CREATE DATABASE IF NOT EXISTS `nursing_home`;
USE `nursing_home`;


DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `patient_info`;
DROP TABLE IF EXISTS `employee_info`;
DROP TABLE IF EXISTS `role`;
DROP TABLE IF EXISTS `appointment`;
DROP TABLE IF EXISTS `patient_record`;
DROP TABLE IF EXISTS `roster`;
DROP TABLE IF EXISTS `payments`;



CREATE TABLE `role` (
  `role_id` serial PRIMARY KEY,
  `role_name` varchar(50),
  `access_level` int
);

CREATE TABLE `users` (
  `user_id` serial PRIMARY KEY,
  `role_id` int REFERENCES `role`(`role_id`),
  `f_name` text,
  `l_name` text,
  `email` text UNIQUE,
  `phone` varchar(10),
  `password` varchar(70),
  `dob` date,
  `validated` boolean
);


CREATE TABLE `patient_info` (
  `p_info_id` serial PRIMARY KEY,
  `user_id` int REFERENCES `users`(`user_id`),
  `family_code` varchar(6),
  `emergency_contact` varchar(100),
  `relation_of_contact` varchar(100),
  `admission_date` date,
  `group_id` int,
  `date_payed` date,
  `payment` int
);


CREATE TABLE `employee_info` (
  `e_info_id` serial PRIMARY KEY,
  `user_id` int REFERENCES `users`(`user_id`),
  `salary` int,
  `group_id` int
);



CREATE TABLE `roster` (
  `roster_id` serial PRIMARY KEY,
  `supervisor` int REFERENCES `users`(`user_id`),
  `doctor` int REFERENCES `users`(`user_id`),
  `caregiver_1` int REFERENCES `users`(`user_id`),
  `caregiver_2` int REFERENCES `users`(`user_id`),
  `caregiver_3` int REFERENCES `users`(`user_id`),
  `caregiver_4` int REFERENCES `users`(`user_id`),
  `date` date
);




CREATE TABLE `appointment` (
    `appointment_id` serial PRIMARY KEY,
    `patient_id` int REFERENCES `users`(`user_id`),
    `doctor_id` int REFERENCES `users`(`user_id`),
    `appointment_date` date,
    `morning_med` varchar(50),
    `afternoon_med` varchar(50),
    `night_med` varchar(50),
    `prescription_date` date,
    `comment` varchar(500),
    `completed` boolean
    
);



CREATE TABLE `patient_records` (
  `record_id` serial PRIMARY KEY,
  `patient_id` int REFERENCES `users`(`user_id`),
  `morning_med_check` boolean,
  `afternoon_med_check` boolean,
  `night_med_check` boolean,
  `breakfast` boolean,
  `lunch` boolean,
  `dinner` boolean,
  `cur_date` date
  
);


