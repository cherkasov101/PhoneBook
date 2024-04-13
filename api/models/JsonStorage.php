<?php

declare(strict_types=1);

namespace api\models;

/**
 * Class JsonStorage
 * @package api\models
 */
class JsonStorage {
    private string $filename;

    public function __construct(string $filename) {
        $this->filename = $filename;
    }

    /**
     * Function to load contacts from JSON file
     * 
     * @return array
     */
    public function loadContacts(): array {
        $contacts = [];
    
        if (file_exists($this->filename)) {
            $json = file_get_contents($this->filename);
            $contacts = json_decode($json, true) ?? [];
        }
    
        // Assign unique ID to each contact
        foreach ($contacts as $index => $contact) {
            $contact['id'] = $index; // Simple unique ID generation
            $contacts[$index] = $contact;
        }
    
        return $contacts;
    }
    
    /**
     * Function to save contacts to JSON file
     * 
     * @param array $contacts
     * 
     * @return void
     */
    public function saveContacts(array $contacts): void {
        $json = json_encode($contacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        file_put_contents($this->filename, $json);
    }
}