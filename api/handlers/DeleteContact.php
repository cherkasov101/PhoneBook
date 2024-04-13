<?php

declare(strict_types=1);

namespace api\handlers;

require_once __DIR__ . '/../models/JsonStorage.php';
require_once __DIR__ . '/../models/ContactBook.php';

use api\models\JsonStorage;
use api\models\ContactBook;

/**
 * Class DeleteContactHandler
 * @package api\handlers
 */
class DeleteContactHandler
{
    public function handle(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['id'])) {
                $storage = new JsonStorage('contacts.json');
                $contactBook = new ContactBook($storage);
                $contactBook->deleteContact($data['id']);

                http_response_code(200);
                echo json_encode(['message' => 'Contact deleted'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Invalid data'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            }
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }
    }
}
