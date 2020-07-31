CREATE TABLE regist (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(200) NOT NULL,
    email varchar(200) NOT NULL,
    password varchar(200) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE spot (
    id int NOT NULL AUTO_INCREMENT,
    spot_name varchar(40) NOT NULL,
    latitude float NOT NULL,
    longitude float NOT NULL,
    rate int NOT NULL,
    discribe text,
    s3FilePath varchar(250),
    trafoo int NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE regist (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(200) NOT NULL,
    rate int NOT NULL,
    reviewpoint text,
    picture varchar(250) NOT NULL,
    objectname varchar(40) NOT NULL,
    PRIMARY KEY (id)
);