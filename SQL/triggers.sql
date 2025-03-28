
CREATE TRIGGER Calc_Recent_Ratings
    AFTER INSERT ON song_play_count FOR EACH ROW 
    BEGIN
    UPDATE songs c 
    SET `listens` = (
    SELECT COUNT(1) FROM `song_play_count` AS s
        WHERE s.event_time <= LAST_DAY(CURRENT_TIMESTAMP)
        AND s.event_time >= CAST(DATE_FORMAT(NOW() ,'%Y-%m-01') as DATE)
        AND s.song_id = NEW.song_id)
    WHERE c.song_id = NEW.song_id
    END;

    
CREATE TRIGGER increase_follower_count
    AFTER INSERT ON followed_artists FOR EACH ROW
    BEGIN
    UPDATE artists a
    SET a.followers = a.followers + 1
    WHERE a.artist_id = NEW.artist_id
    END;

CREATE TRIGGER reduce_follower_count
    AFTER DELETE ON followed_artists FOR EACH ROW
    BEGIN
    UPDATE artists a
    SET a.followers = a.followers - 1
    WHERE a.artist_id = OLD.artist_id
    END;

    


root@localhost
