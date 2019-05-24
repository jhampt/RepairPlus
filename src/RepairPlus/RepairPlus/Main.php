<?php
namespace RepairPlus\RepairPlus;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use jojoe77777\FormAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\server\ServerCommandEvent;
class Main extends PluginBase implements Listener{
    public function onEnable(): void{
        $this->getServer()->getPluginManager()->registerEvents(($this), $this);
        $this->getLogger()->info("RepairPlus Enabled By jhampt");
    }
    public function onDisable(): void{
        $this->getLogger()->info("RepairPlus Disabled By jhampt");
    }
    public function checkDepends(): void{
        $this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        if(is_null($this->formapi)){
            $this->getLogger()->error("RepairPlus Requires FormAPI To Work Correctly");
            $this->getPluginLoader()->disablePlugin($this);
        }
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
        if($cmd->getName() == "repair"){
            if(!($sender instanceof Player)){
                $sender->sendMessage("RepairPlus", false);
                return true;
            }
            $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
            $form = $api->createSimpleForm(function (Player $sender, $data){
                $result = $data;
                if ($result == null) {
                }
                switch ($result) {
                    case 0:
                        $sender->sendMessage("Item Repaired");
                        $sender->getInventory()->setItem($index, $item->setDamage(0));
                        $sender->getInventory()->getHeldItemIndex();
                        $sender->getInventory()->getItem($index);
                        break;
                }
            });
            $form->setTitle("RepairPlus");
            $form->setContent("Repair Below:\nEnter The Damage Amount You Want To Change Your Item To");
            $form->addButton("Repair");
            $form->sendToPlayer($sender);
        //    $form->addInput(""); //
        }
        return true;
    }
}
