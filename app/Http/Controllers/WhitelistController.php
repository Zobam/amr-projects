<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhitelistController extends Controller
{
    public function whitelist($target_ip = null)
    {
        $temp_black_list = fopen(public_path('temp_black_list.text'), 'a');
        $black_list = fopen(public_path('blacklist.text'), 'r');
        while (!feof($black_list)) {
        }
        return response()->json([
            'target_ip' => $target_ip ?? null,
        ]);
    }
}
