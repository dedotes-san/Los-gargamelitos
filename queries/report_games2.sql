-- ==========================================
-- REPORT QUERIES – MythCore RPG Launcher
-- ==========================================

-- ==========================================
-- 1. SHOW ALL GAMES
-- ==========================================

SELECT id, name, genre
FROM games
ORDER BY name ASC;


-- ==========================================
-- 2. COUNT TOTAL GAMES
-- ==========================================

SELECT COUNT(*) AS total_games
FROM games;


-- ==========================================
-- 3. GAMES BY GENRE
-- ==========================================

SELECT genre, COUNT(*) AS total
FROM games
GROUP BY genre
ORDER BY total DESC;


-- ==========================================
-- 4. REAL VS CUSTOM GAMES
-- ==========================================

SELECT 
is_real,
COUNT(*) AS total
FROM games
GROUP BY is_real;


-- ==========================================
-- 5. SEARCH GAMES BY NAME
-- ==========================================

SELECT *
FROM games
WHERE name LIKE '%RPG%';


-- ==========================================
-- 6. USERS WITH MOST XP
-- ==========================================

SELECT 
username,
xp,
level
FROM users
ORDER BY xp DESC
LIMIT 10;


-- ==========================================
-- 7. USERS WITH MOST FRIENDS
-- ==========================================

SELECT 
sender_id AS user_id,
COUNT(*) AS total_friends
FROM friends
WHERE status = 'accepted'
GROUP BY sender_id
ORDER BY total_friends DESC;


-- ==========================================
-- 8. TOTAL MESSAGES SENT BY USER
-- ==========================================

SELECT 
sender_id,
COUNT(*) AS total_messages
FROM messages
GROUP BY sender_id
ORDER BY total_messages DESC;


-- ==========================================
-- 9. MOST FAVORITED GAMES
-- ==========================================

SELECT 
games.name,
COUNT(favorites.id) AS total_favorites
FROM favorites
JOIN games ON games.id = favorites.game_id
GROUP BY games.name
ORDER BY total_favorites DESC;


-- ==========================================
-- 10. FRIEND REQUESTS STATUS
-- ==========================================

SELECT 
status,
COUNT(*) AS total
FROM friend_requests
GROUP BY status;


-- ==========================================
-- 11. BLOCKED USERS COUNT
-- ==========================================

SELECT 
blocker_id,
COUNT(*) AS blocked_users
FROM blocked_users
GROUP BY blocker_id;


-- ==========================================
-- 12. RECENTLY ADDED GAMES
-- ==========================================

SELECT 
name,
created_at
FROM games
ORDER BY created_at DESC
LIMIT 10;
