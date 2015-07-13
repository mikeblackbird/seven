<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи и ABSPATH. Дополнительную информацию можно найти на странице
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется скриптом для создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения вручную.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'seven');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

define( 'WPLANG', 'ru_RU' );
/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'qp5|j)xhU.s<)7C+ttqn0?=a9UO/}2+||qnp-iFFx3Gc-7JRs+1aI|`(+-opg,m6');
define('SECURE_AUTH_KEY',  '2GSQF2NKVd_8v|8Z9PR4-2<]S)[xHW$7+_R-Js2{9:rosntnX-p9j3KbG|wy-f@K');
define('LOGGED_IN_KEY',    'AAtcb<bDWQs--j^trcIyZP[Vgr|]i|nq3}`OhC,8Ygd~1nOT-Oo)VYsMjMC^BL-+');
define('NONCE_KEY',        'G5d4OyY-{n19;HD(k3&;Chwg^%!+zy)+udk!]/{l7>.*P}yD((P-*$.DG%9LgMKV');
define('AUTH_SALT',        '&9Or!|R4grP}nnmif)C(JSNf$-t0#8+0lp^@1Q&mG7s9N|,Y(>Q>2+WwtC>434=U');
define('SECURE_AUTH_SALT', 'z475 s:%+eB=~$kCw=W2q_?Ic^?0W&-xBl^2l :Jrnc.jfw}L}4ukKv~2pxg^Jgv');
define('LOGGED_IN_SALT',   ' a2?_sFQAzn?]3bC#pZYY=S4^}C _?S$-;NeV&nE3O+0+TS|=pFU[YJl(3t~k1Z>');
define('NONCE_SALT',       '-nC>QvQCy:9&!U#]9Uzx!f?NU?p#s(o`bfL4RP[JtRW3-K+Bwotloi*6V8@-1Uv ');

	

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
