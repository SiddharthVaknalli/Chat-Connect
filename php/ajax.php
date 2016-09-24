<?php

//Database configuration array
$dbOptions = array('db_host' => 'localhost', 'db_user' => 'web222-webchat', 'db_pass' => 'wfz!EFrYm', 'db_name' => 'web222-webchat');

//Error reporting setup
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Require all the PHP class files
require "classes/DB.class.php";
require "classes/Chat.class.php";
require "classes/ChatBase.class.php";
require "classes/ChatLine.class.php";
require "classes/ChatUser.class.php";

//Name the current session and start it
session_name('webchat');
session_start();

//Magic quotes is a process that automagically escapes incoming data to the PHP script. So if it is turned on, remove all the slashes so that the required data can be escaped at runtime instead
if(get_magic_quotes_gpc()){
	
	// If magic quotes is enabled, strip the extra slashes from the GET and POST arrays
	array_walk_recursive($_GET,create_function('&$v,$k','$v = stripslashes($v);'));
	array_walk_recursive($_POST,create_function('&$v,$k','$v = stripslashes($v);'));
    
    /*
    Explanation of code:
    Array_walk_recursive executes a function (the second argument) recursively on each item in the given array(the first argument). create_function creates an anonymous function in lambda-style. The first argument are the parameters for the function, the second argument is the code that needs to be executed by the function. The stripslashes() function removes all the escape characters i.e. slashes from the given string.
    So create_function creates a function with &$v (a reference variable) and $k as parameters. Array_walk_recursive calls the function recursively on each item in the $_GET or $_POST array, which supplies each value as the first argument and the key as the second argument. Since the first argument is a reference, the values in the array get changed as well. The effect is that all items in the $_GET and $_POST arrays are stripped of escape slashes.
    For more explanation, see: http://forums.phpfreaks.com/topic/271595-what-does-this-piece-of-code-do/
    */
}

try {
    //Connect to database
    DB::init($dbOptions);
    
    $response = array();
    
    //Handling the supported actions
    switch($_GET['action']){
            
        case 'login':
            $response = Chat::login($_POST['name'], $_POST['email']);
        break;
            
        case 'checkLogged':
			$response = Chat::checkLogged();
		break;
		
		case 'logout':
			$response = Chat::logout();
		break;
		
		case 'submitChat':
			$response = Chat::submitChat($_POST['chatText']);
		break;
		
		case 'getUsers':
			$response = Chat::getUsers();
		break;
		
		case 'getChats':
			$response = Chat::getChats($_GET['lastID']);
		break;
		
		default:
			throw new Exception('Wrong action');
    }
    
    //Encode the response array in JSON format
    echo json_encode($response);
}
catch(Exception $e) {
    die(json_encode(array('error' => $e->getMessage())));
}

?>