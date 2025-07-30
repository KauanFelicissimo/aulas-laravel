<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\FormRequestUsuarios;

// Hash de autenicação - necessário para a criptografia de senha
use Illuminate\Support\Facades\Hash;
 
class UsuarioController extends Controller
{
    public function __construct(User $user){
        $this->user =$user;
    }
 
     public function index(Request $request){
        $pesquisar = $request->pesquisar;
        $findUser = $this->user->getFiltrosPaginate(search: $pesquisar ?? "");
 
        return view('pages.usuario.index', compact('findUser'));
    }

    public function delete($idUser) {
        $buscaRegistro = User::find($idUser);
        $buscaRegistro->delete();

        return back();
    }

     public function create(FormRequestUsuarios $request)
    {
 
        //condicional para entendimento do envio dos dados para o banco de dados
        if ($request->method() == "POST"){
            $data = $request->all();
            User::create(
                [
                    "name" => $data['nome'],
                    "email" => $data['email'],
                    "password" => Hash::make($data['password']),
                ]
            );
 
            return redirect('/usario');
        }
        return view('pages.usuario.create');
    }
}