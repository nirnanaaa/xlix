<?php

namespace Homepage\DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Homepage\DefaultBundle\Entity\BsForumGroups
 *
 * @ORM\Table(name="bs_forum_groups")
 * @ORM\Entity
 */
class BsForumGroups
{
    /**
     * @var integer $groupId
     *
     * @ORM\Column(name="group_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $groupId;

    /**
     * @var boolean $groupType
     *
     * @ORM\Column(name="group_type", type="boolean", nullable=false)
     */
    private $groupType;

    /**
     * @var boolean $groupFounderManage
     *
     * @ORM\Column(name="group_founder_manage", type="boolean", nullable=false)
     */
    private $groupFounderManage;

    /**
     * @var boolean $groupSkipAuth
     *
     * @ORM\Column(name="group_skip_auth", type="boolean", nullable=false)
     */
    private $groupSkipAuth;

    /**
     * @var string $groupName
     *
     * @ORM\Column(name="group_name", type="string", length=255, nullable=false)
     */
    private $groupName;

    /**
     * @var string $groupDesc
     *
     * @ORM\Column(name="group_desc", type="text", nullable=false)
     */
    private $groupDesc;

    /**
     * @var string $groupDescBitfield
     *
     * @ORM\Column(name="group_desc_bitfield", type="string", length=255, nullable=false)
     */
    private $groupDescBitfield;

    /**
     * @var integer $groupDescOptions
     *
     * @ORM\Column(name="group_desc_options", type="integer", nullable=false)
     */
    private $groupDescOptions;

    /**
     * @var string $groupDescUid
     *
     * @ORM\Column(name="group_desc_uid", type="string", length=8, nullable=false)
     */
    private $groupDescUid;

    /**
     * @var boolean $groupDisplay
     *
     * @ORM\Column(name="group_display", type="boolean", nullable=false)
     */
    private $groupDisplay;

    /**
     * @var string $groupAvatar
     *
     * @ORM\Column(name="group_avatar", type="string", length=255, nullable=false)
     */
    private $groupAvatar;

    /**
     * @var boolean $groupAvatarType
     *
     * @ORM\Column(name="group_avatar_type", type="boolean", nullable=false)
     */
    private $groupAvatarType;

    /**
     * @var integer $groupAvatarWidth
     *
     * @ORM\Column(name="group_avatar_width", type="smallint", nullable=false)
     */
    private $groupAvatarWidth;

    /**
     * @var integer $groupAvatarHeight
     *
     * @ORM\Column(name="group_avatar_height", type="smallint", nullable=false)
     */
    private $groupAvatarHeight;

    /**
     * @var integer $groupRank
     *
     * @ORM\Column(name="group_rank", type="integer", nullable=false)
     */
    private $groupRank;

    /**
     * @var string $groupColour
     *
     * @ORM\Column(name="group_colour", type="string", length=6, nullable=false)
     */
    private $groupColour;

    /**
     * @var integer $groupSigChars
     *
     * @ORM\Column(name="group_sig_chars", type="integer", nullable=false)
     */
    private $groupSigChars;

    /**
     * @var boolean $groupReceivePm
     *
     * @ORM\Column(name="group_receive_pm", type="boolean", nullable=false)
     */
    private $groupReceivePm;

    /**
     * @var integer $groupMessageLimit
     *
     * @ORM\Column(name="group_message_limit", type="integer", nullable=false)
     */
    private $groupMessageLimit;

    /**
     * @var integer $groupMaxRecipients
     *
     * @ORM\Column(name="group_max_recipients", type="integer", nullable=false)
     */
    private $groupMaxRecipients;

    /**
     * @var boolean $groupLegend
     *
     * @ORM\Column(name="group_legend", type="boolean", nullable=false)
     */
    private $groupLegend;



    /**
     * Get groupId
     *
     * @return integer 
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * Set groupType
     *
     * @param boolean $groupType
     * @return BsForumGroups
     */
    public function setGroupType($groupType)
    {
        $this->groupType = $groupType;
    
        return $this;
    }

