<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 18/06/18
 * Time: 17:28
 */

namespace application\core;


abstract class crud
{
    public static $dbconnect;
    public $_tabela;

    public function create(Array $dados) {

        self::$dbconnect = $this->_connect();

        $campos = implode(", ", array_keys($dados));
        $valores  = implode(", ", array_values($dados));
        $sql = "INSERT INTO `".$this->_tabela."`";

        $sql .= "(".$campos.") VALUES (".$valores.");";
        $statement = self::$dbconnect->prepare($sql);

        if($statement->execute()){

            return array ('create status' => 'success');
        }else{

            return array ('create status' => 'fail');
        }

    }

    public function read(Array $where = null) {

        self::$dbconnect = $this->_connect();

        $sql = "SELECT * FROM ".$this->_tabela;

        if(!is_null($where)){

            $condicoes = array();

            foreach (array_keys($where) as $nomeCampo) { // array_keys($where) vai retornar array('id', 'nome')
                $condicoes []= "`{$nomeCampo}` = :{$nomeCampo}";
            }

            $condicaoString = implode(' AND ', $condicoes);
            if (!empty($condicaoString)) {
                $sql = $sql." WHERE {$condicaoString}";
            }
        }




        $statement = self::$dbconnect->prepare($sql);





        if(!is_null($where)){

            foreach ($where as $chave=>$value){

                $statement->bindValue(":{$chave}", $value);

            }
        }



        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function update(Array $dados, Array $where) {

        self::$dbconnect = $this->_connect();

        foreach($dados as $inds => $vals){
            $campos[] = "`".$inds."` = ".$vals;
        }

        $campos = implode(", ", $campos);

        $sql = "UPDATE `".$this->_tabela."` SET ".$campos;

        if(!is_null($where)){

            $condicoes = array();

            foreach (array_keys($where) as $nomeCampo) { // array_keys($where) vai retornar array('id', 'nome')
                $condicoes []= "`{$nomeCampo}` = :{$nomeCampo}";
            }

            $condicaoString = implode(' AND ', $condicoes);
            if (!empty($condicaoString)) {
                $sql = $sql." WHERE {$condicaoString}";
            }
        }


        $statement = self::$dbconnect->prepare($sql);

        if(!is_null($where)){

            foreach ($where as $chave=>$value){

                $statement->bindValue(":{$chave}", $value);

            }
        }

        if($statement->execute()){

            return array ('update status' => 'success');
        }else{

            return array ('update status' => 'fail');
        }
    }

    public function delete(Array $where) {

        self::$dbconnect = $this->_connect();

        $sql = "DELETE FROM ".$this->_tabela;
        if(!is_null($where)){

            $condicoes = array();

            foreach (array_keys($where) as $nomeCampo) { // array_keys($where) vai retornar array('id', 'nome')
                $condicoes []= "`{$nomeCampo}` = :{$nomeCampo}";
            }

            $condicaoString = implode(' AND ', $condicoes);
            if (!empty($condicaoString)) {
                $sql = $sql." WHERE {$condicaoString}";
            }
        }

        $statement = self::$dbconnect->prepare($sql);

        if(!is_null($where)){

            foreach ($where as $chave=>$value){

                $statement->bindValue(":{$chave}", $value);

            }
        }

        if($statement->execute()){

            return array ('remove status' => 'success');
        }else{

            return array ('remove status' => 'fail');
        }

    }

    public function extract(Array $where = null){



        self::$dbconnect = $this->_connect();

        $sql = "SELECT * FROM ".$this->_tabela;


        if(!is_null($where)){

            $condicoes = array();

            foreach (array_keys($where) as $nomeCampo) { // array_keys($where) vai retornar array('id', 'nome')
                $condicoes []= "`{$nomeCampo}` = :{$nomeCampo}";
            }

            $condicaoString = implode(' AND ', $condicoes);
            if (!empty($condicaoString)) {
                $sql = $sql." WHERE {$condicaoString}";
            }
        }

        $sql = $sql." ORDER BY expirate_date ASC";

        $statement = self::$dbconnect->prepare($sql);





        if(!is_null($where)){

            foreach ($where as $chave=>$value){

                $statement->bindValue(":{$chave}", $value);

            }
        }




        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);

    }
}