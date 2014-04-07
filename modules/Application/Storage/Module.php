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

//    public function getSourceInfoByModuleID($moduleID)
//    {
//        $row = $this->ds->createQueryBuilder()
//            ->select('si.*')
//            ->from('module_source_info', 'si')
//            ->andWhere('si.module_id = :moduleID')->setParameter(':moduleID', $moduleID)
//            ->execute()
//            ->fetch(self::fetchMode);
//
//        if ($row === false) {
//            throw new \Exception('Unable to obtain source info for module id: ' . $moduleID);
//        }
//
//        return new SourceEntity($row);
//    }

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

    public function create(ModuleEntity $entity)
    {
        $data = $entity->toInsertArray();
        $data['last_updated'] = date('Y-m-d h:i:s');

        $rowsAffected = $this->ds->insert(self::tableName, $data);
        return $this->ds->lastInsertId();
    }

    public function setCompleted($moduleID, $flag)
    {
        $rowsAffected = $this->ds->update(
            self::tableName,
            array('is_completed' => (int) $flag, 'last_updated' => date('Y-m-d h:i:s')),
            array('id' => $moduleID)
        );
        return true;
    }

    /**
     * Update the description of the specified module
     *
     * @param integer $moduleID
     * @param string $desc
     * @return bool True if rows were updated. False if not
     */
    public function updateDescription($moduleID, $desc)
    {
        $rowsAffected = $this->ds->update(
            self::tableName,
            array('description' => $desc, 'last_updated' => date('Y-m-d i:h:s')),
            array('id' => $moduleID)
        );

        // If you pass in the same desc twice then affected rows is 0, but it successfully ran the query
        return true;
    }

    /**
     * Check if a module exists by the given title
     *
     * @param string $title
     * @return bool
     * @throws \Exception On SQL failure
     */
    public function existsByTitle($title)
    {

        $row = $this->ds->createQueryBuilder()
            ->select('count(id) as count')
            ->from(self::tableName, 'm')
            ->andWhere('m.title = :moduleID')->setParameter(':moduleID', $title)
            ->execute()
            ->fetch(self::fetchMode);

        if ($row === false) {
            throw new \Exception('Unable to obtain module by title');
        }

        if(isset($row['count']) && intval($row['count']) > 0) {
            return true;
        }

        return false;
    }

}
