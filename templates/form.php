<?php

    session_start();

    require('input_validator.php');

    if (isset($_POST['submit'])) {

        // validate user input
        $validation = new InputValidator($_POST);
        $errors = $validation->validateForm();
        

        // check if errors are present
        if(!array_filter($errors)) {
            // assign input to SESSION
            foreach($_POST as $key => $value) {
                $_SESSION[$key] = $value;
            }
            // direct user to next screen
            header('Location: templates/compare.php');
        }
    }
?>


<div>

    <h3>Hotel Reservations</h3>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div>
            <label for="firstname">First name:</label>
            <input type="text" name="firstname" placeholder="Please enter your name" value="<?php echo htmlspecialchars($_POST['firstname'] ?? ''); ?>">
            <p class="error"><?php echo $errors['firstname'] ?? ''; ?></p>
        </div>

        <div>
            <label for="surname">Surname:</label>
            <input type="text" name="surname" placeholder="Please enter your surname" value="<?php echo htmlspecialchars($_POST['surname'] ?? ''); ?>">
            <p class="error"><?php echo $errors['surname'] ?? ''; ?></p>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Please enter your email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            <p class="error"><?php echo $errors['email'] ?? ''; ?></p>
        </div>

        <div>
            <label for="hotel">Select your hotel by clicking the dropdown menu below:</label>
            <select name="hotel" id="hotel">
                <option value=""></option>
                <option value="oneandonly">One&amp;Only</option>
                <option value="commodore">The Commodore Hotel</option>
            </select>
            <p class="error"><?php echo $errors['hotel'] ?? ''; ?></p>
        </div>

        <div>
            <label for="checkInDate">Check-in:</label>
            <input type="date" name="checkInDate" value="<?php echo htmlspecialchars($_POST['checkInDate'] ?? ''); ?>">
        </div>

        <div>
            <label for="checkOutDate">Check-out:</label>
            <input type="date" name="checkOutDate" value="<?php echo htmlspecialchars($_POST['checkOutDate'] ?? ''); ?>">
        </div>
        <p class="error"><?php echo $errors['date'] ?? ''; ?></p>

        <input type="submit" value="Submit" name="submit">
    </form>
</div>