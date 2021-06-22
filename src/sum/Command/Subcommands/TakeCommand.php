<?php

namespace sum\Command\Subcommands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use sum\Command\CreditCommand;
use sum\StoreCredit;

class TakeCommand extends Command{
    /**
     * TakeCommand constructor.
     */
    public function __construct(){
        parent::__construct("take", "take storecredit from players online");
        $this->setPermission("storecredit.take");
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
        if(!isset($args[1])){
            $sender->sendMessage(CreditCommand::PREFIX . TextFormat::RED . "You must supply a player!");
            return;
        }
        $player = Server::getInstance()->getPlayer($args[1]);
        if(!$player instanceof Player){
            $sender->sendMessage(CreditsCommand::PREFIX . TextFormat::RED . "This player is not online!");
            return;
        }
        StoreCredit::getInstance()->takeCredits($player, $args[0]);
        $sender->sendMessage(CreditsCommand::PREFIX . TextFormat::GREEN . $args[0] . " Store Credit has been taken from you!");
    }
}