<?php
require_once 'Database.php';
require_once 'EmailSender.php';

class RegistrationHandler
{
    private $username;
    private $usernameErr;

    private $password;
    private $confirmPassword;
    private $confirmPasswordErr;

    private $name;
    private $nameErr;

    private $email;
    private $emailErr;

    private $telephone;
    private $telephoneErr;

    private $address1;
    private $address1Err;

    private $address2;
    private $address2Err;

    private $state;
    private $stateErr;

    private $city;
    private $cityErr;

    private $postalCode;
    private $postalCodeErr;

    private $successMessage;
    private $errorMessage;

    private $db;
    private $emailSender;

    public function __construct()
    {
        $this->username = $this->confirmPassword = $this->name = $this->email = $this->telephone = $this->address1 = $this->address2 = $this->state = $this->city = $this->postalCode = "";
        $this->usernameErr = $this->confirmPasswordErr = $this->nameErr = $this->emailErr = $this->telephoneErr = $this->address1Err = $this->address2Err = $this->stateErr = $this->cityErr = $this->postalCodeErr = "";
        $this->successMessage = "";
        $this->errorMessage = "";

        // Initialize Database
        $this->db = new Database();

        // Initialize EmailSender
        $this->emailSender = new EmailSender();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->validateForm();
        }
    }

    private function validateForm()
    {
        // Validate username
        if (empty(trim($_POST["username"]))) {
            $this->usernameErr = "Username is required.";
        } else {
            $this->username = trim($_POST["username"]);
        }

        // Validate name
        if (empty(trim($_POST["name"]))) {
            $this->nameErr = "Name is required.";
        } else {
            $this->name = trim($_POST["name"]);
        }

        // Validate email
        if (empty(trim($_POST["email"]))) {
            $this->emailErr = "Email is required.";
        } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
            $this->emailErr = "Invalid email format.";
        } else {
            $this->email = trim($_POST["email"]);
        }

        // Validate confirm password
        $this->password = trim($_POST["password"]);
        if (empty(trim($_POST["confirm_password"]))) {
            $this->confirmPasswordErr = "Please confirm your password.";
        } elseif (trim($_POST["confirm_password"]) !== $this->password) {
            $this->confirmPasswordErr = "Passwords do not match.";
        } else {
            $this->confirmPassword = sha1(trim($_POST["confirm_password"]));
        }

        $this->telephone = trim($_POST["telephone"]);
        $this->address1 = trim($_POST["address_1"]);
        $this->address2 = trim($_POST["address_2"]);
        $this->state = trim($_POST["state"]);
        $this->city = trim($_POST["city"]);
        $this->postalCode = trim($_POST["postal_code"]);

        // If no errors, process data
        if (empty($this->usernameErr) && empty($this->nameErr) && empty($this->emailErr) && empty($this->confirmPasswordErr)) {
            // Here you can save the data to a database
            $this->saveData();
        }
    }

    private function sendEmailToRegisteredUser()
    {
        try {
            /**
             * Email details
             */
            $from = 'marwin@tracketeer.com';
            $fromName = 'TracketeerExam';
            $to = $this->email;
            $subject = 'Thank You!';
            $body = "Welcome, {$this->name}! Thank you for registering!";

            $result = $this->emailSender->sendEmail($from, $fromName, $to, $subject, $body);

            if ($result === true) {
                /**
                 * Do something
                 */
            } else {
                /**
                 * Do something when error
                 */
            }
        } catch (Exception $e) {
            $this->errorMessage = $e->getMessage();
        }
    }

    private function saveData()
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO users (username, password, name, email, telephone, address1, address2, state, city, postal_code) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $stmt->bind_param("ssssssssss",
                $this->username,
                $this->confirmPassword,
                $this->name,
                $this->email,
                $this->telephone,
                $this->address1,
                $this->address2,
                $this->state,
                $this->city,
                $this->postalCode
            );

            if ($stmt->execute()) {
                $this->successMessage = "Thank you, {$this->name}! Your message has been sent.";
                // Here you can send an email to user
                $this->sendEmailToRegisteredUser();

                // Clear the fields
                $this->username = $this->confirmPassword = $this->name = $this->email = $this->telephone = $this->address1 = $this->address2 = $this->state = $this->city = $this->postalCode = "";
            } else {
                $this->successMessage = "Error: " . $stmt->error;
            }

            $stmt->close();
            $this->db->close();
        } catch (Exception $e) {
            $this->errorMessage = $e->getMessage();
        }
    }


    public function getUsername()
    {
        return $this->username;
    }

    public function getUsernameError()
    {
        return $this->usernameErr;
    }

    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    public function getConfirmpasswordError()
    {
        return $this->confirmPasswordErr;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNameError()
    {
        return $this->nameErr;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getEmailError()
    {
        return $this->emailErr;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getTelephoneError()
    {
        return $this->telephoneErr;
    }

    public function getAddress1()
    {
        return $this->address1;
    }

    public function getAddress1Error()
    {
        return $this->address1Err;
    }

    public function getAddress2()
    {
        return $this->address2;
    }

    public function getAddress2Error()
    {
        return $this->address2Err;
    }
    
    public function getCity()
    {
        return $this->city;
    }

    public function getCityError()
    {
        return $this->cityErr;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getStateError()
    {
        return $this->stateErr;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function getPostalCodeError()
    {
        return $this->postalCodeErr;
    }

    public function getSuccessMessage()
    {
        return $this->successMessage;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}