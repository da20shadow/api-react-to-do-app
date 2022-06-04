<?php

namespace Database;

use Generator;
use PDOStatement;

class PDOResultSet implements ResultSetInterface
{

    private PDOStatement $pdoStatement;

    /**
     * @param PDOStatement $pdoStatement
     */
    public function __construct(PDOStatement $pdoStatement)
    {
        $this->pdoStatement = $pdoStatement;
    }

    public function fetch($className): Generator
    {
        while ($row = $this->pdoStatement->fetchObject($className)){

            yield $row;
        }
    }
}