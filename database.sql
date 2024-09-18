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
    Email VARCHAR(100) UNIQUE NOT NULL,
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
    PetName VARCHAR(50) NOT NULL,
    image_url VARCHAR(255),
    Age INT,
    PetSpecies VARCHAR(50),
    Breed VARCHAR(50),
    Gender ENUM('Male', 'Female'),
    PetDesc VARCHAR(255),
    Status ENUM('Available', 'Pending', 'Adopted', 'Deceased') NOT NULL
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

INSERT INTO Pets (PetName, image_url, Age, PetSpecies, Breed, Gender, Status, PetDesc)
VALUES 
('Henry', 'floofa(dog).jpg', 3, 'Dog', 'Border Collie', 'Male', 'Available', 'Henry was taken in after his previous owners gave him up'),
('Bella', 'Phoenix(dog).jpg', 3, 'Dog', 'Corgi', 'Female', 'Available',  'Bella is a hyper active dog that loves the outdoors'),
('Max', 'burger(cat).jpg', 2, 'Cat', 'Siamese', 'Male', 'Available', 'Max is a quiet and calm Siamese, ideal for indoor...'),
('Coco', 'Coco(cat).jpg', 3, 'Cat', 'Domestic Shorthair', 'Female', 'Adopted',  'Coco likes to cuddle with the people she trust '),
('Mimi', 'Mimi(cat).jpg', 2, 'Cat', 'Maine Coon', 'Female', 'Available',  'Mimi is a calm cat, that likes to look out the windows whenever it is raining'),
('Dan', 'muffin(dog).jpg', 4, 'Dog', 'Golden Retriever', 'Male', 'Available',  'Dan is a loyal golden retriever that likes to play with other dogs');
