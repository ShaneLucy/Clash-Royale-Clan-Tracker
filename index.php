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
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta
            name="description"
            content="Sunday Roasts is a competitive war clan for supercell's multiplayer game Clash Royale. This website is used to track clan members progress and war recrods."
        />
        <meta name="author" content="Shane Lucy" />
        <link rel="shortcut icon" href="favicon.ico" />
        <title>Sunday Roasts a Clash Royale Clan</title>
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
            integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="scripts/custom.css" />
    </head>
    <body>
        <header id="home">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"> </span>
                </button>
                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#home"
                                >Home
                                <span class="sr-only">(current) </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#clanStats"
                                >Clan Stats
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#currentWar"
                                >Current War
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#members">Members </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#warLog">War Log </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div id="particles-js" class="w-100">
            <h1 class="">Sunday Roasts a Competitive Clash Royale War Clan</h1>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path
                fill="#AA0E13"
                fill-opacity="1"
                d="M0,288L48,288C96,288,192,288,288,256C384,224,480,160,576,138.7C672,117,768,139,864,170.7C960,203,1056,245,1152,261.3C1248,277,1344,267,1392,261.3L1440,256L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"
            ></path>
        </svg>
        <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
        <script src="scripts/particles.js"></script>
        <script>
            particlesJS.load(
                "particles-js",
                "assets/particles.json",
                function () {
                    //console.log('callback - particles.js config loaded');
                }
            );
        </script>
        <section id="clanStats" class="pb-5">
            <div class="container pb-5">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="text-center">Clan Stats</h2>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-12">
                        <p class="font-weight-bold">
                            Clan Trophies:
                            <?php echo $calc->getClanTrophies(); ?> War
                            Trophies:
                            <?php echo $calc->getWarTrophies(); ?> Required
                            Trophies:
                            <?php echo $calc->getRequiredTrophies(); ?>
                            Donations Per Week:
                            <?php echo $calc->getDonationsPerWeek();?> Clan
                            Badge ID:
                            <?php echo $calc->getClanId(); ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p><?php echo $calc->getClanTag();?></p>
                        <p><?php echo $calc->recruitment();?></p>
                    </div>
                </div>
            </div>
        </section>

        <section id="currentWar" class="secondary pb-5">
            <div class="container-fluid pt-5 pb-5">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="pt-2 text-center">Current War</h2>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-12">
                        <?php echo $calc->currentWarStatus(); ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="members" class="pb-5">
            <div class="container-fluid pt-5 pb-3">
                <div class="row>">
                    <div class="col-sm-12">
                        <h2 class="text-center pt-2">Members</h2>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-12">
                        <?php $calc->displayPlayerDetails();?>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-sm-4">
                        <h3 class="pt-5">Members Who Missed All 10 Wars</h3>
                        <p><?php $calc->missedAllWars();?></p>
                    </div>
                    <div class="col-sm-4">
                        <h3 class="pt-5">Members Eligible For Promotion</h3>
                        <p><?php $calc->promotionEligibility();?></p>
                    </div>
                    <div class="col-sm-4">
                        <h3 class="pt-5">Members Eligible for Demotion</h3>
                        <p><?php $calc->elderDonations();?></p>
                    </div>
                </div>
            </div>
        </section>
        <section id="warLog" class="secondary">
            <div class="container-fluid pt-5">
                <h2 class="text-center pt-2">War Log</h2>
                <span class="pt-2"> </span>
                <?php $calc->readableWarResults();?>
                <div class="row">
                    <div class="col-sm-12">
                        <details class="pt-4">
                            <summary class="pb-2 text-center"
                                >War 1
                                <?php echo $summary1;?>
                            </summary>
                            <table class="w-100">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <details class="pt-4">
                            <summary class="pb-2 text-center"
                                >War 2
                                <?php echo $summary2;?>
                            </summary>
                            <table class="w-100">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <details class="pt-4">
                            <summary class="pb-2 text-center"
                                >War 3
                                <?php echo $summary3;?>
                            </summary>
                            <table class="w-100">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <details class="pt-4">
                            <summary class="pb-2 text-center"
                                >War 4
                                <?php echo $summary4;?>
                            </summary>
                            <table class="w-100">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <details class="pt-4">
                            <summary class="pb-2 text-center"
                                >War 5
                                <?php echo $summary5;?>
                            </summary>
                            <table class="w-100">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <details class="pt-4">
                            <summary class="pb-2 text-center"
                                >War 6
                                <?php echo $summary6;?>
                            </summary>
                            <table class="w-100">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <details class="pt-4">
                            <summary class="pb-2 text-center"
                                >War 7
                                <?php echo $summary7;?>
                            </summary>
                            <table class="w-100">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <details class="pt-4">
                            <summary class="pb-2 text-center"
                                >War 8
                                <?php echo $summary8;?>
                            </summary>
                            <table class="w-100">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <details class="pt-4">
                            <summary class="pb-2 text-center"
                                >War 9
                                <?php echo $summary9;?>
                            </summary>
                            <table class="w-100">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <details class="pt-4">
                            <summary class="pb-2 text-center"
                                >War 10
                                <?php echo $summary10;?>
                            </summary>
                            <table class="w-100">
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
                </div>
            </div>
        </section>
        <script
            src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
