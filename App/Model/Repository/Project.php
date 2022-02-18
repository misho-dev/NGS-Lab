<?php

namespace App\Model\Repository;

use App\Model\Database\DAL;
use App\Model\Project as ProjectModel;

class Project
{
    const TABLE_NAME = 'project_entity';

    /**
     * @return \App\Model\Project[]
     * @throws \ClanCats\Hydrahon\Query\Sql\Exception
     * @throws \Exception
     */
    public static function getProjects()
    {
        $projects = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->get();

        return self::buildProjects($projects);
    }

    /**
     * @param $id
     * @return ProjectModel|null
     * @throws \ClanCats\Hydrahon\Query\Sql\Exception
     * @throws \Exception
     */
    public static function getProjectById($id)
    {
        $result = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->where('entity_id', (int) $id)
            ->get();

        $project = self::buildProjects($result);
        if (!count($project)) {
            return null;
        }

        return $project[$id];
    }

    /**
     * @return array
     * @throws \ClanCats\Hydrahon\Query\Sql\Exception
     * @throws \Exception
     */
    public static function getProjectsOwnedByUser($userId)
    {
        // TODO
        $projects = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->where('owner_id', (int) $userId)
            ->get();

        return self::buildProjects($projects);
    }

    /**
     * @throws \Exception
     */
    public static function addProject(ProjectModel $project)
    {
        $newProject = [
            'name' => $project->getName(),
            'short_description' => $project->getShortDescription(),
            'description' => $project->getDescription(),
            'slider_html' => $project->getSliderHtml(),
            'name_ka' => $project->getName('ka'),
            'short_description_ka' => $project->getShortDescription('ka'),
            'description_ka' => $project->getDescription('ka'),
            'slider_html_ka' => $project->getSliderHtml('ka'),
            'meta_title' => $project->getMetaTitle(),
            'meta_keyword' => $project->getMetaKeyword(),
            'meta_description' => $project->getMetaDescription(),
            'meta_title_ka' => $project->getMetaTitle('ka'),
            'meta_keyword_ka' => $project->getMetaKeyword('ka'),
            'meta_description_ka' => $project->getMetaDescription('ka'),
        ];

        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->insert($newProject)
            ->execute();
    }

    /**
     * @param $imageId
     * @param $projectId
     * @return mixed
     * @throws \Exception
     */
    public static function updateImage($imageId, $projectId)
    {
        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->update(['image' => $imageId])
            ->where('entity_id', (int) $projectId)
            ->execute();
    }

    /**
     * @param $imageId
     * @param $projectId
     * @return mixed
     * @throws \Exception
     */
    public static function updateLogo($imageId, $projectId)
    {
        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->update(['logo' => $imageId])
            ->where('entity_id', (int) $projectId)
            ->execute();
    }

    public static function updateProject(ProjectModel $project, $projectId)
    {
        $data = [
            'name' => $project->getName(),
            'short_description' => $project->getShortDescription(),
            'description' => $project->getDescription(),
            'slider_html' => $project->getSliderHtml(),
            'name_ka' => $project->getName('ka'),
            'short_description_ka' => $project->getShortDescription('ka'),
            'description_ka' => $project->getDescription('ka'),
            'slider_html_ka' => $project->getSliderHtml('ka'),
            'meta_title' => $project->getMetaTitle(),
            'meta_keyword' => $project->getMetaKeyword(),
            'meta_description' => $project->getMetaDescription(),
            'meta_title_ka' => $project->getMetaTitle('ka'),
            'meta_keyword_ka' => $project->getMetaKeyword('ka'),
            'meta_description_ka' => $project->getMetaDescription('ka'),
        ];

        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->update($data)
            ->where('entity_id', (int) $projectId)
            ->execute();
    }

    /**
     * @throws \Exception
     */
    public static function unsetOwnerForProjects($ownerId)
    {
        // TODO ?
        return DAL::builder()
            ->table('project_entity')
            ->update(['owner_id' => null])
            ->where('owner_id', (int) $ownerId)
            ->execute();
    }

    /**
     * @param $projects
     * @return array
     */
    public static function buildProjects($projects)
    {
        $result = [];
        foreach ($projects as $project) {
            $result[$project['entity_id']] = new ProjectModel($project);
        }

        return $result;
    }
}