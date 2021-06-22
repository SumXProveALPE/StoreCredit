<?php

namespace sum\Command\Subcommands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use sum\Command\CreditCommand;
use sum\StoreCredit;

class AllCommand extends Command {
    /**
     * AllCommand constructor.
     */
    public function __construct(){
        parent::__construct("all", "give all online players StoreCredit");
        $this->setPermission("storecredit.all");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return mixed|void
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player) return;
        if(!isset($args[0])){
            $sender->sendMessage(CreditCommand::PREFIX . TextFormat::RED . "You must supply an amount!");
            return;
        }
        if(!is_numeric($args[0])){
            $sender->sendMessage(CreditCommand::PREFIX . TextFormat::RED . "The amount must be type int!");
            return;
        }
        StoreCredit::getInstance()->allCredit($args[0]);
    }
}