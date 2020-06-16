<?php
add_action('rest_api_init', function()
{
    /**
	 * Route to confirm employee
	 *
	 * @return respose JSON
	 **/
	register_rest_route('api/v1/', 'employee/confirm', [
		'methods' => WP_REST_Server::CREATABLE,
		'callback' => 'confirm',
        'args' => [
			'employee_id' => [
				'required' => true,
				'type' => 'string',
			],
            'dependents_id' => [
                'required' => false,
                'type' => 'array',
            ],
			'onibus' => [
				'required' => true,
				'type' => 'string',
			],
			'obs' => [
				'required' => false,
				'type' => 'string',
			],
			'email' => [
				'required' => false,
				'type' => 'string',
			],
			'telefone' => [
				'required' => false,
				'type' => 'string',
			],

			'dependente_nome' => [
				'required' => false,
				'type' => 'string',
			],
			'dependente_parentesco' => [
				'required' => false,
				'type' => 'string',
			],
			'dependente_idade' => [
				'required' => false,
				'type' => 'string',
			],

        ],
	]);

    register_rest_route('api/v1/', 'employee/signin', [
		'methods' => WP_REST_Server::CREATABLE,
		'callback' => 'signin',
        'args' => [
			'cpf' => [
				'required' => true,
				'type' => 'string',
			],
			'id_8' => [
				'required' => true,
				'type' => 'string',
			],
        ],
	]);

    register_rest_route('api/v1/', 'employee/login', [
		'methods' => WP_REST_Server::CREATABLE,
		'callback' => 'login',
        'args' => [
			'cpf' => [
				'required' => true,
				'type' => 'string',
			],
            'password' => [
				'required' => true,
				'type' => 'string',
			],
        ],
	]);

    register_rest_route('api/v1/', 'employee/logout', [
		'method' => WP_REST_Server::READABLE,
		'callback' => 'logout',
	]);

	 register_rest_route('api/v1/', 'employee/check', [
		'method' => WP_REST_Server::READABLE,
		'callback' => 'checkSession',
	]);

	register_rest_route('api/v1/', 'test/(?P<cpf>\d+)', [
		'method' => WP_REST_Server::READABLE,
		'callback' => 'test',
        'args' => [
			'cpf' => [
				'required' => true,
				'type' => 'string',
			],
        ],
	]);

});
