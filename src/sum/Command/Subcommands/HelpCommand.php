<?php

namespace sum\Command\Subcommands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use sum\Command\CreditCommand;

class HelpCommand extends Command{
    /**
     * HelpCommand constructor.
     */
    public function __construct(){
        parent::__construct("help", "Receive help on store credit commands");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return mixed|void
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player) return;
        $message = TextFormat::GREEN . "Command Help:" . TextFormat::EOL;
        $message .= TextFormat::AQUA . "/storecredit add [amount] [player] - Add store credit to an online player" . TextFormat::EOL;
        $message .= TextFormat::AQUA . "/storecredit set [amount] [player] - Set store credit to an online player" . TextFormat::EOL;
        $message .= TextFormat::AQUA . "/storecredit take [amount] [player] - Take store credit from an online player" . TextFormat::EOL;
        $message .= TextFormat::AQUA . "/storecredit all [amount] - Give all players online Store Credit" . TextFormat::EOL;
        $message .= TextFormat::AQUA . "/storecredit info [player] - Check store credit of an online player" . TextFormat::EOL;
        $sender->sendMessage($message);
    }
}