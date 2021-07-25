DROP DATABASE IF EXISTS `ctftraining`;
DROP DATABASE IF EXISTS `kee1ongzs_news`;
CREATE DATABASE kee1ongzs_news;
USE kee1ongzs_news;

CREATE TABLE passage
(
    id int PRIMARY KEY AUTO_INCREMENT,
    content varchar(1000)
);

INSERT INTO passage values(NULL, 'Hello,This is a simple test'),(NULL, 'You may find what you want in other tables.Good luck!');

create table if not exists Flag
(
	flag varchar(256) not null
);
