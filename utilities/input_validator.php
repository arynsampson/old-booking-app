<?php

    class InputValidator {
        private $input;
        private $errors;

        public function __construct($input, $errors) {
            $this->input = $input;
            $this->errors = $errors;
        }

        public function validateForm() {

            function validateName($name) {
                    return $name = trim(htmlspecialchars($name));
            }

            function errorCheck($name, $message, $strmin) {
                if(empty($name) || strlen($name) < $strmin) {
                    return $message;
                } else {
                    return;
                }
            }

            // check firstname for errors
            $this->errors['firstname'] = errorCheck($this->input['firstname'], "Please enter minimum 2 characters.", 2);
            if(!$this->errors['firstname']) {
                $this->input['firstname'] = validateName($this->input['firstname']);
            }

            // check surname for errors
            $this->errors['surname'] = errorCheck($this->input['surname'], "Please enter minimum 2 characters.", 2);
            if(!$this->errors['surname']) {
                $this->input['surname'] = validateName($this->input['surname']);
            }

            // check email for errors
            $this->errors['email'] = errorCheck($this->input['email'], 'Please enter minimum 4 characters.', 3);
            if(!$this->errors['email']) {
                // set email value to be returned
                $this->input['email'] = validateName($this->input['email']);
            }

            // validate hotel
             $this->errors['hotel'] = errorCheck($this->input['hotel'], 'Please pick a hotel.', 6);
            if(! $this->errors['hotel']) {
               $this->input['hotel'] = $this->input['hotel'];
            }
            
            // validate dates
            if(empty($this->input['checkInDate']) | empty($this->input['checkOutDate'])) {
                $this->errors['date'] = 'Please enter both dates.';
            } else {
                if(date("Y-m-d") > $this->input['checkInDate']) {
                    $this->errors['date'] = 'Check in date cannot be before today.';
                } else {
                    if($this->input['checkInDate'] > $this->input['checkOutDate']) {
                        $this->errors['date'] = 'Check in date should be before check out date.';
                    } else {
                        $this->input['checkInDate'] = $this->input['checkInDate'];
                        $this->input['checkOutDate'] = $this->input['checkOutDate'];
                    }
                }
            }
            return [$this->input, $this->errors];
        }
    }

 

?>