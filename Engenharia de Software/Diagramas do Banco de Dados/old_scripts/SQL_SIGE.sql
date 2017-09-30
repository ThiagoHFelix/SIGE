/*
	*********************************
	* Author: Thiago Henrique Felix *
	* Data: 29/09/2017		          *
	* Hora: 17:31			              *
	* Version: 2.0			            *
	*********************************
*/

CREATE TABLE Pessoa (
    id integer PRIMARY KEY
    primeiroNome varchar(25)
    sobrenome varchar(60)
    nascimento date
    status tinyint
    Estado char(2)
    Rua varchar(50)
    CEP char(9)
    Bairro varchar(50)
    Cidade varchar(60)
    numResidencia integer
    senha varchar(50)
    sexo tinyint
    cpf char(14)
    rg varchar(15)
    telefone varchar(14)
    email varchar(40)
    foto varchar(50)
    celular varchar(14)
    estado_civil varchar(20),
);

CREATE TABLE Administrador (
    id integer,
    FK_Pessoa_id integer,
    PRIMARY KEY (id, FK_Pessoa_id)
);

CREATE TABLE Professor (
    id integer,
    Area_atuacao varchar(50),
    infoAdd varchar(255),
    FK_Pessoa_id integer,
    PRIMARY KEY (id, FK_Pessoa_id)
);

CREATE TABLE Aluno (
    id integer,
    Numero_Chamada integer,
    info_add varchar(255),
    FK_Pessoa_id integer,
    PRIMARY KEY (id, FK_Pessoa_id)
);

CREATE TABLE Curso (
    titulo varchar(60)
    status varchar(12)
    id integer PRIMARY KEY
    descricao varchar(250),
);

CREATE TABLE Materia (
    Titulo varchar(60)
    Apresentacao varchar(250)
    Objetivo varchar(250)
    Ementa varchar(250)
    status varchar(12)
    id integer PRIMARY KEY
    material varchar(250)
    bibliografia varchar(250)
    extraClasse varchar(250),
);

CREATE TABLE turma (
    id integer PRIMARY KEY
    dataInicial date
    status varchar(12)
    infoAdd varchar(255)
    sala varchar(12)
    turno char(1)
    horaInicial time
    tempoAula time
    titulo varchar(50)
    diaSemana char(20)
    quantDia integer
    quantMaxAluno integer
    quantMinAluno integer
    professor integer
    FK_Materia_id integer,
);

CREATE TABLE Atividade (
    id integer PRIMARY KEY
    timeOpen timestamp
    titulo varchar(50)
    text varchar(255)
    entrega varchar(255)
    timeKeep numeric(2,2)
    timeClose timestamp
    FK_turma_id integer
    status varchar(12),
);

CREATE TABLE Curso_materia (
    FK_Materia_id integer
    FK_Curso_id integer,
);

CREATE TABLE Matricula (
    FK_Curso_id integer
    FK_Aluno_id integer
    FK_Aluno_FK_Pessoa_id integer
    status varchar(12)
    info_add varchar(255)
    data_hora timestamp,
);

CREATE TABLE Avaliado (
    FK_turma_id integer
    FK_Aluno_id integer
    FK_Aluno_FK_Pessoa_id integer
    dataHora timestamp
    Nota numeric(2,1)
    complemento varchar(255)
    numProva PRIMARY KEY,
);

CREATE TABLE Frequenta (
    FK_Aluno_id integer
    FK_Aluno_FK_Pessoa_id integer
    FK_turma_id integer
    Presenca char(1)
    dataHora timestamp,
);

CREATE TABLE aluno_atividade (
    FK_Aluno_id integer
    FK_Aluno_FK_Pessoa_id integer
    FK_Atividade_id integer,
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

ALTER TABLE turma ADD CONSTRAINT FK_turma_1
    FOREIGN KEY (FK_Materia_id)
    REFERENCES Materia (id);

ALTER TABLE Atividade ADD CONSTRAINT FK_Atividade_1
    FOREIGN KEY (FK_turma_id)
    REFERENCES turma (id);

ALTER TABLE Curso_materia ADD CONSTRAINT FK_Curso_materia_0
    FOREIGN KEY (FK_Materia_id)
    REFERENCES Materia (id);

ALTER TABLE Curso_materia ADD CONSTRAINT FK_Curso_materia_1
    FOREIGN KEY (FK_Curso_id)
    REFERENCES Curso (id);

ALTER TABLE Matricula ADD CONSTRAINT FK_Matricula_0
    FOREIGN KEY (FK_Curso_id)
    REFERENCES Curso (id);

ALTER TABLE Matricula ADD CONSTRAINT FK_Matricula_1
    FOREIGN KEY (FK_Aluno_id, FK_Aluno_FK_Pessoa_id)
    REFERENCES Aluno (id, FK_Pessoa_id);

ALTER TABLE Avaliado ADD CONSTRAINT FK_Avaliado_1
    FOREIGN KEY (FK_turma_id)
    REFERENCES turma (id);

ALTER TABLE Avaliado ADD CONSTRAINT FK_Avaliado_2
    FOREIGN KEY (FK_Aluno_id, FK_Aluno_FK_Pessoa_id)
    REFERENCES Aluno (id, FK_Pessoa_id);

ALTER TABLE Frequenta ADD CONSTRAINT FK_Frequenta_0
    FOREIGN KEY (FK_Aluno_id, FK_Aluno_FK_Pessoa_id)
    REFERENCES Aluno (id, FK_Pessoa_id);

ALTER TABLE Frequenta ADD CONSTRAINT FK_Frequenta_1
    FOREIGN KEY (FK_turma_id)
    REFERENCES turma (id);

ALTER TABLE aluno_atividade ADD CONSTRAINT FK_aluno_atividade_0
    FOREIGN KEY (FK_Aluno_id, FK_Aluno_FK_Pessoa_id)
    REFERENCES Aluno (id, FK_Pessoa_id);

ALTER TABLE aluno_atividade ADD CONSTRAINT FK_aluno_atividade_1
    FOREIGN KEY (FK_Atividade_id)
    REFERENCES Atividade (id);
