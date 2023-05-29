CREATE TABLE `user` (
  `user_username` VARCHAR(10) PRIMARY KEY,
  `user_isAdmin` BOOLEAN,
  CONSTRAINT `uq_user_username` UNIQUE (`user_username`)
);

CREATE TABLE `poll` (
  `poll_id` INT PRIMARY KEY AUTO_INCREMENT,
  `poll_name` VARCHAR(255),
  `poll_info` VARCHAR(500),
  `poll_created_at` TIMESTAMP,
  `poll_startDate` DATE,
  `poll_endDate` DATE
);

CREATE TABLE `option` (
  `option_id` INT PRIMARY KEY AUTO_INCREMENT,
  `poll_id` INT,
  `option_name` VARCHAR(255),
  `option_info` VARCHAR(500),
  FOREIGN KEY (`poll_id`) REFERENCES `poll`(`poll_id`)
);

CREATE TABLE `vote` (
  `user_username` VARCHAR(10),
  `poll_id` INT,
  `option_id` INT,
  PRIMARY KEY (`user_username`, `poll_id`),
  FOREIGN KEY (`user_username`) REFERENCES `user`(`user_username`),
  FOREIGN KEY (`poll_id`) REFERENCES `poll`(`poll_id`),
  FOREIGN KEY (`option_id`) REFERENCES `option`(`option_id`)
);

UPDATE `vote` SET `user_username`='[value-1]',`poll_id`='[value-2]',`option_id`='[value-3]' WHERE 1;
