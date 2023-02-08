<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function changeLanguage($langCode)
    {
        App::setLocale($langCode);
        session()->put("lang_code", $langCode);

        return redirect()->back();
    }
}
