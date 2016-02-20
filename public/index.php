<?php
require_once '../bootstrap.php';

use Symfony\Component\HttpFoundation\Request;
use Code\Sistema\Entity\Cliente;
use Code\Sistema\Mapper\ClienteMapper;
use Code\Sistema\Service\ClienteService;
use Code\Sistema\Service\ProdutoService;
use Code\Sistema\Entity\Produto;
use Code\Sistema\Mapper\ProdutoMapper;


/** Inicio Rotas Cliente */
$app['clienteService'] = function(){
    return new ClienteService(
        new Cliente(),
        new ClienteMapper()
    );
};
/** @var ClienteService $clienteService */
$clienteService = $app['clienteService'];

$app->get('/clientes', function() use ($app) {
    $clientes = [
        1 =>
            [ 'nome' => 'Albo Vieira',
                'email' => 'albovieira@gmail.com',
                'cpf' => '13387766335'
            ],
        2 =>
            [ 'nome' => 'Albo Vieira',
                'email' => 'albovieira@gmail.com',
                'cpf' => '13387766335'
            ]
    ];
    return $app->json($clientes);
});

/** Fim Rotas Cliente */

/** Inicio Rotas Produto */
$app['produtoService'] = function(){
    return new ProdutoService(
        new Produto(),
        new ProdutoMapper()
    );
};
/** @var ProdutoService $produtoService */
$produtoService = $app['produtoService'];

$app->get('/produtos', function() use ($app,$produtoService) {
    $result = $produtoService->findAll();
    return $app->json($result);
});

$app->get('/produtos/{id}', function($id) use ($app,$produtoService) {
    $result = $produtoService->findById($id);
    return $app->json($result);
});

$app->post('/produtos', function(Request $request) use($app,$produtoService){
    $dados['nome'] = $request->get('nome');
    $dados['descricao'] = $request->get('descricao');
    $dados['valor'] = $request->get('valor');
    $result = $produtoService->insert($dados);

    return $app->json($result);
});

$app->post('/produtos/{id}', function(Request $request,$id) use($app,$produtoService){

    $dados['id'] = $id;
    $dados['nome'] = $request->get('nome');
    $dados['descricao'] = $request->get('descricao');
    $dados['valor'] = $request->get('valor');
    $result = $produtoService->update($dados);

    return $app->json($result);
});

$app->delete('/produtos/{id}', function($id) use ($app,$produtoService) {
    $result = $produtoService->excluir($id);
    return $app->json($result);
});

/** Fim Rotas Produto */


$app->run();