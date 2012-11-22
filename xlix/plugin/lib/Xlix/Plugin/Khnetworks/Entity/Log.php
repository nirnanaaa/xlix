<?php

namespace Xlix\Plugin\Khnetworks\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Xlix\Plugin\Khnetworks\Entity\Log
 *
 * @ORM\Table(name="log")
 * @ORM\Entity
 */
class Log
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $priority
     *
     * @ORM\Column(name="priority", type="string", length=255, nullable=false)
     */
    private $priority;

    /**
     * @var string $message
     *
     * @ORM\Column(name="message", type="text", nullable=false)
     */
    private $message;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set priority
     *
     * @param string $priority
     * @return Log
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    
        return $this;
    }

    /**
     * Get priority
     *
     * @return string 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Log
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }
}