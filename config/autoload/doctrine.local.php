<?php
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOPgSql\Driver',
                'params' => array(
                    'user' => 'postgres',
                    'password' => 'asdf1234',
                ),
            ),
            
        )
    )
);