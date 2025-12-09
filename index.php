<?php             

    $i = 0;

    $hotels = [
        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4               
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2           
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],
    ];   
    
    // controllo filtro per parcheggio

    // mi creo una variabile per capire se i parcheggi sono richiesti o meno
    $parcking_requested = false;

    /*   
    if($_GET["parcking"] == "on"){
        echo "parcheggi richiesti";
    } 
    */
    // meglio con isset e operatore logico
    if( isset($_GET["parcking"]) && $_GET["parcking"] == "on"){
       // echo "parcheggi richiesti";
       $parcking_requested = true;
       
    };

    // controllo filtro per voto
    // mi creo una variabile per dare un valore iniziale di voto
    $minimun_vote = 0;

    // meglio con isset e operatore logico
    if( isset($_GET["minimumVoteHotel"]) && is_numeric($_GET["minimumVoteHotel"]) && $_GET["minimumVoteHotel"] > 0 && $_GET["minimumVoteHotel"] <= 5)  {
       
        // echo "voto minimo : " . $_GET["minimumVoteHotel"];
       $minimun_vote = (int)$_GET["minimumVoteHotel"]; // (int) per far diventare la variabile un numero
    };

    var_dump($minimun_vote);
                
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

    <header>
        <nav class="navbar bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="#">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/>
                        
                    </svg>
                    List Hotel
                </a>
                
            </div>
        </nav>
    </header>

    <main>
        <!-- Form -->
        <div id="fomr" class="container">
                    <h3 class="m-3">Find your best hotel</h3>
                    <form action="" class="m-3">
                        
                            <div class="d-flex m-3">

                                <div class="mb-3 form-control">
                                    <input type="checkbox" class="form-check-input" id="parcking" name="parcking">
                                    <label class="form-check-label" for="parcking">Parcking</label>
                                </div>
                                <div class="mb-3 form-control">
                                    <label for="minimumVoteHotel" class="form-label">Minimum rating</label>
                                    <input type="number" min="1" max="5" class="form-control" id="minimumVoteHotel" aria-describedby="minimumVoteHotel" name="minimumVoteHotel">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                            
                        </div>
                    </form>
        </div>   

        <!-- List Hotel -->
        <div id="list-hotel" class="container-fluid">
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Parcking</th>
                        <th scope="col">Vote</th>
                        <th scope="col">Distance to center</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($hotels as $hotel){
                            $i++;
                            // controlliamo se l'utente ha richiesto il parcheggio
                            // mostriamo solo gli hotel con il parcheggio

                            if($parcking_requested){
                                // controlliamo se l'hotel dell'iterazione non ha i parcheggi
                                if(!$hotel["parking"]){
                                    // saltiamo solo l'iterazione corrente del ciclo 
                                    // diverso da break che ti fa uscire dal ciclo
                                    continue;
                                }
                            };
                            
                            if ($hotel["vote"] < $minimun_vote){
                                // controlliamo anche che il voto minimo non sia inferiore a quello dell'hotel dell'iterazione
                                continue;
                            } 

                            ?>
                            <!-- First correction
                                <tr>
                                    <th scope="row"><?php echo $i  ?></th>
                                    <?php
                                foreach ($hotel as $key => $value){
                                    
                                    echo "<td> $value </td>"; 
                                    
                                }
                                ?>
                            </tr>
                            -->
                            <tr>
                                <th scope="row"><?php echo $i  ?></th>
                                <td><?php echo $hotel["name"] ?></td>
                                <td><?php echo $hotel["description"] ?></td>
                                <td>
                                    <!-- Output migliore per parcking con il ternario-->
                                    <?php 
                                        echo $hotel["parking"] ? "Presente" : "Assente"
                                    ?>
                                </td>
                                <td><?php echo $hotel["vote"] ?></td>
                                <td><?php echo $hotel["distance_to_center"] ?></td>
                            </tr>    
                        <?php    
                        };
                        ?>
                </tbody>
            </table> 
        </div>
    </main>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>