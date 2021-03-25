DROP TABLE IF EXISTS `#__easyimagerotator`;
CREATE TABLE `#__easyimagerotator` (
	`item_id` int( 11 ) NOT NULL ,
	`img_url` varchar( 1000 ) NOT NULL ,
	`img_textlayer` varchar( 1000 ) NOT NULL ,
	`img_title` varchar( 100 ) NOT NULL ,
	PRIMARY KEY ( `item_id` )	);