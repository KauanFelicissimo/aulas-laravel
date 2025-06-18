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

    public function delete($idUser){
        $buscaRegistro = Contatos::find($idUser);
        $buscaRegistro->delete();

        return back();
    }

    public function create(Request $request){
        // condicional para enentendimento do envio dos dados para os baco e dados
        if($request->method() == "POST"){
            $data = $request->all();
            Contatos::create($data);

            return redirect('/contatos');
        }

        return view('pages.contatos.create');
    }
}
