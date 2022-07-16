<?php
require 'bootstrap.php';

try {
  $data = router();
  $view = $data['view'];
  extract($data['data']);

  require VIEWS . 'master.php';

  if (!isset($view)) {
    throw new Exception("O índice view está faltando");
  }

  if (!file_exists(VIEWS . $view)) {
    throw new Exception("Essa view {$view} não existe.");
  }
} catch (Exception $e) {
  var_dump($e->getMessage());
}
