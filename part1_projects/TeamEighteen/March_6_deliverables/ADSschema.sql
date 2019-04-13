create table user(
  id int auto_increment,
  email varchar(100),
  fname varchar(100),
  lname varchar(100),
  username varchar(100),
  password varchar(100),
  primary key(id)
);

create table taken(
  creditHours int,
  gpa float(3,2),
  year int,
  semester varchar(100),
  classTime varchar(100),
  dept varchar(100),
  courseNumber int,
  courseTitle varchar(100),
  section int,
  id int,
  day varchar(100),
  primary key(id),
  foreign key(id) references user(id),
  foreign key(courseNumber) references courseCatalog(courseNumber)
);

create table roles(
  id int,
  role varchar(100),
  reviewForm int,
  approveThesis int,
  readTranscript int,
  primary key(id),
  foreign key(id) references user(id)
);

create table courseCatalog(
  courseNumber int,
  title varchar(100),
  credits int,
  dept varchar(100),
  preRequisite1 int default 'None',
  preRequisite2 int default 'None',
  primary key(courseNumber, dept)
);
