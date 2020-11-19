/* roles
    Admin: 5
    Supervisor: 4
    Doctor: 3
    Caregiver: 2
    Patient: 1
    Family member: 1
*/



INSERT INTO `role` (`role_name`, `access_level`)
VALUES ("Admin", 5),
       ("Supervisor", 4),
       ("Doctor", 3),
       ("Caregiver", 2),
       ("Patient", 1),
       ("family", 1);


INSERT INTO `users` (`role_id`, `f_name`, `l_name`, `email`, `phone`, `password`, `dob`, `validated`)
VALUES (6, "Maurice", "Petrov", "mauricepetrov80@gmail.com", 7177451999, "PasswordMaurice", "1982/02/23", 1),
       (6, "Olivia", "Semmelweis", "oliviasemmelweis80@gmail.com", 7177451999, "PasswordOlivia", "1980/10/23", 1),
       (5, "Ignaz", "Semmelweis", "ignazsemmelweis40@gmail.com", 5659238383, "PasswordIgnaz", "1818/06/12", 0),
       (5, "Stanislav", "Petrov", "stanislavpetrov@gmail.com", 7179234383, "PasswordKevin", "1920/03/12", 1),
       (4, "Frances", "Marion", "francesmarion23@gmail.com", 7176845764, "PasswordKylie", "1998/04/10", 1),
       (4, "Ada", "Lovelace", "adalovelace10@gmail.com", 7175219061, "PasswordLovelace", "1999/06/10", 1),
       (4, "Dorathy", "Lawrence", "dorathylawrence23@gmail.com", 7176845764, "PasswordDorathy", "1998/07/06", 1),
       (4, "Dud", "Bolt", "dudbolt23@gmail.com", 7158634764, "PasswordDud", "1990/04/30", 1),
       (2, "Jek", "Porkins", "jekporkins12@gmail.com", 7932845123, "PasswordJek", "1976/09/01", 1),
       (2, "Edward", "Jenner", "edwardjenner23@gmail.com", 9801238501, "PasswordEdward", "1749/02/23", 1),
       (1, "Arthur", "Wellesley", "arthurwellesley43@gmail.com", 7172348920, "PasswordArthur", "1912/12/12", 1);

INSERT INTO `patient_info` (`user_id`, `family_code`, `emergency_contact`, `relation_of_contact`, `admission_date`)
VALUES (3, "OAI343", "Maurice Petrov", "Son", "2019/02/23"),
       (4, "OA9G12", "Olivia Semmelweis", "Daughter", "2018/03/24");


INSERT INTO `employee_info` (`user_id`, `salary`)
VALUES (5, 50000),
       (6, 50000),
       (7, 50000),
       (8, 50000),
       (9, 120000),
       (10, 120000),
       (11, 150000);

INSERT INTO `roster` (`supervisor`, `doctor`, `caregiver_1`, `caregiver_2`, `caregiver_3`, `caregiver_4`)
VALUES (11, 10, 5, 6, 7, 8);

INSERT INTO `appointment` (`patient_id`,`doctor_id`, `appointment_date`)
VALUES (3, 9, "2020/10/11"),
       (4, 10, "2020/03/11");


INSERT INTO `patient_records` (`patient_id`, `morning_med`, `afternoon_med`, `night_med`, `breakfast`, `lunch`, `dinner`, `cur_date`)
VALUES (3, 1, 1, 1, 1, 1, 1, "2020/12/23"),
       (4, 1, 0, 1, 1, 0, 1, "2020/11/10");
