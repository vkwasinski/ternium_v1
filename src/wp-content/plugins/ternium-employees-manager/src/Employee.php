<?php

namespace Ternium\Plugin;

class Employee
{
    public static $employee;
    public static $db;
    private $employeeTableName = 'employees';
    private $dependentsTableName = 'dependents';


    public function __construct() {
        global $wpdb;

        $this->db = $wpdb;
        $this->employeeTableName = $wpdb->prefix.$this->employeeTableName;
        $this->dependentsTableName = $wpdb->prefix.$this->dependentsTableName;
    }

    static function buildAllData(array $retreiveAll): array
    {
        $employeesWithDependents = [];
        foreach ($retreiveAll as $data)
        {
            $matricula = $data->matricula;

            if (!isset($employeesWithDependents[$matricula])) {
                $employeesWithDependents[$matricula] = (object) [
                    'id' => $data->id,
                    'matricula' => $data->matricula,
                    'id_8' => $data->{'8_id'},
                    'nome' => $data->nome,
                    'escala' => $data->escala,
                    'data_festa' => $data->data_festa,
                    'cpf' => $data->cpf,
                    'onibus' => $data->onibus,
                    'cargo_nome' => $data->cargo_nome,
                    'estado_civil' => $data->estado_civil,
                    'endereco' => $data->endereco,
                    'confirmado' => $data->confirmado,
                    'obs' => $data->obs,
                    'telefone' => $data->telefone,
                    'email' => $data->email,
                    'dependents' => [],
                ];

                if (!is_null($data->dependente_nome)
                && !is_null($data->dependente_data_nascimento))
                $employeesWithDependents[$matricula]->dependents[] = (object) [
                        'id' => $data->dependente_id,
                        'nome' => $data->dependente_nome,
                        'parentesco' => $data->dependente_parentesco,
                        'data_nascimento' => $data->dependente_data_nascimento,
                        'confirmacao' => $data->dependente_confirmacao,
                ];
            }
            else {
                if (!is_null($data->dependente_nome)
                && !is_null($data->dependente_data_nascimento))
                $employeesWithDependents[$matricula]->dependents[] = (object) [
                        'id' => $data->dependente_id,
                        'nome' => $data->dependente_nome,
                        'parentesco' => $data->dependente_parentesco,
                        'data_nascimento' => $data->dependente_data_nascimento,
                        'confirmacao' => $data->dependente_confirmacao,
                ];
            }
        }

        return $employeesWithDependents;
    }

    static function buildData($employeeData)
    {
        foreach($employeeData as $data)
        {
            if (!isset($employee->info))
            {
                $employee = (object) [
                    'info' => (object) [
                        'id' => $data->id,
                        'matricula' => $data->matricula,
                        'id_8' => $data->{'8_id'},
                        'nome' => $data->nome,
                        'escala' => $data->escala,
                        'data_festa' => $data->data_festa,
                        'onibus' => $data->onibus,
                        'cpf' => $data->cpf,
                        'cargo_nome' => $data->cargo_nome,
                        'estado_civil' => $data->estado_civil,
                        'endereco' => $data->endereco,
                        'confirmado' => $data->confirmado,
                        'obs' => $data->obs,
                        'telefone' => $data->telefone,
                        'email' => $data->email,
                        'senha' => $data->senha,
                    ],
                    'dependents' => [],
                ];

                if (!is_null($data->dependente_nome) && !is_null($data->dependente_data_nascimento)) {
                    $employee->dependents[] = (object) [
                        'id' => $data->dependente_id,
                        'nome' => $data->dependente_nome,
                        'parentesco' => $data->dependente_parentesco,
                        'data_nascimento' => $data->dependente_data_nascimento,
                        'confirmacao' => $data->dependente_confirmado,
                    ];
                }
            }
            else
            {
                if (!is_null($data->dependente_nome) && !is_null($data->dependente_data_nascimento)) {
                    $employee->dependents[] = (object) [
                        'id' => $data->dependente_id,
                        'nome' => $data->dependente_nome,
                        'parentesco' => $data->dependente_parentesco,
                        'data_nascimento' => $data->dependente_data_nascimento,
                        'confirmacao' => $data->dependente_confirmacao,
                    ];
                }
            }

        }

        return $employee;
    }

    public static function getAllEmployeesWithDependents(): array
    {
        $retreiveAll = self::retrieveAllQuery();

        return self::buildAllData($retreiveAll);

    }

