<?php

require_once 'vendor/autoload.php';

// create custom plugin settings menu
add_action('admin_menu', 'tem_reg_create_menu');
// avoid zlib warnings on site and pannel
remove_action('shutdown', 'wp_ob_end_flush_all', 1);

use Ternium\Plugin\Import;
use Ternium\Plugin\Employee;


$importer = new Import([
    'debug' => true,
]);
$importer->watchForImportations();



/**
 * Create top-level menu
 */
function tem_reg_create_menu() {
    add_menu_page('Ternium Employees Manager', 'Employees', 'administrator', __FILE__, 'tem_main');
    add_action('admin_init', 'tem_reg_register_settings');
}

/**
 * Register fields
 */
function tem_reg_register_settings() {
    register_setting('ttoa-reg-settings-group', 'plugin_action');
}

function tem_main() {
    global $wpdb;

    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" integrity="sha256-zuyRv+YsWwh1XR5tsrZ7VCfGqUmmPmqBjIvJgQWoSDo=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
    	<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

    <!-- LOCAL JS -->
    <script type="text/javascript">
        jQuery(document).ready(function() {

            $("#maintable").DataTable({
                dom: 'Bfrtip',
				buttons: [
					'csv', 'excel', 'pdf', 'print'
				]
            });

            /**
             * Click event for uploading file
             */
            $("#import-spreadsheet").click(function() {
                var file = $("input[name='spreadsheet']").val();
                if ( !file || file == '')  return;

                $("form[name='file-upload-form']").submit();
            });

            $(document).on("click", ".employee", function() {
                var id = $(this).data('idbox');
                var content = $("#box_"+id ).html();

                Swal.fire({
                    html: content,
                    icon: 'info',
                    width: '70%',
                });

            });
        });
    </script>
    <!-- LOCAL JS -->

    <div class="container">
        <div class="page-header">
            <h1>Gerenciamento Convidados</h1>
        </div>

        <!-- Upload Form -->
        <div class="row">
            <div class="col-md-12">

                <div class="col-md-2">
                    <button id="import-spreadsheet" class="btn btn-success">Importar Planilha</button>
                </div>

                <div class="col-md-2">
                    <div style="display: none;" data-import_status="<?= $importer->importationStatus; ?>"></div>
                    <form name="file-upload-form" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="import"/>
                        <input class="form-control-file" type="file" name="spreadsheet" value=""/>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">

                <small>Legenda:</small>
                <small style="background-color: #dff0d8; padding: 10px;">Convidado confirmado.</small>
                <small style="background-color: #fcf8e3; padding: 10px;">Convidado ainda não confirmado.</small>
                <small style="background-color: #f2dede; padding: 10px;">Convidado Fez Observação</small>
            <hr>
                <table id="maintable" class="table">
                    <thead>

                        <th>Matrícula</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Estado Civil</th>
                        <th>Dia da Festa</th>
                        <th>Vai de ônibus</th>
                        <th>Confirmado</th>
                        <th>Com Observação</th>
                    </thead>
                    <tbody>
                        <?php
                        // Retrieve all the employees with their dependents
                        $employees = Employee::getAllEmployeesWithDependents();

                        if (isset($employees)) foreach($employees as $employee): ?>
                            <tr
                                class="
                                    <?php if ($employee->confirmado && empty($employee->obs)): ?>
                                    success
                                    <?php elseif(!$employee->confirmado && empty($employee->obs)): ?>
                                    warning
                                    <?php elseif(!empty($employee->obs)): ?>
                                    danger
                                    <?php endif; ?>
                                 employee"
                                data-idbox="<?= $employee->id ?>"
                                style="
                                    cursor: pointer;
                                    text-transform: capitalize;
                                "
                                onMouseOver="this.style.color='#3c3c3c3c'"
                                onMouseOut="this.style.color=''"
                            >
                                <td><?= $employee->matricula; ?></td>
                                <td><?= $employee->nome; ?></td>
                                <td><?= $employee->cpf; ?></td>
                                <td><?= $employee->estado_civil; ?></td>
                                <td><?= $employee->data_festa; ?></td>
                                <td><?= $employee->onibus == 1? 'Sim': 'Não'; ?></td>
                                <td class="<?= $employee->confirmado == 1? 'success': ''; ?>"><?= $employee->confirmado == 1? 'Confirmado': 'Não'; ?></td>
                                <td><?= empty($employee->obs)? 'Não': 'Observação'; ?></td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php if (isset($employees))

    foreach($employees as $employee): ?>
        <?php if(!empty($employee->dependents)): ?>
                <div id="box_<?= $employee->id ?>" style="display:none;">
                    <h3>Informações Convidado</h3>
                        <ul>
                            <li><b>Matricula:</b> <?= $employee->matricula; ?></li>
                            <li style="text-transform: capitalize;"><b>Nome: </b><?= $employee->nome; ?></li>
                            <li><b>Cpf/PassPort: </b><?= $employee->cpf; ?></li>
                            <li><b>Estado Civil: </b><?= $employee->estado_civil; ?></li>
                            <li><b>Data da Festa: </b><?= $employee->data_festa; ?></li>
                            <li><b>Data da Festa: </b><?= $employee->confirmado? 'Sim': 'Não'; ?></li>
                            <li><b>Email: </b><a
                                href="
                                    mailto:<?= $employee->email; ?>?body=Em Resposta a:<?= $employee->obs; ?>
                                "
                            ><?= $employee->email; ?></a></li>
                            <li><b>Telefone: </b><?= $employee->telefone; ?></li>
                            <li><b>Observação: </b><h4><?= $employee->obs; ?></h4></li>
                        <ul>

                    <hr/>
                    <h3>Informações Dependentes</h3>
                    <table class="table" style="text-align: center;">
                        <thead>
                            <tr style="text-align: center;">
                                <th>Nome</th>
                                <th>Parentesco</th>
                                <th>Data de nascimento</th>
                                <th>Confirmado</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($employee->dependents as $dependent): ?>
                            <tr class="<?= (($dependent->confirmado)? 'success': 'danger'); ?> employee">
                                <td style="text-transform: capitalize;"> <?= $dependent->nome  ?></td>
                                <td><?= $dependent->parentesco  ?></td>
                                <td><?= $dependent->data_nascimento  ?></td>
                                <td><?= $dependent->confirmado == 1? 'Sim': 'Não'  ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif;
        endforeach;
}
