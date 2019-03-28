<?php
    // Headers
    header ("Access-Control-Allow-Origin: *");
    header ("Content-Type: application/json; charset=UTF-8");
    // Includes
    include_once '../config/database.php';
    include_once '../objects/contacts.php';
    // Instantiate Database
    $database = new Database();
    $db = $database->getConnection();
    // Initialize Contacts object
    $contacts = new Contacts($db);
    // Query the Data to Read
    $stmt = $contacts->read();
    // Checks if there is data to read using $num
    $num = $stmt->rowCount();
    if($num>0){
        // Creates array which will get the data
        $contacts_arr = array();
        $contacts_arr["records"] = array();
        // Retrieving table content
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){  //FETCH_ASSOC is used to return an array indexed by column name
            extract($row); // Transforms $row["name"] to $name
            $contacts_item=array(
                "id" => $id,
                "username" => $username,
                "email" => $email,
                "city" => $city,
                "country" => $country,
                "job" => $job
            );
            array_push($contacts_arr["records"],$contacts_item);
        }
        // http code
        http_response_code(200);
        // echo the contact data in json
        echo json_encode($contacts_arr);
    }
    // no product found is here
    else {
        // http code
        http_response_code(404);
        // echo the user no contact found
        echo json_encore(
            array('message'=>'No contact found.')
        );
    }
?>