<?php
    
    session_start(); 

    $hotels = json_decode(file_get_contents(dirname(__DIR__).'/hotels/hotels.json'));
    $hotel_chosen;
    $hotel_to_compare;
    $final_hotel_choice;

    function dateDifference($date1, $date2) {
        $dateDifferenceAmount = date_diff(date_create($date1), date_create($date2));
        return $dateDifferenceAmount->format("%a");
    }

    // print_r($_SESSION);
    foreach($hotels as $hotel) {
        if($hotel->name !== $_SESSION['hotel']) {
            global $hotel_to_compare;
            $hotel_to_compare = array(
                'name' => $hotel->name,
                'dailyRate' => $hotel->dailyRate,
                'features' => $hotel->features,
            );
            // CHECK WHY RETURN BROKE THIS
        } else {
            global $hotel_chosen;
            $hotel_chosen = array(
                'name' => $hotel->name,
                'dailyRate' => $hotel->dailyRate,
                'features' => $hotel->features,
            );
        }
    }

    $_SESSION['numberOfDays'] = dateDifference($_SESSION['checkInDate'], $_SESSION['checkOutDate']);
    $_SESSION['totalCost'] = $_SESSION['numberOfDays'] * $hotel_chosen['dailyRate'];

    if($_POST['hotel'] === $hotel_chosen['name']) {
        global $final_hotel_choice;
        $final_hotel_choice = array(
            'firstname' => $_SESSION['firstname'],
            'surname' => $_SESSION['surname'],
            'email' => $_SESSION['email'],
            'chosenHotel' => $_SESSION['hotel'],
            'checkInDate' => $_SESSION['checkInDate'],
            'checkOutDate' => $_SESSION['checkOutDate'],
            'numberOfDays' => $_SESSION['numberOfDays'],
            'totalCost' => $_SESSION['totalCost'],
        );

        $_SESSION['userBooking'] = $final_hotel_choice;
        print_r($_SESSION['userBooking']);
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/styles.css?v=<?php echo time(); ?>">
    <title>Booking App</title>
</head>

<body>

    <div class="container">
    <p>Hi there, <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['surname']; ?></p>

        <div class="row">

            <div class="card col">
                <div class="card-body">
                    
                    <h5 class="card-title"><?php echo $_SESSION['hotel']; ?></h5>
                    <p class="card-text">Per night: R<?php echo $hotel_chosen['dailyRate']; ?></p>
                    <p class="card-text">Check-in: <?php echo $_SESSION['checkInDate']; ?></p>
                    <p class="card-text">Check-out: <?php echo $_SESSION['checkOutDate']; ?></p>

                    <ul>
                        <?php foreach($hotel_chosen['features'] as $feature): ?>
                            <li><?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>

            <div class="card col">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $hotel_to_compare['name']; ?></h5>
                    <p class="card-text">Per night R:<?php echo $hotel_to_compare['dailyRate']; ?></p>

                    <ul>
                        <?php foreach($hotel_to_compare['features'] as $feature): ?>
                            <li><?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    
                 </div>
            </div>

        </div>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <div>
                <label for="hotel" class="form-label">Select your hotel:</label>
                <select name="hotel" id="hotel" class="form-control">
                    <option value=""></option>
                    <option value="One&Only">One&amp;Only</option>
                    <option value="The Commodore">The Commodore</option>
                </select>
                <p class="error"><?php echo $errors['hotel'] ?? ''; ?></p>
            </div>

            <input type="submit" value="Book" name="submit">
        </form>
    </div>

</body>

</html>