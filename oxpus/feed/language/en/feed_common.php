<?php

/**
*
* @package phpBB Extension - Feed Reader
* @copyright (c) 2016 OXPUS - www.oxpus.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/*
* [ english ] language file
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'OX_NEWS_TICKER'	=> 'News ticker',

	'ACP_OX_FEED_READER'								=> 'Feed Reader',
	'ACP_OX_FEED_READER_MANAGE'							=> 'Manage feeds',
	'ACP_OX_FEED_READER_MANAGE_UPDATED'					=> 'Feed settings updated',
	'ACP_OX_FEED_READER_CONFIG'							=> 'General settings',
	'ACP_OX_FEED_READER_CONFIG_UPDATED'					=> 'Feed reader settings updated',

	'ACP_OX'											=> 'Feed News Center',
	'ACP_OX_FEEDS'										=> 'Feeds list',
	'ACP_OX_FEEDS_DESCRIPTION'							=> 'There you can choose a feed to edit, delete or add a new one.',
	'ACP_OX_ADD_NEW'									=> 'ADD new feed',
	'ACP_OX_BASIC'										=> 'Basic settings',
	'ACP_OX_DOWNLOAD_FUNCTION'							=> 'Download function',
	'ACP_OX_DOWNLOAD_FUNCTION_DESCRIPTION'				=> 'Which function is used to download the feed? (simplexml recommended)',
	'ACP_OX_ENCODING'									=> 'Encoding',
	'ACP_OX_ENCODING_DESCRIPTION'						=> 'Encoding of the feed',
	'ACP_OX_FEED_ENABLED_POSTING_SHORT'					=> 'Posting',
	'ACP_OX_FEED_ENABLED_POSTING'						=> 'Post content of the feed',
	'ACP_OX_FEED_ENABLED_POSTING_DESCRIPTION'			=> 'If enabled, downloaded content will be posted to board',
	'ACP_OX_FEED_ENABLED_DISPLAYING_SHORT'				=> 'Displaying',
	'ACP_OX_FEED_ENABLED_DISPLAYING'					=> 'Displaying feed on the board',
	'ACP_OX_FEED_ENABLED_DISPLAYING_DESCRIPTION'		=> 'If enabled, cached content will be displayed in news ticker',
	'ACP_OX_FEED_NAME'									=> 'Name',
	'ACP_OX_FEED_NAME_DESCRIPTION'						=> 'Name of the feed',
	'ACP_OX_FEED_TICKER_POSITION'						=> 'Display position for the feed ticker',
	'ACP_OX_FEED_TICKER_POSITION_DESCRIPTION'			=> 'Select here where the ticker for downloaded feeds should be shown.<br />From here you can disable the ticker completely against the settings in the single feeds.',
	'ACP_OX_FEED_TICKER_POSITION_0'						=> 'disabled',
	'ACP_OX_FEED_TICKER_POSITION_1'						=> 'over the board header',
	'ACP_OX_FEED_TICKER_POSITION_2'						=> 'over the top navbar',
	'ACP_OX_FEED_TICKER_POSITION_3'						=> 'before the page content',
	'ACP_OX_FEED_TICKER_POSITION_4'						=> 'at the beginning of the page content',
	'ACP_OX_FEED_TICKER_POSITION_5'						=> 'at the end of the page content',
	'ACP_OX_FEED_TICKER_POSITION_6'						=> 'after the page content',
	'ACP_OX_FEED_TICKER_POSITION_7'						=> 'after the board footer',
	'ACP_OX_FEED_TYPE'									=> 'Type',
	'ACP_OX_FEED_TYPE_DESCRIPTION'						=> 'Type of the feed (ATOM/RSS/RDF)',
	'ACP_OX_FEED_URL'									=> 'URL',
	'ACP_OX_FEED_URL_DESCRIPTION'						=> 'URL of the feed',
	'ACP_OX_FEEDS_UPD_NEVER'							=> 'never',
	'ACP_OX_LAST_UPDATE'								=> 'Latest update',
	'ACP_OX_LAST_UPDATE_DESCRIPTION'					=> 'Time, when feed was updated',
	'ACP_OX_NEWS_TICKER'								=> 'News ticker',
	'ACP_OX_NEXT_UPDATE'								=> 'Next update',
	'ACP_OX_POSTING'									=> 'Posting',
	'ACP_OX_POSTER_ID'									=> 'Poster',
	'ACP_OX_POSTER_ID_DESCRIPTION'						=> 'Username, who will be a poster of the message',
	'ACP_OX_POSTER_FORUM_DESTINATION_ID'				=> 'Forum ID',
	'ACP_OX_POSTER_FORUM_DESTINATION_ID_DESCRIPTION'	=> 'Id of the forum to be posted in',
	'ACP_OX_POSTER_TOPIC_DESTINATION_ID'				=> 'Topic ID',
	'ACP_OX_POSTER_TOPIC_DESTINATION_ID_DESCRIPTION'	=> 'Id of the topic to be posted in<br />While the selected topic was posted in another forum as selected in the previous option, the forum from the topic will be used.',
	'ACP_OX_POSTING_LIMIT'								=> 'Messages limit',
	'ACP_OX_POSTING_LIMIT_DESCRIPTION'					=> 'How many latest messages may be checked and posted',
	'ACP_OX_REFRESH_AFTER'								=> 'Check feed after',
	'ACP_OX_REFRESH_AFTER_DESCRIPTION'					=> 'After how much time, the feed might be checked for a new content again? (Note : If using CRON mode, all feeds are checked while CRON is inited)',
	'ACP_OX_REFRESH_AFTER_HOURS'						=> 'hours',
	'ACP_OX_REFRESH_AFTER_MINUTES'						=> 'minutes',

	'ACP_OX_AVAILABLE_ATTRIBUTES'						=> 'Available attributes',
	'ACP_OX_TEMPLATES'									=> 'Templates',
	'ACP_OX_TEMPLATES_DESCRIPTION'						=> 'There you can edit templates used for posting or displaying on your board',
	'ACP_OX_TEMPLATE_FOR_POSTING'						=> 'Post template',
	'ACP_OX_TEMPLATE_FOR_POSTING_DESCRIPTION'			=> 'Template used for post, if posting is enabled',
	'ACP_OX_TEMPLATE_FOR_DISPLAYING'					=> 'Display template',
	'ACP_OX_TEMPLATE_FOR_DISPLAYING_DESCRIPTION'		=> 'Template used for news ticker, if displaying is enabled',

	'ACP_OX_ACTION_ERROR_DB'							=> 'There was an error during inserting values',
	'ACP_OX_ACTION_SUCCESS'								=> 'Action was performed successfully',
	'ACP_OX_ACTION_ERROR_VALUES'						=> 'Not enough informations were posted',

	'ACP_OX_INIT_ON_INDEX'								=> 'Index init',
	'ACP_OX_INIT_ON_INDEX_DESCRIPTION'					=> 'If enabled, index.php will init downloading of ONE feed',
	'ACP_OX_POSTING_ON_INDEX'							=> 'Index posting',
	'ACP_OX_POSTING_ON_INDEX_DESCRIPTION'				=> 'If enabled, after initiation on index.php, content will be posted to forum',
	'ACP_OX_INIT_ON_CRON'								=> 'Cron init',
	'ACP_OX_INIT_ON_CRON_DESCRIPTION'					=> 'Enable, if you´ll use a CRON job for updating the feeds (cron.php in phpBB ROOT directory). If enabled, index.php will never init downloading or posting of feed and ALL feeds will be updated.',
	'ACP_OX_POSTING_ON_CRON'							=> 'Cron posting',
	'ACP_OX_POSTING_ON_CRON_DESCRIPTION'				=> 'If enabled, after initiation on cron.php, content will be posted to forum',

	'LOG_SFNC_FEED_CONFIG'								=> 'Update Feed Reader settings.',
	'LOG_SFNC_FEED_MANAGE'								=> 'Update settings for feed %s.',
	'LOG_ERROR_SFNC_FEED_PARSER_NO_FEED_TYPE'			=> 'Unable to detect feed type for feed "%s"',
));
