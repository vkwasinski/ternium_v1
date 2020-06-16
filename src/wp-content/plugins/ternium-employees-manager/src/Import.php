<?php

namespace Ternium\Plugin;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Import
{

    protected $actionImport = false;
    protected $db;
    protected $table_employee;
    protected $table_dependents;

    public $debug = false;
    public $importationStatus = self::STATUS_OK;


    const STATUS_OK = true;
    const STATUS_NON_OK = false;

    const MATRICULA = 0;
    const NOME = 1;
    const ESCALA = 2;
    const DATAFESTA = 3;
    const CPF = 4;
    const CARGO_NOME = 5;
    const ESTADO_CIVIL = 6;
    const ENDERECO = [8, 9, 10, 11, 12];
    const CEP = 13;
    const ID = 14;

    CONST DEPENDENTE_NOME = 18;
    CONST DEPENDENTE_PARENTESCO = 19;
    CONST DEPENDENTE_DATA_NASCIMENTO = 20;

    public function __construct($options)
    {
        global $wpdb;

        $this->db = $wpdb;
        $this->table_employee = $this->db->prefix.'employees';
        $this->table_dependents = $this->db->prefix.'dependents';

        if ($_REQUEST['action'] == 'import')
            $this->actionImport = true;

        if (isset($options['debug']) && $options['debug'])  $this->debug = true;

        set_time_limit(36000);

    }

    public function debug($thing): void {
        if ($this->debug) {
            print '<pre>';
            var_dump(
                $thing
            ) & exit;
        }
    }

    /**
     * Importation watcher for
     */
    public function watchForImportations(): void
    {
        if (
            $this->actionImport
            && isset($_FILES['spreadsheet'])
            && $_FILES['spreadsheet']['name']
            && !$_FILES['spreadsheet']['error']
        ) {
            $this->importSpreadsheet( $_FILES['spreadsheet'] );
        }
    }


    /**
     * Import Distributors from Spreadsheet
     */
    public function importSpreadsheet( $upload ): void
    {
        try {
            $inputFile     = $upload['tmp_name'];
            $inputFileType = IOFactory::identify($inputFile);
            $objReader     = IOFactory::createReader($inputFileType);
            $objPHPExcel   = $objReader->load($inputFile);

            $sheet         = $objPHPExcel->getSheet(0);
            $highestRow    = $sheet->getHighestRow();
            $highestColumn = 'Z'; // $sheet->getHighestColumn();

            for ($row = 2; $row <= $highestRow; $row++)
            {
                $cellRange = 'A'.$row.':'.$highestColumn.$row;
                $rowData = $sheet->rangeToArray($cellRange, null, true, true)[0];

                /**
                 * Validations
                 */
                foreach ([
                    self::MATRICULA,
                    self::NOME,
                    self::ESCALA,
                    self::DATAFESTA,
                    self::CPF,
                    self::CARGO_NOME,
                    self::ESTADO_CIVIL,
                    self::ENDERECO[0],
                    self::ENDERECO[1],
                    self::ENDERECO[2],
                    self::ENDERECO[3],
                    self::ENDERECO[4],
                    self::CEP,
                    self::ID,
                    self::DEPENDENTE_NOME,
                    self::DEPENDENTE_PARENTESCO,
                    self::DEPENDENTE_DATA_NASCIMENTO,
                ] as $index) {
                    $rowData[$index] = trim($rowData[$index]);
                    $rowData[$index] = strtolower($rowData[$index]);

                    if (is_null($rowData[$index]))                  $this->importationStatus = self::STATUS_NON_OK;
                    if (empty($rowData[$index]))                    $this->importationStatus = self::STATUS_NON_OK;
                    if (preg_match('/$[\s-]^/', $rowData[$index]))   $this->importationStatus = self::STATUS_NON_OK;
                }

                // exit importation
                // if ($this->importationStatus == self::STATUS_NON_OK)  break;

                if ( !isset($employeesData[$rowData[self::MATRICULA]]) )
                {
                    $employeesData[$rowData[self::MATRICULA]] = [
                        'nome' => (string) $rowData[self::NOME],
                        'matricula' => (string) $rowData[self::MATRICULA],
                        'escala' => (string) $rowData[self::ESCALA],
                        'data_festa' => (string) $rowData[self::DATAFESTA],
                        'cpf' =>  (string)$rowData[self::CPF],
                        'cargo_nome' => (string) $rowData[self::CARGO_NOME],
                        'estado_civil' => (string) $rowData[self::ESTADO_CIVIL],
                        'endereco' => (string) $rowData[self::ENDERECO[0]]
                            . ', '. $rowData[self::ENDERECO[1]]
                            . ', '. $rowData[self::ENDERECO[2]]
                            . ', '. $rowData[self::ENDERECO[3]]
                            . ', '. $rowData[self::ENDERECO[4]],
                        'cep' => (string) $rowData[self::CEP],
                        '8_id' => (string) $rowData[self::ID],
                        'dependents' => [],
                    ];
                }

                if ( !empty( (string) $rowData[self::DEPENDENTE_NOME]) ) {
                    array_push($employeesData[ $rowData[self::MATRICULA] ]['dependents'], [
                        'nome' => $rowData[self::DEPENDENTE_NOME],
                        'parentesco' => $rowData[self::DEPENDENTE_PARENTESCO],
                        'data_nascimento' => $rowData[self::DEPENDENTE_DATA_NASCIMENTO],
                    ]);
                }
            }

            $this->dbImport($employeesData);
        }
        catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function dbImport(array $employeesData): void
    {
        foreach ($employeesData as $employee) {
            $employeeExists = !!$this->db->get_results(
                "SELECT
                    matricula
                 FROM {$this->table_employee}
                 WHERE
                     matricula = '{$employee['matricula']}'
                LIMIT 1
            ")[0];

            if ($employeeExists)   $this->updateEmployee($employee);
            if (!$employeeExists)  $this->insertEmployee($employee);
        }
    }

    public function insertEmployee($employee): void
    {
        $dependents = $employee['dependents'];
        unset($employee['dependents']);

        $this->db->insert($this->table_employee,
            // data
            $employee,
            [ // mask
                '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
            ]
        );

        $employee_id = $this->db->insert_id;
        if (!$employee_id)  return;

        if ( !empty($dependents) )  foreach($dependents as $dependent)
        {
            $dependent['employees_id'] = $employee_id;

            $this->db->insert($this->table_dependents,
            // data
            $dependent,
            [ // mask
                '%s', '%s', '%s', '%s',
            ]);
        }
    }

    public function updateEmployee($employee): void
    {
        $dependents = $employee['dependents'];
        unset($employee['dependents']);

        $updated = $this->db->update(
            $this->table_employee,
            $employee,
            [ // where
                'matricula' => $employee['matricula'],
            ],
            [ // mask
                '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
            ]
        );

        $employee_id = $this->getIdViaMat($employee['matricula']);

        if (!$updated || !$employee_id)  return;

        if ( !empty($dependents) )  foreach($dependents as $dependent)
        {
            $updated = $this->db->update(
                $this->table_dependents,
                $dependents,
                [ // where
                    'employees_id' => $employee_id,
                ],
                [ // mask
                    '%s','%s','%s','%s'
                ]
            );
        }
    }

    public function getIdViaMat(string $matricula)
    {
        $employee_id = $this->db->get_results(
            "SELECT
                id
            FROM
                $this->table_employee
            WHERE
                matricula = '{$matricula}'
             LIMIT 1;
        ")[0];

        return $employee_id->id;
    }
}