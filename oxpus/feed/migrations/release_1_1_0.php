<?php

/**
*
* @package phpBB Extension - Feed Reader
* @copyright (c) 2016 OXPUS - www.oxpus.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace oxpus\feed\migrations;

class release_1_1_0 extends \phpbb\db\migration\migration
{
	var $ext_version = '1.1.0';

	public function effectively_installed()
	{
		return isset($this->config['feed_version']) && version_compare($this->config['feed_version'], $this->ext_version, '>=');
	}

	static public function depends_on()
	{
		return array('\oxpus\feed\migrations\release_1_0_0');
	}

	public function update_data()
	{
		return array(
			array('config.update', array('feed_version', $this->ext_version)),
		);
	}
}
