<?php

namespace MythicRelics\relics;

use MythicRelics\EventLoader;

use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Block;
use pocketmine\Player;
use pocketmine\utils\Random;

class Rare implements Listener
{
    private $plugin;

    public function __construct(EventLoader $plugin)
    {
        $this->setPlugin($plugin);
        $plugin->getServer()->getPluginManager()->registerEvents($this, $plugin);
    }

    public function setPlugin($plugin)
    {
        return $this->plugin;
    }

    public function onBlockBreak(BlockBreakEvent $event){
        $player = $event->getPlayer();
        $item = $event->getItem();
        $name = $player->getName();
        $block = $event->getBlock();
        $chance = mt_rand(0,1780);

        if($block->getId() === 1){
            if($chance === 1){

                $relic = Item::get(54, 102, 1);
                $relic->setCustomName(TF::RESET . TF::RED . "§6[§bAncient Artifact§6]" . PHP_EOL .
                                      TF::GRAY . "§4--------------------§r" . PHP_EOL .
                                      TF::GRAY . "§7This Ancient Pouch" . PHP_EOL .
                                      TF::GRAY . "§7contains §l§bMythical" . PHP_EOL .
                                      TF::GRAY . "§l§bRewards§r" . PHP_EOL .
                                      TF::GRAY . "§4--------------------§r" . PHP_EOL .
                                      TF::GRAY . "§dTier Level: §6IV" . PHP_EOL .
                                      TF::GRAY . "§dActivation: §6Right-Click§r" . PHP_EOL .
                                      TF::GRAY . "§4--------------------§r");
                $player->getInventory()->addItem($relic);
                $player->getServer()->broadcastMessage(TF::BOLD . TF::DARK_GRAY . "§7(" . TF::DARK_PURPLE . "§l§c!§r" . TF::DARK_GRAY . "§7)" . TF::RESET . TF::GRAY . TF::RESET . TF::GRAY . "§a $name §7found a §bAncient Artifact §l§6IV§r");
            }
        }
    }

    public function onTap(BlockPlaceEvent $event){
        $player = $event->getPlayer();
        $item = $event->getItem();

        $damage = $event->getItem()->getDamage();

        $prot = Enchantment::getEnchantment(0);
        $unb = Enchantment::getEnchantment(17);
        $sharp = Enchantment::getEnchantment(9);
        $eff = Enchantment::getEnchantment(15);
        $kb = Enchantment::getEnchantment(12);
        $loot = Enchantment::getEnchantment(14);
        $fire = Enchantment::getEnchantment(13);
        $resp = Enchantment::getEnchantment(6);

        switch($damage) {
            case "102":
            $relic = Item::get(54, 102, 1);
            $item1 = Item::get(310, 0, 1);
            $item1->setCustomName(TF::RED . "§cSoul" . TF::GRAY . "Helmet");
            $item1->addEnchantment(new EnchantmentInstance($prot, 50));
            $item1->addEnchantment(new EnchantmentInstance($unb, 2));

            $item2 = Item::get(311, 0, 1);
            $item2->setCustomName(TF::RED . "§cSoul" . TF::GRAY . "Chestplate");
            $item2->addEnchantment(new EnchantmentInstance($prot, 50));
            $item2->addEnchantment(new EnchantmentInstance($unb, 2));
            
            $item3 = Item::get(312, 0, 1);
            $item3->setCustomName(TF::RED . "§cSoul" . TF::GRAY . "Leggings");
            $item3->addEnchantment(new EnchantmentInstance($prot, 50));
            $item3->addEnchantment(new EnchantmentInstance($unb, 2));

            $item4 = Item::get(313, 0, 1);
            $item4->setCustomName(TF::RED . "§cSoul" . TF::GRAY . "Boots");
            $item4->addEnchantment(new EnchantmentInstance($prot, 50));
            $item4->addEnchantment(new EnchantmentInstance($unb, 2));

            $sword = Item::get(276, 0, 1);
            $sword->setCustomName(TF::RED . "§2Zeldas" . TF::GRAY . "§aBlade§r");
            $sword->addEnchantment(new EnchantmentInstance($sharp, 30));
            $sword->addEnchantment(new EnchantmentInstance($unb, 2));

            $pickaxe = Item::get(278, 0, 1);
            $pickaxe->setCustomName(TF::RED . "§bInfinite" . TF::GRAY . "§3Mining §bSource");
            $pickaxe->addEnchantment(new EnchantmentInstance($eff, 20));
            $pickaxe->addEnchantment(new EnchantmentInstance($unb, 2));

            $axe = Item::get(279, 0, 1);
            $axe->setCustomName(TF::RED . "§l§dLUCKY§r" . TF::GRAY . "§3Axe");
            $axe->addEnchantment(new EnchantmentInstance($eff, 20));
            $axe->addEnchantment(new EnchantmentInstance($unb, 2));

            $diamond = Item::get(264, 0, 8);
            $iron = Item::get(265, 0, 32);
            $gold = Item::get(266, 0, 16);

            $tobegiven1 = [$item1, $item2, $item3, $item4, $sword, $pickaxe, $axe]; //array1
            $rand1 = mt_rand(0, 1);

            $player->getInventory()->addItem($tobegiven1[$rand1]);
            $player->sendMessage(TF::LIGHT_PURPLE . "§7Opening §bAncient Artifact §l§6IV§r");
            $player->getInventory()->removeItem($relic);
            break;
        }
    }
}
