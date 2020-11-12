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
VALUES (6, "Maurice", "Petrov", "mauricepetrov80@gmail.com", 7177451999, "PasswordMaurice", 06/23/1982, 1),
       (6, "Olivia", "Semmelweis", "oliviasemmelweis80@gmail.com", 7177451999, "PasswordOlivia", 06/23/1980, 1),
       (5, "Ignaz", "Semmelweis", "ignazsemmelweis40@gmail.com", 5659238383, "PasswordIgnaz", 03/12/1818, 0),
       (5, "Stanislav", "Petrov", "stanislavpetrov@gmail.com", 7179234383, "PasswordKevin", 03/12/1920, 1),
       (4, "Frances", "Marion", "francesmarion23@gmail.com", 7176845764, "PasswordKylie", 06/10/1998, 1),
       (4, "Ada", "Lovelace", "adalovelace10@gmail.com", 7175219061, "PasswordLovelace", 06/10/1999, 1),
       (4, "Dorathy", "Lawrence", "dorathylawrence23@gmail.com", 7176845764, "PasswordDorathy", 06/10/1998, 1),
       (4, "Dud", "Bolt", "dudbolt23@gmail.com", 7158634764, "PasswordDud", 02/30/1990, 1),
       (2, "Jek", "Porkins", "jekporkins12@gmail.com", 7932845123, "PasswordJek", 09/01/1976, 1),
       (2, "Edward", "Jenner", "edwardjenner23@gmail.com", 9801238501, "PasswordEdward", 02/23/1749, 1),
       (1, "Arthur", "Wellesley", "arthurwellesley43@gmail.com", 7172348920, "PasswordArthur", 12/12/1912, 1);





