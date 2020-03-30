<?php
class Calculations extends GetData
{
    public function getClanTrophies()
    {
        return $this->clanTrophies;
    }

    public function getRequiredTrophies()
    {
        return $this->requiredTrophies;
    }

    public function getWarTrophies()
    {
        return $this->clanWarTrophies;
    }

    public function getDonationsPerWeek()
    {
        return $this->donationsPerWeek;
    }

    public function promotionEligibility()
    {
        //loop through player array and check for members with >= 300 donations and rank of member
        for ($i = 0; $i < $this->playerDetailsLength; $i++) {
            if (
                $this->playerDetails['donations'][$i] >= 300 &&
                $this->playerDetails['role'][$i] == "member"
            ) {
                echo $this->playerDetails['name'][$i] . "<br>";
            }
        }
    }

    public function elderDonations()
    {
        //loop through player array and check for elders with < 100 donations
        for ($i = 0; $i < $this->playerDetailsLength; $i++) {
            if (
                $this->playerDetails['donations'][$i] < 100 &&
                $this->playerDetails['role'][$i] == "elder"
            ) {
                echo $this->playerDetails['name'][$i] . "<br>";
            }
        }
    }

    public function giveRequestRatio()
    {
        for ($i = 0; $i < $this->playerDetailsLength; $i++) {
            //if a player hasn't received any donations set ratio to their number of donations
            if ($this->playerDetails['donationsReceived'][$i] == 0) {
                $this->playerDetails['donateRequestRatio'][$i] =
                    $this->playerDetails['donations'][$i];
                //if a player hasn't made any donations set the ratio to the negative of their donations received
            } elseif ($this->playerDetails['donations'][$i] == 0) {
                $this->playerDetails['donateRequestRatio'][$i] = -$this
                    ->playerDetails['donationsReceived'][$i];
                //set ratio to zero if both variables are equal 0
            } elseif (
                $this->playerDetails['donationsReceived'][$i] == 0 &&
                $this->playerDetails['donations'][$i] == 0
            ) {
                $this->playerDetails['donateRequestRatio'][$i] = 0;
                //otherwise the ratio is calculated by dividing a players donations with their donations received
            } else {
                $this->playerDetails['donateRequestRatio'][$i] = round(
                    $this->playerDetails['donations'][$i] /
                        $this->playerDetails['donationsReceived'][$i],
                    1
                );
            }
        }
    }

    public function recruitment()
    {
        $placesAvailable = 50 - $this->playerDetailsLength;
        if ($placesAvailable == 1) {
            return " We have " . $placesAvailable . " place available";
        } elseif ($placesAvailable > 1) {
            return "We have " . $placesAvailable . " places available";
        }
    }

    public function currentWarStatus()
    {
        switch ($this->warState) {
            case 'notInWar':
                return "We are currently not at war";
                break;
            case 'collectionDay':
                echo "War State:$this->warState &ensp; Members Participating:$this->warParticipants &ensp; Collection Battles Played:$this->warTotalCollectionBattles &ensp; Victories:$this->warTotalCollectionWins &ensp; Collection Day Ends:$this->collectionEndTime";
                echo "
            <table>
                <tr>
                    <th>Name</th>
                    <th>Collection Battles Played</th>
                    <th>Cards Earned</th>
                </tr>";
                for ($i = 0; $i < $this->warParticipants; $i++) {
                    //check if a member is participating in the current war

                    //if $i is odd the row will have a white background

                    if ($i % 2 == 1) {
                        echo "<tr>
                                <td>" .
                            $this->currentWarDetails['name'][$i] .
                            "</td>
                                  <td>" .
                            $this->currentWarDetails['warCollectionBattles'][
                                $i
                            ] .
                            "</td>
                                  <td>" .
                            $this->currentWarDetails['warCardsEarned'][$i] .
                            "</td></tr>";
                        //if $i is even the row will have a dark background
                    }
                    if ($i % 2 == 0) {
                        echo "<tr class='dark'>
                                 <td>" .
                            $this->currentWarDetails['name'][$i] .
                            "</td>
                                  <td>" .
                            $this->currentWarDetails['warCollectionBattles'][
                                $i
                            ] .
                            "</td>
                                  <td>" .
                            $this->currentWarDetails['warCardsEarned'][$i] .
                            "</td></tr>";
                    }
                }
                echo "</table>";
                break;
            case 'warDay':
                echo "War State:$this->warState &ensp; Members Participating:$this->warParticipants &ensp;  Final Battles Completed:$this->warTotalFinalBattles &ensp; Victories:$this->warTotalFinalWins &ensp; Crowns:$this->warTotalFinalCrowns &ensp; War End Time:$this->warEndTime";
                echo "
                
            <table>
                <tr>
                    <th>Name</th>
                    <th>Collection Battles Played</th>
                    <th>Cards Earned</th>
                    <th>Allocated Final Battles</th>
                    <th>Final Battles Played</th>
                    <th>Final Battle Result</th>
                </tr>";

                for ($i = 0; $i < $this->warParticipants; $i++) {
                    //if $i is odd the row will have a white background

                    if ($i % 2 == 1) {
                        echo "<tr>
                                  <td>" .
                            $this->currentWarDetails['name'][$i] .
                            "</td>
                                  <td>" .
                            $this->currentWarDetails['warCollectionBattles'][
                                $i
                            ] .
                            "</td>
                                  <td>" .
                            $this->currentWarDetails['warCardsEarned'][$i] .
                            "</td>
                                  <td>" .
                            $this->currentWarDetails['allocatedFinalBattles'][
                                $i
                            ] .
                            "</td>
                                  <td>" .
                            $this->currentWarDetails[
                                'numberOfFinalBattlesPlayed'
                            ][$i] .
                            "</td>
                                  <td>" .
                            $this->currentWarDetails['warFinalBattleResult'][
                                $i
                            ] .
                            "</td></tr>";
                    } else {
                        echo "<tr class='dark'>
                                  <td>" .
                            $this->currentWarDetails['name'][$i] .
                            "</td>
                                  <td>" .
                            $this->currentWarDetails['warCollectionBattles'][
                                $i
                            ] .
                            "</td>
                                  <td>" .
                            $this->currentWarDetails['warCardsEarned'][$i] .
                            "</td>
                                  <td>" .
                            $this->currentWarDetails['allocatedFinalBattles'][
                                $i
                            ] .
                            "</td>
                                  <td>" .
                            $this->currentWarDetails[
                                'numberOfFinalBattlesPlayed'
                            ][$i] .
                            "</td>
                                  <td>" .
                            $this->currentWarDetails['warFinalBattleResult'][
                                $i
                            ] .
                            "</td></tr>";
                    }
                }

                echo "</table>";
        }
    }

