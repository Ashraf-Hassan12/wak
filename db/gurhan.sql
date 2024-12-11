-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 07:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gurhan`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `academic_year_sp` (IN `_name` VARCHAR(100))   BEGIN
if EXISTS(SELECT id FROM years WHERE name=_name)THEN
SELECT concat('danger|',_name,' Horay ayaa lo diwan galiyay');
ELSE

UPDATE years SET status=0;
INSERT INTO years(name)
VALUES(_name);

SELECT concat('succes|',_name,' waala diwan galiyay');
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `change_pasword_sp` (`_user_id` INT, `_old_P` TEXT, `_new_p` TEXT, `_confirm` TEXT)   BEGIN


IF NOT EXISTS(SELECT * FROM users WHERE id=_user_id AND password=_old_P)THEN
SELECT concat('danger| Old password is incorrect');
ELSEIF EXISTS(SELECT * FROM users WHERE id=_user_id AND password=_new_p)THEN
SELECT concat('warning| Old password is not match new password');
ELSE
UPDATE users SET password =_new_p WHERE id=_user_id;
SELECT concat('success| Password Change');


END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `charts_sp` (IN `_user_id` INT)   BEGIN

SELECT *,chart_count(action)Counts FROM charts ORDER BY sort ASC;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login_sp` (IN `_username` VARCHAR(100), IN `_password` VARCHAR(150))   BEGIN

if EXISTS(SELECT * FROM users WHERE username=_username AND password =_password AND status='active')THEN

SELECT id user_id,username,image FROM users WHERE username=_username AND password =_password AND status='active';

ELSE
SELECT 'Username or password incorrect' as error;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reset_pass_sp` (IN `_user_id` INT, IN `_new_passw` TEXT)   BEGIN

UPDATE users SET password =_new_passw WHERE id=_user_id;
SELECT concat('Password Changed');


END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `chart_count` (`_action` TEXT) RETURNS VARCHAR(100) CHARSET utf8 COLLATE utf8_general_ci  BEGIN
SET @cc = 0;
if(_action='users')THEN
SELECT count(id) INTO @cc FROM users;

ELSEIF(_action='flights')THEN
SELECT count(id) INTO @cc FROM flights;

ELSEIF(_action='customers')THEN
SELECT count(id) INTO @cc FROM customers;


END IF;

RETURN @cc;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `name`, `date`) VALUES
(3, 'IPS BANK', '2024-07-08'),
(4, 'SAHAL', '2024-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `flights_id` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `customer_id`, `flights_id`, `price`, `date`) VALUES
(8, 5, 6, 380, '2024-07-02'),
(9, 6, 6, 25, '2024-07-02'),
(10, 7, 6, 600, '2024-07-12'),
(11, 8, 6, 50, '2024-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `charge_salary`
--

CREATE TABLE `charge_salary` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `month_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `charge_salary`
--

INSERT INTO `charge_salary` (`id`, `employee_id`, `amount`, `month_id`, `year_id`, `date`) VALUES
(9, 8, 100, 1, 1, '2024-07-01'),
(10, 8, 300, 1, 1, '2024-07-01'),
(11, 9, 300, 1, 1, '2024-07-01'),
(12, 8, 180, 3, 1, '2024-07-13'),
(13, 10, 100, 1, 1, '2024-07-13'),
(14, 8, 300, 3, 1, '2024-07-13'),
(15, 8, 300, 1, 1, '2024-07-13'),
(16, 12, 500, 1, 1, '2024-07-13');

--
-- Triggers `charge_salary`
--
DELIMITER $$
CREATE TRIGGER `charge_sl` AFTER INSERT ON `charge_salary` FOR EACH ROW UPDATE employees e SET e.salary = (e.salary + new.amount)  WHERE e.id= new.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_emp_sal` AFTER INSERT ON `charge_salary` FOR EACH ROW BEGIN
  UPDATE employees e 
  SET e.salary = e.salary + NEW.amount  
  WHERE e.id = NEW.employee_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_emp_salary` AFTER INSERT ON `charge_salary` FOR EACH ROW UPDATE employees e SET e.salary = (e.salary + new.amount)  WHERE e.id= new.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `charts`
--

