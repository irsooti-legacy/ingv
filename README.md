![](http://itaca.mi.ingv.it/ItacaNet/img/logoingv.png)
# INGV - JSON data, accessible to everyone

This project is the JSON version of the text list on http://cnt.rm.ingv.it/events

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

You can also choose XML and CSV version, passing the `request` parameter: csv, xml, json (wich is the default one)

## Use this API

You can pass all parameter as you want directly here: https://ingv-json.herokuapp.com/

![](http://i.imgur.com/VmctaxP.gif  =100px)

## What is INGV?

The Istituto Nazionale di Geofisica e Vulcanologia was born in September 1999 through a merger of former Istituto Nazionale di Geofisica, Osservatorio Vesuviano and three other institutions: Istituto Internazionale di Vulcanologia, Istituto di Geochimica dei Fluidi and Istituto di Ricerca sul Rischio Sismico.

INGV was meant to gather all scientific and technical institutions operating in Geophysics and Volcanology and to create a permanent scientific forum in the Earth Sciences. INGV cooperates with universities and other national public and private institutions, as well as with many research agencies worldwide. The new institution, currently the largest European body dealing with research in Geophysics and Volcanology, has its headquarters in Rome and important facilities in Milano, Bologna, Pisa, Napoli, Catania and Palermo.
The main mission of INGV is the monitoring of geophysical phenomena in both the solid and fluid components of the Earth. INGV is devoted to 24-hour countrywide seismic surveillance, real-time volcanic monitoring, early warning and forecast activities. State-of-the-art networks of geophysical sensors deliver a continuous flow of observations to the acquisition centers of Rome, Naples and Catania, were the data are analyzed around the clock by specialized personnel. In addition to being analysed for research and civil defence purposes, the data supplied by numerous monitoring networks are regularly distributed to the public institutions concerned, to the scientific community and to the public.
INGV operates in close coordination with the Ministry of University and Research and with Civil Protection authorities, both at national and local level. INGV also cooperates with the Ministry of Environment, the Ministry of Education, the Ministry of Defense and the Ministry of Foreign Affairs in the frame of large research programs of national and international relevance.
INGV pays special attention to Education and Outreach through publications for schools, scientific exhibitions and dedicated Internet pages.

From http://istituto.ingv.it/the-institute/the-institute/view?set_language=en
