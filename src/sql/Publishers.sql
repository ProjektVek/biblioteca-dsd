CREATE TABLE Publishers (
    publisher_id SERIAL PRIMARY KEY,
    name CHAR(30),
);
INSERT INTO Publishers
VALUES ('0201', 'Addison-Wesley');
INSERT INTO Publishers
VALUES ('0471', 'John Wiley & Sons');
INSERT INTO Publishers
VALUES ('0262', 'MIT Press');
INSERT INTO Publishers
VALUES ('0596', 'O''Reilly', 'www.ora.com');
INSERT INTO Publishers
VALUES ('019', 'Oxford University Press');
INSERT INTO Publishers
VALUES ('013', 'Prentice Hall');
INSERT INTO Publishers
VALUES ('0679', 'Random House');
INSERT INTO Publishers
VALUES ('07434', 'Simon & Schuster');