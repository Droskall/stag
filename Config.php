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
        'formation',
    ];

    // avatar list
    public const AVATAR_LIST = [
        'avatar.png',
        'cat.png',
        'demon.png',
        'dog.png',
        'dragon_1.png',
        'dragon_2.png',
        'harry.png',
        'hinata.png',
        'man_1.png',
        'man_2.png',
        'naruto.png',
        'pica.png',
        'smiley.png',
        'tiger.png',
        'venom.png',
        'woman_1.png',
        'woman_2.png',
        'woman_3.png',
        'woman_4.png',
        'woman_5.png',
    ];
}