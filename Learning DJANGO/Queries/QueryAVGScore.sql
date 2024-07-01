UPDATE reviewscore rs
SET rs.avg_score = (
	SELECT AVG(us.user_score)
	FROM userscore us
	WHERE us.game = rs.game	
);