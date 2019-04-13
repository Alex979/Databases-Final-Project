<? php
include('connect.php');

$query = "SET foreign_key_checks = 0";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "DROP TABLE applicant";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "DROP TABLE user";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "DROP TABLE application_info";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "DROP TABLE subject_score";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "DROP TABLE application_status";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "DROP TABLE rec_letters";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "DROP TABLE faculty_evaluation";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "DROP TABLE faculty";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "DROP TABLE transcript";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "SET foreign_key_checks = 1";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);

$query = "CREATE TABLE applicant(
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
)";
$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "ALTER TABLE applicant AUTO_INCREMENT=11111111";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);



$query = "CREATE TABLE user(
uname varchar(20) not null,
pword varchar(20) not null,
role varchar (20) not null,
primary key(uname)
)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);

$query = "CREATE TABLE application_info(
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
)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);

$query = "CREATE TABLE transcript(
uid int(8) not null,
submitted boolean,
primary key(uid)
)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);

$query = "CREATE TABLE subject_score(
uid int(8) not null,
subject varchar(20) not null,
score int(3) not null,
primary key(uid,subject)
)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);

$query = "CREATE TABLE application_status(
uid int(8) not null,
ready_for_evaluation varchar(3) not null,
admission_status varchar(20) not null,
decision varchar(20),
date_completed date,
avg_rank float(3,2),
num_evaluations int,
primary key(uid)
)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);


$query = "CREATE TABLE rec_letters(
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
)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);


$query = "CREATE TABLE faculty(
fid int(8) not null AUTO_INCREMENT,
uname varchar(20) not null,
fname varchar(20) not null,
lname varchar(20) not null,
department varchar(20) not null,
primary key(fid)
)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "ALTER TABLE faculty AUTO_INCREMENT=50000000";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);

$query = "CREATE TABLE faculty_evaluation(
uid int(8) not null,
fid  int(8) not null,
comments varchar(50),
ranking int(1) not null,
rec_advisor varchar(20) not null,
reason varchar(50) not null,
primary key(uid,fid),
foreign key(fid) references faculty(fid)
)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);



$query = "INSERT INTO user VALUES('narahari','pword','faculty')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO faculty (uname,fname,lname,department) VALUES ('narahari','Bhagirath','Narahari','CSCI')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);

$query = "INSERT INTO user VALUES('tim','pword','faculty')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO faculty (uname,fname,lname,department) VALUES ('tim','Timothy','Wood','CSCI')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);

$query = "INSERT INTO user VALUES('sheller','pword','faculty')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO faculty (uname,fname,lname,department) VALUES ('sheller','Rachelle','Heller','CSCI')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);

$query = "INSERT INTO user VALUES('dave','pword','system-admin')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO faculty (uname,fname,lname,department) VALUES ('dave','David','Donald','CHEM')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);

$query = "INSERT INTO user VALUES('carl','pword','cac')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO faculty (uname,fname,lname,department) VALUES ('carl','Carl','Constantine','HONR')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);

$query = "INSERT INTO user VALUES('dick','pword','gs')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO faculty (uname,fname,lname,department) VALUES ('dick','Richard','Rollins','PMGT')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);





$query = "INSERT INTO user VALUES('jlenn','pword','applicant')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO applicant (ssn,uname,fname,lname,street,city,state,email,phone,zip,complete) VALUES('111-11-1111','jlenn','John','Lennon','Imagination lane','NYC','New York','johnny@gmail.com','9997776666','54321',true)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO application_info (uid,degree_sought,major,start_year,start_semester,b_degree,b_university,b_gpa,b_date,gre_date,toeffel_date,area_of_interest,work_experience,complete)  VALUES (11111111,'MS','CSCI','2019','Fall','Music','Juliard',3.0,'1999/05/12','2005','2006','Music Production','Set the standard for all music while a member of The Beatles',true)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO subject_score VALUES (11111111,'GRE Total',335)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO subject_score VALUES (11111111,'GRE Verbal',165)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO subject_score VALUES (11111111,'GRE Quantitative',170)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO subject_score VALUES (11111111,'Toeffel',90)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO application_status (uid,ready_for_evaluation,admission_status,date_completed,num_evaluations) VALUES (11111111,'yes','complete','2019/02/26',0)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO transcript VALUES (11111111,true)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);




#ringo will have uid 11111112, not 66666666. Our database uses autoincremented uids
$query = "INSERT INTO user VALUES('ringostarr','pword','applicant')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO applicant (ssn,uname,fname,lname,street,city,state,email,phone,zip,complete) VALUES('222-11-1111','ringostarr','Richard','Starkey','beatstreet','Beverly Hills','CA','rstarr@gmail.com','8882221234','12345',true)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO application_status (uid,ready_for_evaluation,admission_status,num_evaluations) VALUES (11111112,'no','incomplete',0)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO transcript VALUES (11111112,false)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);



$query = "INSERT INTO user VALUES('jake','pword','applicant')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO applicant (ssn,uname,fname,lname,street,city,state,email,phone,zip,complete) VALUES('123-45-6789','jake','Jacob','Cannizzaro','600 20th St NW','Washington','DC','jdabi13@gmail.com','8023804981','20052',true)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO application_info (uid,degree_sought,major,start_year,start_semester,b_degree,b_university,b_gpa,b_date,gre_date,area_of_interest,work_experience,complete)  VALUES (11111113,'MS','CSCI','2019','Fall','CSCI','RIT',3.5,'2017/05/19','2017','Cyber Security','Top of the Hill Grill',true)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO subject_score VALUES (11111113,'GRE Total',339)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO subject_score VALUES (11111113,'GRE Verbal',169)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO subject_score VALUES (11111113,'GRE Quantitative',170)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO application_status VALUES (11111113,'yes','complete','admit','2019/02/26',4,3)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO faculty_evaluation VALUES (11111113,50000000,'Brilliant',4,'narahari','admitted')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO faculty_evaluation VALUES (11111113,50000001,'Enthusiastic',4,'narahari','admitted')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO faculty_evaluation VALUES (11111113,50000004,'We need him at this school!',4,'narahari','admitted')";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO rec_letters (uid,rec_fname,rec_lname,rec_email,rec_title,rec_affiliation,reccomendation,rating,generic,credible,complete) VALUES (11111113,'Kevin','ODonnel','kev@odonnel.com','Professor','Calculus Teacher','This kid loves math for some reason but he's a hard worker.',5,'Yes','Yes',true)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);
$query = "INSERT INTO transcript VALUES (11111113,true)";
$result = mysqli_query($conn,$query);$row = mysqli_fetch_assoc($result);
echo "Error: " .$query . "<br/>" . mysqli_error($conn);




header('location:login.php');exit;

?>
