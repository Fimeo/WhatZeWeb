CREATE TABLE `comment` (
   `id` int(11) NOT NULL,
   `pseudo` varchar(100) NOT NULL,
   `content` text NOT NULL,
   `createdAt` datetime NOT NULL,
   `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `comment` (`id`, `pseudo`, `content`, `createdAt`, `article_id`) VALUES
(1, 'Jean', 'Génial, hâte de voir ce que ça donne !', '2019-03-16 21:02:24', 1),
(2, 'Nina', 'Trop cool ! depuis le temps', '2019-03-17 17:34:35', 1),
(3, 'Rodrigo', 'Great ! ', '2019-03-17 17:42:04', 1),
(4, 'Hélène', 'je suis heureuse de découvrir un super site ! Continuez comme ça ', '2019-03-18 12:08:37', 2),
(5, 'Moussa', 'Un peu déçu par le contenu pour le moment...', '2019-03-18 03:09:02', 2),
(6, 'Barbara', 'pressée de voir la suite', '2019-03-18 10:05:58', 2),
(7, 'Guillaume', 'Je viens ici pour troller !', '2019-03-19 21:08:44', 3),
(8, 'Aurore', 'Enfin un blog tranquille, où on ne nous casse pas les pieds !', '2019-03-19 21:09:27', 3),
(9, 'Jordane', 'Je suis vendéen ! Amateur de mojettes !', '2019-03-20 10:10:11', 3);

ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_article_id` (`article_id`);

ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `comment`
  ADD CONSTRAINT `fk_article_id` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`);

ALTER TABLE `comment` ADD `flag` BOOLEAN NOT NULL AFTER `createdAt`;