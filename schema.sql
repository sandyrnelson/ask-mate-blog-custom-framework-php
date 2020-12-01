/*
 * AskMate, again
 *
 * Database schema
 * Version: 10.4.13-MariaDB
 */

CREATE DATABASE IF NOT EXISTS `ask_mate_again` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ask_mate_again`;

SET FOREIGN_KEY_CHECKS = FALSE;

DROP TABLE IF EXISTS `registered_user`;
CREATE TABLE `registered_user`
(
    `id`                INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `email`             TEXT NOT NULL,
    `password_hash`     TEXT NOT NULL,
    `registration_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image`
(
    `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `directory`   TEXT NOT NULL,
    `file_name`   TEXT NOT NULL,
    `upload_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question`
(
    `id`                 INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_image`           INT(11) UNSIGNED NULL,
    `id_registered_user` INT(11) UNSIGNED NOT NULL,
    `title`              VARCHAR(255) NOT NULL,
    `message`            TEXT NOT NULL,
    `vote_number`        INT(11) NOT NULL,
    `submission_time`    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_image_on_question` FOREIGN KEY (`id_image`) REFERENCES `image`(`id`),
    CONSTRAINT `fk_registered_user_on_question` FOREIGN KEY (`id_registered_user`) REFERENCES `registered_user`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

DROP TABLE IF EXISTS `answer`;
CREATE TABLE `answer`
(
    `id`                 INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_question`        INT(11) UNSIGNED NOT NULL,
    `id_registered_user` INT(11) UNSIGNED NOT NULL,
    `message`            TEXT NOT NULL,
    `vote_number`        INT(11) NOT NULL,
    `submission_time`    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_question_on_answer` FOREIGN KEY (`id_question`) REFERENCES `question`(`id`),
    CONSTRAINT `fk_registered_user_on_answer` FOREIGN KEY (`id_registered_user`) REFERENCES `registered_user`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag`
(
    `id`   INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` TEXT NOT NULL,
    PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `rel_question_tag`;
CREATE TABLE `rel_question_tag`
(
    `id_question` INT(11) UNSIGNED NOT NULL,
    `id_tag`      INT(11) UNSIGNED NOT NULL,
    CONSTRAINT `fk_question_on_rel_question_tag` FOREIGN KEY (`id_question`) REFERENCES `question`(`id`),
    CONSTRAINT `fk_tag_on_rel_question_tag` FOREIGN KEY (`id_tag`) REFERENCES `tag`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

SET FOREIGN_KEY_CHECKS = TRUE;


INSERT INTO registered_user VALUES (1, 'virag.baranyai2@gmail.com', 'hashed', '1987-12-16 10:41:00' );
INSERT INTO registered_user VALUES (2, 'john@doe.com', 'hashpotato', '1999-06-16 10:41:00' );

INSERT INTO image VALUES (1, 'image', 'Flower', '2010-02-16 10:41:00' );
INSERT INTO image VALUES (2, 'image', 'Blumen', '2015-10-02 10:41:00' );

INSERT INTO question VALUES (2, 1, 1, 'Drawing canvas with an image picked with Cordova Camera Plugin', 'I''m getting an image from device and drawing a canvas with filters using Pixi JS. It works all well using computer to get an image. But when I''m on IOS, it throws errors such as cross origin issue, or that I''m trying to use an unknown format.
', 22,  '2001-05-01 10:41:00');
INSERT INTO question VALUES (1, 2, 1, 'Coco', 'Coco is a super cute beautiful komondor boy.', 12, '2004-02-05 10:41:00');

INSERT INTO tag VALUES (1, 'python');
INSERT INTO tag VALUES (2, 'sql');
INSERT INTO tag VALUES (3, 'css');

INSERT INTO rel_question_tag VALUES (1, 1);
INSERT INTO rel_question_tag VALUES (1, 2);
INSERT INTO rel_question_tag VALUES (2, 3);

INSERT INTO answer VALUES (1, 1, 1, 'This is an answer.', 34, '2019-11-21 20:01:05');
INSERT INTO answer VALUES (2, 2, 2, 'Another answer.', 18, '2017-08-10 18:01:05');

