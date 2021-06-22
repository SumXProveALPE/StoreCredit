<?php

namespace sum\Data;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;
use sum\StoreCredit;

class LoadData implements Listener{
    /**
     * LoadData constructor.
     */
    public function __construct(){
        StoreCredit::getInstance()->getServer()->getPluginManager()->registerEvents($this, StoreCredit::getInstance());
    }

    /**
     * @param PlayerJoinEvent $event
     */
    public function loadData(PlayerJoinEvent $event){
        $name = $event->getPlayer()->getName();
        $data = new Config(StoreCredit::getInstance()->getDataFolder() . "credit/$name.yml", Config::YAML);
        if($data->get("StoreCredit") == null){
			$data->set("StoreCredit", 0);
			$data->save();
		}
    }
}