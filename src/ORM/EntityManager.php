<?php

declare(strict_types=1);

namespace App\ORM;

class EntityManager implements ObjectManager
{
    protected $db;
    protected $path;

    public function __construct($path = __DIR__.'/../../var/db')
    {
        $this->path = $path;
        $this->loadDatabase();
    }

    public function resetDatabase(): void
    {
        $this->deleteDatabase();
        $this->createDatabase();
    }

    public function createDatabase(): void
    {
        if (!file_exists($this->path)) {
            $fp = fopen($this->path, 'wb');
            fwrite($fp, '');
            fclose($fp);
        }

        // never do this for real.
        $this->loadDatabase();
    }

    public function loadDatabase(): void
    {
        $this->db = unserialize(file_get_contents($this->path));
    }

    public function deleteDatabase(): void
    {
        @unlink($this->path);
    }

    public function persist($object): void
    {
        if (!method_exists($object, 'getId')) {
            throw new \LogicException(sprintf('Object "%s" must have a public getId method.', get_class($object)));
        }

        $this->db[get_class($object)][$object->getId()] = $object;
    }

    public function remove($object): void
    {
        unset($this->db[get_class($object)][$object->getId()]);
    }

    public function find($className, $id): ?object
    {
        return $this->db[$className][$id] ?? null;
    }

    public function findAll($className): array
    {
        return $this->db[$className] ?? [];
    }

    public function flush(): void
    {
        // never do this for real.
        file_put_contents($this->path, serialize($this->db));
    }
}
