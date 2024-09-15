CREATE TABLE Member (
    MemberID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    DOB DATE,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL
);

CREATE TABLE Admin (
    AdminID INT AUTO_INCREMENT PRIMARY KEY,
    MemberID INT NOT NULL,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL,
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

CREATE TABLE AdoptionHistory (
    ApplicationID INT AUTO_INCREMENT PRIMARY KEY,
    MemberID INT,
    PetID INT,
    ApplicationDate DATE,
    Status ENUM('Accepted', 'Denied', 'Cancelled') NOT NULL,
    FOREIGN KEY (MemberID) REFERENCES Member(MemberID),
    FOREIGN KEY (PetID) REFERENCES Pets(PetID)
);

INSERT INTO Member (Username, FirstName, LastName, DOB, Email, Password) 
VALUES ('AgentLai', 'Douglas', 'Lai', '2000-02-12', 'douglaslys-sm23@student.tarc.edu.my', 'TarUMT2000');

INSERT INTO Admin (MemberID, Username, Password) 
VALUES (1, 'PetAdmin', '@dmin2024_PetHaven');

INSERT INTO Pets (name, PetSpecies, Breed, Age, Gender, Status, image_url) VALUES
('Bella', 'Dog', 'Labrador', 3, 'Female', 'Available', 'Images/Snow(dog).jpg'),
('Max', 'Cat', 'Siamese', 2, 'Male', 'Available', 'Images/Mars(cat).jpg'),
('Charlie', 'Dog', 'Beagle', 4, 'Male', 'Adopted', 'Images/floofa(dog).jpg');
