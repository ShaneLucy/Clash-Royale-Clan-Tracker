<?php
include_once 'class/GetData.php';
include_once 'class/Calculations.php';
$calc = new Calculations();
$calc->getPlayerAndClanData();
$calc->getWarLog();
$calc->lengthOfArrays();
$calc->getWarData();
$calc->warParticipation();
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
        <meta name="description" content="Sunday Roasts is a competitive war clan for supercell's multiplayer game Clash Royale. This website is used to track clan members progress and war recrods." />
        <meta name="author" content="Shane Lucy" />
        <link rel="shortcut icon" href="favicon.ico">
        <title>Sunday Roasts a Clash Royale Clan</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <style>
            .dark {
                background-color: #F0F0F0;
            }
            
            body {
                background-color: ivory;
            }
        </style>    
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#currentWar">Current War</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#members">Members</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#warLog">War Log</a>
                        </li>
                        </ul>
                </div>
            </nav>
            <div class="container pt-5">
                <section id="home">
                    <h1 class="text-center pt-5">Sunday Roasts - A Competitive Clash Royale War Clan</h1>
                    <p class="pt-2">Clan Trophies:
                        <?php echo $calc->getClanTrophies(); ?> War Trophies:
                            <?php echo $calc->getWarTrophies(); ?> Required Trophies:
                                <?php echo $calc->getRequiredTrophies(); ?> Donations Per Week:
                                    <?php echo $calc->getDonationsPerWeek();?>
                    </p>
                    <p>We are based in the UK but have members situated around the globe in our ranks. We take wars seriously but we can also have a good laugh.
                        <?php echo $calc->recruitment();?>
                    </p>
                </section>
            </div>
        </header>
        <div class="container pt-5">
            <section id="currentWar">
                <h2 class="text-center pt-5">Current War</h2>
                <p class="pt-2">
                    <?php echo $calc->currentWarStatus(); ?>
                </p>
            </section>
        </div>
        <section id="members">
            <div class="container pt-5">
                <h2 class="text-center pt-5">Members</h2>
            </div>
            <span class="pt-2"></span>
            <?php $calc->displayPlayerDetails();?>
                <div class="container">
                    <h3 class="text-center pt-5">Members Who Missed All Wars</h3>
                    <?php $calc->missedAllWars();?>
                        <h3 class="text-center pt-5">Members Eligible For Promotion</h3>
                        <p>
                            <?php $calc->promotionEligibility();?>
                        </p>
                        <h3 class="text-center pt-5">Members Eligible for Demotion</h3>
                        <p>
                            <?php $calc->elderDonations();?>
                        </p>
                </div>
        </section>
        <section id="warLog">
            <div class="container pt-5">
                <h2 class="text-center pt-5">War Log</h2>
                <span class="pt-2"></span>
                <?php $calc->readableWarResults();?>
                    <details>
                        <summary>War 1
                            <?php echo $summary1;?>
                        </summary>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Collection Battles Played</th>
                                <th>Cards Earned</th>
                                <th>Allocated Final Battles</th>
                                <th>Final Battles Played</th>
                                <th>Final Battle Result</th>
                            </tr>
                            <?php $calc->warLog0();?>
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
                                <th>Allocated Final Battles</th>
                                <th>Final Battles Played</th>
                                <th>Final Battle Result</th>
                            </tr>
                            <?php $calc->warLog1();?>
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
                                <th>Allocated Final Battles</th>
                                <th>Final Battles Played</th>
                                <th>Final Battle Result</th>
                            </tr>
                            <?php $calc->warLog2();?>
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
                                <th>Allocated Final Battles</th>
                                <th>Final Battles Played</th>
                                <th>Final Battle Result</th>
                            </tr>
                            <?php $calc->warLog3();?>
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
                                <th>Allocated Final Battles</th>
                                <th>Final Battles Played</th>
                                <th>Final Battle Result</th>
                            </tr>
                            <?php $calc->warLog4();?>
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
                                <th>Allocated Final Battles</th>
                                <th>Final Battles Played</th>
                                <th>Final Battle Result</th>
                            </tr>
                            <?php $calc->warLog5();?>
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
                                <th>Allocated Final Battles</th>
                                <th>Final Battles Played</th>
                                <th>Final Battle Result</th>
                            </tr>
                            <?php $calc->warLog6();?>
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
                                <th>Allocated Final Battles</th>
                                <th>Final Battles Played</th>
                                <th>Final Battle Result</th>
                            </tr>
                            <?php $calc->warLog7();?>
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
                                <th>Allocated Final Battles</th>
                                <th>Final Battles Played</th>
                                <th>Final Battle Result</th>
                            </tr>
                            <?php $calc->warLog8();?>
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
                                <th>Allocated Final Battles</th>
                                <th>Final Battles Played</th>
                                <th>Final Battle Result</th>
                            </tr>
                            <?php $calc->warLog9();?>
                        </table>
                    </details>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
    </html>
