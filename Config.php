<?php

namespace App;

class Config
{
    // data base
    public const HOST = "localhost";
    public const DB_NAME = "sodavesnois";
    public const USER = "root";
    public const PASSWORD = "";

    // send mail
    public const APP_URL = 'http://localhost:8000';

    //sticker list
    public const STICKER_TYPE = [
        'bad',
        'fun',
        'good',
        'happy',
        'heart',
    ];

    // link type list
    public const LINK_TYPE = [
        'health',
        'mobility',
        'help',
    ];

    // avatar list
    public const AVATAR_LIST = [
        'avatar.png',
        'demon.png',
        'pica.png',
        'smiley.png',
        'venom.png',
    ];
}