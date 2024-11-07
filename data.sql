CREATE DATABASE demo_web;
USE demo_web;

CREATE TABLE users (
    id INT(10) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    ngay DATE,  -- có thể đổi tên thành dob nếu cần
    gender ENUM('nam', 'nu')
);

INSERT INTO users (username, password, email, ngay, gender) VALUES
('admin', '123123', 'admin@gmail.com', '2004-04-04', 'nam'),
('dung', '123456', 'dung@gmail.com', '2002-02-02', 'nam'),
('chip', '123444', 'chip@gmail.com', '2007-12-01', 'nu');

CREATE TABLE post(
    post_id int(10) AUTO_INCREMENT PRIMARY KEY,
    user_id int(10) UNIQUE NOT NULL,
    title VARCHAR(50),
    content varchar(250),
    date DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
    
);

INSERT INTO post(post_id,user_id,title,content,date) VALUES
(1,1,'abcc','aaaaaaaa','2024-11-24 14:50:45'),
(2,2,'aaaaaaa','bbbbbbbb','2024-11-24 14:50:45'),
(3,2,'aaaaaaaaaa','zzzzzzzzzzzzz','2024-12-24 14:50:45'),
(4,3,'adgggggggg','dddddkgd','2024-07-24 14:50:45'),
(5,4,'khovaicabiu','phplamanhsuy','2024-07-24 14:50:45');
