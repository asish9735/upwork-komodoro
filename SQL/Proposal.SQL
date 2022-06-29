CREATE TABLE `pref_proposals` (
  `proposal_id` int(11) NOT NULL,
  `proposal_seller_id` int(11) NOT NULL,
  `proposal_title` varchar(250) NOT NULL,
  `proposal_short_info` varchar(250) DEFAULT NULL,
  `proposal_url` varchar(250) NOT NULL,
  `display_price` decimal(10,0) NOT NULL,
  `proposal_date` datetime NOT NULL,
  `proposal_status` tinyint(1) NOT NULL,
  `proposal_image` varchar(150) NOT NULL,
  `admin_reason` varchar(250) NOT NULL,
  `posted_lang` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `pref_proposal_additional` (
  `proposal_id` int(11) NOT NULL,
  `proposal_description` text NOT NULL,
  `buyer_instruction` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pref_proposal_category` (
  `proposal_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_subchild_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `pref_proposal_files` (
  `proposal_file_id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `is_video` tinyint(1) NOT NULL,
  `original_name` varchar(250) DEFAULT NULL,
  `server_name` varchar(250) DEFAULT NULL,
  `image_thumb` varchar(250) DEFAULT NULL,
  `upload_time` datetime NOT NULL,
  `file_ext` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pref_proposal_packages` (
  `package_id` varchar(50) NOT NULL,
  `proposal_id` int(100) NOT NULL,
  `package_name` varchar(255) DEFAULT NULL,
  `description` text,
  `delivery_time` varchar(255) DEFAULT NULL,
  `price` int(200) NOT NULL,
  `package_type` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `pref_proposal_question` (
  `proposal_id` int(11) NOT NULL,
  `proposal_question` varchar(250) NOT NULL,
  `proposal_answer` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `pref_proposal_settings` (
  `proposal_id` int(11) NOT NULL,
  `proposal_featured` tinyint(1) NOT NULL,
  `featured_end_date` datetime DEFAULT NULL,
  `is_package` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `pref_proposal_skills` (
  `proposal_skill_id` int(11) NOT NULL,
  `proposal_id` int(11) DEFAULT NULL,
  `skill_id` int(11) DEFAULT NULL,
  `proposal_skill_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `pref_proposal_stat` (
  `proposal_id` int(11) NOT NULL,
  `proposal_rating` int(11) NOT NULL,
  `proposal_views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `pref_proposal_view_log` (
  `proposal_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `reg_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `pref_proposals` ADD PRIMARY KEY (`proposal_id`), ADD UNIQUE KEY `proposal_url` (`proposal_url`);
 
ALTER TABLE `pref_proposal_files` ADD PRIMARY KEY (`proposal_file_id`);
 
ALTER TABLE `pref_proposal_packages` ADD UNIQUE KEY `package_id` (`package_id`);
 
ALTER TABLE `pref_proposal_skills` ADD PRIMARY KEY (`proposal_skill_id`);
 
ALTER TABLE `pref_proposal_view_log` ADD UNIQUE KEY `proposal_id` (`proposal_id`,`member_id`);
 
ALTER TABLE `pref_proposals` MODIFY `proposal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
 
ALTER TABLE `pref_proposal_files` MODIFY `proposal_file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
 
ALTER TABLE `pref_proposal_skills` MODIFY `proposal_skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


CREATE TABLE `pref_orders` (
  `order_id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `buyer_id` int(10) NOT NULL,
  `seller_id` int(10) NOT NULL,
  `proposal_id` varchar(15) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `delivery_time` int(11) NOT NULL,
  `delivery_date` datetime NOT NULL,
  `order_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `order_qty` int(10) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `order_fee` float(6,2) NOT NULL DEFAULT '0.00',
  `order_total` decimal(10,2) NOT NULL,
  `order_active` tinyint(1) NOT NULL,
  `order_status` tinyint(1) NOT NULL,
  `complete_time` datetime DEFAULT NULL,
  `payment_method` varchar(10) NOT NULL,
  `transaction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `pref_orders_conversations` (
  `c_id` int(11) NOT NULL,
  `order_id` int(10) NOT NULL,
  `sender_id` int(10) NOT NULL,
  `message` text,
  `file` varchar(150) DEFAULT NULL,
  `date` datetime NOT NULL,
  `reason` text,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `pref_orders_transaction` (
  `order_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `pref_orders` ADD PRIMARY KEY (`order_id`);

ALTER TABLE `pref_orders_conversations` ADD PRIMARY KEY (`c_id`);

ALTER TABLE `pref_orders` MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `pref_orders_conversations`
--
ALTER TABLE `pref_orders_conversations` MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE `pref_buyer_reviews` (
  `review_id` int(10) NOT NULL,
  `proposal_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `review_buyer_id` int(10) NOT NULL,
  `buyer_rating` int(10) NOT NULL,
  `buyer_review` text NOT NULL,
  `review_seller_id` int(10) NOT NULL,
  `review_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pref_seller_reviews` (
  `review_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `review_seller_id` int(10) NOT NULL,
  `seller_rating` int(10) NOT NULL,
  `seller_review` text NOT NULL,
  `review_buyer_id` int(10) NOT NULL,
  `review_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `pref_buyer_reviews` ADD PRIMARY KEY (`review_id`);

ALTER TABLE `pref_seller_reviews` ADD PRIMARY KEY (`review_id`);

ALTER TABLE `pref_buyer_reviews` MODIFY `review_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `pref_seller_reviews` MODIFY `review_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

INSERT INTO `pref_settings` (`id`, `title`, `setting_key`, `setting_value`, `editable`, `deletable`, `display_order`, `setting_group`) VALUES
(NULL, 'Gigs Feature Duration', 'featured_duration', '30', 1, 0, 0, 'custom'),
(NULL, 'Gigs Feature Fee', 'featured_fee', '10', 1, 0, 0, 'custom');

INSERT INTO `pref_wallet_transaction_type` (`wallet_transaction_type_id`, `title_tkey`, `description_tkey`) VALUES (NULL, 'FEATURED_PAYMENT_WALLET', 'Featured Payment Gig by wallet');
INSERT INTO `pref_settings` (`id`, `title`, `setting_key`, `setting_value`, `editable`, `deletable`, `display_order`) VALUES (NULL, 'Featured Payment Gig by wallet', 'FEATURED_PAYMENT_WALLET', '17', '0', '0', '0');

ALTER TABLE `pref_conversations` ADD `proposal_id` INT NULL AFTER `project_id`;
ALTER TABLE `pref_conversations` CHANGE `project_id` `project_id` INT(11) NULL;

INSERT INTO `pref_settings` (`id`, `title`, `setting_key`, `setting_value`, `editable`, `deletable`, `display_order`, `setting_group`) VALUES
(NULL, 'Order Number', 'ORDER_NUMBER', '0', 0, 0, 10, 'constants');

INSERT INTO `pref_wallet_transaction_type` (`wallet_transaction_type_id`, `title_tkey`, `description_tkey`) VALUES (NULL, 'ORDER_PAYMENT_WALLET', 'Order Payment by wallet');
INSERT INTO `pref_settings` (`id`, `title`, `setting_key`, `setting_value`, `editable`, `deletable`, `display_order`) VALUES (NULL, 'Order Payment by wallet', 'ORDER_PAYMENT_WALLET', '13', '0', '0', '0');


INSERT INTO `pref_wallet_transaction_type` (`wallet_transaction_type_id`, `title_tkey`, `description_tkey`) VALUES (NULL, 'ORDER_PAYMENT_REFUND', 'Order Payment refund');
INSERT INTO `pref_settings` (`id`, `title`, `setting_key`, `setting_value`, `editable`, `deletable`, `display_order`) VALUES (NULL, 'Order Payment refund', 'ORDER_PAYMENT_REFUND', '14', '0', '0', '0');

INSERT INTO `pref_wallet_transaction_type` (`wallet_transaction_type_id`, `title_tkey`, `description_tkey`) VALUES (NULL, 'ORDER_REVENUE_TO_SELLER', 'Release Order Payment');
INSERT INTO `pref_settings` (`id`, `title`, `setting_key`, `setting_value`, `editable`, `deletable`, `display_order`) VALUES (NULL, 'Release Order Payment', 'ORDER_REVENUE_TO_SELLER', '15', '0', '0', '0');

INSERT INTO `pref_wallet_transaction_type` (`wallet_transaction_type_id`, `title_tkey`, `description_tkey`) VALUES (NULL, 'ORDER_SITE_COMMISSION', 'Order Site Commission');
INSERT INTO `pref_settings` (`id`, `title`, `setting_key`, `setting_value`, `editable`, `deletable`, `display_order`) VALUES (NULL, 'Order Site Commission', 'ORDER_SITE_COMMISSION', '16', '0', '0', '0');


