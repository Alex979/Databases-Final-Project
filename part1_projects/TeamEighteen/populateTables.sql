delete from taken;
delete from courseCatalog;
delete from roles;
delete from users;


insert into users values
  (111, 211, 'johndoe@gmail.com', 'John', 'Doe', 'johndoe', 'password', '10 M St NW, Washington, DC', 2500.00),
  (112, 211, 'janedoe@gmail.com', 'Jane', 'Doe', 'janedoe', 'password', '11 L St NW, Washington, DC', 5000.00),
  (113, 212,'mileycyrus@gmail.com', 'Miley', 'Cyrus', 'mileycyrus', 'password', '900 H St NW, Washington, DC', 0.00),
  (114, NULL, 'oprahwinfrey@gmail.com', 'Oprah', 'Winfrey', 'oprahwinfrey', 'password', '101 I St NW, Washington, DC', 0.00),
  (211, NULL, 'tombrady@gmail.com', 'Tom', 'Brady', 'tombrady', 'password', '900 21st St NW, Washington, DC', 0.00),
  (212, NULL, 'nickjonas@gmail.com', 'Nick', 'Jonas', 'nickjonas', 'password', '405 22nd St NW, Washington, DC', 0.00),
  (311, NULL, 'kevinjonas@gmail.com', 'Kevin', 'Jonas', 'kevinjonas', 'password', '405 22nd St NW, Washington, DC', 0.00),
  (411, NULL, 'joejonas@gmail.com', 'Joe', 'Jonas', 'joejonas', 'password', '405 22nd St NW, Washington, DC', 0.00),
  (511, NULL, 'frankiejonas@gmail.com', 'Frankie', 'Jonas', 'frankiejonas', 'password', '405 22nd St NW, Washington, DC', 0.00);

insert into roles values
  (111, 'student', 0, 0, 0),
  (112, 'student', 0, 0, 0),
  (113, 'student', 0, 0, 0),
  (114, 'student', 0, 0, 0),
  (211, 'advisor', 0, 0, 0),
  (212, 'advisor', 0, 0, 0),
  (311, 'gradSec', 0, 0, 0),
  (411, 'sysAdmin', 0, 0, 0),
  (511, 'alumni', 0, 0, 0);
  
insert into courseCatalog values
    (1011, 'Microeconomics', 3, 'ECON', NULL, NULL),
	(1012, 'Macroeconomics', 3, 'ECON', 'ECON1011', NULL),
	(1231, 'Calculus I', 3, 'MATH', NULL, NULL),
	(1125, 'Biology I Lab', 1, 'BISC', NULL, NULL),
	
	(6221, 'SW Paradigms', 3, 'CSCI', NULL, NULL),
	(6461, 'Computer Architecture', 3, 'CSCI', NULL, NULL),
	(6212, 'Algorithms', 3, 'CSCI', NULL, NULL),
	(6220, 'Machine Learning', 3, 'CSCI', NULL, NULL),
	(6232, 'Networks 1', 3, 'CSCI', NULL, NULL),
	(6233, 'Networks 2', 3, 'CSCI', 'CSCI 6233', NULL),
	(6241, 'Database 1', 3, 'CSCI', NULL, NULL),
	(6242, 'Database 2', 3, 'CSCI', 'CSCI 6241', NULL),
	(6246, 'Compilers', 3, 'CSCI', 'CSCI 6461', 'CSCI 6212'),
	(6260, 'Multimedia', 3, 'CSCI', NULL, NULL),
	(6251, 'Cloud Computing', 3, 'CSCI', 'CSCI 6461', NULL),
	(6254, 'SW Engineering', 3, 'CSCI', 'CSCI 6221', NULL),
	(6262, 'Graphics 1', 3, 'CSCI', NULL, NULL),
	(6283, 'Security 1', 3, 'CSCI', 'CSCI 6212', NULL),
	(6284, 'Cryptography', 3, 'CSCI', 'CSCI 6212', NULL),
	(6286, 'Network Security', 3, 'CSCI', 'CSCI 6283', 'CSCI 6232'),
	(6325, 'Algorithms 2', 3, 'CSCI', 'CSCI 6212', NULL),
	(6339, 'Embedded Systems', 3, 'CSCI', 'CSCI 6461', 'CSCI 6212'),
	(6384, 'Cryptography 2', 3, 'CSCI', 'CSCI 6284', NULL),
	(6241, 'Communication Theory', 3, 'ECE', NULL, NULL),
	(6242, 'Information Theory', 2, 'ECE', NULL, NULL),
	(6210, 'Logic', 2, 'MATH', NULL, NULL);

