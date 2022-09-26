<?php
// use the follow name to save in the folder routes/web/ $MODEL_NAME_PLURAL_SNAKE$.routes.php

use App\Http\Controllers\ProdutoController;

$router->group(
    [
        'prefix' => 'produtos',
        'middleware' => 'permission:produtos.view',
    ],
    function () use ($router) {
        $router->get('', [
            ProdutoController::class, 'index'
        ])->name('produtos.index');

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
