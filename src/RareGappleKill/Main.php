<?php

namespace ChanceApple;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;
use pocketmine\level\sound\FizzSound;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\enitity\Effect;

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
          $killer->addEffect(Effect::getEffect(Effect::STRENGTH)->setAmplifier(1)->setDuration(100)->setVisible(true));
				}
				
				if(!$event->isCancelled()) {
					$level = $killer->getLevel();
					$level->addSound(new FizzSound($killer->getLocation()));
        }
      }
    }
  }

}
