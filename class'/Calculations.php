<?php
class Calculations extends GetData {
    
    public function promotionEligibility() {
        //loop through player array and check for members with >= 300 donations and rank of member
        for ($i = 0;$i < count($this->playerDetails['name']);$i++) {
            if (($this->playerDetails['donations'][$i] >= 300) && ($this->playerDetails['role'][$i] == "member")) {
                echo $this->playerDetails['name'][$i];
            } else {
            }
        }
    }
    
    public function promotedMemberDonations() {
        //loop through player array and check for members with < 300 donations and rank != member
        for ($i = 0;$i < count($this->playerDetails['name']);$i++) {
            if (($this->playerDetails['donations'][$i] < 300) && ($this->playerDetails['role'][$i] != "member")) {
                echo $this->playerDetails['name'][$i] . " with " . $this->playerDetails['donations'][$i] . " donations " . " was " . (300 - $this->playerDetails['donations'][$i]) . " donations away from 300 <br>";
            }
        }
    }
    
    public function giveRequestRatio() {
        for ($i = 0;$i < count($this->playerDetails['name']);$i++) {
            //if a player hasn't received any donations set ratio to their number of donations
            if (($this->playerDetails['donationsReceived'][$i] === 0) && ($this->playerDetails['donations'][$i] > 0)) {
                $ratio = $this->playerDetails['donations'][$i];
                //if a player hasn't made any donations set the ratio to the negative of their donations received
                
            } elseif ($this->playerDetails['donations'][$i] === 0) {
                $ratio = - $this->playerDetails['donationsReceived'][$i];
                //set ratio to zero if both variables are equal 0
                
            } elseif (($this->playerDetails['donationsReceived'][$i] == 0) && ($this->playerDetails['donations'][$i] == 0)) {
                $ratio = 0;
                //
                
            } else {
                $ratio = ($this->playerDetails['donations'][$i]) / ($this->playerDetails['donationsReceived'][$i]);
                echo $this->playerDetails['name'][$i] . " has a give/request ratio of " . $ratio . " with " . $this->playerDetails['donations'][$i] . " donations and " . $this->playerDetails['donationsReceived'][$i] . " donations received <BR>";
            }
        }
    }
    
    public function recruitment() {
        if (count($this->playerDetails['name']) < 50) {
            echo "We have " . (count($this->playerDetails['name']) - 50) . " places available";
        }
    }
}
