<?php

namespace App\Http\Controllers;

use App\PacsInstallation;
use Illuminate\Http\Request;

class PacsUploadController extends Controller
{
    public function browse(PacsInstallation $pacsInstallation)
    {
        return view('pacs.installation.browse', compact('pacsInstallation'));
    }
}
