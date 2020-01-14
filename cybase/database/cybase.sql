CREATE TABLE person (
  username varchar(20) NOT NULL primary key,
  password varchar(30) NOT NULL,
  first_name varchar(10) NOT NULL,
  last_name varchar(10) NOT NULL,
  email varchar(100) NOT NULL,
  role varchar(5) NOT NULL ,
  avg_rate decimal(5,4) default 0,
  count integer(5) default 0,
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


INSERT INTO person (username,password,first_name,last_name,email,role) VALUES ('admin','cybase','aaa','bbb','test@gmail.com','admin');  


CREATE TABLE course (
  course_id integer(3) AUTO_INCREMENT primary key,
  course_name varchar(50) NOT NULL,
  duration varchar(10) NOT NULL,
  link varchar(100) NOT NULL,
  provider_name varchar(30) NOT NULL,
  domain_name varchar(30) NOT NULL ,
  foreign key(provider_name) references provider(provider_name) on delete cascade,
  foreign key(domain_name) references domain(domain_name) on delete cascade
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE provider (
  provider_name varchar(30) NOT NULL primary key,
  contact varchar(30) NOT NULL,
  website varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE domain (
  domain_name varchar(30) NOT NULL primary key,
  domain_description varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE review (
  course_id integer(3) NOT NULL,
  username varchar(20) NOT NULL,
  description varchar(50) NOT NULL,
  rating integer(1) NOT NULL CHECK (rating >= 0 and rating <=5),
  primary key (username, course_id),
  foreign key(course_id) references course(course_id) on delete cascade,
  foreign key(username) references person(username) on delete cascade
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO review (course_id,username,description,rating) VALUES (32,'a','good',5); 


DELIMITER //
DROP PROCEDURE IF EXISTS `GetReview`// 
CREATE PROCEDURE GetReview(
    IN c_id VARCHAR(3)
)
BEGIN
    SELECT * 
     FROM review
    WHERE course_id = c_id;
END //


DELIMITER //
DROP PROCEDURE IF EXISTS `SetAvgRating`// 
CREATE PROCEDURE SetAvgRating(
    IN c_id VARCHAR(3)
)
BEGIN
    UPDATE course set avg_rate=(SELECT avg(rating) FROM review),count=(SELECT count(*) FROM review) WHERE course_id = c_id;
END //




