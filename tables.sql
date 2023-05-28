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
                        name varchar(255) UNIQUE,
                        description varchar(455),
                        PRIMARY KEY (`id`)
)

INSERT INTO memberships (name,description)VALUES('BRONZE','This membership consists of the following features:
    • Tier Unlock: Instantly unlock two additional tiers to progress further in the game.
    • Exclusive Bronze Sticker: Earn our exclusive
Bronze sticker to showcase your membership status.
Daily Bonus Chest: Receive a daily bonus chest with extra resources for deck building and upgrading.','approved');

INSERT INTO memberships (name,description)VALUES('SILVER','This membership consists of the following features:
Tier Unlock: Unlock five additional tiers to progress further in the game. Additionally, receive a bonus Silver Chest.
•Exclusive Silver Sticker: Earn our exclusive
Silver sticker to showcase your membership status in style.
Bonus Chests: Enjoy the advantage of receiving three bonus chests every two days.','approved');

INSERT INTO memberships (name,description)VALUES('GOLD','This membership consists of the following features:
• Tier Unlock: Unlock ten additional tiers for exclusive high-level gameplay and rewords.
Exclusive Cold Sticker: Showcase your prestigious Gold membership status.
•Legendary Chests: Receive one
Legendary Chest every week for powerful and rare cards,
• Priority Support: Enjoy priority customer support for any inquiries or issues you may encounter.','approved');

CREATE TABLE membership_user (
                                 userID INT NOT NULL,
                                 membershipID INT NOT NULL,
                                 status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
                                 PRIMARY KEY (userID, membershipID),
                                 FOREIGN KEY (userID) REFERENCES Users(id),
                                 FOREIGN KEY (membershipID) REFERENCES Memberships(id)
);