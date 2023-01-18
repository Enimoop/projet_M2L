create database M2L;
use M2L;

create table prestataire(
    id_presta int not null auto_increment,
    raison_sociale varchar(255),
    constraint pk_prestataire primary key (id_presta)
);

create table lieu(
    id_lieu int not null auto_increment,
    adresse varchar(255),
    cp varchar(10),
    ville varchar(20),
    constraint pk_lieu primary key (id_lieu)
);

create table prerequis(
    id_pre int not null auto_increment,
    libelle varchar(200),
    constraint pk_prerequis primary key (id_pre)
);

create table formation(
    id_f int not null auto_increment,
    contenu text,
    duree time,
    date_f date,
    nb_jours int(3),
    id_lieu int not null,
    id_presta int not null,
    constraint pk_formation primary key(id_f),
    constraint fk_formlieu foreign key(id_lieu) references lieu(id_lieu),
    constraint fk_formpresta foreign key(id_presta) references prestataire(id_presta)
);

create table users(
    id_u int not null auto_increment,
    email varchar(255),
    mdp varchar(255),
    nom_u varchar(50),
    prenom_u varchar(50),
    lvl int,
    nb_jours_u int,
    id_chef int,
    constraint pk_users primary key(id_u),
    constraint fk_userschef foreign key(id_chef) references users(id_u)
);

create table form_pre(
    id_f int not null,
    id_pre int not null,
    constraint pk_formpre primary key(id_f,id_pre),
    constraint fk_form foreign key(id_f) references formation(id_f),
    constraint fk_pre foreign key(id_pre) references prerequis(id_pre)
);

create table suivre(
    id_f int not null,
    id_u int not null,
    etat int default 0,
    constraint pk_suivre primary key(id_f,id_u),
    constraint fk_suivreform foreign key(id_f) references formation(id_f),
    constraint fk_suivreusers foreign key(id_u) references users(id_u)
);