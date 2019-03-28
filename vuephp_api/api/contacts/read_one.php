<?php
    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    // Includes
    include_once '../config/database.php';
    include_once '../objects/contacts.php';
    // Instantiate Database
    $database = new Database();
    $db = $database->getConnection();
    // Initialize Contacts object
    $contact = new Contacts($db);
    // Set ID property of the object if the request is made
    $contact->id = isset($_GET['id']) ? $_GET['id'] : die();
    // Calls readOne method of the Contact
    $contact->readOne();
    // Verify if the query returned something
    if($contact->username != null){
        // Create the array that will be sent to the client
        $contact_arr=array(
            "id" => $contact->id,
            "username" => $contact->username,
            "email" => $contact->email,
            "city" => $contact->city,
            "country" => $contact->country,
            "job" => $contact->job
        );
        // http code
        http_response_code(200);
        // echo the contact data in json
        echo json_encode($contact_arr);
    }
    // In case the query requested something that doesnt exist in the database
    else {
        // http code
        http_response_code(404);
        // error message
        echo json_encode(array("message"=>"This contact does not exists."));
    }
?>