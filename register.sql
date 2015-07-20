SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE TABLE IF NOT EXISTS users(
id int(11)  NOT NULL,
email varchar(50) NOT NULL,
username varchar(50) NOT NULL,
password varchar(255) NOT NULL,
date_created datetime NOT NULL,
date_modified datetime NOT NULL
 )ENGINE=InnoDb AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
ALTER TABLE users
ADD PRIMARY KEY (id);
