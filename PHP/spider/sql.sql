-- auto-generated definition
create table proxy
(
  id        int auto_increment
  comment '自增id'
    primary key,
  ip_addr   varchar(20)            not null,
  port      int(5) default '80'    not null,
  net_speed decimal(2) default '0' null
  comment '响应时间（ms）',
  constraint proxy_ip_addr_uindex
  unique (ip_addr)
);


-- auto-generated definition
create table task
(
  id        int auto_increment
    primary key,
  url       varchar(500)        not null,
  url_hash  varchar(50)         null,
  is_finsh  tinyint default '0' null,
  create_at datetime            null,
  update_at datetime            null,
  constraint task_url_hash_uindex
  unique (url_hash)
);

create index is_finsh
  on task (is_finsh);

