INSERT INTO user (id, username, avatar) VALUES
(1, 'Ваня Денисов', 'assets/avatar1.png'),
(2, 'Лиза Дёмина', 'assets/avatar2.png');

INSERT INTO post (user_id, image, text, likes, created_at) VALUES
(1, 'assets/snow_city.png', 'Так красиво сегодня на улице! Настоящая зима)) Вспоминается Бродский...', 203, FROM_UNIXTIME(1774224000)),
(2, 'assets/flowers.png', '', 45, DATE_SUB(NOW(), INTERVAL 2 HOUR));