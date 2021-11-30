/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     30/11/2021 11:36:58                          */
/*==============================================================*/


alter table LOMBA 
   drop foreign key FK_LOMBA_AMBIL_LOM_PESERTA;

alter table PERGURUAN_TINGGI 
   drop foreign key FK_PERGURUA_MENGADAKA_LOMBA;

drop table if exists ADMIN;


alter table LOMBA 
   drop foreign key FK_LOMBA_AMBIL_LOM_PESERTA;

drop table if exists LOMBA;


alter table PERGURUAN_TINGGI 
   drop foreign key FK_PERGURUA_MENGADAKA_LOMBA;

drop table if exists PERGURUAN_TINGGI;

drop table if exists PESERTA;

/*==============================================================*/
/* Table: ADMIN                                                 */
/*==============================================================*/
create table ADMIN
(
   USERNAME             varchar(20) not null  comment '',
   PASSWORD             varchar(20) not null  comment '',
   primary key (USERNAME)
);

/*==============================================================*/
/* Table: LOMBA                                                 */
/*==============================================================*/
create table LOMBA
(
   NAMA_LOMBA           varchar(30) not null  comment '',
   NAMA                 varchar(20)  comment '',
   JENIS_LOMBA          varchar(30) not null  comment '',
   TINGKAT_LOMBA        varchar(30) not null  comment '',
   HADIAH               int not null  comment '',
   SERTIFIKAT           varchar(20) not null  comment '',
   ID_LOMBA             int not null auto_increment  comment '',
   ID_PESERTA           int  comment '',
   primary key (ID_LOMBA)
);

/*==============================================================*/
/* Table: PERGURUAN_TINGGI                                      */
/*==============================================================*/
create table PERGURUAN_TINGGI
(
   NAMA_PERGURUAN       varchar(20) not null  comment '',
   NAMA_LOMBA           varchar(30)  comment '',
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

alter table LOMBA add constraint FK_LOMBA_AMBIL_LOM_PESERTA foreign key (ID_PESERTA)
      references PESERTA (ID_PESERTA) on delete restrict on update restrict;

alter table PERGURUAN_TINGGI add constraint FK_PERGURUA_MENGADAKA_LOMBA foreign key (ID_LOMBA)
      references LOMBA (ID_LOMBA) on delete restrict on update restrict;

