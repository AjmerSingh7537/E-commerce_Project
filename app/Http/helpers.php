<?php

function delete_form($routeParams, $label = 'Delete')
{
    $form = Form::open(['method' => 'DELETE', 'route' => $routeParams]);
    $form .= '<button class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete</button>';
    //$form .= Form::submit($label, ['class' => 'btn btn-danger']);
    return $form .= Form::close();
}