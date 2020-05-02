<?php
namespace todoe56\LifeboatSurvivalMode;
use pocketmine\block\Block;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\inventory\InventoryCloseEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\GameRulesChangedPacket;
use pocketmine\tile\Chest;

class LSMListener implements Listener
{
    private $plugin;

    public function __construct(LifeboatSurvivalMode $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onInventoryClose(InventoryCloseEvent $event)
    {
        $block = $event->getInventory()->getHolder();
        if (!$block instanceof Chest) return;
        $string = "" . $block->getFloorX() . ":" . $block->getFloorY() . ":" . $block->getFloorZ() . ":" . $block->getLevel()->getName();
        if (isset($this->plugin->chests[$string])) {
            $level = $block->getLevel();
            $level->setBlock(new Vector3($block->getFloorX(), $block->getFloorY(), $block->getFloorZ()), new Block(0));
            unset($this->plugin->chests[$string]);
        }
    }

    public function onBreak(BlockBreakEvent $event)
    {
        $block = $event->getBlock();
        if ($block->getName() === "Chest") {
            $string = "" . $block->getFloorX() . ":" . $block->getFloorY() . ":" . $block->getFloorZ() . ":" . $block->getLevel()->getName();
            if (isset($this->plugin->chests[$string])) {
                unset($this->plugin->chests[$string]);
            }
        }
    }
}