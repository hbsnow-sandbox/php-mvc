<?php

class Charactor extends AbstractDataModel
{
    protected static $_schema = array(
        'id'   => parent::INTEGER,
        'name'    => parent::STRING,
        'grade'   => parent::INTEGER,
        'atk'   => parent::INTEGER,
        'def'   => parent::INTEGER,
        'created_at' => parent::DATETIME
    );

    function isValid()
    {
        return true;
    }
}
