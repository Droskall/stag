<?php

namespace App\Controller;

class StickerController extends AbstractController
{

    public function default()
    {
        self::render('home');
    }

    public function add(int $id, string $type) {
        
    }
}