    public function displayPlayerDetails()
    {
        echo "
            <table>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Donations</th>
                    <th>Give/Request Ratio</th>
                    <th>Last Seen</th>
                    <th>Total Collection Battles Played</th>
                    <th>Final Battle Win/Loss Ratio</th>
                    <th>Final Battles Missed</th>
                    <th>War Participation</th>
                    <th>Cards Earned</th>   
                </tr>";
        for ($i = 0; $i < $this->playerDetailsLength; $i++) {
            //if $i is odd the row will have a white background
            // (array_key_exists($i, $this->playerDetails['warCollectionBattles'])) {
            if ($i % 2 == 1) {
                echo "<tr>
                                <td>" .
                    $this->playerDetails['name'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['role'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['donations'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['donateRequestRatio'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['lastSeen'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['totalCollectionBattles'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['finalBattleWinLoss'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['totalFinalBattlesMissed'][$i] .
                    "</td>	
				          <td>" .
                    $this->playerDetails['warParticipation'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['totalCardsEarned'][$i] .
                    "</td></tr>";

                //if $i is even the row will have a dark background
            } else {
                echo "<tr class='dark'>
                                 <td>" .
                    $this->playerDetails['name'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['role'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['donations'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['donateRequestRatio'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['lastSeen'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['totalCollectionBattles'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['finalBattleWinLoss'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['totalFinalBattlesMissed'][$i] .
                    "</td>	
				          <td>" .
                    $this->playerDetails['warParticipation'][$i] .
                    "</td>
                                  <td>" .
                    $this->playerDetails['totalCardsEarned'][$i] .
                    "</td></tr>";
            }
        }
        echo "</table>";
    }

    public function warParticipation()
    {
        for ($i = 0; $i < $this->playerDetailsLength; $i++) {
            for ($q = 0; $q < $this->warLog0Length; $q++) {
                //check if a player has participated in a war and add 1 to their participation
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][0]['name'][$q]
                ) {
                    $this->playerDetails['warParticipation'][$i] = 1;
                }
            }

            for ($r = 0; $r < $this->warLog1Length; $r++) {
                //check if a player has participated in a war and this war and add 1 to their participation
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][1]['name'][$r]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['warParticipation']
                        )
                    ) {
                        $this->playerDetails['warParticipation'][$i] += 1;
                    } else {
                        //otherwise set their participation to 1
                        $this->playerDetails['warParticipation'][$i] = 1;
                    }
                }
            }

            for ($s = 0; $s < $this->warLog2Length; $s++) {
                //check if a player has participated in a war and this war and add 1 to their participation
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][2]['name'][$s]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['warParticipation']
                        )
                    ) {
                        $this->playerDetails['warParticipation'][$i] += 1;
                    } else {
                        //otherwise set their participation to 1
                        $this->playerDetails['warParticipation'][$i] = 1;
                    }
                }
            }

            for ($t = 0; $t < $this->warLog3Length; $t++) {
                //check if a player has participated in a war and this war and add 1 to their participation
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][3]['name'][$t]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['warParticipation']
                        )
                    ) {
                        $this->playerDetails['warParticipation'][$i] += 1;
                    } else {
                        //otherwise set their participation to 1
                        $this->playerDetails['warParticipation'][$i] = 1;
                    }
                }
            }

            for ($u = 0; $u < $this->warLog4Length; $u++) {
                //check if a player has participated in a war and this war and add 1 to their participation
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][4]['name'][$u]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['warParticipation']
                        )
                    ) {
                        $this->playerDetails['warParticipation'][$i] += 1;
                    } else {
                        //otherwise set their participation to 1
                        $this->playerDetails['warParticipation'][$i] = 1;
                    }
                }
            }

            for ($v = 0; $v < $this->warLog5Length; $v++) {
                //check if a player has participated in a war and this war and add 1 to their participation
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][5]['name'][$v]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['warParticipation']
                        )
                    ) {
                        $this->playerDetails['warParticipation'][$i] += 1;
                    } else {
                        //otherwise set their participation to 1
                        $this->playerDetails['warParticipation'][$i] = 1;
                    }
                }
            }

            for ($w = 0; $w < $this->warLog6Length; $w++) {
                //check if a player has participated in a war and this war and add 1 to their participation
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][6]['name'][$w]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['warParticipation']
                        )
                    ) {
                        $this->playerDetails['warParticipation'][$i] += 1;
                    } else {
                        //otherwise set their participation to 1
                        $this->playerDetails['warParticipation'][$i] = 1;
                    }
                }
            }

            for ($x = 0; $x < $this->warLog7Length; $x++) {
                //check if a player has participated in a war and this war and add 1 to their participation
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][7]['name'][$x]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['warParticipation']
                        )
                    ) {
                        $this->playerDetails['warParticipation'][$i] += 1;
                    } else {
                        //otherwise set their participation to 1
                        $this->playerDetails['warParticipation'][$i] = 1;
                    }
                }
            }

            for ($y = 0; $y < $this->warLog8Length; $y++) {
                //check if a player has participated in a war and this war and add 1 to their participation
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][8]['name'][$y]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['warParticipation']
                        )
                    ) {
                        $this->playerDetails['warParticipation'][$i] += 1;
                    } else {
                        //otherwise set their participation to 1
                        $this->playerDetails['warParticipation'][$i] = 1;
                    }
                }
            }

            for ($z = 0; $z < $this->warLog9Length; $z++) {
                //check if a player has participated in a war and this war and add 1 to their participation
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][9]['name'][$z]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['warParticipation']
                        )
                    ) {
                        $this->playerDetails['warParticipation'][$i] += 1;
                    } else {
                        //otherwise set their participation to 1
                        $this->playerDetails['warParticipation'][$i] = 1;
                    }
                }
            }

            //convert a players participation from a digit to a percentage
            if (
                array_key_exists($i, $this->playerDetails['warParticipation'])
            ) {
                $this->playerDetails['warParticipation'][$i] =
                    $this->playerDetails['warParticipation'][$i] * 10 . "%";
            } else {
                //finally set participation to 0 if it hasn't been set before this point
                $this->playerDetails['warParticipation'][$i] = "0%";
            }
        }
    }

    public function readableWarResults()
    {
        for ($x = 0; $x < $this->warLog0Length; $x++) {
            switch ($this->warLog['warLog'][0]['finalBattleWins'][$x]) {
                case 0:
                    if (
                        $this->warLog['warLog'][0]['allocatedFinalBattles'][
                            $x
                        ] == 1
                    ) {
                        $this->warLog['warLog'][0]['finalBattleWins'][$x] =
                            "Loss";
                    } else {
                        $this->warLog['warLog'][0]['finalBattleWins'][$x] =
                            "Loss,Loss";
                    }
                    break;
                case 1:
                    if (
                        $this->warLog['warLog'][0]['allocatedFinalBattles'][
                            $x
                        ] == 1
                    ) {
                        $this->warLog['warLog'][0]['finalBattleWins'][$x] =
                            "Win";
                    } else {
                        $this->warLog['warLog'][0]['finalBattleWins'][$x] =
                            "Win,Loss";
                    }
                    break;
                case 2:
                    $this->warLog['warLog'][0]['finalBattleWins'][$x] =
                        "Win,Win";
                    break;
            }
            //if a player has played and won 2 war battles change warFinalBattleWins from 2 -> "Win, Win" for readability for end users
            /*gonna try use a switch for this instead at this part
             *
             *
             */
            if ($this->warLog['warLog'][0]['finalBattleWins'][$x] == 2) {
            }
            //if a player has been allocated 1 battle and won 1 battle change finalBattleWins from 1 -> "Win"
            if (
                $this->warLog['warLog'][0]['finalBattleWins'][$x] == 1 &&
                $this->warLog['warLog'][0]['allocatedFinalBattles'][$x] == 1
            ) {
            }
            //if a player has been allocated 1 battle and lost 1 battle change finalBattleWins from 0 -> "Loss"
            if (
                $this->warLog['warLog'][0]['finalBattleWins'][$x] == 0 &&
                $this->warLog['warLog'][0]['allocatedFinalBattles'][$x] == 1
            ) {
            }
            //if a player has been allocated 2 battles and only won 1 battle change finalBattleWins from 1-> "Win,Loss"
            if (
                $this->warLog['warLog'][0]['finalBattleWins'][$x] == 1 &&
                $this->warLog['warLog'][0]['finalBattlesPlayed'][$x] == 2
            ) {
            }
            //if a player has been allocated 2 battles and lost both change finalBattleWins from 0 -> "Loss,Loss"
            if (
                $this->warLog['warLog'][0]['finalBattleWins'][$x] == 0 &&
                $this->warLog['warLog'][0]['allocatedFinalBattles'][$x] == 2
            ) {
            }
        }
    }
    public function warLogSummary()
    {
        //assigning overall clan war results to an array for each war
        $warLogSummary[0] =
            "Created on:" .
            $this->warLog['createdOn'][0] .
            "&ensp; Total Participants:" .
            $this->warLog['participants'][0] .
            "&ensp; Total Battles Played:" .
            $this->warLog['battlesPlayed'][0] .
            " &ensp; Total Wins:" .
            $this->warLog['wins'][0] .
            "&ensp; Total Crowns Won:" .
            $this->warLog['crowns'][0] .
            "&ensp; Trophy Change:" .
            $this->warLog['trophyChange'][0];

        $warLogSummary[1] =
            "Created on:" .
            $this->warLog['createdOn'][1] .
            "&ensp; Total Participants:" .
            $this->warLog['participants'][1] .
            "&ensp; Total Battles Played:" .
            $this->warLog['battlesPlayed'][1] .
            " &ensp; Total Wins:" .
            $this->warLog['wins'][1] .
            "&ensp; Total Crowns Won:" .
            $this->warLog['crowns'][1] .
            "&ensp; Trophy Change:" .
            $this->warLog['trophyChange'][1];

        $warLogSummary[2] =
            "Created on:" .
            $this->warLog['createdOn'][2] .
            "&ensp; Total Participants:" .
            $this->warLog['participants'][2] .
            "&ensp; Total Battles Played:" .
            $this->warLog['battlesPlayed'][2] .
            " &ensp; Total Wins:" .
            $this->warLog['wins'][2] .
            "&ensp; Total Crowns Won:" .
            $this->warLog['crowns'][2] .
            "&ensp; Trophy Change:" .
            $this->warLog['trophyChange'][2];

        $warLogSummary[3] =
            "Created on:" .
            $this->warLog['createdOn'][3] .
            "&ensp; Total Participants:" .
            $this->warLog['participants'][3] .
            "&ensp; Total Battles Played:" .
            $this->warLog['battlesPlayed'][3] .
            " &ensp; Total Wins:" .
            $this->warLog['wins'][3] .
            "&ensp; Total Crowns Won:" .
            $this->warLog['crowns'][3] .
            "&ensp; Trophy Change:" .
            $this->warLog['trophyChange'][3];

        $warLogSummary[4] =
            "Created on:" .
            $this->warLog['createdOn'][4] .
            "&ensp; Total Participants:" .
            $this->warLog['participants'][4] .
            "&ensp; Total Battles Played:" .
            $this->warLog['battlesPlayed'][4] .
            " &ensp; Total Wins:" .
            $this->warLog['wins'][4] .
            "&ensp; Total Crowns Won:" .
            $this->warLog['crowns'][4] .
            "&ensp; Trophy Change:" .
            $this->warLog['trophyChange'][4];

        $warLogSummary[5] =
            "Created on:" .
            $this->warLog['createdOn'][5] .
            "&ensp; Total Participants:" .
            $this->warLog['participants'][5] .
            "&ensp; Total Battles Played:" .
            $this->warLog['battlesPlayed'][5] .
            " &ensp; Total Wins:" .
            $this->warLog['wins'][5] .
            "&ensp; Total Crowns Won:" .
            $this->warLog['crowns'][5] .
            "&ensp; Trophy Change:" .
            $this->warLog['trophyChange'][5];

        $warLogSummary[6] =
            "Created on:" .
            $this->warLog['createdOn'][6] .
            "&ensp; Total Participants:" .
            $this->warLog['participants'][6] .
            "&ensp; Total Battles Played:" .
            $this->warLog['battlesPlayed'][6] .
            " &ensp; Total Wins:" .
            $this->warLog['wins'][6] .
            "&ensp; Total Crowns Won:" .
            $this->warLog['crowns'][6] .
            "&ensp; Trophy Change:" .
            $this->warLog['trophyChange'][6];

        $warLogSummary[7] =
            "Created on:" .
            $this->warLog['createdOn'][7] .
            "&ensp; Total Participants:" .
            $this->warLog['participants'][7] .
            "&ensp; Total Battles Played:" .
            $this->warLog['battlesPlayed'][7] .
            " &ensp; Total Wins:" .
            $this->warLog['wins'][7] .
            "&ensp; Total Crowns Won:" .
            $this->warLog['crowns'][7] .
            "&ensp; Trophy Change:" .
            $this->warLog['trophyChange'][7];

        $warLogSummary[8] =
            "Created on:" .
            $this->warLog['createdOn'][8] .
            "&ensp; Total Participants:" .
            $this->warLog['participants'][8] .
            "&ensp; Total Battles Played:" .
            $this->warLog['battlesPlayed'][8] .
            " &ensp; Total Wins:" .
            $this->warLog['wins'][8] .
            "&ensp; Total Crowns Won:" .
            $this->warLog['crowns'][8] .
            "&ensp; Trophy Change:" .
            $this->warLog['trophyChange'][8];

        $warLogSummary[9] =
            "Created on:" .
            $this->warLog['createdOn'][9] .
            "&ensp; Total Participants:" .
            $this->warLog['participants'][9] .
            "&ensp; Total Battles Played:" .
            $this->warLog['battlesPlayed'][9] .
            " &ensp; Total Wins:" .
            $this->warLog['wins'][9] .
            "&ensp; Total Crowns Won:" .
            $this->warLog['crowns'][9] .
            "&ensp; Trophy Change:" .
            $this->warLog['trophyChange'][9];

        return $warLogSummary;
    }

    public function warLog0()
    {
        //getting individual player results
        for ($x = 0; $x < $this->warLog0Length; $x++) {
            //if $x is odd the row will have a white background
            if ($x % 2 == 1) {
                echo "<tr>
   <td>" .
                    $this->warLog['warLog'][0]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][0]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][0]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][0]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][0]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][0]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
                //if $x is even the row will have a dark background
            } else {
                echo "<tr class='dark'>
   <td>" .
                    $this->warLog['warLog'][0]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][0]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][0]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][0]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][0]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][0]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
            }
        }
    }

    public function warLog1()
    {
        //getting individual player results
        for ($x = 0; $x < $this->warLog1Length; $x++) {
            //if $x is odd the row will have a white background
            if ($x % 2 == 1) {
                echo "<tr>
   <td>" .
                    $this->warLog['warLog'][1]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][1]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][1]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][1]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][1]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][1]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
                //if $x is even the row will have a dark background
            } else {
                echo "<tr class='dark'>
   <td>" .
                    $this->warLog['warLog'][1]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][1]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][1]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][1]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][1]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][1]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
            }
        }
    }

    public function warLog2()
    {
        //getting individual player results
        for ($x = 0; $x < $this->warLog2Length; $x++) {
            //if $x is odd the row will have a white background
            if ($x % 2 == 1) {
                echo "<tr>
   <td>" .
                    $this->warLog['warLog'][2]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][2]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][2]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][2]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][2]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][2]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
                //if $x is even the row will have a dark background
            } else {
                echo "<tr class='dark'>
   <td>" .
                    $this->warLog['warLog'][2]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][2]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][2]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][2]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][2]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][2]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
            }
        }
    }

    public function warLog3()
    {
        //getting individual player results
        for ($x = 0; $x < $this->warLog3Length; $x++) {
            //if $x is odd the row will have a white background
            if ($x % 2 == 1) {
                echo "<tr>
   <td>" .
                    $this->warLog['warLog'][3]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][3]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][3]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][3]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][3]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][3]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
                //if $x is even the row will have a dark background
            } else {
                echo "<tr class='dark'>
   <td>" .
                    $this->warLog['warLog'][3]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][3]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][3]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][3]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][3]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][3]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
            }
        }
    }

    public function warLog4()
    {
        //getting individual player results
        for ($x = 0; $x < $this->warLog4Length; $x++) {
            //if $x is odd the row will have a white background
            if ($x % 2 == 1) {
                echo "<tr>
   <td>" .
                    $this->warLog['warLog'][4]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][4]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][4]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][4]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][4]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][4]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
                //if $x is even the row will have a dark background
            } else {
                echo "<tr class='dark'>
   <td>" .
                    $this->warLog['warLog'][4]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][4]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][4]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][4]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][4]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][4]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
            }
        }
    }

    public function warLog5()
    {
        //getting individual player results
        for ($x = 0; $x < $this->warLog5Length; $x++) {
            //if $x is odd the row will have a white background
            if ($x % 2 == 1) {
                echo "<tr>
   <td>" .
                    $this->warLog['warLog'][5]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][5]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][5]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][5]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][5]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][5]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
                //if $x is even the row will have a dark background
            } else {
                echo "<tr class='dark'>
   <td>" .
                    $this->warLog['warLog'][5]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][5]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][5]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][5]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][5]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][5]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
            }
        }
    }

    public function warLog6()
    {
        //getting individual player results
        for ($x = 0; $x < $this->warLog6Length; $x++) {
            //if $x is odd the row will have a white background
            if ($x % 2 == 1) {
                echo "<tr>
   <td>" .
                    $this->warLog['warLog'][6]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][6]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][6]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][6]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][6]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][6]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
                //if $x is even the row will have a dark background
            } else {
                echo "<tr class='dark'>
   <td>" .
                    $this->warLog['warLog'][6]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][6]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][6]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][6]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][6]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][6]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
            }
        }
    }

    public function warLog7()
    {
        //getting individual player results
        for ($x = 0; $x < $this->warLog0Length; $x++) {
            //if $x is odd the row will have a white background
            if ($x % 2 == 1) {
                echo "<tr>
   <td>" .
                    $this->warLog['warLog'][7]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][7]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][7]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][7]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][7]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][7]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
                //if $x is even the row will have a dark background
            } else {
                echo "<tr class='dark'>
   <td>" .
                    $this->warLog['warLog'][7]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][7]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][7]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][7]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][7]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][7]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
            }
        }
    }

    public function warLog8()
    {
        //getting individual player results
        for ($x = 0; $x < $this->warLog8Length; $x++) {
            //if $x is odd the row will have a white background
            if ($x % 2 == 1) {
                echo "<tr>
   <td>" .
                    $this->warLog['warLog'][8]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][8]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][8]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][8]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][8]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][8]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
                //if $x is even the row will have a dark background
            } else {
                echo "<tr class='dark'>
   <td>" .
                    $this->warLog['warLog'][8]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][8]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][8]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][8]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][8]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][8]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
            }
        }
    }

    public function warLog9()
    {
        //getting individual player results
        for ($x = 0; $x < $this->warLog9Length; $x++) {
            //if $x is odd the row will have a white background
            if ($x % 2 == 1) {
                echo "<tr>
   <td>" .
                    $this->warLog['warLog'][9]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][9]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][9]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][9]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][9]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][9]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
                //if $x is even the row will have a dark background
            } else {
                echo "<tr class='dark'>
   <td>" .
                    $this->warLog['warLog'][9]['name'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][9]['collectionBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][9]['cardsEarned'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][9]['allocatedFinalBattles'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][9]['finalBattlesPlayed'][$x] .
                    "</td>
   <td>" .
                    $this->warLog['warLog'][9]['finalBattleWins'][$x] .
                    "</td>
   </tr>";
            }
        }
    }

    public function totalCardsEarned()
    {
        //loop over this code for every player in the clan
        for ($i = 0; $i < $this->playerDetailsLength; $i++) {
            for ($q = 0; $q < $this->warLog0Length; $q++) {
                //check if a player has participated in a war and get their cards earned
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][0]['name'][$q]
                ) {
                    $this->playerDetails['totalCardsEarned'][$i] =
                        $this->warLog['warLog'][0]['cardsEarned'][$q];
                }
            }
            //in each subsequent loop a players cards earned are added onto their total
            for ($r = 0; $r < $this->warLog1Length; $r++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][1]['name'][$r]
                ) {
                    //check if a player has already participated in a war
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCardsEarned']
                        )
                    ) {
                        //if yes add on their cards earned to their total
                        $this->playerDetails['totalCardsEarned'][$i] +=
                            $this->warLog['warLog'][1]['cardsEarned'][$r];
                    } else {
                        //otherwise assign their total cards earned
                        $this->playerDetails['totalCardsEarned'][$i] =
                            $this->warLog['warLog'][1]['cardsEarned'][$r];
                    }
                }
            }
            for ($s = 0; $s < $this->warLog2Length; $s++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][2]['name'][$s]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCardsEarned']
                        )
                    ) {
                        $this->playerDetails['totalCardsEarned'][$i] +=
                            $this->warLog['warLog'][2]['cardsEarned'][$s];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] =
                            $this->warLog['warLog'][2]['cardsEarned'][$s];
                    }
                }
            }
            for ($t = 0; $t < $this->warLog3Length; $t++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][3]['name'][$t]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCardsEarned']
                        )
                    ) {
                        $this->playerDetails['totalCardsEarned'][$i] +=
                            $this->warLog['warLog'][3]['cardsEarned'][$t];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] =
                            $this->warLog['warLog'][3]['cardsEarned'][$t];
                    }
                }
            }
            for ($u = 0; $u < $this->warLog4Length; $u++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][4]['name'][$u]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCardsEarned']
                        )
                    ) {
                        $this->playerDetails['totalCardsEarned'][$i] +=
                            $this->warLog['warLog'][4]['cardsEarned'][$u];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] =
                            $this->warLog['warLog'][4]['cardsEarned'][$u];
                    }
                }
            }
            for ($v = 0; $v < $this->warLog5Length; $v++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][5]['name'][$v]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCardsEarned']
                        )
                    ) {
                        $this->playerDetails['totalCardsEarned'][$i] +=
                            $this->warLog['warLog'][5]['cardsEarned'][$v];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] =
                            $this->warLog['warLog'][5]['cardsEarned'][$v];
                    }
                }
            }
            for ($w = 0; $w < $this->warLog6Length; $w++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][6]['name'][$w]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCardsEarned']
                        )
                    ) {
                        $this->playerDetails['totalCardsEarned'][$i] +=
                            $this->warLog['warLog'][6]['cardsEarned'][$w];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] =
                            $this->warLog['warLog'][6]['cardsEarned'][$w];
                    }
                }
            }
            for ($x = 0; $x < $this->warLog7Length; $x++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][7]['name'][$x]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCardsEarned']
                        )
                    ) {
                        $this->playerDetails['totalCardsEarned'][$i] +=
                            $this->warLog['warLog'][7]['cardsEarned'][$x];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] =
                            $this->warLog['warLog'][7]['cardsEarned'][$x];
                    }
                }
            }
            for ($y = 0; $y < $this->warLog8Length; $y++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][8]['name'][$y]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCardsEarned']
                        )
                    ) {
                        $this->playerDetails['totalCardsEarned'][$i] +=
                            $this->warLog['warLog'][8]['cardsEarned'][$y];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] =
                            $this->warLog['warLog'][8]['cardsEarned'][$y];
                    }
                }
            }
            for ($z = 0; $z < $this->warLog9Length; $z++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][9]['name'][$z]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCardsEarned']
                        )
                    ) {
                        $this->playerDetails['totalCardsEarned'][$i] +=
                            $this->warLog['warLog'][9]['cardsEarned'][$z];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] =
                            $this->warLog['warLog'][9]['cardsEarned'][$z];
                    }
                }
            }
            //set total cards earned to 0 if a player hasn't participated in any wars
            if (
                !array_key_exists($i, $this->playerDetails['totalCardsEarned'])
            ) {
                $this->playerDetails['totalCardsEarned'][$i] = 0;
            }
        }
    }

    public function totalCollectionBattles()
    {
        //loop over this code for every player in the clan
        for ($i = 0; $i < $this->playerDetailsLength; $i++) {
            for ($q = 0; $q < $this->warLog0Length; $q++) {
                //check if a player has participated in a war and get their collection battles played if they have
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][0]['name'][$q]
                ) {
                    $this->playerDetails['totalCollectionBattles'][$i] =
                        $this->warLog['warLog'][0]['collectionBattlesPlayed'][
                            $q
                        ];
                }
            }
            //in each subsequent loop a players collection battles are added onto their total
            for ($r = 0; $r < $this->warLog1Length; $r++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][1]['name'][$r]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCollectionBattles']
                        )
                    ) {
                        $this->playerDetails['totalCollectionBattles'][$i] +=
                            $this->warLog['warLog'][1][
                                'collectionBattlesPlayed'
                            ][$r];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] =
                            $this->warLog['warLog'][1][
                                'collectionBattlesPlayed'
                            ][$r];
                    }
                }
            }
            for ($s = 0; $s < $this->warLog2Length; $s++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][2]['name'][$s]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCollectionBattles']
                        )
                    ) {
                        $this->playerDetails['totalCollectionBattles'][$i] +=
                            $this->warLog['warLog'][2][
                                'collectionBattlesPlayed'
                            ][$s];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] =
                            $this->warLog['warLog'][2][
                                'collectionBattlesPlayed'
                            ][$s];
                    }
                }
            }
            for ($t = 0; $t < $this->warLog3Length; $t++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][3]['name'][$t]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCollectionBattles']
                        )
                    ) {
                        $this->playerDetails['totalCollectionBattles'][$i] +=
                            $this->warLog['warLog'][3][
                                'collectionBattlesPlayed'
                            ][$t];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] =
                            $this->warLog['warLog'][3][
                                'collectionBattlesPlayed'
                            ][$t];
                    }
                }
            }
            for ($u = 0; $u < $this->warLog4Length; $u++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][4]['name'][$u]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCollectionBattles']
                        )
                    ) {
                        $this->playerDetails['totalCollectionBattles'][$i] +=
                            $this->warLog['warLog'][4][
                                'collectionBattlesPlayed'
                            ][$u];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] =
                            $this->warLog['warLog'][4][
                                'collectionBattlesPlayed'
                            ][$u];
                    }
                }
            }
            for ($v = 0; $v < $this->warLog5Length; $v++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][5]['name'][$v]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCollectionBattles']
                        )
                    ) {
                        $this->playerDetails['totalCollectionBattles'][$i] +=
                            $this->warLog['warLog'][5][
                                'collectionBattlesPlayed'
                            ][$v];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] =
                            $this->warLog['warLog'][5][
                                'collectionBattlesPlayed'
                            ][$v];
                    }
                }
            }
            for ($w = 0; $w < $this->warLog6Length; $w++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][6]['name'][$w]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCollectionBattles']
                        )
                    ) {
                        $this->playerDetails['totalCollectionBattles'][$i] +=
                            $this->warLog['warLog'][6][
                                'collectionBattlesPlayed'
                            ][$w];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] =
                            $this->warLog['warLog'][6][
                                'collectionBattlesPlayed'
                            ][$w];
                    }
                }
            }
            for ($x = 0; $x < $this->warLog7Length; $x++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][7]['name'][$x]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCollectionBattles']
                        )
                    ) {
                        $this->playerDetails['totalCollectionBattles'][$i] +=
                            $this->warLog['warLog'][7][
                                'collectionBattlesPlayed'
                            ][$x];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] =
                            $this->warLog['warLog'][7][
                                'collectionBattlesPlayed'
                            ][$x];
                    }
                }
            }
            for ($y = 0; $y < $this->warLog8Length; $y++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][8]['name'][$y]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCollectionBattles']
                        )
                    ) {
                        $this->playerDetails['totalCollectionBattles'][$i] +=
                            $this->warLog['warLog'][8][
                                'collectionBattlesPlayed'
                            ][$y];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] =
                            $this->warLog['warLog'][8][
                                'collectionBattlesPlayed'
                            ][$y];
                    }
                }
            }
            for ($z = 0; $z < $this->warLog9Length; $z++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][9]['name'][$z]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalCollectionBattles']
                        )
                    ) {
                        $this->playerDetails['totalCollectionBattles'][$i] +=
                            $this->warLog['warLog'][9][
                                'collectionBattlesPlayed'
                            ][$z];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] =
                            $this->warLog['warLog'][9][
                                'collectionBattlesPlayed'
                            ][$z];
                    }
                }
            }
            //set total collection battles played to 0 if a player hasn't participated in any wars
            if (
                !array_key_exists(
                    $i,
                    $this->playerDetails['totalCollectionBattles']
                )
            ) {
                $this->playerDetails['totalCollectionBattles'][$i] = 0;
            }
        }
    }

    public function totalFinalBattlesMissed()
    {
        //loop over this code for every player in the clan
        for ($i = 0; $i < $this->playerDetailsLength; $i++) {
            for ($q = 0; $q < $this->warLog0Length; $q++) {
                //check if a player has participated in a war and get their allocated final battles and number of final battles played
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][0]['name'][$q]
                ) {
                    $this->playerDetails['totalFinalBattlesPlayed'][$i] =
                        $this->warLog['warLog'][0]['finalBattlesPlayed'][$q];
                    $this->playerDetails['totalAllocatedFinalBattles'][$i] =
                        $this->warLog['warLog'][0]['allocatedFinalBattles'][$q];
                }
            }
            //in each subsequent loop a players  battles are added onto their total
            for ($r = 0; $r < $this->warLog1Length; $r++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][1]['name'][$r]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalFinalBattlesPlayed']
                        )
                    ) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] +=
                            $this->warLog['warLog'][1]['finalBattlesPlayed'][
                                $r
                            ];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] =
                            $this->warLog['warLog'][1]['finalBattlesPlayed'][
                                $r
                            ];
                    }
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalAllocatedFinalBattles']
                        )
                    ) {
                        $this->playerDetails['totalAllocatedFinalBattles'][
                            $i
                        ] +=
                            $this->warLog['warLog'][1]['allocatedFinalBattles'][
                                $r
                            ];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] =
                            $this->warLog['warLog'][1]['allocatedFinalBattles'][
                                $r
                            ];
                    }
                }
            }
            for ($s = 0; $s < $this->warLog2Length; $s++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][2]['name'][$s]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalFinalBattlesPlayed']
                        )
                    ) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] +=
                            $this->warLog['warLog'][2]['finalBattlesPlayed'][
                                $s
                            ];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] =
                            $this->warLog['warLog'][2]['finalBattlesPlayed'][
                                $s
                            ];
                    }
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalAllocatedFinalBattles']
                        )
                    ) {
                        $this->playerDetails['totalAllocatedFinalBattles'][
                            $i
                        ] +=
                            $this->warLog['warLog'][2]['allocatedFinalBattles'][
                                $s
                            ];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] =
                            $this->warLog['warLog'][2]['allocatedFinalBattles'][
                                $s
                            ];
                    }
                }
            }
            for ($t = 0; $t < $this->warLog3Length; $t++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][3]['name'][$t]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalFinalBattlesPlayed']
                        )
                    ) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] +=
                            $this->warLog['warLog'][3]['finalBattlesPlayed'][
                                $t
                            ];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] =
                            $this->warLog['warLog'][3]['finalBattlesPlayed'][
                                $t
                            ];
                    }
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalAllocatedFinalBattles']
                        )
                    ) {
                        $this->playerDetails['totalAllocatedFinalBattles'][
                            $i
                        ] +=
                            $this->warLog['warLog'][3]['allocatedFinalBattles'][
                                $t
                            ];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] =
                            $this->warLog['warLog'][3]['allocatedFinalBattles'][
                                $t
                            ];
                    }
                }
            }
            for ($u = 0; $u < $this->warLog4Length; $u++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][4]['name'][$u]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalFinalBattlesPlayed']
                        )
                    ) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] +=
                            $this->warLog['warLog'][4]['finalBattlesPlayed'][
                                $u
                            ];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] =
                            $this->warLog['warLog'][4]['finalBattlesPlayed'][
                                $u
                            ];
                    }
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalAllocatedFinalBattles']
                        )
                    ) {
                        $this->playerDetails['totalAllocatedFinalBattles'][
                            $i
                        ] +=
                            $this->warLog['warLog'][4]['allocatedFinalBattles'][
                                $u
                            ];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] =
                            $this->warLog['warLog'][4]['allocatedFinalBattles'][
                                $u
                            ];
                    }
                }
            }
            for ($v = 0; $v < $this->warLog5Length; $v++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][5]['name'][$v]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalFinalBattlesPlayed']
                        )
                    ) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] +=
                            $this->warLog['warLog'][5]['finalBattlesPlayed'][
                                $v
                            ];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] =
                            $this->warLog['warLog'][5]['finalBattlesPlayed'][
                                $v
                            ];
                    }
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalAllocatedFinalBattles']
                        )
                    ) {
                        $this->playerDetails['totalAllocatedFinalBattles'][
                            $i
                        ] +=
                            $this->warLog['warLog'][5]['allocatedFinalBattles'][
                                $v
                            ];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] =
                            $this->warLog['warLog'][5]['allocatedFinalBattles'][
                                $v
                            ];
                    }
                }
            }
            for ($w = 0; $w < $this->warLog6Length; $w++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][6]['name'][$w]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalFinalBattlesPlayed']
                        )
                    ) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] +=
                            $this->warLog['warLog'][6]['finalBattlesPlayed'][
                                $w
                            ];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] =
                            $this->warLog['warLog'][6]['finalBattlesPlayed'][
                                $w
                            ];
                    }
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalAllocatedFinalBattles']
                        )
                    ) {
                        $this->playerDetails['totalAllocatedFinalBattles'][
                            $i
                        ] +=
                            $this->warLog['warLog'][6]['allocatedFinalBattles'][
                                $w
                            ];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] =
                            $this->warLog['warLog'][6]['allocatedFinalBattles'][
                                $w
                            ];
                    }
                }
            }
            for ($x = 0; $x < $this->warLog7Length; $x++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][7]['name'][$x]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalFinalBattlesPlayed']
                        )
                    ) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] +=
                            $this->warLog['warLog'][7]['finalBattlesPlayed'][
                                $x
                            ];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] =
                            $this->warLog['warLog'][7]['finalBattlesPlayed'][
                                $x
                            ];
                    }
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalAllocatedFinalBattles']
                        )
                    ) {
                        $this->playerDetails['totalAllocatedFinalBattles'][
                            $i
                        ] +=
                            $this->warLog['warLog'][7]['allocatedFinalBattles'][
                                $x
                            ];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] =
                            $this->warLog['warLog'][7]['allocatedFinalBattles'][
                                $x
                            ];
                    }
                }
            }
            for ($y = 0; $y < $this->warLog8Length; $y++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][8]['name'][$y]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalFinalBattlesPlayed']
                        )
                    ) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] +=
                            $this->warLog['warLog'][8]['finalBattlesPlayed'][
                                $y
                            ];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] =
                            $this->warLog['warLog'][8]['finalBattlesPlayed'][
                                $y
                            ];
                    }
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalAllocatedFinalBattles']
                        )
                    ) {
                        $this->playerDetails['totalAllocatedFinalBattles'][
                            $i
                        ] +=
                            $this->warLog['warLog'][8]['allocatedFinalBattles'][
                                $y
                            ];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] =
                            $this->warLog['warLog'][8]['allocatedFinalBattles'][
                                $y
                            ];
                    }
                }
            }
            for ($z = 0; $z < $this->warLog9Length; $z++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][9]['name'][$z]
                ) {
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalFinalBattlesPlayed']
                        )
                    ) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] +=
                            $this->warLog['warLog'][9]['finalBattlesPlayed'][
                                $z
                            ];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] =
                            $this->warLog['warLog'][9]['finalBattlesPlayed'][
                                $z
                            ];
                    }
                    if (
                        array_key_exists(
                            $i,
                            $this->playerDetails['totalAllocatedFinalBattles']
                        )
                    ) {
                        $this->playerDetails['totalAllocatedFinalBattles'][
                            $i
                        ] +=
                            $this->warLog['warLog'][9]['allocatedFinalBattles'][
                                $z
                            ];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] =
                            $this->warLog['warLog'][9]['allocatedFinalBattles'][
                                $z
                            ];
                    }
                }
            }
            //check if a player has participated in at least 1 war and set total missed battles
            //which will be their total allocated battles - their total played battles

            if (
                array_key_exists(
                    $i,
                    $this->playerDetails['totalFinalBattlesPlayed']
                )
            ) {
                $this->playerDetails['totalFinalBattlesMissed'][$i] =
                    $this->playerDetails['totalAllocatedFinalBattles'][$i] -
                    $this->playerDetails['totalFinalBattlesPlayed'][$i];
                //if a player hasnt participated in any war then set their final battles missed to 10
                //and missed all wars to true
            } else {
                $this->playerDetails['missedAllWars'][$i] = "true";
                $this->playerDetails['totalFinalBattlesMissed'][$i] = 10;
            }
        }
    }

    public function finalBattleWinLoss()
    {
        //loop over this code for every player in the clan
        for ($i = 0; $i < $this->playerDetailsLength; $i++) {
            for ($q = 0; $q < $this->warLog0Length; $q++) {
                //check if a player has participated in a war and get their wins/loss for each war
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][0]['name'][$q]
                ) {
                    //check if a player has won their battles then this value is assigned to their wins
                    if ($this->warLog['warLog'][0]['finalBattleWins'][$q] > 0) {
                        $this->playerDetails['totalFinalBattleWins'][$i] =
                            $this->warLog['warLog'][0]['finalBattleWins'][$q];
                        //if a player has won their battle set their total losses to 0

                        $this->playerDetails['totalFinalBattleLosses'][$i] = 0;
                    } else {
                        //if a player has lost their final battle assign the number of final battles they have played as their losses
                        $this->playerDetails['totalFinalBattleLosses'][$i] =
                            $this->warLog['warLog'][0]['finalBattlesPlayed'][
                                $q
                            ];
                        //and assign their total wins to 0
                        $this->playerDetails['totalFinalBattleWins'][$i] = 0;
                    }
                }
            }
            //in each subsequent loop a players final battle wins/losses are added onto their total
            for ($r = 0; $r < $this->warLog1Length; $r++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][1]['name'][$r]
                ) {
                    //check if a player has won their final battle
                    if ($this->warLog['warLog'][1]['finalBattleWins'][$r] > 0) {
                        //check if a player has already won a final battle
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            //if a player has won then add on the result for this war to their total wins
                            $this->playerDetails['totalFinalBattleWins'][$i] +=
                                $this->warLog['warLog'][1]['finalBattleWins'][
                                    $r
                                ];
                        } else {
                            //if a player hasn't already won a final battle then assign the result of this war as their total wins
                            $this->playerDetails['totalFinalBattleWins'][$i] =
                                $this->warLog['warLog'][1]['finalBattleWins'][
                                    $r
                                ];
                        }
                        //check if a playe hasn't lost any battles
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            //then set their total losses to 0
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] = 0;
                        }
                    } else {
                        //if a player has lost this war, check if they have already lost a war and add their battles played onto their total losses
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] +=
                                $this->warLog['warLog'][1][
                                    'finalBattlesPlayed'
                                ][$r];
                        } else {
                            //otherwise assign their number of battles played in this war as their total losses
                            $this->playerDetails['totalFinalBattleLosses'][$i] =
                                $this->warLog['warLog'][1][
                                    'finalBattlesPlayed'
                                ][$r];
                        }
                        //check if a player hasn't won any battles
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            //then set their total wins to 0
                            $this->playerDetails['totalFinalBattleWins'][
                                $i
                            ] = 0;
                        }
                    }
                }
            }
            for ($s = 0; $s < $this->warLog2Length; $s++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][2]['name'][$s]
                ) {
                    if ($this->warLog['warLog'][2]['finalBattleWins'][$s] > 0) {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][$i] +=
                                $this->warLog['warLog'][2]['finalBattleWins'][
                                    $s
                                ];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] =
                                $this->warLog['warLog'][2]['finalBattleWins'][
                                    $s
                                ];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] = 0;
                        }
                    } else {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] +=
                                $this->warLog['warLog'][2][
                                    'finalBattlesPlayed'
                                ][$s];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] =
                                $this->warLog['warLog'][2][
                                    'finalBattlesPlayed'
                                ][$s];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][
                                $i
                            ] = 0;
                        }
                    }
                }
            }
            for ($t = 0; $t < $this->warLog3Length; $t++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][3]['name'][$t]
                ) {
                    if ($this->warLog['warLog'][3]['finalBattleWins'][$t] > 0) {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][$i] +=
                                $this->warLog['warLog'][3]['finalBattleWins'][
                                    $t
                                ];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] =
                                $this->warLog['warLog'][3]['finalBattleWins'][
                                    $t
                                ];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] = 0;
                        }
                    } else {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] +=
                                $this->warLog['warLog'][3][
                                    'finalBattlesPlayed'
                                ][$t];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] =
                                $this->warLog['warLog'][3][
                                    'finalBattlesPlayed'
                                ][$t];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][
                                $i
                            ] = 0;
                        }
                    }
                }
            }
            for ($u = 0; $u < $this->warLog4Length; $u++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][4]['name'][$u]
                ) {
                    if ($this->warLog['warLog'][4]['finalBattleWins'][$u] > 0) {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][$i] +=
                                $this->warLog['warLog'][4]['finalBattleWins'][
                                    $u
                                ];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] =
                                $this->warLog['warLog'][4]['finalBattleWins'][
                                    $u
                                ];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] = 0;
                        }
                    } else {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] +=
                                $this->warLog['warLog'][4][
                                    'finalBattlesPlayed'
                                ][$u];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] =
                                $this->warLog['warLog'][4][
                                    'finalBattlesPlayed'
                                ][$u];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][
                                $i
                            ] = 0;
                        }
                    }
                }
            }
            for ($v = 0; $v < $this->warLog5Length; $v++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][5]['name'][$v]
                ) {
                    if ($this->warLog['warLog'][5]['finalBattleWins'][$v] > 0) {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][$i] +=
                                $this->warLog['warLog'][5]['finalBattleWins'][
                                    $v
                                ];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] =
                                $this->warLog['warLog'][5]['finalBattleWins'][
                                    $v
                                ];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] = 0;
                        }
                    } else {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] +=
                                $this->warLog['warLog'][5][
                                    'finalBattlesPlayed'
                                ][$v];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] =
                                $this->warLog['warLog'][5][
                                    'finalBattlesPlayed'
                                ][$v];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][
                                $i
                            ] = 0;
                        }
                    }
                }
            }
            for ($w = 0; $w < $this->warLog6Length; $w++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][6]['name'][$w]
                ) {
                    if ($this->warLog['warLog'][6]['finalBattleWins'][$w] > 0) {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][$i] +=
                                $this->warLog['warLog'][6]['finalBattleWins'][
                                    $w
                                ];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] =
                                $this->warLog['warLog'][6]['finalBattleWins'][
                                    $w
                                ];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] = 0;
                        }
                    } else {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] +=
                                $this->warLog['warLog'][6][
                                    'finalBattlesPlayed'
                                ][$w];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] =
                                $this->warLog['warLog'][6][
                                    'finalBattlesPlayed'
                                ][$w];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][
                                $i
                            ] = 0;
                        }
                    }
                }
            }
            for ($x = 0; $x < $this->warLog7Length; $x++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][7]['name'][$x]
                ) {
                    if ($this->warLog['warLog'][7]['finalBattleWins'][$x] > 0) {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][$i] +=
                                $this->warLog['warLog'][7]['finalBattleWins'][
                                    $x
                                ];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] =
                                $this->warLog['warLog'][7]['finalBattleWins'][
                                    $x
                                ];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] = 0;
                        }
                    } else {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] +=
                                $this->warLog['warLog'][7][
                                    'finalBattlesPlayed'
                                ][$x];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] =
                                $this->warLog['warLog'][7][
                                    'finalBattlesPlayed'
                                ][$x];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][
                                $i
                            ] = 0;
                        }
                    }
                }
            }
            for ($y = 0; $y < $this->warLog8Length; $y++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][8]['name'][$y]
                ) {
                    if ($this->warLog['warLog'][8]['finalBattleWins'][$y] > 0) {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][$i] +=
                                $this->warLog['warLog'][8]['finalBattleWins'][
                                    $y
                                ];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] =
                                $this->warLog['warLog'][8]['finalBattleWins'][
                                    $y
                                ];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] = 0;
                        }
                    } else {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] +=
                                $this->warLog['warLog'][8][
                                    'finalBattlesPlayed'
                                ][$y];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] =
                                $this->warLog['warLog'][8][
                                    'finalBattlesPlayed'
                                ][$y];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][
                                $i
                            ] = 0;
                        }
                    }
                }
            }
            for ($z = 0; $z < $this->warLog9Length; $z++) {
                if (
                    $this->playerDetails['name'][$i] ==
                    $this->warLog['warLog'][9]['name'][$z]
                ) {
                    if ($this->warLog['warLog'][9]['finalBattleWins'][$z] > 0) {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][$i] +=
                                $this->warLog['warLog'][9]['finalBattleWins'][
                                    $z
                                ];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] =
                                $this->warLog['warLog'][9]['finalBattleWins'][
                                    $z
                                ];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] = 0;
                        }
                    } else {
                        if (
                            array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleLosses']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleLosses'][
                                $i
                            ] +=
                                $this->warLog['warLog'][9][
                                    'finalBattlesPlayed'
                                ][$z];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] =
                                $this->warLog['warLog'][9][
                                    'finalBattlesPlayed'
                                ][$z];
                        }
                        if (
                            !array_key_exists(
                                $i,
                                $this->playerDetails['totalFinalBattleWins']
                            )
                        ) {
                            $this->playerDetails['totalFinalBattleWins'][
                                $i
                            ] = 0;
                        }
                    }
                }
            }
            if (
                array_key_exists(
                    $i,
                    $this->playerDetails['totalFinalBattleLosses']
                ) &&
                array_key_exists(
                    $i,
                    $this->playerDetails['totalFinalBattleWins']
                )
            ) {
                //if a player hasn't lost any battles set the ratio to their number of wins
                if ($this->playerDetails['totalFinalBattleLosses'][$i] == 0) {
                    $this->playerDetails['finalBattleWinLoss'][$i] =
                        $this->playerDetails['totalFinalBattleWins'][$i];
                } else {
                    //otherwise set the ratio to their wins divided by losses rounded to 1 decimal point

                    $this->playerDetails['finalBattleWinLoss'][$i] = round(
                        $this->playerDetails['totalFinalBattleWins'][$i] /
                            $this->playerDetails['totalFinalBattleLosses'][$i],
                        1
                    );
                    //if totalfinalbattleWins or totalFinalBattleLosses hasn't been set set the players ratio to N/A
                }
                if ($this->playerDetails['totalFinalBattleWins'][$i] == 0) {
                    //if a player hasn't won any final battles set their ratio to the negative of their total losses
                    $this->playerDetails['finalBattleWinLoss'][$i] =
                        0 - $this->playerDetails['totalFinalBattleLosses'][$i];
                }
            } else {
                //if a player has missed all wars set their win loss to 0

                $this->playerDetails['finalBattleWinLoss'][$i] = 0;
            }
        }
    }

    public function missedAllWars()
    {
        for ($i = 0; $i < $this->playerDetailsLength; $i++) {
            if ($this->playerDetails['missedAllWars'][$i] === "true") {
                echo $this->playerDetails['name'][$i] . "<br>";
            }
        }
    }
}
