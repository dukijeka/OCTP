CREATE TABLE document
(
	id                   INTEGER NOT NULL,
	posting_user_id      INTEGER NOT NULL,
	date_created         DATE NULL,
	language_id          INTEGER NOT NULL
);

ALTER TABLE document
ADD CONSTRAINT XPKdocument PRIMARY KEY (id);

CREATE TABLE knows_language
(
	user_id              INTEGER NOT NULL,
	language_id          INTEGER NOT NULL
);

ALTER TABLE knows_language
ADD CONSTRAINT XPKknows_language PRIMARY KEY (user_id,language_id);

CREATE TABLE language
(
	id                   INTEGER NOT NULL,
	name                 VARCHAR(15) NULL
);

ALTER TABLE language
ADD CONSTRAINT XPKlanguage PRIMARY KEY (id);

CREATE TABLE rating
(
	user_id              INTEGER NOT NULL,
	translation_id       INTEGER NOT NULL,
	date                 DATE NULL,
	rating_value         INTEGER NULL CHECK ( rating_value BETWEEN 1 AND 10 )
);

ALTER TABLE rating
ADD CONSTRAINT XPKrating PRIMARY KEY (user_id,translation_id);

CREATE TABLE report
(
	document_id          INTEGER NOT NULL,
	user_id              INTEGER NOT NULL,
	date                 DATE NULL,
	explanation          VARCHAR(1000) NULL
);

ALTER TABLE report
ADD CONSTRAINT XPKreport PRIMARY KEY (document_id,user_id);

CREATE TABLE sentence
(
	id                   INTEGER NOT NULL,
	text                 VARCHAR(500) NULL,
	document_id          INTEGER NOT NULL
);

ALTER TABLE sentence
ADD CONSTRAINT XPKsentence PRIMARY KEY (id);

CREATE TABLE translation
(
	id                   INTEGER NOT NULL,
	date                 DATE NULL,
	translation_text     VARCHAR(500) NULL,
	user_id              INTEGER NULL,
	language_id          INTEGER NOT NULL,
	average_rating       FLOAT NULL,
	sentence_id          INTEGER NOT NULL
);

ALTER TABLE translation
ADD CONSTRAINT XPKtranslation PRIMARY KEY (id);

CREATE TABLE user
(
	id                   INTEGER NOT NULL,
	username             VARCHAR(25) NULL,
	password_hash        VARCHAR(256) NULL,
	first_name           VARCHAR(25) NULL,
	last_name            VARCHAR(35) NULL,
	email                VARCHAR(50) NULL,
	date_of_birth        DATE NULL,
	date_joined          DATE NULL,
	access_level         INTEGER NULL,
	rating               FLOAT NULL
);

ALTER TABLE user
ADD CONSTRAINT XPKuser PRIMARY KEY (id);

CREATE TABLE wanted_translations
(
	document_id          INTEGER NOT NULL,
	language_id          INTEGER NOT NULL
);

ALTER TABLE wanted_translations
ADD CONSTRAINT XPKwanted_translations PRIMARY KEY (document_id,language_id);

ALTER TABLE document
ADD CONSTRAINT user_document FOREIGN KEY (posting_user_id) REFERENCES user (id)
		ON DELETE CASCADE;

ALTER TABLE document
ADD CONSTRAINT language_document FOREIGN KEY (language_id) REFERENCES language (id)
		ON DELETE CASCADE;

ALTER TABLE knows_language
ADD CONSTRAINT user_knows_language FOREIGN KEY (user_id) REFERENCES user (id)
		ON DELETE CASCADE;

ALTER TABLE knows_language
ADD CONSTRAINT language_knows_language FOREIGN KEY (language_id) REFERENCES language (id)
		ON DELETE CASCADE;

ALTER TABLE rating
ADD CONSTRAINT user_rating FOREIGN KEY (user_id) REFERENCES user (id)
		ON DELETE CASCADE;

ALTER TABLE rating
ADD CONSTRAINT translation_rating FOREIGN KEY (translation_id) REFERENCES translation (id)
		ON DELETE CASCADE;

ALTER TABLE report
ADD CONSTRAINT document_report FOREIGN KEY (document_id) REFERENCES document (id)
		ON DELETE CASCADE;

ALTER TABLE report
ADD CONSTRAINT user_report FOREIGN KEY (user_id) REFERENCES user (id)
		ON DELETE CASCADE;

ALTER TABLE sentence
ADD CONSTRAINT document_sentence FOREIGN KEY (document_id) REFERENCES document (id)
		ON DELETE CASCADE;

ALTER TABLE translation
ADD CONSTRAINT user_translation FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE translation
ADD CONSTRAINT language_translation FOREIGN KEY (language_id) REFERENCES language (id)
		ON DELETE CASCADE;

ALTER TABLE translation
ADD CONSTRAINT R_17 FOREIGN KEY (sentence_id) REFERENCES sentence (id)
		ON DELETE CASCADE;

ALTER TABLE wanted_translations
ADD CONSTRAINT document_wanted_translations FOREIGN KEY (document_id) REFERENCES document (id)
		ON DELETE CASCADE;

ALTER TABLE wanted_translations
ADD CONSTRAINT language_wanted_translations FOREIGN KEY (language_id) REFERENCES language (id)
		ON DELETE CASCADE;
