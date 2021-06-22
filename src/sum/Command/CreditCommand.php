<?php

namespace sum\Command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use sum\Command\Subcommands\AddCommand;
use sum\Command\Subcommands\AllCommand;
use sum\Command\Subcommands\HelpCommand;
use sum\Command\Subcommands\InfoCommand;
use sum\Command\Subcommands\SetCommand;
use sum\Command\Subcommands\TakeCommand;

class CreditCommand extends Command{

    /**
     * @var array
     */
    public $commands = [];

    const PREFIX = TextFormat::BOLD . TextFormat::BLUE . "STORECREDIT: " . TextFormat::RESET;

    public function __construct(){
        parent::__construct("storecredit");
        $this->setDescription("StoreCredit Commands");
        $this->setAliases(["mc"]);
        $subCommands = [
            new AddCommand(),
            new HelpCommand(),
            new SetCommand(),
            new TakeCommand(),
            new AllCommand(),
            new InfoCommand()
        ];
        foreach($subCommands as $command) $this->registerSub($command);
    }

    public function registerSub(Command $command){
        $this->commands[$command->getName()] = $command;
    }

    /**
     * @param string $name
     * @return Command|null
     */
    public function getCommand(string $name): ?Command{
        foreach($this->commands as $cmdName => $cmd){
            if(in_array($name, $cmd->getAliases()) or $cmdName == $name){
                return $cmd;
            }
        }
        return null;
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return mixed|void
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!isset($args[0]) or (isset($args[0]) and $this->getCommand($args[0]) == null)){
            $sender->sendMessage(self::PREFIX . TextFormat::RED . "/storecredit help");
            return;
        }
        $cmd = $this->getCommand(array_shift($args));
        if($cmd->getPermission() !== null and !$sender->isOp() and !$sender->hasPermission($cmd->getPermission())){
            $sender->sendMessage(self::PREFIX . TextFormat::RED . "You do not have permission to use this command!");
            return;
        }
        $cmd->execute($sender, $commandLabel, $args);
    }
}