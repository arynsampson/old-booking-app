<?php

require('input_validator.php');

    $firstname = $surname = $email = $hotel = $date = '';
    $errors = array(
        'firstname' => '',
        'surname' => '',
        'email' => '',
        'hotel' => '',
        'date' => ''
    );

    if (isset($_POST['submit'])) {

        // validate user input

        // validate firstname 
        if(empty($_POST['firstname']) | strlen($_POST['firstname'] < 2)) {
            $errors['firstname'] = 'Please enter a valid name with at 2 characters.';
        } else {
            $firstname = $_POST['firstname'];
        }

        // validate surname
        if(empty($_POST['surname']) | strlen($_POST['surname'] < 2)) {
            $errors['surname'] = 'Please enter a valid surname with at 2 characters.';
        } else {
            $surname = $_POST['surname'];
        }

        // validate email
        if(empty($_POST['email']) | strlen($_POST['email'] < 2)) {
            $errors['email'] = 'Please enter a valid email with at 2 characters.';
        } else {
            $email = $_POST['email'];
        }

        // validate hotel
        if(empty($_POST['hotel'])) {
            $errors['hotel'] = 'Please pick a hotel.';
        } else {
            $hotel = $_POST['hotel'];
        }

        // validate dates
        if(empty($_POST['checkInDate']) | empty($_POST['checkOutDate'])) {
            $errors['date'] = 'Please enter both dates.';
        } else {
            if($_POST['checkInDate'] < $_POST['checkOutDate']) {
                $errors['date'] = 'Check in date should be before check out date.';
            }
        }
        
        //save user input
        
        // direct user to next screen
    }

?>


<div>

    <h3>Hotel Reservations</h3>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div>
            <label for="firstname">First name:</label>
            <input type="text" name="firstname" placeholder="Please enter your name">
            <p class="error"><?php echo $errors['firstname']; ?></p>
        </div>

        <div>
            <label for="surname">Surname:</label>
            <input type="text" name="surname" placeholder="Please enter your surname">
            <p class="error"><?php echo $errors['surname']; ?></p>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="text" name="email" placeholder="Please enter your email">
            <p class="error"><?php echo $errors['email']; ?></p>
        </div>

        <div>
            <label for="hotel">Select your hotel by clicking the dropdown menu below:</label>
            <select name="hotel" id="hotel">
                <option value=""></option>
                <option value="oneandonly">One&amp;Only</option>
                <option value="commodore">The Commodore Hotel</option>
            </select>
            <p class="error"><?php echo $errors['hotel']; ?></p>
        </div>

        <div>
            <label for="checkInDate">Check-in:</label>
            <input type="date" name="checkInDate">
        </div>

        <div>
            <label for="checkOutDate">Check-out:</label>
            <input type="date" name="checkOutDate">
        </div>
        <p class="error"><?php echo $errors['date']; ?></p>

        <input type="submit" value="Submit" name="submit">
    </form>
</div>