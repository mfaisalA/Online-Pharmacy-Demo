-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2018 at 12:40 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gulfmedical`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `order_type` int(11) NOT NULL,
  `process_status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_ship_address` text NOT NULL,
  `cpr_copy` varchar(255) NOT NULL,
  `prescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `customer_id`, `sub_total`, `discount`, `grand_total`, `total_qty`, `payment_type`, `order_type`, `process_status`, `order_status`, `customer_contact`, `customer_ship_address`, `cpr_copy`, `prescription`) VALUES
(70, '2017-11-06 14:33:30', 46, '5', '0', '5', 1, 2, 1, 1, 1, '32654890', 'Building 67, Road 89, Block 0998, Amwaj', '', ''),
(71, '2018-03-06 12:35:04', -1, '224', '0', '224', 2, 1, 1, 1, 0, '35698001', 'Riffa', '', ''),
(73, '2018-03-06 15:18:38', 47, '15', '0', '15', 3, 2, 2, 1, 1, '38656542', 'Isa Town', '', ''),
(74, '2018-03-06 15:24:04', 47, '10', '0', '10', 2, 1, 1, 1, 1, '38656542', 'Isa Town', '', 'uploads/743175.jpg'),
(75, '2018-03-07 11:56:14', -1, '11', '0', '11.5', 1, 1, 1, 1, 1, '35698001', 'Flat 108, Road 258, Block 685, Manama', '', 'uploads/754865.jpg'),
(76, '2018-03-07 11:57:13', -1, '11', '0', '11', 1, 2, 2, 1, 1, '35698001', 'Flat 108, Road 258, Block 685, Manama', '', 'uploads/754865.jpg'),
(77, '2018-03-07 11:57:48', -1, '11', '0', '11', 1, 2, 2, 1, 1, '35698001', 'Flat 108, Road 258, Block 685, Manama', '', 'uploads/754865.jpg'),
(78, '2018-03-19 00:39:40', 12, '11', '0', '11', 1, 2, 2, 1, 1, '32056025', 'house 502, road 2542, block 789, muharraq', '', 'uploads/786486.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `rate`, `total`, `order_item_status`) VALUES
(310, 70, 7, '1', '5', '5', 1),
(311, 71, 4, '2', '112', '224', 1),
(313, 73, 7, '1', '5', '5', 1),
(314, 73, 8, '2', '5', '10', 1),
(315, 74, 7, '1', '5', '5', 1),
(316, 74, 8, '1', '5', '5', 1),
(317, 75, 4, '1', '11', '11', 1),
(318, 76, 4, '1', '11', '11', 1),
(319, 77, 4, '1', '11', '11', 1),
(320, 78, 4, '1', '11', '11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `image_1` varchar(255) NOT NULL,
  `image_2` varchar(255) NOT NULL,
  `image_3` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `stock_status` tinyint(4) NOT NULL,
  `product_status` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_code`, `product_name`, `product_price`, `product_desc`, `image_1`, `image_2`, `image_3`, `qty`, `stock_status`, `product_status`, `status`, `created_date`, `modified_date`) VALUES
(1, 1, 'BGF', 'Gauldian Finch', '1.5', 'The&nbsp;Gouldian finch&nbsp;(Erythrura gouldiae), also known as the&nbsp;Lady Gouldian finch,&nbsp;Gould&#39;s finch&nbsp;or the&nbsp;rainbow finch, is a colourful&nbsp;passerine&nbsp;bird&nbsp;endemic&nbsp;to&nbsp;Australia. There is strong evidence of a continuing decline, even at the best-known site near&nbsp;Katherine&nbsp;in the&nbsp;Northern Territory.', '../productImage/75583.jpg', '21502280098.png', '', -48, 1, 1, 0, '2017-08-07 17:27:00', '2017-09-23 15:22:49'),
(2, 2, 'TESTI7', 'Apple  iPhone 7', '500', '<span style=\"color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\">The Red color has always been a symbol of class and luxury and so has the brand Apple. Make this device is an extension of your personality with its streamlined body, incredibly forward technologies, and a friendly interface that can be customized to suit your requirements. The 12MP camera is now improved with a larger f/1.8 aperture and front camera that is upgraded to 7MP with an optical image stabilization that will surely take away your struggle to get the best selfies. Equipped with 128GB of storage capacity, you can store tons of data on your device and fetch it when required. The Apple iPhone 7 Plus has so much to do and experiment with and this is made possible by the unbeatable iOS 10 operating system, which is faster than ever before giving you an unmatched user experience. Thanks to the 4G LTE support, you have the power to access the fastest Internet connections</span><br>', '11502280270.jpg', '21502280270.jpg', '', -13, 0, 1, 0, '2017-08-07 18:19:14', '2017-08-15 16:57:28'),
(3, 3, 'CLHPP458', 'HP 2In1 Notebook Pavilion X2-10-P000NE Atom Red', '100', '<h4 style=\"font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" color:=\"\" rgb(51,=\"\" 51,=\"\" 51);=\"\" font-size:=\"\" 18px;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"><span style=\"font-weight: bold;\">HP 2In1 Notebook Pavilion X2-10-P000NE Atom Red</span></h4><p style=\"line-height: 21px; color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"><span style=\"font-weight: bold;\">General</span></p><p style=\"line-height: 21px; color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"></p><ul style=\"color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"><li style=\"line-height: 21px; margin-bottom: 5px;\">OS:<span style=\"font-size: 12px;\">Windows 10&nbsp;</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\">Processor:<span style=\"font-size: 12px;\">Intel Atom Dual Core&nbsp;</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\">Color:<span style=\"font-size: 12px;\">Red&nbsp;</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\">Weight:<span style=\"font-size: 12px;\">2200g&nbsp;</span><br></li></ul><p style=\"line-height: 21px; color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"></p><p style=\"line-height: 21px; color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"><span style=\"font-weight: bold;\">Display</span></p><p style=\"line-height: 21px; color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"></p><ul style=\"color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"><li style=\"line-height: 21px; margin-bottom: 5px;\">Size:<span style=\"font-size: 12px;\">10.1 inches &nbsp;</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\">Display Type:<span style=\"font-size: 12px;\">HD LED-backlit Display&nbsp;</span><br></li></ul><p style=\"line-height: 21px; color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"></p><p style=\"line-height: 21px; color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"><span style=\"font-weight: bold;\">Storage</span></p><p style=\"line-height: 21px; color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"></p><ul style=\"color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"><li style=\"line-height: 21px; margin-bottom: 5px;\">HDD:<span style=\"font-size: 12px;\">32GB&nbsp;</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\">RAM:<span style=\"font-size: 12px;\">2GB&nbsp;</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\">Graphic Memory:<span style=\"font-size: 12px;\">Intel HD graphics &nbsp;</span><br></li></ul><p style=\"line-height: 21px; color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"></p><p style=\"line-height: 21px; color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"><span style=\"font-weight: bold;\">Connectivity</span></p><p style=\"line-height: 21px; color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"></p><ul style=\"color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.5px;\"=\"\"><li style=\"line-height: 21px; margin-bottom: 5px;\">WiFi:<span style=\"font-size: 12px;\">Yes&nbsp;</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\">Ethernet LAN:<span style=\"font-size: 12px;\">Yes&nbsp;</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\">Bluetooth:<span style=\"font-size: 12px;\">Yes&nbsp;</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\">HDMI:<span style=\"font-size: 12px;\">Yes&nbsp;</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\">USB<span style=\"font-size: 12px; white-space: pre;\">	</span><span style=\"font-size: 12px;\">2 x USB 2.0&nbsp;</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\">Web Camera:<span style=\"font-size: 12px;\">Yes&nbsp;</span></li></ul>', '11502278866.jpg', '21502278866.jpg', '31502278866.jpg', 15, 0, 1, 0, '2017-08-09 14:41:06', '2017-08-16 19:36:19'),
(4, 5, 'ATN', 'Atenolol', '11', 'Atenolol&nbsp;is a selective&nbsp;Î²1&nbsp;receptor&nbsp;antagonist, a drug belonging to the group of&nbsp;beta blockers&nbsp;(sometimes written Î²-blockers), a class of drugs used primarily in&nbsp;cardiovascular diseases. Introduced in 1976, atenolol was developed as a replacement for&nbsp;propranolol&nbsp;in the treatment of&nbsp;hypertension. It works by slowing down the heart and reducing its workload. Unlike&nbsp;propranolol, atenolol does not readily pass through the&nbsp;bloodâ€“brain barrier, thus decreasing the incidence of&nbsp;central nervous system&nbsp;side effects.', '../productImage/8507.jpg', '', '', 7, 0, 1, 1, '2017-08-11 18:51:21', '2017-09-24 12:39:13'),
(5, 1, 'BKFD101', 'SLOW COOKING', '5', '<p style=\"line-height: 21px; color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, sans-serif; letter-spacing: 0.5px;\">Brilliant new cookery series, each with 45 stunning recipes giving step-by-step instructions and ingredients list. A wide selection and growing range of titles provides complete kitchen library with endless variety.</p><p style=\"line-height: 21px; color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, sans-serif; letter-spacing: 0.5px;\"><span style=\"font-weight: bold;\">Product Details</span></p><p style=\"line-height: 21px; color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, sans-serif; letter-spacing: 0.5px;\"></p><ul style=\"color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, sans-serif; letter-spacing: 0.5px;\"><li style=\"line-height: 21px; margin-bottom: 5px;\"><span style=\"line-height: 1.42857;\">Series: Food Lovers</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\"><span style=\"line-height: 1.42857;\">Paperback: 96 pages</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\"><span style=\"line-height: 1.42857;\">Publisher: Trans Atlantic (January 1, 2011)</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\"><span style=\"line-height: 1.42857;\">Language: English</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\"><span style=\"line-height: 1.42857;\">ISBN-10: 1907176489</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\"><span style=\"line-height: 1.42857;\">ISBN-13: 978-1907176487</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\"><span style=\"line-height: 1.42857;\">Product Dimensions: 8.5 x 0.4 x 10.6 inches</span><br></li><li style=\"line-height: 21px; margin-bottom: 5px;\"><span style=\"line-height: 1.42857;\">Shipping Weight: 13.4 ounces</span></li></ul>', '11506246594.jpg', '', '', 25, 0, 1, 0, '2017-09-24 12:49:54', '0000-00-00 00:00:00'),
(6, 1, 'CH2', 'Charging Cables', '6', '1 meter long charging cables', '../productImage/64315.png', '', '', 100, 0, 1, 0, '2017-10-03 13:22:16', '2017-10-15 11:35:02'),
(7, 5, 'GFH', 'Panadol Extra', '5', 'Panadol Extra is ideal for those who want the benefits of Panadol, plus a little more pain relieving effect on mild to moderate pain such as headaches, toothaches and period pain. The ingredients in Panadol Extra provide upto 37% more powerful pain relief than standard paracetamol. It is also gentle on stomach when used as directed', '../productImage/74561.jpg', '', '', -16, 0, 1, 1, '2017-10-29 12:54:52', '0000-00-00 00:00:00'),
(8, 5, 'SFC', 'Sofvasc-HCT', '5', 'Sofvasc (Amlodipine) is used for Increased Blood Pressure or Angina (Chest/Heart Pain)This product may also be used for purposes not listed in this medication guide.', '../productImage/71471.jpg', '', '', -3, 0, 1, 1, '2018-03-06 14:33:24', '0000-00-00 00:00:00'),
(9, 2, 'BPM', 'Omron HEM-7120 Automatic Blood Pressure Monitor', '55', 'OverviewOmron Hem-7120 Blood Presure Monitor is a multi-purpose multi utility device that can help you keep a regular and proper check on your blood pressure levels. This high quality health device is manufactured by&nbsp;Omron&nbsp;which is a very reputable and famous company in selling health product and health monitors.Design and ComfortOmron Hem-7120 Blood Pressure Monitor lets you measure your blood pressure as well as pulse within a few seconds. This amazing device is easy to use and lets you take correct and accurate measurement of your blood pressure levels. It is a device that will help you stay healthy and fit. It is one device that is must in your home in case you are suffering from Bp or someone in your family is suffering from the same.FeaturesThis monitor comes with a large LCD screen which displays the vitals clearly and accurately. The machine is light in weight and helps in accurate measurement of blood pressure with hypertension indication for timely action and accurate detection of irregular heartbeat. The monitor is made using high quality materials that ensure that it stays durable and reliable for long years to come.', '../productImage/86867.jpg', '', '', 0, 0, 1, 1, '2018-03-06 14:47:51', '0000-00-00 00:00:00'),
(10, 2, 'ACC', 'Accu Chek Active Glucose Monitor + FREE 10 Test Strips', '62.5', 'Overview Check your blood glucose hassle free with the Accu-Chek Active Glucose Monitor. Available on Snapdeal, the Accu-Chek Active Glucose Monitor is compact and handy and comes with a pack of 10 strips which helps you check your blood glucose from the comfort of your home and provides accurate results for the same. Design Accu-Chek Active Glucose Monitor is light in weight and easy to use. It provides fast and accurate results in a couple of seconds.The Accu-Chek Active Glucose Monitor is compact and handy which makes it easy to be carried around with you as well. It is pain free and gives you accurate results at all times. It has simple auto coding and provides you complete and immediate results. Features This monitor enables you to get accurate results with very small amount of blood and has a record of your readings in the past. It has a LED screen which helps you read the result easily and the monitor is extremely easy to use as well. Suitable for self care, this monitor and strips combo will ensure you do not need to rush to a doctor for a blood glucose check up.', '../productImage/92309.jpg', '', '', 0, 0, 1, 1, '2018-03-06 14:57:07', '0000-00-00 00:00:00'),
(11, 1, 'ETB', 'Electric Toothbrush', '2.8', 'Omron sonic type electric toothbrush media clean HT-B551 Japan Import', '../productImage/106782.jpg', '', '', 0, 0, 1, 1, '2018-03-06 15:01:00', '0000-00-00 00:00:00'),
(12, 3, 'OSC', 'Olay Imported Day Cream 50 gm', '12', 'A daily facial moisturiser that provides 7 anti-ageing benefits in 1, plus SPF 15 to help protect against sun exposure. Total Effects UV is fortified with SPF 15 that prevents your skin from the harmful ageing effects of UVA and UVB rays. This is suited especially for a hectic lifestyle that requires you to spend time outdoors in the sun. Science behind Olay Total Effects-Olay Total Effects provides a breadth of benefits to deliver the beautiful younger looking skin women want and the healthy skin they need. The key to this is a combination of two ingredients VitaNiacin and Anti-Oxidants, which together work to fight 7 signs of ageing and give younger looking skin. Helps fight 7 signs of ageing Total Effects is the result of years of state-of-the-art anti-ageing research. It is our answer to the needs of all skin types. It has been specially formulated to help fight 7 signs of ageing. 1. Visibly reduces dark spots 2. Gives firm-looking skin 3. Radiant, glowing skin 4. Visibly reduces lines wrinkles 5. Gives soft smooth skin 6. Gives even skin tone 7. Visibly reduces pore size Directions for Use: 1. Press the pump gently to release a pea sized amount of the product. This amount should be enough to cover the face area. 2. Using your fingertips, apply the product to your face and neck with gentle, circular movements. 3. For best results use in conjunction with Olay Total Effects Cleanser.', '../productImage/112758.jpg', '', '', 0, 0, 1, 1, '2018-03-06 15:03:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `category_code` varchar(10) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL,
  `label_color` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `category_code`, `category_name`, `is_active`, `status`, `label_color`, `created_date`) VALUES
(1, 'DCP', 'Dental Care', 1, 1, '#3fb7d2', '2017-08-07 14:00:00'),
(2, 'MEQ', 'Medical Equipments', 1, 1, '#15c01c', '2017-08-07 14:10:00'),
(3, 'SCP', 'Skin Care', 1, 1, '#ff9e29', '2017-08-07 14:10:00'),
(5, 'MED', 'Medicines', 1, 1, '', '2017-12-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `site_visits`
--

CREATE TABLE `site_visits` (
  `id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_visits`
--

INSERT INTO `site_visits` (`id`, `count`) VALUES
(1, 1027);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(12) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `uemail` varchar(50) NOT NULL,
  `upassword` varchar(256) NOT NULL,
  `ucontact` varchar(255) NOT NULL,
  `address` text,
  `cpr` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `uname`, `uemail`, `upassword`, `ucontact`, `address`, `cpr`, `status`, `created_date`) VALUES
(4, 'Saleh Ahmed', 'saleh@gmail.com', '$2y$10$.B/k8XqVBNM2TNf9r2IuF.NEvu6Yd3/KNdMlfzEhi3zx/J.dpyRW2', '36553256', 'umm-al-hassam', '', 0, '2017-08-23 02:17:29'),
(12, 'Inam Ul Haqq', 'inam@hotmail.com', '$2y$10$5j9lDbHlJiu3WaaOz6o/reaTQw2uHfKrMjbwaDLwikj0j1Q.n9DP6', '32056025', 'address\r\n', '', 1, '2017-08-28 14:22:21'),
(44, 'Mohammad Jaffer', 'jaffer@yahoo.com', '$2y$10$TNWhQBwK1tSCKJHx8kIOYe8tLTiy6vvORBc0l.rksydjoX4byLooa', '32654898', 'Manama', '', 1, '2017-10-09 05:12:43'),
(45, 'Abur Rehman', 'adurrehman@mail.com', '$2y$10$y6Vk.6.T5.xq.LkuPPp20eOPVE4.Y6SkuDJBQSeZVtpeY/E7f9z.y', '32654898', 'Hamad Town', '3989659545', 1, '2017-10-28 05:12:00'),
(46, 'Rashid Mehmod', 'rashid@gmail.com', '$2y$10$TUgMLGGpeD5m2V8gq9qwRuZpFE.a.ld3Ce2KDl2d8F6lk49eKGBCq', '32654890', 'Building 67, Road 89, Block 0998, Amwaj', '856954020', 1, '2017-10-28 23:02:13'),
(47, 'Maryam Al Hamad', 'maryam@gmail.com', '$2y$10$bAtTlmIw1vWtHDvm9KBf7u0iG7sxONGoqFoy/trxMxRr7cBNl/Hl.', '38656542', 'Isa Town', '', 1, '2018-03-06 15:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_chat_messages`
--

CREATE TABLE `user_chat_messages` (
  `id` int(11) NOT NULL,
  `message_content` text NOT NULL,
  `username` varchar(20) NOT NULL,
  `message_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `recipient` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_chat_messages`
--

INSERT INTO `user_chat_messages` (`id`, `message_content`, `username`, `message_time`, `recipient`) VALUES
(1, 'hi', 'Admin', '2018-01-30 16:34:54', 'Abur Rehman'),
(2, 'hi', 'Admin', '2018-01-30 16:39:43', 'Abur Rehman'),
(3, 'hi', 'Abur Rehman', '2018-01-30 16:41:09', 'Abur Rehman'),
(5, 'hello', 'Admin', '2018-01-30 16:43:57', 'Inam Ul Haqq'),
(6, 'hi', 'Inam Ul Haqq', '2018-01-30 18:11:28', 'Admin '),
(7, 'how can I help you', 'Admin', '2018-01-30 18:15:14', 'Inam Ul Haqq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `user_chat_messages`
--
ALTER TABLE `user_chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `user_chat_messages`
--
ALTER TABLE `user_chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
