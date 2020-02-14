<?php

namespace App\Entity;

interface IBuyable
{
    public function getId() : int;
    public function getName() : string;
    public function setName($name) : void;
    public function getPrice() : int;
    public function setPrice($price) : void;
    public function getCategorie() : int;
    public function setCategorie($categorie) : void;
}