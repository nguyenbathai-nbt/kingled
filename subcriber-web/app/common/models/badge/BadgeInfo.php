<?php


namespace Subscriber\Common\Models\Badge;


use Phalcon\Mvc\Model;

class BadgeInfo extends Model
{
    protected $id_;
    protected $assertion_id;
    protected $issued_date;
    protected $recipient_id;
    protected $recipient_type;
    protected $a_badge_id;
    protected $a_badge_name;
    protected $a_badge_description;
    protected $a_badge_image_uri;
    protected $a_b_criteria_narrative;
    protected $a_b_issued_id;
    protected $recipient_name;
    protected $group_name;
    protected $group_url;
    protected $group_email;

    public function getSource()
    {
        return "badge_info";
    }
    public function initialize()
    {

        $this->hasOne('a_b_issued_id',  'Subscriber\Common\Models\Users\Users', 'id_', [
            'alias' => 'issued'
        ]);

    }
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
    public function getAssertionId()
    {
        return $this->assertion_id;
    }

    /**
     * @param mixed $assertion_id
     */
    public function setAssertionId($assertion_id)
    {
        $this->assertion_id = $assertion_id;
    }

    /**
     * @return mixed
     */
    public function getIssuedDate()
    {
        return $this->issued_date;
    }

    /**
     * @param mixed $issued_date
     */
    public function setIssuedDate($issued_date)
    {
        $this->issued_date = $issued_date;
    }

    /**
     * @return mixed
     */
    public function getRecipientId()
    {
        return $this->recipient_id;
    }

    /**
     * @param mixed $recipient_id
     */
    public function setRecipientId($recipient_id)
    {
        $this->recipient_id = $recipient_id;
    }

    /**
     * @return mixed
     */
    public function getRecipientType()
    {
        return $this->recipient_type;
    }

    /**
     * @param mixed $recipient_type
     */
    public function setRecipientType($recipient_type)
    {
        $this->recipient_type = $recipient_type;
    }

    /**
     * @return mixed
     */
    public function getABadgeId()
    {
        return $this->a_badge_id;
    }

    /**
     * @param mixed $a_badge_id
     */
    public function setABadgeId($a_badge_id)
    {
        $this->a_badge_id = $a_badge_id;
    }

    /**
     * @return mixed
     */
    public function getABadgeName()
    {
        return $this->a_badge_name;
    }

    /**
     * @param mixed $a_badge_name
     */
    public function setABadgeName($a_badge_name)
    {
        $this->a_badge_name = $a_badge_name;
    }

    /**
     * @return mixed
     */
    public function getABadgeDescription()
    {
        return $this->a_badge_description;
    }

    /**
     * @param mixed $a_badge_description
     */
    public function setABadgeDescription($a_badge_description)
    {
        $this->a_badge_description = $a_badge_description;
    }

    /**
     * @return mixed
     */
    public function getABadgeImageUri()
    {
        return $this->a_badge_image_uri;
    }

    /**
     * @param mixed $a_badge_image_uri
     */
    public function setABadgeImageUri($a_badge_image_uri)
    {
        $this->a_badge_image_uri = $a_badge_image_uri;
    }

    /**
     * @return mixed
     */
    public function getABCriteriaNarrative()
    {
        return $this->a_b_criteria_narrative;
    }

    /**
     * @param mixed $a_b_criteria_narrative
     */
    public function setABCriteriaNarrative($a_b_criteria_narrative)
    {
        $this->a_b_criteria_narrative = $a_b_criteria_narrative;
    }

    /**
     * @return mixed
     */
    public function getABIssuedId()
    {
        return $this->a_b_issued_id;
    }

    /**
     * @param mixed $a_issued_id
     */
    public function setABIssuedId($a_issued_id)
    {
        $this->a_b_issued_id = $a_issued_id;
    }

    /**
     * @return mixed
     */
    public function getRecipientName()
    {
        return $this->recipient_name;
    }

    /**
     * @param mixed $recipient_name
     */
    public function setRecipientName($recipient_name)
    {
        $this->recipient_name = $recipient_name;
    }

    /**
     * @return mixed
     */
    public function getGroupName()
    {
        return $this->group_name;
    }

    /**
     * @param mixed $group_name
     */
    public function setGroupName($group_name)
    {
        $this->group_name = $group_name;
    }

    /**
     * @return mixed
     */
    public function getGroupUrl()
    {
        return $this->group_url;
    }

    /**
     * @param mixed $group_url
     */
    public function setGroupUrl($group_url)
    {
        $this->group_url = $group_url;
    }

    /**
     * @return mixed
     */
    public function getGroupEmail()
    {
        return $this->group_email;
    }

    /**
     * @param mixed $group_email
     */
    public function setGroupEmail($group_email)
    {
        $this->group_email = $group_email;
    }

}