CREATE TABLE user (
  id VARCHAR(10) PRIMARY KEY,
  isAdmin BOOLEAN,
  CONSTRAINT uq_user_id UNIQUE (id)
);

CREATE TABLE poll (
  id VARCHAR(10) PRIMARY KEY,
  name VARCHAR(50),
  info VARCHAR(500),
  startdate DATE,
  enddate DATE,
  CONSTRAINT uq_poll_id UNIQUE (id)
);

CREATE TABLE side (
  id VARCHAR(10) PRIMARY KEY,
  poll_id VARCHAR(10),
  name VARCHAR(255),
  info VARCHAR(500),
  FOREIGN KEY (poll_id) REFERENCES poll(id)
);

CREATE TABLE vote (
  user_id VARCHAR(10),
  poll_id VARCHAR(10),
  side_id VARCHAR(10),
  PRIMARY KEY (user_id, poll_id, side_id),
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (poll_id) REFERENCES poll(id),
  FOREIGN KEY (side_id) REFERENCES side(id)
);

INSERT INTO
  user (id, isAdmin)
VALUES
  ('6409650089', true);

INSERT INTO
  poll (id, name, info, startdate, enddate)
VALUES
  (
    '0000000001',
    'expired poll',
    'expired poll info',
    '2023-01-01',
    '2023-01-31'
  );

INSERT INTO
  side (id, poll_id, name, info)
VALUES
  (
    '0000000001',
    '0000000001',
    'expired poll Side A',
    'expired poll Side A Info'
  );

INSERT INTO
  side (id, poll_id, name, info)
VALUES
  (
    '0000000002',
    '0000000001',
    'expired poll Side B',
    'expired poll Side B Info'
  );

INSERT INTO
  side (id, poll_id, name, info)
VALUES
  (
    '0000000003',
    '0000000001',
    'expired poll Side C',
    'expired poll Side C Info'
  );

INSERT INTO
  vote (user_id, poll_id, side_id)
VALUES
  ('6409650089', '0000000001', '0000000003');

INSERT INTO
  poll (id, name, info, startdate, enddate)
VALUES
  (
    '0000000002',
    'comingsoon poll',
    'comingsoon poll info',
    '2023-12-01',
    '2023-12-31'
  );

INSERT INTO
  poll (id, name, info, startdate, enddate)
VALUES
  (
    '0000000003',
    'test poll',
    'test test info',
    '2023-05-01',
    '2023-12-31'
  );

INSERT INTO
  side (id, poll_id, name, info)
VALUES
  (
    '0000000001',
    '0000000003',
    'test poll Side A',
    'test p oll Side A Info'
  );

INSERT INTO
  side (id, poll_id, name, info)
VALUES
  (
    '0000000002',
    '0000000003',
    'test poll Side B',
    'test poll Side B Info'
  );

INSERT INTO
  side (id, poll_id, name, info)
VALUES
  (
    '0000000003',
    '0000000003',
    'test poll Side C',
    'test poll Side C Info'
  );