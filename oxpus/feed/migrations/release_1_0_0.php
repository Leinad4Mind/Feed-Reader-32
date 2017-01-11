<?php

/**
*
* @package phpBB Extension - Feed Reader
* @copyright (c) 2016 OXPUS - www.oxpus.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace oxpus\feed\migrations;

class release_1_0_0 extends \phpbb\db\migration\migration
{
	var $ext_version = '1.0.0';

	public function effectively_installed()
	{
		return isset($this->config['feed_version']) && version_compare($this->config['feed_version'], $this->ext_version, '>=');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('feed_version', $this->ext_version)),

			array('config.add', array('sfnc_download_function', 'simplexml')),
			array('config.add', array('sfnc_cron_init', 0)),
			array('config.add', array('sfnc_cron_posting', 0)),
			array('config.add', array('sfnc_index_init', 0)),
			array('config.add', array('sfnc_index_posting', 0)),
			array('config.add', array('sfnc_ticker_position', 0)),

			array('module.add', array(
 				'acp',
 				'ACP_CAT_DOT_MODS',
 				'ACP_OX_FEED_READER'
 			)),
			array('module.add', array(
				'acp',
				'ACP_OX_FEED_READER',
				array(
					'module_basename'	=> '\oxpus\feed\acp\config_module',
					'modes'				=> array('main'),
				),
			)),
			array('module.add', array(
				'acp',
				'ACP_OX_FEED_READER',
				array(
					'module_basename'	=> '\oxpus\feed\acp\main_module',
					'modes'				=> array('main'),
				),
			)),

			array('permission.add', array('a_ox_feed_reader_config')),
			array('permission.add', array('a_ox_feed_reader_manage')),

			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_ox_feed_reader_config')),
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_ox_feed_reader_manage')),
		);
	}
			
	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'sfnc_feeds' => array(
					'COLUMNS'		=> array(
						'id'							=> array('INT:11', null, 'auto_increment'),
						'feed_name'						=> array('VCHAR', ''),
						'url'							=> array('VCHAR', ''),
						'feed_type'						=> array('VCHAR:10', ''),
						'next_update'					=> array('VCHAR: 10', '0'),
						'last_update'					=> array('INT:10', 0),
						'available_feed_attributes'		=> array('VCHAR:255', ''),
						'available_item_attributes'		=> array('VCHAR:255', ''),
						'encoding'						=> array('VCHAR:255', ''),
						'refresh_after'					=> array('VCHAR:5', '3600'),
						'template_for_displaying'		=> array('VCHAR:255', ''),
						'template_for_posting'			=> array('VCHAR:255', ''),
						'poster_id'						=> array('INT:5', 0),
						'poster_forum_destination_id'	=> array('INT:5', 0),
						'poster_topic_destination_id'	=> array('INT:5', 0),
						'posting_limit'					=> array('INT:2', 1),
						'enabled_posting'				=> array('INT:1', 0),
						'enabled_displaying'			=> array('INT:1', 0),
					),
					'PRIMARY_KEY'	=> 'id',
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables' => array(
				$this->table_prefix . 'sfnc_feeds',
			),
		);
	}
}
