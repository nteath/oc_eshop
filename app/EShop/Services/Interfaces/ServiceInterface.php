<?php

namespace App\EShop\Services\Interfaces;

use Illuminate\Http\Request;


interface ServiceInterface
{
    public function run(Request $request);
}
