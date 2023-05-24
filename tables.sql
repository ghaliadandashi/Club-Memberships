CREATE TABLE users (
                       id INT(11) PRIMARY KEY AUTO_INCREMENT,
                       full_name VARCHAR(50),
                       email VARCHAR(255) UNIQUE,
                       password VARCHAR(255),
                       dob DATE,
                       role varchar(10)
);

CREATE TABLE memberships (
                        id INT(11) AUTO_INCREMENT,
                        user_id INT(11),
                        name varchar(255),
                        description varchar(255),
                        status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
                        PRIMARY KEY (`id`),
                        KEY user_id (user_id),
                        CONSTRAINT memberships_ibfk_1 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
)