<?php

use Ternium\Plugin\Employee;

session_start();

function confirm(WP_REST_Request $request): WP_REST_Response
{
    session_start();
    if (!isset($_SESSION['login']))  return  new WP_REST_Response([
        ''
    ], 400);

    try
    {
        $employee_id =  $request->get_param('employee_id');
        $dependents_id =  $request->get_param('dependents_id');

        $obs =  $request->get_param('obs')?? '';
        $email =  $request->get_param('email')?? '';
        $telefone =  $request->get_param('telefone')?? '';

        $dependente_nome = $request->get_param('dependente_nome')?? '';
        $dependente_parentesco = $request->get_param('dependente_parentesco')?? '';
        $dependente_idade = $request->get_param('dependente_idade')?? '';

        $confirmed = Employee::confirmation([
            'employee_id' => $employee_id,
            'dependents_id' => $dependents_id,
            'obs' =>  $obs,
            'email' => $email,
            'telefone' => $telefone,
            'dependente_nome' => $dependente_nome,
            'dependente_parentesco' => $dependente_parentesco,
            'dependente_idade' => $dependente_idade,
        ]);

        return new WP_REST_Response([
            'success' => $confirmed,
        ], 200);
    }
    catch (Exception $e) {
        return  new WP_REST_Response([
            'success' => false,
            'error' => $e->getMessage(),
        ], 400);
    }
}

function login(WP_REST_Request $request): WP_REST_Response
{
    try {
        $cpf =  $request->get_param('cpf');
        $password =  $request->get_param('password');

        $employee = Employee::byCpf($cpf);

        if (trim($cpf) != trim($employee->info->cpf) || trim($password) != trim($employee->info->senha)) {
            return new WP_REST_Response([
              'success' => false,
            ], 404);
        }

        session_start();

        $_SESSION['login'] = [
            'employee' => $employee,
        ];

        return new WP_REST_Response([
            'success' => true,
            'data' => $employee,
        ]);
    }
    catch (Exception $e) {
        return  new WP_REST_Response([
            'success' => false,
            'error' => $e->getMessage(),
        ], 400);
    }
}


function logout(WP_REST_Request $request): WP_REST_Response
{
    try {
        unset($_SESSION['login']);
        session_destroy();

        return  new WP_REST_Response([
            'success' => !isset($_SESSION['login']),
        ], 200);
    }
    catch (Exception $e) {
        return  new WP_REST_Response([
            'success' => false,
            'error' => $e->getMessage(),
        ], 400);
    }
}

function checkSession(WP_REST_Request $request): WP_REST_Response
{
    try {
        session_start();

        return  new WP_REST_Response([
            'success' => isset($_SESSION['login']),
        ], 200);
    }
    catch (Exception $e) {
        return  new WP_REST_Response([
            'success' => false,
            'error' => $e->getMessage(),
        ], 400);
    }
}

function signin(WP_REST_Request $request): WP_REST_Response
{
    try {
        $cpf = $request->get_param('cpf');
        $id_8 = $request->get_param('id_8');

        $employee = Employee::byCpf($cpf);

        if (trim($cpf) !== trim($employee->info->cpf) || trim($id_8) !== trim($employee->info->id_8)) {
            return new WP_REST_Response([
              'success' => false,
            ], 404);
        }

        // update user password
        $password = Employee::createPassword($employee->info->cpf);

        session_start();
        // login user
        $_SESSION['login'] = [
            'employee' => $employee,
        ];

        return new WP_REST_Response([
            'success' => $password !== '',
            'data' => [
                'cpf' => $employee->info->cpf,
                'name' => $employee->info->nome,
                'password' => $password,
            ]
        ], 200);

    }
    catch (Exception $e) {
        return  new WP_REST_Response([
            'success' => false,
            'error' => $e->getMessage(),
        ], 400);
    }
}


function test(WP_REST_Request $request)
{
    $cpf =  $request->get_param('cpf');
    $e = Employee::bycpf($cpf);

    session_start();
    if (!isset($_SESSION['login']))  return  new WP_REST_Response([
        ''
    ], 400);

    return  new WP_REST_Response([
        $e,
        $_SESSION
    ], 200);
}
