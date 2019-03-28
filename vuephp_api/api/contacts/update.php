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
    // Get ID of the contact to update
    $data = json_decode(file_get_contents("php://input"));
    // Set contact property values
    $contact->id = $data->id;
    $contact->username = $data->username;
    $contact->email = $data->email;
    $contact->city = $data->city;
    $contact->country = $data->country;
    $contact->job = $data->job;
    // Update the contact
    if($contact->update()){
        // http code
        http_response_code(200);
        // Communicates with the user
        echo json_encode(array("message"=>"Contact info updated"));
    }
    // If unable to update the product, tell the user
    else {
        // http code
        http_response_code(503);
        // Communicates with the user
        echo json_encode(array("message"=>"Unable to update contact info"));
    }
?>