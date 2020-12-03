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

INSERT INTO ask_mate_again.registered_user (id, email, password_hash, registration_time) VALUES (1, 'test@test.com', '$2y$10$6g9bdxpkbkBvolevahRwT.NncQOjMnIpKDwekuMUFc7afA5JBJ0.G', '2020-12-03 13:51:32');
INSERT INTO ask_mate_again.registered_user (id, email, password_hash, registration_time) VALUES (2, 'user@user.hu', '$2y$10$AAdA/H4r8897KwUHM4thuuKauQXIgeM9Kd8py0NdNx0lzML//Dl82', '2020-12-03 13:52:36');
INSERT INTO ask_mate_again.registered_user (id, email, password_hash, registration_time) VALUES (3, 'john@doe.com', '$2y$10$KuIbdf64FBxYu.JHOzTMR.fTw6rFvth6NgvTMecdr2h.HWo1Ocs3i', '2020-12-03 13:55:56');
INSERT INTO ask_mate_again.registered_user (id, email, password_hash, registration_time) VALUES (4, 'something@sg.com', '$2y$10$/oOOPJmFNwp8WczSYG1AFe6YUukSG.xcRL7CoOTsit69fRYdlx/gm', '2020-12-03 15:32:55');

INSERT INTO ask_mate_again.image (id, directory, file_name, upload_time) VALUES (1, '/../../Static/image/', 'belgian_waffel.jpg', '2020-12-03 13:59:32');
INSERT INTO ask_mate_again.image (id, directory, file_name, upload_time) VALUES (2, '/../../Static/image/', 'rainbow-cake.jpg', '2020-12-03 14:04:39');
INSERT INTO ask_mate_again.image (id, directory, file_name, upload_time) VALUES (3, '/../../Static/image/', 'bakedolives.jpg', '2020-12-03 14:13:28');
INSERT INTO ask_mate_again.image (id, directory, file_name, upload_time) VALUES (4, '/../../Static/image/', 'frenchfries.jpg', '2020-12-03 14:15:35');

