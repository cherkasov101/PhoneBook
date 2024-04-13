<?php

declare(strict_types=1);

namespace api\handlers;

/**
 * MainPage class is a handler for main page
 */
class MainPage
{
    /**
     * Handle request
     *
     * @return void
     */
    public function handleRequest(): void
    {
        header('Content-Type: text/html; charset=utf-8');
        include __DIR__ . '/../../frontend/html/main_page.html';
    }
}
