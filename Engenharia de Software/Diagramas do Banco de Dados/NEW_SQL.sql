/*
	*********************************
	* Author: Thiago Henrique Felix *
	* Data: 30/09/2017		          *
	* Hora: 10:53			              *
	* Version: 3.0			            *
	*********************************
*/


CREATE TABLE Pessoa (

    id integer,
    primeiroNome varchar(25) NOT NULL,
    sobrenome varchar(60) NOT NULL,
    nascimento char(10) NOT NULL,
    status varchar(10) NOT NULL,/* Ativado e Desativado */
    Estado varchar(2),
    Rua varchar(50),
    CEP varchar(9),
    Bairro varchar(50),
    Cidade varchar(60),
    numResidencia integer,
    senha varchar(20) NOT NULL,/* Maximo de carecteres permitidos sao 20 */
    sexo varchar(9) NOT NULL,/* Masculino e Feminino */
    cpf varchar(14),
    rg varchar(15),
    telefone varchar(14),
    email varchar(40) NOT NULL,
    foto varchar(255),

    CONSTRAINT Check_Status check (upper(status) in ('ATIVADO','DESATIVADO')),
    CONSTRAINT Check_Sexo check (upper(sexo) in ('MASCULINO', 'FEMININO') ),
    CONSTRAINT PK_Pessoa PRIMARY KEY (id)

);

CREATE TABLE Administrador (
    id integer,
    FK_Pessoa_id integer,

    CONSTRAINT PK_Administrador PRIMARY KEY (id)
);

CREATE TABLE Professor (
    id integer,
    Area_atuacao varchar(50),
    Informacoes_adicionais varchar(255),
    FK_Pessoa_id integer,

    CONSTRAINT PK_Professor PRIMARY KEY (id)
);

CREATE TABLE Aluno (
    id integer,
    Numero_Chamada integer,
    info_add varchar(255),
    FK_Pessoa_id integer,

    CONSTRAINT PK_Aluno PRIMARY KEY (id)
);

CREATE TABLE Curso (
    id integer,
    titulo varchar(60) not null,
    status varchar(12) not null,
    descricao varchar(250),

    CONSTRAINT CK_Curso check (upper(status) in ('ATIVADO','DESATIVADO')),
    CONSTRAINT PK_Curso PRIMARY KEY (id)
);

CREATE TABLE Materia (
  Titulo varchar(60) not null,
  Apresentacao varchar(250),
  Objetivo varchar(250),
  Ementa varchar(250),
  status varchar(12),
  id integer ,
  material varchar(250),
  bibliografia varchar(250),
  extraClasse varchar(250),

  CONSTRAINT CK_Materia check (upper(status) in ('ATIVADO','DESATIVADO')),
  CONSTRAINT PK_Materia PRIMARY KEY (id)
);


CREATE TABLE turma (
    id integer ,
    dataInicial date not null,
    status varchar(12) not null,
    infoAdd varchar(255),
    sala varchar(12),
    turno char(1) not null,
    horaInicial time not null,
    tempoAula time not null,
    titulo varchar(50) not null,
    diaSemana char(200) not null,
    quantDia integer not null,
    quantMaxAluno integer not null,
    quantMinAluno integer not null,
    professor integer not null,
    FK_Materia_id integer,

    CONSTRAINT CK_Turma check (upper(status) in ('ATIVADO','DESATIVADO')),
    CONSTRAINT PK_Turma PRIMARY KEY (id)

);

CREATE TABLE Atividade (
    id integer PRIMARY KEY,
    timeOpen timestamp,
    titulo varchar(50),
    text varchar(255),
    entrega varchar(255),
    timeKeep numeric(2,2),
    timeClose timestamp,
    FK_turma_id integer,
    status varchar(12)
);


CREATE TABLE Curso_materia (
    FK_Materia_id integer,
    FK_Curso_id integer
);

CREATE TABLE Matricula (
  FK_Curso_id integer,
  FK_Aluno_id integer,
  FK_Aluno_FK_Pessoa_id integer,
  status varchar(12),
  info_add varchar(255),
  data_hora timestamp,

    CONSTRAINT PK_Matricula PRIMARY KEY (FK_Curso_id, FK_Aluno_id)
);

