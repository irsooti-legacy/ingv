# INGV - JSON data, accessible to everyone

This project is a JSON version of the text list on http://cnt.rm.ingv.it/events

In order to use advanced filter, I use a a default filter - that you can modify for yours purpouse:
```
"starttime" => $startTime,
"endtime" => $endTime,
"minmag" => 2,
"maxmag" => 10,
"mindepth" => -10,
"maxdepth" => 1000,
"minlat" => -90,
"maxlat" => 90,
"minlon" => -180,
"maxlon" => 180,
"minversion" => 100,
"format" => "text",
"limit" => 100
```

## Use this API

You can pass all parameter as you want directly here: https://ingv-json.herokuapp.com/