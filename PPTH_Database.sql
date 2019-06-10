CREATE TABLE DEPARTMENT (
	Department_name VARCHAR (50),
    Beds INT,
    Specialty TEXT,
    Location TEXT,
    PRIMARY KEY (Department_name)
);

CREATE TABLE TEAMS (
	Team_name VARCHAR (50),
    Department VARCHAR (50),
    Shift TEXT,
    PRIMARY KEY (Team_name),
    FOREIGN KEY (Department) REFERENCES DEPARTMENT (Department_name)
);

CREATE TABLE PROVIDER (
	Employee_ID VARCHAR (50),
	lName TEXT,
    fName TEXT,
    DOB TEXT,
    Shift TEXT,
    Licence TEXT,
    PositionType TEXT,
    Team VARCHAR (50),
    Password TEXT,
	PRIMARY KEY (Employee_ID),
    FOREIGN KEY (Team) REFERENCES TEAMS (Team_name)
);

CREATE TABLE PATIENT (
	SSN VARCHAR (50),
    Employee_ID VARCHAR (50),
    Address TEXT,
    pfName TEXT,
    plName TEXT,
    Reason_for_visit VARCHAR (500),
    pDOB TEXT,
    Location TEXT,
    MRN INT,
    Phone VARCHAR (10),
    Email TEXT,
	PRIMARY KEY (SSN),
    FOREIGN KEY (Employee_ID) REFERENCES PROVIDER (Employee_ID)
);