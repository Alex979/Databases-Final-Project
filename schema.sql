-- Create user table
CREATE TABLE user (
    uid INT,
    username varchar(100),
    password VARCHAR(32),
    fname VARCHAR(32),
    lname VARCHAR(32),
    street VARCHAR(128),
    city VARCHAR(64),
    state VARCHAR(32),
    zip INT,
    balance float(20,2),
    reviewForm int,
    approveThesis int,
    clearedToGrad int,
    PRIMARY KEY (uid)
);

-- Create role table
CREATE TABLE role (
    uid INT,
    type VARCHAR(16),
    FOREIGN KEY (uid) REFERENCES user(uid)
);

-- Create course table
CREATE TABLE course (
    cid INT AUTO_INCREMENT,
    dept VARCHAR(4),
    courseNumber int,
    title VARCHAR(64),
    credits INT,
    instructor_id INT,
    prereq1_id INT,
    prereq2_id INT,
    PRIMARY KEY (cid),
    -- Uncomment when 'user' table is created
    FOREIGN KEY (instructor_id) REFERENCES user(uid),
    FOREIGN KEY (prereq1_id) REFERENCES course(cid),
    FOREIGN KEY (prereq2_id) REFERENCES course(cid),
    CONSTRAINT unique_course UNIQUE(dept, courseNumber)
);

-- Create schedule table
CREATE TABLE schedule (
    sid INT AUTO_INCREMENT,
    cid INT,
    section INT,
    term VARCHAR(4),
    day VARCHAR(1),
    start TIME,
    end TIME,
    is_current INT, -- tells us whether this is the latest semester or not
    PRIMARY KEY (sid),
    FOREIGN KEY (cid) REFERENCES course(cid)
);

-- Create enrolls table
CREATE TABLE enrolls (
    uid INT,
    sid INT,
    grade VARCHAR(2),
    -- Uncomment when 'user' table is created
    FOREIGN KEY (uid) REFERENCES user(uid),
    FOREIGN KEY (sid) REFERENCES schedule(sid)
);

create table formOne(
    num int auto_increment,
    uid int,
    courseNumber int,
    dept varchar(100),
    primary key(num),
    foreign key(uid) references user(uid)
);
  
create table formOneValid(
    num int auto_increment,
    uid int,
    courseNumber int,
    dept varchar(100),
    primary key(num)
);

CREATE TABLE applicant(
    uid int(8) not null AUTO_INCREMENT,
    ssn varchar(11),
    uname varchar(20) not null,
    fname varchar(20) not null,
    lname varchar(20) not null,
    street varchar(50),
    city varchar(20),
    state varchar(10), 
    email varchar(50),
    phone varchar(20),
    zip varchar(10),
    complete boolean not null,
    primary key(uid)
);

CREATE TABLE application_info(
    uid int(8) not null,
    degree_sought varchar(20) not null,
    major varchar(20) not null,
    start_year varchar(4) not null,
    start_semester varchar(6) not null,
    b_degree varchar(20) not null,
    b_university varchar(50) not null,
    b_gpa float(3,2) not null, #this is like 3.4digitsafterdot(6-2=4
    b_date varchar(10) not null,
    m_degree varchar(20),
    m_university varchar(50),
    m_gpa float(3,2),
    m_date varchar(6),
    gre_date varchar(10),
    toeffel_date varchar(10),
    area_of_interest varchar(20),
    work_experience varchar(100),
    complete boolean not null,
    primary key(uid)
);

CREATE TABLE transcript(
    uid int(8) not null,
    submitted boolean,
    primary key(uid)
);

CREATE TABLE subject_score(
    uid int(8) not null,
    subject varchar(20) not null,
    score int(3) not null,
    primary key(uid,subject)
);

CREATE TABLE application_status(
    uid int(8) not null,
    ready_for_evaluation varchar(3) not null,
    admission_status varchar(20) not null,
    decision varchar(20),
    date_completed date,
    avg_rank float(3,2),
    num_evaluations int,
    primary key(uid)
);

CREATE TABLE rec_letters(
    recid int not null AUTO_INCREMENT,
    uid varchar(20) not null,
    rec_fname varchar(20),
    rec_lname varchar(20) not null,
    rec_email varchar(50) not null,
    rec_title varchar(20) not null,
    rec_affiliation varchar(20) not null,
    reccomendation varchar(500) not null,
    rating int,
    generic varchar(3),
    credible varchar(3),
    complete boolean not null,
    primary key(recid,uid)
);

CREATE TABLE faculty(
    fid int(8) not null AUTO_INCREMENT,
    uname varchar(20) not null,
    fname varchar(20) not null,
    lname varchar(20) not null,
    department varchar(20) not null,
    primary key(fid)
);
ALTER TABLE faculty AUTO_INCREMENT=50000000;

CREATE TABLE faculty_evaluation(
    uid int(8) not null,
    fid  int(8) not null,
    comments varchar(50),
    ranking int(1) not null,
    rec_advisor varchar(20) not null,
    reason varchar(50) not null,
    primary key(uid,fid),
    foreign key(fid) references faculty(fid)
);
