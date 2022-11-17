<?php
    
    require_once '../utilities/hotel_utils.php';

    session_start(); 

    $hotels = json_decode(file_get_contents(dirname(__DIR__).'/mock_data/hotels.json'));
    $hotelChosen = $hotelToCompare = $final_hotel_choice = [];
    $_SESSION['numberOfDays'] = dateDifference($_SESSION['checkInDate'], $_SESSION['checkOutDate']);

    foreach($hotels as $hotel) {
        global $hotelToCompare;
        if($hotel->name !== $_SESSION['hotel']) {
            $hotelToCompare = setHotel($hotel, $_SESSION['numberOfDays']);
        } else {
            $hotelChosen = setHotel($hotel, $_SESSION['numberOfDays']);
        }
    }

    if(isset($_POST['submit'])) {
        global $final_hotel_choice;
        if($_POST['hotel'] === $hotelChosen['name']) {
            $final_hotel_choice = userFinalBookingInfo($_SESSION, $hotelChosen['name'], $hotelChosen['dailyRate']);
        } else {
            $final_hotel_choice = userFinalBookingInfo($_SESSION, $hotelToCompare['name'], $hotelToCompare['dailyRate']);
        }
        $_SESSION['userBooking'] = $final_hotel_choice;
        session_destroy();
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/compare.css">

    <title>Booking App</title>
</head>

<body>

    <div class="container">
    <h2>Hi there, <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['surname']; ?></h2>

        <div class="row">

            <div class="card col">
                <div class="card-body">
                    
                    <h5 class="card-title"><?php echo $hotelChosen['name']; ?></h5>
                    <p class="card-text">Per night: R<?php echo $hotelChosen['dailyRate']; ?></p>
                    <p class="card-text">Check-in: <?php echo $_SESSION['checkInDate']; ?></p>
                    <p class="card-text">Check-out: <?php echo $_SESSION['checkOutDate']; ?></p>
                    <p class="card-text">Total: R<?php echo $hotelChosen['totalCost']; ?></p>

                    <ul>
                        <?php foreach($hotelChosen['features'] as $feature): ?>
                            <li class="pill"><?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>

            <div class="card col">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $hotelToCompare['name']; ?></h5>
                    <p class="card-text">Per night R:<?php echo $hotelToCompare['dailyRate']; ?></p>
                    <p class="card-text">Check-in: <?php echo $_SESSION['checkInDate']; ?></p>
                    <p class="card-text">Check-out: <?php echo $_SESSION['checkOutDate']; ?></p>
                    <p class="card-text">Total: R<?php echo $hotelToCompare['totalCost']; ?></p>

                    <ul>
                        <?php foreach($hotelToCompare['features'] as $feature): ?>
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