CREATE TABLE Avaliado (
  FK_turma_id integer,
  FK_Aluno_id integer,
  FK_Aluno_FK_Pessoa_id integer,
  dataHora timestamp,
  Nota numeric(2,1),
  complemento varchar(255),
  numProva integer,
  FK_Materia_id integer,

    CONSTRAINT PK_Avaliado PRIMARY KEY (FK_Aluno_id, FK_turma_id, numProva)
);

CREATE TABLE Frequenta (
  FK_Aluno_id integer,
  FK_Aluno_FK_Pessoa_id integer,
  FK_turma_id integer,
  Presenca char(1),
  dataHora timestamp,
  FK_Materia_id integer,

    CONSTRAINT PK_Frequenta PRIMARY KEY (FK_turma_id, FK_Aluno_id)
);



CREATE TABLE sistem_log (
    id integer,
    data date,
    hora time,
    mensagem varchar(255),
    user_email varchar(50),
    id_pessoa integer,
    id_entidade integer,
    user_banco varchar(20),

    CONSTRAINT PK_Sistem_log PRIMARY KEY (id)
);

CREATE TABLE aluno_atividade (
    FK_Aluno_id integer,
    FK_Aluno_FK_Pessoa_id integer,
    FK_Atividade_id integer
);


CREATE TABLE history (
    id integer,
    data date,
    hora time,
    operacao varchar(20),
    banco_user varchar(20),

    CONSTRAINT PK_History PRIMARY KEY (id)
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
    FOREIGN KEY (FK_Aluno_id)
    REFERENCES Aluno (id);

ALTER TABLE Avaliado ADD CONSTRAINT FK_Avaliado_0
    FOREIGN KEY (FK_Materia_id)
    REFERENCES Materia (id);

ALTER TABLE Avaliado ADD CONSTRAINT FK_Avaliado_1
    FOREIGN KEY (FK_Aluno_id)
    REFERENCES Aluno (id);

ALTER TABLE Frequenta ADD CONSTRAINT FK_Frequenta_0
    FOREIGN KEY (FK_Materia_id)
    REFERENCES Materia (id);

ALTER TABLE Frequenta ADD CONSTRAINT FK_Frequenta_1
    FOREIGN KEY (FK_Aluno_id)
    REFERENCES Aluno (id);


/*======================================================================*/
 /* Criação de GENERATOR */


CREATE GENERATOR GN_PESSOA;
CREATE GENERATOR GN_ADMINISTRADOR;
CREATE GENERATOR GN_ALUNO;
CREATE GENERATOR GN_PROFESSOR;
CREATE GENERATOR GN_CURSO;
CREATE GENERATOR GN_MATERIA;
CREATE GENERATOR GN_MATRICULA;
CREATE GENERATOR GN_CURSO_MATERIA;
CREATE GENERATOR GN_SISTEM_LOG;
CREATE GENERATOR GN_HISTORY;
CREATE GENERATOR GN_AVALIADO;
CREATE GENERATOR GN_FREQUENTA;
CREATE GENERATOR GN_AUDIT_FREQUEN;
CREATE GENERATOR GN_AUDIT_MATRI;
CREATE GENERATOR GN_AUDIT_AVALI;
CREATE GENERATOR GN_TURMA;
CREATE GENERATOR GN_ATIVIDADE;


/*======================================================================*/
/* PESSOA */


SET TERM^;

CREATE TRIGGER TR_PESSOA FOR PESSOA
ACTIVE
BEFORE INSERT OR UPDATE OR DELETE
AS
BEGIN

    IF(INSERTING) THEN BEGIN

        IF(NEW.ID IS NULL) THEN BEGIN
            NEW.ID = GEN_ID(GN_PESSOA,1);
        END

        INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'INSERT',
         CURRENT_USER
        );

    END

    IF(DELETING) THEN BEGIN

         INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'DELETE',
         CURRENT_USER
        );

    END

    IF(UPDATING) THEN BEGIN

         INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'UPDATE',
         CURRENT_USER
        );

    END

