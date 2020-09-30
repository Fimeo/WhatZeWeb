CREATE TABLE `article` (
    `id` int(11) NOT NULL,
    `title` varchar(100) NOT NULL,
    `content` text NOT NULL,
    `author` varchar(100) NOT NULL,
    `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `article` (`id`, `title`, `content`, `author`, `createdAt`) VALUES
(1, 'Voici mon premier article', 'Mon super blog est en construction.', 'Karim', '2019-03-15 08:10:24'),
(2, 'Un deuxième article', 'Je continue à ajouter du contenu sur mon blog.', 'Karim', '2019-03-16 13:27:38'),
(3, 'Mon troisième article', 'Mon blog est génial !!!', 'Karim', '2019-03-16 14:45:57');

ALTER TABLE `article`
ADD PRIMARY KEY (`id`);
ALTER TABLE `article`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4; 