<?php

    class InputValidator {
        private $data;
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

            echo $this->data['firstname'];

        // validate firstname 
        if(!empty($this->data['firstname']) && strlen($this->data['firstname']) < 2) {
            $this->errors['firstname'] = 'Please enter a valid name with minimum 2 characters.';
        } else {
            $_POST['firstname'] = $this->data['firstname'];
        }

        // validate surname 
        if(!empty($this->data['surname']) && strlen($this->data['surname']) < 2) {
            $this->errors['surname'] = 'Please enter a valid surname with minimum 2 characters.';
        } else {
            $_POST['surname'] = $this->data['surname'];
        }

        // validate email
        if(!empty($this->data['email']) && strlen($this->data['email']) < 2) {
            $this->errors['email'] = 'Please enter a valid email.';
        } else {
            $_POST['email'] = $this->data['email'];
        }

        // validate hotel
        if(empty($this->data['hotel'])) {
            $this->errors['hotel'] = 'Please pick a hotel.';
        } else {
            $_POST['hotel'] = $this->data['hotel'];
        }

        // validate dates
        if(empty($this->data['checkInDate']) | empty($this->data['checkOutDate'])) {
            $this->errors['date'] = 'Please enter both dates.';
        } else {
            if($this->data['checkInDate'] > $this->data['checkOutDate']) {
                $this->errors['date'] = 'Check in date should be before check out date.';
            } else {
                $_POST['checkInDate'] = $this->data['checkInDate'];
                $_POST['checkOutDate'] = $this->data['checkOutDate'];
            }
        }
            return $this->errors;
        }
    }

 

?>