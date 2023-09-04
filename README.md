# Bunny Stream

> Bunny Stream is a Statamic addon that integrates the Bunny Stream API for single Stream libraries in the Statamic CP.

## Features

- Upload and rename (on upload only) videos to Bunny Stream
- Automatically detect transcoding status
- Delete videos from Bunny Stream
- Embedding videos via a custom fieldtype or a custom tag
- Customizable video.js player included

## How to Install

This addon is only available through composer:

``` bash
composer require laborb/bunny-stream
```

For the videos to be displayed properly you need to add the Statamic Tag `{{ video_styles:css }}` in the `<head>` section
and the `{{ video_styles:js }}` tag before the `</body>` element in your layout.

Alternatively you can add these tags only to pages you want to display videos.

## How to configure

You need to provide the following config options in `config/statamic/bunny.php`:
- Your Bunny Stream LibraryID
- Your Libraries API Key
- Your Libraries CDN Hostname

You can get all values in your Bunny Stream Dashboard at [https://dash.bunny.net/stream/](https://dash.bunny.net/stream/) `Delivery > Stream > API`

### Publish config file

``` bash
php artisan vendor:publish --tag=bunny-stream-config
```

## How to Use

**After you installed the addon you need to add your config options first.**

### Upload videos

A new CP navigation item appears: `Videobrowser`
There you can upload and rename (only on upload) your video files.
When they are uploaded, they need to process. The videos are processed directly at bunny. The given progress indicator displays bunnys progress.
After the processing is done the video is available in the videobrowser and in the included fieldtype.

### Work with videos

You can embed previously uploaded videos via the provided Statamic Tag `{{ video }}` or in the content area via the provided Statamic Fieldtype `Bunny`.

#### Video Tag

You should always use the provided `Video` Tag as it includes all options that are available.

``` antlers
{{ video :id="bunny_field" :responsive="responsive" :controls="controls" :ratio="ratio" :width="width" :height="height" class="" }}
```

You need to add your own Statamic Fieldset with at least the Bunny Fieldtype included.

You can also add some options:
- `id`: **Required** Expects a valid Bunny Stream GUID.
- `responsive`: Displays the video in a responsive way. It respects the given ratio(default: 16/9).
- `ratio`: Expects one of the following ratios: `1/1`, `16/9`, `4/3`, `9/16`. Only works with the `responsive: true`.
- `controls`: If `true` all controls are available in the video player. If `false` no controls are available and the video will autoplay muted in a loop.
- `width`: Width of the video player. Only available with `responsive: false`. Preserves the videos ratio.
- `height`: Height of the video player. Only available with `responsive: false`. Preserves the videos ratio.
- `class`: You can give additional classes for the video element

#### Example Fieldset

You can use this example fieldset with the provided tag as a layout to include all available options.

``` yaml
title: Video
fields:
  -
    handle: bunny_field
    field:
      type: bunny
      display: Video
      icon: video
      listable: hidden
      instructions_position: above
      visibility: visible
      hide_display: false
      validate:
        - required
  -
    handle: controls
    field:
      default: true
      type: toggle
      display: Controls
      icon: toggle
      instructions: 'Ohne Controls wird das Video automatisch gemuted und im Loop automatisch abgespielt.'
      listable: hidden
      instructions_position: above
      visibility: visible
      hide_display: false
  -
    handle: responsive
    field:
      default: true
      type: toggle
      display: 'Responsive Darstellung'
      icon: toggle
      instructions: 'Stellt das Video in der entsprechenden Ratio responsiv dar.'
      width: 33
      listable: hidden
      instructions_position: above
      visibility: visible
      hide_display: false
  -
    handle: width
    field:
      input_type: number
      append: px
      antlers: false
      type: text
      display: Breite
      icon: text
      instructions: 'Breite des Videos'
      width: 33
      listable: hidden
      instructions_position: above
      visibility: visible
      hide_display: false
      if:
        responsive: 'equals false'
  -
    handle: height
    field:
      input_type: number
      append: px
      antlers: false
      type: text
      display: Höhe
      icon: text
      instructions: 'Höhe des Videos'
      width: 33
      listable: hidden
      instructions_position: above
      visibility: visible
      hide_display: false
      if:
        responsive: 'equals false'
  -
    handle: ratio
    field:
      options:
        1/1: null
        16/9: null
        4/3: null
        9/16: null
      default: 16/9
      type: button_group
      display: Ratio
      icon: button_group
      instructions: 'Das Bildverhältnis des Videos. Nur in responsiver Darstellung möglich.'
      listable: hidden
      instructions_position: above
      visibility: visible
      hide_display: false
      if:
        responsive: 'equals true'
      width: 66

```

## How to customize

The included video player is a simple [video.js](https://videojs.com) player with zero customization.

You can style the whole player to your needs with simple CSS classes: [https://videojs.com/guides/skins/](https://videojs.com/guides/skins/)