# URL

<a href="http://gwupyterhub.seas.gwu.edu/~sp19DBp2-Team_Name/Team_Name/part1_projects/FlatEarthSociety/public_html/login.php"> Website </a>

# Team_Name

**Integration Changes**

-Change 'users' table to 'user'

-Change 'roles' table to 'role'

-Use 'uid' instead of 'id'

-Split up 'address' into 'street', 'city', 'state', and 'zip'

-Remove primary key from roles

-'reviewForm', 'approveThesis', and 'clearedToGrad' ints (booleans) are now in the user table instead of role

-'cNum' became 'courseNumber' 

-'courseCatalog' table is now 'course'

-'taken' is split up into 'schedule' and 'enrolls'

-'applicant: uname' is different from 'user: username'

-'formOne: id' and 'formOneValid: id' is now 'uid'


**Upcoming Plan**

-Creating a universal homepage with two buttons – Apply & Access Portal
-New page for registration portal that displays an nice UI for accessing course list, transcript, 

# Phase 2 Queries

* Search	for	an	applicant	using	their	last	name	or	student	number.	This	query	can	be	
submitted	by	the	GS	or	by	a	faculty	reviewer.

  * **Arjun - Add an input field to applicant_display.php**

* Update	applicant’s	academic	and	personal	information	– an	applicant	may	choose	to	
update	their	information	at	any	time.	This	can	be	simplified	by	having	only	the	GS	
perform	this	but	this	is	not	an	ideal	solution.	

  * **DONE**

* Given	the	Semester,	or	Year	or	Degree	program,	generate	the	list	of	graduate	
applicants.	This	query	can	be	submitted	by	the	GS.

  * **ALEX DO THIS**

* Given	the	semester	or	year	or	degree	program,	generate	the	list	of	admitted	students.	
This	query	can be	submitted	by	the	GS.

  * **Arjun - Add an input field to applicant_display.php and change role to also include 'gs'**

* Given	the	semester	or	year	or	degree	program,	generate	statistics	such	as	total	
number	of	applicants,	total	number	admitted,	total	number	rejected,	average	GRE	
score	for	admitted	applicants,	etc.	This	query	can	be	submitted	by	the GS.

  * 

* Given	the	semester	or	year	or	degree	program,	generate	the	list	of	graduating	
students	(i.e.,	those	cleared	for	graduation).	This	query	can	be	submitted	by	the	GS.

  * **DONE**

* Given	the	semester	or	year	or	degree	program,	generate	the	list	of	alumni	and	their	
email	address. This	query	can	be	submitted	by	the	GS.

  * **DONE - manage.php**

* Generate	total	list	of	current	students	(by	degree	or	by	admit	year). This	query	can	be	
submitted	by	the	GS.

  * **DONE - manage.php**

* Change	the	advisor	for	a	student,	given	the	student’s	student	number.	This	query	can	
be	submitted	by	the	GS.

  * **DONE - assignAdvisor.php**
  
* Given	a	student’s	student	number,	generate	the	transcript	(list	of	courses,	credits,	and	
the	current	GPA). This	query	can	be	submitted	by	the	GS	or	by	the	faculty	advisor	or	
by	the	student.

  * **Done within transcript.php**

* For	a	faculty	advisor,	generate	list	of	all	advisees. This	query	can	be	submitted	by	the	
GS	or	the	faculty	advisor.

  * **DONE - manage.php**

* For	a	faculty	instructor,	generate	their	course	roster	(i.e.,	list	of	students	enrolled	in	
their	class)	given	a	specific	course	they	are	teaching.

  * **DONE**

# Dashboard Items

**Systems Admin**

* register.php (Ben)
  * Creates a new user

**Student**

* viewStudentInfo.php (Ben)
  * view student name, id, address, balance
* transcript.php (Alex)
  * view student transcript
* editPersonalInfo.php (Ben)
  * edit information from viewStudentInfo.php
* applyToGraduate.php (Ben)
  * apply to graduate after submitting a form 1
  * graduated.php (Ben)
    * informs the user that their application to graduate was a success
  * noGraduate.php (Ben)
    * informs user about apply to graduate errors
* courseCatalog.php (Ben)
  * view all courses
* form1.php (Ben)
  * form 1 submission
  * successSubmit.php (Ben)
    * redirects user if submission is a success
  * form1Error.php (Ben)
    * informs user about form 1 submission errors
  
**Instructor**

**Faculty Advisor**

* viewStudentInfo.php (Ben)
  * view student name, id, address, balance
* transcript.php (Alex)
  * view student transcript
* viewForm1.php (Ben)
  * view student form 1

**Grad Secretary**

* assignAdvisor.php (Ben)
  * assign a student to a faculty advisor
* clearedGrad.php (Ben)
  * shows a list of students that are cleared to graduate
* viewAllStudents.php (Ben)
  * shows a list of all students

**Alumni**

* viewStudentInfo.php (Ben)
  * view student name, id, address, balance
* transcript.php (Alex)
  * view student transcript
* editPersonalInfo.php (Ben)
  * edit information from viewStudentInfo.php

