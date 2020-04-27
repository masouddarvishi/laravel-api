<?php

namespace Hooraweb\Base\Http\Controllers;

use App\Http\Controllers\Controller;
Use UserModal;

class TestController extends Controller
{
    public function test()
    {
        dd((new UserModal())->getMessage());
    }
}
