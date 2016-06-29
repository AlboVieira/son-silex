<?php
require_once '../bootstrap.php';

use Symfony\Component\HttpFoundation\Request;
use Code\System\Entity\Customer;
use Code\System\Mapper\ProductMapper;
use Code\System\Service\ClientService;
use Code\System\Service\ProductService;
use Code\System\Entity\Product;


/** Inicio Rotas Cliente */
/*$app['clienteService'] = function(){
    return new ClientService(
        new Customer(),
        new ClienteMapper()
    );
};
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
});*/

/** Fim Rotas Cliente */

/** Inicio Rotas Produto */
$app['produtoService'] = function(){
    return new ProductService(
        new Product(),
        new ProductMapper()
    );
};
/** @var ProductService $productService */
$productService = $app['produtoService'];

$app->get('/api/produtos', function() use ($app,$productService) {
    $result = $productService->findAll();
    return $app->json($result);
});

$app->get('/api/produtos/{id}', function($id) use ($app,$productService) {
    $result = $productService->findById($id);
    return $app->json($result);
});

$app->post('/api/produtos', function(Request $request) use($app,$productService){

    $dados['name'] = $request->get('name');
    $dados['description'] = $request->get('description');
    $dados['price'] = $request->get('price');
    $result = $productService->insert($dados);

    return $app->json($result);
});

$app->post('/api/produtos/{id}', function(Request $request,$id) use($app,$productService){

    $dados['id'] = $id;
    $dados['name'] = $request->get('name');
    $dados['description'] = $request->get('description');
    $dados['price'] = $request->get('price');
    $result = $productService->update($dados);

    return $app->json($result);
});

$app->delete('/api/produtos/{id}', function($id) use ($app,$productService) {
    $result = $productService->delete($id);
    return $app->json($result);
});

/** Fim Rotas Produto */


/** View Produto **/

$app->get("/", function() use($app,$productService){

    $products = $productService->findAllAsArray();
    return $app['twig']->render('index.twig',['products' => $products]);
});

$app->get("/produtos/incluir", function() use($app,$productService){

    return $app['twig']->render('incluir.twig');

})->bind('incluir-produto');

/** Fim View Produto */

$app->run();