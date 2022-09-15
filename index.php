<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Pipper</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>


    <!-- test -->
    <div class="container">
        <div class="row">
            <div class="col-3 order-1 pt-3 " id="sticky-sidebar">
                <div class="sticky-top d-flex flex-column">
                    <!-- logo -->
                    <img src="img/logo.svg" alt="Responsive image" class="img-fluid" max-height="50" width="50">
                    <!-- placeholders -->

                    <li class="bold">🏠Forside</li>
                    <li># Udforsk</li>
                    <li>🔔Meddelser</li>
                    <li>📧Beskeder</li>
                    <li>🔖Bogmærker</li>
                    <li>📄Lister</li>
                    <li>👤Profil</li>
                    <li>💠Mere</li>

                    <!-- modal knap -->
                    <button class="pipBTN mx-auto" data-toggle="modal" data-target="#modal">Pip</button>

                </div>
            </div>

            <!-- modal -->
            <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="modallabel" aria-hidden="true">
                <div class="modal-dialog" role="document ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Send et pip</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true ">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action="insert-API.php" method="post">
                                <!-- username -->
                                <textarea type="text" id="modalUsername" name="username" maxlength="255" placeholder="Brugernavn"></textarea>
                                <!-- textarea -->
                                <textarea type="text" id="modalText" maxlength="255" name="message" placeholder="Hvad sker der?"></textarea>
                                <input type="submit" name="button" class="btn pipBTNModal">
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <!-- pip area -->
            <div class="col-6 order-2 pt-3" id="main">
                <h1 class="bold">Forside</h1>


                <?php
                // giver $servername dbname osv, evt tilpas til egen sti/path
                $pdo = require 'connect.php';



                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $db_username, $db_password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    // Tager alle rows fra "pips" og sorterer dem fra højest id til lavest
                    $sql = "SELECT * FROM pips ORDER BY id DESC";



                    $statement = $conn->prepare($sql);

                    $statement->execute();



                    $pips = $statement->fetchAll(PDO::FETCH_ASSOC);

                    // laver et laver et loop der kører for hver pip der er lavet (definere pip udfra pips)
                    foreach ($pips as $pip) { ?>

                        <div class="border border-bottom-0 pt-1 pb-3">
                            <div class="row d-flex justify-content-center">

                                <div class="col-2 d-flex justify-content-center">


                                    <!-- Først laves unikt id fra pip[id]+pic - derefter gør vi at hvert brugernavn(fra dicebear) har et unikt billede  -->
                                    <img id="<?php echo htmlspecialchars($pip['id']) . "pic" ?>" src="https://avatars.dicebear.com/api/adventurer/<?php echo htmlspecialchars($pip['name']) ?>.svg?r=50&b=lightgrey" alt="" height="60px">
                                </div>
                                <div class="col">


                                    <!-- Laver en h4, hvis id kommer fra databasen - samt får brugerneavnet fra databasen -->
                                    <h4 id="<?php echo htmlspecialchars($pip['id']) ?>"> <?php echo htmlspecialchars($pip['name']); ?> </h4>

                                    <!-- Henter beskeden fra pippet i databaen og fremviser den på siden i et p tag -->
                                    <p> <?php echo htmlspecialchars($pip['content']); ?> </p>
                                </div>
                            </div>

                        </div>


                <?php }
                }
                // Laver en catch exception, hvis det går noget galt
                catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
                ?>
            </div>
            <!-- right col -->

            <!-- DEKORATION -->
            <div class="col-3 order-3" id="right">
                <button class="search mt-3">
                    Søg på pipper
                </button>

                <div class="filler mt-2 border">
                    <br>
                    <h4>Trends til dig</h4>
                    <br>
                    <br>


                    <p class="mb-1">Nyheder · Trending</p>
                    <h5 class="">#NogetNyt</h5>
                    <p>6.482 pips</p>
                    <br>
                    <br>

                    <p class="mb-1">Shrek · Trending</p>
                    <h5>#Shrek</h5>
                    <p>69.420 pips</p>
                    <br>
                    <br>

                    <p class="mb-1">Sport · Trending</p>
                    <h5>#RealMadrid</h5>
                    <p>1 pips</p>
                    <br>
                    <br>

                    <p class="mb-1">Sport · Trending</p>
                    <h5>#FCBARCELONA</h5>
                    <p>3.236.482 pips</p>

                </div>
            </div>
        </div>
    </div>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js " integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js " integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js " integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl " crossorigin="anonymous "></script>
</body>

</html>