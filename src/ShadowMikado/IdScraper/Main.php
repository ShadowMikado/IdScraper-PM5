<?php

namespace ShadowMikado\IdScraper;

use pocketmine\block\VanillaBlocks;
use pocketmine\event\Listener;
use pocketmine\item\VanillaItems;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener
{


    public function onEnable(): void
    {
        $blockid = new Config($this->getDataFolder() . "BlockId.json", Config::JSON);
        $itemid = new Config($this->getDataFolder() . "ItemId.json", Config::JSON);

        foreach (VanillaItems::getAll() as $item) {
            $itemid->set($item->getName(), $item->getTypeId());
            $itemid->save();
        }

        foreach (VanillaBlocks::getAll() as $block) {
            $blockid->set($block->getName(), $block->getTypeId());
            $blockid->save();
        }
    }
}
