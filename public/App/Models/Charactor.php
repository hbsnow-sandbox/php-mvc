<?php

class Charactor extends AbstractDataModel
{
    protected static $_schema = array(
        'id'         => parent::INTEGER,
        'name'       => parent::STRING
    );

    function isValid()
    {
        return true;
    }
}
