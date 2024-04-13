<?php

declare(strict_types=1);

namespace api\models;

/**
 * Class Contact
 * @package api\models
 */
class Contact {
    public string $name;
    public string $phone;

    public function __construct(string $name, string $phone) {
        $this->name = $name;
        $this->phone = $phone;
    }
}