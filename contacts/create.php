<?php
    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    // Includes
    include_once '../config/database.php';
    include_once '../objects/contacts.php';
    // Instantiate Database
    $database = new Database();
    $db = $database->getConnection();
    // Initialize new Contact object
    $contact = new Contacts($db);
    // Get Posted Data
    $data = json_decode(file_get_contents("php://input"));
    // Verification that data is not empty
    if (
        !empty($data->username) &&
        !empty($data->email) &&
        !empty($data->city) &&
        !empty($data->country) &&
        !empty($data->job)
    ) {
        // Set Contact propertiy values
        $contact->username =$data->username;
        $contact->email =$data->email;
        $contact->city =$data->city;
        $contact->country =$data->country;
        $contact->job =$data->job;
        // Creates the contact
        if($contact->create()){
            // Set http code
            http_response_code(201);
            // Communicate with the user
            echo json_encode(array("message"=>"Contact created"));
        } 
        // If Unable to create the Contact
        else {
            // Set http code
            http_response_code(503);
            // Communicate with the user
            echo json_encore(array("message"=>"Service unavailable"));
        }
    } 
    // If data sent by user is incomplete
    else {
        // Set http code
        http_response_code(400);
        // Communicate with the user
        echo json_encore(array("message"=>"Unable to create the contact - Data incomplete"));
    }
?>