<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Contatos;
//importando o arquivo de validação
use App\Http\Requests\FormRequestContatos;
 
class ContatosController extends Controller
{
    public function __construct(Contatos $contatos){
        $this->contatos =$contatos;
    }
 
     public function index(Request $request){
        $pesquisar = $request->pesquisar;
        $findContatos = $this->contatos->getFiltrosPaginate(search: $pesquisar ?? "");
 
        return view('pages.contatos.index', compact('findContatos'));
    }
 
    public function delete($IdUser)
    {
       $buscaRegistro = Contatos::find($IdUser);
       $buscaRegistro->delete();
       return back();
    }
 
    public function create(FormRequestContatos $request)
    {
 
        //condicional para entendimento do envio dos dados para o banco de dados
        if ($request->method() == "POST"){
            $data = $request->all();
            Contatos::create($data);
 
            return redirect('/contatos');
        }
        return view('pages.contatos.create');
    }
 
    public function update(FormRequestContatos $request, $idContatos) {
        if($request->method() == 'PUT'){
            $data = $request->all();
            $buscaRegistro = Contatos::find($idContatos);
            $buscaRegistro->update($data);
 
            return redirect('/contatos');
        }
 
        $findContatos = Contatos::where('id', '=', $idContatos)->first();
 
        return view('pages.contatos.update', compact('findContatos'));
    }
}