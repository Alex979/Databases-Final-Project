-- JOHN LENNON COMPLETE APPLICANT, NEEDS FACULTY REVIWS
INSERT INTO applicant VALUES(
    55551111, 
    '111-11-1111',
    'jLennon',
    'John',
    'Lennon',
    '2121 I St NW',
    'Washington',
    'DC',
    'arjunvkr@gmail.com',
    '111-111-1111',
    '20052',
    1
);
INSERT INTO application_info(uid, degree_sought, major, start_year, start_semester, b_degree, b_university, b_gpa, b_date,gre_date, area_of_interest, work_experience, complete) VALUES (
    55551111,
    "MS",
    "CSCI",
    "2017",
    "Fall",
    "CSCI",
    "RIT",
    3.5,
    "2017/05/19",
    "2017",
    "Cyber Security",
    "NSA and Google",
    1);

INSERT INTO rec_letters(uid, rec_fname, rec_lname, rec_email, rec_title, rec_affiliation, reccomendation, complete) VALUES (
    55551111,
    "Kevin",
    "ODonnel",
    "kev@odonnel.com",
    "Professor",
    "Calculus Teacher",
    "Hard worker and great student",
    1
);

INSERT INTO subject_score VALUES (55551111,"GRE Total",339);
INSERT INTO subject_score VALUES (55551111,"GRE Verbal",169);
INSERT INTO subject_score VALUES (55551111,"GRE Quantitative",170);
INSERT INTO transcript VALUES (55551111,NULL, 1);


INSERT INTO application_status (uid,ready_for_evaluation,admission_status,num_evaluations) VALUES (
    55551111,
    "yes",
    "Application Recieved and Decision Pending",
    0
);

-- RINGO STAR INCOMPLETE APPLICANT(MISSING LETTERS)
INSERT INTO applicant VALUES(
     66661111, -- uid
    '222-11-1111', -- ssn
    'ringostar', -- username
    'Ringo',
    'Star',
    '2121 I St NW',
    'Washington',
    'DC',
    'arjunvkr@gmail.com',
    '111-111-1111',
    '20052',
    true
);
INSERT INTO application_info(uid, degree_sought, major, start_year, start_semester, b_degree, b_university, b_gpa, b_date,gre_date, area_of_interest, work_experience, complete) VALUES (
    66661111,
    "MS",
    "CSCI",
    "2017",
    "Fall",
    "CSCI",
    "RIT",
    3.5,
    "2016/05/19",
    "2016",
    "Cyber Security",
    "NSA and Google",
    true
);

INSERT INTO subject_score VALUES (66661111,"GRE Total",339);
INSERT INTO subject_score VALUES (66661111,"GRE Verbal",169);
INSERT INTO subject_score VALUES (66661111,"GRE Quantitative",170);
INSERT INTO transcript VALUES (66661111,NULL, true);


INSERT INTO application_status (uid,ready_for_evaluation,admission_status,num_evaluations) VALUES (
    66661111,
    "no",
    "Application Materials Missing. Please View Above",
    0
);


-- LOUIS ARMSTRONG APPLIED AND WAS REJECTED
INSERT INTO applicant VALUES(
     00001234, -- uid
    '555-11-1111', -- ssn
    'lArmstrong', -- username
    'Louis',
    'Armstrong',
    '2121 I St NW',
    'Washington',
    'DC',
    'arjunvkr@gmail.com',
    '111-111-1111',
    '20052',
    true
);
INSERT INTO application_info(uid, degree_sought, major, start_year, start_semester, b_degree, b_university, b_gpa, b_date,gre_date, area_of_interest, work_experience, complete) VALUES (
    00001234,
    "MS",
    "CSCI",
    "2017",
    "Fall",
    "CSCI",
    "RIT",
    3.0,
    "2013/05/19",
    "2017",
    "Cyber Security",
    "Apple",
    true
);

INSERT INTO rec_letters (uid,rec_fname,rec_lname,rec_email,rec_title,rec_affiliation,reccomendation,rating,generic,credible,complete)
 VALUES (00001234,"Kevin","ODonnel","kev@odonnel.com","Professor","Calculus Teacher","This kid loves math for some reason but he's a hard worker.",2,"Yes","No",true);