END^

SET TERM;^

/*======================================================================*/
/* Turma */

SET TERM^;

CREATE TRIGGER TR_TURMA FOR TURMA
ACTIVE
BEFORE INSERT OR UPDATE OR DELETE
AS
BEGIN

    IF(INSERTING) THEN BEGIN

         IF(NEW.ID IS NULL) THEN BEGIN
            NEW.ID = GEN_ID(GN_TURMA,1);
        END

           INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'INSERT',
         CURRENT_USER
        );

    END

    IF(DELETING) THEN BEGIN

           INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'DELETE',
         CURRENT_USER
        );

    END

    IF(UPDATING) THEN BEGIN

           INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'UPDATE',
         CURRENT_USER
        );

    END

END^

SET TERM;^

/*======================================================================*/
/* Atividade */

SET TERM^;

CREATE TRIGGER TR_ATIVIDADE FOR ATIVIDADE
ACTIVE
BEFORE INSERT OR UPDATE OR DELETE
AS
BEGIN

    IF(INSERTING) THEN BEGIN

         IF(NEW.ID IS NULL) THEN BEGIN
            NEW.ID = GEN_ID(GN_ATIVIDADE,1);
        END

           INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'INSERT',
         CURRENT_USER
        );

    END

    IF(DELETING) THEN BEGIN

           INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'DELETE',
         CURRENT_USER
        );

    END

    IF(UPDATING) THEN BEGIN

           INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'UPDATE',
         CURRENT_USER
        );

    END

END^

SET TERM;^
/*======================================================================*/
/* ADMINISTRADOR */

SET TERM^;

CREATE TRIGGER TR_ADMINISTRADOR FOR ADMINISTRADOR
ACTIVE
BEFORE INSERT OR UPDATE OR DELETE
AS
BEGIN

    IF(INSERTING) THEN BEGIN

         IF(NEW.ID IS NULL) THEN BEGIN
            NEW.ID = GEN_ID(GN_ADMINISTRADOR,1);
        END

           INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'INSERT',
         CURRENT_USER
        );

    END

    IF(DELETING) THEN BEGIN

           INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'DELETE',
         CURRENT_USER
        );

    END

    IF(UPDATING) THEN BEGIN

           INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'UPDATE',
         CURRENT_USER
        );

    END

END^

SET TERM;^

/*======================================================================*/
/* PROFESSOR */

SET TERM^;

CREATE TRIGGER TR_PROFESSOR FOR PROFESSOR
ACTIVE
BEFORE INSERT OR UPDATE OR DELETE
AS
BEGIN

    IF(INSERTING) THEN BEGIN
         IF(NEW.ID IS NULL) THEN BEGIN
            NEW.ID = GEN_ID(GN_PROFESSOR,1);
        END


          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'INSERT',
         CURRENT_USER
        );
    END

    IF(DELETING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'DELETE',
         CURRENT_USER
        );

    END

    IF(UPDATING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'UPDATE',
         CURRENT_USER
        );

    END

END^

SET TERM;^

/*======================================================================*/
/* ALUNO */

SET TERM^;

CREATE TRIGGER TR_ALUNO FOR ALUNO
ACTIVE
BEFORE INSERT OR UPDATE OR DELETE
AS
BEGIN

    IF(INSERTING) THEN BEGIN
         IF(NEW.ID IS NULL) THEN BEGIN
            NEW.ID = GEN_ID(GN_ALUNO,1);
        END


          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'INSERT',
         CURRENT_USER
        );
    END

    IF(DELETING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'DELETE',
         CURRENT_USER
        );

    END

    IF(UPDATING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'UPDATE',
         CURRENT_USER
        );

    END

END^

SET TERM;^

/*======================================================================*/
/* MATRICULA */

SET TERM^;

CREATE TRIGGER TR_MATRICULA FOR MATRICULA
ACTIVE
BEFORE INSERT OR UPDATE OR DELETE
AS
BEGIN

    IF(INSERTING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'INSERT',
         CURRENT_USER
        );

    END

    IF(DELETING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'DELETE',
         CURRENT_USER
        );

    END

    IF(UPDATING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'UPDATE',
         CURRENT_USER
        );

    END

