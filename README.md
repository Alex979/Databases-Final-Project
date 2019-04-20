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
* courseCatalog.php (Ben)
  * view all courses

  
**Instructor**

**Faculty Advisor**

* viewStudentInfo.php (Ben)
  * view student name, id, address, balance
* transcript.php (Alex)
  * view student transcript
* viewForm1.php (Ben)
  * view student form 1

**Grad Secretary**

**Alumni**

* viewStudentInfo.php (Ben)
  * view student name, id, address, balance
* transcript.php (Alex)
  * view student transcript
* editPersonalInfo.php (Ben)
  * edit information from viewStudentInfo.php

