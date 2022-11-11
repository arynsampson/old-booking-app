<?php


?>


<div>

    <h3>Hotel Reservations</h3>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div>
            <label for="firstname">First name:</label>
            <input type="text" name="firstname" placeholder="Please enter your name" required>
        </div>

        <div>
            <label for="surname">Surname:</label>
            <input type="text" name="surname" placeholder="Please enter your surname" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="text" name="email" placeholder="Please enter your email" required>
        </div>

        <div>
            <label for="hotel">Select your hotel by clicking the dropdown menu below:</label>
            <select name="hotel" id="hotel" required>
                <option value=""></option>
                <option value="oneandonly">One&amp;Only</option>
                <option value="commodore">The Commodore Hotel</option>
            </select>
        </div>

        <div>
            <label for="checkIn">Check-in:</label>
            <input type="date" name="checkIn" required>
        </div>

        <div>
            <label for="checkOut">Check-out:</label>
            <input type="date" name="checkOut" required>
        </div>
    </form>
</div>