-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2023 at 06:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_models`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `member_id` varchar(50) NOT NULL,
  `rating` varchar(5) NOT NULL,
  `text` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` longtext NOT NULL,
  `services` varchar(2000) DEFAULT NULL,
  `room_id` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `policies` mediumtext DEFAULT NULL,
  `contact` mediumtext DEFAULT NULL,
  `avg_rating` varchar(5) DEFAULT NULL,
  `province` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `name`, `details`, `services`, `room_id`, `location`, `policies`, `contact`, `avg_rating`, `province`) VALUES
('0', 'Super 8 by Wyndham Lethbridge', 'Super 8 is conveniently located less than a mile from Henderson Lake Park and approximately four miles from Lethbridge Airport. The property provides 56 nicely furnished guest rooms situated on two stories. While staying at the inn one can enjoy the complimentary continental breakfast while reading the daily newspaper. There is a heated indoor swimming pool and an exercise gym to suit the customers preferences. The hotel is close to restaurants and various attractions. One can come relax and enjoy the value at the Super 8. All rooms have air-conditioning in-room coffee clock radios modem lines irons and cable TV. Refrigerators and microwaves are available upon request.\r\n', 'Pet Friendly, Fitness Center, Internet Available, Free WiFi, Business Center, Meeting Rooms, Air Conditioning, Television, Breakfast Available, Free Breakfast, Parking Available, Free Parking, Laundry Room, Dry Cleaning', 'R0', '1030 Mayor Magrath Dr S, Lethbridge, AB T1K 2P8', NULL, NULL, NULL, 'Alberta'),
('1', 'Fairmont Le Chateau Frontenac Hotel', 'Standing high on a bluff overlooking the mighty St. Lawrence River the Fairmont Le Chateau Frontenac is located in the heart of Old Quebec City. Offering three exquisite dining opportunities and a distinctive Gallic charm this stately hotel stands above historic Old Quebec a United Nations World Heritage Site. A stay at the chateau permits you easy walking access to all of the sites and experiences that Old Quebec has to offer.In the late 19th century the hotel was built as an ideal stopover for Canadian Pacific (CP) Railway passengers. Drawing on the styles of the Middle Ages and the Renaissance architect Bruce Price immortalized the history of the two great powers that had occupied Quebec City\'s highest promontory. A new expansion phase was completed in 1993 with the inauguration of the Claude-Pratte Wing which offers guests a superb indoor pool a physical fitness center and a magnificent outdoor terrace. There is also a spa with masseur and steam bath. History casts a long architectural line at the Chateau: a 300-year-old stone bearing the Cross of Malta emblem is among the interior stones of the hotel\'s vaulted lobby. Countless personalities have graced Fairmont Le Chateau Frontenac with their presence including King George VI and Queen Elizabeth Princess Grace of Monaco Charles de Gaulle Ronald Reagan Francois Mitterrand Charles Lindberg and Alfred Hitchcock. In 1944 Fairmont Le Chateau Frontenac became the action center of the Quebec Conferences of World War II which involved U.S. President Franklin D. Roosevelt and British Prime Minister Winston Churchill.The chateau\'s 618 guest rooms are styled with chateau furnishings and regal decor and feature air-conditioning with individual climate control an alarm clock-radio cable television with in-room pay movies and video games coffee/tea maker hairdryer iron and ironing board mini-bar telephone equipped with voice-mail and windows that open to the outside.\r\n', 'Pet Friendly, Fitness Center, Internet Available, Business Center, Meeting Rooms, Family Rooms, Babysitting Available, Air Conditioning, Television, Restaurant, Room Service, Breakfast Available, Spa Services, Parking Available, Wheelchair Accessible, Dry Cleaning, Elevator, Non-Smoking Property', 'R1', '1 Rue des Carrieres, Quebec, QC G1R 4P5', NULL, 'Fairmont Le Chateau Frontenac Hotel welcomes two pets of any size for an additional fee of CAD 60 per night. Both dogs and cats are allowed, but pets may not be left unattended in rooms. Four-legged guests receive a bowl and blanket at check-in. There are no grassy areas on the property, but parks are within walking distance. For same day arrivals, please call 877‑411‑3436 to confirm availability of a pet-friendly room.', NULL, 'Quebec'),
('2', 'The Westin Harbour Castle Toronto', 'Make your escape to The Westin Harbour Castle, Toronto, a harbourfront hotel brimming with sophisticated style and amenities. Unwind in our hotel accommodations, featuring signature amenities like our Westin Heavenly® Bed and Westin Heavenly® Bath, along with Wi-Fi and stunning views of Lake Ontario. Find your balance in our WestinWORKOUT™ Fitness Studio, which includes yoga classes and a running concierge. Refuel in our array of dynamic dining destinations. Weddings and meetings take place in our 70,000 square feet of venue and convention centre space, including the 25,000-square-foot Metropolitan Ballroom.', 'Pet Friendly, Fitness Center, Internet Available, Business Center, Meeting Rooms, Air Conditioning, Television, Restaurant, Breakfast Available, Spa Services, Parking Available, Wheelchair Accessible, Dry Cleaning, Elevator, Non-Smoking Property', 'R2', '1 Harbour Square, Toronto, ON M5J 1A6', NULL, NULL, NULL, 'Ontario'),
('3', 'Fairmont Banff Springs', 'Styled after a Scottish baronial castle the Fairmont is located approximately 70 miles from Calgary International Airport. The Fairmont Banff Springs offers stunning vistas 27-hole golf course unparalleled skiing classic cuisine and Willow Stream a world class European-style spa. Dining options range from seven restaurants/eateries to four bar/lounges to wine tasting to Sunday Brunch to afternoon tea. Room service is available 24 hours a day. To assist you in making your selections a weekly dining guide is issued to each guest upon arrival.', 'Pet Friendly, Fitness Center, Internet Available, Free WiFi, Business Center, Meeting Rooms, Babysitting Available, Air Conditioning, Television, Restaurant, Room Service, Breakfast Available, Spa Services, Airport Shuttle, Parking Available, Laundry Room, Dry Cleaning, Elevator, Picnic Tables', 'R3', '405 Spray Ave, Banff, AB T1L 1J4', 'Fairmont Banff Springs welcomes two pets of any size for an additional fee of CAD 50 per night. Both dogs and cats are permitted, but pets may not be left unattended at any time. The hotel provides pet beds, bowls and treats. There are grassy areas for pet relief on the property.', NULL, NULL, 'Alberta'),
('4', 'Harrison Hot Springs Resort And Spa', 'Surrounded by forested mountains. Set beside a shimmering lake. Soaking in pools form natural hot springs. In a place no so far away. Escape to Harrison Hot Springs Resort and Spa. Today your adventure begins right outside our doors; hike canoe golf fish bike or bird watch. A hot stone massage in Healing Springs Spa and tonight dining and dancing in The Copper Room. Family vacation romantic getaway or a teambuilding retreat - there is something for everyone at Harrison Hot Springs Resort and Spa.', 'Pet Friendly, Fitness Center, Internet Available, Free WiFi, Television, Room Service, Breakfast Available, Spa Services, Parking Available', 'R4', '100 Esplanade, Harrison Hot Springs, BC V0M 1K1', 'Harrison Hot Springs Resort and Spa allows two pets of any size for an additional fee of CAD 30 per night. Only West Tower 2 Queen Beds Garden View rooms are pet friendly. Both dogs and cats are welcome, but they may not be left in the room unattended. Four-legged guests receive a blanket and a water bowl at check-in. There are grassy areas and a walking trail on the property.', NULL, NULL, 'British Columbia'),
('5', 'Fantasyland Hotel', 'Welcome to one of the world*s most unique hotels the internationally acclaimed Fantasyland Hotel in West Edmonton Mall. Escape to a vacation paradise with something for everyone be it business or pleasure a romantic getaway or a family vacation. We invite you to discover a world of adventure.', 'Pet Friendly, Fitness Center, Internet Available, Free WiFi, Business Center, Meeting Rooms, Air Conditioning, Television, Room Service, Breakfast Available, Airport Shuttle, Parking Available, Free Parking, Dry Cleaning, Elevator, Non-Smoking Property', 'R5', '17700 87th Ave, Edmonton, AB T5T 4V4', 'Fantasyland Hotel welcomes pets up to 25 lbs for an additional fee of CAD 50 per night. Both dogs and cats are allowed but may not be left unattended in rooms. Guests with pets are assigned to Superior King rooms.', NULL, NULL, 'Alberta'),
('6', 'Kananaskis Mountain Lodge Autograph Collection', 'Kananaskis Mountain Lodge, Autograph Collection tour desk helps guest arrange whitewater rafting, horseback riding and ski and snowboarding trips.', 'Pet Friendly, Fitness Center, Internet Available, Free WiFi, Meeting Rooms, Television, Restaurant, Room Service, Breakfast Available, Spa Services, Parking, Available, Free Parking, RV / Trailer Parking, Wheelchair Accessible, Laundry Room, Dry Cleaning, Elevator, Non-Smoking Property, Picnic Tables', 'R6', '1 Centennial Dr, Kananaskis, AB T0L 2H0', 'Kananaskis Mountain Lodge Autograph Collection allows two pets up to 50 lbs in designated rooms for an additional fee of CAD 40 per night. Both dogs and cats are allowed.', NULL, NULL, 'Alberta'),
('7', 'Rundle Mountain Lodge', 'Located in Canmore, Rundle Mountain Lodge is in the mountains and minutes from Canmore Golf and Curling Club and Cross Zee Ranch. This hotel is within close proximity of Canmore Museum and Geoscience Centre and Silvertip Golf Course. Make yourself at home in one of the 61 guestrooms featuring refrigerators. Complimentary wireless Internet access keeps you connected, and cable programming is available for your entertainment. Bathrooms with bathtubs or showers are provided. Conveniences include coffee/tea makers, as well as phones with free local calls. Take advantage of recreation opportunities such as an indoor pool, or other amenities including complimentary wireless Internet access and a picnic area. Event facilities at this hotel consist of conference space and meeting rooms. Free self parking is available onsite.', 'Pet Friendly, Internet Available, Free WiFi, Meeting Rooms, Television, Parking Available, Free Parking, Laundry Room, Non-Smoking Property, Outdoor Grills, Picnic Tables', 'R7', '1723 Bow Valley Trail, Canmore, AB T1W 1L7', 'Rundle Mountain Lodge welcomes two pets of any size for an additional fee of CAD 20 per pet, per night. Both dogs and cats are allowed. Pets must be crated if left unattended in the guest rooms. There is a grassy pet relief area on the property.', NULL, NULL, 'Alberta'),
('8', 'Old Stone Inn', 'The Old Stone Inn is a first class historical Inn nestled in the heart of Niagara Falls. Originally built as a flow mill in 1904 the Inn has been transformed into a classic country Inn. The 114 cozy guest rooms are traditionally appointed creating a unique charming atmosphere. You can enjoy the indoor/outdoor pool hot tub and privacy of the outdoor courtyard. Guests can sit back and relax in the ambiance of day gone by in the Rendez-Vous Lounge. This Inn is the ideal choice when visiting this world famous area and Niagara wine country. Discover old charm and elegance in the historical dining room while enjoying casual fine dining with the soaring cathedral ceiling wood burning fireplace and brass chandeliers you can dine on fresh classic cuisine while reflecting on the proud heritage of the Old Stone Inn. The staff is professional and personable consistently providing outstanding hospitality. The Old Stone Inn offers onsite dining and is convenient to many shopping golf courses and entertainment venues. There is a daily parking fee.', 'Pet Friendly, Internet Available, Free WiFi, Air Conditioning, Television, Restaurant, Breakfast Available, Parking Available, RV / Trailer Parking, Wheelchair Accessible, Dry Cleaning, Elevator, Non-Smoking Property', 'R8', '6080 Fallsview Blvd, Niagara Falls, ON L2G 7L6', 'Old Stone Inn accepts two dogs of any size for an additional fee of CAD 50 per pet, per night. Well-behaved dogs may be left in the room unattended. Treats are available at the front desk. There is a grassy area for pet relief on the property. Cats are not accepted.', NULL, NULL, 'Ontario'),
('9', 'Sheraton Centre Toronto Hotel', 'In the centre of the business and entertainment districts, the fully wireless CAA/AAA Four Diamond Sheraton Centre Toronto is connected to PATH, a 16-mile underground network of shops and services. Steps from the Eaton Centre shopping mall and convention centre. Experience a fresh kind of classic. A 2.5-acre garden atrium highlights our new lobby. A new ballroom and hall means more than 100,000 square feet of function space. Relax in our internet caf?, the Link@Sheraton experienced with Microsoft, our fitness centre and Senses, our full-service spa. Each of our 1,377 redesigned guest rooms and suites offer the plush comfort of our Sheraton Sweet Sleeper? Bed. Sheraton Club Rooms offer another level of service with an array of upgraded amenities and access to the stylish 43rd floor Sheraton Club Lounge.\r\n', 'Pet Friendly, Fitness Center, Internet Available, Free WiFi, Business Center, Meeting Rooms, Air Conditioning, Television, Restaurant, Breakfast Available, Spa Services, Parking Available, Wheelchair Accessible, Laundry Room, Dry Cleaning, Elevator, Non-Smoking Property', 'R9', '123 Queen Street West, Toronto, ON M5H 2M9', 'Sheraton Centre Toronto Hotel is pet friendly! One dog under 40 lbs is accepted for no additional fee. Dogs may not be left in the room unattended. Dog beds, bowls and food are available, and there is a park across the street from property. Sorry, cats are not allowed.', NULL, NULL, 'Ontario');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` varchar(50) NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `amount` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registered_member`
--

CREATE TABLE `registered_member` (
  `member_id` varchar(20) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `booking_history` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` varchar(50) NOT NULL,
  `amenities` varchar(1000) NOT NULL,
  `bed` varchar(50) NOT NULL,
  `view` varchar(1000) NOT NULL,
  `accommodation` varchar(1000) NOT NULL,
  `capabilities` varchar(1000) NOT NULL,
  `price` varchar(25) NOT NULL,
  `availability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`,`room_id`),
  ADD UNIQUE KEY `hotel_id` (`hotel_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `registered_member`
--
ALTER TABLE `registered_member`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `member_id` (`member_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `room_id` (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
