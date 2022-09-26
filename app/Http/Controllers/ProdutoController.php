<?php

namespace App\Http\Controllers;

use App\DataTables\ProdutoDataTable;
use App\Http\Requests\CreateProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProdutoRepository;
use Illuminate\Http\Request;
use Flash;

class ProdutoController extends AppBaseController
{
    /** @var ProdutoRepository $produtoRepository*/
    private $produtoRepository;

    public function __construct(ProdutoRepository $produtoRepo)
    {
        $this->produtoRepository = $produtoRepo;
    }

    /**
     * Display a listing of the Produto.
     */
    public function index(ProdutoDataTable $produtoDataTable)
    {
    return $produtoDataTable->render('produtos.index');
    }


    /**
     * Show the form for creating a new Produto.
     */
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Store a newly created Produto in storage.
     */
    public function store(CreateProdutoRequest $request)
    {
        $input = $request->all();

        $produto = $this->produtoRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/produtos.singular')]));

        return redirect(route('produtos.index'));
    }

    /**
     * Display the specified Produto.
     */
    public function show($id)
    {
        $produto = $this->produtoRepository->find($id);

        if (empty($produto)) {
            Flash::error(__('models/produtos.singular').' '.__('messages.not_found'));

            return redirect(route('produtos.index'));
        }

        return view('produtos.show')->with('produto', $produto);
    }

    /**
     * Show the form for editing the specified Produto.
     */
    public function edit($id)
    {
        $produto = $this->produtoRepository->find($id);

        if (empty($produto)) {
            Flash::error(__('models/produtos.singular').' '.__('messages.not_found'));

            return redirect(route('produtos.index'));
        }

        return view('produtos.edit')->with('produto', $produto);
    }

    /**
     * Update the specified Produto in storage.
     */
    public function update($id, UpdateProdutoRequest $request)
    {
        $produto = $this->produtoRepository->find($id);

        if (empty($produto)) {
            Flash::error(__('models/produtos.singular').' '.__('messages.not_found'));

            return redirect(route('produtos.index'));
        }

        $produto = $this->produtoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/produtos.singular')]));

        return redirect(route('produtos.index'));
    }

    /**
     * Remove the specified Produto from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $produto = $this->produtoRepository->find($id);

        if (empty($produto)) {
            Flash::error(__('models/produtos.singular').' '.__('messages.not_found'));

            return redirect(route('produtos.index'));
        }

        $this->produtoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/produtos.singular')]));

        return redirect(route('produtos.index'));
    }
}
