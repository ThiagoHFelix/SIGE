/* Em constru��o: */

CREATE TABLE Pessoa (
    id integer PRIMARY KEY
    primeiroNome varchar(25)
    sobrenome varchar(60)
    nascimento date
    status varchar(10)
    senha varchar(20)
    sexo varchar(9)
    cpf varchar(14)
    rg varchar(15)
    foto varchar(50)
    Estado varchar(2)
    Rua varchar(50)
    CEP varchar(9)
    Cidade varchar(50)
    Bairro varchar(50)
    Area_atuacao varchar(50)
    Pessoa_TIPO varchar(25)
    FK_Curso_id integer
    status_matricula varchar(10)
    info_matricula varchar(255)
    hora_matricula time
    data_matricula date,
);

CREATE TABLE Curso (
    titulo varchar(60)
    status varchar(10)
    id integer PRIMARY KEY
    descricao varchar(250)
    FK_Materia_id integer
    Data date
    Hora time
    FK_Turno_id integer,
);

CREATE TABLE Materia (
    Titulo varchar(60)
    Apresentacao varchar(250)
    Objetivo varchar(250)
    Ementa varchar(250)
    status varchar(10)
    id integer PRIMARY KEY
    material varchar(250)
    bibliografia varchar(250)
    extraClasse varchar(250),
);

CREATE TABLE turma (
    id integer PRIMARY KEY
    dataInicial date
    status varchar(10)
    infoAdd varchar(255)
    sala varchar(12)
    horaInicial time
    tempoAula time
    titulo varchar(50)
    quantDia integer
    quantMaxAluno integer
    quantMinAluno integer
    FK_Materia_id integer
    FK_Pessoa_id integer
    FK_Turno_id integer,
);

CREATE TABLE Aviso (
    titulo varchar(25)
    mensagem varchar(255)
    hora time
    data date
    id integer PRIMARY KEY,
);

CREATE TABLE Dia_semana (
    titulo varcha(25)
    id integer PRIMARY KEY
    horainicio time
    quantaula int,
);

CREATE TABLE Turno (
    id integer PRIMARY KEY
    titulo varchar(25),
);

CREATE TABLE Telefone (
    numero varchar(20)
    Tipo varchar(20)
    FK_Pessoa_id integer,
);

CREATE TABLE Email (
    email varchar(30)
    tipo varchar(20)
    FK_Pessoa_id integer,
);

CREATE TABLE Area (
    id integer PRIMARY KEY
    titulo varchar(100),
);

CREATE TABLE Avaliado (
    FK_turma_id integer,
    FK_Pessoa_id integer,
    dataHora timestamp,
    Nota numeric(2,1),
    numProva,
    complemento varchar(255),
    PRIMARY KEY (numProva, FK_Pessoa_id, FK_turma_id)
);

CREATE TABLE Frequenta_aula (
    FK_Pessoa_id integer,
    FK_turma_id integer,
    Presenca char(1),
    data date,
    hora time,
    Assunto_aula varchar(50),
    dia_semana varchar(25),
    PRIMARY KEY (FK_turma_id, FK_Pessoa_id)
);

CREATE TABLE Aviso_pessoa (
    FK_Pessoa_id integer,
    FK_Aviso_id integer,
    PRIMARY KEY (FK_Pessoa_id, FK_Aviso_id)
);

CREATE TABLE dia_turma (
    FK_Dia_semana_id integer,
    FK_turma_id integer,
    PRIMARY KEY (FK_turma_id, FK_Dia_semana_id)
);

CREATE TABLE Atividade (
    FK_turma_id integer,
    FK_Pessoa_id integer,
    timeKeep time,
    status varchar(10),
    timeClose time,
    text varchar(255),
    titulo varchar(50),
    timeOpen time,
    entrega varchar(255),
    PRIMARY KEY (FK_Pessoa_id, FK_turma_id)
);

CREATE TABLE matricula_turma (
    FK_turma_id integer,
    FK_Pessoa_id integer,
    infoAdd varchar(255),
    status varchar(10),
    data date,
    hora time,
    PRIMARY KEY (FK_Pessoa_id, FK_turma_id)
);

CREATE TABLE area_materia (
    FK_Materia_id integer,
    FK_Area_id integer,
    PRIMARY KEY (FK_Area_id, FK_Materia_id)
);
 
ALTER TABLE Pessoa ADD CONSTRAINT FK_Pessoa_1
    FOREIGN KEY (FK_Curso_id)
    REFERENCES Curso (id);
 
ALTER TABLE Curso ADD CONSTRAINT FK_Curso_1
    FOREIGN KEY (FK_Materia_id)
    REFERENCES Materia (id);
 
ALTER TABLE Curso ADD CONSTRAINT FK_Curso_2
    FOREIGN KEY (FK_Turno_id)
    REFERENCES Turno (id);
 
ALTER TABLE turma ADD CONSTRAINT FK_turma_1
    FOREIGN KEY (FK_Materia_id)
    REFERENCES Materia (id);
 
ALTER TABLE turma ADD CONSTRAINT FK_turma_2
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE turma ADD CONSTRAINT FK_turma_3
    FOREIGN KEY (FK_Turno_id)
    REFERENCES Turno (id);
 
ALTER TABLE Telefone ADD CONSTRAINT FK_Telefone_0
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE Email ADD CONSTRAINT FK_Email_0
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE Avaliado ADD CONSTRAINT FK_Avaliado_1
    FOREIGN KEY (FK_turma_id)
    REFERENCES turma (id);
 
ALTER TABLE Avaliado ADD CONSTRAINT FK_Avaliado_2
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE Frequenta_aula ADD CONSTRAINT FK_Frequenta_aula_0
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE Frequenta_aula ADD CONSTRAINT FK_Frequenta_aula_1
    FOREIGN KEY (FK_turma_id)
    REFERENCES turma (id);
 
ALTER TABLE Aviso_pessoa ADD CONSTRAINT FK_Aviso_pessoa_0
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE Aviso_pessoa ADD CONSTRAINT FK_Aviso_pessoa_1
    FOREIGN KEY (FK_Aviso_id)
    REFERENCES Aviso (id);
 
ALTER TABLE dia_turma ADD CONSTRAINT FK_dia_turma_0
    FOREIGN KEY (FK_Dia_semana_id)
    REFERENCES Dia_semana (id);
 
ALTER TABLE dia_turma ADD CONSTRAINT FK_dia_turma_1
    FOREIGN KEY (FK_turma_id)
    REFERENCES turma (id);
 
ALTER TABLE Atividade ADD CONSTRAINT FK_Atividade_0
    FOREIGN KEY (FK_turma_id)
    REFERENCES turma (id);
 
ALTER TABLE Atividade ADD CONSTRAINT FK_Atividade_1
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE matricula_turma ADD CONSTRAINT FK_matricula_turma_0
    FOREIGN KEY (FK_turma_id)
    REFERENCES turma (id);
 
ALTER TABLE matricula_turma ADD CONSTRAINT FK_matricula_turma_1
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE area_materia ADD CONSTRAINT FK_area_materia_0
    FOREIGN KEY (FK_Materia_id)
    REFERENCES Materia (id);
 
ALTER TABLE area_materia ADD CONSTRAINT FK_area_materia_1
    FOREIGN KEY (FK_Area_id)
    REFERENCES Area (id);