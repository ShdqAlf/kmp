<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    // ============== VIEW ===============
    public function index()
    {
        $data = [
            'title' => 'Arsip',
            'subtitle' => 'Daftar Arsip',
        ];
        return view('page.arsip.index', $data);
    }

    public function show($id)
    {

    }

    // ============== END VIEW ===============

    // ============== ACTION ===============
    // ============== END ACTION ===============
}
