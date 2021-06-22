<?php

namespace sum;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use sum\Command\CreditCommand;
use sum\Manager\Manager;

class StoreCredit extends PluginBase{

    /**
     * @var
     */
    public static $instance;


    function onEnable(){
        self::$instance = $this;
        @mkdir($this->getDataFolder() . "credit/");
        Manager::Register();
        $this->getLogger()->alert("StoreCredit, Enabled");
        parent::onEnable();
    }

    function onDisable(){
        $this->saveConfig();
        parent::onDisable();
    }

    /**
     * @return static
     */
    public static function getInstance(): self{
        return self::$instance;
    }

    /**
     * @param Player $player
     * @param int $amount
     */
    public function addCredit(Player $player, int $amount){
        $name = $player->getName();
        $data = new Config($this->getDataFolder() . "credit/$name.yml");
        $data->set("StoreCredit", $data->get("StoreCredit") + $amount);
        $data->save();
    }

    /**
     * @param Player $player
     * @param int $amount
     */
    public function setCredit(Player $player, int $amount){
        $name = $player->getName();
        $data = new Config($this->getDataFolder() . "credit/$name.yml");
        $data->set("StoreCredit", $amount);
        $data->save();
    }

    /**
     * @param Player $player
     * @param int $amount
     */
    public function takeCredit(Player $player, int $amount){
        $name = $player->getName();
        $data = new Config($this->getDataFolder() . "credit/$name.yml");
        $data->set("StoreCredit", $data->get("StoreCredit") - $amount);
        $data->save();
    }

    /**
     * @param int $amount
     */
    public function allCredit(int $amount){
        foreach(Server::getInstance()->getOnlinePlayers() as $player){
            $name = $player->getName();
            $data = new Config($this->getDataFolder() . "credit/$name.yml");
            $data->set("StoreCredit", $data->get("StoreCredit") + $amount);
            $data->save();
            $player->sendMessage(CreditCommand::PREFIX . TextFormat::GREEN . "Everyone online has received " . $amount . " Store Credit!");
        }
    }

    /**
     * @param Player $player
     * @return bool|mixed
     * To use this follow the example:
     * $credit = StoreCredit::getInstance()->getCredit($player);
     * $player->sendMessage("You have " . $credit . " storecredit!");
     */
    public function getCredit(Player $player){
        $name = $player->getName();
        $data = new Config($this->getDataFolder() . "credit/$name.yml");
        return $data->get("StoreCredit");
    }
}