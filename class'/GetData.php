<?php
class GetData {

    protected $playerDetails = ['name' => [], 'role' => [], 'donations' => [], 'donationsReceived' => [], 'lastSeen' => [], 'warCollectionBattles' => [], 'totalCollectionBattles' => [], 'warCardsEarned' => [], 'totalCardsEarned' => [], 'allocatedFinalBattles' => [], 'numberOfFinalBattlesPlayed' => [], 'totalFinalBattlesMissed' => [], 'warFinalBattleWin' => [], 'finalBattleWinLoss' => []];
    
    protected $warLog = ['warLog' => [
        0 => [
            'name' => [],
            'cardsEarned' => [],
            'finalBattlesPlayed' => [],
            'finalBattleWins' => [],
            'collectionBattlesPlayed' => []
        ],
        1 => [
            'name' => [],
            'cardsEarned' => [],
            'finalBattlesPlayed' => [],
            'finalBattleWins' => [],
            'collectionBattlesPlayed' => []
        ],
        2 => [
            'name' => [],
            'cardsEarned' => [],
            'finalBattlesPlayed' => [],
            'finalBattleWins' => [],
            'collectionBattlesPlayed' => []
        ],
        3 => [
            'name' => [],
            'cardsEarned' => [],
            'finalBattlesPlayed' => [],
            'finalBattleWins' => [],
            'collectionBattlesPlayed' => []
        ],
        4 => [
            'name' => [],
            'cardsEarned' => [],
            'finalBattlesPlayed' => [],
            'finalBattleWins' => [],
            'collectionBattlesPlayed' => []
        ],
        5 => [
            'name' => [],
            'cardsEarned' => [],
            'finalBattlesPlayed' => [],
            'finalBattleWins' => [],
            'collectionBattlesPlayed' => []
        ],
        6 => [
            'name' => [],
            'cardsEarned' => [],
            'finalBattlesPlayed' => [],
            'finalBattleWins' => [],
            'collectionBattlesPlayed' => []
        ],
        7 => [
            'name' => [],
            'cardsEarned' => [],
            'finalBattlesPlayed' => [],
            'finalBattleWins' => [],
            'collectionBattlesPlayed' => []
        ],
        8 => [
            'name' => [],
            'cardsEarned' => [],
            'finalBattlesPlayed' => [],
            'finalBattleWins' => [],
            'collectionBattlesPlayed' => []
        ],
        9 => [
            'name' => [],
            'cardsEarned' => [],
            'finalBattlesPlayed' => [],
            'finalBattleWins' => [],
            'collectionBattlesPlayed' => []
        ]
    ], 'createdOn' => [], 'participants' => [], 'battlesPlayed' => [], 'wins' => [], 'crowns' => [], 'trophyChange' => []];
    
