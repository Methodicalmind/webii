/*
* In postgres
* CREATE USER ta_user WITH password 'ta_pass' NOCREATEDB;
* GRANT SELECT ON scripture TO ta_user;
*/

CREATE DATABASE scripture;
\c scripture

CREATE TABLE scripture
(
	id         SERIAL PRIMARY KEY,
	book       VARCHAR(128) NOT NULL,
    chapter    SMALLINT NOT NULL,
    verse      SMALLINT NOT NULL,
	content    TEXT NOT NULL
);

\d scripture;

INSERT INTO scripture(book, chapter, verse, content)
VALUES
('John', 1, 5, 'And the light shineth in darkness; and the darkness comprehended it not.'),
('Doctrine and Covenants', 88, 49, 'The light shineth in darkness, and the darkness comprehendeth it not; nevertheless, the day shall come when you shall comprehend even God, being quickened in him and by him.'),
('Doctrine and Covenants', 93, 28, 'He that keepeth his commandments receiveth truth and light, until he is glorified in truth and knoweth all things.'),
('Mosiah', 16, 9, 'He is the light and the life of the world; yea, a light that is endless, that can never be darkened; yea, and also a life which is endless, that there can be no more death.');


CREATE TABLE topic
(
	id         SERIAL PRIMARY KEY,
	name       VARCHAR(128) NOT NULL
);

CREATE TABLE scripture_topic
(
	id           SERIAL PRIMARY KEY,
    scripture_id INT NOT NULL REFERENCES scripture(id),
	name         VARCHAR(128) NOT NULL
);

INSERT INTO topic VALUES
(DEFAULT, 'faith'),
(DEFAULT, 'charity'),
(DEFAULT, 'love'),
(DEFAULT, 'hope');

INSERT INTO scripture_topic VALUES
(DEFAULT, 1, 'faith'),
(DEFAULT, 2, 'charity'),
(DEFAULT, 3, 'love'),
(DEFAULT, 4, 'hope');
