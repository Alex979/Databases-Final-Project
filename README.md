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

