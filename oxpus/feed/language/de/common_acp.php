<?php

/**
*
* @package phpBB Extension - Feed Reader
* @copyright (c) 2016 OXPUS - www.oxpus.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/*
* [ german ] language file
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
	'ACP_OX_FEED_READER'								=> 'Feed Reader',
	'ACP_OX_FEED_READER_MANAGE'							=> 'Feeds verwalten',
	'ACP_OX_FEED_READER_MANAGE_UPDATED'					=> 'Feed aktualisiert',
	'ACP_OX_FEED_READER_CONFIG'							=> 'Allgemeine Einstellungen',
	'ACP_OX_FEED_READER_CONFIG_UPDATED'					=> 'Feed Reader Einstellungen aktualisiert',

	'ACP_OX'											=> 'Feed News Center',
	'ACP_OX_FEEDS'										=> 'Feeds Liste',
	'ACP_OX_FEEDS_DESCRIPTION'							=> 'Hier kannst du einen Feed auswählen, um ihn zu bearbeiten oder zu löschen oder einen neuen Feed anlegen.',
	'ACP_OX_ADD_NEW'									=> 'Neuen Feed anlegen',
	'ACP_OX_BASIC'										=> 'Basiseinstellungen',
	'ACP_OX_DOWNLOAD_FUNCTION'							=> 'Downloadfunktion',
	'ACP_OX_DOWNLOAD_FUNCTION_DESCRIPTION'				=> 'Welche Funktion wird zum Download verwendet (simplexml empfohlen)?',
	'ACP_OX_ENCODING'									=> 'Kodierung',
	'ACP_OX_ENCODING_DESCRIPTION'						=> 'Kodierung des Feeds',
	'ACP_OX_FEED_ENABLED_POSTING_SHORT'					=> 'Posting',
	'ACP_OX_FEED_ENABLED_POSTING'						=> 'Inhalt des Feeds posten',
	'ACP_OX_FEED_ENABLED_POSTING_DESCRIPTION'			=> 'Wenn aktiviert, wird der heruntergeladene Inhalt im Forum veröffentlicht',
	'ACP_OX_FEED_ENABLED_DISPLAYING_SHORT'				=> 'Anzeige',
	'ACP_OX_FEED_ENABLED_DISPLAYING'					=> 'Anzeige des Feeds im Board',
	'ACP_OX_FEED_ENABLED_DISPLAYING_DESCRIPTION'		=> 'Wenn aktiviert, wird der gepufferte Inhalt im Forum als News Ticker angezeigt',
	'ACP_OX_FEED_NAME'									=> 'Name',
	'ACP_OX_FEED_NAME_DESCRIPTION'						=> 'Name des Feeds',
	'ACP_OX_FEED_TICKER_POSITION'						=> 'Anzeigeposition des Feed Tickers',
	'ACP_OX_FEED_TICKER_POSITION_DESCRIPTION'			=> 'Bestimme hier, wo der Ticker für heruntergeladene Feeds angezeigt werden soll.<br />Du kannst den Ticker hier auch komplett abschalten, unabhängig der Einstellungen in den Feeds.',
	'ACP_OX_FEED_TICKER_POSITION_0'						=> 'deaktiviert',
	'ACP_OX_FEED_TICKER_POSITION_1'						=> 'über dem Boardkopf',
	'ACP_OX_FEED_TICKER_POSITION_2'						=> 'über der oberen Navigationsleiste',
	'ACP_OX_FEED_TICKER_POSITION_3'						=> 'vor dem Seiteninhalt',
	'ACP_OX_FEED_TICKER_POSITION_4'						=> 'am Anfang des Seiteninhalt',
	'ACP_OX_FEED_TICKER_POSITION_5'						=> 'am Ende des Seiteninhalts',
	'ACP_OX_FEED_TICKER_POSITION_6'						=> 'nach dem Seitenhínhalt',
	'ACP_OX_FEED_TICKER_POSITION_7'						=> 'unter dem Boardfuß',
	'ACP_OX_FEED_TYPE'									=> 'Typ',
	'ACP_OX_FEED_TYPE_DESCRIPTION'						=> 'Typ des Feeds (ATOM/RSS/RDF)',
	'ACP_OX_FEED_URL'									=> 'URL',
	'ACP_OX_FEED_URL_DESCRIPTION'						=> 'URL des Feeds',
	'ACP_OX_FEEDS_UPD_NEVER'							=> 'nie',
	'ACP_OX_LAST_UPDATE'								=> 'Letzte Aktualiserung',
	'ACP_OX_LAST_UPDATE_DESCRIPTION'					=> 'Zeit nachdem der Feed aktualisiert wurde',
	'ACP_OX_NEWS_TICKER'								=> 'News Ticker',
	'ACP_OX_NEXT_UPDATE'								=> 'Nächste Aktualiserung',
	'ACP_OX_POSTING'									=> 'Posting',
	'ACP_OX_POSTER_ID'									=> 'Poster',
	'ACP_OX_POSTER_ID_DESCRIPTION'						=> 'Benutzer-Name der als Poster der Nachricht eingesetzt werden soll',
	'ACP_OX_POSTER_FORUM_DESTINATION_ID'				=> 'Forum ID',
	'ACP_OX_POSTER_FORUM_DESTINATION_ID_DESCRIPTION'	=> 'Forum ID, in dem der Beitrag veröffentlicht werden soll',
	'ACP_OX_POSTER_TOPIC_DESTINATION_ID'				=> 'Topic ID',
	'ACP_OX_POSTER_TOPIC_DESTINATION_ID_DESCRIPTION'	=> 'Topic ID, an den der Beitrag angehangen werden soll<br />Befindet sich das angegeben Topic in einem anderen Forum, wie in der vorherigen Option ausgewählt, wird das Forum des Topics gewählt.',
	'ACP_OX_POSTING_LIMIT'								=> 'Nachrichtenlimit',
	'ACP_OX_POSTING_LIMIT_DESCRIPTION'					=> 'Wie viele letzte Nachrichten sollten geprüft und gepostet werden',
	'ACP_OX_REFRESH_AFTER'								=> 'Prüfe Feed nach',
	'ACP_OX_REFRESH_AFTER_DESCRIPTION'					=> 'Nach welcher Zeit soll ein Feed erneut auf neuen Inhalt geprüft werden? (Hinweis: Wenn du den CRON Modus verwendest, werden alle Feed auf einmal geprüft)',
	'ACP_OX_REFRESH_AFTER_HOURS'						=> 'Stunden',
	'ACP_OX_REFRESH_AFTER_MINUTES'						=> 'Minuten',

	'ACP_OX_AVAILABLE_ATTRIBUTES'						=> 'Verfügbare Attribute',
	'ACP_OX_TEMPLATES'									=> 'Vorlagen',
	'ACP_OX_TEMPLATES_DESCRIPTION'						=> 'Hier kannst du Vorlagen bearbeiten, um die Nachricht zu posten oder im Forum anzuzeigen',
	'ACP_OX_TEMPLATE_FOR_POSTING'						=> 'Post-Vorlage',
	'ACP_OX_TEMPLATE_FOR_POSTING_DESCRIPTION'			=> 'Vorlage für Beiträge, wenn aktiviert',
	'ACP_OX_TEMPLATE_FOR_DISPLAYING'					=> 'Anzeige-Vorlage',
	'ACP_OX_TEMPLATE_FOR_DISPLAYING_DESCRIPTION'		=> 'Vorlage für den News Ticker, wenn aktiviert',

	'ACP_OX_ACTION_ERROR_DB'							=> 'Es gab einen Fehler während dem Speichern der Werte',
	'ACP_OX_ACTION_SUCCESS'								=> 'Aktion wurde erfolgreich abgeschlossen',
	'ACP_OX_ACTION_ERROR_VALUES'						=> 'Es wurden nicht alle nötigen Informationen erfasst',

	'ACP_OX_INIT_ON_INDEX'								=> 'Board Init',
	'ACP_OX_INIT_ON_INDEX_DESCRIPTION'					=> 'Wenn aktiviert wird mit jedem Seitenaufruf EIN Feed heruntergeladen',
	'ACP_OX_POSTING_ON_INDEX'							=> 'Board Posting',
	'ACP_OX_POSTING_ON_INDEX_DESCRIPTION'				=> 'Wenn aktiviert, wird der beim Seitenaufruf heruntergeladene Feed im Forum veröffentlicht',
	'ACP_OX_INIT_ON_CRON'								=> 'Cron Init',
	'ACP_OX_INIT_ON_CRON_DESCRIPTION'					=> 'Aktiviere dieses, wenn du einen CRON Job zum Aktualiseren der Feeds verwenden möchstest (cron.php im phpBB ROOT Verzeichnis). Wenn aktiviert, wird kein Feed beim Seitenaufruf des Forums heruntergeladen.',
	'ACP_OX_POSTING_ON_CRON'							=> 'Cron Posting',
	'ACP_OX_POSTING_ON_CRON_DESCRIPTION'				=> 'Wenn aktiviert, wird beim Aufruf des Cron Init der Feed Inhalt im Forum veröffentlicht',

	'LOG_SFNC_FEED_CONFIG'								=> 'Feed Reader Einstellungen geändert.',
	'LOG_SFNC_FEED_MANAGE'								=> 'Einstellungen für Feed %s geändert.',
	'LOG_ERROR_SFNC_FEED_PARSER_NO_FEED_TYPE'			=> 'Kann den Feed Typ für Feed "%s" nicht ermitteln',
));