INSERT INTO ask_mate_again.question (id, id_image, id_registered_user, title, message, vote_number, submission_time) VALUES (1, 1, 1, 'Belgian waffle recipe help', 'Good Evening Everyone!&#13;&#10;&#13;&#10;Since Covid began I’ve been working on a Belgian waffle recipe I’d like to introduce in to my small batch ice cream shop. I’ve tracked down and imported Belgian Sugar Crystals and am using a Krampfouz waffle iron. Which we bake them at 190 for 3 minutes.&#13;&#10;&#13;&#10;The problem is that my waffles become fairly stiff after they cool down. I was in Travelling last year and had some in a cafe that were absolutely delicious and even had a friend overnight me a batch to compare and contrast. Can’t seem to make mine stay soft over 20-30 minutes. The cafe we were at had filling in them. Or were dipped in chocolate. While I would love to do that, they become too hard. I’ve tried a dozen recipes and can’t seem to match the cafe theirs almost had a donut like consistency. I’ve included the one that seems to have worked best below. Any suggestions would help.&#13;&#10;&#13;&#10;note: we do let it rise for 12-18 hrs (tried various times) both in and out of the fridge.', 1, '2020-12-03 13:59:32');
INSERT INTO ask_mate_again.question (id, id_image, id_registered_user, title, message, vote_number, submission_time) VALUES (2, 2, 2, 'Vanilla cake mix - Technical issues', 'I&#39;m wondering if someone can help with a technical issue I have,,, We have a vanilla mix that tastes amazing but one of our teams seems to really struggle to get it right. I think they are over mixing it and as a result the baked cake looks dense and raw (it isn&#39;t). It&#39;s a reverse cream method. &#13;&#10;&#13;&#10;It does contain lots of fat BUT our second store never get it wrong. Although I&#39;ve built an amazing baking business I&#39;m not a trained pastry chef and I need some advice if anyone can help?', 1, '2020-12-03 14:04:39');
INSERT INTO ask_mate_again.question (id, id_image, id_registered_user, title, message, vote_number, submission_time) VALUES (3, 3, 2, 'Orange and Rosemary Baked Olives', 'Low-carb, healthful snack choice which can be kept in the fridge for up to two weeks.&#13;&#10;Preheat oven to 375 degrees F (190 degrees C). Stir the olives together with the wine, orange juice, olive oil, and garlic in a 9x13 inch baking dish. Nestle the sprigs of rosemary in the olives.&#13;&#10;Bake in the preheated oven for 15 minutes, stirring halfway through the baking. Remove and discard the rosemary sprigs, then stir in the parsley, oregano, orange zest, and red pepper flakes. Serve warm, or cool the olives and use them to top a salad.', 0, '2020-12-03 14:13:28');
INSERT INTO ask_mate_again.question (id, id_image, id_registered_user, title, message, vote_number, submission_time) VALUES (4, 4, 2, 'Hand cut French fries', 'We have an issue with our fries staying crispy. We cut Idaho potatoes and place them into a 3 compartment sink filled with hot water and a cup of kosher salt. They soak for about one hour and then we give them a first cook in fryer oil at 350. This par cook is fine until the potato just starts to want to turn color and ends up about half cooked. We then toss these in a plastic tub and put in the walk in cooler until service. At service we fry until brown and crispy. Any thoughts on how to improve flavor and texture?&#13;&#10;&#13;&#10;The size of the fries is show in the attached image', 9, '2020-12-03 14:15:35');
INSERT INTO ask_mate_again.question (id, id_image, id_registered_user, title, message, vote_number, submission_time) VALUES (5, null, 3, 'Want to make ketchup from scratch - do I need an immersion blender?', 'Before I go nuts looking at god-knows-how-many-available-internet-recipes.... do I need an immersion blender to properly make ketchup? The end goal is a smooth texture, as a base for BBQ sauce.&#13;&#10;&#13;&#10;Thanks in advance.', 2, '2020-12-03 15:27:20');
INSERT INTO ask_mate_again.question (id, id_image, id_registered_user, title, message, vote_number, submission_time) VALUES (6, null, 3, 'Repurposing holiday feast leftovers', 'Here in the United States we just finished celebrating Thanksgiving, and despite to current climate I cooked a full holiday dinner feast in the style of New England: Turkey, dressing, cranberry sauce, cornbread, roasted Brussels sprouts with crispy pancetta, creamy mashed potato, and cornbread.&#13;&#10;&#13;&#10;There were no leftovers (to use the words of Iceman). Well... there was some leftover turkey meat... but that’s to be expected.&#13;&#10;&#13;&#10;Turkey legs and wings, which nobody seems to like eating, were repurposed into a delectable turkey salad for sandwiches. The remainder will get smothered by mole poblano, from a paste bought at local Mexican market.&#13;&#10;&#13;&#10;The remainder of the buttermilk getting frozen for future biscuit making.&#13;&#10;&#13;&#10;The remainder of the heavy cream... well this year becomes an experiment. Most often I convert to butter but I have a Meyer Lemon tree just brimming with ripe fruit... so a lemon posset will be made.&#13;&#10;&#13;&#10;How else can I repurpose leftover holiday feast food and ingredients?', 1, '2020-12-03 15:28:49');

INSERT INTO ask_mate_again.tag (id, name) VALUES (1, 'breakfast');
INSERT INTO ask_mate_again.tag (id, name) VALUES (2, 'cake');
INSERT INTO ask_mate_again.tag (id, name) VALUES (3, 'healthy');
INSERT INTO ask_mate_again.tag (id, name) VALUES (4, 'potato');
INSERT INTO ask_mate_again.tag (id, name) VALUES (5, 'kitchen');

INSERT INTO ask_mate_again.rel_question_tag (id, id_question, id_tag) VALUES (1, 1, 1);
INSERT INTO ask_mate_again.rel_question_tag (id, id_question, id_tag) VALUES (2, 2, 2);
INSERT INTO ask_mate_again.rel_question_tag (id, id_question, id_tag) VALUES (3, 3, 3);
INSERT INTO ask_mate_again.rel_question_tag (id, id_question, id_tag) VALUES (4, 4, 4);
INSERT INTO ask_mate_again.rel_question_tag (id, id_question, id_tag) VALUES (5, 5, 5);
INSERT INTO ask_mate_again.rel_question_tag (id, id_question, id_tag) VALUES (6, 6, 1);
INSERT INTO ask_mate_again.rel_question_tag (id, id_question, id_tag) VALUES (7, 6, 2);

