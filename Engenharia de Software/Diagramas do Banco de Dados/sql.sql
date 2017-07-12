/* Em construção: */

CREATE TABLE Pessoa (
    id integer PRIMARY KEY auto_increment,
    primeiroNome varchar(25),
    sobrenome varchar(60),
    nascimento date,
    status tinyint,
    Estado char(2),
    Rua varchar(50),
    CEP char(9),
    Bairro varchar(50),
    Cidade varchar(60),
    numResidencia integer,
    senha varchar(50),
    sexo tinyint,
    cpf char(14),
    rg varchar(15),
    telefone varchar(14),
    email varchar(40),
    foto varchar(50)
);

CREATE TABLE Administrador (
    id integer auto_increment,
    FK_Pessoa_id integer,
    PRIMARY KEY (id, FK_Pessoa_id)
);

CREATE TABLE Professor (
    id integer auto_increment,
    FK_Pessoa_id integer,
    PRIMARY KEY (id, FK_Pessoa_id)
);

CREATE TABLE Aluno (
    id integer auto_increment,
    FK_Pessoa_id integer,
    PRIMARY KEY (id, FK_Pessoa_id)
);

CREATE TABLE Curso (
    titulo varchar(60),
    status tinyint,
    id integer PRIMARY KEY auto_increment,
    descricao varchar(250)
);

CREATE TABLE Matéria (
    Titulo varchar(60),
    Apresentacao varchar(250),
    Objetivo varchar(250),
    Ementa varchar(250),
    status tinyint,
    id integer PRIMARY KEY auto_increment,
    material varchar(250),
    bibliografia varchar(250),
    extraClasse varchar(250),
    Avaliacoes varchar(250)
);

CREATE TABLE FazParte (
    FK_Matéria_id integer ,
    FK_Curso_id integer,
    DiaSemana varchar(40),
    Turno varchar(30),
    horaInicial time,
    horaFinal time,
    Turma varchar(35),
    DataInicio date,
    DataFinal date
);

CREATE TABLE Matrícula (
    FK_Curso_id integer,
    FK_Aluno_id integer,
    FK_Aluno_FK_Pessoa_id integer,
    Data date,
    status tinyint
);

CREATE TABLE Avaliado (
    FK_Matéria_id integer,
    FK_Aluno_id integer,
    FK_Aluno_FK_Pessoa_id integer,
    Data date,
    Nota numeric(2,1)
);

CREATE TABLE Frequenta (
    FK_Matéria_id integer,
    FK_Aluno_id integer,
    FK_Aluno_FK_Pessoa_id integer,
    Data date,
    Presenca tinyint
);
 
ALTER TABLE Administrador ADD CONSTRAINT FK_Administrador_1
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE Professor ADD CONSTRAINT FK_Professor_1
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE Aluno ADD CONSTRAINT FK_Aluno_1
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE FazParte ADD CONSTRAINT FK_FazParte_0
    FOREIGN KEY (FK_Matéria_id)
    REFERENCES Matéria (id);
 
ALTER TABLE FazParte ADD CONSTRAINT FK_FazParte_1
    FOREIGN KEY (FK_Curso_id)
    REFERENCES Curso (id);
 
ALTER TABLE Matrícula ADD CONSTRAINT FK_Matrícula_0
    FOREIGN KEY (FK_Curso_id)
    REFERENCES Curso (id);
 
ALTER TABLE Matrícula ADD CONSTRAINT FK_Matrícula_1
    FOREIGN KEY (FK_Aluno_id, FK_Aluno_FK_Pessoa_id)
    REFERENCES Aluno (id, FK_Pessoa_id);
 
ALTER TABLE Avaliado ADD CONSTRAINT FK_Avaliado_0
    FOREIGN KEY (FK_Matéria_id)
    REFERENCES Matéria (id);
 
ALTER TABLE Avaliado ADD CONSTRAINT FK_Avaliado_1
    FOREIGN KEY (FK_Aluno_id, FK_Aluno_FK_Pessoa_id)
    REFERENCES Aluno (id, FK_Pessoa_id);
 
ALTER TABLE Frequenta ADD CONSTRAINT FK_Frequenta_0
    FOREIGN KEY (FK_Matéria_id)
    REFERENCES Matéria (id);
 
ALTER TABLE Frequenta ADD CONSTRAINT FK_Frequenta_1
    FOREIGN KEY (FK_Aluno_id, FK_Aluno_FK_Pessoa_id)
    REFERENCES Aluno (id, FK_Pessoa_id);