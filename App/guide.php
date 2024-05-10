<?php

use Models\User;

// Izveidot jaunu lietotāju

$user = new User();
$user->username = 'vards';
$user->password = 'parole';
$user->email = 'e-pasts';
$user->save();

// Izvadīt visus lietotājus

$users = User::all();

// Atrod lietotāju pēc ID

$user = User::find(1);

// Dzēst lietotāju

$user->delete();

// Vismaz vajadzētu strādāt...
