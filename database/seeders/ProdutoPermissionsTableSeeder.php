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
                'name' => 'Visualizar Produtos',
                'slug' => 'produtos.view',
                'description' => 'Visualizar Produtos',
                'model' => 'Permission',
            ],
            [
                'name' => 'Criar Produtos',
                'slug' => 'produtos.create',
                'description' => 'Criar Produtos',
                'model' => 'Permission',
            ],
            [
                'name' => 'Editar Produtos',
                'slug' => 'produtos.edit',
                'description' => 'Editar Produtos',
                'model' => 'Permission',
            ],
            [
                'name' => 'Remover Produtos',
                'slug' => 'produtos.delete',
                'description' => 'Remover Produtos',
                'model' => 'Permission',
            ],
        ];


        foreach ($PermissionItems as $PermissionItem) {
            $newPermissionItem = Permission::where('slug', '=', $PermissionItem['slug'])->first();
            if ($newPermissionItem === null) {
                Permission::create(
                    [
                        'name' => $PermissionItem['name'],
                        'slug' => $PermissionItem['slug'],
                        'description' => $PermissionItem['description'],
                        'model' => $PermissionItem['model'],
                    ]
                );
            }
        }
        $permissions_produtos = Permission::where('slug', 'LIKE', 'produtos.%')->get();
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