insert into taken values
  (3,'B-', 3.00, 2017, 'Fall', '0935-1050', 'ECON', 1011, 'Microeconomics', 11, 114, 'T'),
  (3,'B+', 3.00, 2018, 'Spring', '1110-1225', 'ECON', 1012, 'Macroeconomics', 10, 114, 'M'),
  (3,'B-', 3.00, 2018, 'Spring', '1245-1400', 'MATH', 1231, 'Calculus I', 12, 114, 'T'),
  (1,'B', 3.00, 2017, 'Fall', '0800-0915', 'BISC', 1125, 'Biology I Lab', 30, 114, 'F'),
  
  
  
(3, 'A', 3.34, 2018, 'Fall', '1500-1730', 'CSCI', 6221, 'SW Paradigms', 11, 111, 'M'),
(3, 'B-', 3.34, 2018, 'Fall', '1500-1730', 'CSCI', 6461, 'Computer Architecture', 12, 111, 'T'),
(3, 'B+', 3.34, 2018, 'Fall', '1500-1730', 'CSCI', 6212, 'Algorithms', 14, 111, 'W'),
(3, 'B', 3.34, 2018, 'Spring', '1800-2030', 'CSCI', 6232, 'Networks 1', 10, 111, 'M'),
(3, 'A-', 3.34, 2018, 'Fall', '1800-2030', 'CSCI', 6233, 'Networks 2', 11, 111, 'T'),
(3, 'A', 3.62, 2018, 'Spring', '1800-2030', 'CSCI', 6241, 'Database 1', 12, 112, 'W'),
(3, 'C+', 3.62, 2018, 'Fall', '1800-2030', 'CSCI', 6242, 'Database 2', 11, 112, 'R'),
(3, 'A-', 3.62, 2018, 'Fall', '1500-1730', 'CSCI', 6246, 'Compilers', 10, 112, 'T'),
(3, 'A', 3.62, 2018, 'Fall', '1800-2030', 'CSCI', 6251, 'Cloud Computing', 13, 112, 'M'),
(3, 'A', 3.62, 2018, 'Fall', '1530-1800', 'CSCI', 6254, 'SW Engineering', 15, 112, 'M'),
(3, 'A-', 3.62, 2018, 'Fall', '1800-2030', 'CSCI', 6260, 'Multimedia', 11, 112, 'R'),
(3, 'A', 3.00, 2018, 'Spring', '1800-2030', 'CSCI', 6262, 'Graphics 1', 11, 113, 'W'),
(3, 'C', 3.00, 2018, 'Spring', '1800-2030', 'CSCI', 6283, 'Security 1', 12, 113, 'T'),
(3, 'B+', 3.00, 2018, 'Spring', '1800-2030', 'CSCI', 6284, 'Cryptography', 10, 113, 'M'),
(3, 'B-', 3.00, 2018, 'Spring', '1800-2030', 'CSCI', 6286, 'Network Security', 11, 113, 'W'),
(3, 'A-', 3.00, 2018, 'Fall', '1500-1730', 'CSCI', 6384, 'Cryptography 2', 13, 113, 'W'),
(3, 'C+', 3.00, 2018, 'Fall', '1800-2030', 'ECE', 6241, 'Communication Theory', 12, 113, 'M'),
(2, 'B', 3.00, 2018, 'Fall', '1800-2030', 'ECE', 6242, 'Information Theory', 11, 113, 'T'),
(2, 'B', 3.00, 2018, 'Fall', '1800-2030', 'MATH', 6210, 'Logic', 10, 113, 'W'),
(3, 'B', 3.00, 2018, 'Fall', '1600-2830', 'CSCI', 6339, 'Embedded Systems', 14, 113, 'R');