INSERT INTO ask_mate_again.answer (id, id_question, id_registered_user, message, vote_number, submission_time) VALUES (1, 1, 1, 'This is how it also happens in belgium, we cannot keep the real Liège waffles fresh for the next day, they are cooked à la minute in front of the customer.
Personally, I never made them.
What vendors sometimes do is put a baked waffle back into the waffle iron to heat it up, but never with a waffle from the day before.
The industry offers so-called Liège waffles which are eaten cold.
Try to line up the ingredients of a donut recipe next to the ingredients of a Liège waffle, and correct your recipe.
Good luck!', 0, '2020-12-03 14:00:01');
INSERT INTO ask_mate_again.answer (id, id_question, id_registered_user, message, vote_number, submission_time) VALUES (2, 2, 3, 'Is it butter? do both teams use the same brand of butter? butterfat can make a huge difference. so can the temperature of the butter. warm soft butter will never beat properly', 0, '2020-12-03 14:05:36');
INSERT INTO ask_mate_again.answer (id, id_question, id_registered_user, message, vote_number, submission_time) VALUES (3, 2, 2, 'The team (member) that successfully makes this should go to the second location and make the cake. This can help you narrow the problem to staff error (if the cake comes out right when the visiting team makes it) or equipment/possible ingredient issue if it doesn''t come out right.', 0, '2020-12-03 14:06:29');
INSERT INTO ask_mate_again.answer (id, id_question, id_registered_user, message, vote_number, submission_time) VALUES (4, 3, 1, 'These are delicious! I used kalamata olives which aren''t called for here but that''s what I had. Surprisingly the olives didn''t overpower the seasonings.', 0, '2020-12-03 14:17:18');
INSERT INTO ask_mate_again.answer (id, id_question, id_registered_user, message, vote_number, submission_time) VALUES (5, 4, 1, 'Soaking them for an hour is the problem. As soon as they''re cut, par cook them and place them in the walk-in. Then increase the temperature of your oil about 25''f or so higher than normal. Fry as usual. ', 2, '2020-12-03 14:17:35');
INSERT INTO ask_mate_again.answer (id, id_question, id_registered_user, message, vote_number, submission_time) VALUES (6, 3, 3, 'Loved these olives and it took no time to make. The green cerignolas olives were especially good. Thanks for sharing it user!', 0, '2020-12-03 14:18:23');
INSERT INTO ask_mate_again.answer (id, id_question, id_registered_user, message, vote_number, submission_time) VALUES (7, 4, 3, 'The above poster may be correct, but I would suggest leaving them uncovered in your walk-in to dry off before you fry them. The excess moisture may be the problem.', 0, '2020-12-03 14:18:39');
INSERT INTO ask_mate_again.answer (id, id_question, id_registered_user, message, vote_number, submission_time) VALUES (8, 5, 1, 'Immersion blender is really nice for making catsup or bbq sauce... but a regular jar blender works too. Food processor will not get smooth enough.', 0, '2020-12-03 15:31:15');
INSERT INTO ask_mate_again.answer (id, id_question, id_registered_user, message, vote_number, submission_time) VALUES (9, 6, 1, 'Soup, pot pie, tamales', 0, '2020-12-03 15:31:33');
INSERT INTO ask_mate_again.answer (id, id_question, id_registered_user, message, vote_number, submission_time) VALUES (10, 5, 2, 'Do you need an immersion blender to make ketchup? No.

Should you have an immersion blender? Yes. ', 0, '2020-12-03 15:32:09');
INSERT INTO ask_mate_again.answer (id, id_question, id_registered_user, message, vote_number, submission_time) VALUES (11, 6, 2, 'I could take care of three dishes in one sandwich. The mashed potatoes can be used for fried Potato patties for breakfast. ', 0, '2020-12-03 15:32:23');
INSERT INTO ask_mate_again.answer (id, id_question, id_registered_user, message, vote_number, submission_time) VALUES (12, 5, 4, 'I’ve only had two in my entire life. The first was a cheap one and it lasted nearly forever. Finally the bearing gave out. Now I have a 2-speed Waring Commercial. Not sure how old it is because I bought it used about 3 years ago. I much prefer having fast and slow rather than just fast.', 1, '2020-12-03 15:33:17');
INSERT INTO ask_mate_again.answer (id, id_question, id_registered_user, message, vote_number, submission_time) VALUES (13, 6, 4, 'My wife likes cold turkey sandwiches on white bread. I''m a heathen and just pile a bunch of reheated leftovers on a plate and just have Thanksgiving dinner several times. Though this year we had more than usual because leftovers usually get sent home with people as care packages.', 0, '2020-12-03 15:33:31');
