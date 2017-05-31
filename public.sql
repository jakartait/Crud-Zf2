/*
Navicat PGSQL Data Transfer

Source Server         : PostgreSQL
Source Server Version : 90411
Source Host           : localhost:5432
Source Database       : crud
Source Schema         : public

Target Server Type    : PGSQL
Target Server Version : 90411
File Encoding         : 65001

Date: 2017-05-31 12:59:13
*/


-- ----------------------------
-- Sequence structure for book_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."book_id_seq";
CREATE SEQUENCE "public"."book_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 45
 CACHE 1;
SELECT setval('"public"."book_id_seq"', 45, true);

-- ----------------------------
-- Sequence structure for publisher_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."publisher_id_seq";
CREATE SEQUENCE "public"."publisher_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 8
 CACHE 1;
SELECT setval('"public"."publisher_id_seq"', 8, true);

-- ----------------------------
-- Sequence structure for writer_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."writer_id_seq";
CREATE SEQUENCE "public"."writer_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS "public"."books";
CREATE TABLE "public"."books" (
"book_id" int4 NOT NULL,
"title" varchar(255) COLLATE "default",
"date_of_publish" date,
"publisher_id" int4,
"writer_id" int4,
"update_date" date
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of books
-- ----------------------------
INSERT INTO "public"."books" VALUES ('40', 'Codeigniter', '2015-10-10', '8', '1', '2015-10-10');
INSERT INTO "public"."books" VALUES ('41', 'Laravel', '2008-10-12', '2', '2', '2008-10-12');
INSERT INTO "public"."books" VALUES ('42', 'Zend Framework', '2007-09-08', '4', '3', '2007-09-08');
INSERT INTO "public"."books" VALUES ('44', 'Google Adsense', '2005-10-18', '1', '6', '2005-10-18');
INSERT INTO "public"."books" VALUES ('45', 'Mysql Administration', '2017-08-06', '6', '5', '2017-08-06');

-- ----------------------------
-- Table structure for publisher
-- ----------------------------
DROP TABLE IF EXISTS "public"."publisher";
CREATE TABLE "public"."publisher" (
"publisher_id" int4 NOT NULL,
"name" varchar(255) COLLATE "default",
"update_date" date
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of publisher
-- ----------------------------
INSERT INTO "public"."publisher" VALUES ('1', 'Ilmu Komputer', null);
INSERT INTO "public"."publisher" VALUES ('2', 'Yudhistira', null);
INSERT INTO "public"."publisher" VALUES ('3', 'Tiga Bintang Muda', null);
INSERT INTO "public"."publisher" VALUES ('4', 'Roda Sinar Indah', null);
INSERT INTO "public"."publisher" VALUES ('6', 'Indora', null);
INSERT INTO "public"."publisher" VALUES ('7', 'A&B', null);
INSERT INTO "public"."publisher" VALUES ('8', 'Tolabul Ilmi', null);

-- ----------------------------
-- Table structure for writer
-- ----------------------------
DROP TABLE IF EXISTS "public"."writer";
CREATE TABLE "public"."writer" (
"writer_id" int4 NOT NULL,
"name" varchar(255) COLLATE "default",
"update_date" date
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of writer
-- ----------------------------
INSERT INTO "public"."writer" VALUES ('1', 'Ahmad Zulkarnain', null);
INSERT INTO "public"."writer" VALUES ('2', 'Zaenal Arifin', null);
INSERT INTO "public"."writer" VALUES ('3', 'Muhamad Husni Tamrin', null);
INSERT INTO "public"."writer" VALUES ('4', 'Alexandra Tania', null);
INSERT INTO "public"."writer" VALUES ('5', 'Syaiful Bahri', null);
INSERT INTO "public"."writer" VALUES ('6', 'Anita Renata', null);

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table books
-- ----------------------------
ALTER TABLE "public"."books" ADD PRIMARY KEY ("book_id");

-- ----------------------------
-- Primary Key structure for table publisher
-- ----------------------------
ALTER TABLE "public"."publisher" ADD PRIMARY KEY ("publisher_id");

-- ----------------------------
-- Primary Key structure for table writer
-- ----------------------------
ALTER TABLE "public"."writer" ADD PRIMARY KEY ("writer_id");
