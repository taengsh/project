<?php 
use Illuminate\Routing\Controller;
class testyoutubeController extends BaseController
{

    public function getindexweb()
    {
        //return View::make('nurse');
     return View::make('you');
    }

     public function gettestimage()
     {
            //return View::make('nurse');
         return View::make('image');
     }

     public function geteiei(){
            //echo "tetet";
        chdir('assets');
        shell_exec ("ffmpeg -r 1 -f image2 -start_number 0 -i c%d.jpg -vframes 9 groupEfernAndpic4.avi");
        echo "DONE";

    }

    protected function uploadvideo(){
        ini_set("max_execution_time", 0);
        session_start();

        $OAUTH2_CLIENT_ID = '1099096092113-fjp7osplt9u776bhqignu5mtkardat8c.apps.googleusercontent.com';
        $OAUTH2_CLIENT_SECRET = 'LkQEYvZxBwLOiGbmKfkAsOax';
        $client = new Google_Client();
        $client->setClientId($OAUTH2_CLIENT_ID);
        $client->setApprovalPrompt('auto');
        $client->revokeToken();
        $client->setAccessType('offline');
        $client->setClientSecret($OAUTH2_CLIENT_SECRET);
        $client->setScopes('https://www.googleapis.com/auth/youtube');
        $redirect = "http://network01.ce.kmitl.ac.th:8002/project/public/testyoutube";
        $client->setRedirectUri($redirect); 
        $client->refreshToken('1/hRcN9WzgL9WCViXnqGa1yXWnKZr5hs0McGlmoxsrl5kMEudVrK5jSpoR30zcRFq6');
        $_SESSION['access_token']=$client->getAccessToken();
        $client->setAccessToken($_SESSION['access_token']);


        // Define an object that will be used to make all API requests.
        $youtube = new Google_Service_YouTube($client);

        if (isset($_GET['code'])) {
              if (strval($_SESSION['state']) !== strval($_GET['state'])) {
                var_dump("////session state////"); var_dump($_SESSION['state']); 
                var_dump("////state////");var_dump($_GET['state']); 
                die('The session state did not match.');
            }
            $client->authenticate($_GET['code']);
            $_SESSION['token'] = $client->getAccessToken();
            header('Location: ' . $redirect);
            var_dump("////token////"); var_dump($_SESSION['token']);
            header('Location: ' . $redirect);
        }

        if (isset($_SESSION['token'])) {
          $client->setAccessToken($_SESSION['token']);
          if ($client->isAccessTokenExpired()) {
              $client->refreshToken('1/hRcN9WzgL9WCViXnqGa1yXWnKZr5hs0McGlmoxsrl5kMEudVrK5jSpoR30zcRFq6');
              $_SESSION['access_token']=$client->getAccessToken();
              $client->setAccessToken($_SESSION['access_token']);
          }
        }

        chdir('assets');
        $group = 10; 
        // Check to ensure that the access token was successfully acquired.
    
        if ($client->getAccessToken()) {
          for($a=1;$a<=4;$a++){
              $videoPath = "groupEfernAndpic4.avi";
              $title = "groupEfernAndpic4.avi";
              
                //$videoPath = "groupKMITLtoสถานีรถไฟหัวตะเข้and".$group."pic.avi";
                //$title = "groupKMITLtoสถานีรถไฟหัวตะเข้and".$group."pic.avi";

                // Create a snippet with title, description, tags and category ID
                // Create an asset resource and set its snippet metadata and type.
                // This example sets the video's title, description, keyword tags, and
                // video category.
                    $snippet = new Google_Service_YouTube_VideoSnippet();
                    $snippet->setTitle($title);
                    $snippet->setDescription($title);
                    $snippet->setTags(array("tag1", "tag2"));

                // Numeric video category. See
                // https://developers.google.com/youtube/v3/docs/videoCategories/list 
                    $snippet->setCategoryId("22");

                // Set the video's status to "public". Valid statuses are "public",
                // "private" and "unlisted".
                    $status = new Google_Service_YouTube_VideoStatus();
                    $status->privacyStatus = "public";

                // Associate the snippet and status objects with a new video resource.
                    $video = new Google_Service_YouTube_Video();
                    $video->setSnippet($snippet);
                    $video->setStatus($status);

                // Specify the size of each chunk of data, in bytes. Set a higher value for
                // reliable connection as fewer chunks lead to faster uploads. Set a lower
                // value for better recovery on less reliable connections.
                    $chunkSizeBytes = 1 * 1024 * 1024;

                // Setting the defer flag to true tells the client to return a request which can be called
                // with ->execute(); instead of making the API call immediately.
                    $client->setDefer(true);

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

               echo "Video Uploaded";
               echo sprintf('<li>%s (%s)</li>',
                $status['snippet']['title'],
                $status['id']);

            /*catch (Google_Service_Exception $e) {
                echo sprintf('A service error occurred: <code>%s</code>',
                htmlspecialchars($e->getMessage()));
            } 
            catch (Google_Exception $e) {
                echo sprintf('An client error occurred: <code>%s</code>',
                htmlspecialchars($e->getMessage()));
            }*/

            $_SESSION['token'] = $client->getAccessToken();
              $group = $group+10;
            }//for
          
        } 

        else {
          // If the user hasn't authorized the app, initiate the OAuth flow
          $state = mt_rand();
          $client->setState($state);
          $_SESSION['state'] = $state;

          $authUrl = $client->createAuthUrl();
          $re = "https://developers.google.com/oauthplayground/";
          echo "Authorization Required "; 
         echo "You need to.......".$authUrl;
        echo "<a href='".$re."'>authorize access</a>";
        echo " authorize access before proceeding";



        //header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
          
        }
        
    
}

protected function createPlaylist(){
    session_start();

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
    $redirect = "http://network01.ce.kmitl.ac.th:8002/project/public/testplaylist";
    $client->setRedirectUri($redirect); 
    //$client->refreshToken('ya29..zgIArftdR7ivgCUygbcTE6rEWPnjyDe9rdDfbyEb8msBA7jPjvVFoZl6fGP7Z7YDGDo');
   // $_SESSION['access_token']=$client->getAccessToken();
    //$client->setAccessToken($_SESSION['access_token']);
    
    // Define an object that will be used to make all API requests.
    $youtube = new Google_Service_YouTube($client);

    if (isset($_GET['code'])) {
    
      if (strval($_SESSION['state']) !== strval($_GET['state'])) {
      die('The session state did not match.');
      }
      $client->authenticate($_GET['code']);
     $_SESSION['token'] = $client->getAccessToken();
       header('Location: ' . $redirect);
    }

    if (isset($_SESSION['token'])) {
      $client->setAccessToken($_SESSION['token']);
      if ($client->isAccessTokenExpired()) {
          $client->refreshToken('ya29..zgIArftdR7ivgCUygbcTE6rEWPnjyDe9rdDfbyEb8msBA7jPjvVFoZl6fGP7Z7YDGDo');
        $_SESSION['access_token']=$client->getAccessToken();
        $client->setAccessToken($_SESSION['access_token']);
      }
    }
    if ($client->getAccessToken()) {
     // try {
     
      // This code creates a new, private playlist in the authorized user's
      // channel and adds a video to the playlist.
      // 1. Create the snippet for the playlist. Set its title and description.
      $playlistSnippet = new Google_Service_YouTube_PlaylistSnippet();
      $playlistSnippet->setTitle('groupKMITLtoสถานีรถไฟหัวตะเข้');
      $playlistSnippet->setDescription('A private playlist created with the YouTube API v3');

      // 2. Define the playlist's status.
      $playlistStatus = new Google_Service_YouTube_PlaylistStatus();
      $playlistStatus->setPrivacyStatus('public');

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

    //  $list->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);
     //   for ($list->rewind(); $list->valid(); $list->next()) {
      //echo nl2br($list->current()->mark." "."To go this point by: ".$list->current()->video." Distance".$list->current()->cost."\n");
      
      // 5. Add a video to the playlist. First, define the resource being added
      // to the playlist by setting its video ID and kind.   
        $size=array("iO7Ly9mNWyg","7AfkomfKDlc");
          for($a=0;$a<=1;$a++){
            $resourceId = new Google_Service_YouTube_ResourceId();
            $resourceId->setVideoId($size[$a]);
            //$resourceId->setVideoId($size[$a]);
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
          }      
        } 
    //}

      $_SESSION['token'] = $client->getAccessToken();
      $playlist [] = array("video" => $playlistId,);
      $out3 = array_values($playlist);
      //echo json_encode(array($out,$out2,$out3));
       echo json_encode(array($out3));
     
    }



}




