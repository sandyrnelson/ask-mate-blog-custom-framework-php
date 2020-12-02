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
    `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_question` INT(11) UNSIGNED NOT NULL,
    `id_tag`      INT(11) UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_question_on_rel_question_tag` FOREIGN KEY (`id_question`) REFERENCES `question`(`id`),
    CONSTRAINT `fk_tag_on_rel_question_tag` FOREIGN KEY (`id_tag`) REFERENCES `tag`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

SET FOREIGN_KEY_CHECKS = TRUE;

INSERT INTO registered_user VALUES (1, 'test@test.com', '$2y$10$d5WOxRJQJSnjGxd8RMEiS.Y51g.hWGnlVdlc9L/aTM9pth5fRWSiO', '2020-12-02 10:30:20');
#psw: test
INSERT INTO registered_user VALUES (2, 'user@user.hu', '$2y$10$0cbjFKiblYPkRXBh0BJxjuwSKkgGCVsS3SIc5EovukM3UwALPoS0i', '2020-12-02 10:30:29');
#psw: user
INSERT INTO registered_user VALUES (3, 'john@doe.com', '$2y$10$wC8XZrHvq8DPeylJ9DI7fuU.esvqhu5Sb.efVwUUN6qjQ3CpWwVPq', '2020-12-02 10:30:57');
#psw: john
INSERT INTO registered_user VALUES (4, 'virag.baranyai2@gmail.com', '$2y$10$xIFif8pL13nRX0/feJwodOwyEHhq.bhxs9uDGusLPbxo7fN0Ys8ve', '2020-12-02 11:29:20');



INSERT INTO image VALUES (2, 'image', 'Hugo', '2011-02-16 10:43:00' );
INSERT INTO image VALUES (1, 'image', 'Hugo', '2011-02-16 10:43:00' );
INSERT INTO image VALUES (3, 'image', 'Kirusha', '2008-03-16 12:41:00' );
INSERT INTO image VALUES (4, 'image', 'Polka', '2010-02-16 01:10:30' );
INSERT INTO image VALUES (5, 'image', 'Blumen', '2015-10-02 13:40:08' );

INSERT INTO question VALUES (1, 3, 1, 'Drawing canvas with...', 'I''m getting an image from device and drawing a canvas with filters using Pixi JS. It works all well using computer to get an image. But when I''m on IOS, it throws errors such as cross origin issue, or that I''m trying to use an unknown format.
', 22,  '2001-05-01 10:41:00');
INSERT INTO question VALUES (2, 2, 3, 'Coco', 'Coco is a super cute beautiful komondor boy.', 12, '2004-02-05 10:41:00');
INSERT INTO question VALUES (3, 5, 2, 'Bumi', 'Bumi is a the eldest boy in da house.', 23, '2001-03-05 8:21:20');
INSERT INTO question VALUES (4, 2, 4, 'Kikelet', 'Pitypang and Emil are real rocknrollas.', 73, '2003-09-29 07:21:32');

INSERT INTO tag VALUES (1, 'python');
INSERT INTO tag VALUES (2, 'sql');
INSERT INTO tag VALUES (3, 'css');
INSERT INTO tag VALUES (4, 'mariadb');
INSERT INTO tag VALUES (5, 'java');
INSERT INTO tag VALUES (6, 'python');
INSERT INTO tag VALUES (7, 'trambulin');

INSERT INTO rel_question_tag VALUES (1, 1, 1);
INSERT INTO rel_question_tag VALUES (2, 4, 2);
INSERT INTO rel_question_tag VALUES (3, 4, 3);
INSERT INTO rel_question_tag VALUES (4, 4, 4);
INSERT INTO rel_question_tag VALUES (5, 2, 3);
INSERT INTO rel_question_tag VALUES (6, 3, 3);
INSERT INTO rel_question_tag VALUES (7, 3, 6);
INSERT INTO rel_question_tag VALUES (8, 2, 5);
INSERT INTO rel_question_tag VALUES (9, 1, 2);
INSERT INTO rel_question_tag VALUES (10, 4, 7);

INSERT INTO answer VALUES (1, 1, 1, 'This is an answer.', 34, '2019-11-21 20:01:05');
INSERT INTO answer VALUES (2, 3, 2, 'Another answer.', 18, '2017-08-10 18:01:05');
INSERT INTO answer VALUES (3, 3, 3, 'That\'s not funny answer.', 34, '2016-08-23 08:01:12');
INSERT INTO answer VALUES (4, 2, 3, 'Ereszcsatorna.', 56, '2018-05-22 03:41:05');
INSERT INTO answer VALUES (5, 1, 3, 'Zúgolódik már a tenger.', 42, '2010-02-05 01:01:01');
INSERT INTO answer VALUES (6, 2, 4, 'I nedd answers.', 18, '2017-12-19 07:57:55');
INSERT INTO answer VALUES (7, 2, 4, 'What is your favorite answer?.', 18, '2020-08-10 04:31:05');

