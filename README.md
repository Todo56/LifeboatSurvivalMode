# LifeboatSurvivalMode
This is a pmmp plugin that generates random chests with the loot you choose around a world. Just like Lifeboat's sm.

## How to use it?
Using it is fairly simple, download the lastest release and then move it to your plugins folder. Then start your server and stop it again. Open the config.yml file that should've appeared in plugin_data/LifeboatSurvivalMode and then edit it according to what you want. 
Example configuration:
```yml
spawn_interval: 10 # in seconds
maximum_chests: 10
maximum_items_per_chest: 9
worlds:
  - name: world
    max_z: 500
    min_z: 0
    max_x: 500
    min_x: 0
```
    
