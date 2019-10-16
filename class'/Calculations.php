<?php
class Calculations extends GetData {


    public function promotionEligibility() {
        //loop through player array and check for members with >= 300 donations and rank of member
        for ($i = 0;$i < $this->playerDetailsLength;$i++) {
            if (($this->playerDetails['donations'][$i] >= 300) && ($this->playerDetails['role'][$i] == "member")) {
                echo $this->playerDetails['name'][$i];
            } else {
            }
        }
    }
    
    
    public function elderDonations() {
        //loop through player array and check for elders with < 100 donations
        for ($i = 0;$i < $this->playerDetailsLength;$i++) {
            if (($this->playerDetails['donations'][$i] < 100) && ($this->playerDetails['role'][$i] == "elder")) {
                echo $this->playerDetails['name'][$i] . " with " . $this->playerDetails['donations'][$i] . " donations " . " was " . (100 - $this->playerDetails['donations'][$i]) . " donations away from 100 <br>";
            }
        }
    }
    
    
    public function giveRequestRatio() {
        for ($i = 0;$i < $this->playerDetailsLength;$i++) {
            //if a player hasn't received any donations set ratio to their number of donations
            if (($this->playerDetails['donationsReceived'][$i] === 0) && ($this->playerDetails['donations'][$i] > 0)) {
                $this->playerDetails['donateRequestRatio'][$i] = $this->playerDetails['donations'][$i];
                //if a player hasn't made any donations set the ratio to the negative of their donations received
                
            } elseif ($this->playerDetails['donations'][$i] === 0) {
                $this->playerDetails['donateRequestRatio'][$i] = - $this->playerDetails['donationsReceived'][$i];
                //set ratio to zero if both variables are equal 0
                
            } elseif (($this->playerDetails['donationsReceived'][$i] == 0) && ($this->playerDetails['donations'][$i] == 0)) {
                $this->playerDetails['donateRequestRatio'][$i] = 0;
                //finally the ratio is calculated by dividing a players donations with their donations received
                
            } else {
                $this->playerDetails['donateRequestRatio'][$i] = ($this->playerDetails['donations'][$i]) / ($this->playerDetails['donationsReceived'][$i]);
            }
        }
    }
    
    
    public function recruitment() {
        $placesAvailable = (50 - $this->playerDetailsLength);
        if ($placesAvailable == 1) {
            echo " We have " . $placesAvailable . " place available";
        } else if ($placesAvailable > 1) {
            echo "We have " . $placesAvailable . " places available";
        }
    }
    
    
    public function currentWarStatus() {
        switch ($this->warState) {
            case 'notInWar':
                echo "We are currently not at war";
            break;
            case 'collectionDay':
                echo "We are gathering cards on $this->warState. Currently we have participated in $this->warTotalCollectionBattles battles with $this->warTotalCollectionWins victories. We will be moving to the next stage of war at $this->collectionEndTime";
            break;
            case 'warDay':
                echo "We are now at the final stage of our war. We have $this->warParticipants members fighting for us today. We have a total of $this->warTotalFinalBattles battles used, currently we have $this->warTotalFinalWins victories and $this->warTotalFinalCrowns crowns. This war is ending at $this->warEndTime";
            break;
        }
    }
    
    
    public function warLog0() {
        echo "<HR>";
        //getting overall clan war results
        echo "Created on: " . $this->warLog['createdOn'][0] . " Total Participants: " . $this->warLog['participants'][0] . " Total Battles Played: " . $this->warLog['battlesPlayed'][0] . " Total Wins: " . $this->warLog['wins'][0] . " Total Crowns Won: " . $this->warLog['crowns'][0] . " Trophy Change: " . $this->warLog['trophyChange'][0] . "<br>";
        echo "<table>
   <tr>
   <th>Name</th>
   <th>Collection Battles Played</th>
   <th>Cards Earned</th>
   <th>Final Battles Played</th>
   <th>Final Battle Result</th>
   </tr>";
        //getting individual player results
        for ($x = 0;$x < $this->warLog0Length;$x++) {
            echo "<tr>
   <td>" . $this->warLog['warLog'][0]['name'][$x] . "</td>
   <td>" . $this->warLog['warLog'][0]['collectionBattlesPlayed'][$x] . "</td>
   <td>" . $this->warLog['warLog'][0]['cardsEarned'][$x] . "</td>
   <td>" . $this->warLog['warLog'][0]['finalBattlesPlayed'][$x] . "</td>
   <td>" . $this->warLog['warLog'][0]['finalBattleWins'][$x] . "</td>
   </tr>";
        }
    }
    
    
    public function totalCardsEarned() {
        //loop over this code for every player in the clan
        for ($i = 0;$i < $this->playerDetailsLength;$i++) {
            for ($q = 0;$q < $this->warLog0Length;$q++) {
                //check if a player has participated in a war and get their cards earned
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][0]['name'][$q]) {
                    $this->playerDetails['totalCardsEarned'][$i] = $this->warLog['warLog'][0]['cardsEarned'][$q];
                }
            }
            //in each subsequent loop a players cards earned are added onto their total
            for ($r = 0;$r < $this->warLog1Length;$r++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][1]['name'][$r]) {
                    //check if a player has already participated in a war
                    if (array_key_exists($i, $this->playerDetails['totalCardsEarned'])) {
                        //if yes add on their cards earned to their total
                        $this->playerDetails['totalCardsEarned'][$i]+= $this->warLog['warLog'][1]['cardsEarned'][$r];
                    } else {
                        //otherwise assign their total cards earned
                        $this->playerDetails['totalCardsEarned'][$i] = $this->warLog['warLog'][1]['cardsEarned'][$r];
                    }
                }
            }
            for ($s = 0;$s < $this->warLog2Length;$s++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][2]['name'][$s]) {
                    if (array_key_exists($i, $this->playerDetails['totalCardsEarned'])) {
                        $this->playerDetails['totalCardsEarned'][$i]+= $this->warLog['warLog'][2]['cardsEarned'][$s];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] = $this->warLog['warLog'][2]['cardsEarned'][$s];
                    }
                }
            }
            for ($t = 0;$t < $this->warLog3Length;$t++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][3]['name'][$t]) {
                    if (array_key_exists($i, $this->playerDetails['totalCardsEarned'])) {
                        $this->playerDetails['totalCardsEarned'][$i]+= $this->warLog['warLog'][3]['cardsEarned'][$t];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] = $this->warLog['warLog'][3]['cardsEarned'][$t];
                    }
                }
            }
            for ($u = 0;$u < $this->warLog4Length;$u++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][4]['name'][$u]) {
                    if (array_key_exists($i, $this->playerDetails['totalCardsEarned'])) {
                        $this->playerDetails['totalCardsEarned'][$i]+= $this->warLog['warLog'][4]['cardsEarned'][$u];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] = $this->warLog['warLog'][4]['cardsEarned'][$u];
                    }
                }
            }
            for ($v = 0;$v < $this->warLog5Length;$v++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][5]['name'][$v]) {
                    if (array_key_exists($i, $this->playerDetails['totalCardsEarned'])) {
                        $this->playerDetails['totalCardsEarned'][$i]+= $this->warLog['warLog'][5]['cardsEarned'][$v];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] = $this->warLog['warLog'][5]['cardsEarned'][$v];
                    }
                }
            }
            for ($w = 0;$w < $this->warLog6Length;$w++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][6]['name'][$w]) {
                    if (array_key_exists($i, $this->playerDetails['totalCardsEarned'])) {
                        $this->playerDetails['totalCardsEarned'][$i]+= $this->warLog['warLog'][6]['cardsEarned'][$w];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] = $this->warLog['warLog'][6]['cardsEarned'][$w];
                    }
                }
            }
            for ($x = 0;$x < $this->warLog7Length;$x++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][7]['name'][$x]) {
                    if (array_key_exists($i, $this->playerDetails['totalCardsEarned'])) {
                        $this->playerDetails['totalCardsEarned'][$i]+= $this->warLog['warLog'][7]['cardsEarned'][$x];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] = $this->warLog['warLog'][7]['cardsEarned'][$x];
                    }
                }
            }
            for ($y = 0;$y < $this->warLog8Length;$y++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][8]['name'][$y]) {
                    if (array_key_exists($i, $this->playerDetails['totalCardsEarned'])) {
                        $this->playerDetails['totalCardsEarned'][$i]+= $this->warLog['warLog'][8]['cardsEarned'][$y];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] = $this->warLog['warLog'][8]['cardsEarned'][$y];
                    }
                }
            }
            for ($z = 0;$z < $this->warLog9Length;$z++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][9]['name'][$z]) {
                    if (array_key_exists($i, $this->playerDetails['totalCardsEarned'])) {
                        $this->playerDetails['totalCardsEarned'][$i]+= $this->warLog['warLog'][9]['cardsEarned'][$z];
                    } else {
                        $this->playerDetails['totalCardsEarned'][$i] = $this->warLog['warLog'][9]['cardsEarned'][$z];
                    }
                }
            }
        }
    }
    
    
    public function totalCollectionBattles() {
        //loop over this code for every player in the clan
        for ($i = 0;$i < $this->playerDetailsLength;$i++) {
            for ($q = 0;$q < $this->warLog0Length;$q++) {
                //check if a player has participated in a war and get their collection battles played if they have
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][0]['name'][$q]) {
                    $this->playerDetails['totalCollectionBattles'][$i] = $this->warLog['warLog'][0]['collectionBattlesPlayed'][$q];
                }
            }
            //in each subsequent loop a players collection battles are added onto their total
            for ($r = 0;$r < $this->warLog1Length;$r++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][1]['name'][$r]) {
                    if (array_key_exists($i, $this->playerDetails['totalCollectionBattles'])) {
                        $this->playerDetails['totalCollectionBattles'][$i]+= $this->warLog['warLog'][1]['collectionBattlesPlayed'][$r];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] = $this->warLog['warLog'][1]['collectionBattlesPlayed'][$r];
                    }
                }
            }
            for ($s = 0;$s < $this->warLog2Length;$s++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][2]['name'][$s]) {
                    if (array_key_exists($i, $this->playerDetails['totalCollectionBattles'])) {
                        $this->playerDetails['totalCollectionBattles'][$i]+= $this->warLog['warLog'][2]['collectionBattlesPlayed'][$s];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] = $this->warLog['warLog'][2]['collectionBattlesPlayed'][$s];
                    }
                }
            }
            for ($t = 0;$t < $this->warLog3Length;$t++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][3]['name'][$t]) {
                    if (array_key_exists($i, $this->playerDetails['totalCollectionBattles'])) {
                        $this->playerDetails['totalCollectionBattles'][$i]+= $this->warLog['warLog'][3]['collectionBattlesPlayed'][$t];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] = $this->warLog['warLog'][3]['collectionBattlesPlayed'][$t];
                    }
                }
            }
            for ($u = 0;$u < $this->warLog4Length;$u++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][4]['name'][$u]) {
                    if (array_key_exists($i, $this->playerDetails['totalCollectionBattles'])) {
                        $this->playerDetails['totalCollectionBattles'][$i]+= $this->warLog['warLog'][4]['collectionBattlesPlayed'][$u];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] = $this->warLog['warLog'][4]['collectionBattlesPlayed'][$u];
                    }
                }
            }
            for ($v = 0;$v < $this->warLog5Length;$v++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][5]['name'][$v]) {
                    if (array_key_exists($i, $this->playerDetails['totalCollectionBattles'])) {
                        $this->playerDetails['totalCollectionBattles'][$i]+= $this->warLog['warLog'][5]['collectionBattlesPlayed'][$v];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] = $this->warLog['warLog'][5]['collectionBattlesPlayed'][$v];
                    }
                }
            }
            for ($w = 0;$w < $this->warLog6Length;$w++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][6]['name'][$w]) {
                    if (array_key_exists($i, $this->playerDetails['totalCollectionBattles'])) {
                        $this->playerDetails['totalCollectionBattles'][$i]+= $this->warLog['warLog'][6]['collectionBattlesPlayed'][$w];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] = $this->warLog['warLog'][6]['collectionBattlesPlayed'][$w];
                    }
                }
            }
            for ($x = 0;$x < $this->warLog7Length;$x++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][7]['name'][$x]) {
                    if (array_key_exists($i, $this->playerDetails['totalCollectionBattles'])) {
                        $this->playerDetails['totalCollectionBattles'][$i]+= $this->warLog['warLog'][7]['collectionBattlesPlayed'][$x];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] = $this->warLog['warLog'][7]['collectionBattlesPlayed'][$x];
                    }
                }
            }
            for ($y = 0;$y < $this->warLog8Length;$y++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][8]['name'][$y]) {
                    if (array_key_exists($i, $this->playerDetails['totalCollectionBattles'])) {
                        $this->playerDetails['totalCollectionBattles'][$i]+= $this->warLog['warLog'][8]['collectionBattlesPlayed'][$y];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] = $this->warLog['warLog'][8]['collectionBattlesPlayed'][$y];
                    }
                }
            }
            for ($z = 0;$z < $this->warLog9Length;$z++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][9]['name'][$z]) {
                    if (array_key_exists($i, $this->playerDetails['totalCollectionBattles'])) {
                        $this->playerDetails['totalCollectionBattles'][$i]+= $this->warLog['warLog'][9]['collectionBattlesPlayed'][$z];
                    } else {
                        $this->playerDetails['totalCollectionBattles'][$i] = $this->warLog['warLog'][9]['collectionBattlesPlayed'][$z];
                    }
                }
            }
        }
    }
    
    
    public function totalFinalBattlesMissed() {
        //loop over this code for every player in the clan
        for ($i = 0;$i < $this->playerDetailsLength;$i++) {
            for ($q = 0;$q < $this->warLog0Length;$q++) {
                //check if a player has participated in a war and get their allocated final battles and number of final battles played
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][0]['name'][$q]) {
                    $this->playerDetails['totalFinalBattlesPlayed'][$i] = $this->warLog['warLog'][0]['finalBattlesPlayed'][$q];
                    $this->playerDetails['totalAllocatedFinalBattles'][$i] = $this->warLog['warLog'][0]['allocatedFinalBattles'][$q];
                }
            }
            //in each subsequent loop a players  battles are added onto their total
            for ($r = 0;$r < $this->warLog1Length;$r++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][1]['name'][$r]) {
                    if (array_key_exists($i, $this->playerDetails['totalFinalBattlesPlayed'])) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i]+= $this->warLog['warLog'][1]['finalBattlesPlayed'][$r];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] = $this->warLog['warLog'][1]['finalBattlesPlayed'][$r];
                    }
                    if (array_key_exists($i, $this->playerDetails['totalAllocatedFinalBattles'])) {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i]+= $this->warLog['warLog'][1]['allocatedFinalBattles'][$r];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] = $this->warLog['warLog'][1]['allocatedFinalBattles'][$r];
                    }
                }
            }
            for ($s = 0;$s < $this->warLog2Length;$s++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][2]['name'][$s]) {
                    if (array_key_exists($i, $this->playerDetails['totalFinalBattlesPlayed'])) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i]+= $this->warLog['warLog'][2]['finalBattlesPlayed'][$s];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] = $this->warLog['warLog'][2]['finalBattlesPlayed'][$s];
                    }
                    if (array_key_exists($i, $this->playerDetails['totalAllocatedFinalBattles'])) {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i]+= $this->warLog['warLog'][2]['allocatedFinalBattles'][$s];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] = $this->warLog['warLog'][2]['allocatedFinalBattles'][$s];
                    }
                }
            }
            for ($t = 0;$t < $this->warLog3Length;$t++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][3]['name'][$t]) {
                    if (array_key_exists($i, $this->playerDetails['totalFinalBattlesPlayed'])) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i]+= $this->warLog['warLog'][3]['finalBattlesPlayed'][$t];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] = $this->warLog['warLog'][3]['finalBattlesPlayed'][$t];
                    }
                    if (array_key_exists($i, $this->playerDetails['totalAllocatedFinalBattles'])) {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i]+= $this->warLog['warLog'][3]['allocatedFinalBattles'][$t];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] = $this->warLog['warLog'][3]['allocatedFinalBattles'][$t];
                    }
                }
            }
            for ($u = 0;$u < $this->warLog4Length;$u++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][4]['name'][$u]) {
                    if (array_key_exists($i, $this->playerDetails['totalFinalBattlesPlayed'])) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i]+= $this->warLog['warLog'][4]['finalBattlesPlayed'][$u];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] = $this->warLog['warLog'][4]['finalBattlesPlayed'][$u];
                    }
                    if (array_key_exists($i, $this->playerDetails['totalAllocatedFinalBattles'])) {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i]+= $this->warLog['warLog'][4]['allocatedFinalBattles'][$u];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] = $this->warLog['warLog'][4]['allocatedFinalBattles'][$u];
                    }
                }
            }
            for ($v = 0;$v < $this->warLog5Length;$v++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][5]['name'][$v]) {
                    if (array_key_exists($i, $this->playerDetails['totalFinalBattlesPlayed'])) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i]+= $this->warLog['warLog'][5]['finalBattlesPlayed'][$v];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] = $this->warLog['warLog'][5]['finalBattlesPlayed'][$v];
                    }
                    if (array_key_exists($i, $this->playerDetails['totalAllocatedFinalBattles'])) {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i]+= $this->warLog['warLog'][5]['allocatedFinalBattles'][$v];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] = $this->warLog['warLog'][5]['allocatedFinalBattles'][$v];
                    }
                }
            }
            for ($w = 0;$w < $this->warLog6Length;$w++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][6]['name'][$w]) {
                    if (array_key_exists($i, $this->playerDetails['totalFinalBattlesPlayed'])) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i]+= $this->warLog['warLog'][6]['finalBattlesPlayed'][$w];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] = $this->warLog['warLog'][6]['finalBattlesPlayed'][$w];
                    }
                    if (array_key_exists($i, $this->playerDetails['totalAllocatedFinalBattles'])) {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i]+= $this->warLog['warLog'][6]['allocatedFinalBattles'][$w];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] = $this->warLog['warLog'][6]['allocatedFinalBattles'][$w];
                    }
                }
            }
            for ($x = 0;$x < $this->warLog7Length;$x++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][7]['name'][$x]) {
                    if (array_key_exists($i, $this->playerDetails['totalFinalBattlesPlayed'])) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i]+= $this->warLog['warLog'][7]['finalBattlesPlayed'][$x];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] = $this->warLog['warLog'][7]['finalBattlesPlayed'][$x];
                    }
                    if (array_key_exists($i, $this->playerDetails['totalAllocatedFinalBattles'])) {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i]+= $this->warLog['warLog'][7]['allocatedFinalBattles'][$x];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] = $this->warLog['warLog'][7]['allocatedFinalBattles'][$x];
                    }
                }
            }
            for ($y = 0;$y < $this->warLog8Length;$y++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][8]['name'][$y]) {
                    if (array_key_exists($i, $this->playerDetails['totalFinalBattlesPlayed'])) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i]+= $this->warLog['warLog'][8]['finalBattlesPlayed'][$y];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] = $this->warLog['warLog'][8]['finalBattlesPlayed'][$y];
                    }
                    if (array_key_exists($i, $this->playerDetails['totalAllocatedFinalBattles'])) {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i]+= $this->warLog['warLog'][8]['allocatedFinalBattles'][$y];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] = $this->warLog['warLog'][8]['allocatedFinalBattles'][$y];
                    }
                }
            }
            for ($z = 0;$z < $this->warLog9Length;$z++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][9]['name'][$z]) {
                    if (array_key_exists($i, $this->playerDetails['totalFinalBattlesPlayed'])) {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i]+= $this->warLog['warLog'][9]['finalBattlesPlayed'][$z];
                    } else {
                        $this->playerDetails['totalFinalBattlesPlayed'][$i] = $this->warLog['warLog'][9]['finalBattlesPlayed'][$z];
                    }
                    if (array_key_exists($i, $this->playerDetails['totalAllocatedFinalBattles'])) {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i]+= $this->warLog['warLog'][9]['allocatedFinalBattles'][$z];
                    } else {
                        $this->playerDetails['totalAllocatedFinalBattles'][$i] = $this->warLog['warLog'][9]['allocatedFinalBattles'][$z];
                    }
                }
            }
            //check if a player has participated in at least 1 war and set total missed battles
            //which will be their total allocated battles - their total played battles
            //also set missedAllWars to false (0)
            if (array_key_exists($i, $this->playerDetails['totalFinalBattlesPlayed'])) {
                $this->playerDetails['totalFinalBattlesMissed'][$i] = $this->playerDetails['totalAllocatedFinalBattles'][$i] - $this->playerDetails['totalFinalBattlesPlayed'][$i];
                $this->playerDetails['missedAllWars'][$i] = 0;
                //if a player hasnt participated in any war then set their final battles missed to NA
                //and missed all wars to true
                
            } else {
                $this->playerDetails['missedAllWars'][$i] = 1;
                $this->playerDetails['totalFinalBattlesMissed'][$i] = "N/A";
            }
        }
    }
    
    
    public function finalBattleWinLoss() {
        //loop over this code for every player in the clan
        for ($i = 0;$i < $this->playerDetailsLength;$i++) {
            for ($q = 0;$q < $this->warLog0Length;$q++) {
                //check if a player has participated in a war and get their wins/loss for each war
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][0]['name'][$q]) {
                    //check if a player has won their battles then this value is assigned
                    if ($this->warLog['warLog'][0]['finalBattleWins'][$q] > 0) {
                        $this->playerDetails['totalFinalBattleWins'][$i] = $this->warLog['warLog'][0]['finalBattleWins'][$q];
                        //if a player has lost their battles assign then their losses will be the amount of battles they played
                        
                    } else {
                        $this->playerDetails['totalFinalBattleLosses'][$i] = $this->warLog['warLog'][0]['finalBattlesPlayed'][$q];
                    }
                }
            }
            //in each subsequent loop a players collection wns/losses are added onto their total
            for ($r = 0;$r < $this->warLog1Length;$r++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][1]['name'][$r]) {
                    if ($this->warLog['warLog'][1]['finalBattleWins'][$r] > 0) {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleWins'])) {
                            $this->playerDetails['totalFinalBattleWins'][$i]+= $this->warLog['warLog'][1]['finalBattleWins'][$r];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] = $this->warLog['warLog'][1]['finalBattleWins'][$r];
                        }
                    } else {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleLosses'])) {
                            $this->playerDetails['totalFinalBattleLosses'][$i]+= $this->warLog['warLog'][1]['finalBattlesPlayed'][$r];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] = $this->warLog['warLog'][1]['finalBattlesPlayed'][$r];
                        }
                    }
                }
            }
            for ($s = 0;$s < $this->warLog2Length;$s++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][2]['name'][$s]) {
                    if ($this->warLog['warLog'][2]['finalBattleWins'][$s] > 0) {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleWins'])) {
                            $this->playerDetails['totalFinalBattleWins'][$i]+= $this->warLog['warLog'][2]['finalBattleWins'][$s];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] = $this->warLog['warLog'][2]['finalBattleWins'][$s];
                        }
                    } else {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleLosses'])) {
                            $this->playerDetails['totalFinalBattleLosses'][$i]+= $this->warLog['warLog'][2]['finalBattlesPlayed'][$s];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] = $this->warLog['warLog'][2]['finalBattlesPlayed'][$s];
                        }
                    }
                }
            }
            for ($t = 0;$t < $this->warLog3Length;$t++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][3]['name'][$t]) {
                    if ($this->warLog['warLog'][3]['finalBattleWins'][$t] > 0) {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleWins'])) {
                            $this->playerDetails['totalFinalBattleWins'][$i]+= $this->warLog['warLog'][3]['finalBattleWins'][$t];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] = $this->warLog['warLog'][3]['finalBattleWins'][$t];
                        }
                    } else {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleLosses'])) {
                            $this->playerDetails['totalFinalBattleLosses'][$i]+= $this->warLog['warLog'][3]['finalBattlesPlayed'][$t];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] = $this->warLog['warLog'][3]['finalBattlesPlayed'][$t];
                        }
                    }
                }
            }
            for ($u = 0;$u < $this->warLog4Length;$u++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][4]['name'][$u]) {
                    if ($this->warLog['warLog'][4]['finalBattleWins'][$u] > 0) {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleWins'])) {
                            $this->playerDetails['totalFinalBattleWins'][$i]+= $this->warLog['warLog'][4]['finalBattleWins'][$u];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] = $this->warLog['warLog'][4]['finalBattleWins'][$u];
                        }
                    } else {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleLosses'])) {
                            $this->playerDetails['totalFinalBattleLosses'][$i]+= $this->warLog['warLog'][4]['finalBattlesPlayed'][$u];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] = $this->warLog['warLog'][4]['finalBattlesPlayed'][$u];
                        }
                    }
                }
            }
            for ($v = 0;$v < $this->warLog5Length;$v++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][5]['name'][$v]) {
                    if ($this->warLog['warLog'][5]['finalBattleWins'][$v] > 0) {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleWins'])) {
                            $this->playerDetails['totalFinalBattleWins'][$i]+= $this->warLog['warLog'][5]['finalBattleWins'][$v];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] = $this->warLog['warLog'][5]['finalBattleWins'][$v];
                        }
                    } else {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleLosses'])) {
                            $this->playerDetails['totalFinalBattleLosses'][$i]+= $this->warLog['warLog'][5]['finalBattlesPlayed'][$v];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] = $this->warLog['warLog'][5]['finalBattlesPlayed'][$v];
                        }
                    }
                }
            }
            for ($w = 0;$w < $this->warLog6Length;$w++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][6]['name'][$w]) {
                    if ($this->warLog['warLog'][6]['finalBattleWins'][$w] > 0) {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleWins'])) {
                            $this->playerDetails['totalFinalBattleWins'][$i]+= $this->warLog['warLog'][6]['finalBattleWins'][$w];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] = $this->warLog['warLog'][6]['finalBattleWins'][$w];
                        }
                    } else {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleLosses'])) {
                            $this->playerDetails['totalFinalBattleLosses'][$i]+= $this->warLog['warLog'][6]['finalBattlesPlayed'][$w];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] = $this->warLog['warLog'][6]['finalBattlesPlayed'][$w];
                        }
                    }
                }
            }
            for ($x = 0;$x < $this->warLog7Length;$x++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][7]['name'][$x]) {
                    if ($this->warLog['warLog'][7]['finalBattleWins'][$x] > 0) {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleWins'])) {
                            $this->playerDetails['totalFinalBattleWins'][$i]+= $this->warLog['warLog'][7]['finalBattleWins'][$x];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] = $this->warLog['warLog'][7]['finalBattleWins'][$x];
                        }
                    } else {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleLosses'])) {
                            $this->playerDetails['totalFinalBattleLosses'][$i]+= $this->warLog['warLog'][7]['finalBattlesPlayed'][$x];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] = $this->warLog['warLog'][7]['finalBattlesPlayed'][$x];
                        }
                    }
                }
            }
            for ($y = 0;$y < $this->warLog8Length;$y++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][8]['name'][$y]) {
                    if ($this->warLog['warLog'][8]['finalBattleWins'][$y] > 0) {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleWins'])) {
                            $this->playerDetails['totalFinalBattleWins'][$i]+= $this->warLog['warLog'][8]['finalBattleWins'][$y];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] = $this->warLog['warLog'][8]['finalBattleWins'][$y];
                        }
                    } else {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleLosses'])) {
                            $this->playerDetails['totalFinalBattleLosses'][$i]+= $this->warLog['warLog'][8]['finalBattlesPlayed'][$y];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] = $this->warLog['warLog'][8]['finalBattlesPlayed'][$y];
                        }
                    }
                }
            }
            for ($z = 0;$z < $this->warLog9Length;$z++) {
                if ($this->playerDetails['name'][$i] == $this->warLog['warLog'][9]['name'][$z]) {
                    if ($this->warLog['warLog'][9]['finalBattleWins'][$z] > 0) {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleWins'])) {
                            $this->playerDetails['totalFinalBattleWins'][$i]+= $this->warLog['warLog'][9]['finalBattleWins'][$z];
                        } else {
                            $this->playerDetails['totalFinalBattleWins'][$i] = $this->warLog['warLog'][9]['finalBattleWins'][$z];
                        }
                    } else {
                        if (array_key_exists($i, $this->playerDetails['totalFinalBattleLosses'])) {
                            $this->playerDetails['totalFinalBattleLosses'][$i]+= $this->warLog['warLog'][9]['finalBattlesPlayed'][$z];
                        } else {
                            $this->playerDetails['totalFinalBattleLosses'][$i] = $this->warLog['warLog'][9]['finalBattlesPlayed'][$z];
                        }
                    }
                }
            }
            if (array_key_exists($i, $this->playerDetails['totalFinalBattleLosses'])) {
                //if a player hasn't lost any battles set the ratio to their number of wins
                if ($this->playerDetails['totalFinalBattleLosses'][$i] == 0) {
                    $this->playerDetails['finalBattleWinLoss'][$i] = $this->playerDetails['totalFinalBattleWins'][$i];
                } else {
                    //otherwise set the ratio to their wins divided by losses
                    if (array_key_exists($i, $this->playerDetails['totalFinalBattleWins'])) {
                        $this->playerDetails['finalBattleWinLoss'][$i] = $this->playerDetails['totalFinalBattleWins'][$i] / $this->playerDetails['totalFinalBattleLosses'][$i];
                        //if totalfinalbattleWins or totalFinalBattleLosses hasn't been set set the players ratio to N/A
                    } else {
                        $this->playerDetails['finalBattleWinLoss'][$i] = "N/A";
                    }
                }
            } else {
                $this->playerDetails['finalBattleWinLoss'][$i] = "N/A";
            }
        }
    }
}
