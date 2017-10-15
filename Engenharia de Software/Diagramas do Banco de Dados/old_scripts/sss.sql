/* Em construção: */

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
    Pessoa_TIPO varchar(13),
);

CREATE TABLE Curso (
    titulo varchar(60)
    status varchar(10)
    id integer PRIMARY KEY
    descricao varchar(250),
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
    id integer PRIMARY KEY,
);

CREATE TABLE Turno (
    id integer PRIMARY KEY
    titulo varchar(25),
);

CREATE TABLE Telefone (
    numero varchar(20),
    Tipo varchar(20),
    FK_Pessoa_id integer,
    PRIMARY KEY (FK_Pessoa_id, numero)
);

CREATE TABLE Email (
    email varchar(30),
    tipo varchar(20),
    FK_Pessoa_id integer,
    PRIMARY KEY (FK_Pessoa_id, email)
);

CREATE TABLE Curso_materia (
    FK_Materia_id integer,
    FK_Curso_id integer,
    PRIMARY KEY (FK_Curso_id, FK_Materia_id)
);

CREATE TABLE Matricula (
    FK_Curso_id integer,
    FK_Pessoa_id integer,
    status varchar(10),
    info_add varchar(255),
    data_hora timestamp,
    PRIMARY KEY (FK_Pessoa_id, FK_Curso_id)
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

CREATE TABLE Frequenta (
    FK_Pessoa_id integer
    FK_turma_id integer
    Presenca char(1)
    data date
    hora time,
);

CREATE TABLE Aviso_adm (
    FK_Aviso_id integer,
    FK_Pessoa_id integer,
    PRIMARY KEY (FK_Pessoa_id, FK_Aviso_id)
);

CREATE TABLE Aviso_pro (
    FK_Pessoa_id integer,
    FK_Aviso_id integer,
    PRIMARY KEY (FK_Aviso_id, FK_Pessoa_id)
);

CREATE TABLE Aviso_alu (
    FK_Aviso_id integer,
    FK_Pessoa_id integer,
    PRIMARY KEY (FK_Pessoa_id, FK_Aviso_id)
);

CREATE TABLE dia_turma (
    FK_turma_id integer,
    FK_Dia_semana_id integer,
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
    PRIMARY KEY (FK_turma_id, FK_Pessoa_id)
);
 
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
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE Avaliado ADD CONSTRAINT FK_Avaliado_1
    FOREIGN KEY (FK_turma_id)
    REFERENCES turma (id);
 
ALTER TABLE Avaliado ADD CONSTRAINT FK_Avaliado_2
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE Frequenta ADD CONSTRAINT FK_Frequenta_0
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE Frequenta ADD CONSTRAINT FK_Frequenta_1
    FOREIGN KEY (FK_turma_id)
    REFERENCES turma (id);
 
ALTER TABLE Aviso_adm ADD CONSTRAINT FK_Aviso_adm_0
    FOREIGN KEY (FK_Aviso_id)
    REFERENCES Aviso (id);
 
ALTER TABLE Aviso_adm ADD CONSTRAINT FK_Aviso_adm_1
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE Aviso_pro ADD CONSTRAINT FK_Aviso_pro_0
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE Aviso_pro ADD CONSTRAINT FK_Aviso_pro_1
    FOREIGN KEY (FK_Aviso_id)
    REFERENCES Aviso (id);
 
ALTER TABLE Aviso_alu ADD CONSTRAINT FK_Aviso_alu_0
    FOREIGN KEY (FK_Aviso_id)
    REFERENCES Aviso (id);
 
ALTER TABLE Aviso_alu ADD CONSTRAINT FK_Aviso_alu_1
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);
 
ALTER TABLE dia_turma ADD CONSTRAINT FK_dia_turma_0
    FOREIGN KEY (FK_turma_id)
    REFERENCES turma (id);
 
ALTER TABLE dia_turma ADD CONSTRAINT FK_dia_turma_1
    FOREIGN KEY (FK_Dia_semana_id)
    REFERENCES Dia_semana (id);
 
ALTER TABLE Atividade ADD CONSTRAINT FK_Atividade_0
    FOREIGN KEY (FK_turma_id)
    REFERENCES turma (id);
 
ALTER TABLE Atividade ADD CONSTRAINT FK_Atividade_1
    FOREIGN KEY (FK_Pessoa_id)
    REFERENCES Pessoa (id);