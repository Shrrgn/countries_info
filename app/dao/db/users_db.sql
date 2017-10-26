#into users_db

CREATE TABLE users (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nickname VARCHAR(25) NOT NULL,
	password VARCHAR(40) NOT NULL,
	mail VARCHAR(20) NOT NULL,
	UNIQUE KEY (nickname) 	
);

INSERT INTO users (nickname, password, mail) VALUES
	('chossen12', md5('chossen12'), 'harry@ukr.net'),
	('ginger111', md5('ginger111'), 'ron@gmail.com'),
	('coolgirl_me', md5('coolgirl_me'),'coolgirl_me@ukr.net'),
	('nevilllll', md5('nevilllll'), 'nevilllll@hogwarts.uk.com'),
	('dark_lord', md5('dark_lord'), 'dark_lord@mail.ru');