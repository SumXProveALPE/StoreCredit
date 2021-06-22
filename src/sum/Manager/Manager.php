<?php

namespace sum\Manager;

use sum\Command\CreditCommand;
use sum\Data\LoadData;
use sum\StoreCredit;

class Manager{
    public static function Register(){
        new LoadData();
        StoreCredit::getInstance()->getServer()->getCommandMap()->register("StoreCredit", new CreditCommand());
    }
}