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
    const FETCH_MODE = \PDO::FETCH_ASSOC;
    const TABLE_NAME = 'module';

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
            ->select(
                'm.id, m.title, m.author_id, m.github_url, m.last_updated, m.is_completed, m.created,
                 IFNULL(m.num_stars, 0) as num_stars, IFNULL(m.num_downloads, 0) as num_downloads,
                 m.short_description, mi.content as installation_details, md.content as description'
            )
            ->from(self::TABLE_NAME, 'm')
            ->leftJoin('m', 'module_installation', 'mi', 'm.id = mi.module_id')
            ->leftJoin('m', 'module_description', 'md', 'm.id = md.module_id')
            ->andWhere('m.id = :moduleID')->setParameter(':moduleID', $moduleID)
            ->execute()
            ->fetch(self::FETCH_MODE);

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
            ->fetchAll(self::FETCH_MODE);

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
            ->fetchAll(self::FETCH_MODE);

        if ($rows === false) {
            throw new \Exception('Unable to obtain screenshots for module id: ' . $moduleID);
        }

        $ent = array();
        foreach ($rows as $r) {
            $ent[] = new ModuleScreenshotEntity($r);
        }
        return $ent;
    }

    /**
     * Gets a single screenshot entity by id
     *
     * @param integer $screenshotID
     * @return ModuleScreenshotEntity
     * @throws \Exception
     */
    public function getScreenshotByID($screenshotID)
    {
        $row = $this->ds->createQueryBuilder()
            ->select('ms.*')
            ->from('module_screenshot', 'ms')
            ->andWhere('ms.id = :screenshotID')->setParameter(':screenshotID', $screenshotID)
            ->execute()
            ->fetch(self::FETCH_MODE);

        if ($row === false) {
            throw new \Exception('Unable to obtain screenshot for screenshot id: ' . $screenshotID);
        }

        return new ModuleScreenshotEntity($row);
    }

    /**
     * Deletes a Screenshot by id
     *
     * @param integer $screenshotID
     * @return ModuleScreenshotEntity OR false
     */

    public function deleteScreenshotByID($screenshotID)
    {
        $tempScreenshot = $this->getScreenshotByID($screenshotID);
        return ($this->ds->delete('module_screenshot', array('id'=>$screenshotID)) > 0) ? $tempScreenshot : false;
    }

//    public function getSourceInfoByModuleID($moduleID)
//    {
//        $row = $this->ds->createQueryBuilder()
//            ->select('si.*')
//            ->from('module_source_info', 'si')
//            ->andWhere('si.module_id = :moduleID')->setParameter(':moduleID', $moduleID)
//            ->execute()
//            ->fetch(self::FETCH_MODE);
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
            ->fetchAll(self::FETCH_MODE);

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
        $data['created'] = date('Y-m-d h:i:s');

        $rowsAffected = $this->ds->insert(self::TABLE_NAME, $data);
        return $this->ds->lastInsertId();
    }

    public function update(ModuleEntity $entity)
    {
        $data = $entity->toUpdateArray();
        $data['last_updated'] = date('Y-m-d h:i:s');
        return $this->ds->update(self::TABLE_NAME, $data, array('id'=>$entity->getID()));
    }

    public function createScreenshot(ModuleScreenshotEntity $entity)
    {
        $data = $entity->toInsertArray();
        $this->ds->insert('module_screenshot', $data);
        return $this->ds->lastInsertId();
    }

    public function getDescByModuleId($id)
    {
        $row = $this->ds->createQueryBuilder()
            ->select('md.content')
            ->from('module_description', 'md')
            ->andWhere('md.module_id = :id')->setParameter(':id', $id)
            ->execute()
            ->fetch(self::FETCH_MODE);

        return isset($row['content']) ? $row['content'] : '';

    }

    public function setCompleted($moduleID, $flag)
    {
        $rowsAffected = $this->ds->update(
            self::TABLE_NAME,
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
        $this->ds->delete('module_description', ['module_id' => $moduleID]);

        $rowsAffected = $this->ds->insert(
            'module_description',
            array(
                'content' => $desc,
                'module_id' => $moduleID
            ),
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
            ->from(self::TABLE_NAME, 'm')
            ->andWhere('m.title = :moduleID')->setParameter(':moduleID', $title)
            ->execute()
            ->fetch(self::FETCH_MODE);

        if ($row === false) {
            throw new \Exception('Unable to obtain module by title');
        }

        if (isset($row['count']) && intval($row['count']) > 0) {
            return true;
        }

        return false;
    }

    public function getPopularModules()
    {
        $rows = $this->ds->createQueryBuilder()
            ->select('
                      t.*,
                      a.firstname as author_firstname,
                      a.lastname as author_lastname,
                      a.image_path as author_avatar
                     ')
            ->from(self::TABLE_NAME, 't')
            ->leftJoin('t', 'module_author', 'a', 't.author_id = a.id')
            ->orderBy('t.num_stars', 'ASC')
            ->setMaxResults(10)
            ->execute()
            ->fetchAll(self::FETCH_MODE);

        $ent = array();
        foreach ($rows as $r) {
            $ent[] = new ModuleEntity($r);
        }
        return $ent;
    }

    public function getUpdatedModules()
    {
        $rows = $this->ds->createQueryBuilder()
            ->select('
                      t.*,
                      a.firstname as author_firstname,
                      a.lastname as author_lastname,
                      a.image_path as author_avatar
                    ')
            ->from(self::TABLE_NAME, 't')
            ->leftJoin('t', 'module_author', 'a', 't.author_id = a.id')
            ->orderBy('t.last_updated', 'DESC')
            ->setMaxResults(10)
            ->execute()
            ->fetchAll(self::FETCH_MODE);

        $ent = array();
        foreach ($rows as $r) {
            $ent[] = new ModuleEntity($r);
        }
        return $ent;
    }

    public function searchModules($query)
    {
        $qb = $this->ds->createQueryBuilder();
        $qb->select('
                     t.*,
                     a.firstname as author_firstname,
                     a.lastname as author_lastname,
                     a.image_path as author_avatar
                   ');
        $qb->from(self::TABLE_NAME, 't');
        $qb->leftJoin('t', 'module_author', 'a', 't.author_id = a.id');

        if ($query != '' && $query !== '%') {
            $qb->andWhere($qb->expr()->orX(
                $qb->expr()->like('t.title', ':title'),
                $qb->expr()->like('t.short_description', ':description')
            ))
            ->setParameter(':title', '%' . $query . '%')
            ->setParameter(':description', '%' . $query . '%');
        }


        $qb->orderBy('t.last_updated', 'DESC');
        $rows = $qb->execute()->fetchAll(self::FETCH_MODE);

        $ent = array();
        foreach ($rows as $r) {
            $ent[] = new ModuleEntity($r);
        }
        return $ent;
    }
}
