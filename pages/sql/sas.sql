CREATE TABLE `Administrator`(
    `admin_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `fname` VARCHAR(255) NOT NULL,
    `lname` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);
CREATE TABLE `Transit`(
    `transit_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `depature_town` VARCHAR(255) NOT NULL,
    `destination` VARCHAR(255) NOT NULL,
    `trunk_id` INT NOT NULL,
    `transporter_id` INT NOT NULL,
    `datetime` DATETIME NULL
);
CREATE TABLE `Trunks`(
    `trunk_id` INT NOT NULL AUTO_INCREMENT,
    `trunk_name` VARCHAR(255) NOT NULL,
    `status` VARCHAR(255) NOT NULL,
    PRIMARY KEY(`trunk_id`)
);
CREATE TABLE `Coordinates`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `trunk_id` INT NOT NULL,
    `latitude` DECIMAL NOT NULL,
    `longitude` DECIMAL NOT NULL,
    `date_time` DATETIME(6) NOT NULL
);
CREATE TABLE `Alerts`(
    `alert_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `alert_type` VARCHAR(255) NOT NULL,
    `alert_msg` VARCHAR(255) NOT NULL,
    `longitude` DECIMAL(6) NOT NULL,
    `latitude` DECIMAL(6) NOT NULL,
    `Time_stamp` TIMESTAMP(6),
    `trunk_id` INT NOT NULL,
    `transporter_id` INT NOT NULL
);
CREATE TABLE `Transporter`(
    `transporter_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `fname` VARCHAR(255) NOT NULL,
    `lname` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `nrc` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(255) NOT NULL,
    `finger_id` VARCHAR(255) NOT NULL,
    `status` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);


ALTER TABLE `Alerts` ADD CONSTRAINT `trunk_id_alert` FOREIGN KEY (`trunk_id`) REFERENCES `Trunks`(`trunk_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Alerts` ADD CONSTRAINT `transporter_id_alert` FOREIGN KEY (`transporter_id`) REFERENCES `Transporter`(`transporter_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `Transit` ADD CONSTRAINT `trunk_id_transit` FOREIGN KEY (`trunk_id`) REFERENCES `Trunks`(`trunk_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Transit` ADD CONSTRAINT `transporter_id_transit` FOREIGN KEY (`transporter_id`) REFERENCES `Transporter`(`transporter_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;