CREATE TABLE `charts` (
  `id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `text` varchar(150) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `charts`
--

INSERT INTO `charts` (`id`, `action`, `color`, `icon`, `text`, `sort`) VALUES
(1, 'users', 'bg-danger', 'fa fa-users', 'Total Users', 1),
(2, 'flights', 'bg-success', 'fa fa-plane', 'Total Flights', 2),
(3, 'customers', 'bg-info', 'fa fa-users', 'Total Customer', 3);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `Tell` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `sex_id` int(11) NOT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `Tell`, `Email`, `sex_id`, `Date`) VALUES
(5, ' Hassan Abdulle Jamac', '0907885860', 'isqamsiqam@gmail.com', 1, '2024-06-30'),
(6, ' Hassan Abdulle', '0907885867', 'isqamsiqam2@gmail.com', 1, '2024-07-01'),
(7, 'Khadijo Jama', '0907885867', 'isqamsiqam2@gmail.com', 2, '2024-07-04'),
(8, 'Dhuuxay Jama', '09078858676', 'isqamsiqam@gmail.com', 2, '2024-07-04'),
(9, 'Abdirahim Ali Abukar', '9876543', 'Zeynaad41@gmail.com', 1, '2024-07-13'),
(10, 'Asia', '345678', 'Zeynaad41@gmail.com', 2, '2024-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `name`, `date`) VALUES
(4, 'Mugadisho', '2024-05-20'),
(5, 'Garowe', '2024-05-20'),
(7, 'Gado', '2024-06-30'),
(8, '1234', '0000-00-00'),
(9, '1234', '0000-00-00'),
(10, '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Tell` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `sex_id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL,
  `salary` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `Tell`, `Email`, `sex_id`, `title_id`, `salary`, `date`) VALUES
(8, 'Ashraf Hassan', '0907885867', 'isqamsiqam2@gmail.com', 1, 1, 560, '2024-07-31'),
(9, 'Faarax Geedi', '0907885867', 'isqamsiqam@gmail.com', 1, 1, 0, '2024-07-01'),
(10, 'Qaalib Faarax', '0907885867', 'isqamsiqam@gmail.com', 1, 1, 700, '2024-07-08'),
(11, 'Abdirahim Ali', '0617493218', 'abdyrahi@gmail.com', 1, 1, 2000, '2024-07-13'),
(12, 'Abdirahim Ali Abukar', '9876543', 'Zeynaad41@gmail.com', 1, 1, 1000, '2024-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `airplane` varchar(100) DEFAULT NULL,
  `fromm` varchar(100) NOT NULL,
  `too` varchar(100) NOT NULL,
  `departure_airport` varchar(100) DEFAULT NULL,
  `arrival_airport` varchar(100) DEFAULT NULL,
  `price` double NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `name`, `airplane`, `fromm`, `too`, `departure_airport`, `arrival_airport`, `price`, `date`) VALUES
(3, 'Abdishakur Hassan Abdulle', '1RD23', '0', '0', 'ugaas', 'xer', 200, '2024-06-30'),
(5, 'Freadom', '1RD23', '4', '5', 'ugas ', 'xer', 200, '2024-07-02'),
(6, 'Freadom', '1RD23', 'Galdogob', 'Gaarisa', 'ugas ', 'xer', 200, '2024-07-02'),
(7, 'FLY', 'AS3', 'LAASKA', 'GEDO', 'DSS', 'RFF', 200, '2024-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `name`, `date`) VALUES
(1, 'Manager', '2024-05-20'),
(3, 'SAHAL', '2024-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `ordes` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`id`, `name`, `date`, `ordes`) VALUES
(1, 'January', '2023-03-21', '6'),
(2, 'February', '2023-03-21', '7'),
(3, 'March', '2023-03-21', '8'),
(4, 'April', '2023-03-21', '9'),
(5, 'May', '2023-03-21', '10'),
(6, 'June', '2023-03-21', '11'),
(7, 'July', '2023-03-21', '12'),
(8, 'August', '2023-03-21', '1'),
(9, 'September', '2023-03-21', '2'),
(10, 'OctOber', '2023-03-21', '3'),
(11, 'November', '2023-03-21', '4'),
(12, 'December', '2023-03-21', '5');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `account_id`, `amount`, `description`, `date`) VALUES
(1, 0, 200, 'Addeg', '2024-07-01'),
(2, 1, 300, 'Addeg Iyo ', '2024-07-02'),
(4, 1, 500, 'RENT', '2024-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `pay_salary`
--

CREATE TABLE `pay_salary` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `month_id` int(11) DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pay_salary`
--

INSERT INTO `pay_salary` (`id`, `employee_id`, `amount`, `account_id`, `month_id`, `year_id`, `date`) VALUES
(1, 8, 100, 1, 1, 1, '2024-07-01'),
(2, 8, 25, 1, 1, 1, '2024-07-01'),
(3, 8, 10, 1, 1, 1, '2024-07-01'),
(4, 10, 600, 1, 1, 1, '2024-07-13'),
(5, 10, 300, 1, 2, 1, '2024-07-13'),
(6, 8, 400, 1, 4, 0, '2024-07-13'),
(7, 9, 300, 1, 3, 1, '2024-07-13'),
(8, 12, 100, 1, 1, 1, '2024-07-13');

--
-- Triggers `pay_salary`
--
DELIMITER $$
CREATE TRIGGER `update_emp_salary_after_payment` AFTER INSERT ON `pay_salary` FOR EACH ROW BEGIN
  UPDATE employees e 
  SET e.salary = e.salary - NEW.amount  
  WHERE e.id = NEW.employee_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`id`, `customer_id`, `amount`, `description`, `date`) VALUES
