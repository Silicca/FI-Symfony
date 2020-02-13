<?php

declare(strict_types=1);

namespace App\Entity;

final class DoStuff
{
    private $id;

    private $stuffToDo;

    public function __construct()
    {
        $this->id = \App\ORM\Util\UUID::v4();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setStuffToDo(string $stuffToDo): void
    {
        $this->stuffToDo = $stuffToDo;
    }
}
