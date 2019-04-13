<? php
include('connect.php');

$query = "SET foreign_key_checks = 0;
DROP TABLE applicant;
DROP TABLE user;
DROP TABLE application_info;
DROP TABLE subject_score;
DROP TABLE application_status;
DROP TABLE rec_letters;
DROP TABLE faculty_evaluation;
DROP TABLE faculty;
DROP TABLE transcript;
SET foreign_key_checks = 1;

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
ALTER TABLE applicant AUTO_INCREMENT=11111111;

-- INSERT INTO applicant (ssn,uname,fname,lname,address,email,phone) VALUES ('0123','bob','rob','robertson','somewherestreet','email1@gmail.com','phone');
-- INSERT INTO applicant (ssn,uname,fname,lname,address,email,phone) VALUES ('0123','amanda','amanda','smith','somewherestreet','email2@gmail.com','phone');
-- INSERT INTO applicant (ssn,uname,fname,lname,address,email,phone) VALUES ('0123','donald','don','duck','somewherestreet','email3@gmail.com','phone');

CREATE TABLE user(
uname varchar(20) not null,
pword varchar(20) not null,
role varchar (20) not null,
primary key(uname)
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

#INSERT INTO user VALUES('jake','pword','applicant');

##FACULTY INSERTS

INSERT INTO user VALUES('narahari','pword','faculty');
INSERT INTO faculty (uname,fname,lname,department) VALUES ('narahari','Bhagirath','Narahari','CSCI');

INSERT INTO user VALUES('tim','pword','faculty');
INSERT INTO faculty (uname,fname,lname,department) VALUES ('tim','Timothy','Wood','CSCI');

INSERT INTO user VALUES('sheller','pword','faculty');
INSERT INTO faculty (uname,fname,lname,department) VALUES ('sheller','Rachelle','Heller','CSCI');

INSERT INTO user VALUES('dave','pword','system-admin');
INSERT INTO faculty (uname,fname,lname,department) VALUES ('dave','David','Donald','CHEM');

INSERT INTO user VALUES('carl','pword','cac');
INSERT INTO faculty (uname,fname,lname,department) VALUES ('carl','Carl','Constantine','HONR');

INSERT INTO user VALUES('dick','pword','gs');
INSERT INTO faculty (uname,fname,lname,department) VALUES ('dick','Richard','Rollins','PMGT');




##APPLICANT INSERTS

#john lennon will have uid 11111111, not 55555555. Our database uses autoincremented uids
INSERT INTO user VALUES('jlenn','pword','applicant');
INSERT INTO applicant (ssn,uname,fname,lname,street,city,state,email,phone,zip,complete) VALUES('111-11-1111','jlenn','John','Lennon','Imagination lane','NYC','New York','johnny@gmail.com','9997776666','54321',true);
INSERT INTO application_info (uid,degree_sought,major,start_year,start_semester,b_degree,b_university,b_gpa,b_date,gre_date,toeffel_date,area_of_interest,work_experience,complete)  VALUES (11111111,'MS','CSCI','2019','Fall','Music','Juliard',3.0,'1999/05/12','2005','2006','Music Production','Set the standard for all music while a member of The Beatles',true);
INSERT INTO subject_score VALUES (11111111,'GRE Total',335);
INSERT INTO subject_score VALUES (11111111,'GRE Verbal',165);
INSERT INTO subject_score VALUES (11111111,'GRE Quantitative',170);
INSERT INTO subject_score VALUES (11111111,'Toeffel',90);
INSERT INTO application_status (uid,ready_for_evaluation,admission_status,date_completed,num_evaluations) VALUES (11111111,'yes','complete','2019/02/26',0);
INSERT INTO transcript VALUES (11111111,true);




#ringo will have uid 11111112, not 66666666. Our database uses autoincremented uids
INSERT INTO user VALUES('ringostarr','pword','applicant');
INSERT INTO applicant (ssn,uname,fname,lname,street,city,state,email,phone,zip,complete) VALUES('222-11-1111','ringostarr','Richard','Starkey','beatstreet','Beverly Hills','CA','rstarr@gmail.com','8882221234','12345',true);
INSERT INTO application_status (uid,ready_for_evaluation,admission_status,num_evaluations) VALUES (11111112,'no','incomplete',0);
INSERT INTO transcript VALUES (11111112,false);



INSERT INTO user VALUES('jake','pword','applicant');
INSERT INTO applicant (ssn,uname,fname,lname,street,city,state,email,phone,zip,complete) VALUES('123-45-6789','jake','Jacob','Cannizzaro','600 20th St NW','Washington','DC','jdabi13@gmail.com','8023804981','20052',true);
INSERT INTO application_info (uid,degree_sought,major,start_year,start_semester,b_degree,b_university,b_gpa,b_date,gre_date,area_of_interest,work_experience,complete)  VALUES (11111113,'MS','CSCI','2019','Fall','CSCI','RIT',3.5,'2017/05/19','2017','Cyber Security','Top of the Hill Grill',true);
INSERT INTO subject_score VALUES (11111113,'GRE Total',339);
INSERT INTO subject_score VALUES (11111113,'GRE Verbal',169);
INSERT INTO subject_score VALUES (11111113,'GRE Quantitative',170);
INSERT INTO application_status VALUES (11111113,'yes','complete','admit','2019/02/26',4,3);
INSERT INTO faculty_evaluation VALUES (11111113,50000000,'Brilliant',4,'narahari','admitted');
INSERT INTO faculty_evaluation VALUES (11111113,50000001,'Enthusiastic',4,'narahari','admitted');
INSERT INTO faculty_evaluation VALUES (11111113,50000004,'We need him at this school!',4,'narahari','admitted');
INSERT INTO rec_letters (uid,rec_fname,rec_lname,rec_email,rec_title,rec_affiliation,reccomendation,rating,generic,credible,complete) VALUES (11111113,'Kevin','ODonnel','kev@odonnel.com','Professor','Calculus Teacher','This kid loves math for some reason but he's a hard worker.',5,'Yes','Yes',true);
INSERT INTO transcript VALUES (11111113,true)";

$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);

//header('location:login.php');exit;

?>
