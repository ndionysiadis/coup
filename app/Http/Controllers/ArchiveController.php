<?php

namespace App\Http\Controllers;

use App\Data\Archive\ArchiveIndexPageData;
use Inertia\Inertia;
use Inertia\Response;

class ArchiveController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Archive/Index', new ArchiveIndexPageData());
    }
}
