drop table if exists freeCitizenCommentairesJob;
create table freeCitizenCommentairesJob (
id integer not null primary key auto_increment,
idArticle integer not null,
datePost datetime not null,
idAuteur integer  not null,
commentaire text not null
) engine=innodb character set utf8 collate utf8_unicode_ci;


