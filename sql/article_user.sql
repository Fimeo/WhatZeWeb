ALTER TABLE `article`
    DROP COLUMN `author`;

ALTER TABLE `article`
    ADD COLUMN `user_id` int(11) NOT NULL;

ALTER TABLE `article`
    ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
