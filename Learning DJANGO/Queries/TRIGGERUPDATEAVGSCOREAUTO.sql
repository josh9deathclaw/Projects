DELIMITER //

CREATE TRIGGER update_avg_score AFTER INSERT ON userscore
FOR EACH ROW
BEGIN
    DECLARE total_score DECIMAL(5, 2);
    DECLARE total_reviews INT;
    DECLARE new_avg_score DECIMAL(5, 2);

    -- Calculate total score and total reviews for the game
    SELECT SUM(user_score), COUNT(*)
    INTO total_score, total_reviews
    FROM userscore
    WHERE game = NEW.game;

    -- Calculate average score
    IF total_reviews > 0 THEN
        SET new_avg_score = total_score / total_reviews;
    ELSE
        SET new_avg_score = 0; -- Or NULL, depending on your business logic
    END IF;

    -- Update average score in the Review table
    UPDATE reviewscore
    SET avg_score = new_avg_score
    WHERE game = NEW.game;

END //

DELIMITER ;