    protected $playerDetailsLength;
    protected $warLog0Length;
    protected $warLog1Length;
    protected $warLog2Length;
    protected $warLog3Length;
    protected $warLog4Length;
    protected $warLog5Length;
    protected $warLog6Length;
    protected $warLog7Length;
    protected $warLog8Length;
    protected $warLog9Length;
    protected $warState;
    protected $warTotalCollectionBattles;
    protected $warTotalCollectionWins;
    protected $collectionEndTime;
    protected $warParticipants;
    protected $warTotalFinalWins;
    protected $warTotalFinalCrowns;
    protected $warTotalFinalBattles;
    protected $warEndTime;
    protected $clanTrophies;
    protected $clanWarTrophies;
    protected $requiredTrophies;
    protected $donationsPerWeek;
    //test
    private $jwt = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6IjU5ZDQxOTEwLWQzMmYtNDUwYS1hYzgwLWE2NjJmYzVkMzRjZSIsImlhdCI6MTU1NzI1Mjc1Miwic3ViIjoiZGV2ZWxvcGVyLzg3ZTM0ODA3LTgxYTAtNDk4MS1kZjNlLWViZWQ5ZTU1MDM4MSIsInNjb3BlcyI6WyJyb3lhbGUiXSwibGltaXRzIjpbeyJ0aWVyIjoiZGV2ZWxvcGVyL3NpbHZlciIsInR5cGUiOiJ0aHJvdHRsaW5nIn0seyJjaWRycyI6WyIxOTguOTEuODEuNCJdLCJ0eXBlIjoiY2xpZW50In1dfQ.GQ0lmY6OWRnXqgq5Z-D0kkM05FGTyAqB3lIMc6QzU7jrzf6fI40VJX-R-mh_sEqy2GL5HnuFGM1n0e7C1qCdwA";
    //production
    // private $jwt = 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6IjdkMjcxZGNlLWQxN2YtNGM4Yi05ZmFiLTdkOGQ1MDlhMDkxYSIsImlhdCI6MTU2MzQ1Nzg1NSwic3ViIjoiZGV2ZWxvcGVyLzg3ZTM0ODA3LTgxYTAtNDk4MS1kZjNlLWViZWQ5ZTU1MDM4MSIsInNjb3BlcyI6WyJyb3lhbGUiXSwibGltaXRzIjpbeyJ0aWVyIjoiZGV2ZWxvcGVyL3NpbHZlciIsInR5cGUiOiJ0aHJvdHRsaW5nIn0seyJjaWRycyI6WyIyMDQuOTMuMTc0LjEzNiJdLCJ0eXBlIjoiY2xpZW50In1dfQ.HY0FYAwqSkIYJ2wY_I79uEuz1dTHXqd-DtujtuRXvQal_sswjYOBNBHFlTuUV-ImRYvkMhyH61kPdVQYqqsgsQ';
    

