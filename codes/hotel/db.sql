CREATE DATABASE HotelBooking;

USE HotelBooking;

CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Email VARCHAR(100) UNIQUE,
    Password VARCHAR(255) NOT NULL,
    Phone VARCHAR(50),
    Role varchar(10) NOT NULL DEFAULT 'tamu'
);

CREATE TABLE Hotels (
    HotelID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Location VARCHAR(255),    
    Description TEXT
);

CREATE TABLE Rooms (
    RoomID INT AUTO_INCREMENT PRIMARY KEY,
    HotelID INT,
    Type VARCHAR(50) ,
    Price DECIMAL(10,2),
    Rating DECIMAL(3,2),
    Availability BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (HotelID) REFERENCES Hotels(HotelID)
);

CREATE TABLE Bookings (
    BookingID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    RoomID INT,
    CheckInDate DATE,
    CheckOutDate DATE,
    TotalPrice DECIMAL(10,2),
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (RoomID) REFERENCES Rooms(RoomID)
);

CREATE TABLE Reviews (
    ReviewID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    BookingID INT,
    Rating INT,
    Comment TEXT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (BookingID) REFERENCES Bookings(BookingID)
);

CREATE TABLE Payments (
    PaymentID INT AUTO_INCREMENT PRIMARY KEY,
    BookingID INT,
    Amount DECIMAL(10,2),
    PaymentMethod VARCHAR(50),
    Status VARCHAR(50) DEFAULT 'pending',
    FOREIGN KEY (BookingID) REFERENCES Bookings(BookingID)
);
