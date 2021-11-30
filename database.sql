/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     30/11/2021 09:36:52                          */
/*==============================================================*/


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
   primary key (NAMA_LOMBA)
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
   primary key (NAMA_PERGURUAN)
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
   primary key (NAMA)
);

alter table LOMBA add constraint FK_LOMBA_AMBIL_LOM_PESERTA foreign key (NAMA)
      references PESERTA (NAMA) on delete restrict on update restrict;

alter table PERGURUAN_TINGGI add constraint FK_PERGURUA_MENGADAKA_LOMBA foreign key (NAMA_LOMBA)
      references LOMBA (NAMA_LOMBA) on delete restrict on update restrict;

