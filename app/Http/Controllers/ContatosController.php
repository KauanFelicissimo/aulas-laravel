<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contatos;

class ContatosController extends Controller
{
    public function index(){
        $findContatos = Contatos::get();

        return view('pages.contatos.index', compact('findContatos'));
    }
}
