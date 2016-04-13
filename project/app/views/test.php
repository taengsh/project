<?php
ini_set("max_execution_time", 0);
// Call set_include_path() as needed to point to your client library.

session_start();
/*
 * You can acquire an OAuth 2.0 client ID and client secret from the
 * Google Developers Console <https://console.developers.google.com/>
 * For more information about using OAuth 2.0 to access Google APIs, please see:
 * <https://developers.google.com/youtube/v3/guides/authentication>
 * Please ensure that you have enabled the YouTube Data API for your project.
 */


$OAUTH2_CLIENT_ID = '225495119308-pho565qrgiaj6urmspmr8j424dv0thjj.apps.googleusercontent.com';
$OAUTH2_CLIENT_SECRET = 'NIWAtPJqZctnoVcwCwvsNPrv';
//$OAUTH2_CLIENT_ID = '166585705395-jbe88q0dipmj4qtjn91hc85rtffetcqj.apps.googleusercontent.com';
//$OAUTH2_CLIENT_SECRET = 'sv2S5B44hv2q6n7hC3VHtVWr';
$htmlBody = "";
$client = new Google_Client();
$client->setClientId($OAUTH2_CLIENT_ID);
$client->setApprovalPrompt('auto');
$client->revokeToken();
$client->setAccessType('offline');
$client->setClientSecret($OAUTH2_CLIENT_SECRET);
$client->setScopes('https://www.googleapis.com/auth/youtube');
$redirect = "http://161.246.6.1:8002/project/public/testyoutube";
$client->setRedirectUri($redirect);	

// Define an object that will be used to make all API requests.
$youtube = new Google_Service_YouTube($client);

if (isset($_GET['code'])) {
	 // $client->authenticate();
	  //$_SESSION['access_token'] = $client->getAccessToken();
  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
    var_dump($_SESSION['state']);
    var_dump($_GET['state']);
    die('The session state did not match.');
  }
  $client->authenticate($_GET['code']);
 $_SESSION['token'] = $client->getAccessToken();
 var_dump($_SESSION['token']);
 return 0;
   header('Location: ' . $redirect);
}

