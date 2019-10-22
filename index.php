<?php
include_once 'class/GetData.php';
include_once 'class/Calculations.php';
$calc = new Calculations();
$calc->getPlayerAndClanData();
$calc->getWarData();
$calc->getWarLog();
$calc->lengthOfArrays();
//assigning values from warLogSummary[] to variables ready for output
list($summary1, $summary2, $summary3, $summary4, $summary5, $summary6, $summary7, $summary8, $summary9, $summary10) = $calc->warLogSummary();
$calc->giveRequestRatio();
$calc->totalCardsEarned();
$calc->totalCollectionBattles();
$calc->totalFinalBattlesMissed();
$calc->finalBattleWinLoss();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="clash royale, clash royale clan, friendly clan,  sunday roasts, war clan, active war clan, recruiting, competitive war clan" />
    <meta name="description" content="Sunday Roasts is a competitive war clan for supercell's multiplayer game Clash Royale. This website is used to track clan members progress and war recrods." />
    <meta name="author" content="Shane Lucy" />
    <title>Sunday Roasts - Clash Royale</title>
    <style>
        .dark {
        background-color: #F0F0F0;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <a href="#home">Home</a>
            <a href="#currentWar">Current War</a>
            <a href="#members">Members</a>
            <a href="#warLog">War Log</a>
        </nav>

        <section id="home">
            <h1>Sunday Roasts - A Competitive Clash Royale War Clan</h1>
            <p>We are based in the UK but have members situated around the globe in our ranks. We take wars seriously but we can also have a good laugh.
                <?php echo $calc->recruitment();?>
            </p>
        </section>
    </header>

    <section id="currentWar">
        <h2>Current War</h2>
        <p>
            <?php $calc->currentWarStatus();?>
        </p>
        <h3>Battles Played </h3>

    </section>



    <section id="members">
        <h2>Members</h2>
        <h3>Members Eligible For Promotion</h3>
        <p>
            <?php $calc->promotionEligibility();?>
        </p>
        <h3>Members Eligible for Demotion</h3>
        <p>
            <?php $calc->elderDonations();?>
        </p>
    </section>

    <section id="warLog">
        <h2>War Log</h2>
        <details>
            <summary>War 1
                <?php echo $summary1;?>
            </summary>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Collection Battles Played</th>
                    <th>Cards Earned</th>
                    <th>Final Battles Played</th>
                    <th>Final Battle Result</th>
                </tr>
                <?php echo $calc->warLog0();?>
            </table>
        </details>

        <details>
            <summary>War 2
                <?php echo $summary2;?>
            </summary>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Collection Battles Played</th>
                    <th>Cards Earned</th>
                    <th>Final Battles Played</th>
                    <th>Final Battle Result</th>
                </tr>
                <?php echo $calc->warLog1();?>
            </table>
        </details>


        <details>
            <summary>War 3
                <?php echo $summary3;?>
            </summary>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Collection Battles Played</th>
                    <th>Cards Earned</th>
                    <th>Final Battles Played</th>
                    <th>Final Battle Result</th>
                </tr>
                <?php echo $calc->warLog2();?>
            </table>
        </details>


        <details>
            <summary>War 4
                <?php echo $summary4;?>
            </summary>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Collection Battles Played</th>
                    <th>Cards Earned</th>
                    <th>Final Battles Played</th>
                    <th>Final Battle Result</th>
                </tr>
                <?php echo $calc->warLog3();?>
            </table>
        </details>


        <details>
            <summary>War 5
                <?php echo $summary5;?>
            </summary>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Collection Battles Played</th>
                    <th>Cards Earned</th>
                    <th>Final Battles Played</th>
                    <th>Final Battle Result</th>
                </tr>
                <?php echo $calc->warLog4();?>
            </table>
        </details>



        <details>
            <summary>War 6
                <?php echo $summary6;?>
            </summary>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Collection Battles Played</th>
                    <th>Cards Earned</th>
                    <th>Final Battles Played</th>
                    <th>Final Battle Result</th>
                </tr>
                <?php echo $calc->warLog5();?>
            </table>
        </details>



        <details>
            <summary>War 7
                <?php echo $summary7;?>
            </summary>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Collection Battles Played</th>
                    <th>Cards Earned</th>
                    <th>Final Battles Played</th>
                    <th>Final Battle Result</th>
                </tr>
                <?php echo $calc->warLog6();?>
            </table>
        </details>



        <details>
            <summary>War 8
                <?php echo $summary8;?>
            </summary>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Collection Battles Played</th>
                    <th>Cards Earned</th>
                    <th>Final Battles Played</th>
                    <th>Final Battle Result</th>
                </tr>
                <?php echo $calc->warLog7();?>
            </table>
        </details>



        <details>
            <summary>War 9
                <?php echo $summary9;?>
            </summary>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Collection Battles Played</th>
                    <th>Cards Earned</th>
                    <th>Final Battles Played</th>
                    <th>Final Battle Result</th>
                </tr>
                <?php echo $calc->warLog8();?>
            </table>
        </details>



        <details>
            <summary>War 10
                <?php echo $summary10;?>
            </summary>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Collection Battles Played</th>
                    <th>Cards Earned</th>
                    <th>Final Battles Played</th>
                    <th>Final Battle Result</th>
                </tr>
                <?php echo $calc->warLog9();?>
            </table>
        </details>



    </section>
</body>

</html>
