-- Created by Vertabelo (http://vertabelo.com)
-- Script type: create
-- Scope: [tables, references, sequences, views, procedures]
-- Generated at Wed Oct 01 03:46:28 UTC 2014




-- tables
-- Table: comments
CREATE TABLE comments (
    id int    NOT NULL  AUTO_INCREMENT,
    user_id int    NOT NULL ,
    message varchar(500)    NOT NULL ,
    time timestamp    NOT NULL ,
    event_id int    NOT NULL ,
    CONSTRAINT comments_pk PRIMARY KEY (id)
);

CREATE INDEX idx_1 ON comments (id);


-- Table: event_notifications
CREATE TABLE event_notifications (
    id int    NOT NULL  AUTO_INCREMENT,
    event_id int    NOT NULL ,
    device_token varchar(100)    NOT NULL ,
    CONSTRAINT event_notifications_pk PRIMARY KEY (id)
);

CREATE INDEX idx_1 ON event_notifications (id);


-- Table: events
CREATE TABLE events (
    id int    NOT NULL  AUTO_INCREMENT,
    problem_id int    NOT NULL ,
    start_time timestamp    NOT NULL ,
    end_time timestamp    NOT NULL ,
    user_id int    NOT NULL ,
    description varchar(300)    NOT NULL ,
    CONSTRAINT events_pk PRIMARY KEY (id)
);

CREATE INDEX idx_1 ON events (id);


-- Table: problem_notifications
CREATE TABLE problem_notifications (
    id int    NOT NULL  AUTO_INCREMENT,
    problem_id int    NOT NULL ,
    device_token varchar(100)    NOT NULL ,
    CONSTRAINT problem_notifications_pk PRIMARY KEY (id)
);

-- Table: problems
CREATE TABLE problems (
    id int    NOT NULL  AUTO_INCREMENT,
    lat double(10,10)    NOT NULL ,
    lng double(10,10)    NOT NULL ,
    description varchar(300)    NOT NULL ,
    image_url varchar(300)    NOT NULL ,
    user_id int    NOT NULL ,
    CONSTRAINT problems_pk PRIMARY KEY (id)
);

CREATE INDEX idx_1 ON problems (id);


-- Table: users
CREATE TABLE users (
    id int    NOT NULL  AUTO_INCREMENT,
    username varchar(50)    NOT NULL ,
    password varchar(50)    NOT NULL ,
    name varchar(40)    NOT NULL ,
    CONSTRAINT users_pk PRIMARY KEY (id)
);

CREATE INDEX idx_1 ON users (id);


-- Table: votes
CREATE TABLE votes (
    id int    NOT NULL  AUTO_INCREMENT,
    user_id int    NOT NULL ,
    problem_id int    NOT NULL ,
    CONSTRAINT votes_pk PRIMARY KEY (id)
);

CREATE INDEX idx_1 ON votes (id);







-- End of file.

