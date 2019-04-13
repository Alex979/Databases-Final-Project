drop table if exists formOneValid cascade;
drop table if exists formOne cascade;
drop table if exists taken cascade;
drop table if exists courseCatalog cascade;
drop table if exists roles cascade;
drop table if exists users cascade;


create table users(
  id int,
  advisorid int,
  email varchar(100),
  fname varchar(100),
  lname varchar(100),
  username varchar(100),
  password varchar(100),
  address varchar(255),
  balance float(20,2),
  primary key(id)
);


create table roles(
  id int,
  role varchar(100),
  reviewForm int,
  approveThesis int,
  clearedToGrad int,
  primary key(id),
  foreign key(id) references users(id)
);

create table courseCatalog(
  courseNumber int,
  title varchar(100),
  credits int,
  dept varchar(100),
  preRequisite1 varchar(100),
  preRequisite2 varchar(100),
  primary key(courseNumber, dept)
);

create table taken(
  creditHours int,
  grade varchar(3),
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
  primary key(id, dept, section, courseNumber),
  foreign key(id) references users(id),
  foreign key(courseNumber) references courseCatalog(courseNumber)
);

create table formOne(
  num int auto_increment,
  id int,
  courseNumber int,
  dept varchar(100),
  primary key(num),
  foreign key(id) references users(id)
  );
  
create table formOneValid(
  num int auto_increment,
  id int,
  courseNumber int,
  dept varchar(100),
  primary key(num)
  );
