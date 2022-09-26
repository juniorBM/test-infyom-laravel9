/*
@php
    echo "<?php".PHP_EOL;
@endphp

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class {{ $config->modelNames->name }}PermissionsTableSeeder extends Seeder
{
public function run()
{
Permission::where('slug', 'LIKE', '{{ $config->modelNames->camelPlural }}.%')->forceDelete();

$PermissionItems = [
[
'name'        => 'Visualizar {{ $config->modelNames->humanPlural }}' ,
'slug'        => '{{ $config->modelNames->camelPlural }}.view',
'description' => 'Visualizar {{ $config->modelNames->humanPlural }}',
'model'       => 'Permission',
],
[
'name'        => 'Criar {{ $config->modelNames->humanPlural }}',
'slug'        => '{{ $config->modelNames->camelPlural }}.create',
'description' => 'Criar {{ $config->modelNames->humanPlural }}',
'model'       => 'Permission',
],
[
'name'        => 'Editar {{ $config->modelNames->humanPlural }}',
'slug'        => '{{ $config->modelNames->camelPlural }}.edit',
'description' => 'Editar {{ $config->modelNames->humanPlural }}',
'model'       => 'Permission',
],
[
'name'        => 'Remover {{ $config->modelNames->humanPlural }}',
'slug'        => '{{ $config->modelNames->camelPlural }}.delete',
'description' => 'Remover {{ $config->modelNames->humanPlural }}',
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
$permissions_{{ $config->modelNames->snakePlural }} = Permission::where('slug', 'LIKE','{{ $config->modelNames->camelPlural }}.%')->get();
$roleAdmin = Role::where('slug', '=', Role::ADMIN)->first();
// Add to admin role
foreach ($permissions_{{ $config->modelNames->snakePlural }} as $permission) {
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

@php
    echo "<?php".PHP_EOL;
@endphp
// use the follow name to save in the folder routes/web/ $MODEL_NAME_PLURAL_SNAKE$.routes.php

use {{ $config->namespaces->controller }}\{{ $config->modelNames->name }}Controller;

$router->group(
    [
        'prefix' => '{{ $config->modelNames->snakePlural }}',
        'middleware' => 'permission:{{ $config->modelNames->camelPlural }}.view',
    ],
    function () use ($router) {
        $router->get('', [
            {{ $config->modelNames->name }}Controller::class, 'index'
        ])->name('{{ $config->modelNames->camelPlural }}.index');

        $router->post(
            '',
            [
                {{ $config->modelNames->name }}Controller::class,
                'store',
            ]
        )
            ->name('{{ $config->modelNames->camelPlural }}.store')
            ->middleware('permission:{{ $config->modelNames->camelPlural }}.create');
        $router->get(
            '/create',
            [
                {{ $config->modelNames->name }}Controller::class,
                'create'
            ]
        )
            ->name('{{ $config->modelNames->camelPlural }}.create')
            ->middleware('permission:{{ $config->modelNames->camelPlural }}.create');
        $router->put(
            '/{roles}',
            [
                {{ $config->modelNames->name }}Controller::class,
                'update'
            ]
        )
            ->name('{{ $config->modelNames->camelPlural }}.update')
            ->middleware('permission:{{ $config->modelNames->camelPlural }}.edit');
        $router->patch(
            '/{roles}',
            [
                    {{ $config->modelNames->name }}Controller::class,
                    'update'
                ]
            )
                ->middleware('permission:{{ $config->modelNames->camelPlural }}.edit');
        $router->delete(
            '/{roles}',
            [
                {{ $config->modelNames->name }}Controller::class,
                'destroy'
            ]
        )
            ->name('{{ $config->modelNames->camelPlural }}.destroy')
            ->middleware('permission:{{ $config->modelNames->camelPlural }}.delete');
        $router->get(
            '/{roles}',
            [
                {{ $config->modelNames->name }}Controller::class,
                'show'
            ]
        )
            ->name('{{ $config->modelNames->camelPlural }}.show');
        $router->get(
            '/{roles}/edit',
            [
                {{ $config->modelNames->name }}Controller::class,
                'edit'
            ]
        )
            ->name('{{ $config->modelNames->camelPlural }}.edit')
            ->middleware('permission:{{ $config->modelNames->camelPlural }}.edit');
    }
);
/*

require 'web/{{ $config->modelNames->snakePlural }}.routes.php';

*/
