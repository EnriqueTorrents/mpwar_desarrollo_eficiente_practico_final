DROP
DATABASE IF EXISTS `open_flight`;
CREATE
DATABASE IF NOT EXISTS `open_flight`;
USE `open_flight`;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`
(
    `Id`       CHAR(36) NOT NULL,
    `Username` TEXT     NOT NULL,
    `Name`     TEXT     NOT NULL,
    `LastName` TEXT     NOT NULL,
    `Password` TEXT     NOT NULL,
    PRIMARY KEY (`Id`)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `flight`;
CREATE TABLE `flight`
(
    `Id`             CHAR(36) NOT NULL,
    `Origin`         TEXT     NOT NULL,
    `Destination`    TEXT     NOT NULL,
    `Flight-hours`   INT      NOT NULL,
    `Price`          INT      NOT NULL,
    `Currency`       CHAR(1)  NOT NULL,
    `Departure-date` DATETIME NOT NULL,
    `Aircraft`       TEXT     NOT NULL,
    `Airline`        TEXT     NOT NULL,
    PRIMARY KEY (`Id`)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book`
(
    `Id`             CHAR(36) NOT NULL,
    `Buy-date`       DATETIME NOT NULL,
    `Number-seat`    INT      NOT NULL,
    `Letter-seat`    CHAR(1)  NOT NULL,
    `Class-seat`     TEXT     NOT NULL,
    `Price`          INT      NOT NULL,
    `Currency`       CHAR(1)  NOT NULL,
    `Flight-id`      CHAR(36) NOT NULL,
    `User-id`        CHAR(36) NOT NULL,

    PRIMARY KEY (`Id`)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `luggage`;
CREATE TABLE `luggage`
(
    `Id`            CHAR(36) NOT NULL,
    `Type`          TEXT     NOT NULL,
    `Weight-value`        INT     NOT NULL,
    `Weight-unit`   CHAR(5)     NOT NULL,
    `book-id`       CHAR(36) NOT NULL,
    PRIMARY KEY (`Id`)
) ENGINE = InnoDB;

CREATE TABLE `flights_destination_counter` (
   `id` CHAR(36)        NOT  NULL,
   `destination`        TEXT NOT NULL,
   `total`              INT  NOT NULL,
   `existing_flights`   JSON NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB;