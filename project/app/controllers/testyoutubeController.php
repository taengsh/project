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



    protected function createPlaylist($list,$out,$out2){
        session_start();
        /*
         * You can acquire an OAuth 2.0 client ID and client secret from the
         * Google Developers Console <https://console.developers.google.com/>
         * For more information about using OAuth 2.0 to access Google APIs, please see:
         * <https://developers.google.com/youtube/v3/guides/authentication>
         * Please ensure that you have enabled the YouTube Data API for your project.
         */
        $OAUTH2_CLIENT_ID = '239015545428-6fvo3qk8favv2a5bls05fi6edv1f1ffh.apps.googleusercontent.com';
        $OAUTH2_CLIENT_SECRET = '5r3NdDBBhfn-dH5r6MlbMdZr';
        $htmlBody = "";
        $client = new Google_Client();
        $client->setClientId($OAUTH2_CLIENT_ID);
        $client->setApprovalPrompt('auto');
        $client->revokeToken();
        $client->setAccessType('offline');
        $client->setClientSecret($OAUTH2_CLIENT_SECRET);
        $client->setScopes('https://www.googleapis.com/auth/youtube');
        $redirect = "http://smith96.ce.kmitl.ac.th:8003/test";
        $client->setRedirectUri($redirect); 
        $client->refreshToken('1/q8l6DcenAkeadNeRT9wAmWwON2z5AznV8DVRCAlEkmAMEudVrK5jSpoR30zcRFq6');
        $_SESSION['access_token']=$client->getAccessToken();
        $client->setAccessToken($_SESSION['access_token']);
        
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
                $client->refreshToken('1/q8l6DcenAkeadNeRT9wAmWwON2z5AznV8DVRCAlEkmAMEudVrK5jSpoR30zcRFq6');
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
            $list->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);
                for ($list->rewind(); $list->valid(); $list->next()) {
                 //echo nl2br($list->current()->mark." "."To go this point by: ".$list->current()->video." Distance".$list->current()->cost."\n");
            // 5. Add a video to the playlist. First, define the resource being added
            // to the playlist by setting its video ID and kind.                 
                        $resourceId = new Google_Service_YouTube_ResourceId();
                        $resourceId->setVideoId($list->current()->video);
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
          $_SESSION['token'] = $client->getAccessToken();
          $playlist [] = array("video" => $playlistId,);
          $out3 = array_values($playlist);
          echo json_encode(array($out,$out2,$out3));
         
        }


}
   