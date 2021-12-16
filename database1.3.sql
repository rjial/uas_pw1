/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     16/12/2021 15:48:57                          */
/*==============================================================*/


/*==============================================================*/
/* Table: AMBIL_LOMBA                                           */
/*==============================================================*/
create table AMBIL_LOMBA
(
   ID_PESERTA           int not null auto_increment  comment '',
   ID_LOMBA             int not null  comment '',
   primary key (ID_PESERTA, ID_LOMBA)
);

/*==============================================================*/
/* Table: LOMBA                                                 */
/*==============================================================*/
create table LOMBA
(
   NAMA_LOMBA           varchar(100) not null  comment '',
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
   ID_USER              int not null  comment '',
   primary key (ID_PESERTA)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   ID_USER              int not null auto_increment  comment '',
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
   ID_LEVEL             int not null auto_increment  comment '',
   NAMA_LEVEL           varchar(40) not null  comment '',
   primary key (ID_LEVEL)
);

alter table AMBIL_LOMBA add constraint FK_AMBIL_LO_AMBIL_LOM_PESERTA foreign key (ID_PESERTA)
      references PESERTA (ID_PESERTA) on delete restrict on update restrict;

alter table AMBIL_LOMBA add constraint FK_AMBIL_LO_AMBIL_LOM_LOMBA foreign key (ID_LOMBA)
      references LOMBA (ID_LOMBA) on delete restrict on update restrict;

alter table LOMBA add constraint FK_LOMBA_MENGADAKA_PERGURUA foreign key (ID_PERGURUAN_TINGGI)
      references PERGURUAN_TINGGI (ID_PERGURUAN_TINGGI) on delete restrict on update restrict;

alter table PESERTA add constraint FK_PESERTA_RELATIONS_USER foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table USER add constraint FK_USER_RELATIONS_USER_LEV foreign key (ID_LEVEL)
      references USER_LEVEL (ID_LEVEL) on delete restrict on update restrict;

