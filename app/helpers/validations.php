<?php

function required($field)
{
  if ($_POST[$field] === '') {
    setFlash($field, 'O campo é obrigatório');
    return false;
  }

  return filter_input(INPUT_POST, $field);
}

function email($field)
{
  $emailIsValid = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);

  if (!$emailIsValid) {
    setFlash($field, 'O campo tem que ser um email válido');
    return false;
  }

  return filter_input(INPUT_POST, $field);
}

function unique($field, $param)
{
  $data = filter_input(INPUT_POST, $field);
  $findBy = findBy($param, $field, $data);

  if ($findBy) {
    setFlash($field, 'Esse valor já está cadastrado');
    return false;
  }

  return $data;
}

function maxlen($field, $param)
{
  $data = filter_input(INPUT_POST, $field);

  if (strlen($data) > $param) {
    setFlash($field, "Esse campo deve conter no máximo {$param} caracteres");
    return false;
  }

  return $data;
}
