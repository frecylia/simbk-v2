<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catatan; // <--- ini penting

class CatatanController extends Controller
{
    public function index()
    {
        $catatan = Catatan::all();
        return view('catatan.index', compact('catatan'));
    }
}
