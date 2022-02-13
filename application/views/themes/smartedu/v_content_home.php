<section class="slideshow">
    <div id="au_rev_slider2" class="rev_slider fullscreenbanner slide-content" style="display:none;" data-version="5.4.1">
        <ul>
            <?php
                $slide = select("slide","*","WHERE flag_aktif='1' ORDER BY created DESC");
                foreach($slide as $i => $r){
            ?>
                    <li data-index="rs-<?php echo $i; ?>" data-transition="papercut" data-thumb="<?php echo base_url().'upload/slide/img_slide/'.$r['img_slide']; ?>">
                        <img src="<?php echo base_url().'upload/slide/img_slide/'.$r['img_slide']; ?>" alt="Image">

                        <div class="tp-caption tp-resizeme slide-title slide-title-uppercase" data-frames='[{"delay":0,"split":"chars","splitdelay":0.05,"speed":1000,"frame":"0","from":"x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-responsive="on" data-x="['left','left','center','center']" data-hoffset="['5',100,'0','0']" data-y="['center','center','center','center']" data-voffset="['-100','-100','-120','-120']" data-width="['570', '570', '570', '480']"
                            data-fontsize="['45','45','35','30']" data-color="['#f2f2f2']" data-fontweight="['bold']" data-textalign="['left','left','center','center']" data-lineheight="['58','58','40','40']" data-whitespace="normal">
                            <?php echo $r['name']; ?>
                        </div>
                        <div class="tp-caption tp-resizeme slide-desc" data-frames='[{"delay":0,"speed":2000,"frame":"0","from":"x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-responsive="on" data-x="['left','left','center','center']" data-hoffset="['5',100,'0','0']" data-y="['center','center','center','center']" data-voffset="['-4', '-4', '-20', '-20']" data-width="['550', '600', '700', '480']"
                            data-height="['auto']" data-whitespace="normal" data-type="text" data-textalign="['left','left','center','center']" data-fontsize="['16','16','20','20']" data-color="['#f2f2f2']" data-lineheight="['27','27','35','35']">
                            <?php echo $r['detail']; ?>
                        </div>
                        <a href="<?php echo base_url().'pages/content/about/data'; ?>" class="tp-caption tp-resizeme slide-btn" data-frames='[{"delay":0,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-responsive="on" data-x="['left','left','center','center']" data-hoffset="['5',100,'0','0']" data-y="['center','center','center','center']" data-voffset="['85', '85', '85', '85']" data-width="['auto']" data-height="['auto']"
                            data-type="text" data-textalign="['left','left','center','center']" data-paddingtop="[13, 13, 13, 13]" data-paddingright="[53, 53, 53, 53]" data-paddingbottom="[13, 13, 13, 13]" data-paddingleft="[53, 53, 53, 53]" data-fontsize="['14','14','20','20']"
                            data-lineheight="['25']">
                            About
                        </a>
                    </li>
            <?php
                }
            ?>
        </ul>
    </div>
</section>

{CONTENT}
