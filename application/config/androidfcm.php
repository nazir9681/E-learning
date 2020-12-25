<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
|| Android Firebase Push Notification Configurations
|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 */

/*
|--------------------------------------------------------------------------
| Firebase API Key
|--------------------------------------------------------------------------
|
| The secret key for Firebase API
|
 */
/*$config['API_ACCESS_KEY'] = 'AIzaSyBvV0SSXoAV4vaVAsFghkyFRfpO0CfSfaY';*/
// $config['API_ACCESS_KEY'] = 'AAAAlt2NKes:APA91bGXFhsEQVkeROWZyUhvLIOt45K_gxYtoAfZPbVnqmBmMvX3auPzYq8C_KCuGV62p19_p9bGxtZYnIsBtNTg8S5mVFhEUiJAhTQ05-RwQHdoMMtuaMT6bo17BcO8AyC-e-9mbzSG';
$config['API_ACCESS_KEY'] = 'AAAAH_rU3hk:APA91bGp6J4OdRHPRfSwyB6EbH-_2pWz2iops70oMA7LQUYUQH1XXRir9_KD6PLtgtmHlInBn3Z-jcWPp2-1XCLKRUPj4O06TzohKbRnEI8bYiMtMLbZ3OARrwrbP39bxmFxNjinyXhi';

/*
|--------------------------------------------------------------------------
| Firebase Cloud Messaging API URL
|--------------------------------------------------------------------------
|
| The URL for Firebase Cloud Messafing
|
 */

$config['fcm_url'] = 'https://fcm.googleapis.com/fcm/send';

return $config;
?>