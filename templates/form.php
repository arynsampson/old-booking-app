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


<div class="content-container">

    <h1>Hotel <span id="heading-colour">Reservations</span></h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="form-grid">

            <div>
                <label for="firstname" class="form-label">First name:</label>
                <input type="text" class="form-control" name="firstname" placeholder="Please enter your name" value="<?php echo htmlspecialchars($_POST['firstname'] ?? ''); ?>">
                <p class="error"><?php echo $errors['firstname'] ?? ''; ?></p>
            </div>

            <div>
                <label for="surname" class="form-label">Surname:</label>
                <input type="text" class="form-control" name="surname" placeholder="Please enter your surname" value="<?php echo htmlspecialchars($_POST['surname'] ?? ''); ?>">
                <p class="error"><?php echo $errors['surname'] ?? ''; ?></p>
            </div>

            <div>
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" placeholder="Please enter your email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                <p class="error"><?php echo $errors['email'] ?? ''; ?></p>
            </div>

            <div>
                <label for="hotel" class="form-label">Select your hotel:</label>
                <select name="hotel" id="hotel" class="form-control">
                    <option value=""></option>
                    <option value="One&Only">One&amp;Only</option>
                    <option value="The Commodore">The Commodore</option>
                </select>
                <p class="error"><?php echo $errors['hotel'] ?? ''; ?></p>
            </div>

            <div>
                <label for="checkInDate" class="form-label">Check-in:</label>
                <input type="date" class="form-control" name="checkInDate" value="<?php echo htmlspecialchars($_POST['checkInDate'] ?? ''); ?>">
            </div>

            <div>
                <label for="checkOutDate" class="form-label">Check-out:</label> 
                <input type="date" class="form-control" name="checkOutDate" id="checkOutDate" value="<?php echo htmlspecialchars($_POST['checkOutDate'] ?? ''); ?>">
            </div>
                <p class="error"><?php echo $errors['date'] ?? ''; ?></p>
            
            <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        </div>
    </form>
</div>