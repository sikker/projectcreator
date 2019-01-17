{
    "name": "%VENDOR%/%PACKAGE%",
    "type": "application",
    "description": "Dummy description",
    "homepage": "https://example.com",
    "keywords": ["list", "of", "tags"],
    "license": "CC-BY-4.0",
    "authors": [
        {
            "name": "Your Name",
            "email": "email@example.com",
            "homepage": "https://example.com"
        }
    ],
    "require": {
        "php": "^7.0",
        "sikker/phinatra": "*",
        "sikker/notnosql": "*"
    },
    "autoload": {
        "psr-4": {
            "%VENDOR%\\%PACKAGE%\\": "src/"
        }
    }
}