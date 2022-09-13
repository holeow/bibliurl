CREATE TABLE Folder(
   ID INT AUTO_INCREMENT,
   Name VARCHAR(255) NOT NULL,
   ImgUrl VARCHAR(1023),
   Container INT,
   WebUser bigint(20) unsigned NOT NULL,
   PRIMARY KEY(ID),
   FOREIGN KEY(Container) REFERENCES Folder(ID) ON DELETE CASCADE,
   FOREIGN KEY(WebUser) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE Bookmark(
   ID INT AUTO_INCREMENT,
   Name VARCHAR(255) NOT NULL,
   Comment VARCHAR(255),
   URL VARCHAR(1023) NOT NULL,
   CreationDate DATETIME,
   ImgUrl VARCHAR(1023),
   Folder INT NOT NULL,
   PRIMARY KEY(ID),
   FOREIGN KEY(Folder) REFERENCES Folder(ID) ON DELETE CASCADE
);

CREATE TABLE Bookmark_Tag(
   Bookmark INT,
   Tag VARCHAR(50),
   PRIMARY KEY(Bookmark, Tag),
   FOREIGN KEY(Bookmark) REFERENCES Bookmark(ID) ON DELETE CASCADE
);


CREATE TABLE Folder_Tag(
   Folder INT,
   Tag VARCHAR(50),
   PRIMARY KEY(Folder, Tag),
   FOREIGN KEY(Folder) REFERENCES Folder(ID) ON DELETE CASCADE
);
