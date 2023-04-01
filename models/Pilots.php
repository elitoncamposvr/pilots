<?php
class Pilots extends model
{

    public function getList($offset, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM pilots WHERE id_company = :id_company ORDER BY fullname_pilot ASC LIMIT $offset, 15");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getListPilotsRegistrations($tourney_registration, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM pilots WHERE  tourney_registration LIKE '%$tourney_registration%'");
        $sql->bindValue(":tourney_registration", $tourney_registration);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }


    public function getInfo($id, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM pilots WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue("id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();

            $array['tourney_registration'] = explode(',', $array['tourney_registration']);
        }

        return $array;
    }

    public function getCount($id_company)
    {
        $r = 0;

        $sql = $this->db->prepare("SELECT COUNT(*) as pd FROM pilots WHERE id_company = :id_company");
        $sql->bindValue('id_company', $id_company);
        $sql->execute();
        $row = $sql->fetch();

        $r = $row['pd'];



        return $r;
    }

    public function isRegistered($fullname_pilot, $cellphone, $nickname_pilot, $cpf, $birth_date)
    {

        $sql = $this->db->prepare("SELECT * FROM pilots WHERE cpf = :cpf");
        $sql->bindValue(':cpf', $cpf);

        $sql->execute();


        if ($sql->rowCount() > 0) {
            $sql->fetch();

            return true;
        } else {
            $this->registerPilots($fullname_pilot, $cellphone, $nickname_pilot, $cpf, $birth_date, 1);
        }
    }


    public function registerPilots($fullname_pilot, $cellphone, $nickname_pilot, $cpf, $birth_date, $id_company)
    {

        $sql = $this->db->prepare("INSERT INTO pilots SET fullname_pilot = :fullname_pilot, cellphone = :cellphone, nickname_pilot = :nickname_pilot, cpf = :cpf, birth_date = :birth_date, date_registration = NOW(), id_company = :id_company");

        $sql->bindValue(":fullname_pilot", $fullname_pilot);
        $sql->bindValue("cellphone", $cellphone);
        $sql->bindValue("nickname_pilot", $nickname_pilot);
        $sql->bindValue("cpf", $cpf);
        $sql->bindValue("birth_date", $birth_date);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }

    public function add($fullname_pilot, $cellphone, $nickname_pilot, $cpf, $birth_date, $id_company)
    {

        $sql = $this->db->prepare("INSERT INTO pilots SET fullname_pilot = :fullname_pilot, cellphone = :cellphone, nickname_pilot = :nickname_pilot, cpf = :cpf, birth_date = :birth_date, date_registration = NOW(), id_company = :id_company");

        $sql->bindValue(":fullname_pilot", $fullname_pilot);
        $sql->bindValue("cellphone", $cellphone);
        $sql->bindValue("nickname_pilot", $nickname_pilot);
        $sql->bindValue("cpf", $cpf);
        $sql->bindValue("birth_date", $birth_date);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }


    public function edit($id, $id_company, $fullname_pilot, $cellphone, $nickname_pilot, $cpf, $birth_date)
    {
        $sql = $this->db->prepare("UPDATE pilots SET fullname_pilot = :fullname_pilot, cellphone = :cellphone, cellphone = :cellphone, nickname_pilot = :nickname_pilot, cpf = :cpf, birth_date = :birth_date WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":fullname_pilot", $fullname_pilot);
        $sql->bindValue("cellphone", $cellphone);
        $sql->bindValue("nickname_pilot", $nickname_pilot);
        $sql->bindValue("cpf", $cpf);
        $sql->bindValue("birth_date", $birth_date);

        $sql->execute();
    }

    public function delete($id, $id_company)
    {
        $sql = $this->db->prepare("DELETE FROM pilots WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
    }

    public function tourneyRegistration($id, $plist, $id_company)
    {
        $tourney_registration = implode(',', $plist);

        $sql = $this->db->prepare("UPDATE pilots SET tourney_registration = :tourney_registration WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":tourney_registration", $tourney_registration);
        $sql->execute();
    }

    public function searchPilots($sp, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM pilots WHERE fullname_pilot LIKE '%$sp%' ORDER BY fullname_pilot ASC");
        $sql->bindValue(":client_id", $sp . '%');
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
}
