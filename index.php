<?php

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
        ]

    ];
$filtered_hotels = $hotels;
$filter_vote = $_GET["number-stars"] ?? "";
$filter_parking = $_GET["parking"] ?? "";
//se filter_parking è unguale a 1 stampo tutti gli hotel che hanno parking true
if($filter_parking == "1"){
    $filtered_hotels = [];
    for($i = 0; $i < count($hotels); $i++){
        $current_hotel = $hotels[$i]; 
            if($current_hotel["parking"]){
                $filtered_hotels[] = $current_hotel;      
        }
    } 
    // $filtered_hotels = array_filter($filtered_hotels, fn ($hotel) => $hotel["parking"]);

    //Altrimenti Se è uguale a 0 stampo tutti gli hotel che hanno parking false
} elseif($filter_parking == "0"){
    $filtered_hotels = [];
    for($i = 0; $i < count($hotels); $i++){
        $current_hotel = $hotels[$i]; 
            if(!$current_hotel["parking"]){
                $filtered_hotels[] = $current_hotel;      
        }
    } 
    // $filtered_hotels = array_filter($filtered_hotels, fn ($hotel) => !$hotel["parking"]);
    var_dump($filtered_hotels);
}
//se filter_vote non è vuoto stampo tutti gli hotel che hanno vote maggiore uguale al valore di filter_vote
if(!empty($filter_vote)){
    $filter_vote = intval($filter_vote);
    $vote_hotels = [];
    for($i = 0; $i < count($filtered_hotels); $i++){
        $current_hotel = $filtered_hotels[$i]; 
            if($current_hotel["vote"] >= $filter_vote){
                $vote_hotels[] = $current_hotel;      
        }
    }
    $filtered_hotels = $vote_hotels;
    // $filtered_hotels = array_filter($filtered_hotels, fn ($hotel) => !$hotel["vote"] >= intval($filter_vote));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="GET">
        <div>
            <label for="number-stars">numero di stelle </label>
            <select name="number-stars" id="number-stars">
                <option value="">Tutti</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div>
            <label for="parcking">Con Parcheggio?</label>
            <select name="parking" id="parking">
                <option value="">Tutti</option>
                <option value="1">Si</option>
                <option value="0">No</option>
            </select>
        </div>
        <button type="submit"> Cerca </button>
    </form>
<table class="table table-striped-columns">
  <thead>
    <tr>
      <th scope="col">#Hotel</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Parking</th>
      <th scope="col">Vote</th>
      <th scope="col">Distance to center</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        for($i = 0; $i < count($filtered_hotels); $i++){
          $cur_hotel = $filtered_hotels[$i]; 
    ?>
     <tr>
      <th scope="row"><?php echo $i + 1;?></th>
      <?php 
            foreach ($cur_hotel as $key => $value) {
        ?>
        <td>
            <?php
                if($key === 'parking'){
                    if($value){
                        echo "si";
                    }else{
                        echo "no";
                    }
                }else{
                    echo $value;
                } 
            ?>
        </td>
        <?php }?>
    </tr>
    <?php }?>
  </tbody>
</table>
</body>
</html>