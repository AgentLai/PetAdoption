CREATE TABLE Member (
    MemberID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    DOB DATE,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    CHECK (Email REGEXP '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$'),
    CHECK (Password REGEXP '^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$')
);

CREATE TABLE Admin (
    AdminID INT AUTO_INCREMENT PRIMARY KEY,
    MemberID INT NOT NULL,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    CHECK (Email REGEXP '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$'),
    CHECK (Password REGEXP '^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$'),
    FOREIGN KEY (MemberID) REFERENCES Member(MemberID)
);

CREATE TABLE Settings (
    SettingID INT AUTO_INCREMENT PRIMARY KEY,
    MemberID INT,
    NameOfSetting VARCHAR(100) NOT NULL,
    OptionPicked VARCHAR(100) NOT NULL,
    FOREIGN KEY (MemberID) REFERENCES Member(MemberID)
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
    MemberID INT,
    PetID INT,
    Date DATE,
    Time TIME,
    Amount DECIMAL(10, 2),
    FOREIGN KEY (MemberID) REFERENCES Member(MemberID),
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
    MemberID INT,
    PetID INT,
    ApplicationDate DATE,
    Status ENUM('Accepted', 'Denied', 'Ongoing', 'Submitted', 'Cancelled') NOT NULL,
    Comments TEXT,
    FOREIGN KEY (MemberID) REFERENCES Member(MemberID),
    FOREIGN KEY (PetID) REFERENCES Pets(PetID)
);

CREATE TABLE Reviews (
    ReviewID INT AUTO_INCREMENT PRIMARY KEY,
    MemberID INT,
    PetID INT,
    Rating INT CHECK (Rating BETWEEN 1 AND 5),
    Comments TEXT,
    ReviewDate DATE,
    FOREIGN KEY (MemberID) REFERENCES Member(MemberID),
    FOREIGN KEY (PetID) REFERENCES Pets(PetID)
);

INSERT INTO Member(Username, FistName, LastName, DOB, Email, Password) VALUES ('AgentLai', 'Douglas', 'Lai', '12-Feb-2000', 'douglaslys-sm23@student.tarc.edu.my', 'TarUMT2000');
INSERT INTO Admin(MemberID, Username, Password) VALUES (1,'PetAdmin', '@dmin2024_PetHaven');