<?php

namespace App\Response;

interface HttpResponseInterface
{
    public function send(): void;
}