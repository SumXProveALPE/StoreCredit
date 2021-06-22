<?php

namespace sum\Command\Subcommands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use sum\Command\CreditCommand;
use sum\StoreCredit;

class InfoCommand extends Command{
    /**
     * InfoCommand constructor.
     */
    public function __construct(){
        parent::__construct("info", "check players store credit!");
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
            $sender->sendMessage(CreditCommand::PREFIX . TextFormat::RED . "You must supply a player!");
            return;
        }
        $player = Server::getInstance()->getPlayer($args[0]);
        if(!$player instanceof Player){
            $sender->sendMessage(CreditCommand::PREFIX . TextFormat::RED . "This player is not online!");
            return;
        }
        $credit = StoreCredit::getInstance()->getCredit($player);
        $sender->sendMessage(CreditCommand::PREFIX . TextFormat::GREEN . "This player has a total of " . $credit . " Store Credit!");
    }
}