     public function getPlayerAndClanData() {
        //initialise and set curl opttions for request
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => 'https://api.clashroyale.com/v1/clans/%23PQGLG8VC',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                $this->jwt
            )
        );
        //curl execution and error checking
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        // if curl executes check the http status code
        if (!curl_errno($ch)) {
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                //successful response
                case 200:
                    $clanArr = json_decode($response, true);
                    //setting clan details
                    $this->clanTrophies = $clanArr['clanScore'];
                    $this->clanWarTrophies = $clanArr['clanWarTrophies'];
                    $this->requiredTrophies = $clanArr['requiredTrophies'];
                    $this->donationsPerWeek = $clanArr['donationsPerWeek'];
                    //iterates through the returned json object to get player details
                    foreach($clanArr['memberList'] as $player => $details) {
                        //setting player details
                        $this->playerDetails['name'][] = $details['name'];
                        $this->playerDetails['role'][] = $details['role'];
                        $this->playerDetails['donations'][] = $details['donations'];
                        $this->playerDetails['donationsReceived'][] = $details['donationsReceived'];
                        /*converting time from ISO-8601 to local time in a readable format
                         * by removing the microseconds and creating a date time object
                         */
                        $lastSeenISO = explode(".", $details['lastSeen']);
                        $lastSeen = new DateTime($lastSeenISO[0]);
                        $this->playerDetails['lastSeen'][] = $lastSeen->format('F j, Y, g:i a');
                    }
                    break;
                case 400:
                    return "The request failed due to incorrect parameters being supplied.";
                    break;
                case 403:
                    return "Access to this resource is denied.";
                    break;
                case 404:
                    return "The requested resource was not found.";
                    break;
                case 429:
                    return "The request was throttled because the number of requests made is to high.";
                    break;
                case 500:
                    return "An unknown error occurred with the request.";
                    break;
                case 503;
                return "Service is temporarily unavailable because of maintenance.";
                break;
                default:
                    return 'Unexpected HTTP code: '.$http_code;
            }
        } else {
            return "Curl error".curl_errno($ch);
        }
        //close curl connection
        curl_close($ch);
    }
    
    
    public function getWarData() {
        //initialise and set curl options for request to get details for current war
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => 'https://api.clashroyale.com/v1/clans/%23PQGLG8VC/currentwar',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                $this->jwt
            )
        );
        //curl execution and error checking
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        // if curl executes check the http status code
        if (!curl_errno($ch)) {
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                //successful response
                case 200:
                    $warArr = json_decode($response, true);
                    //setting war variables
                    $this->warState = $warArr['state'];
                    switch ($warArr['state']) {
                        //do nothing if we aren't in a war
                        case 'notInWar':
                            break;
                        case 'collectionDay':
                            //setting collection day variables
                            //these arent being displayed on war day, I need to get collection end time and then save these values to the db as the war state is changing 
                            $this->warTotalCollectionBattles = $warArr['clan']['battlesPlayed'];
                            $this->warTotalCollectionWins = $warArr['clan']['wins'];
                            //converting IS0-8601 to utc 
                            $collectionEndTimeISO = explode(".", $warArr['collectionEndTime']);
                            $collectionEndTime = new DateTime($collectionEndTimeISO[0]);
                            $this->collectionEndTime = $collectionEndTime->format('m-d H:i:s');
                            break;
                        case 'warDay':
                            //setting final battle day variables
                            $this->warParticipants = $warArr['clan']['participants'];
                            $this->warTotalFinalBattles = $warArr['clan']['battlesPlayed'];
                            $this->warTotalFinalWins = $warArr['clan']['wins'];
                            $this->warTotalFinalCrowns = $warArr['clan']['crowns'];
                            //converting IS0-8601 to utc 
                            $warEndTimeISO = explode(".", $warArr['warEndTime']);
                            $warEndTime = new DateTime($warEndTimeISO[0]);
                            $this->warEndTime = $warEndTime->format('F j, Y, g:i a');
                            //first loop gets the index of playerDetails
                            for ($i = 0; $i < $this->playerDetailsLength; $i++) {
                                //second loop gets the index of warArr
                                for ($x = 0; $x < count($warArr['participants']); $x++) {
                                    //if name at $i index = name at $x index set the values in playerDetails at $i index
                                    if ($this->playerDetails['name'][$i] == $warArr['participants'][$x]['name']) {
                                        $this->playerDetails['warCollectionBattles'][$i] = $warArr['participants'][$x]['collectionDayBattlesPlayed'];
                                        $this->playerDetails['warCardsEarned'][$i] = $warArr['participants'][$x]['cardsEarned'];
                                        $this->playerDetails['allocatedFinalBattles'][$i] = $warArr['participants'][$x]['numberOfBattles'];
                                        $this->playerDetails['numberOfFinalBattlesPlayed'][$i] = $warArr['participants'][$x]['battlesPlayed'];
                                        $this->playerDetails['warFinalBattleWin'][$i] = $warArr['participants'][$x]['wins'];
                                    }
                                }
                            }
                            break;
                    }
                    break;
                case 400:
                    return "The request failed due to incorrect parameters being supplied.";
                    break;
                case 403:
                    return "Access to this resource is denied.";
                    break;
                case 404:
                    return "The requested resource was not found.";
                    break;
                case 429:
                    return "The request was throttled because the number of requests made is to high.";
                    break;
                case 500:
                    return "An unknown error occurred with the request.";
                    break;
                case 503;
                return "Service is temporarily unavailable because of maintenance.";
                break;
                default:
                    return 'Unexpected HTTP code: '.$http_code;
            }
        } else {
            return "Curl error".curl_errno($ch);
        }
        //close curl and save the response to a variable
        curl_close($ch);
    }
    

    public function getWarlog() {
        //initialise and set curl opttions for request
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => 'https://api.clashroyale.com/v1/clans/%23PQGLG8VC/warlog',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                $this->jwt
            )
        );
        //curl execution and error checking
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        // if curl executes check the http status code
        if (!curl_errno($ch)) {
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                //successful response
                case 200:
                    $warLog = json_decode($response, true);
                    /*loop through the array and assign values to the warLog array based on the index of both loops 
                     * $x index represents the index for each of the 10 wars
                     * $i index represents each participant in a war
                     * $y index represents each of the 4 clans participating in war
                     */
                    for ($x = 0; $x < 10; $x++) {
                        $createdOnISO = explode(".", $warLog['items'][$x]['createdDate']);
                        $createdOn = new DateTime($createdOnISO[0]);
                        $this->warLog['createdOn'][$x] = $createdOn->format('F j, Y, g:i a');
                        for ($i = 0; $i < count($warLog['items'][$x]['participants']); $i++) {
                            $this->warLog['warLog'][$x]['name'][$i] = $warLog['items'][$x]['participants'][$i]['name'];
                            $this->warLog['warLog'][$x]['cardsEarned'][$i] = $warLog['items'][$x]['participants'][$i]['cardsEarned'];
                            $this->warLog['warLog'][$x]['finalBattlesPlayed'][$i] = $warLog['items'][$x]['participants'][$i]['battlesPlayed'];
                            $this->warLog['warLog'][$x]['finalBattleWins'][$i] = $warLog['items'][$x]['participants'][$i]['wins'];
                            $this->warLog['warLog'][$x]['collectionBattlesPlayed'][$i] = $warLog['items'][$x]['participants'][$i]['collectionDayBattlesPlayed'];
                        }
                        //there are 4 clans in a war 
                        for ($y = 0; $y < 5; $y++) {
                            //assign clan variables if clan tag matches our clan tag
                            if ($warLog['items'][$x]['standings'][$y]['clan']['tag'] == '#PQGLG8VC') {
                                $this->warLog['participants'][$x] = $warLog['items'][$x]['standings'][$y]['clan']['participants'];
                                $this->warLog['battlesPlayed'][$x] = $warLog['items'][$x]['standings'][$y]['clan']['battlesPlayed'];
                                $this->warLog['wins'][$x] = $warLog['items'][$x]['standings'][$y]['clan']['wins'];
                                $this->warLog['crowns'][$x] = $warLog['items'][$x]['standings'][$y]['clan']['crowns'];
                                $this->warLog['trophyChange'][$x] = $warLog['items'][$x]['standings'][$y]['trophyChange'];
                            }
                        }
                    }
                    break;
                case 400:
                    return "The request failed due to incorrect parameters being supplied.";
                    break;
                case 403:
                    return "Access to this resource is denied.";
                    break;
                case 404:
                    return "The requested resource was not found.";
                    break;
                case 429:
                    return "The request was throttled because the number of requests made is to high.";
                    break;
                case 500:
                    return "An unknown error occurred with the request.";
                    break;
                case 503;
                return "Service is temporarily unavailable because of maintenance.";
                break;
                default:
                    return 'Unexpected HTTP code: '.$http_code;
            }
        } else {
            return "Curl error".curl_errno($ch);
        }
        //close curl connection
        curl_close($ch);
    }


    public function lengthOfArrays() {
        /*I am assigning the count of theses arrays to variables so I won't have to
         * call the count function every time I use this value in a loop later
         */
        $this->playerDetailsLength = count($this->playerDetails['name']);
        $this->warLog0Length = count($this->warLog['warLog'][0]['name']);
        $this->warLog1Length = count($this->warLog['warLog'][1]['name']);
        $this->warLog2Length = count($this->warLog['warLog'][2]['name']);
        $this->warLog3Length = count($this->warLog['warLog'][3]['name']);
        $this->warLog4Length = count($this->warLog['warLog'][4]['name']);
        $this->warLog5Length = count($this->warLog['warLog'][5]['name']);
        $this->warLog6Length = count($this->warLog['warLog'][6]['name']);
        $this->warLog7Length = count($this->warLog['warLog'][7]['name']);
        $this->warLog8Length = count($this->warLog['warLog'][8]['name']);
        $this->warLog9Length = count($this->warLog['warLog'][9]['name']);
    }
}
