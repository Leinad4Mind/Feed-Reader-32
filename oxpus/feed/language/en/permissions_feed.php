<?php

/**
*
* @package phpBB Extension - Feed Reader
* @copyright (c) 2016 OXPUS - www.oxpus.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* Language pack for Extension permissions [English]
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

// Permissions
$lang = array_merge($lang, array(
	'ACP_OX_FEED_READER'		=> 'Feed Reader',

	'A_OX_FEED_READER_MANAGE'	=> 'Can configure feeds',
	'A_OX_FEED_READER_CONFIG'	=> 'Can configure the Feed Reader',
));
