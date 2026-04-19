-- TEST 1: Insert a new user
INSERT INTO users (username, email, password)
VALUES ('test_user', 'test@mail.com', '123456');

-- TEST 2: Verify user insertion
SELECT * FROM users
WHERE username = 'test_user';

-- TEST 3: Insert a new category
INSERT INTO categories (name)
VALUES ('Test Category');

-- TEST 4: Insert a game
INSERT INTO games (name, genre, id_category)
VALUES ('Test Game', 'RPG', 1);

-- TEST 5: Join test (users + messages)
SELECT u.username, m.message
FROM users u
JOIN messages m ON u.id = m.sender_id;

-- TEST 6: Count users
SELECT COUNT(*) AS total_users
FROM users;

-- TEST 7: Delete test user
DELETE FROM users
WHERE username = 'test_user';
