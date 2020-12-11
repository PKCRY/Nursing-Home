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
VALUES (6, "Maurice", "Petrov", "mauricepetrov80@gmail.com", 7177451999, "PasswordMaurice", "1982/02/23", 1), /*family*/
       (6, "Olivia", "Semmelweis", "oliviasemmelweis80@gmail.com", 7177451999, "PasswordOlivia", "1980/10/23", 1), /*family*/
       (5, "Ignaz", "Semmelweis", "ignazsemmelweis40@gmail.com", 5659238383, "PasswordIgnaz", "1818/06/12", 0), /*patient*/
       (5, "Stanislav", "Petrov", "stanislavpetrov@gmail.com", 7179234383, "PasswordKevin", "1920/03/12", 1), /*patient*/
       (4, "Frances", "Marion", "francesmarion23@gmail.com", 7176845764, "PasswordKylie", "1998/04/10", 1), /*caregiver*/
       (4, "Ada", "Lovelace", "adalovelace10@gmail.com", 7175219061, "PasswordLovelace", "1999/06/10", 1),  /*caregiver*/
       (4, "Dorathy", "Lawrence", "dorathylawrence23@gmail.com", 7176845764, "PasswordDorathy", "1998/07/06", 1), /*caregiver*/
       (4, "Dud", "Bolt", "dudbolt23@gmail.com", 7158634764, "PasswordDud", "1990/04/30", 1), /*caregiver*/
       (2, "Jek", "Porkins", "jekporkins12@gmail.com", 7932845123, "PasswordJek", "1976/09/01", 1), /*supervisor*/
       (2, "Edward", "Jenner", "edwardjenner23@gmail.com", 9801238501, "PasswordEdward", "1749/02/23", 1), /*supervisor*/
       (1, "Arthur", "Wellesley", "arthurwellesley43@gmail.com", 7172348920, "PasswordArthur", "1912/12/12", 1), /*admin*/
       (3, "TEST", "DOCTOR", "test@doctor", 7777777777, "1", "2020-10-10", 1), /*doctor*/
       (5, "TEST", "PATIENT", "test@patient", 777777777, "1", "2020-10-19", 1), /*patient*/
       (6, "TEST", "FAMILY", "test@family", 777777777, "1", "2020-10-09", 1), /*family*/
       (1, "TEST", "ADMIN", "test@admin", 777777777, "1", "2020-05-05", 1), /*admin*/
       (4, "TEST", "CAREGIVER", "test@caregiver", 7777777777, "1", "2020-10-10", 1), /*caregiver*/
       (2, "TEST", "SUPERVISOR", "test@supervisor", 7777777777, "1", "2020-10-10", 1); /*supervisor*/

INSERT INTO `patient_info` (`user_id`, `family_code`, `emergency_contact`, `relation_of_contact`, `admission_date`, `group_id`)
VALUES (3, "OAI343", "Maurice Petrov", "Son", "2019/02/23", 2),
       (4, "OA9G12", "Olivia Semmelweis", "Daughter", "2018/03/24", 2),
       (13, "test", "Olivia Semmelweis", "Mother", "2020-08-10", 2);


INSERT INTO `employee_info` (`user_id`, `salary`, `group_id`)
VALUES (5, 50000, 4),
       (6, 50000, NULL),
       (7, 50000, 3),
       (8, 50000, 1),
       (9, 120000, NULL),
       (10, 120000, NULL),
       (11, 150000, NULL),
       (12, 1000, NULL),
       (15, 90000, NULL),
	     (16, 100000, 2);

INSERT INTO `roster` (`supervisor`, `doctor`, `caregiver_1`, `caregiver_2`, `caregiver_3`, `caregiver_4`, `date`)
VALUES (9, 12, 5, 6, 7, 8, '2020-12-08'),
       (10, 12, 8, 7, 6, 5, '2020-12-09'),
       (9, 12, 5, 7, 6, 8, '2020-12-10'),
       (10, 12, 8, 6, 7, 5, '2020-12-11');

INSERT INTO `appointment` (`patient_id`,`doctor_id`, `appointment_date`, `morning_med`, `afternoon_med`, `night_med`, `completed`, `comment`)
VALUES (3, 9, "2020/10/11", "Invega", "apriprazole", "cariprazine", 1, "prescribed"),
       (4, 10, "2020/03/11", "Advil", "benadryl", "apriprazole", 0, "prescribed"),
       (13, 12, "2020/12/10", "advil", "apriprazole", "melatonin", 0, "Prescribed"),
       (13, 12, "2020/12/11", "Not Prescribed", "Not Prescribed", "Not Prescribed", 0, "No comment"),
       (13, 12, "2020/12/8", "methenphelidate", "advil", "melatonin", 1, "Patient Needs help with pain and focus during the day and sleep during the night"),
       (3, 10, "2020/12/10", "methamphetamine", "benadryl", "apriprazole", 0, "No Comment");


INSERT INTO `patient_records` (`patient_id`, `morning_med_check`, `afternoon_med_check`, `night_med_check`, `breakfast`, `lunch`, `dinner`, `cur_date` )
VALUES (13, 1, 1, 1, 1, 1, 1, "2020/12/08"),
       (13, 1, 0, 1, 1, 0, 1, "2020/12/09"),
       (13, 1, 1, 0, 1, 1, 1, "2020/12/10"),
       (13, 1, 1, 1, 1, 0, 1, "2020/12/11");
