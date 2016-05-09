<?php
ini_set("max_execution_time", 0);
// Call set_include_path() as needed to point to your client library.
//require_once 'Google/Service/YouTube.php';
//$videoname = "groupEfernAndpic4.avi";
$title = "groupKMITLtoสถานีรถไฟหัวตะเข้and20pic.avi";


session_start();
/*
 * You can acquire an OAuth 2.0 client ID and client secret from the
 * Google Developers Console <https://console.developers.google.com/>
 * For more information about using OAuth 2.0 to access Google APIs, please see:
 * <https://developers.google.com/youtube/v3/guides/authentication>
 * Please ensure that you have enabled the YouTube Data API for your project.
 */

$OAUTH2_CLIENT_ID = '1099096092113-fjp7osplt9u776bhqignu5mtkardat8c.apps.googleusercontent.com';
$OAUTH2_CLIENT_SECRET = 'LkQEYvZxBwLOiGbmKfkAsOax';
$htmlBody = "";
$client = new Google_Client();
$client->setClientId($OAUTH2_CLIENT_ID);
$client->setApprovalPrompt('auto');
$client->revokeToken();
$client->setAccessType('offline');
$client->setClientSecret($OAUTH2_CLIENT_SECRET);
$client->setScopes('https://www.googleapis.com/auth/youtube');
$redirect = "http://network01.ce.kmitl.ac.th:8002/project/public/testyoutube";
$client->setRedirectUri($redirect);	

// Define an object that will be used to make all API requests.
$youtube = new Google_Service_YouTube($client);

if (isset($_GET['code'])) {
	 // $client->authenticate();
	  //$_SESSION['access_token'] = $client->getAccessToken();
  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
    var_dump("////session state////"); var_dump($_SESSION['state']); 
    var_dump("////state////");var_dump($_GET['state']); 
    die('The session state did not match.');
  }
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: ' . $redirect);
  var_dump("////token////"); var_dump($_SESSION['token']);
  //return 0;
   header('Location: ' . $redirect);
}

if (isset($_SESSION['token'])) {
	//var_dump($client);
	var_dump("////....////"); var_dump($_SESSION['token']);
  //return 0;
	//$client->refreshToken('1/puY6ZR9NlbMVeutaAEGwGEsNZK_WiC60FKC5BAJ4gr0');
    $client->setAccessToken($_SESSION['token']);
  	//$_SESSION['access_token']=$client->getAccessToken();
  //echo($client->getAccessToken());
 // var_dump($client->getAccessToken());
  //var_dump($client);
    //var_dump($_SESSION['token']);
  /*if ($client->isAccessTokenExpired()) {
  	$client->refreshToken('1/gZb4w9pWpKVRIPeVpp24BS2q1UjZuKQgJhi6EqnRHe4');
  	var_dump($client);
  	$_SESSION['access_token']=$client->getAccessToken();
  	$client->setAccessToken($_SESSION['access_token']);
 	$client->refreshToken('1/BgRb3qZK0_3j5jLtFBQsYeie5aQl_tBOUcdTzOxokZIMEudVrK5jSpoR30zcRFq6');
    $client->refreshToken($access_token['access_token']);
  }*/
    if ($client->isAccessTokenExpired()) {
   $client->refreshToken($client->getRefreshToken());
  }
}
// Check to ensure that the access token was successfully acquired.
if ($client->getAccessToken()) {
  try {

  
        chdir('assets');
    $videoPath = "groupKMITLtoสถานีรถไฟหัวตะเข้and20pic.avi";

   // echo getcwd() . "\n";
      //  exec('ls', $out);
      //  var_dump($out);

    // Create a snippet with title, description, tags and category ID
    // Create an asset resource and set its snippet metadata and type.
    // This example sets the video's title, description, keyword tags, and
    // video category.
    $snippet = new Google_Service_YouTube_VideoSnippet();
    $snippet->setTitle($title);
    $snippet->setDescription($title);
    $snippet->setTags(array("tag1", "tag2"));
    //var_dump($snippet);var_dump("fernnnnnnnnnnnnnnnnnnnnn");

    // Numeric video category. See
    // https://developers.google.com/youtube/v3/docs/videoCategories/list 
    $snippet->setCategoryId("22");
   // var_dump($snippet);var_dump("fernnnnnnnnnnnnnnnnnnnnn");

    // Set the video's status to "public". Valid statuses are "public",
    // "private" and "unlisted".
    $status = new Google_Service_YouTube_VideoStatus();
    $status->privacyStatus = "public";
   // var_dump($status);var_dump("fernnnnnnnnnnnnnnnnnnnnn");

    // Associate the snippet and status objects with a new video resource.
    $video = new Google_Service_YouTube_Video();
    $video->setSnippet($snippet);
    $video->setStatus($status);
    //var_dump($video);var_dump("fernnnnnnnnnnnnnnnnnnnnn");

    // Specify the size of each chunk of data, in bytes. Set a higher value for
    // reliable connection as fewer chunks lead to faster uploads. Set a lower
    // value for better recovery on less reliable connections.
    $chunkSizeBytes = 1 * 1024 * 1024;
    
    // Setting the defer flag to true tells the client to return a request which can be called
    // with ->execute(); instead of making the API call immediately.
    $client->setDefer(true);
echo "t";
    // Create a request for the API's videos.insert method to create and upload the video.
    $insertRequest = $youtube->videos->insert("status,snippet", $video);
    
    // Create a MediaFileUpload object for resumable uploads.
    $media = new Google_Http_MediaFileUpload(
        $client,
        $insertRequest,
        'video/*',
        null,
        true,
        $chunkSizeBytes
    );

    $media->setFileSize(filesize($videoPath));


    // Read the media file and upload it chunk by chunk.
    $status = false;
    $handle = fopen($videoPath, "rb");
    while (!$status && !feof($handle)) {
      $chunk = fread($handle, $chunkSizeBytes);
      $status = $media->nextChunk($chunk);
    }

    $result = false;
    if($status != false) {
     $result = $status;
    }

    fclose($handle);

    // If you want to make other calls after the file upload, set setDefer back to false
    $client->setDefer(false);
    var_dump("0000000000");


    $htmlBody .= "<h3>Video Uploaded</h3><ul>";
    $htmlBody .= sprintf('<li>%s (%s)</li>',
        $status['snippet']['title'],
        $status['id']);

    $htmlBody .= '</ul>';

  } catch (Google_Service_Exception $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
  }

  $_SESSION['token'] = $client->getAccessToken();
} else {
  // If the user hasn't authorized the app, initiate the OAuth flow
  $state = mt_rand();
  $client->setState($state);
  $_SESSION['state'] = $state;

  $authUrl = $client->createAuthUrl();
  $htmlBody = <<<END
  <h3>Authorization Required</h3>
  <p>You need to <a href="$authUrl">authorize access</a> before proceeding.<p>
END;
}
?>

<!doctype html>
<html>
<head>
<title>New Playlist</title>
</head>
<body>
  <?=$htmlBody?>
</body>
</html>
