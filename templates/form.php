<?php

    session_start();

    require_once './utilities/input_validator.php';

    if (isset($_POST['submit'])) {

        $data = array(
                'firstname' => '',
                'surname' => '',
                'email' => '',
                'hotel' => '',
                'dates' => ''
            );
        // validate user input
        $validation = new InputValidator($_POST, $data);
        $formData = $validation->validateForm();

        // check if errors are present
        if(!array_filter($formData[1])) {
            // assign input to SESSION
            foreach($formData[0] as $key => $value) {
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
                <input type="text" class="form-control" name="firstname" placeholder="Please enter your name" value="<?php echo htmlspecialchars($formData[0]['firstname'] ?? ''); ?>">
                <p class="error"><?php echo $formData[1]['firstname'] ?? ''; ?></p>
            </div>

            <div>
                <label for="surname" class="form-label">Surname:</label>
                <input type="text" class="form-control" name="surname" placeholder="Please enter your surname" value="<?php echo htmlspecialchars($formData[0]['surname'] ?? ''); ?>">
                <p class="error"><?php echo $formData[1]['surname'] ?? ''; ?></p>
            </div>

            <div>
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" placeholder="Please enter your email" value="<?php echo htmlspecialchars($formData[0]['email'] ?? ''); ?>">
                <p class="error"><?php echo $formData[1]['email'] ?? ''; ?></p>
            </div>

            <div>
                <label for="hotel" class="form-label">Select your hotel:</label>
                <select name="hotel" id="hotel" class="form-control">
                    <option value=""></option>
                    <option value="One&Only">One&amp;Only</option>
                    <option value="The Commodore">The Commodore</option>
                </select>
                <p class="error"><?php echo $formData[1]['hotel'] ?? ''; ?></p>
            </div>

            <div>
                <label for="checkInDate" class="form-label">Check-in:</label>
                <input type="date" class="form-control" name="checkInDate" value="<?php echo htmlspecialchars($formData[0]['checkInDate'] ?? ''); ?>">
            </div>

            <div>
                <label for="checkOutDate" class="form-label">Check-out:</label> 
                <input type="date" class="form-control" name="checkOutDate" id="checkOutDate" value="<?php echo htmlspecialchars($formData[0]['checkOutDate'] ?? ''); ?>">
            </div>
                <p class="error"><?php echo $formData[1]['date'] ?? ''; ?></p>
            
            <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        </div>
    </form>
</div>