<?php

    // stay in number of days
    function dateDifference($date1, $date2) {
        $dateDifferenceAmount = date_diff(date_create($date1), date_create($date2));
        return $dateDifferenceAmount->format("%a");
    }

    // set hotel details
    function setHotel($hotel, $numberOfDays) {
        $hotel = array(
                'name' => $hotel->name,
                'dailyRate' => $hotel->dailyRate,
                'features' => $hotel->features,
                'totalCost' => totalStayCost($numberOfDays, $hotel->dailyRate)
            );
        return $hotel;
    }

    // calculate the cost of stay
    function totalStayCost($numOfDays, $dailyRate) {
        return $numOfDays * $dailyRate;
    }


    // user booking information
    function userFinalBookingInfo($bookingInfo, $hotelChosen, $hotelRate) {
        return array(
            'firstname' => $bookingInfo['firstname'],
            'surname' => $bookingInfo['surname'],
            'email' => $bookingInfo['email'],
            'chosenHotel' => $hotelChosen,
            'checkInDate' => $bookingInfo['checkInDate'],
            'checkOutDate' => $bookingInfo['checkOutDate'],
            'numberOfDays' => $bookingInfo['numberOfDays'],
            'totalCost' => $bookingInfo['numberOfDays'] * $hotelRate
        );
    }

?>