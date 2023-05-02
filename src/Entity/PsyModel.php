<?php
// src/Entity/Quiz.php
// src/Entity/Quiz.php

namespace App\Entity;

use App\Repository\QuizRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
class PsyModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getPsyUsers() {
        $sql = "SELECT * FROM user WHERE speciality = 'Psy'";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
