
CREATE DATABASE Forum CHARACTER SET utf8 COLLATE utf8_general_ci;
USE Forum;

CREATE TABLE users(
	Id INT UNSIGNED UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	Username VARCHAR(50) NOT NULL UNIQUE,
	Password CHAR(100) NOT NULL,
	Email VARCHAR(70),
	FullName VARCHAR(100),
    IsAdmin BOOL
);

CREATE TABLE tags(
	Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	Title VARCHAR(100) NOT NULL    
);

CREATE TABLE categories(
	Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	Title VARCHAR(100) NOT NULL
);

CREATE TABLE questions(
	Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	Title VARCHAR(100) NOT NULL,
    Content VARCHAR(500) NOT NULL,
    Date DATETIME NOT NULL,
    Counter LONG NOT NULL,
    Category INT UNSIGNED NOT NULL,
    User INT UNSIGNED NOT NULL,
    
    FOREIGN KEY(Category) REFERENCES categories(Id),
    FOREIGN KEY(User) REFERENCES users(Id)
);

CREATE TABLE questions_tags(
	questionId INT UNSIGNED NOT NULL,
	tagId INT UNSIGNED NOT NULL,
    
    PRIMARY KEY(questionId,tagId),
	FOREIGN KEY(questionId) REFERENCES questions(Id),
    FOREIGN KEY(tagId) REFERENCES tags(Id)
);

CREATE TABLE answers(
	Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Content VARCHAR(500) NOT NULL,
    Date DATETIME NOT NULL,
    Question INT UNSIGNED NOT NULL,
    AuthorName VARCHAR(100) NOT NULL,    
    AuthorEmail VARCHAR(100) NOT NULL,
    
    FOREIGN KEY(Question) REFERENCES questions(Id)
);

INSERT INTO users (Username, Password, Email, FullName, IsAdmin) 
VALUES ("Administrator", "123", "administrator@gmail.bg", "Admin Admin", true);

INSERT INTO tags (Title) 
VALUES ("C#"),
("Java"),
("JavaScript"),
("PHP"),
("OOP"),
("Unity3D"),
("Linux"),
("SEO"),
("MySQL");

INSERT INTO categories (Title) 
VALUES ("C#"),
("Java"),
("JavaScript"),
("PHP"),
("OOP"),
("Unity3D"),
("Linux"),
("SEO"),
("MySQL");

INSERT INTO questions (Title, Content, Date, Counter, Category, User) 
VALUES ("C# ", "Защо получавам това..", NOW(), 0, 3, 1),
("Unity 3D", "Как да направя това...", NOW(), 0, 2, 1);

INSERT INTO questions_tags (questionId, tagId) 
VALUES (1,2);

INSERT INTO answers(Content, Date, Question, AuthorName, AuthorEmail) 
VALUES ("Потърси в Google преди да питаш...", NOW(), 1, "Maria",""),
("Инсталирай си новата версия ....", NOW(), 1, "Penka", "penka@gmail.com");