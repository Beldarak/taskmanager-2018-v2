DROP DATABASE taskmanager2018;
CREATE DATABASE taskmanager2018;
USE taskmanager2018;

DROP TABLE IF EXISTS `tmuser`;

CREATE TABLE `tmuser` (

  `tmuser_id` int(11) NOT NULL AUTO_INCREMENT,

  `tmuser_name` varchar(50) NOT NULL,

  `tmuser_first_name` varchar(50) NOT NULL,

  `tmuser_login` varchar(50) NOT NULL,

  `tmuser_password` varchar(50) NOT NULL,

  `tmuser_role` int(11) NOT NULL DEFAULT 1,

  `tmuser_type` int(11) NOT NULL DEFAULT 0,

  PRIMARY KEY (`tmuser_id`)

) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `task`;

CREATE TABLE `task` (

  `task_id` int(11) NOT NULL AUTO_INCREMENT,

  `task_name` varchar(255) NOT NULL,

  `task_description` varchar(255) NOT NULL,

  `task_creator` int(11) NOT NULL,

  `task_parent` int(11),

  `task_limit` datetime NOT NULL,

  `task_status` boolean DEFAULT FALSE,

  `task_emergency` boolean DEFAULT FALSE,

  `task_end` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

  `task_priority` int(11) NOT NULL,

  PRIMARY KEY (`task_id`),

  KEY `task_creator` (`task_creator`),

  KEY `task_parent` (`task_parent`),

  CONSTRAINT `task_fk_creator` FOREIGN KEY (`task_creator`) REFERENCES `tmuser` (`tmuser_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,

  CONSTRAINT `task_fk_task` FOREIGN KEY (`task_parent`) REFERENCES `task` (`task_id`) ON DELETE NO ACTION ON UPDATE NO ACTION

) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `tmuser_task`;

CREATE TABLE `tmuser_task` (

  `tmuser_task_task` int(11) NOT NULL,

  `tmuser_task_tmuser` int(11) NOT NULL,

  `tmuser_task_order` int(11) NOT NULL DEFAULT 1,

  PRIMARY KEY (`tmuser_task_task`,`tmuser_task_tmuser`),

  KEY `tmuser_task_task` (`tmuser_task_task`),

  KEY `tmuser_task_tmuser` (`tmuser_task_tmuser`),

  CONSTRAINT `tmuser_task_fk_tmuser` FOREIGN KEY (`tmuser_task_task`) REFERENCES `task` (`task_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,

  CONSTRAINT `tmuser_task_fk_task` FOREIGN KEY (`tmuser_task_tmuser`) REFERENCES `tmuser` (`tmuser_id`) ON DELETE NO ACTION ON UPDATE NO ACTION

) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO `tmuser` (`tmuser_id`, `tmuser_name`, `tmuser_first_name`, `tmuser_login`, `tmuser_password`, `tmuser_role`, `tmuser_type`) VALUES

(1, 'PAHAUT', 'Julien', 'JP', 'JP01', 0, 0),
(2, 'DUBLET', 'Emilien', 'ED', 'ED01', 0, 0),
(3, 'INCOUL', 'Maxence', 'MI', 'MI01', 0, 0),
(4, 'REMACLE', 'David', 'DR', 'DR01', 0, 0),
(5, 'ROLLMANN', 'Alain', 'AR', 'AR01', 0, 0);

INSERT INTO `task` (`task_id`, `task_name`, `task_description`, `task_creator`, `task_parent`, `task_limit`, `task_status`, `task_emergency`, `task_end`, `task_priority`) VALUES

(2, 'Projet 1', 'Projet 1, ID 2', 1, NULL, '2018-05-02 11:20:49', 0, 0, '2018-05-07 16:24:41', 1),

(3, 'Projet 2', 'Projet 2, ID 3', 1, NULL, '2018-03-07 10:52:12', 0, 0, '2018-05-07 16:24:41', 2),

(4, 'Tache 1', 'Tâche 1, ID 4, Parent Projet 1', 1, 2, '2018-05-07 15:07:23', 0, 0, '2018-05-07 13:27:50', 1),

(5, 'Projet 3', 'Projet 3, ID 5', 1, NULL, '2018-05-07 16:47:34', 0, 0, '2018-05-07 16:24:41', 0),

(6, 'Tâche 3', 'Tâche 3, ID 6, Parent Projet 3', 1, 5, '2018-05-07 16:47:57', 0, 0, '2018-05-07 14:48:07', 0);



INSERT INTO `tmuser_task` (`tmuser_task_task`, `tmuser_task_tmuser`, `tmuser_task_order`) VALUES

(2, 1, 1),

(3, 1, 2);
