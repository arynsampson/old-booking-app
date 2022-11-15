<?php
    
    require('../hotel_functions/hotel_functions.php');

    session_start(); 

    $hotels = json_decode(file_get_contents(dirname(__DIR__).'/mock_data/hotels.json'));
    $hotel_chosen = $hotel_to_compare = $final_hotel_choice = [];

    // print_r($_SESSION);
    foreach($hotels as $hotel) {
        global $hotel_to_compare;
        if($hotel->name !== $_SESSION['hotel']) {
            $hotel_to_compare = setHotel($hotel);
        } else {
            $hotel_chosen = setHotel($hotel);
        }
    }

    $_SESSION['numberOfDays'] = dateDifference($_SESSION['checkInDate'], $_SESSION['checkOutDate']);
    $_SESSION['totalCost'] = totalStayCost($_SESSION['numberOfDays'], $hotel_chosen['dailyRate']);

    if(isset($_POST['submit'])) {
        global $final_hotel_choice;
        if($_POST['hotel'] === $hotel_chosen['name']) {
            $final_hotel_choice = userFinalBookingInfo($_SESSION, $hotel_chosen['name'], $hotel_chosen['dailyRate']);
        } else {
            $final_hotel_choice = userFinalBookingInfo($_SESSION, $hotel_to_compare['name'], $hotel_to_compare['dailyRate']);
        }
        $_SESSION['userBooking'] = $final_hotel_choice;
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
    <link rel="stylesheet" href="../styles/compare.css">

    <title>Booking App</title>
</head>

<body>

    <div class="container">
    <h2>Hi there, <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['surname']; ?></h2>

        <div class="row">

            <div class="card col">
                <div class="card-body">
                    
                    <h5 class="card-title"><?php echo $_SESSION['hotel']; ?></h5>
                    <p class="card-text">Per night: R<?php echo $hotel_chosen['dailyRate']; ?></p>
                    <p class="card-text">Check-in: <?php echo $_SESSION['checkInDate']; ?></p>
                    <p class="card-text">Check-out: <?php echo $_SESSION['checkOutDate']; ?></p>

                    <ul>
                        <?php foreach($hotel_chosen['features'] as $feature): ?>
                            <li class="pill"><?php echo $feature; ?></li>
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
                            <li class="pill"><?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    
                 </div>
            </div>

        </div>

       
    </div>

    <div class="form-container">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <div>
                <label for="hotel" class="form-label">Select your hotel:</label>
                <select name="hotel" id="hotel" class="form-control">
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