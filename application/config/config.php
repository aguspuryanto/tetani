<?php
/*
| -------------------------------------------------------------------
| CONFIG APPLICATION
| -------------------------------------------------------------------
| GOJASA CONFIG STRUCT
|
| By Juwendi
| maswend.2020@gmail.com
| 08991585001
| -------------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');
$config['DEMO'] = FALSE;
$fcmserver = 'AAAAX06Dv_A:APA91bE4m9nUIqjR1kVj9MXqSZB0lK-G6F6d88HhH_ZxbnIM_9dwIcQcPG6SZZEsBNfwIx5F21MlCOrP92NU3c-A_TcI-L71izQMRFMvOvoMfPk9g6hLESblKRV3Ugl1RtppqwebHcdh';
$googleapi = 'AIzaSyCmkVwCTlPT6Hsc5efIh2aT0uP6gQeu0QA';
$config['app_name'] = 'Tetani';
$config['base_url'] = 'http://localhost/tetani/';
$config['app_api'] =    '1';
$config['fcm_server'] = '1';
//mobilepulsa
$config['mp_server'] = 'https://prepaid.iak.dev/v1/legacy/index';
$config['mp_user'] = '08991585001';
$config['mp_apikey'] = '2526030b3e046f49';
define('firebaseDb', 'https://newgojasa-default-rtdb.firebaseio.com/');
define('keyfcm', $fcmserver);
define('google_maps_api', $googleapi);
$config['index_page'] = '';
$config['uri_protocol']    = 'REQUEST_URI';
$config['url_suffix'] = '';
$config['language']    = 'english';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = FALSE;
$config['subclass_prefix'] = 'MY_';
$config['composer_autoload'] = FALSE;
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';
$config['allow_get_array'] = TRUE;
$config['log_threshold'] = 0;
$config['log_path'] = '';
$config['log_file_extension'] = '';
$config['log_file_permissions'] = 0644;
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['error_views_path'] = '';
$config['cache_path'] = '';
$config['cache_query_string'] = FALSE;
$config['encryption_key'] = '';
// $config['sess_driver'] = 'files';
// $config['sess_cookie_name'] = 'ci_session';
// $config['sess_expiration'] = 7200;
// $config['sess_save_path'] = NULL;
// $config['sess_save_path'] = sys_get_temp_dir();
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;
$config['cookie_prefix']    = '';
$config['cookie_domain']    = '';
$config['cookie_path']        = '/';
$config['cookie_secure']    = TRUE;
$config['cookie_httponly']     = TRUE;
define('c9283746321av', '25862136');
$config['standardize_newlines'] = FALSE;
define('xcxc09ddlkfdf98xck0rt89dff', 'qn7nqAY7Zb02pogRzmJo84OJnycUkSwG');
$config['global_xss_filtering'] = FALSE;
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array();
$config['compress_output'] = TRUE;
$config['time_reference'] = 'local';
define('c9283746321a', c9283746321av);
define('xcxc09ddlkfdf98xck0rt89df', xcxc09ddlkfdf98xck0rt89dff);
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';
$config['LICENSE_KEY'] = 'PML-5L17-1Z55-XJ51-4638';

// php 7.4
$config['sess_driver'] = 'database';
$config['sess_cookie_name'] = '165_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = "ci_sessions";