    /**
     * Get groupType
     *
     * @return boolean 
     */
    public function getGroupType()
    {
        return $this->groupType;
    }

    /**
     * Set groupFounderManage
     *
     * @param boolean $groupFounderManage
     * @return BsForumGroups
     */
    public function setGroupFounderManage($groupFounderManage)
    {
        $this->groupFounderManage = $groupFounderManage;
    
        return $this;
    }

    /**
     * Get groupFounderManage
     *
     * @return boolean 
     */
    public function getGroupFounderManage()
    {
        return $this->groupFounderManage;
    }

    /**
     * Set groupSkipAuth
     *
     * @param boolean $groupSkipAuth
     * @return BsForumGroups
     */
    public function setGroupSkipAuth($groupSkipAuth)
    {
        $this->groupSkipAuth = $groupSkipAuth;
    
        return $this;
    }

    /**
     * Get groupSkipAuth
     *
     * @return boolean 
     */
    public function getGroupSkipAuth()
    {
        return $this->groupSkipAuth;
    }

    /**
     * Set groupName
     *
     * @param string $groupName
     * @return BsForumGroups
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
    
        return $this;
    }

    /**
     * Get groupName
     *
     * @return string 
     */
    public function getGroupName()
    {
        return $this->groupName;
    }

    /**
     * Set groupDesc
     *
     * @param string $groupDesc
     * @return BsForumGroups
     */
    public function setGroupDesc($groupDesc)
    {
        $this->groupDesc = $groupDesc;
    
        return $this;
    }

    /**
     * Get groupDesc
     *
     * @return string 
     */
    public function getGroupDesc()
    {
        return $this->groupDesc;
    }

    /**
     * Set groupDescBitfield
     *
     * @param string $groupDescBitfield
     * @return BsForumGroups
     */
    public function setGroupDescBitfield($groupDescBitfield)
    {
        $this->groupDescBitfield = $groupDescBitfield;
    
        return $this;
    }

    /**
     * Get groupDescBitfield
     *
     * @return string 
     */
    public function getGroupDescBitfield()
    {
        return $this->groupDescBitfield;
    }

    /**
     * Set groupDescOptions
     *
     * @param integer $groupDescOptions
     * @return BsForumGroups
     */
    public function setGroupDescOptions($groupDescOptions)
    {
        $this->groupDescOptions = $groupDescOptions;
    
        return $this;
    }

    /**
     * Get groupDescOptions
     *
     * @return integer 
     */
    public function getGroupDescOptions()
    {
        return $this->groupDescOptions;
    }

    /**
     * Set groupDescUid
     *
     * @param string $groupDescUid
     * @return BsForumGroups
     */
    public function setGroupDescUid($groupDescUid)
    {
        $this->groupDescUid = $groupDescUid;
    
        return $this;
    }

    /**
     * Get groupDescUid
     *
     * @return string 
     */
    public function getGroupDescUid()
    {
        return $this->groupDescUid;
    }

    /**
     * Set groupDisplay
     *
     * @param boolean $groupDisplay
     * @return BsForumGroups
     */
    public function setGroupDisplay($groupDisplay)
    {
        $this->groupDisplay = $groupDisplay;
    
        return $this;
    }

    /**
     * Get groupDisplay
     *
     * @return boolean 
     */
    public function getGroupDisplay()
    {
        return $this->groupDisplay;
    }

    /**
     * Set groupAvatar
     *
     * @param string $groupAvatar
     * @return BsForumGroups
     */
    public function setGroupAvatar($groupAvatar)
    {
        $this->groupAvatar = $groupAvatar;
    
        return $this;
    }

    /**
     * Get groupAvatar
     *
     * @return string 
     */
    public function getGroupAvatar()
    {
        return $this->groupAvatar;
    }

    /**
     * Set groupAvatarType
     *
     * @param boolean $groupAvatarType
     * @return BsForumGroups
     */
    public function setGroupAvatarType($groupAvatarType)
    {
        $this->groupAvatarType = $groupAvatarType;
    
        return $this;
    }

