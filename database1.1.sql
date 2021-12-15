/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     15/12/2021 11:50:04                          */
/*==============================================================*/


alter table AMBIL_LOMBA 
   drop foreign key FK_AMBIL_LO_AMBIL_LOM_PESERTA;

alter table AMBIL_LOMBA 
   drop foreign key FK_AMBIL_LO_AMBIL_LOM_LOMBA;

alter table LOMBA 
   drop foreign key FK_LOMBA_RELATIONS_PERGURUA;

alter table PESERTA 
   drop foreign key FK_PESERTA_RELATIONS_USER;

alter table USER 
   drop foreign key FK_USER_RELATIONS_USER_LEV;


alter table AMBIL_LOMBA 
   drop foreign key FK_AMBIL_LO_AMBIL_LOM_PESERTA;

alter table AMBIL_LOMBA 
   drop foreign key FK_AMBIL_LO_AMBIL_LOM_LOMBA;

drop table if exists AMBIL_LOMBA;


alter table LOMBA 
   drop foreign key FK_LOMBA_RELATIONS_PERGURUA;

drop table if exists LOMBA;

drop table if exists PERGURUAN_TINGGI;


alter table PESERTA 
   drop foreign key FK_PESERTA_RELATIONS_USER;

drop table if exists PESERTA;


alter table USER 
   drop foreign key FK_USER_RELATIONS_USER_LEV;

drop table if exists USER;

drop table if exists USER_LEVEL;

/*==============================================================*/
/* Table: AMBIL_LOMBA                                           */
/*==============================================================*/
create table AMBIL_LOMBA
(
   ID_PESERTA           int not null  comment '',
   ID_LOMBA             int not null  comment '',
   primary key (ID_PESERTA, ID_LOMBA)
);

/*==============================================================*/
/* Table: LOMBA                                                 */
/*==============================================================*/
create table LOMBA
(
   NAMA_LOMBA           varchar(30) not null  comment '',
   JENIS_LOMBA          varchar(30) not null  comment '',
   TINGKAT_LOMBA        varchar(30) not null  comment '',
   HADIAH               int not null  comment '',
   SERTIFIKAT           varchar(20) not null  comment '',
   ID_LOMBA             int not null auto_increment  comment '',
   ID_PERGURUAN_TINGGI  int  comment '',
   primary key (ID_LOMBA)
);

/*==============================================================*/
/* Table: PERGURUAN_TINGGI                                      */
/*==============================================================*/
create table PERGURUAN_TINGGI
(
   NAMA_PERGURUAN       varchar(20) not null  comment '',
   ALAMAT               text not null  comment '',
   AKREDITAS            varchar(5) not null  comment '',
   ID_PERGURUAN_TINGGI  int not null auto_increment  comment '',
   primary key (ID_PERGURUAN_TINGGI)
);

/*==============================================================*/
/* Table: PESERTA                                               */
/*==============================================================*/
create table PESERTA
(
   NAMA                 varchar(20) not null  comment '',
   KELAS                varchar(15) not null  comment '',
   ASAL                 varchar(30) not null  comment '',
   JENIS_KELAMIN        char(1) not null  comment '',
   JURUSAN              varchar(20) not null  comment '',
   ALAMAR               text not null  comment '',
   ID_PESERTA           int not null auto_increment  comment '',
   ID_USER              int  comment '',
   primary key (ID_PESERTA)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   ID_USER              int not null  comment '',
   ID_LEVEL             int  comment '',
   USERNAME             varchar(20) not null  comment '',
   PASSWORD             varchar(40) not null  comment '',
   primary key (ID_USER)
);

/*==============================================================*/
/* Table: USER_LEVEL                                            */
/*==============================================================*/
create table USER_LEVEL
(
   ID_LEVEL             int not null  comment '',
   NAMA_LEVEL           varchar(40) not null  comment '',
   primary key (ID_LEVEL)
);

alter table AMBIL_LOMBA add constraint FK_AMBIL_LO_AMBIL_LOM_PESERTA foreign key (ID_PESERTA)
      references PESERTA (ID_PESERTA) on delete restrict on update restrict;

alter table AMBIL_LOMBA add constraint FK_AMBIL_LO_AMBIL_LOM_LOMBA foreign key (ID_LOMBA)
      references LOMBA (ID_LOMBA) on delete restrict on update restrict;

alter table LOMBA add constraint FK_LOMBA_RELATIONS_PERGURUA foreign key (ID_PERGURUAN_TINGGI)
      references PERGURUAN_TINGGI (ID_PERGURUAN_TINGGI) on delete restrict on update restrict;

alter table PESERTA add constraint FK_PESERTA_RELATIONS_USER foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table USER add constraint FK_USER_RELATIONS_USER_LEV foreign key (ID_LEVEL)
      references USER_LEVEL (ID_LEVEL) on delete restrict on update restrict;

