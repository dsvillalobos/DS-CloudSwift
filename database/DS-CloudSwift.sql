CREATE DATABASE dscloudswift;
USE dscloudswift;

CREATE TABLE users (
	UserID INT NOT NULL AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    LastName VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    PRIMARY KEY (UserID)
);

CREATE TABLE files (
	FileID INT NOT NULL AUTO_INCREMENT,
    FileName VARCHAR(255) NOT NULL,
    File LONGBLOB NOT NULL,
    FileType VARCHAR(50) NOT NULL,
    Date DATE DEFAULT CURRENT_TIMESTAMP,
    Time TIME DEFAULT CURRENT_TIMESTAMP,
    UserID INT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES users(UserID),
    PRIMARY KEY (FileID)
);

CREATE TABLE links (
	LinkID INT NOT NULL AUTO_INCREMENT,
    LinkTitle VARCHAR(255) NOT NULL,
    LinkAddress TEXT NOT NULL,
    Date DATE DEFAULT CURRENT_TIMESTAMP,
    Time TIME DEFAULT CURRENT_TIMESTAMP,
    UserID INT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES users(UserID),
    PRIMARY KEY (LinkID)
);

CREATE TABLE notes (
	NoteID INT NOT NULL AUTO_INCREMENT,
    NoteTitle VARCHAR(255) NOT NULL,
    NoteBody TEXT NOT NULL,
    Date DATE DEFAULT CURRENT_TIMESTAMP,
    Time TIME DEFAULT CURRENT_TIMESTAMP,
    UserID INT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES users(UserID),
    PRIMARY KEY (NoteID)
);

CREATE VIEW files_view AS
SELECT
	files.FileID,
    files.FileName,
    files.File,
    files.FileType,
    files.Date,
    files.Time,
    files.UserID,
    users.Name AS Name,
    users.LastName AS LastName,
    users.email AS Email
FROM files
INNER JOIN users ON files.UserID = users.UserID;

CREATE VIEW links_view AS
SELECT
	links.LinkID,
    links.LinkTitle,
    links.LinkAddress,
    links.Date,
    links.Time,
    links.UserID,
    users.Name AS Name,
    users.LastName AS LastName,
    users.Email AS Email
FROM links
INNER JOIN users ON links.UserID = users.UserID;

CREATE VIEW notes_view AS
SELECT
	notes.NoteID,
    notes.NoteTitle,
    notes.NoteBody,
    notes.Date,
    notes.Time,
    notes.UserID,
    users.Name AS Name,
    users.LastName AS LastName,
    users.Email AS Email
FROM notes
INNER JOIN users ON notes.UserID = users.UserID;
