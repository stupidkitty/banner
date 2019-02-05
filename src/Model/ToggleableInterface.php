<?php
namespace SK\BannerModule\Model;

interface ToggleableInterface
{
    /**
     * @return bool
     */
    public function isEnabled();
    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled);
    public function enable();
    public function disable();
}