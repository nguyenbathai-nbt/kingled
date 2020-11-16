<?php


namespace Subscriber\Common\Models\Badge;


use Phalcon\Mvc\Model;

class Badge extends Model
{
    protected $id_;
    protected $batch_id;
    protected $create_date;
    protected $modified_date;
    protected $status_;
    protected $bchain_trans_id;
    protected $bchain_data;
    protected $request_data;
    protected $badge_template_id;
    protected $bchain_block_id;
    protected $group_id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id_;
    }

    /**
     * @param mixed $id_
     */
    public function setId($id_)
    {
        $this->id_ = $id_;
    }

    /**
     * @return mixed
     */
    public function getBatchId()
    {
        return $this->batch_id;
    }

    /**
     * @param mixed $batch_id
     */
    public function setBatchId($batch_id)
    {
        $this->batch_id = $batch_id;
    }

    /**
     * @return mixed
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     * @param mixed $create_date
     */
    public function setCreateDate($create_date)
    {
        $this->create_date = $create_date;
    }

    /**
     * @return mixed
     */
    public function getModifiedDate()
    {
        return $this->modified_date;
    }

    /**
     * @param mixed $modified_date
     */
    public function setModifiedDate($modified_date)
    {
        $this->modified_date = $modified_date;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status_;
    }

    /**
     * @param mixed $status_
     */
    public function setStatus($status_)
    {
        $this->status_ = $status_;
    }

    /**
     * @return mixed
     */
    public function getBchainTransId()
    {
        return $this->bchain_trans_id;
    }

    /**
     * @param mixed $bchain_trans_id
     */
    public function setBchainTransId($bchain_trans_id)
    {
        $this->bchain_trans_id = $bchain_trans_id;
    }

    /**
     * @return mixed
     */
    public function getBchainData()
    {
        return $this->bchain_data;
    }

    /**
     * @param mixed $bchain_data
     */
    public function setBchainData($bchain_data)
    {
        $this->bchain_data = $bchain_data;
    }

    /**
     * @return mixed
     */
    public function getRequestData()
    {
        return $this->request_data;
    }

    /**
     * @param mixed $request_data
     */
    public function setRequestData($request_data)
    {
        $this->request_data = $request_data;
    }

    /**
     * @return mixed
     */
    public function getBadgeTemplateId()
    {
        return $this->badge_template_id;
    }

    /**
     * @param mixed $badge_template_id
     */
    public function setBadgeTemplateId($badge_template_id)
    {
        $this->badge_template_id = $badge_template_id;
    }

    /**
     * @return mixed
     */
    public function getBchainBlockId()
    {
        return $this->bchain_block_id;
    }

    /**
     * @param mixed $bchain_block_id
     */
    public function setBchainBlockId($bchain_block_id)
    {
        $this->bchain_block_id = $bchain_block_id;
    }

    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    /**
     * @param mixed $group_id
     */
    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;
    }



}