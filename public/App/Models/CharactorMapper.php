<?php

class CharactorMapper extends AbstractDataMapper
{
    const MODEL_CLASS = 'Charactor';

    /**
     * Model\Entryか、Model\Entryの配列を引数に取り、全部DBにinsertします。
     *
     */
    function insert($data)
    {
        $pdo = $this->_pdo;
        $modelClass = self::MODEL_CLASS;
        $stmt = $pdo->prepare('
            INSERT INTO charactor
            (name, grade, atk, def, created_at)
            VALUES (?, ?, ?, ?)
        ');

        $stmt->bindParam(1, $name, PDO::PARAM_STR);
        $stmt->bindParam(2, $grade, PDO::PARAM_STR);
        $stmt->bindParam(3, $atk, PDO::PARAM_STR);
        $stmt->bindParam(3, $def, PDO::PARAM_STR);
        $stmt->bindParam(4, $created_at, PDO::PARAM_STR);

        if (!is_array($data)) {
            $data = array($data);
        }

        foreach ($data as $row) {
            if (!$row instanceof $modelClass || !$row->isValid()) {
                throw new InvalidArgumentException;
            }

            $name  = $row->name;
            $grade   = $row->grade;
            $atk = $row->atk;
            $def = $row->def;
            $created_at = $row->created_at->format('c');
            $stmt->execute();

            //autoincrementな主キーをオブジェクト側へ反映
            $row->id = $pdo->lastInsertId();
        }
    }



    function update($data)
    {
        $modelClass = self::MODEL_CLASS;

        $stmt = $this->_pdo->prepare('
            UPDATE charactor
            SET name = ?,
                grade = ?,
                atk = ?,
                def = ?,
            WHERE id = ?
        ');

        $stmt->bindParam(1, $name, PDO::PARAM_STR);
        $stmt->bindParam(2, $grade, PDO::PARAM_INT);
        $stmt->bindParam(3, $atk, PDO::PARAM_INT);
        $stmt->bindParam(4, $def, PDO::PARAM_INT);
        $stmt->bindParam(5, $id, PDO::PARAM_INT);

        if (! is_array($data)) {
            $data = array($data);
        }

        foreach ($data as $row) {
            if (! $row instanceof $modelClass || ! $row->isValid()) {
                throw new InvalidArgumentException;
            }

            $id = $row->id;
            $name = $row->name;
            $grade = $row->grade;
            $atk = $row->atk;
            $def = $row->def;
            $stmt->execute();
        }
    }



    function delete($data)
    {
        $modelClass = self::MODEL_CLASS;

        $stmt = $this->_pdo->prepare('
            DELETE FROM charactor
            WHERE id = ?
        ');

        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        if (!is_array($data)) {
            $data = array($data);
        }

        foreach ($data as $row) {
            if (!$row instanceof $modelClass) {
                throw new InvalidArgumentException;
            }

            $id = $row->id;
            $stmt->execute();
        }
    }



    function find($id)
    {
        $stmt = $this->_pdo->prepare('
            SELECT *
            FROM charactor
            WHERE id = ?
        ');

        $stmt->bindParam(1, $entridyId, PDO::PARAM_INT);
        $stmt->execute();
        $this->_decorate($stmt);

        return $stmt->fetch();
    }

    function findAll()
    {
        $stmt = $this->_pdo->query('
            SELECT *
            FROM charactor
        ');

        return $this->_decorate($stmt);
    }
}
