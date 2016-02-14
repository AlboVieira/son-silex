<?php
require_once '../bootstrap.php';

$app->get('/clientes', function() use ($app) {
    $clientes = [
      1 =>
          [ 'nome' => 'Albo Vieira',
            'email' => 'albovieira@gmail.com',
            'cpf' => '13387766335'
          ],
      2 =>
          [   'nome' => 'Joao Silva',
              'email' => 'joaosilva@gmail.com',
              'cpf' => '4455667889'
          ]
    ];
    return $app->json($clientes);
});

$app->run();