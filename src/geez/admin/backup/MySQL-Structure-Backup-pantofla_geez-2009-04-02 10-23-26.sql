DROP TABLE IF EXISTS `pligg_categories`;

CREATE TABLE `pligg_categories` (
  `category__auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_lang` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `category_parent` int(11) NOT NULL DEFAULT '0',
  `category_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `category_safe_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `category_enabled` int(11) NOT NULL DEFAULT '1',
  `category_order` int(11) NOT NULL DEFAULT '0',
  `category_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_author_level` enum('normal','admin','god') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'normal',
  `category_author_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`category__auto_id`),
  UNIQUE KEY `key` (`category_name`),
  KEY `category_parent` (`category_parent`),
  KEY `category_safe_name` (`category_safe_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_comments`;

CREATE TABLE `pligg_comments` (
  `comment_id` int(20) NOT NULL AUTO_INCREMENT,
  `comment_randkey` int(11) NOT NULL DEFAULT '0',
  `comment_parent` int(20) DEFAULT '0',
  `comment_link_id` int(20) NOT NULL DEFAULT '0',
  `comment_user_id` int(20) NOT NULL DEFAULT '0',
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment_karma` smallint(6) NOT NULL DEFAULT '0',
  `comment_content` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_votes` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`),
  UNIQUE KEY `comments_randkey` (`comment_randkey`,`comment_link_id`,`comment_user_id`,`comment_parent`),
  KEY `comment_link_id` (`comment_link_id`,`comment_parent`,`comment_date`),
  KEY `comment_link_id_2` (`comment_link_id`,`comment_date`),
  KEY `comment_date` (`comment_date`),
  KEY `comment_parent` (`comment_parent`,`comment_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_config`;

CREATE TABLE `pligg_config` (
  `var_id` int(11) NOT NULL AUTO_INCREMENT,
  `var_page` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `var_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `var_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `var_defaultvalue` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `var_optiontext` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `var_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `var_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `var_method` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `var_enclosein` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`var_id`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_feed_import_fields`;

CREATE TABLE `pligg_feed_import_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_feed_link`;

CREATE TABLE `pligg_feed_link` (
  `feed_link_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) NOT NULL,
  `feed_field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pligg_field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`feed_link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_feeds`;

CREATE TABLE `pligg_feeds` (
  `feed_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `feed_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `feed_freq_hours` int(11) NOT NULL DEFAULT '12',
  `feed_votes` int(11) NOT NULL DEFAULT '1',
  `feed_submitter` int(11) NOT NULL DEFAULT '1',
  `feed_item_limit` int(11) NOT NULL DEFAULT '1',
  `feed_category` int(11) NOT NULL DEFAULT '1',
  `feed_url_dupe` int(11) NOT NULL DEFAULT '0',
  `feed_title_dupe` int(11) NOT NULL DEFAULT '0',
  `feed_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'queued',
  `feed_last_check` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `feed_random_vote_enable` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `feed_random_vote_min` tinyint(3) unsigned NOT NULL DEFAULT '5',
  `feed_random_vote_max` tinyint(3) unsigned NOT NULL DEFAULT '20',
  `feed_last_item_first` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`feed_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_files`;

CREATE TABLE `pligg_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_size` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_user_id` int(11) NOT NULL,
  `file_link_id` int(11) NOT NULL,
  `file_orig_id` int(11) NOT NULL,
  `file_real_size` int(11) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_formulas`;

CREATE TABLE `pligg_formulas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `formula` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_friends`;

CREATE TABLE `pligg_friends` (
  `friend_id` int(11) NOT NULL AUTO_INCREMENT,
  `friend_from` bigint(20) NOT NULL DEFAULT '0',
  `friend_to` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`friend_id`),
  UNIQUE KEY `friends_from_to` (`friend_from`,`friend_to`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_group_member`;

CREATE TABLE `pligg_group_member` (
  `member_id` int(20) NOT NULL AUTO_INCREMENT,
  `member_user_id` int(20) NOT NULL,
  `member_group_id` int(20) NOT NULL,
  `member_role` enum('admin','normal','moderator','flagged','banned') COLLATE utf8_unicode_ci NOT NULL,
  `member_status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `user_group` (`member_group_id`,`member_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_group_shared`;

CREATE TABLE `pligg_group_shared` (
  `share_id` int(20) NOT NULL AUTO_INCREMENT,
  `share_link_id` int(20) NOT NULL,
  `share_group_id` int(20) NOT NULL,
  `share_user_id` int(20) NOT NULL,
  PRIMARY KEY (`share_id`),
  KEY `share_group_id` (`share_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_groups`;

CREATE TABLE `pligg_groups` (
  `group_id` int(20) NOT NULL AUTO_INCREMENT,
  `group_creator` int(20) NOT NULL,
  `group_status` enum('Enable','disable') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `group_members` int(20) NOT NULL,
  `group_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `group_safename` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `group_name` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `group_description` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `group_privacy` enum('private','public','restricted') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `group_avatar` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `group_vote_to_publish` int(20) NOT NULL,
  `group_field1` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `group_field2` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `group_field3` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `group_field4` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `group_field5` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `group_field6` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `group_name` (`group_name`(100)),
  KEY `group_creator` (`group_creator`,`group_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_links`;

CREATE TABLE `pligg_links` (
  `link_id` int(20) NOT NULL AUTO_INCREMENT,
  `link_author` int(20) NOT NULL DEFAULT '0',
  `link_status` enum('discard','queued','published','abuse','duplicated','page') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'discard',
  `link_randkey` int(20) NOT NULL DEFAULT '0',
  `link_votes` int(20) NOT NULL DEFAULT '0',
  `link_reports` int(20) NOT NULL DEFAULT '0',
  `link_comments` int(20) NOT NULL DEFAULT '0',
  `link_karma` decimal(10,2) NOT NULL DEFAULT '0.00',
  `link_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `link_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_published_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_category` int(11) NOT NULL DEFAULT '0',
  `link_lang` int(11) NOT NULL DEFAULT '1',
  `link_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_url_title` text COLLATE utf8_unicode_ci,
  `link_title` text COLLATE utf8_unicode_ci NOT NULL,
  `link_title_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_content` text COLLATE utf8_unicode_ci NOT NULL,
  `link_summary` text COLLATE utf8_unicode_ci,
  `link_tags` text COLLATE utf8_unicode_ci,
  `link_field1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_field2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_field3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_field4` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_field5` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_field6` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_field7` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_field8` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_field9` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_field10` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_field11` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_field12` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_field13` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_field14` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_field15` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_group_id` int(20) NOT NULL DEFAULT '0',
  `link_out` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`link_id`),
  KEY `link_author` (`link_author`),
  KEY `link_url` (`link_url`),
  KEY `link_status` (`link_status`),
  KEY `link_title_url` (`link_title_url`),
  KEY `link_date` (`link_date`),
  KEY `link_published_date` (`link_published_date`),
  FULLTEXT KEY `link_url_2` (`link_url`,`link_url_title`,`link_title`,`link_content`,`link_tags`),
  FULLTEXT KEY `link_tags` (`link_tags`),
  FULLTEXT KEY `link_search` (`link_title`,`link_content`,`link_tags`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_messages`;

CREATE TABLE `pligg_messages` (
  `idMsg` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `sender` int(11) NOT NULL DEFAULT '0',
  `receiver` int(11) NOT NULL DEFAULT '0',
  `senderLevel` int(11) NOT NULL DEFAULT '0',
  `readed` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idMsg`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_misc_data`;

CREATE TABLE `pligg_misc_data` (
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_modules`;

CREATE TABLE `pligg_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `version` float NOT NULL,
  `latest_version` float NOT NULL,
  `folder` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_redirects`;

CREATE TABLE `pligg_redirects` (
  `redirect_id` int(11) NOT NULL AUTO_INCREMENT,
  `redirect_old` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `redirect_new` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`redirect_id`),
  KEY `redirect_old` (`redirect_old`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_saved_links`;

CREATE TABLE `pligg_saved_links` (
  `saved_id` int(11) NOT NULL AUTO_INCREMENT,
  `saved_user_id` int(11) NOT NULL,
  `saved_link_id` int(11) NOT NULL,
  `saved_privacy` enum('private','public') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'public',
  PRIMARY KEY (`saved_id`),
  KEY `saved_user_id` (`saved_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_snippets`;

CREATE TABLE `pligg_snippets` (
  `snippet_id` int(11) NOT NULL AUTO_INCREMENT,
  `snippet_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `snippet_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `snippet_updated` datetime NOT NULL,
  `snippet_order` int(11) NOT NULL,
  `snippet_content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`snippet_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_spam_comments`;

CREATE TABLE `pligg_spam_comments` (
  `auto_id` int(20) NOT NULL AUTO_INCREMENT,
  `userid` int(20) NOT NULL DEFAULT '0',
  `linkid` int(20) NOT NULL DEFAULT '0',
  `cmt_rand` int(20) NOT NULL DEFAULT '0',
  `cmt_content` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `cmt_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cmt_parent` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`auto_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_tag_cache`;

CREATE TABLE `pligg_tag_cache` (
  `tag_words` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_tags`;

CREATE TABLE `pligg_tags` (
  `tag_link_id` int(11) NOT NULL DEFAULT '0',
  `tag_lang` varchar(4) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `tag_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tag_words` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  UNIQUE KEY `tag_link_id` (`tag_link_id`,`tag_lang`,`tag_words`),
  KEY `tag_lang` (`tag_lang`,`tag_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_totals`;

CREATE TABLE `pligg_totals` (
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_trackbacks`;

CREATE TABLE `pligg_trackbacks` (
  `trackback_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trackback_link_id` int(11) NOT NULL DEFAULT '0',
  `trackback_user_id` int(11) NOT NULL DEFAULT '0',
  `trackback_type` enum('in','out') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'in',
  `trackback_status` enum('ok','pendent','error') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pendent',
  `trackback_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `trackback_date` timestamp NULL DEFAULT NULL,
  `trackback_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `trackback_title` text COLLATE utf8_unicode_ci,
  `trackback_content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`trackback_id`),
  UNIQUE KEY `trackback_link_id_2` (`trackback_link_id`,`trackback_type`,`trackback_url`),
  KEY `trackback_link_id` (`trackback_link_id`),
  KEY `trackback_url` (`trackback_url`),
  KEY `trackback_date` (`trackback_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_users`;

CREATE TABLE `pligg_users` (
  `user_id` int(20) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_level` enum('normal','admin','god') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'normal',
  `user_modification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_pass` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_names` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_karma` decimal(10,2) DEFAULT '10.00',
  `user_url` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_lastlogin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_aim` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_msn` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_yahoo` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_gtalk` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_skype` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_irc` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `public_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_avatar_source` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `user_lastip` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `last_reset_request` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_email_friend` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_reset_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_occupation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19.20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60',
  `user_university` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_birthdate` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_age` tinyint(1) NOT NULL,
  `user_gender` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `user_status` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `user_habits` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `user_car` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `user_country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_state` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_bio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_subscription` tinyint(1) NOT NULL,
  `user_interests` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `social_delicious` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `social_facebook` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `social_flickr` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `social_linkedin` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `social_pownce` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `social_stumbleupon` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `social_twitter` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `social_youtube` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_login` (`user_login`),
  KEY `user_email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `pligg_votes`;

CREATE TABLE `pligg_votes` (
  `vote_id` int(20) NOT NULL AUTO_INCREMENT,
  `vote_type` enum('links','comments') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'links',
  `vote_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `vote_link_id` int(20) NOT NULL DEFAULT '0',
  `vote_user_id` int(20) NOT NULL DEFAULT '0',
  `vote_value` smallint(11) NOT NULL DEFAULT '1',
  `vote_ip` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`vote_id`),
  KEY `user_id` (`vote_user_id`),
  KEY `link_id` (`vote_link_id`),
  KEY `vote_type` (`vote_type`,`vote_link_id`,`vote_user_id`,`vote_ip`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

