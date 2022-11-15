<?php

    // stay in number of days
    function dateDifference($date1, $date2) {
        $dateDifferenceAmount = date_diff(date_create($date1), date_create($date2));
        return $dateDifferenceAmount->format("%a");
    }

    // set hotel details
    function setHotel($hotel) {
        $hotel = array(
                'name' => $hotel->name,
                'dailyRate' => $hotel->dailyRate,
                'features' => $hotel->features,
            );
        return $hotel;
    }

    // calculate the cost of stay
    function totalStayCost($numOfDays, $dailyRate) {
        return $numOfDays * $dailyRate;
    }


    // user booking information
    function userFinalBookingInfo($booking_info, $hotel_chosen, $hotel_rate) {
        return array(
            'firstname' => $booking_info['firstname'],
            'surname' => $booking_info['surname'],
            'email' => $booking_info['email'],
            'chosenHotel' => $hotel_chosen,
            'checkInDate' => $booking_info['checkInDate'],
            'checkOutDate' => $booking_info['checkOutDate'],
            'numberOfDays' => $booking_info['numberOfDays'],
            'totalCost' => $booking_info['numberOfDays'] * $hotel_rate
        );
    }

?>