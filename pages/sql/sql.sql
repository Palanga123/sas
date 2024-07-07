CREATE DATABASE `sas`;

CREATE TABLE `sas`.`admin` (
    `admin_id` INT(20) NOT NULL AUTO_INCREMENT , 
    `fname` VARCHAR(255) NOT NULL , 
    `lname` VARCHAR(255) NOT NULL , 
    `email` VARCHAR(255) NOT NULL ,
    `phone` VARCHAR(255) NOT NULL , 
    `nrc` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`admin_id`)) ENGINE = InnoDB;

CREATE TABLE `sas`.`users` (
    `user_id` INT(20) NOT NULL AUTO_INCREMENT , 
    `fname` VARCHAR(20) NOT NULL , 
    `lname` VARCHAR(20) NOT NULL , 
    `email` VARCHAR(20) NOT NULL ,
     `pass` VARCHAR(20) NOT NULL , 
     PRIMARY KEY (`user_id`)) ENGINE = InnoDB;

CREATE TABLE `sas`.`trunks` (
    `trunk_id` INT(20) NOT NULL AUTO_INCREMENT , 
    `status` VARCHAR(20) NOT NULL , 
    `` VARCHAR(20), 
     PRIMARY KEY (`user_id`)) ENGINE = InnoDB;

INSERT INTO `admin` (fname, lname, email, pass) VALUES("Humphrey", "Mulenga", "mulengahumphrey@gamil.com", "12345678")

ALTER TABLE `coordinates` ADD CONSTRAINT `trunk_id_coordinates` FOREIGN KEY (`trunk_id`) REFERENCES `Trunks`(`trunk_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;