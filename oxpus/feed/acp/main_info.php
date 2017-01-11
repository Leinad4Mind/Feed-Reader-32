<?php

/**
*
* @package phpBB Extension - Feed Reader
* @copyright (c) 2016 OXPUS - www.oxpus.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace oxpus\feed\acp;

class main_info
{
	function module()
	{
		global $config;

		return array(
			'filename'	=> '\oxpus\feed\acp\main_info',
			'title'		=> 'ACP_OX_FEED_READER',
			'version'	=> $config['feed_version'],
			'modes'		=> array(
				'main'		=> array('title' => 'ACP_OX_FEED_READER_MANAGE',	'auth' => 'ext_oxpus/feed && acl_a_ox_feed_reader_manage',		'cat' => array('ACP_OX_FEED_READER')),
			),
		);
	}
}
