<?php

namespace app\controllers;

class Login
{
  public function index()
  {
    return [
      'view' => 'login',
      'data' => ['title' => 'Login']
    ];
  }

  public function store()
  {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');

    if (empty($email) || empty($password)) {
      return setMessageAndRedirect('message', 'Usuário ou senha estão incorretos', '/login');
    }

    $user = findBy('users', 'email', $email);

    if (!$user) {
      return setMessageAndRedirect('message', 'Usuário ou senha estão incorretos', '/login');
    }

    if (!password_verify($password, $user->password)) {
      return setMessageAndRedirect('message', 'Usuário ou senha estão incorretos', '/login');
    }

    $_SESSION[LOGGED] = $user;
    return redirect('/');
  }

  public function destroy()
  {
    unset($_SESSION[LOGGED]);
    return redirect('/');
  }
}
