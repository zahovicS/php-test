<?php

namespace Src\Database;

use Src\DataBase\Abstracts\ORM;

class Model extends ORM{
    protected $table;
    protected $primaryKey;
}