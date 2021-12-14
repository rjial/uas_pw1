/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     14/12/2021 12:29:45                          */
/*==============================================================*/


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
/* Table: JENIS_USER                                            */
/*==============================================================*/
create table JENIS_USER
(
   ID_LEVEL             int not null  comment '',
   NAMA_LEVEL           varchar(50) not null  comment '',
   primary key (ID_LEVEL)
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
   ID_LOMBA             int  comment '',
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
   primary key (ID_PESERTA)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   ID_USER              int not null  comment '',
   ID_LEVEL             int  comment '',
   ID_USERNAME          int not null  comment '',
   PASSWORD             varchar(40) not null  comment '',
   primary key (ID_USER)
);

alter table AMBIL_LOMBA add constraint FK_AMBIL_LO_AMBIL_LOM_PESERTA foreign key (ID_PESERTA)
      references PESERTA (ID_PESERTA) on delete restrict on update restrict;

alter table AMBIL_LOMBA add constraint FK_AMBIL_LO_AMBIL_LOM_LOMBA foreign key (ID_LOMBA)
      references LOMBA (ID_LOMBA) on delete restrict on update restrict;

alter table PERGURUAN_TINGGI add constraint FK_PERGURUA_MENGADAKA_LOMBA foreign key (ID_LOMBA)
      references LOMBA (ID_LOMBA) on delete restrict on update restrict;

alter table USER add constraint FK_USER_RELATIONS_JENIS_US foreign key (ID_LEVEL)
      references JENIS_USER (ID_LEVEL) on delete restrict on update restrict;

