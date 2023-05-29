CREATE TABLE user (
  id VARCHAR(10) PRIMARY KEY,
  isAdmin BOOLEAN,
  CONSTRAINT uq_user_id UNIQUE (id)
);

CREATE TABLE poll (
  id INT PRIMARY KEY AUTO_INCREMENT,
  question VARCHAR(255),
  created_at TIMESTAMP,
  startDate DATE,
  endDate DATE
);

CREATE TABLE option (
  id INT PRIMARY KEY AUTO_INCREMENT,
  poll_id INT,
  name VARCHAR(255),
  info VARCHAR(500),
  FOREIGN KEY (poll_id) REFERENCES poll(id)
);

CREATE TABLE vote (
  user_id VARCHAR(10),
  poll_id INT,
  option_id INT,
  PRIMARY KEY (user_id, poll_id),
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (poll_id) REFERENCES poll(id),
  FOREIGN KEY (option_id) REFERENCES option(id)
);