if (isset($_SESSION['token'])) {
	//var_dump($client);
	//return 0;
	//var_dump($_SESSION['token']);
	//$client->refreshToken('1/puY6ZR9NlbMVeutaAEGwGEsNZK_WiC60FKC5BAJ4gr0');
  $client->setAccessToken($_SESSION['token']);
  	//$_SESSION['access_token']=$client->getAccessToken();
  //echo($client->getAccessToken());
 // var_dump($client->getAccessToken());
  //var_dump($client);
    //var_dump($_SESSION['token']);
  if ($client->isAccessTokenExpired()) {
  	$client->refreshToken('1/gZb4w9pWpKVRIPeVpp24BS2q1UjZuKQgJhi6EqnRHe4');
  	var_dump($client);
  	$_SESSION['access_token']=$client->getAccessToken();
  	$client->setAccessToken($_SESSION['access_token']);
 //	$client->refreshToken('1/BgRb3qZK0_3j5jLtFBQsYeie5aQl_tBOUcdTzOxokZIMEudVrK5jSpoR30zcRFq6');
 //   $client->refreshToken($access_token['access_token']);
  }
}
// Check to ensure that the access token was successfully acquired.
if ($client->getAccessToken()) {
  try {
    // This code creates a new, private playlist in the authorized user's
    // channel and adds a video to the playlist.

    // 1. Create the snippet for the playlist. Set its title and description.
    $playlistSnippet = new Google_Service_YouTube_PlaylistSnippet();
    $playlistSnippet->setTitle('Test Playlist  ' . date("Y-m-d H:i:s"));
    $playlistSnippet->setDescription('A private playlist created with the YouTube API v3');

    // 2. Define the playlist's status.
    $playlistStatus = new Google_Service_YouTube_PlaylistStatus();
    $playlistStatus->setPrivacyStatus('private');

    // 3. Define a playlist resource and associate the snippet and status
    // defined above with that resource.
    $youTubePlaylist = new Google_Service_YouTube_Playlist();
    $youTubePlaylist->setSnippet($playlistSnippet);
    $youTubePlaylist->setStatus($playlistStatus);

    // 4. Call the playlists.insert method to create the playlist. The API
    // response will contain information about the new playlist.
    $playlistResponse = $youtube->playlists->insert('snippet,status',
    $youTubePlaylist, array());
    $playlistId = $playlistResponse['id'];
    // 5. Add a video to the playlist. First, define the resource being added
    // to the playlist by setting its video ID and kind.
    $resourceId = new Google_Service_YouTube_ResourceId();
    $resourceId->setVideoId('SZj6rAYkYOg');
    $resourceId->setKind('youtube#video');

    // Then define a snippet for the playlist item. Set the playlist item's
    // title if you want to display a different value than the title of the
    // video being added. Add the resource ID and the playlist ID retrieved
    // in step 4 to the snippet as well.
    $playlistItemSnippet = new Google_Service_YouTube_PlaylistItemSnippet();
    $playlistItemSnippet->setTitle('First video in the test playlist');
    $playlistItemSnippet->setPlaylistId($playlistId);
    $playlistItemSnippet->setResourceId($resourceId);

    // Finally, create a playlistItem resource and add the snippet to the
    // resource, then call the playlistItems.insert method to add the playlist
    // item.
    $playlistItem = new Google_Service_YouTube_PlaylistItem();
    $playlistItem->setSnippet($playlistItemSnippet);
    $playlistItemResponse = $youtube->playlistItems->insert(
        'snippet,contentDetails', $playlistItem, array());
     $htmlBody .= "<h3>New Playlist</h3><ul>";
    $htmlBody .= sprintf('<li>%s (%s)</li>',
        $playlistResponse['snippet']['title'],
        $playlistResponse['id']);
    $htmlBody .= '</ul>';

    $htmlBody .= "<h3>New PlaylistItem</h3><ul>";
    $htmlBody .= sprintf('<li>%s (%s)</li>',
        $playlistItemResponse['snippet']['title'],
        $playlistItemResponse['id']);
    $htmlBody .= '</ul>';

    $resourceId = new Google_Service_YouTube_ResourceId();
    $resourceId->setVideoId('pkSxfMJZjuo');
    $resourceId->setKind('youtube#video');

    // Then define a snippet for the playlist item. Set the playlist item's
    // title if you want to display a different value than the title of the
    // video being added. Add the resource ID and the playlist ID retrieved
    // in step 4 to the snippet as well.
    $playlistItemSnippet = new Google_Service_YouTube_PlaylistItemSnippet();
    $playlistItemSnippet->setTitle('First video in the test playlist');
    $playlistItemSnippet->setPlaylistId($playlistId);
    $playlistItemSnippet->setResourceId($resourceId);

    // Finally, create a playlistItem resource and add the snippet to the
    // resource, then call the playlistItems.insert method to add the playlist
    // item.
    $playlistItem = new Google_Service_YouTube_PlaylistItem();
    $playlistItem->setSnippet($playlistItemSnippet);
    $playlistItemResponse = $youtube->playlistItems->insert(
        'snippet,contentDetails', $playlistItem, array());



    $htmlBody .= "<h3>New Playlist</h3><ul>";
    $htmlBody .= sprintf('<li>%s (%s)</li>',
        $playlistResponse['snippet']['title'],
        $playlistResponse['id']);
    $htmlBody .= '</ul>';

    $htmlBody .= "<h3>New PlaylistItem</h3><ul>";
    $htmlBody .= sprintf('<li>%s (%s)</li>',
        $playlistItemResponse['snippet']['title'],
        $playlistItemResponse['id']);
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