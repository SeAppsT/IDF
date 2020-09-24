<?php

class SqlMapper implements Mapper {
    private ?PDO $dbHandler = null;
    private $mode;
    private $name;

    public function setDbHandler(PDO $dbHandler): void {
        $this -> dbHandler = $dbHandler;
    }

    public function setMode($mode): void {
        $this -> mode = $mode;
    }

    public function getName(){
        return $this -> name;
    }

    public function insert(DataObject $entity){
        $partQuery = Array(
            'fields' => '',
            'placeholders' => ''
        );
        $i = 1;
        $partQuery['fields'] = '';
        $partQuery['placeholders'] = '';
        $values = Array();
        foreach ($entity -> getFields() as $field => $value){
            if ($field != $entity -> getCredentials()['identifier'] && $value != null) {
                $partQuery['fields'] .= $field;
                $partQuery['placeholders'] .= '?';
                $values[] = $value;

                if ($i != count($entity -> getFields())) {
                    $partQuery['fields'] .= ', ';
                    $partQuery['placeholders'] .= ', ';
                }
            }
            $i++;
        }
        $query = 'INSERT INTO '.$entity -> getName().' ('.$partQuery['fields'].') VALUES ('.$partQuery['placeholders'].')';
        if (Source::$debug == true){
            $this -> showSQL(new DBDto($query, $values), 'greenyellow');
        }
        $prepared = $this -> dbHandler -> prepare($query);
        $prepared -> execute($values);
    }

    public function update(DataObject $entity){
        $partQuery = null;
        $i = 1;
        $identifier = 0;
        foreach ($entity -> getFields() as $field => $value){
            if ($entity -> getCredentials()['identifier'] != $field && $value != null) {
                $partQuery .= $field . ' = ?';
                $values[] = $value;
                if ($i != count($entity->getFields())) {
                    $partQuery .= ', ';
                }
            } else
                $identifier = $value;
            $i++;
        }
        $query = 'UPDATE '.$entity -> getName().' SET '.$partQuery.' WHERE '.$entity -> getCredentials()['identifier'].' = '.$identifier;
        if (Source::$debug == true)
            $this -> showSQL(new DBDto($query, $values), 'yellow');

        $prepared = $this -> dbHandler -> prepare($query);
        $prepared -> execute($values);
    }

    public function delete(DataObject $entity){
        $query = 'DELETE FROM '.$entity -> getName().' WHERE '.$entity -> getCredentials()['identifier'].' = ?';
        if (Source::$debug == true)
            $this -> showSQL(new DBDto($query, [$entity -> getFields()[$entity -> getCredentials()['identifier']]]), 'red');
        $prepared = $this -> dbHandler -> prepare($query);
        $prepared -> execute([$entity -> getFields()[$entity -> getCredentials()['identifier']]]);
    }

    public function query(Query $query){
        $action = $query -> getAction();
        if ($action == 'del') return $this -> del($query);
        if ($action == 'one') return $this -> select($query)[0];
        if ($action == 'get') return $this -> select($query);
        return null;
    }

    public function del(Query $query){
        $dto = $this -> scanConditions($query -> getConditions());
        $sqlString = 'DELETE FROM '.$query -> getEntity() -> getName().$dto -> query;
        $dto -> query = $sqlString;
        if (Source::$debug == true)
            $this -> showSQL($dto, 'red');
        print_r($sqlString);
    }

    public function select(Query $query){
        $dto = $this -> scanConditions($query -> getConditions());
        $sqlString = 'SELECT * FROM '.$query -> getEntity() -> getName().' '.$dto -> query;
        $dto -> query = $sqlString;
        if (Source::$debug == true)
            $this -> showSQL($dto, 'cornflowerblue');
        $result = $this -> executeResultableQuery($query -> getEntity(), $dto);
        if (!empty($result) && !empty($query -> getSubQueries())){
            foreach ($query -> getSubQueries() as $subQuery){
                if ($subQuery -> getType() == 'in'){
                    $table = $subQuery -> getQuery() -> getEntity() -> getName();
                    $resField = $query -> getEntity() -> getCredentials()['identifier'];
                    if (is_array($result)){
                        foreach ($result as $item){
                            $cloned = clone $subQuery -> getQuery();
                            $item -> $table = $cloned -> search($subQuery -> getField(), equals($result -> $resField)) -> go($query -> getConnectionName());
                        }
                    } else{
                        $cloned = clone $subQuery -> getQuery();
                        $result -> $table = $cloned -> search($subQuery -> getField(), equals($result -> $resField)) -> go($query -> getConnectionName());
                    }
                }

                if ($subQuery -> getType() == 'out'){
                    $resField = $query -> getEntity() -> getCredentials()['identifier'];
                    $currField = $subQuery -> getField();
                    if (is_array($result)){
                        foreach ($result as $item){
                            $cloned = clone $subQuery -> getQuery();
                            $item -> $currField = $cloned -> search($resField, equals($result -> $currField)) -> go($query -> getConnectionName());
                        }
                    } else{
                        $cloned = clone $subQuery -> getQuery();
                        $result -> $currField = $cloned -> search($resField, equals($result -> $currField)) -> go($query -> getConnectionName());
                    }
                }
            }
        }
        return $result;
    }

    public function scanConditions(array $conditions): DBDto{
        $sqlString = ' WHERE ';

        $i = 1;
        foreach ($conditions as $field => $value){
            $sqlString .= $field . ' '.$value['operator'].' ?';
            $values[] = $value['value'];
            if ($i != count($conditions)) {
                $sqlString .= ' AND ';
            }
            $i++;
        }
        return new DBDto($sqlString, $values);
    }

    public function executeResultableQuery(DataObject $entity, DBDto $dto){
        $prepared = $this -> dbHandler -> prepare($dto -> query);
        $executed = $prepared -> execute($dto -> params);
        return $prepared -> fetchAll(PDO::FETCH_CLASS, $entity -> __toString());
    }

    public function showSQL(DBDto $dto, $color){
        echo '<div style="margin: 50px; padding: 20px; border-radius: 5px; background-color: '.$color.'; font-weight: bold; font-family: arial, sans-serif;">';
        print_r($dto -> query);
        echo '<br /> <pre>';
        print_r($dto -> params);
        echo '</pre></div>';
    }
}