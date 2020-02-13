<?php

declare(strict_types=1);

namespace App\ORM;

/**
 * Contract for a persistence layer ObjectManager class to implement.
 */
interface ObjectManager
{
    /**
     * Tells the ObjectManager to make an instance managed and persistent.
     *
     * The object will be entered into the database as a result of the flush operation.
     *
     * NOTE: The persist operation always considers objects that are not yet known to
     * this ObjectManager as NEW. Do not pass detached objects to the persist operation.
     *
     * @param object $object the instance to make managed and persistent
     */
    public function persist($object);

    /**
     * Removes an object instance.
     *
     * A removed object will be removed from the database as a result of the flush operation.
     *
     * @param object $object the object instance to remove
     */
    public function remove($object);

    /**
     * Flushes all changes to objects that have been queued up to now to the database.
     * This effectively synchronizes the in-memory state of managed objects with the
     * database.
     */
    public function flush();

    /**
     * Finds an object by its identifier.
     *
     * @param string $className the class name of the object to find
     * @param mixed  $id        the identity of the object to find
     *
     * @return object|null the found object
     */
    public function find($className, $id);

    /**
     * Finds a collection of objects.
     *
     * @param string $className the class name of the object to find
     *
     * @return object|null the found object
     */
    public function findAll($className);
}
