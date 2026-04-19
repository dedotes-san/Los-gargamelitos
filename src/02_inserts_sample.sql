-- ==========================================
-- SAMPLE INSERT DATA
-- MythCore RPG Launcher
-- ==========================================

-- ==========================================
-- INSERT USERS
-- ==========================================

INSERT INTO users 
(username, email, password, avatar, level, xp)
VALUES

('PlayerOne','player1@email.com','123456','avatar1.png',5,1200),
('ShadowKnight','shadow@email.com','123456','avatar2.png',10,3500),
('MageLord','mage@email.com','123456','avatar3.png',7,2200),
('DragonSlayer','dragon@email.com','123456','avatar4.png',15,5400),
('NoobMaster','noob@email.com','123456','avatar5.png',2,300);


-- ==========================================
-- INSERT FAVORITES
-- ==========================================

INSERT INTO favorites (user_id, game_id)
VALUES

(1,7),
(1,14),
(2,8),
(3,19),
(4,15),
(5,32);


-- ==========================================
-- INSERT FRIEND REQUESTS
-- ==========================================

INSERT INTO friend_requests
(sender_id, receiver_id, status)
VALUES

(1,2,'pending'),
(2,3,'pending'),
(3,4,'accepted'),
(4,5,'pending');


-- ==========================================
-- INSERT FRIENDS
-- ==========================================

INSERT INTO friends
(sender_id, receiver_id, status)
VALUES

(1,2,'accepted'),
(2,3,'accepted'),
(3,4,'accepted'),
(4,5,'accepted');


-- ==========================================
-- INSERT MESSAGES
-- ==========================================

INSERT INTO messages
(sender_id, receiver_id, message, status)
VALUES

(1,2,'Hola, quieres jugar hoy?','sent'),
(2,1,'Claro, vamos a jugar!','sent'),
(3,4,'¿Listo para la raid?','sent'),
(4,3,'Sí, ya entro.','sent'),
(5,1,'Agregame como amigo.','sent');


-- ==========================================
-- INSERT BLOCKED USERS
-- ==========================================

INSERT INTO blocked_users
(blocker_id, blocked_id)
VALUES

(2,5),
(3,1);


-- ==========================================
-- INSERT REPORTS
-- ==========================================

INSERT INTO reports
(reported_id, reason)
VALUES

(5,'Spam messages'),
(2,'Inappropriate language');
