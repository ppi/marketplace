<?php
namespace Application\Storage;

use Application\Storage\Base as BaseStorage;
use Application\Entity\ModuleEntity;
use Application\Entity\ModuleCommentEntity;
use Application\Entity\ModuleScreenshotEntity;
use Application\Entity\AuthorEntity;
use Application\Entity\SourceEntity;

class Module extends BaseStorage
{

    const fetchMode = \PDO::FETCH_ASSOC;
    const tableName = 'module';

    /**
     * Find a user record by its ID
     *
     * @param $id
     * @return
     */
    public function findByID($id)
    {
        return $this->find($id);
    }

    /**
     * Get an entity by its ID
     *
     * @param $userID
     * @return mixed
     * @throws \Exception
     */
    public function getByID($moduleID)
    {

        $row = $this->ds->createQueryBuilder()
            ->select('m.*')
            ->from(self::tableName, 'm')
            ->andWhere('m.id = :moduleID')->setParameter(':moduleID', $moduleID)
            ->execute()
            ->fetch(self::fetchMode);

        if ($row === false) {
            throw new \Exception('Unable to obtain module row for id: ' . $moduleID);
        }

        return new ModuleEntity($row);

    }

    public function getCommentsByModuleID($moduleID)
    {
        $rows = $this->ds->createQueryBuilder()
            ->select('mc.*')
            ->from('module_comment', 'mc')
            ->andWhere('mc.module_id = :moduleID')->setParameter(':moduleID', $moduleID)
            ->execute()
            ->fetchAll(self::fetchMode);

        if ($rows === false) {
            throw new \Exception('Unable to obtain comments for module id: ' . $moduleID);
        }

        $ent = array();
        foreach ($rows as $r) {
            $ent[] = new ModuleCommentEntity($r);
        }
        return $ent;

    }

    /**
     * Get all screenshots for a module
     *
     * @param integer $moduleID
     * @return array
     * @throws \Exception
     */
    public function getScreenshotsByModuleID($moduleID)
    {
        $rows = $this->ds->createQueryBuilder()
            ->select('ms.*')
            ->from('module_screenshot', 'ms')
            ->andWhere('ms.module_id = :moduleID')->setParameter(':moduleID', $moduleID)
            ->execute()
            ->fetchAll(self::fetchMode);

        if ($rows === false) {
            throw new \Exception('Unable to obtain screenshots for module id: ' . $moduleID);
        }

        $ent = array();
        foreach ($rows as $r) {
            $ent[] = new ModuleScreenshotEntity($r);
        }
        return $ent;
    }

    public function getSourceInfoByModuleID($moduleID)
    {
        $row = $this->ds->createQueryBuilder()
            ->select('si.*')
            ->from('module_source_info', 'si')
            ->andWhere('si.module_id = :moduleID')->setParameter(':moduleID', $moduleID)
            ->execute()
            ->fetch(self::fetchMode);

        if ($row === false) {
            throw new \Exception('Unable to obtain source info for module id: ' . $moduleID);
        }

        return new SourceEntity($row);
    }

    public function getAuthorsByModuleID($moduleID)
    {
        $rows = $this->ds->createQueryBuilder()
            ->select('a.*')
            ->from('module_author', 'a')
            ->andWhere('a.module_id = :moduleID')->setParameter(':moduleID', $moduleID)
            ->execute()
            ->fetchAll(self::fetchMode);

        if ($rows === false) {
            throw new \Exception('Unable to obtain screenshots for module id: ' . $moduleID);
        }

        $ent = array();
        foreach ($rows as $r) {
            $ent[] = new AuthorEntity($r);
        }
        return $ent;
    }

    public function rowsToEntities($rows)
    {
        $ent = array();
        foreach ($rows as $r) {
            $ent[] = new ModuleEntity($r);
        }
        return $ent;
    }

}
