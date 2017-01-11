<?php
/**
*
* @package phpBB Extension - Feed Reader
* @copyright (c) 2016 OXPUS - www.oxpus.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace oxpus\feed\cron\tasks;

use Symfony\Component\DependencyInjection\Container;

class feed_cron extends \phpbb\cron\task\base
{
	/* @var string phpbb_root_path */
	protected $root_path;

	/* @var string phpEx */
	protected $php_ext;

	/* @var string table_prefix */
	protected $table_prefix;

 	/* @var \phpbb\db\driver\driver_interface */
	protected $db;

	/* @var \phpbb\user */
	protected $user;

	/* @var \phpbb\log\log_interface */
	protected $log;

	/* @var \phpbb\config\config */
	protected $config;

 	/* @var \phpbb\extension\manager */
	protected $phpbb_extension_manager;

	/* @var \phpbb\auth\auth */
	protected $auth;

	public function __construct($root_path, $php_ext, $table_prefix, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\log\log_interface $log, \phpbb\user $user, \phpbb\extension\manager $phpbb_extension_manager, \phpbb\auth\auth $auth)
    {
		$this->root_path				= $root_path;
		$this->php_ext 					= $php_ext;
		$this->table_prefix 			= $table_prefix;
        $this->config					= $config;
        $this->db						= $db;
        $this->log						= $log;
        $this->user						= $user;
		$this->phpbb_extension_manager	= $phpbb_extension_manager;
		$this->auth						= $auth;
   }

	/*
	* Runs this cron task.
	*
	* @return null
	*/
	public function run()
    {
 		if (!defined('SFNC_FEEDS'))
  		{
			define('SFNC_FEEDS', $this->table_prefix . 'sfnc_feeds');
		}

		$ext_path			= $this->phpbb_extension_manager->get_extension_path('oxpus/feed', true);
		$phpbb_root_path	= $this->root_path;
		$phpEx				= $this->php_ext;

		include_once($ext_path . 'helpers/sfnc_class.' . $this->php_ext);

		$sfnc = new \oxpus\feed\helpers\ sfnc_class();
		$sfnc->cron_init();

		return;
    }

    /*
    * Returns whether this cron task can run, given current board configuration.
    *
    * @return bool
    */
    public function is_runnable()
    {
		return (int) $this->config['sfnc_cron_init'];
    }

    /*
    * Diese Funktion wird vom Cron Task aufgerufen und überprüft ob der Cron-Task laufen soll, oder nicht
    * gibt sie true zurück wird die run() Methode aufgerufen
    *
    * @return bool
    */
    public function should_run()
    {
		return true;
    }
}
