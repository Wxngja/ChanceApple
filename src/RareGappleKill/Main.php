<?php

namespace RareGappleKill;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

class Main extends PluginBase implements Listener
{

  public function onEnable()
  {
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info(TF::GREEN . "Chance of Apple Enabled!");
  }

  public function onDeath(PlayerDeathEvent $event)
  {
    $entity = $event->getEntity();
    $cause = $entity->getLastDamageCause();
    if($cause instanceof EntityDamageByEntityEvent) {
      $killer = $cause->getDamager();
      if($killer instanceof Player) {
        $rand = mt_rand(1, 100);
        if($rand === 25) {
          $killer->getInventory()->addItem(Item::get(Item::ENCHANTED_GOLDEN_APPLE));
          $killer->sendTip(TF::RED . "[CHANCE] Apple Dropped, 25% of it. Player Killed: " . $entity->getDisplayName() . " ! ");
        }
      }
    }
  }

}
