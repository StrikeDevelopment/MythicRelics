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

class Ancient implements Listener
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
        $chance = mt_rand(0,780);

        if($block->getId() === 1){
            if($chance === 1){

                $relic = Item::get(54, 1, 1);
                $relic->setCustomName(TF::RESET . TF::AQUA . "§6[§bAncient Artifact§6]§r" . PHP_EOL .
                                      TF::GRAY . "§4--------------------§r" . PHP_EOL .
                                      TF::GRAY . "§7This Ancient Pouch" . PHP_EOL .
                                      TF::GRAY . "§7contains §l§bMythical" . PHP_EOL .
                                      TF::GRAY . "§l§bRewards§r" . PHP_EOL .
                                      TF::GRAY . "§4--------------------§r" . PHP_EOL .
                                      TF::GRAY . "§dTier Level: §6I" . PHP_EOL .
                                      TF::GRAY . "§dActivation: §6Right-Click§r" . PHP_EOL .
                                      TF::GRAY . "§4--------------------§r");
                $player->getInventory()->addItem($relic);
                $player->getServer()->broadcastMessage(TF::BOLD . TF::DARK_GRAY . "§7(" . TF::DARK_PURPLE . "§c§l!§r" . TF::DARK_GRAY . "§7)§r" . TF::RESET . TF::GRAY . TF::RESET . TF::GRAY . "§a $name §7found a §bAncient Artifact §6§lI§r");
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
            case "1":
            $relic = Item::get(54, 1, 1);
            $item1 = Item::get(310, 0, 1);
            $item1->setCustomName(TF::AQUA . "§4Butchers" . TF::GRAY . "§6Helmet");
            $item1->addEnchantment(new EnchantmentInstance($prot, 1));
            $item1->addEnchantment(new EnchantmentInstance($unb, 1));

            $item2 = Item::get(311, 0, 1);
            $item2->setCustomName(TF::AQUA . "§4Butchers" . TF::GRAY . "§6Chestplate");
            $item2->addEnchantment(new EnchantmentInstance($prot, 1));
            $item2->addEnchantment(new EnchantmentInstance($unb, 1));
            
            $item3 = Item::get(312, 0, 1);
            $item3->setCustomName(TF::AQUA . "§4Butchers" . TF::GRAY . "§6Leggings");
            $item3->addEnchantment(new EnchantmentInstance($prot, 1));
            $item3->addEnchantment(new EnchantmentInstance($unb, 1));

            $item4 = Item::get(313, 0, 1);
            $item4->setCustomName(TF::AQUA . "§4Butchers" . TF::GRAY . "§6Boots");
            $item4->addEnchantment(new EnchantmentInstance($prot, 1));
            $item4->addEnchantment(new EnchantmentInstance($unb, 1));

            $sword = Item::get(276, 0, 1);
            $sword->setCustomName(TF::AQUA . "§4Butchers" . TF::GRAY . "§6Machette");
            $sword->addEnchantment(new EnchantmentInstance($sharp, 1));
            $sword->addEnchantment(new EnchantmentInstance($unb, 1));

            $pickaxe = Item::get(278, 0, 1);
            $pickaxe->setCustomName(TF::AQUA . "§4Butchers" . TF::GRAY . "§6Meat Hook");
            $pickaxe->addEnchantment(new EnchantmentInstance($eff, 1));
            $pickaxe->addEnchantment(new EnchantmentInstance($unb, 1));

            $axe = Item::get(279, 0, 1);
            $axe->setCustomName(TF::AQUA . "§4Butchers" . TF::GRAY . "§6Hatchet");
            $axe->addEnchantment(new EnchantmentInstance($eff, 1));
            $axe->addEnchantment(new EnchantmentInstance($unb, 1));

            $diamond = Item::get(264, 0, 4);
            $diamond->setCustomName(TF::AQUA . "§4Butchers" . TF::GRAY . "§6Soul Gem");
            
            $iron = Item::get(265, 0, 16);
            $gold = Item::get(266, 0, 8);

            $tobegiven1 = [$item1, $item2, $item3, $item4, $sword, $pickaxe, $axe]; //array1
            $rand1 = mt_rand(0, 1);

            $player->getInventory()->addItem($tobegiven1[$rand1]);
            $player->sendMessage(TF::LIGHT_PURPLE . "§7Opening §bAncient Artifact §l§6I§r");
            $player->getInventory()->removeItem($relic);
            break;
        }
    }
}
