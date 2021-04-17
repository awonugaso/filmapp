BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "migrations" (
	"id"	integer NOT NULL,
	"migration"	varchar NOT NULL,
	"batch"	integer NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "users" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"email"	varchar NOT NULL,
	"dob"	date NOT NULL,
	"address"	varchar,
	"user_type"	varchar NOT NULL DEFAULT 'customer' CHECK("user_type" IN ('customer', 'admin')),
	"email_verified_at"	datetime,
	"password"	varchar NOT NULL,
	"remember_token"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime,
	"two_factor_secret"	text,
	"two_factor_recovery_codes"	text,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "password_resets" (
	"email"	varchar NOT NULL,
	"token"	varchar NOT NULL,
	"created_at"	datetime
);
CREATE TABLE IF NOT EXISTS "failed_jobs" (
	"id"	integer NOT NULL,
	"uuid"	varchar NOT NULL,
	"connection"	text NOT NULL,
	"queue"	text NOT NULL,
	"payload"	text NOT NULL,
	"exception"	text NOT NULL,
	"failed_at"	datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "genres" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "films" (
	"id"	integer NOT NULL,
	"title"	varchar NOT NULL,
	"description"	varchar NOT NULL,
	"genre"	varchar NOT NULL,
	"image"	varchar NOT NULL,
	"cost"	integer NOT NULL,
	"status"	varchar NOT NULL DEFAULT 'active' CHECK("status" IN ('active', 'deactivate')),
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "transactions" (
	"id"	integer NOT NULL,
	"film_id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"qty"	integer NOT NULL,
	"cost"	integer NOT NULL,
	"status"	varchar NOT NULL DEFAULT 'approve' CHECK("status" IN ('approve', 'decline')),
	"created_at"	datetime,
	"updated_at"	datetime,
	FOREIGN KEY("film_id") REFERENCES "films"("id") on delete cascade,
	FOREIGN KEY("user_id") REFERENCES "users"("id") on delete cascade,
	PRIMARY KEY("id" AUTOINCREMENT)
);
INSERT INTO "migrations" VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO "migrations" VALUES (2,'2014_10_12_100000_create_password_resets_table',1);
INSERT INTO "migrations" VALUES (3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1);
INSERT INTO "migrations" VALUES (4,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO "migrations" VALUES (5,'2021_04_12_165418_create_genres_table',1);
INSERT INTO "migrations" VALUES (6,'2021_04_14_121548_create_films_table',1);
INSERT INTO "migrations" VALUES (7,'2021_04_14_135821_create_transactions_table',1);
INSERT INTO "users" VALUES (1,'Beverly Durgan','admin@movie.com','2021-04-16 09:39:23',NULL,'admin','2021-04-16 09:39:23','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','sPfOY1jPRHg8lXiVXiZFbXwWElf4MKZWVlCHWkAHKKEcPmvIbzpWMmRy4FmP','2021-04-16 09:39:23','2021-04-16 09:39:23',NULL,NULL);
INSERT INTO "users" VALUES (2,'coolchi','coolchi01@gmail.com','1930-12-31',NULL,'customer',NULL,'$2y$10$Dsdpv1/.Gm.WIZsMO84l9OPYuO3sRJpD7Uz6BWtPUjMq2YdLtRdky',NULL,'2021-04-16 12:04:42','2021-04-16 12:04:42',NULL,NULL);
INSERT INTO "genres" VALUES (1,'Action','2021-04-16 09:39:23','2021-04-16 09:39:23');
INSERT INTO "genres" VALUES (2,'Comedy','2021-04-16 09:39:23','2021-04-16 09:39:23');
INSERT INTO "genres" VALUES (3,'War','2021-04-16 09:39:23','2021-04-16 09:39:23');
INSERT INTO "genres" VALUES (4,'Sci-fi','2021-04-16 09:39:23','2021-04-16 09:39:23');
INSERT INTO "films" VALUES (3,'Citizen Soldier','Citizen Soldier','Action','1618575334.Beverly Durganjpg',400,'active','2021-04-16 12:15:34','2021-04-16 12:15:34');
INSERT INTO "films" VALUES (4,'Ride Along 2','Digital Services','Action','1618575489.Beverly Durganjpg',20,'active','2021-04-16 12:18:09','2021-04-16 12:18:09');
CREATE UNIQUE INDEX IF NOT EXISTS "users_email_unique" ON "users" (
	"email"
);
CREATE INDEX IF NOT EXISTS "password_resets_email_index" ON "password_resets" (
	"email"
);
CREATE UNIQUE INDEX IF NOT EXISTS "failed_jobs_uuid_unique" ON "failed_jobs" (
	"uuid"
);
COMMIT;