INSERT INTO subject_score VALUES (00001234,"GRE Total",339);
INSERT INTO subject_score VALUES (00001234,"GRE Verbal",169);
INSERT INTO subject_score VALUES (00001234,"GRE Quantitative",170);
INSERT INTO transcript VALUES (00001234,NULL, true);

INSERT INTO faculty_evaluation VALUES (
    00001234,
    12345678,
    "Medicore",
    2,
    "narahari",
    "rejected"
);

INSERT INTO application_status (uid,ready_for_evaluation,admission_status,decision,date_completed,avg_rank,num_evaluations) VALUES (
    00001234,
    "yes",
    "Reject",
    "Admit",
    "2019/05/07",
    2,
    1
);

-- ARETHA FRANKLIN APPLIED AND DID NOT ACCEPT
INSERT INTO applicant VALUES(
     00001235, -- uid
    '666-11-1111', -- ssn
    'afranklin', -- username
    'Aretha',
    'Franklin',
    '2121 I St NW',
    'Washington',
    'DC',
    'arjunvkr@gmail.com',
    '111-111-1111',
    '20052',
    true
);
INSERT INTO application_info(uid, degree_sought, major, start_year, start_semester, b_degree, b_university, b_gpa, b_date,gre_date, area_of_interest, work_experience, complete) VALUES (
    00001235,
    "MS",
    "CSCI",
    "2017",
    "Fall",
    "CSCI",
    "RIT",
    3.5,
    "2013/05/19",
    "2017",
    "Cyber Security",
    "NSA and Google",
    true
);

INSERT INTO subject_score VALUES (00001235,"GRE Total",339);
INSERT INTO subject_score VALUES (00001235,"GRE Verbal",169);
INSERT INTO subject_score VALUES (00001235,"GRE Quantitative",170);
INSERT INTO transcript VALUES (00001235,NULL, true);

INSERT INTO rec_letters(uid,rec_fname,rec_lname,rec_email,rec_title,rec_affiliation,reccomendation,rating,generic,credible,complete) VALUES (00001235,"Kevin","ODonnel","kev@odonnel.com","Professor","Calculus Teacher","This kid loves math",3,"No","yes",true);


INSERT INTO faculty_evaluation VALUES (
    00001235,
    12345678,
    "Brilliant",
    3,
    "narahari",
    "admitted"
);


INSERT INTO application_status (uid,ready_for_evaluation,admission_status,decision,date_completed,avg_rank,num_evaluations) VALUES (
    00001235,
    "yes",
    "Admit",
    "Admit",
    "2019/05/07",
    3,
    1
);

-- CARLOS SANTANA APPLIED AND DID NOT ACCEPT
INSERT INTO applicant VALUES(
     00001236, -- uid
    '777-11-1111', -- ssn
    'cSantana', -- username
    'Carlos',
    'Santana',
    '2121 I St NW',
    'Washington',
    'DC',
    'arjunvkr@gmail.com',
    '111-111-1111',
    '20052',
    true
);
INSERT INTO application_info(uid, degree_sought, major, start_year, start_semester, b_degree, b_university, b_gpa, b_date,gre_date, area_of_interest, work_experience, complete) VALUES (
    00001236,
    "PhD",
    "CSCI",
    "2017",
    "Fall",
    "CSCI",
    "RIT",
    3.5,
    "2013/05/19",
    "2013",
    "Cyber Security",
    "NSA and Google",
    true
);

INSERT INTO subject_score VALUES (00001236,"GRE Total",339);
INSERT INTO subject_score VALUES (00001236,"GRE Verbal",169);
INSERT INTO subject_score VALUES (00001236,"GRE Quantitative",170);
INSERT INTO transcript VALUES (00001236,NULL, true);

INSERT INTO faculty_evaluation VALUES (
    00001236,
    12345678,
    "Brilliant",
    4,
    "narahari",
    "admitted"
);


INSERT INTO application_status (uid,ready_for_evaluation,admission_status,decision,date_completed,avg_rank,num_evaluations) VALUES (
    00001236,
    "yes",
    "Admit",
    "Admit",
    "2019/05/07",
    4,
    1
);


