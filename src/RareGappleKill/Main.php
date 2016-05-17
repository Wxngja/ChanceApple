<?php
namespace RareGappleKill;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;
use pocketmine\item\Item;
use pocketmine\event\player\PlayerDeathEvent;
class Main extends PluginBase Implements Listener{
public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this,$this);
$this->getLogger()->info("RareGappleKill v1.0.0 Enabled!");
 }
public function onDeath(PlayerDeathEvent $event){
$player= $event->getPlayer();
$killer = $player->getLastDamageCause();
$rand = mt_rand(1, 100);

If($rand => 25){
$killer->getInventory()->addItem(Item::get(ITEM::GOLDEN_APPLE,0,1));
$killer->sendMessage(TF::GREEN . "[RGK] You have got a rare golden apple for killing " . $entity . " ! ");
       }
    }
}