    /**
     * Get groupAvatarType
     *
     * @return boolean 
     */
    public function getGroupAvatarType()
    {
        return $this->groupAvatarType;
    }

    /**
     * Set groupAvatarWidth
     *
     * @param integer $groupAvatarWidth
     * @return BsForumGroups
     */
    public function setGroupAvatarWidth($groupAvatarWidth)
    {
        $this->groupAvatarWidth = $groupAvatarWidth;
    
        return $this;
    }

    /**
     * Get groupAvatarWidth
     *
     * @return integer 
     */
    public function getGroupAvatarWidth()
    {
        return $this->groupAvatarWidth;
    }

    /**
     * Set groupAvatarHeight
     *
     * @param integer $groupAvatarHeight
     * @return BsForumGroups
     */
    public function setGroupAvatarHeight($groupAvatarHeight)
    {
        $this->groupAvatarHeight = $groupAvatarHeight;
    
        return $this;
    }

    /**
     * Get groupAvatarHeight
     *
     * @return integer 
     */
    public function getGroupAvatarHeight()
    {
        return $this->groupAvatarHeight;
    }

    /**
     * Set groupRank
     *
     * @param integer $groupRank
     * @return BsForumGroups
     */
    public function setGroupRank($groupRank)
    {
        $this->groupRank = $groupRank;
    
        return $this;
    }

    /**
     * Get groupRank
     *
     * @return integer 
     */
    public function getGroupRank()
    {
        return $this->groupRank;
    }

    /**
     * Set groupColour
     *
     * @param string $groupColour
     * @return BsForumGroups
     */
    public function setGroupColour($groupColour)
    {
        $this->groupColour = $groupColour;
    
        return $this;
    }

    /**
     * Get groupColour
     *
     * @return string 
     */
    public function getGroupColour()
    {
        return $this->groupColour;
    }

    /**
     * Set groupSigChars
     *
     * @param integer $groupSigChars
     * @return BsForumGroups
     */
    public function setGroupSigChars($groupSigChars)
    {
        $this->groupSigChars = $groupSigChars;
    
        return $this;
    }

    /**
     * Get groupSigChars
     *
     * @return integer 
     */
    public function getGroupSigChars()
    {
        return $this->groupSigChars;
    }

    /**
     * Set groupReceivePm
     *
     * @param boolean $groupReceivePm
     * @return BsForumGroups
     */
    public function setGroupReceivePm($groupReceivePm)
    {
        $this->groupReceivePm = $groupReceivePm;
    
        return $this;
    }

    /**
     * Get groupReceivePm
     *
     * @return boolean 
     */
    public function getGroupReceivePm()
    {
        return $this->groupReceivePm;
    }

    /**
     * Set groupMessageLimit
     *
     * @param integer $groupMessageLimit
     * @return BsForumGroups
     */
    public function setGroupMessageLimit($groupMessageLimit)
    {
        $this->groupMessageLimit = $groupMessageLimit;
    
        return $this;
    }

    /**
     * Get groupMessageLimit
     *
     * @return integer 
     */
    public function getGroupMessageLimit()
    {
        return $this->groupMessageLimit;
    }

    /**
     * Set groupMaxRecipients
     *
     * @param integer $groupMaxRecipients
     * @return BsForumGroups
     */
    public function setGroupMaxRecipients($groupMaxRecipients)
    {
        $this->groupMaxRecipients = $groupMaxRecipients;
    
        return $this;
    }

    /**
     * Get groupMaxRecipients
     *
     * @return integer 
     */
    public function getGroupMaxRecipients()
    {
        return $this->groupMaxRecipients;
    }

    /**
     * Set groupLegend
     *
     * @param boolean $groupLegend
     * @return BsForumGroups
     */
    public function setGroupLegend($groupLegend)
    {
        $this->groupLegend = $groupLegend;
    
        return $this;
    }

    /**
     * Get groupLegend
     *
     * @return boolean 
     */
    public function getGroupLegend()
    {
        return $this->groupLegend;
    }
}