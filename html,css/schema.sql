DROP DATABASE IF EXISTS HireMe;
CREATE DATABASE HireMe;
USE HireMe;

CREATE TABLE Users (
   Users_id INT AUTO_INCREMENT,
   firstname VARCHAR(32),
   lastname VARCHAR(32),
   password VARCHAR(64),
   telephone VARCHAR(64),
   email VARCHAR(64),
   date_joined DATETIME,
   PRIMARY KEY(Users_id));

   
CREATE TABLE Jobs (
      Jobs_id INT AUTO_INCREMENT,
      job_title VARCHAR(32),
      job_description VARCHAR(255),
      category VARCHAR(64),
      company_name VARCHAR(64),
      company_location VARCHAR(64),
      date_posted DATETIME,
      PRIMARY KEY(Jobs_id)
      );

CREATE TABLE JobsAppliedFor (
         id INT AUTO_INCREMENT,
         job_id INT, /* id from the jobs table*/
         user_id INT, /*  id from the users table*/
         date_applied DATETIME,
         PRIMARY KEY(id)); /* AS SELECT id FROM Jobs, Users;  was tryna select the id from both of the tables*/

INSERT INTO Users (email, password) VALUES ("admin@hireme.com", MD5("password123"));