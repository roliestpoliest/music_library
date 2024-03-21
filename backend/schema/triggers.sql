DELIMITER $$

CREATE TRIGGER `add_account_to_artists`
AFTER INSERT ON `accounts`
FOR EACH ROW
BEGIN
    IF NEW.user_role = 'Artist' THEN
        INSERT INTO `artists` (`account_id`)
        VALUES (NEW.account_id);
    END IF;
END$$

DELIMITER ;

DELIMITER $$

CREATE TRIGGER `add_account_to_admins`
AFTER INSERT ON `accounts`
FOR EACH ROW
BEGIN
    IF NEW.user_role = 'Admin' THEN
        INSERT INTO `admins` (`account_id`)
        VALUES (NEW.account_id);
    END IF;
END$$

DELIMITER ;
