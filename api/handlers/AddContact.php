<?php

declare(strict_types=1);

namespace api\handlers;

require_once __DIR__ . '/../models/ContactBook.php';
require_once __DIR__ . '/../models/JsonStorage.php';

use api\models\ContactBook;
use api\models\JsonStorage;

/**
 * Class AddContactHandler
 * @package api\handlers
 */
class AddContactHandler {
    public function handle(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo 'Method Not Allowed';
            return;
        }

        $requestData = json_decode(file_get_contents('php://input'), true);

        if (!isset($requestData['name']) || !isset($requestData['phone'])) {
            http_response_code(400);
            echo 'Bad Request';
            return;
        }

        $storage = new JsonStorage("contacts.json");
        $contactBook = new ContactBook($storage);

        $contactBook->addContact($requestData['name'], $requestData['phone']);

        http_response_code(200);
        echo 'Contact added successfully';
    }
}