END^

SET TERM;^

/*======================================================================*/
/* CURSO */

SET TERM^;

CREATE TRIGGER TR_CURSO FOR CURSO
ACTIVE
BEFORE INSERT OR UPDATE OR DELETE
AS
BEGIN

    IF(INSERTING) THEN BEGIN
         IF(NEW.ID IS NULL) THEN BEGIN
            NEW.ID = GEN_ID(GN_CURSO,1);
        END


          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'INSERT',
         CURRENT_USER
        );

    END

    IF(DELETING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'DELETE',
         CURRENT_USER
        );

    END

    IF(UPDATING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'UPDATE',
         CURRENT_USER
        );

    END

END^

SET TERM;^

/*======================================================================*/
/* CURSO_MATERIA */

SET TERM^;

CREATE TRIGGER TR_CURSO_MATERIA FOR CURSO_MATERIA
ACTIVE
BEFORE INSERT OR UPDATE OR DELETE
AS
BEGIN

    IF(INSERTING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'INSERT',
         CURRENT_USER
        );

    END

    IF(DELETING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'DELETE',
         CURRENT_USER
        );

    END

    IF(UPDATING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'UPDATE',
         CURRENT_USER
        );

    END

END^

SET TERM;^

/*======================================================================*/
/* MATERIA */

SET TERM^;

CREATE TRIGGER TR_MATERIA FOR MATERIA
ACTIVE
BEFORE INSERT OR UPDATE OR DELETE
AS
BEGIN

    IF(INSERTING) THEN BEGIN
         IF(NEW.ID IS NULL) THEN BEGIN
            NEW.ID = GEN_ID(GN_MATERIA,1);
        END


          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'INSERT',
         CURRENT_USER
        );

    END

    IF(DELETING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'DELETE',
         CURRENT_USER
        );

    END

    IF(UPDATING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'UPDATE',
         CURRENT_USER
        );

    END

END^

SET TERM;^

/*======================================================================*/
/* FREQUENTA */

SET TERM^;

CREATE TRIGGER TR_FREQUENTA FOR FREQUENTA
ACTIVE
BEFORE INSERT OR UPDATE OR DELETE
AS
BEGIN

    IF(INSERTING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'INSERT',
         CURRENT_USER
        );

    END

    IF(DELETING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'DELETE',
         CURRENT_USER
        );

    END

    IF(UPDATING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'UPDATE',
         CURRENT_USER
        );

    END

END^

SET TERM;^

/*======================================================================*/
/* AVALIADO */

SET TERM^;

CREATE TRIGGER TR_AVALIADO FOR AVALIADO
ACTIVE
BEFORE INSERT OR UPDATE OR DELETE
AS
BEGIN

    IF(INSERTING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'INSERT',
         CURRENT_USER
        );

    END

    IF(DELETING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'DELETE',
         CURRENT_USER
        );

    END

    IF(UPDATING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'UPDATE',
         CURRENT_USER
        );

    END

END^

SET TERM;^

/*======================================================================*/
/* SISTEM_LOG */

SET TERM^;

CREATE TRIGGER TR_SISLTEM_LOG FOR SISTEM_LOG
ACTIVE
BEFORE INSERT OR UPDATE OR DELETE
AS
BEGIN

    IF(INSERTING) THEN BEGIN

        /* TABLE'S INSERT */
        NEW.DATA = CURRENT_DATE;
        NEW.HORA = CURRENT_TIME;
        NEW.ID = GEN_ID(GN_SISTEM_LOG,1);
        NEW.USER_BANCO = CURRENT_USER;

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'INSERT',
         CURRENT_USER
        );

    END

    IF(DELETING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'DELETE',
         CURRENT_USER
        );

    END

    IF(UPDATING) THEN BEGIN

          INSERT INTO HISTORY VALUES(
         GEN_ID(GN_HISTORY,1),
         CURRENT_DATE,
         CURRENT_TIME,
         'UPDATE',
         CURRENT_USER
        );

    END

END^

SET TERM;^

/*======================================================================*/
