<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});














Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

require 'web/produtos.routes.php';

/*
<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class ProdutoPermissionsTableSeeder extends Seeder
{
public function run()
{
Permission::where('slug', 'LIKE', 'produtos.%')->forceDelete();

$PermissionItems = [
[
'name'        => 'Visualizar Produtos' ,
'slug'        => 'produtos.view',
'description' => 'Visualizar ' Produtos,
'model'       => 'Permission',
],
[
'name'        => 'Criar Produtos',
'slug'        => 'produtos.create',
'description' => 'Criar Produtos',
'model'       => 'Permission',
],
[
'name'        => 'Editar Produtos',
'slug'        => 'produtos.edit',
'description' => 'Editar Produtos',
'model'       => 'Permission',
],
[
'name'        => 'Remover Produtos',
'slug'        => 'produtos.delete',
'description' => 'Remover Produtos',
'model'       => 'Permission',
],
];


foreach ($PermissionItems as $PermissionItem) {
$newPermissionItem = Permission::where('slug', '=', $PermissionItem['slug'])->first();
if ($newPermissionItem === null) {
Permission::create(
[
'name'          => $PermissionItem['name'],
'slug'          => $PermissionItem['slug'],
'description'   => $PermissionItem['description'],
'model'         => $PermissionItem['model'],
]
);
}
}
$permissions_produtos = Permission::where('slug', 'LIKE','produtos.%')->get();
$roleAdmin = Role::where('slug', '=', Role::ADMIN)->first();
// Add to admin role
foreach ($permissions_produtos as $permission) {
$permission_role = $roleAdmin->permissions()->where('permission_id', $permission->id)->first();
if (!$permission_role) {
$roleAdmin->attachPermission($permission);
}
}
}
}

// ---------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------

<?php
// use the follow name to save in the folder routes/web/ $MODEL_NAME_PLURAL_SNAKE$.routes.php

use App\Http\Controllers\Produto;

$router->group(
    [
        'prefix' => 'produtos',
        'middleware' => 'permission:Produto.view',
    ],
    function () use ($router) {
        $router->get('', [
            ProdutoController::class, 'index'
        ])->name('Produto.index');

        $router->post(
            '',
            [
                ProdutoController::class,
                'store',
            ]
        )
            ->name('produtos.store')
            ->middleware('permission:produtos.create');
        $router->get(
            '/create',
            [
                ProdutoController::class,
                'create'
            ]
        )
            ->name('produtos.create')
            ->middleware('permission:produtos.create');
        $router->put(
            '/{roles}',
            [
                ProdutoController::class,
                'update'
            ]
        )
            ->name('produtos.update')
            ->middleware('permission:produtos.edit');
        $router->patch(
            '/{roles}',
            [
                    ProdutoController::class,
                    'update'
                ]
            )
                ->middleware('permission:produtos.edit');
        $router->delete(
            '/{roles}',
            [
                ProdutoController::class,
                'destroy'
            ]
        )
            ->name('produtos.destroy')
            ->middleware('permission:produtos.delete');
        $router->get(
            '/{roles}',
            [
                ProdutoController::class,
                'show'
            ]
        )
            ->name('produtos.show');
        $router->get(
            '/{roles}/edit',
            [
                ProdutoController::class,
                'edit'
            ]
        )
            ->name('produtos.edit')
            ->middleware('permission:produtos.edit');
    }
);
/*

require 'web/produtos.routes.php';

*/
