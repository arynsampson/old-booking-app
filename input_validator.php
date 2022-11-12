<?php

    class InputValidator {
        private $data;
        private $firstname = '';
        private $surname = '';
        private $email = '';
        private $hotel = '';
        private $date = '';
        private $errors = array(
        'firstname' => '',
        'surname' => '',
        'email' => '',
        'hotel' => '',
        'date' => ''
    );

        public function __construct($input) {
            $this->data = $input;
        }

        public function validateForm() {

        // validate firstname 
        if(empty($this->data['firstname']) | strlen($this->data['firstname'] < 2)) {
            $this->errors['firstname'] = 'Please enter a valid name with at 2 characters.';
        } else {
            $this->firstname = $this->data['firstname'];
        }

        // validate surname 
        if(empty($this->data['surname']) | strlen($this->data['surname'] < 2)) {
            $this->errors['surname'] = 'Please enter a valid surname with at 2 characters.';
        } else {
            $this->surname = $this->data['surname'];
        }

        // validate email
        if(empty($this->data['email']) | strlen($this->data['email'] < 2)) {
            $this->errors['email'] = 'Please enter a valid email with at 2 characters.';
        } else {
            $this->email = $this->data['email'];
        }

        // validate hotel
        if(empty($this->data['hotel'])) {
            $this->errors['hotel'] = 'Please pick a hotel.';
        } else {
            $this->hotel = $this->data['hotel'];
        }

        // validate dates
        if(empty($this->data['checkInDate']) | empty($this->data['checkOutDate'])) {
            $this->errors['date'] = 'Please enter both dates.';
        } else {
            if($this->data['checkInDate'] < $this->data['checkOutDate']) {
                $this->errors['date'] = 'Check in date should be before check out date.';
            }
        }

            return $this->errors;
        }
    }

 

?>