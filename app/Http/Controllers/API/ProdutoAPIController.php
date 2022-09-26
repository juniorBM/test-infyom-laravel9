<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProdutoAPIRequest;
use App\Http\Requests\API\UpdateProdutoAPIRequest;
use App\Models\Produto;
use App\Repositories\ProdutoRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ProdutoAPIController
 */
class ProdutoAPIController extends AppBaseController
{
    private ProdutoRepository $produtoRepository;

    public function __construct(ProdutoRepository $produtoRepo)
    {
        $this->produtoRepository = $produtoRepo;
    }

    /**
     * Display a listing of the Produtos.
     * GET|HEAD /produtos
     */
    public function index(Request $request): JsonResponse
    {
        $produtos = $this->produtoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $produtos->toArray(),
            __('messages.retrieved', ['model' => __('models/produtos.plural')])
        );
    }

    /**
     * Store a newly created Produto in storage.
     * POST /produtos
     */
    public function store(CreateProdutoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $produto = $this->produtoRepository->create($input);

        return $this->sendResponse(
            $produto->toArray(),
            __('messages.saved', ['model' => __('models/produtos.singular')])
        );
    }

    /**
     * Display the specified Produto.
     * GET|HEAD /produtos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Produto $produto */
        $produto = $this->produtoRepository->find($id);

        if (empty($produto)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/$MODEL_NAME_PLURAL_CAMEL$.singular')])
            );
        }

        return $this->sendResponse(
            $produto->toArray(),
            __('messages.retrieved', ['model' => __('models/produtos.singular')])
        );
    }

    /**
     * Update the specified Produto in storage.
     * PUT/PATCH /produtos/{id}
     */
    public function update($id, UpdateProdutoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Produto $produto */
        $produto = $this->produtoRepository->find($id);

        if (empty($produto)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/$MODEL_NAME_PLURAL_CAMEL$.singular')])
            );
        }

        $produto = $this->produtoRepository->update($input, $id);

        return $this->sendResponse(
            $produto->toArray(),
            __('messages.updated', ['model' => __('models/produtos.singular')])
        );
    }

    /**
     * Remove the specified Produto from storage.
     * DELETE /produtos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Produto $produto */
        $produto = $this->produtoRepository->find($id);

        if (empty($produto)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/$MODEL_NAME_PLURAL_CAMEL$.singular')])
            );
        }

        $produto->delete();

        return $this->sendError(
            $id,
            __('messages.deleted', ['model' => __('models/produtos.singular')])
        );
    }
}
