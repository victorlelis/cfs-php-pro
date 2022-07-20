<?php
require 'bootstrap.php';

try {
  $data = router();

  if (!isset($data['data'])) {
    throw new Exception("O índice data está faltando");
  }

  if (!isset($data['data']['title'])) {
    throw new Exception("O índice title está faltando");
  }

  $view = $data['view'];
  if (!isset($view)) {
    throw new Exception("O índice view está faltando");
  }

  if (!file_exists(VIEWS . $view . '.php')) {
    throw new Exception("Essa view {$view} não existe.");
  }

  // Create new Plates instance
  $templates = new League\Plates\Engine(VIEWS);

  // Render a template
  echo $templates->render($view, $data['data']);

  // extract($data['data']);
  // require VIEWS . 'master.php';
} catch (Exception $e) {
  var_dump($e->getMessage());
}
