<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChannelJoinRepository")
 * @ORM\Table()
 */
class ChannelJoin
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $join_time;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $part_time;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Channel")
     * @ORM\JoinColumn(name="chat_id", referencedColumnName="id", nullable=false)
     */
    private $chat;

    public function __construct()
    {
        $this->join_time = new \DateTime();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set joinTime.
     *
     * @param \DateTime $joinTime
     *
     * @return ChannelJoin
     */
    public function setJoinTime($joinTime)
    {
        $this->join_time = $joinTime;

        return $this;
    }

    /**
     * Get joinTime.
     *
     * @return \DateTime
     */
    public function getJoinTime()
    {
        return $this->join_time;
    }

    /**
     * Set partTime.
     *
     * @param \DateTime $partTime
     *
     * @return ChannelJoin
     */
    public function setPartTime($partTime)
    {
        $this->part_time = $partTime;

        return $this;
    }

    /**
     * Get partTime.
     *
     * @return \DateTime
     */
    public function getPartTime()
    {
        return $this->part_time;
    }

    /**
     * Set user.
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return ChannelJoin
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set chat.
     *
     * @param \AppBundle\Entity\Channel $chat
     *
     * @return ChannelJoin
     */
    public function setChat(\AppBundle\Entity\Channel $chat)
    {
        $this->chat = $chat;

        return $this;
    }

    /**
     * Get chat.
     *
     * @return \AppBundle\Entity\Channel
     */
    public function getChat()
    {
        return $this->chat;
    }
}
