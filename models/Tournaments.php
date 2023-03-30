<?php
class Tournaments extends model
{

    public function getList($offset, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM tournament WHERE id_company = :id_company ORDER BY status ASC, name_tourney ASC LIMIT $offset, 10");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getListAll($id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM tournament WHERE id_company = :id_company AND status = 1 ORDER BY name_tourney ASC");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
        
    }

    public function getInfo($id, $id_company){
        $array = array();
    
        $sql = $this->db->prepare("SELECT * FROM tournament WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    
        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }
    
        return $array;
    
    }

    public function getCount($id_company){
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as c FROM tournament WHERE id_company = :id_company");
		$sql->bindValue('id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['c'];



		return $r;
	}

    public function add($name_tourney, $local_tourney, $id_company)
    {

        $sql = $this->db->prepare("INSERT INTO tournament SET name_tourney = :name_tourney, local_tourney = :local_tourney, status = '1', id_company = :id_company");

        $sql->bindValue(":name_tourney", $name_tourney);
        $sql->bindValue(":local_tourney", $local_tourney);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }

    public function edit($id, $name_tourney, $local_tourney, $status, $id_company)
    {
        $sql = $this->db->prepare("UPDATE tournament SET name_tourney = :name_tourney, local_tourney = :local_tourney, status = :status WHERE id = :id AND id_company = :id_company");

        $sql->bindValue(":id", $id);
        $sql->bindValue(":name_tourney", $name_tourney);
        $sql->bindValue(":local_tourney", $local_tourney);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }


    public function delete($id, $id_company)
    {
        $sql = $this->db->prepare("DELETE FROM tournament WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }

}
