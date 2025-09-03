-- safe-mode settings (optional)
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Drop existing tables (order matters because of FKs)
DROP TABLE IF EXISTS borrowdetails;
DROP TABLE IF EXISTS borrow;
DROP TABLE IF EXISTS lost_book;
DROP TABLE IF EXISTS book;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS member;
DROP TABLE IF EXISTS type;
DROP TABLE IF EXISTS users;

-- Category (lookup)
CREATE TABLE category (
  category_id INT AUTO_INCREMENT PRIMARY KEY,
  classname VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Member
CREATE TABLE member (
  member_id INT AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(100) NOT NULL,
  lastname VARCHAR(100) NOT NULL,
  gender VARCHAR(10) NOT NULL,
  address VARCHAR(255) NOT NULL,
  contact VARCHAR(100) NOT NULL,
  type VARCHAR(100) NOT NULL,
  year_level VARCHAR(100) NOT NULL,
  status VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Book
CREATE TABLE book (
  book_id INT AUTO_INCREMENT PRIMARY KEY,
  book_title VARCHAR(200) NOT NULL,
  category_id INT NOT NULL,
  author VARCHAR(200) NOT NULL,
  book_copies INT NOT NULL,
  book_pub VARCHAR(200),
  publisher_name VARCHAR(200),
  isbn VARCHAR(50),
  copyright_year INT,
  date_receive DATE NULL,
  date_added DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status VARCHAR(50) NOT NULL,
  CONSTRAINT fk_book_category FOREIGN KEY (category_id) REFERENCES category(category_id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Borrow (header)
CREATE TABLE borrow (
  borrow_id INT AUTO_INCREMENT PRIMARY KEY,
  member_id INT NOT NULL,
  date_borrow DATETIME NOT NULL,
  due_date DATE NULL,
  CONSTRAINT fk_borrow_member FOREIGN KEY (member_id) REFERENCES member(member_id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Borrow details (line items)
CREATE TABLE borrowdetails (
  borrow_details_id INT AUTO_INCREMENT PRIMARY KEY,
  book_id INT NOT NULL,
  borrow_id INT NOT NULL,
  borrow_status VARCHAR(50) NOT NULL,
  date_return DATETIME NULL,
  CONSTRAINT fk_bd_book FOREIGN KEY (book_id) REFERENCES book(book_id)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_bd_borrow FOREIGN KEY (borrow_id) REFERENCES borrow(borrow_id)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Lost book table
CREATE TABLE lost_book (
  book_id INT AUTO_INCREMENT PRIMARY KEY,
  isbn VARCHAR(50) NOT NULL,
  member_no VARCHAR(50) NOT NULL,
  date_lost DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Type (borrowertype lookup)
CREATE TABLE type (
  id INT AUTO_INCREMENT PRIMARY KEY,
  borrowertype VARCHAR(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Users (note: store hashed passwords)
CREATE TABLE users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  firstname VARCHAR(100) NOT NULL,
  lastname VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------
-- Insert lookup/sample data
-- -----------------------

INSERT INTO category (category_id, classname) VALUES
(1, 'Periodical'),
(2, 'English'),
(3, 'Math'),
(4, 'Science'),
(5, 'Encyclopedia'),
(6, 'Filipiniana'),
(7, 'Newspaper'),
(8, 'General'),
(9, 'References');

INSERT INTO member (member_id, firstname, lastname, gender, address, contact, type, year_level, status) VALUES
(52, 'Jamshed Rahman', 'Auntor', 'Male', 'Dhaka', '212010', 'Student', 'Second Year', 'Active'),
(53, 'Rezwan', 'Ahamed', 'Male', 'Dhaka', '00', 'Student', 'Second Year', 'Banned'),
(54, 'Jas', 'Min', 'Female', 'Dhaka', '009', 'Student', 'Second Year', 'Active'),
(55, 'Fardin', 'Islam', 'Male', 'Dhaka', '0082', 'Student', 'Fourth Year', 'Active'),
(56, 'Renzo', 'Pedroso', 'Male', 'Dhaka', '08080', 'Student', 'Third Year', 'Active'),
(57, 'Eleazar', 'Duterte', 'Male', 'Dhaka', '90902', 'Student', 'Second Year', 'Active'),
(58, 'Ellen', 'Espino', 'Female', 'Dhaka', '123', 'Student', 'First Year', 'Active'),
(59, 'Ruth', 'Magbanua', 'Female', 'Dhaka', '9340', 'Student', 'Second Year', 'Active'),
(60, 'Shaina', 'Gabino', 'Female', 'Dhaka', '132134', 'Student', 'Second Year', 'Active'),
(62, 'Chairty', 'Punzalan', 'Female', 'Dhaka', '12423', 'Teacher', 'Faculty', 'Active'),
(63, 'Kristine', 'Dela Rosa', 'Female', 'Dhaka', '1321', 'Student', 'Second Year', 'Active'),
(64, 'Chinie', 'Laborosa', 'Female', 'Dhaka', '902101', 'Student', 'Second Year', 'Active'),
(65, 'Ruby', 'Morante', 'Female', 'Dhaka', '', 'Teacher', 'Faculty', 'Active');

INSERT INTO book (book_id, book_title, category_id, author, book_copies, book_pub, publisher_name, isbn, copyright_year, date_receive, date_added, status) VALUES
(15, 'Natural Resources', 8, 'Robin Kerrod', 15, 'Marshall Cavendish Corporation', 'Marshall', '1-85435-628-3', 1997, NULL, '2013-12-11 06:34:27', 'New'),
(16, 'Encyclopedia Americana', 5, 'Grolier', 20, 'Connecticut', 'Grolier Incorporation', '0-7172-0119-8', 1988, NULL, '2013-12-11 06:36:23', 'Archive'),
(17, 'Algebra 1', 3, 'Carolyn Bradshaw, Michael Seals', 35, 'Pearson Education, Inc', 'Prentice Hall, New Jersey', '0-13-125087-6', 2004, NULL, '2013-12-11 06:39:17', 'Damage'),
(18, 'The Philippine Daily Inquirer', 7, '..', 3, 'Pasay City', '..', '..', 2013, NULL, '2013-12-11 06:41:53', 'New'),
(19, 'Science in our World', 4, 'Brian Knapp', 25, 'Regency Publishing Group', 'Prentice Hall, Inc', '0-13-050841-1', 1996, NULL, '2013-12-11 06:44:44', 'Lost'),
(20, 'Literature', 9, 'Greg Glowka', 20, 'Regency Publishing Group', 'Prentice Hall, Inc', '0-13-050841-1', 2001, NULL, '2013-12-11 06:47:44', 'Old'),
(21, 'Lexicon Universal Encyclopedia', 5, 'Lexicon', 10, 'Lexicon Publication', 'Pulication Inc., Lexicon', '0-7172-2043-5', 1993, NULL, '2013-12-11 06:49:53', 'Old'),
(22, 'Science and Invention Encyclopedia', 5, 'Clarke Donald, Dartford Mark', 16, 'H.S. Stuttman inc. Publishing', 'Publisher , Westport Connecticut', '0-87475-450-x', 1992, NULL, '2013-12-11 06:52:58', 'New'),
(23, 'Integrated Science Textbook ', 4, 'Merde C. Tan', 15, 'Vibal Publishing House Inc.', '12536. Araneta Avenue Corner Ma. Clara St., Quezon City', '971-570-124-8', 2009, NULL, '2013-12-11 06:55:27', 'New'),
(24, 'Algebra 2', 3, 'Glencoe McGraw Hill', 15, 'The McGrawHill Companies Inc.', 'McGrawhill', '978-0-07-873830-2', 2008, NULL, '2013-12-11 06:57:35', 'New'),
(25, 'Wiki at Panitikan ', 7, 'Lorenza P. Avera', 28, 'JGM & S Corporation', 'JGM & S Corporation', '971-07-1574-7', 2000, NULL, '2013-12-11 06:59:24', 'Damage'),
(26, 'English Expressways TextBook for 4th year', 9, 'Virginia Bermudez Ed. O. et al', 23, 'SD Publications, Inc.', 'Gregorio Araneta Avenue, Quezon City', '978-971-0815-33-8', 2007, NULL, '2013-12-11 07:01:25', 'New'),
(27, 'Asya Pag-usbong Ng Kabihasnan ', 8, 'Ricardo T. Jose, Ph . D.', 21, 'Vibal Publishing House Inc.', 'Araneta Avenue . Cor. Maria Clara St., Quezon City', '971-07-2324-3', 2008, NULL, '2013-12-11 07:02:56', 'New'),
(28, 'Literature (the readers choice)', 9, 'Glencoe McGraw Hill', 20, '..', 'the McGrawHill Companies Inc', '0-02-817934-x', 2001, NULL, '2013-12-11 07:05:25', 'Damage'),
(29, 'Beloved a Novel', 9, 'Toni Morrison', 13, '..', 'Alfred A. Knoff, Inc', '0-394-53597-9', 1987, NULL, '2013-12-11 07:07:02', 'Old'),
(30, 'Silver Burdett Engish', 2, 'Judy Brim', 12, 'Silver Burdett Company', 'Silver', '0-382-08575-5', 1985, NULL, '2013-12-11 09:22:50', 'Old'),
(31, 'The Corporate Warriors (Six Classic Cases in American Business)', 8, 'Douglas K. Ramsey', 8, 'Houghton Miffin Company', '..', '0-395-35487-0', 1987, NULL, '2013-12-11 09:25:32', 'Old'),
(32, 'Introduction to Information System', 9, 'Cristine Redoblo', 10, 'CHMSC', 'Brian INC', '123-132', 2013, NULL, '2014-01-17 19:00:10', 'New');

INSERT INTO borrow (borrow_id, member_id, date_borrow, due_date) VALUES
(484, 55, '2025-08-20 23:50:27', '2025-08-21'),
(483, 55, '2025-08-20 23:49:34', '2025-08-21'),
(482, 52, '2025-08-20 23:38:22', '2025-09-08');

INSERT INTO borrowdetails (borrow_details_id, book_id, borrow_id, borrow_status, date_return) VALUES
(164, 16, 484, 'pending', NULL),
(162, 15, 482, 'pending', NULL),
(163, 15, 483, 'returned', '2025-09-01 00:30:51');

INSERT INTO type (id, borrowertype) VALUES
(2, 'Teacher'),
(20, 'Employee'),
(21, 'Non-Teaching'),
(22, 'Student'),
(32, 'Contruction');

INSERT INTO users (user_id, username, password, firstname, lastname) VALUES
(2, 'admin', 'admin', 'Antu', 'A');
