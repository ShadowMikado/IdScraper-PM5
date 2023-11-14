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

        if (filesize($this->getDataFolder() . "BlockId.json") <= 2 && filesize($this->getDataFolder() . "ItemId.json") <= 2) {
            foreach (VanillaItems::getAll() as $item) {
                $itemid->set($item->getName(), $item->getTypeId());
                $itemid->save();
            }

            foreach (VanillaBlocks::getAll() as $block) {
                $blockid->set($block->getName(), $block->getTypeId());
                $blockid->save();
            }

            $this->getLogger()->notice("Ids scraped in " . $this->getDataFolder());
        } else {
            $this->getLogger()->notice("Ids are already scraped !");
        }
    }
}
