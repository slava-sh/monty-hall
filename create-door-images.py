from svgwrite import *

drawing_style     = 'stroke-width: 3; stroke: black; stroke-linecap: round; stroke-linejoin: round'
inner_w           = 130
inner_h           = 280
padding_h         = 16
padding_v         = 16
vertical_space    = 40
handle_relative_x = 14
handle_relative_y = inner_h / 2
handle_size       = 30
handle_style      = 'stroke-width: 4'
open_inner_w      = 36
open_inner_crack  = 10
open_handle_x     = 7

half_stroke = 2
center_x    = inner_w / 2 + padding_v + vertical_space
ground_w    = center_x * 2
inner_x     = center_x - inner_w / 2
inner_y     = padding_v + half_stroke
ground_y    = inner_y + inner_h

for door_is_open in [False, True]:
    dwg = Drawing(size=(ground_w, ground_y + half_stroke), style=drawing_style)

    # outer
    dwg.add(dwg.path(d=[['M', (inner_x - padding_v, inner_y - padding_h)],
                        ['h', inner_w + 2 * padding_v],
                        ['v', inner_h + padding_h],
                        ['h', -padding_h],
                        ['v', -inner_h],
                        ['h', -inner_w],
                        ['v',  inner_h],
                        ['h', -padding_h],
                        ['z']],
                     fill='#898989'))

    door = dwg.g()
    door.translate((inner_x, inner_y))

    # handle
    if door_is_open:
        open_door = dwg.g()
        open_door.translate((inner_w - open_inner_w, 0))
        # inner
        open_door.add(dwg.path(d=[['M', (0, open_inner_crack)],
                                  ['L', (open_inner_w, 0)],
                                  ['v', inner_h],
                                  ['h', -open_inner_w],
                                  ['z']],
                               fill='#d6d6d6'))
        # handle
        open_door.add(dwg.line((open_handle_x, handle_relative_y - handle_size / 2),
                               (open_handle_x, handle_relative_y + handle_size / 2), style=handle_style))
        door.add(open_door)
    else:
        # inner
        door.add(dwg.rect((0, 0), (inner_w, inner_h), fill='#d6d6d6'))
        # handle
        door.add(dwg.line((handle_relative_x, handle_relative_y - handle_size / 2),
                          (handle_relative_x, handle_relative_y + handle_size / 2), style=handle_style))

    dwg.add(door)

    # ground
    dwg.add(dwg.line((0, ground_y), (vertical_space, ground_y)))
    dwg.add(dwg.line((ground_w - vertical_space, ground_y), (ground_w, ground_y)))

    dwg.saveas('public/img/door-{}.svg'.format('open' if door_is_open else 'closed'))
