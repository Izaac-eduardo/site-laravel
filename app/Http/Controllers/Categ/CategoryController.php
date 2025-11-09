<?php 
namespace App\Http\Controllers\Categ;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Exibe todas as categorias
    public function index()
    {
        $categories = Category::all(); // pega todas categorias da tabela
        // Views das categorias estão em resources/views/admin/categories
        return view('admin.categories.index', compact('categories'));
    }

    // Exibe o formulário para criar categoria
    public function create()
    {
        return view('admin.categories.create');
    }

    // Salva a categoria no banco
    public function store(Request $request)
    {
        // Validação do campo 'name'
        $request->validate([
            'name' => 'required|max:255'
        ]);

        // Cria uma nova categoria no banco com o dado enviado
        Category::create([
            'name' => $request->name
        ]);

        // Redireciona para a lista de categorias
        return redirect()->route('categories.index');
    }

    // Exibe o formulário para editar a categoria existente
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Atualiza a categoria no banco
    public function update(Request $request, Category $category)
    {
        // Validação do campo 'name'
        $request->validate([
            'name' => 'required|max:255'
        ]);

        // Atualiza o registro com o novo valor enviado
        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('categories.index');
    }

    // Exclui a categoria do banco
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
