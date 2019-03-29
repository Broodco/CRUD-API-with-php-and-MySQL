# CRUD-API-with-php-and-MySQL

## What's this repository about?

Three steps : 
1. Create a Restful CRUD API with PHP and mySQL
2. Create a Single Page Web App with Vue.js
3. Use the API to communicate between the front-end and the back-end

This project is a first for me, so I welcome, as always, any criticism or advice.

## Contents

### API (vuephp_api/api)

This API is Object Oriented.

Contains the backend side of the project.
The CRUD API is divided as follow : 
* /config/database(_redacted).php : php file (imported later), used to connect to the database.
* /objects/contacts.php : php file (imported later), containing each SQL query method needed for the CRUD.
* /contacts/ : files accessed with URL :
  * create.php : Create a new row in the Table (need a POST request)
  * delete.php : Delete a row in the Table (need a POST request)
  * read_one.php : Read a row in the Table (need a GET request)
  * read.php : Read the entire Table (no request is needed)
  * search.php : Research a string in the Table and returns the rows containing the string (need a GET request to research)
  * update.php : Changes the data in a row of the Table (need a POST request)
  
  Each of those files import database.php and contacts.php