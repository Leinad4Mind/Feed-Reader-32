<?php

/**
*
* @package phpBB Extension - Feed Reader
* @copyright (c) 2016 OXPUS - www.oxpus.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace oxpus\feed\acp;

/**
* @package acp
*/
class main_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $cache;
		global $phpbb_root_path, $phpbb_admin_path, $phpEx;
		global $phpbb_extension_manager, $table_prefix, $phpbb_container, $phpbb_path_helper;

		$config			= $phpbb_container->get('config');
		$language		= $phpbb_container->get('language');
		$request		= $phpbb_container->get('request');
		$template		= $phpbb_container->get('template');

		$this->tpl_name		= 'acp_sfnc';
		$this->page_title	= 'ACP_OX_FEED_READER_MANAGE';
		$ext_path			= $phpbb_extension_manager->get_extension_path('oxpus/feed', true);

		$view			= $request->variable('view', 'list');
		$action			= $request->variable('action', '');
		$submit			= $request->variable('submit', '');

		$id				= $request->variable('id', 0);

		if (!defined('SFNC_FEEDS'))
		{
			define('SFNC_FEEDS', $table_prefix . 'sfnc_feeds');
		}

		$basic_link = $this->u_action;

		$auth->acl($user->data);
		if (!$auth->acl_get('a_ox_feed_reader_manage'))
		{
			trigger_error('NO_PERMISSION', E_USER_WARNING);
		}

		if ($view == 'manage' && $action == 'delete')
		{
			$sql = 'DELETE FROM ' . SFNC_FEEDS . '
					WHERE id = ' . (int) $id;
			$db->sql_query($sql);

			trigger_error($language->lang('ACP_OX_ACTION_SUCCESS') . adm_back_link($this->u_action));
		}

		$list = array();

		$sql = 'SELECT * FROM ' . SFNC_FEEDS . '
				ORDER BY id ASC';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$list[$row['id']] = $row;
		}

		$db->sql_freeresult($result);

		if ($view == 'list' && sizeof($list))
		{
			$template->assign_vars(array(
				'S_VIEW'	=> 'list',
				'U_NEW'		=> $basic_link . '&amp;view=manage&amp;action=new',
			));

			foreach ($list as $feed_id => $row)
			{
				if ($row['next_update'])
				{
					$next_update = $user->format_date($row['next_update']);
				}
				else if ($row['last_update'] && $row['refresh_after'])
				{
					$next_update = $user->format_date($row['last_update'] + $row['refresh_after']);
				}
				else
				{
					$next_update = $language->lang('ACP_OX_FEEDS_UPD_NEVER');
				}

				$template->assign_block_vars('feed_list_row', array(
					'URL'					=> $row['url'],
					'FEED_ID'				=> $row['id'],
					'FEED_NAME'				=> $row['feed_name'],
					'ENABLED_POSTING'		=> $row['enabled_posting'],
					'ENABLED_DISPLAYING'	=> $row['enabled_displaying'],
					'LAST_UPDATE'			=> ($row['last_update']) ? $user->format_date($row['last_update']) : $language->lang('ACP_OX_FEEDS_UPD_NEVER'),
					'NEXT_UPDATE'			=> $next_update,
					'U_MANAGE'				=> $basic_link . '&amp;view=manage&amp;action=edit&amp;id=' . (int) $row['id'],
					'U_DELETE'				=> $basic_link . '&amp;view=manage&amp;action=delete&amp;id=' . (int) $row['id'],
				));
			}
		}
		else
		{
			if ($submit)
			{
				$feed_name						= htmlspecialchars_decode($request->variable('feed_name', '', true));
				$feed_type						= htmlspecialchars_decode($request->variable('feed_type', '', true));
				$feed_url						= htmlspecialchars_decode($request->variable('feed_url', '', true));
				$encoding						= htmlspecialchars_decode($request->variable('encoding', '', true));
				$template_for_displaying		= htmlspecialchars_decode($request->variable('template_for_displaying', '', true));
				$template_for_posting			= htmlspecialchars_decode($request->variable('template_for_posting', '', true));
				$enabled_posting				= $request->variable('enabled_posting', 0);
				$enabled_displaying				= $request->variable('enabled_displaying', 0);
				$username						= utf8_normalize_nfc(request_var('username', '', true));
				$poster_forum_destination_id	= $request->variable('poster_forum_destination_id', 0);
				$poster_topic_destination_id	= $request->variable('poster_topic_destination_id', 0);
				$refresh_after_hours			= $request->variable('refresh_after_hours', 0) * 3600;
				$refresh_after_minutes			= $request->variable('refresh_after_minutes', 0) * 60;
				$refresh_after					= $refresh_after_hours + $refresh_after_minutes;
				$refresh_after					= ($refresh_after > 0) ? $refresh_after : 3600;
				$posting_limit					= $request->variable('posting_limit', 1);

				if ($feed_name && $feed_url)
				{
					$sql = 'SELECT user_id
						FROM ' . USERS_TABLE . "
						WHERE username_clean = '" . $db->sql_escape(utf8_clean_string($username)) . "'";
					$result = $db->sql_query($sql);
					$poster_id = (int) $db->sql_fetchfield('user_id');
					$db->sql_freeresult($result);
		
					if (!$poster_id)
					{
						$poster_id = $user->data['user_id'];
					}

					$sql_ary = array(
						'feed_name'						=> $feed_name,
						'feed_type'						=> $feed_type,
						'url'							=> $feed_url,
						'encoding'						=> $encoding,
						'enabled_posting'				=> $enabled_posting,
						'enabled_displaying'			=> $enabled_displaying,
						'template_for_posting'			=> $template_for_posting,
						'template_for_displaying'		=> $template_for_displaying,
						'poster_id'						=> $poster_id,
						'poster_forum_destination_id'	=> $poster_forum_destination_id,
						'poster_topic_destination_id'	=> $poster_topic_destination_id,
						'refresh_after'					=> $refresh_after,
						'posting_limit'					=> $posting_limit,
						'next_update'					=> 0,
					);

					if (!$id)
					{
						$sql = 'INSERT INTO ' . SFNC_FEEDS . ' ' . $db->sql_build_array('INSERT', $sql_ary);
					}
					else if ($id)
					{
						$sql = 'UPDATE ' . SFNC_FEEDS . '
								SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
								WHERE id = ' . (int) $id;
					}

					$db->sql_query($sql);

					trigger_error($language->lang('ACP_OX_ACTION_SUCCESS') . adm_back_link($this->u_action));
				}
				else
				{
					trigger_error($language->lang('ACP_OX_ACTION_ERROR_VALUES') . adm_back_link($this->u_action), E_USER_WARNING);
				}
			}

			$available_attributes = array();

			$sfnc = new \oxpus\feed\helpers\ sfnc_class();
			$sfnc->acp_init($id);

			$available_attributes = $sfnc->get_available_bb();

			$forum_list = make_forum_select(false, false, true, true, true, false, true);

			$selected_forum = isset($list[$id]['poster_forum_destination_id']) ? $list[$id]['poster_forum_destination_id'] : 0;

			$forum_list_select_box = '<select id="poster_forum_destination_id" name="poster_forum_destination_id" size="1">';

			foreach ($forum_list as $f_id => $row)
			{
				$forum_list_select_box .= '<option value="' . $f_id . '"' . (($selected_forum == $f_id) ? ' selected="selected"' : '') . ($row['disabled'] ? ' disabled="disabled" class="disabled-option"' : '') . '>' . $row['padding'] . $row['forum_name'] . '</option>';
			}

			$forum_list_select_box .= '</select>';

			$sql = 'SELECT username
				FROM ' . USERS_TABLE . '
				WHERE user_id = ' . (int) $list[$id]['poster_id'];
			$result = $db->sql_query($sql);
			$poster_name = $db->sql_fetchfield('username');
			$db->sql_freeresult($result);

			if (!$poster_name)
			{
				$poster_name = $user->data['username'];
			}

			if (isset($list[$id]['refresh_after']))
			{
				$refresh_hours		= floor($list[$id]['refresh_after'] / 3600);
				$refresh_minutes	= ceil(($list[$id]['refresh_after'] - ($refresh_hours * 3600)) / 60);
			}
			else
			{
				$refresh_hours		= 0;
				$refresh_minutes	= 0;
			}

			$template->assign_vars(array(
				'FEED_ID'								=> $id,
				'FEED_NAME'								=> isset($list[$id]['feed_name']) ? $list[$id]['feed_name'] : '',
				'FEED_TYPE'								=> isset($list[$id]['feed_type']) ? $list[$id]['feed_type'] : '',
				'URL'									=> isset($list[$id]['url']) ? $list[$id]['url'] : 'http://',
				'ENABLED_POSTING'						=> isset($list[$id]['enabled_posting']) ? $list[$id]['enabled_posting'] : 0,
				'ENABLED_DISPLAYING'					=> isset($list[$id]['enabled_displaying']) ? $list[$id]['enabled_displaying'] : 0,
				'ENCODING'								=> isset($list[$id]['encoding']) ? strtoupper($list[$id]['encoding']) : 'UTF-8',
				'NEXT_UPDATE_HOURS'						=> isset($list[$id]['next_update']) ? ($list[$id]['next_update'] > 3600) ? $list[$id]['next_update'] : $list[$id]['next_update']  : '',
				'NEXT_UPDATE_MINUTES'					=> isset($list[$id]['next_update']) ? ($list[$id]['next_update'] > 3600) ? $list[$id]['next_update'] : $list[$id]['next_update']  : '',
				'NEXT_UPDATE'							=> isset($list[$id]['next_update']) ? $list[$id]['next_update'] : '',
				'REFRESH_AFTER_HOURS'					=> $refresh_hours, //(isset($list[$id]['refresh_after'])) ? ($list[$id]['refresh_after'] < 3600) ? 0 : floor($list[$id]['refresh_after'] / 3600) : 24,
				'REFRESH_AFTER_MINUTES'					=> $refresh_minutes, //(isset($list[$id]['refresh_after'])) ? ($list[$id]['refresh_after'] < 3600) ? 0 : ceil(($list[$id]['refresh_after'] % 3600) / 60) : 0,
				'AVAILABLE_ATTRIBUTES'					=> implode(', ', $available_attributes),
				'TEMPLATE_FOR_POSTING'					=> isset($list[$id]['template_for_posting']) ? $list[$id]['template_for_posting'] : '',
				'TEMPLATE_FOR_DISPLAYING'				=> isset($list[$id]['template_for_displaying']) ? $list[$id]['template_for_displaying'] : '',
				'POSTER_NAME'							=> $poster_name,
				'POSTER_FORUM_DESTINATION_ID'			=> isset($list[$id]['poster_forum_destination_id']) ? $list[$id]['poster_forum_destination_id'] : 0,
				'POSTER_FORUM_DESTINATION_ID_SELECTBOX'	=> $forum_list_select_box,
				'POSTER_TOPIC_DESTINATION_ID'			=> isset($list[$id]['poster_topic_destination_id']) ? $list[$id]['poster_topic_destination_id'] : 0,
				'POSTING_LIMIT'							=> isset($list[$id]['posting_limit']) ? $list[$id]['posting_limit'] : 1,
				'S_VIEW'								=> 'manage',
				'S_SELECT_USER'							=> true,
				'U_FIND_USERNAME'						=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=searchuser&amp;form=select_user&amp;field=username&amp;select_single=true'),
				'U_MANAGE'								=> $basic_link . '&amp;view=manage&amp;action=edit&amp;id=' . (int) $id,
				'U_DELETE'								=> $basic_link . '&amp;view=manage&amp;action=delete&amp;id=' . (int) $id,
			));
		}
	}
}
