delete from formOne;
delete from formOneValid;
delete from taken;
delete from courseCatalog;
delete from roles;
delete from users;

insert into users values
(55555555, 88888888, 'paulmccartney@gmail.com', 'Paul', 'McCartney', 'paulmccartney', 'password', '10 M St NW, Washington, DC', 0.00),
(66666666, 99999999, 'georgeharrison@gmail.com', 'George', 'Harrison', 'georgeharrison', 'password', '1 L St NW, Washington, DC', 0.00),
(77777777, NULL, 'ericclapton@gmail.com', 'Eric', 'Clapton', 'ericclapton', 'password', '11 H St NW, Washington, DC', 0.00),
(44444444, NULL, 'gradsecretary@gmail.com', 'Grad', 'Secretary', 'gradsecretary','password','110 Washington St NW, Washington, DC', 0.00),
(88888888, NULL, 'bhaginarahari@gmail.com', 'Bhagi', 'Narahari', 'bhaginarahari', 'password', '777 Rhode Island St NW, Washington, DC', 0.00),
(99999999, NULL, 'gabeparmer@gmail.com', 'Gabe', 'Parmer', 'gabeparmer', 'password', '113 Coffee St NW, Washington, DC', 0.00),
(12345678, NULL, 'sysadmin@gmail.com', 'Systems', 'Admin', 'sysadmin', 'password', '1 M St. NW, Washington, DC', 0.00);

insert into roles values
  (55555555, 'student', 0, 0, 0),
  (66666666, 'student', 0, 0, 0),
  (88888888, 'advisor', 0, 0, 0),
  (99999999, 'advisor', 0, 0, 0),
  (44444444, 'gradSec', 0, 0, 0),
  (77777777, 'alumni', 0, 0, 0),
  (12345678, 'sysAdmin', 0, 0, 0);
insert into courseCatalog values
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
(3, 'A', 3.00, 2018, 'Spring', '1800-2030', 'CSCI', 6221, 'SW Paradigms', 10, 55555555, 'M'),
(3, 'A', 3.00, 2018, 'Spring', '1800-2030', 'CSCI', 6212, 'Algorithms', 10, 55555555, 'M'),
(3, 'A', 3.00, 2018, 'Fall', '1500-1730', 'CSCI', 6461, 'Computer Architecture', 13, 55555555, 'W'),
(3, 'A', 3.00, 2018, 'Fall', '1800-2030', 'CSCI', 6232, 'Networks 1', 12, 55555555, 'M'),
(3, 'A', 3.00, 2018, 'Fall', '1800-2030', 'CSCI', 6233, 'Networks 2', 11, 55555555, 'T'),
(3, 'B', 3.00, 2018, 'Spring', '1800-2030', 'CSCI', 6241, 'Database 1', 10, 55555555, 'W'),
(3, 'B', 3.00, 2018, 'Spring', '1800-2030', 'CSCI', 6246, 'Compiliers', 10, 55555555, 'R'),
(3, 'B', 3.00, 2018, 'Fall', '1500-1730', 'CSCI', 6262, 'Graphics 1', 13, 55555555, 'F'),
(3, 'B', 3.00, 2018, 'Fall', '1800-2030', 'CSCI', 6283, 'Security 1', 12, 55555555, 'W'),
(3, 'B', 3.00, 2018, 'Fall', '1800-2030', 'CSCI', 6242, 'Database 2', 11, 55555555, 'F'),

(2, 'C', 3.00, 2018, 'Spring', '1800-2030', 'ECE', 6242, 'Information Theory', 10, 66666666, 'M'),
(3, 'B', 3.00, 2018, 'Spring', '1800-2030', 'CSCI', 6221, 'SW Paradigms', 10, 66666666, 'M'),
(3, 'B', 3.00, 2018, 'Fall', '1500-1730', 'CSCI', 6461, 'Computer Architecture', 13, 66666666, 'W'),
(3, 'B', 3.00, 2018, 'Fall', '1800-2030', 'CSCI', 6212, 'Algorithms', 12, 66666666, 'M'),
(3, 'B', 3.00, 2018, 'Fall', '1800-2030', 'CSCI', 6232, 'Networks 1', 11, 66666666, 'T'),
(3, 'B', 3.00, 2018, 'Spring', '1800-2030', 'CSCI', 6233, 'Networks 2', 10, 66666666, 'M'),
(3, 'B', 3.00, 2018, 'Fall', '1500-1730', 'CSCI', 6241, 'Database 1', 13, 66666666, 'W'),
(3, 'B', 3.00, 2018, 'Fall', '1800-2030', 'CSCI', 6242, 'Database 2', 12, 66666666, 'M'),
(3, 'B', 3.00, 2018, 'Fall', '1800-2030', 'CSCI', 6283, 'Security 1', 11, 66666666, 'T'),
(3, 'B', 3.00, 2018, 'Spring', '1800-2030', 'CSCI', 6284, 'Cryptography', 10, 66666666, 'M'),

(3, 'A', 3.00, 2013, 'Spring', '1800-2030', 'CSCI', 6283, 'Security 1', 10, 77777777, 'M'),
(3, 'A', 3.00, 2013, 'Spring', '1800-2030', 'CSCI', 6284, 'Cryptography', 10, 77777777, 'M'),
(3, 'A', 3.00, 2013, 'Fall', '1500-1730', 'CSCI', 6286, 'Network Security', 13, 77777777, 'W'),
(3, 'B', 3.00, 2013, 'Fall', '1800-2030', 'CSCI', 6221, 'SW Paradigms', 12, 77777777, 'M'),
(3, 'B', 3.00, 2013, 'Fall', '1800-2030', 'CSCI', 6212, 'Algorithms', 11, 77777777, 'T'),
(3, 'B', 3.00, 2012, 'Spring', '1800-2030', 'CSCI', 6461, 'Computer Architecture', 10, 77777777, 'W'),
(3, 'B', 3.00, 2012, 'Spring', '1800-2030', 'CSCI', 6232, 'Networks 1', 10, 77777777, 'R'),
(3, 'B', 3.00, 2012, 'Fall', '1500-1730', 'CSCI', 6233, 'Networks 2', 13, 77777777, 'F'),
(3, 'B', 3.00, 2011, 'Fall', '1800-2030', 'CSCI', 6241, 'Database 1', 12, 77777777, 'W'),
(3, 'B', 3.00, 2012, 'Fall', '1800-2030', 'CSCI', 6242, 'Database 2', 11, 77777777, 'F'); 


	
