<?php

function getStatus($status)
{
    $data = [

        'inactive' => 'Inactive',
        'active' => 'Active',

    ];

    return $data[$status];
}

function getStatusColor($status)
{
    $data = [
        'inactive' => 'danger',
        'active' => 'success',
    ];
    
    return $data[$status];

}

?>