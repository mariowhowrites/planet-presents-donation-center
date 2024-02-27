<?php

namespace App\Enums;

enum WishlistStatus: string
{
    case Private = 'private';
    case Public = 'public';
}