<?php
namespace todoe56\LifeboatSurvivalMode;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
class LifeboatSurvivalMode extends PluginBase {
    public $config;
    public $items;
    public $chests = [];
    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents(new LSMListener($this), $this);
        @mkdir($this->getDataFolder());
        $this->saveResource("/config.yml");
        $this->saveResource("/items.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->items = new Config($this->getDataFolder() . "items.yml", Config::YAML);
        $this->getScheduler()->scheduleDelayedRepeatingTask(new SpawnTask($this), $this->config->get("spawn_interval") * 20, $this->config->get("spawn_interval") * 20); //delay, period/interval
    }
    public function onDisable()
    {
        $keys = array_keys($this->chests);
        foreach ($keys as $chest){
            $array = explode(":", $chest);
            $vector = new Vector3($array[0], $array[1], $array[2]);
            $level = $this->getServer()->getLevelByName($array[3]);
            $tile = $level->getTile($vector);
            if($tile){
                $tile->close();
                $level->setBlock($vector, new Block(0));
            }
        }
    }
}