    public static function getData(array $whereClause = null): array
    {
        global $wpdb;
        $query =
            "SELECT
                E.id,
                E.matricula,
                E.8_id,
                E.nome,
                E.escala,
                E.data_festa,
                E.cpf,
                E.cargo_nome,
                E.estado_civil,
                E.endereco,
                E.confirmado,
                E.onibus,
                E.senha,
                E.email,
                E.telefone,
                E.obs,
                D.id as 'dependente_id',
                D.nome as 'dependente_nome',
                D.parentesco as 'dependente_parentesco',
                D.data_nascimento as 'dependente_data_nascimento',
                D.confirmado as 'dependente_confirmado'

            FROM
                w2W5jKkc0Oold5kjiL8sR43Hnmmb7__employees E
            JOIN
                w2W5jKkc0Oold5kjiL8sR43Hnmmb7__dependents D
                ON E.id = D.employees_id
        ";

        if ($whereClause !== null && is_array($whereClause)) {
            $clause = array_keys($whereClause)[0];
            $query .= "WHERE E.{$clause} = {$whereClause[$clause]}";
        }

        $data = $wpdb->get_results($query);

        return $data;
    }

    static function retrieveAllQuery(): array
    {
        global $wpdb;
        try {
            return Employee::getData();
        }
        catch (Exception $e) {
            return [ $e->getMessage() ];
        }
    }
    /**
     * employee_id => $id
     * dependents_ids => [$id1, ...., $idN]
     */
    static function confirmation(array $data): bool
    {
        global $wpdb;

        $updateSet = 'confirmado = 1';
        if ($data['obs'] !== '')       $updateSet .= ", obs = '{$data['obs']}' ";
        if ($data['email'] !== '')     $updateSet .= ", email = '{$data['email']}' ";
        if ($data['telefone'] !== '')  $updateSet .= ", telefone = '{$data['telefone']}' ";

        try {
            $employeeId = $data['employee_id'];
            // Update Employee
            $wpdb->query("
                UPDATE
                    w2W5jKkc0Oold5kjiL8sR43Hnmmb7__employees
                SET
                    {$updateSet}
                WHERE
                    id = {$employeeId};
            ");

            if (!empty($data['dependents_id']))
            {
                $dependentsIds = $data['dependents_id'];

                foreach($dependentsIds as $id)
                {
                    // Update Employee
                    $wpdb->query("
                        UPDATE
                            w2W5jKkc0Oold5kjiL8sR43Hnmmb7__dependents
                        SET
                            confirmado = 1
                        WHERE
                            id = {$id};
                    ");
                }
            }

            if ($data['dependente_nome'] !== '' && $data['dependente_parentesco'] !== '' && $data['dependente_idade'] !== '' ) {
                $wpdb->query(
                    "INSERT INTO
                        w2W5jKkc0Oold5kjiL8sR43Hnmmb7__dependents(
                            employees_id,
                            nome,
                            parentesco,
                            data_nascimento,
                            confirmado
                        ) VALUE (
                            {$employeeId},
                            '{$data['dependente_nome']}',
                            '{$data['dependente_parentesco']}',
                            '{$data['dependente_idade']}',
                            1
                        )"
                    );
            }

            return true;
        }
        catch (\Throwable $th) {
            return false;
        }
    }

    static function byId($id): object
    {
        $employeeQuery = Employee::getData([ 'id' => $id ]);
        $employee = self::buildData($employeeQuery);

        return (object) $employee;
    }

    static function byCpf($cpf): object
    {
        $employeeQuery = Employee::getData([ 'cpf' => $cpf ]);
        self::$employee = self::buildData($employeeQuery);

        return (object)  self::$employee;
    }

    static function checkUserSession($id) {
        return isset($_SESSION[$id]);
    }

    static function rndPasswd($length = 8) {
        srand((double) microtime() * 1000000);

        $password = "";
        $possible = "0123456789abcdefghijklmnopqrstvwxyz";

        $i = 0;

        while ($i < $length) {
            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);

            if (!strstr($password, $char)) {
                $password .= $char;
                $i++;
            }
        }

        return $password;
    }

    public function createPassword(string $cpf): string
    {
        global $wpdb;

        try {
            $password = self::rndPasswd(8);
            $wpdb->query("
                UPDATE
                    w2W5jKkc0Oold5kjiL8sR43Hnmmb7__employees
                SET
                    senha = '{$password}'
                WHERE
                    cpf = $cpf
            ");

            return $password;

        }
        catch (\Throwable $th) {
            return '';
        }
    }
}