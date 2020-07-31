INSERT INTO regist (username, email, password)
VALUES ('tester1','test@test.com','123QWEasd');

INSERT INTO spot (spot_name, latitude, longitude, rate, discribe, s3FilePath, trafoo)
VALUES ('Dundas Peak', 43.2572, -79.9277, 0,'A cliff that has a wonder view of the dundas city and a railway down, Best to visit in the autumn when maple leaves turn red. But it is hard to find a parking area as nearly all the streets down the hill have the no-parking sign.','test_example/dundaspeak.jpg', 0);

INSERT INTO spot (spot_name, latitude, longitude, rate, discribe, s3FilePath, trafoo)
VALUES ('Mcmaster University', 43.2636, -79.9182, 0,'McMaster University, McMaster or Mac is a public research university in Hamilton, Ontario, Canada. The main McMaster campus is on 121 hectares of land near the residential neighbourhoods of Ainslie Wood.','test_example/mcmasterUNV.png', 0);

INSERT INTO spot (spot_name, latitude, longitude, rate, discribe, s3FilePath, trafoo)
VALUES ('Tim Hortons', 43.2578, -79.9257, 3,'Canadian chain selling signature premium blend coffee, plus light fare like pastries and panini.',NULL, 1);


INSERT INTO spot (username, rate, reviewpoint, picture, objectname)
VALUES ('tester1', 4, 'The service is very quick.',NULL, 'Tim Hortons');

INSERT INTO spot (username, rate, reviewpoint, picture, objectname)
VALUES ('tester1', 2, 'This shop is too away from my school.',NULL, 'Tim Hortons');

INSERT INTO spot (username, rate, reviewpoint, picture, objectname)
VALUES ('tester1', 4, 'third uploading',NULL, 'Tim Hortons');