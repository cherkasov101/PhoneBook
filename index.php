<?php

$request_method = $_SERVER['REQUEST_METHOD'];
$request_uri = $_SERVER['REQUEST_URI'];

switch ($request_uri) {
    case '/':
        require_once 'api/handlers/MainPage.php';
        $mainPage = new api\handlers\MainPage();
        $mainPage->handleRequest();
        break;
    case '/add_contact':
        require_once 'api/handlers/AddContact.php';
        $addContactHandler = new api\handlers\AddContactHandler();
        $addContactHandler->handle();
        break;
    case '/delete_contact':
        require_once 'api/handlers/DeleteContact.php';
        $handler = new api\handlers\DeleteContactHandler();
        $handler->handle();
        break;
    case '/get_contacts':
        require_once 'api/handlers/GetContacts.php';
        $handler = new api\handlers\GetContactsHandler();
        $handler->handle();
        break;
    default:
        http_response_code(404);
        echo 'Not Found';
        break;
}