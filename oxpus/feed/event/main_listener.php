<?php

/**
*
* @package phpBB Extension - Feed Reader
* @copyright (c) 2016 OXPUS - www.oxpus.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace oxpus\feed\event;

/**
* @ignore
*/
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'						=> 'load_language_on_setup',
			'core.permissions'						=> 'add_permission_cat',
			'core.page_header'						=> 'display_feed_ticker',
		);
	}

	/* @var string phpbb_root_path */
	protected $root_path;

	/* @var string phpEx */
	protected $php_ext;

	/* @var string table_prefix */
	protected $table_prefix;

	/* @var \phpbb\extension\manager */
	protected $phpbb_extension_manager;
	
	/* @var \phpbb\path_helper */
	protected $phpbb_path_helper;

	/* @var Container */
	protected $phpbb_container;

	/* @var \phpbb\db\driver\driver_interface */
	protected $db;

	/* @var \phpbb\config\config */
	protected $config;

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\auth\auth */
	protected $auth;

	/* @var \phpbb\template\template */
	protected $template;
	
	/* @var \phpbb\user */
	protected $user;
	
	/* @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/**
	* Constructor
	*
	* @param string									$root_path
	* @param string									$php_ext
	* @param string									$table_prefix
	* @param \phpbb\extension\manager				$phpbb_extension_manager
	* @param \phpbb\path_helper						$phpbb_path_helper
	* @param Container								$phpbb_container
	* @param \phpbb\db\driver\driver_interfacer		$db
	* @param \phpbb\config\config					$config
	* @param \phpbb\controller\helper				$helper
	* @param \phpbb\auth\auth						$auth
	* @param \phpbb\template\template				$template
	* @param \phpbb\user							$user
	* @param \phpbb\cache\driver\driver_interface	$cache
	* @param cache.driver							$cache
	*/
	public function __construct($root_path, $php_ext, $table_prefix, \phpbb\extension\manager $phpbb_extension_manager, \phpbb\path_helper $phpbb_path_helper, Container $phpbb_container, \phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\auth\auth $auth, \phpbb\template\template $template, \phpbb\user $user, \phpbb\cache\driver\driver_interface $cache = null)
	{
		$this->root_path				= $root_path;
		$this->php_ext 					= $php_ext;
		$this->table_prefix 			= $table_prefix;
		$this->phpbb_extension_manager	= $phpbb_extension_manager;
		$this->phpbb_path_helper		= $phpbb_path_helper;
		$this->phpbb_container 			= $phpbb_container;
		$this->db 						= $db;
		$this->config 					= $config;
		$this->helper 					= $helper;
		$this->auth						= $auth;
		$this->template 				= $template;
		$this->user 					= $user;
		$this->cache					= $cache;
	}

	public function load_language_on_setup($event)
	{	
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'oxpus/feed',
			'lang_set' => 'feed_common',
		);

		if (defined('ADMIN_START'))
		{
			$lang_set_ext[] = array(
				'ext_name' => 'oxpus/feed',
				'lang_set' => 'permissions_feed',
			);
		}

		$event['lang_set_ext'] = $lang_set_ext;

		if (!defined('ADMIN_START'))
		{
			$ext_path					= $this->phpbb_extension_manager->get_extension_path('oxpus/feed', true);
			$this->phpbb_path_helper	= $this->phpbb_container->get('path_helper');
	
			if (!defined('SFNC_FEEDS'))
			{
				define('SFNC_FEEDS', $this->table_prefix . 'sfnc_feeds');
			}
	
			include_once($ext_path . 'helpers/sfnc_class.' . $this->php_ext);
			$sfnc = new \oxpus\feed\helpers\ sfnc_class();
			$sfnc->index_init();
		}
	}

	public function add_permission_cat($event)
	{
		$perm_cat = $event['categories'];
		$perm_cat['ox_feed_reader'] = 'ACP_OX_FEED_READER';
		$event['categories'] = $perm_cat;

		$permission = $event['permissions'];
		$permission['a_ox_feed_reader']		= array('lang' => 'ACP_OX_FEED_READER',		'cat' => 'ox_feed_reader');
		$event['permissions'] = $permission;
	}

	public function display_feed_ticker($event)
	{
		if ($this->config['sfnc_ticker_position'])
		{
			if (!defined('SFNC_FEEDS'))
			{
				define('SFNC_FEEDS', $this->table_prefix . 'sfnc_feeds');
			}

			$sql = 'SELECT id FROM ' . SFNC_FEEDS . '
					WHERE enabled_displaying = 1';
			$result = $this->db->sql_query($sql);
			$feed_ids = array();
			while ($row = $this->db->sql_fetchrow($result))
			{
				$feed_ids[] = $row ['id'];
			}

			$this->db->sql_freeresult($result);

			if (sizeof($feed_ids))
			{
				$output = array();

				$ext_path					= $this->phpbb_extension_manager->get_extension_path('oxpus/feed', true);
				$this->phpbb_path_helper	= $this->phpbb_container->get('path_helper');
				$ext_path_web				= $this->phpbb_path_helper->update_web_root_path($ext_path);
				$ext_path_js				= $ext_path_web . 'helpers/js';

				// From here fetch and post the news feed ticker 
				include_once($ext_path . 'helpers/sfnc_class.' . $this->php_ext);
				$sfnc = new \oxpus\feed\helpers\ sfnc_class();

				foreach ($feed_ids as $key => $id)
				{
					$sfnc->acp_init($id);
					$ticker_data = $sfnc->get_ticker_data($id);

					if ($ticker_data['items'] !== false && is_array($ticker_data))
					{
						$output = array_merge($output, $ticker_data['items']);
					}
				}

				if (sizeof($output))
				{
					$allow_bbcode	= ($this->config['allow_bbcode']) ? true : false;
					$allow_urls		= true;
					$allow_smilies	= ($this->config['allow_smilies']) ? true : false;
					$uid = $bitfield = '';
					$flags = 0;

					$this->template->assign_vars(array(
						'EXT_PATH_JS'			=> $ext_path_js,
						'S_FEED_TICKER_POSTION'	=> $this->config['sfnc_ticker_position'],
					));

					foreach ($output as $key => $value)
					{
						generate_text_for_storage($output[$key], $uid, $bitfield, $flags, $allow_bbcode, $allow_urls, $allow_smilies);
						$message = generate_text_for_display($output[$key], $uid, $bitfield, $flags);
				
						$this->template->assign_block_vars('ticker_items', array(
							'FEED_OUTPUT' => $message,
						));
					}
				}
			}
		}
	}
}