(6, 5, 25, 'Addeg', '2024-07-02'),
(7, 6, 20, 'Addeg Iyo ', '2024-07-02'),
(8, 8, 2, 'h', '2024-07-02'),
(9, 6, 3, 'Kiroo', '2024-07-02'),
(10, 0, 3, '', '2024-07-02');

--
-- Triggers `receipt`
--
DELIMITER $$
CREATE TRIGGER `update_rece` AFTER INSERT ON `receipt` FOR EACH ROW BEGIN
  UPDATE booking e 
  SET e.price = e.price - NEW.amount  
  WHERE e.customer_id = NEW.customer_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sex`
--

CREATE TABLE `sex` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sex`
--

INSERT INTO `sex` (`id`, `name`, `date`) VALUES
(1, 'Male', '2024-05-20'),
(2, 'Female', '2024-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `tuur`
--

CREATE TABLE `tuur` (
  `id` int(11) NOT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `current_balance` float DEFAULT NULL,
  `paid` float DEFAULT NULL,
  `remained` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `new_balance` float DEFAULT NULL,
  `regdate` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tuur`
--

INSERT INTO `tuur` (`id`, `cust_id`, `current_balance`, `paid`, `remained`, `discount`, `new_balance`, `regdate`) VALUES
(3, 0, 695, 10, 685, 5, 680, '2024-07-04'),
(4, 6, 80, 10, 70, 5, 65, '2024-07-03'),
(5, 6, 65, 5, 60, 10, 50, '2024-07-04'),
(6, 6, 50, 15, 35, 10, 25, '2024-07-04'),
(7, 5, 680, 80, 600, 100, 500, '2024-07-12'),
(8, 7, 700, 80, 620, 20, 600, '2024-07-13'),
(9, 5, 500, 20, 480, 100, 380, '2024-07-13'),
(10, 8, 700, 600, 100, 50, 50, '2024-07-13');

--
-- Triggers `tuur`
--
DELIMITER $$
CREATE TRIGGER `update_booking_price` AFTER INSERT ON `tuur` FOR EACH ROW BEGIN
    UPDATE booking 
    SET price = NEW.new_balance 
    WHERE customer_id = NEW.cust_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'active',
  `regdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `emp_id`, `username`, `password`, `image`, `status`, `regdate`) VALUES
(23, 10, 'FAAR', '1234', 'sddefault (1).jpg', 'active', '2024-07-13'),
(24, 8, 'Asad', '1234', 'WhatsApp Image 2024-07-07 at 21.47.04.jpeg', 'active', '2024-07-08'),
(25, 10, 'Isqamg', '234', 'WhatsApp Image 2024-07-07 at 21.47.04.jpeg', 'active', '2024-07-08'),
(26, 10, 'cali', '123', 'WhatsApp Image 2024-07-07 at 21.47.04.jpeg', 'active', '2024-07-08'),
(27, 11, 'updyrahiimm', '3211', 'saar.jpg', 'active', '2024-07-13'),
(28, 11, 'aast', '123', 'Screenshot 2024-06-10 213840.png', 'active', '2024-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `xarun`
--

CREATE TABLE `xarun` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `domain` text NOT NULL,
  `logo` text NOT NULL,
  `letter_head` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `xarun`
--

INSERT INTO `xarun` (`id`, `name`, `tel`, `address`, `domain`, `logo`, `letter_head`, `date`) VALUES
(1, 'Travel  \nAgency', '66', 'kpp', 'locahost', 'uploads/logo.png', '', '2023-04-02 10:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `name`, `status`) VALUES
(1, '2024', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_id` (`customer_id`),
  ADD UNIQUE KEY `customer_id_2` (`customer_id`),
  ADD KEY `customer_id_3` (`customer_id`),
  ADD KEY `destination_id` (`flights_id`);

--
-- Indexes for table `charge_salary`
--
ALTER TABLE `charge_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charts`
--
ALTER TABLE `charts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_salary`
--
ALTER TABLE `pay_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sex`
--
ALTER TABLE `sex`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tuur`
--
ALTER TABLE `tuur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xarun`
--
ALTER TABLE `xarun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `charge_salary`
--
ALTER TABLE `charge_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `charts`
--
ALTER TABLE `charts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pay_salary`
--
ALTER TABLE `pay_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sex`
--
ALTER TABLE `sex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tuur`
--
ALTER TABLE `tuur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `xarun`
--
ALTER TABLE `xarun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
