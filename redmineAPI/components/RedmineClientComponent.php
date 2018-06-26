<?php

namespace redmineModule\components;

use Redmine\Client;
use yii\base\Component;

/**
 * Class RedmineClientComponent
 * @package redmineModule\components
 */
class RedmineClientComponent extends Component
{
    public $api_key;

    public $password;

    public $endpoint;

    /**
     * @var Client
     */
    private $client;

    public function init()
    {
        parent::init();

        $this->client = new \Redmine\Client($this->endpoint, $this->api_key, $this->password);
    }

    public function getProjects()
    {
        return $this->client->project->all();
    }

    public function getProject($project_name)
    {

    }

    public function getIssuesByProjectId($project_id, $options = ["offset" => 0, "limit" => 25])
    {
        return $this->client->issue->all(
            [
                'project_id' => $project_id,
                'status_id' => "*",
                'offset' => $options["offset"],
                'limit' => $options["limit"]
            ]
        );
    }


    public function getProjectById($project_id)
    {
        return $this->client->project->show($project_id);
    }


    public function getIssueById($id)
    {
        return $this->client->issue->show($id);
    }

    public function getTimeEntries($options = ["project_id" => null, "spent_on" => null, "offset" => 0, "limit" => 25])
    {
        return $this->client->time_entry->all([
            'project_id' => $options["project_id"],
            'spent_on' => $options["spent_on"],
            'offset' => $options["offset"],
            'limit' => $options["limit"]
        ]);
    }
}