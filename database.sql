
CREATE TABLE Member (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Age INT,
    DOB DATE,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL
);

CREATE TABLE Admin (
    AdminID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL
);

CREATE TABLE Settings (
    SettingID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    NameOfSetting VARCHAR(100) NOT NULL,
    OptionPicked VARCHAR(100) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Member(UserID)
);

CREATE TABLE Pets (
    PetID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(50) NOT NULL,
    Pictures TEXT,  
    Age INT,
    PetSpecies VARCHAR(50),
    Breed VARCHAR(50),
    Gender ENUM('Male', 'Female'),
    Price DECIMAL(10, 2),
    Status ENUM('Available', 'Pending', 'Adopted', 'Deceased') NOT NULL,
    Size VARCHAR(50),
    Colour VARCHAR(50)
);

CREATE TABLE Transaction (
    TransactionID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    PetID INT,
    Date DATE,
    Time TIME,
    Amount DECIMAL(10, 2),
    FOREIGN KEY (UserID) REFERENCES Member(UserID),
    FOREIGN KEY (PetID) REFERENCES Pets(PetID)
);

CREATE TABLE ChatHistory (
    ChatID INT AUTO_INCREMENT PRIMARY KEY,
    SenderUserID INT,
    ReceiverUserID INT,
    Message TEXT NOT NULL,
    Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (SenderUserID) REFERENCES Member(UserID),
    FOREIGN KEY (ReceiverUserID) REFERENCES Member(UserID)
);

CREATE TABLE AdoptionApplication (
    ApplicationID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    PetID INT,
    ApplicationDate DATE,
    Status ENUM('Accepted', 'Denied', 'Ongoing', 'Submitted', 'Cancelled') NOT NULL,
    Comments TEXT,
    FOREIGN KEY (UserID) REFERENCES Member(UserID),
    FOREIGN KEY (PetID) REFERENCES Pets(PetID)
);

CREATE TABLE Reviews (
    ReviewID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    PetID INT,
    Rating INT CHECK (Rating BETWEEN 1 AND 5),
    Comments TEXT,
    ReviewDate DATE,
    FOREIGN KEY (UserID) REFERENCES Member(UserID),
    FOREIGN KEY (PetID) REFERENCES Pets(PetID)
);
