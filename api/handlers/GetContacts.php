<?php

declare(strict_types=1);

namespace api\handlers;

require_once __DIR__ . '/../models/JsonStorage.php';
require_once __DIR__ . '/../models/ContactBook.php';

use api\models\JsonStorage;
use api\models\ContactBook;

/**
 * Class GetContactsHandler
 * @package api\handlers
 */
class GetContactsHandler
{
    public function handle(): void
    {
        $storage = new JsonStorage('contacts.json');
        $contactBook = new ContactBook($storage);

        $contacts = $contactBook->getContacts();

        header('Content-Type: application/json');
        echo json_encode($contacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
