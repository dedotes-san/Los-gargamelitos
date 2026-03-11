SELECT
g.title,
d.name AS developer,
ge.name AS genre
FROM games g
JOIN developers d ON g.developer_id = d.developer_id
JOIN genres ge ON g.genre_id = ge.genre_id;

