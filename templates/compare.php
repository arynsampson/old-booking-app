<?php
    
    session_start(); 

    $hotels = json_decode(file_get_contents(dirname(__DIR__).'/hotels/hotels.json'));
    $hotel_chosen;
    $hotel_to_compare;

    // print_r($_SESSION);
    foreach($hotels as $hotel) {
        if($hotel->name !== $_SESSION['hotel']) {
            global $hotel_to_compare;
            $hotel_to_compare = array(
                'name' => $hotel->name,
                'dailyRate' => $hotel->dailyRate,
                'features' => $hotel->features,
                'starRating' => $hotel->starRating,
            );
            // CHECK WHY RETURN BROKE THIS
        } else {
            global $hotel_chosen;
            $hotel_chosen = array(
                'name' => $hotel->name,
                'dailyRate' => $hotel->dailyRate,
                'features' => $hotel->features,
                'starRating' => $hotel->starRating,
            );
        }
    }

?>


<div>
    <h3><?php echo $_SESSION['hotel']; ?></h3>
    <p><?php echo $_SESSION['firstname']; ?></p>
    <p><?php echo $_SESSION['surname']; ?></p>

    <div>
        <p><?php echo $_SESSION['checkInDate']; ?></p>
        <p><?php echo $_SESSION['checkOutDate']; ?></p>
    </div>

     <?php foreach($hotel_chosen['features'] as $feature): ?>
        <p><?php echo $feature; ?></p>
    <?php endforeach; ?>

    
</div>

<div>
    <h3><?php echo $hotel_to_compare['name']; ?></h3>
    <p>R<?php echo $hotel_to_compare['dailyRate']; ?></p>
    <p><?php echo $hotel_to_compare['starRating']; ?></p>

    <?php foreach($hotel_to_compare['features'] as $feature): ?>
        <p><?php echo $feature; ?></p>
    <?php endforeach; ?>
</div>