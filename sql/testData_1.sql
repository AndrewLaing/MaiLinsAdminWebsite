

CALL insertCustomerDetails ('scotty','password123','Scott', 'Randolph', '13 Pleasant Street', 
                            'Liverpool', 'L19 0NE', '0151345987','randyscott@gmail.com');
CALL insertCustomerDetails ('dorothy','dottyisme','Garland', 'Judy', '22 Harlington Cresent', 
                            'Liverpool', 'L24 2ED', '01514448383', 'jgarland@gmail.com');
CALL insertCustomerDetails ('loliwin','qwertyuiop','Echowhisky', 'Romeo', '16b Tarwood Terrace', 
                            'Liverpool', 'L1 2LF', '089414567854', 'recho@yahoo.com');
CALL insertCustomerDetails ('sallywins','letmein','Biggins', 'Sally', '22 Plikington Place', 
                            'Liverpool', 'L22 4ES', '08982241161','sbiggins@gmail.com');
CALL insertCustomerDetails ('rockford','iwantapassword','Garner', 'James', '94 Bold Street',
                            'Liverpool', 'L14 3DD', '01517775656', 'jgarner123@gmail.com');
CALL insertCustomerDetails ('scottydog','crisscross','Scott', 'Christopher', '6 Alexandra Mews', 
                            'Liverpool', 'L9 0ND', '015109987784', 'chrissyscott@gmail.com');
CALL insertCustomerDetails ('percyfilth','123456789101112','Morrisson', 'Percival', '21 Everly Close', 
                            'Liverpool', 'L11 4FQ', '08982215663', 'pmoggyio@gmail.com');
CALL insertCustomerDetails ('gigigigi','gigigigi','Delacourt', 'Gigi', '96 Evergreen Terrace', 
                            'Liverpool', 'L22 6TR', '01515556343', 'gggirlie@gmail.com');
CALL insertCustomerDetails ('silentstart','lkjhgfdsa','Ferdinand', 'Lloyd', '124 Mainbridge Street', 
                            'Liverpool', 'L2 4FD', '08942278876', 'ferdielar@gmail.com');
CALL insertCustomerDetails ('crazyshooter','ilovejohn','Chapman', 'Mark', '12 Leepworth Hill', 
                            'Liverpool', 'L16 2WW', '01518989777', 'chappio@gmail.com');
CALL insertCustomerDetails ('paulolol','zxcvbnma','Henderson', 'Paul', '65 Impressa Grove',
                            'Liverpool', 'L2 4EE', '08983267769', 'hennyla@gmail.com');

SELECT checkPassword('scotty','password123');
SELECT checkPassword('scotty','ha');

CALL insertOrder(2, '2018-10-26', '2018-10-27 20:30:00',0);
CALL insertOrder(3, '2018-10-26', '2018-10-27 10:00:00',0);
CALL insertOrder(4, '2018-10-26', '2018-10-27 22:30:00',0);
CALL insertOrder(5, '2018-10-26', '2018-10-27 11:30:00',0);
CALL insertOrder(6, '2018-10-26', '2018-10-27 09:30:00',0);

CALL insertOrderItem(2,4,1);
CALL insertOrderItem(2,5,6);
CALL insertOrderItem(2,6,1);

CALL insertOrderItem(3,12,1);
CALL insertOrderItem(3,5,6);
CALL insertOrderItem(3,2,1);
CALL insertOrderItem(3,33,1);

CALL insertOrderItem(4,54,1);
CALL insertOrderItem(4,15,6);
CALL insertOrderItem(4,26,1);

CALL updateOrderItem(6,3,22,1);
