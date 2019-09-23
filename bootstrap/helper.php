<?php

use Illuminate\Support\Facades\Request;

function isActive($path)
{
    return Request::is($path);
}
