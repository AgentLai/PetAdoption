CREATE TABLE Member (
    MemberID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    DOB DATE,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    image_url VARCHAR(255)
);

CREATE TABLE Admin (
    AdminID INT AUTO_INCREMENT PRIMARY KEY,
    MemberID INT NOT NULL,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    FOREIGN KEY (MemberID) REFERENCES Member(MemberID)
    Email VARCHAR(100) UNIQUE NOT NULL,
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
    image_url VARCHAR(255),
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

CREATE TABLE adoption_applications (
    ApplicationID INT AUTO_INCREMENT PRIMARY KEY,
    MemberID INT NOT NULL,
    PetID INT NOT NULL,
    PetName VARCHAR(100) NOT NULL,
    FullName VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    PhoneNumber VARCHAR(20),
    Address TEXT NOT NULL,
    Occupation VARCHAR(100),
    HouseholdSize INT,
    PetExperience VARCHAR(255),
    ReasonForAdopting TEXT,
    Status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    ApplicationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (MemberID) REFERENCES member(MemberID),
    FOREIGN KEY (PetID) REFERENCES pets(PetID)
);

INSERT INTO Member (Username, FirstName, LastName, DOB, Email, Password, image_url) 
VALUES ('AgentLai', 'Douglas', 'Lai', '2000-02-12', 'douglaslys-sm23@student.tarc.edu.my', 'TarUMT2000', 'Images/Admin_img.jpeg');

INSERT INTO Admin (MemberID, Username, Email, Password) 
VALUES (1, 'PetAdmin', 'PetHaven@gmail.com' ,'@dmin2024_PetHaven');

INSERT INTO Pets (name, PetSpecies, Breed, Age, Gender, Status, image_url) VALUES
('Bella', 'Dog', 'Labrador', 3, 'Female', 'Available', 'Images/Snow(dog).jpg'),
('Max', 'Cat', 'Siamese', 2, 'Male', 'Available', 'Images/Mars(cat).jpg'),
('Charlie', 'Dog', 'Beagle', 4, 'Male', 'Adopted', 'Images/floofa(dog).jpg');
