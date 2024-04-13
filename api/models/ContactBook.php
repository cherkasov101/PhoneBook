<?php

declare(strict_types=1);

namespace api\models;

require_once __DIR__ . '/JsonStorage.php';
require_once __DIR__ . '/Contact.php';

use api\models\JsonStorage;
use api\models\Contact;

/**
 * Class ContactBook
 * @package api\models
 */
class ContactBook {
    private JsonStorage $storage;

    public function __construct(JsonStorage $storage) {
        $this->storage = $storage;
    }

    /**
     * Add new contact
     * 
     * @param string $name
     * @param string $phone
     * 
     * @return void
     */
    public function addContact(string $name, string $phone): void {
        $contacts = $this->storage->loadContacts();
        $contacts[] = new Contact($name, $phone);
        $this->storage->saveContacts($contacts);
    }

    /**
     * Get all contacts
     * 
     * @return array
     */
    public function getContacts(): array {
        $result = $this->storage->loadContacts();
        if (!is_array($result)) {
            $result = [];
        }
        return $result;
    }

    /**
     * Delete contact
     * 
     * @param int $index
     * 
     * @return void
     */
    public function deleteContact($index): void {
        $contacts = $this->storage->loadContacts();
        if (isset($contacts[$index])) {
            unset($contacts[$index]);
            $this->storage->saveContacts(array_values($contacts));
        }
    }
}