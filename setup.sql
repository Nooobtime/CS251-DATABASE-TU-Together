CREATE TABLE user (
  id VARCHAR(10) PRIMARY KEY,
  isAdmin BOOLEAN,
  CONSTRAINT uq_user_id UNIQUE (id)
);

CREATE TABLE poll (
  id INT PRIMARY KEY,
  name VARCHAR(50),
  info VARCHAR(500),
  CONSTRAINT uq_poll_id UNIQUE (id)
);


CREATE TABLE side (
  id VARCHAR(10) PRIMARY KEY,
  poll_id INT,
  name VARCHAR(255),
  info VARCHAR(500),
  FOREIGN KEY (poll_id) REFERENCES poll(id)
);

CREATE TABLE vote (
  user_id VARCHAR(10),
  poll_id INT,
  side_id VARCHAR(10),
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (poll_id) REFERENCES poll(id),
  FOREIGN KEY (side_id) REFERENCES side(id)
);
