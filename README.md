# Colorlight 5A-75E LED card hack

Started from https://github.com/Manawyrm/colorlight-led-cube but chopped it up to get it working with odd sized 96x48 panels.
Because these panels are not powers of 2 some of the tricks in other projects that allow counters to simply roll-over won't work.

This is just a proof of concept and not really much more than just to display a static image.


## Current Specs
- supports 6 LED displays with 96x48 Pixels each
- RGB666 based protocol (before gamma correction), hardware gamma correction, 7 bit brightness control
- Only displays a color test pattern.

## Build
```
cd fpga/syn/
make top.svf
```

Quick Flash to RAM instructions

```
openFPGALoader -b colorlight -c ft2232 -d /dev/ttyUSB0 top.bit
```

