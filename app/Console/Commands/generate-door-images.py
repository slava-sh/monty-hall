import sys
from svgwrite import *

directory = sys.argv[1]

drawing_style     = 'stroke-width: 4; stroke: black; stroke-linecap: round; stroke-linejoin: round'
inner_w           = 130
inner_h           = 280
padding_h         = 16
padding_v         = 16
vertical_space    = 40
handle_relative_x = 14
handle_relative_y = inner_h / 2
handle_size       = 30
open_inner_w      = 36
open_inner_crack  = 10
open_handle_x     = 7

half_stroke = 2
center_x    = inner_w / 2 + padding_v + vertical_space
ground_w    = center_x * 2
inner_x     = center_x - inner_w / 2
inner_y     = padding_v + half_stroke
ground_y    = inner_y + inner_h

for state in ['closed', 'win', 'lose']:
    door_is_open = state != 'closed'

    dwg = Drawing(size=(ground_w, ground_y + half_stroke), style=drawing_style)

    if state == 'win':
        # rainbow
        rainbow = dwg.g(fill='none')
        rainbow.translate(center_x, ground_y + 20)
        rainbow.scale(8)
        rainbow.add(dwg.circle(r=19, style='stroke: #dd0000; stroke-width: 1.1'));
        rainbow.add(dwg.circle(r=18, style='stroke: #fe6230; stroke-width: 1.1'));
        rainbow.add(dwg.circle(r=17, style='stroke: #fef600; stroke-width: 1.1'));
        rainbow.add(dwg.circle(r=16, style='stroke: #00bc00; stroke-width: 1.1'));
        rainbow.add(dwg.circle(r=15, style='stroke: #009bfe; stroke-width: 1.1'));
        rainbow.add(dwg.circle(r=14, style='stroke: #000083; stroke-width: 1.1'));
        rainbow.add(dwg.circle(r=13, style='stroke: #30009b; stroke-width: 1.1'));

        door_clip = dwg.defs.add(dwg.clipPath(id='door_clip'))
        door_clip.add(dwg.rect((inner_x, inner_y), (inner_w, inner_h)))
        rainbow_clipper = dwg.g(clip_path='url(#door_clip)')
        rainbow_clipper.add(rainbow)
        dwg.add(rainbow_clipper)

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
                               (open_handle_x, handle_relative_y + handle_size / 2)))

        door.add(open_door)
    else:
        # inner
        door.add(dwg.rect((0, 0), (inner_w, inner_h), fill='#d6d6d6'))
        # handle
        door.add(dwg.line((handle_relative_x, handle_relative_y - handle_size / 2),
                          (handle_relative_x, handle_relative_y + handle_size / 2)))

    dwg.add(door)

    # ground
    dwg.add(dwg.line((0, ground_y), (vertical_space, ground_y)))
    dwg.add(dwg.line((ground_w - vertical_space, ground_y), (ground_w, ground_y)))

    dwg.saveas('{}/door-{}.svg'.format(directory, state))
