<?php

namespace App;

class Color
{
    /**
     * change the color theme following the page
     * @param string $page
     * @return string
     */
    public static function getColor(string $page): string {
        switch ($page) {
            case 'home':
                $color = '#e09700';
                break;
            case 'sport':
                $color = '#07819c';
                break;
            case 'cultural':
                $color = '#d54398';
                break;
            case 'numerical':
                $color = '#4ea392';
                break;
            case 'utile':
                $color = '#a2c31b';
                break;
            case 'profil':
                $color = '#d2afaf';
                break;
        }

        return $color;
    }
}