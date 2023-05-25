--CREATE user TABLE
CREATE TABLE user (
    id VARCHAR(10) PRIMARY KEY,
    isAdmin BOOLEAN,
    CONSTRAINT uq_user_id UNIQUE (id)
);

--CREATE poll TABLE
CREATE TABLE poll (
    id VARCHAR(10) PRIMARY KEY,
    name VARCHAR(50),
    info VARCHAR(500),
    CONSTRAINT uq_poll_id UNIQUE (id)
);

--CREATE side TABLE
CREATE TABLE side (
    id VARCHAR(10) PRIMARY KEY,
    poll_id VARCHAR(10),
    name VARCHAR(255),
    info VARCHAR(500),
    FOREIGN KEY (poll_id) REFERENCES poll(id)
);

--CREATE vote TABLE
CREATE TABLE vote (
    user_id VARCHAR(10),
    poll_id VARCHAR(10),
    side_id VARCHAR(10),
    PRIMARY KEY (user_id, poll_id, side_id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (poll_id) REFERENCES poll(id),
    FOREIGN KEY (side_id) REFERENCES side(id)
);

--add user
INSERT INTO
    user (id, isAdmin)
VALUES
    ('user123', true);

--delete user
DELETE FROM
    user
WHERE
    id = 'your_user_id';

--add poll
INSERT INTO
    poll (id, name, info)
VALUES
    (
        'your_poll_id',
        'Your Poll Name',
        'Your Poll Information'
    );

--add side
INSERT INTO
    side (id, poll_id, name, info)
VALUES
    (
        'your_side_id',
        'your_poll_id',
        'Side Name',
        'Side Information'
    );

--add vote
INSERT INTO
    vote (user_id, poll_id, side_id)
VALUES
    ('your_user_id', 'your_poll_id', 'your_side_id');

--delete poll from by poll id
DELETE FROM
    vote
WHERE
    poll_id = 'your_poll_id_here';

DELETE FROM
    side
WHERE
    poll_id = 'your_poll_id_here';

DELETE FROM
    poll
WHERE
    id = 'your_id_here';

--get poll from poll id  in poll table
SELECT
    *
FROM
    poll
WHERE
    id = 'your_poll_id';

--get side from poll id  in side table
SELECT
    *
FROM
    side
WHERE
    poll_id = 'your_poll_id';