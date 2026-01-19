-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 06, 2025 at 04:26 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `AdminId` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`AdminId`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminId`, `Username`, `Email`, `Password`) VALUES
(1, 'Admin', 'Admin@example.com', '12345'),
(11, 'admin1', 'admin1@example.com', 'adminPass123'),
(12, 'admin2', 'admin2@example.com', 'securePass456');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `CategoryID` int NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(50) NOT NULL,
  PRIMARY KEY (`CategoryID`),
  UNIQUE KEY `CategoryName` (`CategoryName`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`) VALUES
(1, 'New Release'),
(2, 'Comedy'),
(3, 'Thriller'),
(4, 'Action'),
(5, 'Children'),
(6, 'Romance'),
(7, 'Horror'),
(8, 'Famous');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'lakshani', 'lakshanikumari02@gmail.com', 'laljduhcubc', '2025-08-30 09:20:23'),
(2, 'lakshani', 'user@gmail.com', 'its good', '2025-09-04 09:38:36'),
(3, 'lakshani lasintha', 'user1@example.com', 'welcome', '2025-09-06 13:31:19'),
(4, 'User', 'user01@example.com', 'hi', '2025-09-06 15:05:09'),
(5, 'User', 'user01@example.com', 'hi', '2025-09-06 15:10:04'),
(6, 'User', 'user@example.com', 'hi', '2025-09-06 15:24:13'),
(7, 'User', 'user@example.com', 'Hi', '2025-09-06 15:43:40'),
(8, 'John Doe', 'john@example.com', 'I love your site!', '2025-09-06 16:20:30'),
(9, 'Jane Smith', 'jane@example.com', 'Can you add more action movies?', '2025-09-06 16:20:30'),
(10, 'Mike Lee', 'mike@example.com', 'Having trouble logging in.', '2025-09-06 16:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `dramas`
--

DROP TABLE IF EXISTS `dramas`;
CREATE TABLE IF NOT EXISTS `dramas` (
  `DramaID` int NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `ReleaseYear` year DEFAULT NULL,
  `Description` text,
  `Poster` varchar(255) DEFAULT NULL,
  `Category` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`DramaID`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dramas`
--

INSERT INTO `dramas` (`DramaID`, `Title`, `ReleaseYear`, `Description`, `Poster`, `Category`) VALUES
(1, 'Breaking Bad', '2008', 'A high school chemistry teacher turned methamphetamine producer navigates the dangers of the drug trade.', 'img/d_famous/breaking_bad.jpg', 'Famous'),
(2, 'Game of Thrones', '2011', 'Noble families vie for control of the Seven Kingdoms of Westeros while an ancient enemy returns.', 'img/d_famous/game_of_thrones.jpg', 'Famous'),
(3, 'Friends', '1994', 'Follows the lives, relationships, and comedic adventures of six friends living in New York City.', 'img/d_famous/friends.jpg', 'Famous'),
(4, 'The Crown', '2016', 'Chronicles the reign of Queen Elizabeth II and the events that shaped the second half of the 20th century.', 'img/d_famous/the_crown.jpg', 'Famous'),
(5, 'Stranger Things', '2016', 'A group of kids uncover supernatural mysteries in their small town and face government conspiracies.', 'img/d_famous/stranger_things.png', 'Famous'),
(6, 'Sherlock', '2010', 'A modern adaptation of Sherlock Holmes solving mysteries with his friend Dr. Watson.', 'img/d_famous/sherlock.jpg', 'Famous'),
(7, 'The Witcher', '2019', 'Geralt of Rivia, a monster hunter, struggles to find his place in a world where people often prove more wicked than beasts.', 'img/d_famous/the_witcher.jpg', 'Famous'),
(8, 'Money Heist', '2017', 'A criminal mastermind known as The Professor plans the biggest heist in Spanish history.', 'img/d_famous/money_heist.jpg', 'Famous'),
(9, 'House of Cards', '2013', 'A ruthless politician and his equally ambitious wife manipulate and betray to achieve power in Washington, D.C.', 'img/d_famous/house_of_cards.jpg', 'Famous'),
(10, 'Westworld', '2016', 'In a futuristic theme park, artificial beings begin to gain consciousness and rebel against human guests.', 'img/d_famous/westworld.jpg', 'Famous'),
(11, 'The Last of Us', '2023', 'In a post-apocalyptic world, a smuggler escorts a teenage girl who may hold the key to humanity?s survival.', 'img/d_new/the_last_of_us.jpg', 'New Release'),
(12, 'Wednesday', '2022', 'Wednesday Addams navigates life at Nevermore Academy while solving a series of mysteries.', 'img/d_new/wednesday.jpg', 'New Release'),
(13, 'Severance', '2022', 'Employees at Lumon Industries separate work and personal memories through a mysterious procedure.', 'img/d_new/severance.jpg', 'New Release'),
(14, 'House of the Dragon', '2022', 'Prequel to Game of Thrones focusing on House Targaryen?s history and internal conflicts.', 'img/d_new/house_of_the_dragon.jpg', 'New Release'),
(15, 'The Sandman', '2022', 'The Dream King, Morpheus, is captured, and the world struggles with the consequences.', 'img/d_new/the_sandman.jpg', 'New Release'),
(16, 'Citadel', '2023', 'A global spy organization faces betrayal while protecting secrets that could change the world.', 'img/d_new/citadel.jpg', 'New Release'),
(17, 'The Bear', '2022', 'A young chef returns home to run his family?s sandwich shop and rebuild his life.', 'img/d_new/the_bear.jpg', 'New Release'),
(18, '1899', '2022', 'Immigrants traveling to America face mysterious events aboard a ship crossing the Atlantic.', 'img/d_new/1899.jpg', 'New Release'),
(19, 'Lockwood & Co.', '2023', 'Teen ghost hunters investigate supernatural phenomena in a haunted London.', 'img/d_new/lockwood_co.jpg', 'New Release'),
(20, 'Star Trek: Strange New Worlds', '2022', 'Adventures of the USS Enterprise under Captain Pike before Captain Kirk?s era.', 'img/d_new/strange_new_worlds.jpg', 'New Release'),
(21, 'Squid Game', '2021', 'Contestants participate in deadly children?s games to win a massive cash prize.', 'img/d_korean/squid_game.jpg', 'Korean'),
(22, 'All of Us Are Dead', '2022', 'High school students struggle to survive a zombie outbreak while trapped in their school.', 'img/d_korean/all_of_us_are_dead.jpg', 'Korean'),
(23, 'Kingdom', '2019', 'A crown prince investigates a mysterious plague turning people into the undead.', 'img/d_korean/kingdom.jpg', 'Korean'),
(24, 'Vincenzo', '2021', 'A Korean-Italian lawyer and mafia consigliere fights corruption in his homeland.', 'img/d_korean/vincenzo.jpg', 'Korean'),
(25, 'Crash Landing on You', '2019', 'A South Korean heiress accidentally lands in North Korea and falls in love with an officer.', 'img/d_korean/crash_landing_on_you.jpg', 'Korean'),
(26, 'Extraordinary Attorney Woo', '2022', 'A brilliant autistic lawyer navigates the challenges of law and life.', 'img/d_korean/attorney_woo.jpg', 'Korean'),
(27, 'My Name', '2021', 'A woman infiltrates a crime syndicate to avenge her father?s murder.', 'img/d_korean/my_name.jpg', 'Korean'),
(28, 'Sweet Home', '2020', 'Residents of an apartment complex fight for survival as monsters emerge.', 'img/d_korean/sweet_home.jpg', 'Korean'),
(29, 'Start-Up', '2020', 'Young entrepreneurs chase their dreams in Korea?s booming start-up industry.', 'img/d_korean/start_up.jpg', 'Korean'),
(30, 'Twenty-Five Twenty-One', '2022', 'A coming-of-age story about love, friendship, and dreams in the 1990s.', 'img/d_korean/twenty_five_twenty_one.jpg', 'Korean'),
(31, 'Alice in Borderland', '2020', 'Friends trapped in Tokyo must play deadly games to survive.', 'img/d_other/alice_in_borderland.jpg', 'Other Asian Dramas'),
(32, 'Midnight Diner: Tokyo Stories', '2016', 'A late-night Tokyo diner welcomes customers who share heartfelt stories.', 'img/d_other/midnight_diner.jpg', 'Other Asian Dramas'),
(33, 'GTO: Great Teacher Onizuka', '2012', 'A former gang leader becomes a teacher who inspires troubled students.', 'img/d_other/gto.jpg', 'Other Asian Dramas'),
(34, 'Bad Genius', '2017', 'A brilliant student creates a high-stakes cheating operation.', 'img/d_other/bad_genius.jpg', 'Other Asian Dramas'),
(35, 'Hormones', '2013', 'Thai high school students navigate love, friendship, and challenges of growing up.', 'img/d_other/hormones.jpg', 'Other Asian Dramas'),
(36, 'Girl From Nowhere', '2018', 'A mysterious girl exposes lies and corruption in schools.', 'img/d_other/girl_from_nowhere.jpg', 'Other Asian Dramas'),
(37, 'Sacred Games', '2018', 'A Mumbai cop receives a mysterious tip that sets off a deadly chase.', 'img/d_other/sacred_games.jpg', 'Other Asian Dramas'),
(38, 'Made in Heaven', '2019', 'Two wedding planners in Delhi expose secrets of the elite.', 'img/d_other/made_in_heaven.jpg', 'Other Asian Dramas'),
(39, 'Koombiyo', '2017', 'A cunning conman navigates crime and politics in Colombo.', 'img/d_other/koombiyo.jpeg', 'Other Asian Dramas'),
(40, 'Thanamalvila Kollek', '2021', 'A rural youth?s journey reveals struggles and aspirations in Sri Lanka.', 'img/d_other/thanamalvila_kollek.jpg', 'Other Asian Dramas'),
(41, 'The Untamed', '2019', 'Two soulmates uncover a conspiracy in a fantasy world of martial arts and magic.', 'img/d_china/the_untamed.jpg', 'Chinese'),
(42, 'Nirvana in Fire', '2015', 'A brilliant strategist returns under a new identity to clear his family?s name.', 'img/d_china/nirvana_in_fire.jpg', 'Chinese'),
(43, 'Love O2O', '2016', 'A romance blossoms between two college students who meet in an online game.', 'img/d_china/love_o2o.jpg', 'Chinese'),
(44, 'Eternal Love (Ten Miles of Peach Blossoms)', '2017', 'An immortal love story spanning three lifetimes.', 'img/d_china/eternal_love.jpg', 'Chinese'),
(45, 'Ashes of Love', '2018', 'A love story between a goddess and a heavenly prince facing fate and destiny.', 'img/d_china/ashes_of_love.jpg', 'Chinese'),
(46, 'Princess Agents', '2017', 'A slave girl rises to power amidst palace intrigue and war.', 'img/d_china/princess_agents.jpg', 'Chinese'),
(47, 'Legend of Fuyao', '2018', 'A young woman with mysterious powers sets out on a quest to restore balance.', 'img/d_china/legend_of_fuyao.jpg', 'Chinese'),
(48, 'The King?s Woman', '2017', 'The love story of Ying Zheng, the first Emperor of China, and his consort.', 'img/d_china/kings_woman.jpg', 'Chinese'),
(49, 'Word of Honor', '2021', 'Two men from different worlds form a deep bond while solving martial arts mysteries.', 'img/d_china/word_of_honor.jpg', 'Chinese'),
(50, 'Go Ahead', '2020', 'Three unrelated children grow up together as a family, facing life?s ups and downs.', 'img/d_china/go_ahead.jpg', 'Chinese');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `MovieID` int NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `ReleaseYear` year DEFAULT NULL,
  `ReleaseDate` date DEFAULT NULL,
  `Description` text,
  `Poster` varchar(255) DEFAULT NULL,
  `CategoryID` int DEFAULT NULL,
  `Popularity` int DEFAULT '0',
  `Category` varchar(50) NOT NULL DEFAULT 'General',
  PRIMARY KEY (`MovieID`),
  KEY `CategoryID` (`CategoryID`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`MovieID`, `Title`, `ReleaseYear`, `ReleaseDate`, `Description`, `Poster`, `CategoryID`, `Popularity`, `Category`) VALUES
(19, 'Avengers: Endgame', '2019', '2019-04-26', 'The Avengers assemble once more to undo the damage caused by Thanos.', 'img/engame.jpg', 2, 95, 'Famous'),
(20, 'Frozen II', '2019', '2019-11-22', 'Elsa, Anna, Kristoff, and Olaf set out on a journey to discover the origin of Elsa?s powers.', 'img/frozen2.jpg', 3, 88, 'Children'),
(21, 'The Conjuring', '2013', '2013-07-19', 'Paranormal investigators Ed and Lorraine Warren help a family terrorized by a dark presence.', 'img/conjuring.jpg', 4, 80, 'Horror'),
(22, 'Inception', '2010', '2010-07-16', 'A thief who enters the dreams of others must pull off the ultimate heist inside the subconscious.', 'img/inception.jpg', 5, 90, 'Thriller'),
(23, 'The Hangover', '2009', '2009-06-05', 'Three friends wake up from a bachelor party in Las Vegas with no memory of the night before.', 'img/hangover.jpg', 6, 85, 'Comedy'),
(24, 'Titanic', '1997', '1997-12-19', 'A romance blossoms between Jack and Rose aboard the ill-fated RMS Titanic.', 'img/titanic.jpg', 7, 92, 'Romance'),
(25, 'Oppenheimer', '2023', '2023-07-21', 'The story of J. Robert Oppenheimer and his role in the development of the atomic bomb.', 'img/oppenheimer.jpg', 1, 97, 'New Release'),
(36, 'The Godfather', '1972', '1972-03-24', 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.', 'img/godfather.jpg', 2, 99, 'Famous'),
(27, 'Barbie', '2023', '2023-07-21', 'Barbie discovers the real world outside Barbie Land.', 'img/barbie.jpg', 1, 92, 'Romance'),
(28, 'Guardians of the Galaxy Vol. 3', '2023', '2023-05-05', 'The Guardians embark on a new cosmic adventure.', 'img/guardians3.jpg', 1, 89, 'Horror'),
(29, 'Spider-Man: Across the Spider-Verse', '2023', '2023-06-02', 'Miles Morales travels across the multiverse to face a new threat.', 'img/spiderman_across.jpg', 1, 90, 'New Release'),
(30, 'John Wick: Chapter 4', '2023', '2023-03-24', 'John Wick faces new enemies and his most dangerous mission yet.', 'img/johnwick4.jpg', 1, 88, 'New Release'),
(31, 'Mission: Impossible - Dead Reckoning Part One', '2023', '2023-07-12', 'Ethan Hunt faces a global threat in this high-octane action.', 'img/mi_deadreckoning.jpg', 1, 85, 'New Release'),
(32, 'Dune: Part Two', '2023', '2023-11-15', 'Paul Atreides continues his journey on Arrakis.', 'img/dune2.jpg', 1, 91, 'New Release'),
(33, 'The Marvels', '2023', '2023-11-10', 'Carol Danvers teams up with Kamala Khan and Monica Rambeau.', 'img/the_marvels.jpg', 1, 87, 'New Release'),
(34, 'The Hunger Games: The Ballad of Songbirds & Snakes', '2023', '2023-11-17', 'A prequel to The Hunger Games series, following young Coriolanus Snow.', 'img/hunger_games_prequel.jpg', 1, 84, 'New Release'),
(35, 'Wonka', '2023', '2023-12-15', 'The origin story of Willy Wonka and his chocolate factory adventures.', 'img/wonka.jpg', 1, 86, 'New Release'),
(37, 'The Dark Knight', '2008', '2008-07-18', 'Batman faces the Joker, a criminal mastermind who wants to plunge Gotham into chaos.', 'img/dark_knight.jpg', 2, 98, 'Famous'),
(38, 'Harry Potter and the Sorcerer\'s Stone', '2001', '2001-11-16', 'Harry discovers he is a wizard on his 11th birthday and attends Hogwarts School of Witchcraft and Wizardry.', 'img/harry_potter1.jpg', 2, 97, 'Famous'),
(39, 'Forrest Gump', '1994', '1994-07-06', 'The life journey of Forrest Gump, a man with a kind heart and a unique outlook on life.', 'img/forrest_gump.jpg', 2, 96, 'Famous'),
(40, 'The Lord of the Rings: The Return of the King', '2003', '2003-12-17', 'Frodo and Sam reach Mordor to destroy the One Ring while the rest of the fellowship battles Sauron?s army.', 'img/lotr_return_king.jpg', 2, 95, 'Famous'),
(41, 'Star Wars: Episode V - The Empire Strikes Back', '1980', '1980-05-21', 'The Rebels face setbacks as Darth Vader hunts Luke Skywalker across the galaxy.', 'img/empire_strikes_back.jpg', 2, 94, 'Famous'),
(42, 'The Shawshank Redemption', '1994', '1994-09-23', 'Two imprisoned men bond over several years, finding solace and eventual redemption through acts of decency.', 'img/shawshank_redemption.jpg', 2, 93, 'Famous'),
(43, 'Gladiator', '2000', '2000-05-05', 'A former Roman General sets out to exact vengeance against the corrupt emperor who murdered his family.', 'img/gladiator.jpg', 2, 92, 'Famous'),
(44, 'Jurassic Park', '1993', '1993-06-11', 'During a preview tour, a theme park suffers a major power breakdown that allows cloned dinosaurs to run amok.', 'img/jurassic_park.jpg', 2, 91, 'Famous'),
(45, 'Moana', '2016', '2016-11-23', 'A young girl sets sail on a daring mission to save her people, discovering her own identity along the way.', 'img/moana.jpg', 3, 96, 'Children'),
(46, 'The Lion King', '1994', '1994-06-15', 'A lion cub prince flees his kingdom after the murder of his father, only to learn the true meaning of responsibility and bravery.', 'img/lion_king.jpg', 3, 95, 'Children'),
(47, 'Toy Story', '1995', '1995-11-22', 'A cowboy doll is profoundly threatened and jealous when a new spaceman figure supplants him as top toy in a boy\'s room.', 'img/toy_story.jpg', 3, 94, 'Children'),
(48, 'Finding Nemo', '2003', '2003-05-30', 'After his son is captured in the Great Barrier Reef and taken to Sydney, a timid clownfish sets out on a journey to bring him home.', 'img/finding_nemo.jpg', 3, 93, 'Children'),
(49, 'Shrek', '2001', '2001-05-18', 'An ogre\'s quiet life is disrupted when numerous fairy tale characters are exiled to his swamp, leading him to rescue a princess.', 'img/shrek.jpg', 3, 92, 'Children'),
(50, 'Coco', '2017', '2017-11-22', 'Aspiring musician Miguel enters the Land of the Dead to uncover his family\'s mysterious history and follow his dream.', 'img/coco.jpg', 3, 91, 'Children'),
(51, 'Zootopia', '2016', '2016-03-04', 'In a city of anthropomorphic animals, a rookie bunny cop and a cynical con artist fox must work together to uncover a conspiracy.', 'img/zootopia.jpg', 3, 90, 'Children'),
(52, 'The Incredibles', '2004', '2004-11-05', 'A family of undercover superheroes tries to live a quiet suburban life but is forced into action to save the world.', 'img/incredibles.jpg', 3, 89, 'Children'),
(53, 'Despicable Me', '2010', '2010-07-09', 'A supervillain adopts three girls as part of a grand scheme but discovers the joys of parenthood.', 'img/despicable_me.jpg', 3, 88, 'Children'),
(54, 'Paranormal Activity', '2007', '2007-10-14', 'A young couple becomes increasingly disturbed by a nightly demonic presence in their home, captured on camera.', 'img/paranormal_activity.jpg', 4, 95, 'Horror'),
(55, 'It', '2017', '2017-09-08', 'A group of children are terrorized by Pennywise, an ancient shape-shifting evil that emerges from the sewer every 27 years.', 'img/it.jpg', 4, 94, 'Horror'),
(56, 'A Quiet Place', '2018', '2018-04-06', 'In a post-apocalyptic world, a family must live in silence to avoid blind monsters with acute hearing.', 'img/a_quiet_place.jpg', 4, 93, 'Horror'),
(57, 'The Exorcist', '1973', '1973-12-26', 'A mother seeks the help of two priests to save her daughter from demonic possession.', 'img/exorcist.jpg', 4, 92, 'Horror'),
(58, 'Insidious', '2010', '2010-04-01', 'A family tries to prevent evil spirits from trapping their comatose child in a realm called The Further.', 'img/insidious.jpg', 4, 91, 'Horror'),
(59, 'Halloween', '1978', '1978-10-25', 'Masked killer Michael Myers escapes from a mental institution and returns to his hometown to stalk and kill.', 'img/halloween.jpg', 4, 90, 'Horror'),
(60, 'The Ring', '2002', '2002-10-18', 'A journalist investigates a mysterious videotape which seems to cause the death of anyone who watches it.', 'img/the_ring.jpg', 4, 89, 'Horror'),
(61, 'Hereditary', '2018', '2018-06-08', 'A family is haunted following the death of their secretive grandmother, revealing dark secrets and sinister fate.', 'img/hereditary.jpg', 4, 88, 'Horror'),
(62, 'The Shining', '1980', '1980-05-23', 'A family heads to an isolated hotel where the father descends into madness due to supernatural forces.', 'img/the_shining.jpg', 4, 87, 'Horror'),
(64, 'Memento', '2000', '2000-10-11', 'A man with short-term memory loss uses notes and tattoos to hunt for his wife\'s murderer.', 'img/memento.jpg', 5, 95, 'Thriller'),
(65, 'Se7en', '1995', '1995-09-22', 'Two detectives hunt a serial killer who uses the seven deadly sins as his motives.', 'img/se7en.jpg', 5, 90, 'Thriller'),
(66, 'Gone Girl', '2014', '2014-10-03', 'A man becomes the prime suspect in his wife\'s mysterious disappearance.', 'img/gonegirl.jpg', 5, 88, 'Thriller'),
(67, 'The Girl with the Dragon Tattoo', '2011', '2011-12-21', 'A journalist and hacker investigate a disappearance that happened forty years ago.', 'img/dragontattoo.jpg', 5, 85, 'Thriller'),
(68, 'Shutter Island', '2010', '2010-02-19', 'A U.S. Marshal investigates a psychiatric facility on an isolated island.', 'img/shutterisland.jpg', 5, 87, 'Thriller'),
(69, 'Prisoners', '2013', '2013-09-20', 'A father takes matters into his own hands when his daughter goes missing.', 'img/prisoners.jpg', 5, 83, 'Thriller'),
(70, 'Black Swan', '2010', '2010-12-17', 'A ballet dancer descends into madness as she competes for the lead role.', 'img/blackswan.jpg', 5, 82, 'Thriller'),
(71, 'Mystic River', '2003', '2003-10-15', 'Three men are linked by a tragedy from their past, which resurfaces years later.', 'img/mysticriver.jpg', 5, 80, 'Thriller'),
(72, 'The Sixth Sense', '1999', '1999-08-06', 'A boy who communicates with spirits seeks help from a troubled psychologist.', 'img/sixthsense.jpg', 5, 84, 'Thriller'),
(73, 'Dumb and Dumber', '1994', '1994-12-16', 'Two incredibly dumb friends embark on a cross-country trip to return a briefcase full of money to its owner.', 'img/dumbanddumber.jpg', 6, 95, 'Comedy'),
(74, 'Superbad', '2007', '2007-08-17', 'Two high school friends try to enjoy their final days before graduation while attempting to party and impress girls.', 'img/superbad.jpg', 6, 90, 'Comedy'),
(75, 'Step Brothers', '2008', '2008-07-25', 'Two grown men become stepbrothers and struggle with living together in a new blended family.', 'img/stepbrothers.jpg', 6, 88, 'Comedy'),
(76, 'Anchorman', '2004', '2004-07-09', 'A popular news anchor in the 1970s faces challenges when a female reporter joins his team.', 'img/anchorman.jpg', 6, 87, 'Comedy'),
(77, 'Bridesmaids', '2011', '2011-05-13', 'Competition and chaos ensue when a maid of honor tries to plan the perfect wedding for her best friend.', 'img/bridesmaids.jpg', 6, 85, 'Comedy'),
(78, 'Zombieland', '2009', '2009-10-02', 'Survivors of a zombie apocalypse team up to find a safe haven and discover quirky ways to survive.', 'img/zombieland.jpg', 6, 83, 'Comedy'),
(79, 'Tropic Thunder', '2008', '2008-08-13', 'Actors filming a war movie unknowingly become part of a real conflict while shooting in the jungle.', 'img/tropicthunder.jpg', 6, 82, 'Comedy'),
(80, '21 Jump Street', '2012', '2012-03-16', 'Two underachieving police officers go undercover at a high school to bust a drug ring.', 'img/21jumpstreet.jpg', 6, 80, 'Comedy'),
(81, 'The Other Guys', '2010', '2010-08-06', 'Two mismatched NYPD detectives stumble into a huge financial crime while trying to prove themselves.', 'img/theotherguys.jpg', 6, 79, 'Comedy'),
(82, 'The Fault in Our Stars', '2014', '2014-06-06', 'Two teenagers with cancer meet in a support group and fall in love, navigating life and illness together.', 'img/thefaultinourstars.jpg', 7, 95, 'Romance'),
(83, 'The Notebook', '2004', '2004-06-25', 'A young couple falls in love in the 1940s, facing challenges and separation over the years.', 'img/thenotebook.jpg', 7, 90, 'Romance'),
(84, 'Pride and Prejudice', '2005', '2005-11-11', 'Elizabeth Bennet navigates love, manners, and societal expectations in 19th century England.', 'img/prideandprejudice.jpg', 7, 88, 'Romance'),
(85, 'La La Land', '2016', '2016-12-09', 'An aspiring actress and a jazz musician fall in love while pursuing their dreams in Los Angeles.', 'img/lalaland.jpg', 7, 87, 'Romance'),
(86, 'A Walk to Remember', '2002', '2002-01-25', 'A popular high school student falls in love with a quiet, religious girl, changing both their lives.', 'img/awalktoremember.jpg', 7, 85, 'Romance'),
(87, 'Romeo + Juliet', '1996', '1996-11-01', 'A modern adaptation of Shakespeare\'s tragic love story between two feuding families.', 'img/romeoandjuliet.jpg', 7, 83, 'Romance'),
(88, 'Dear John', '2010', '2010-02-05', 'A soldier and a college student fall in love through letters during his deployment.', 'img/dearjohn.jpg', 7, 82, 'Romance'),
(89, 'The Vow', '2012', '2012-02-10', 'After a car accident, a woman loses her memory and her husband tries to win her heart again.', 'img/thevow.jpg', 7, 80, 'Romance'),
(90, 'Me Before You', '2016', '2016-06-03', 'A young woman becomes the caretaker of a wealthy man left paralyzed after an accident, and they fall in love.', 'img/mebeforeyou.jpg', 7, 79, 'Romance'),
(92, 'narnia', '2021', NULL, 'Narnia is', 'img/m_action/narnia.jpeg', NULL, 0, 'Action'),
(93, 'Narnia', '2015', NULL, 'narnia is ...', 'img/m_thriller/narnia.jpeg', NULL, 0, 'Thriller');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `Password`) VALUES
(8, 'user', 'user@example.com', '$2y$10$73Uck4SSa0GlHL33pSHhvu88W1goR3FolM.mUAjXnlrb4PyONGkWa'),
(9, 'alice', 'alice@example.com', 'alicePass123'),
(10, 'bob', 'bob@example.com', 'bobSecure456'),
(11, 'charlie', 'charlie@example.com', 'charliePwd789');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
