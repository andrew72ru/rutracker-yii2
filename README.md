# rutracker-yii2
Yii2 application for retracer torrents database

## How to use:

1. Clone this repository to server / localhost / whatever;
1. cd project folder, `composer install`;
1. `./init`
1. `./yii migrate`
1. Download Rutracker torrents listing from [here](http://rutracker.org/forum/viewtopic.php?t=4824458);
1. Place last version of downloaded files (e. g. `20150204`) to `project_folder/frontend/runtime/csv`;
1. Run `./yii import/import`
1. Enjoy :)

## Data Format

Data in in [csv](https://ru.wikipedia.org/wiki/CSV)

File `category_info.csv`:

```
"Category ID";"Category Name";"File Name"
```

Files `category_*.csv`:

```
"Forum ID";"Forum Name";"Topic ID";"Info Hash";"Topic Name";"Size (in bytes)";"Torrent registration date"
```

## Attention!

Web interface not yet implemented. Be patient.
