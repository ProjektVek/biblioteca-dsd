CREATE TABLE Users (
    username CHAR(50) PRIMARY KEY,
    password CHAR(30),
    name CHAR(50),
    type INT
);

INSERT INTO Users VALUES ('admin','adminbiblioteca','Administrador',3)
INSERT INTO USERS VALUES ('funcionario01','funcionariorelativo','Albert Einstein',2)
INSERT INTO USERS VALUES ('VictorHSF','VHFerreira','Victor Hugo S Ferreira', 1)