<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */
class Config {

    /**
     * Database host
     * @var string
     */
    const DB_HOST = 'localhost:3306';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'qlms';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'root';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = '3222513';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;

    /**
     * Secret key for hashing
     * @var boolean
     */
    const SECRET_KEY = 'your-secret-key';

    /**
     * Mailgun API key
     *
     * @var string
     */
    const MAILGUN_API_KEY = 'your-mailgun-api-key';

    /**
     * Mailgun domain
     *
     * @var string
     */
    const MAILGUN_DOMAIN = 'your-mailgun-domain';
}
