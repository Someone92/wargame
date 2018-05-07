CREATE TABLE `books` (
  `id` int(10) NOT NULL,
  `book` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `books` (`id`, `book`) VALUES
(1, 'dummy value');

ALTER TABLE `books`
ADD PRIMARY KEY (`id`);

ALTER TABLE `books`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;