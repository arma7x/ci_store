<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="bg-light">
	<style>
		.btn-circle {
			width:50px;
			height:50px;
			border-radius:25px;
		}
		.icon-footer {
			width:25px;
			height:25px
		}
		.mi_fab {
			font-size:1.5em;
			margin-top:0px;
		}
		.list-inline a:visited {
			text-decoration: none;
		}

		.list-inline a:hover {
			text-decoration: none;
		}
	</style>
	<div class="container pt-3 col col-12 col-lg-10 offset-lg-1">
	<div class="col col-12">
		<div class="row">
			<div class="col col-12 col-md-3 mb-3 mb-md-0">
				<h6 class="font-weight-bold text-primary text-center text-md-left">
					<img class="logo icon-footer" src="/static/img/android-chrome-192x192.png" alt="logo"/>
					<?php echo $this->container['app_name'] ?>
				</h6>
				<div class="small text-center text-md-left">
					<?php if (isset($this->container['gi_link']['address'])): ?>
					<?php if ($this->container['gi_link']['address'] !== ''): ?>
					<?php echo $this->container['gi_link']['address'].'<br>' ?>
					<?php endif ?>
					<?php endif ?>
					<?php if (isset($this->container['gi_link']['working_hours'])): ?>
					<?php if ($this->container['gi_link']['working_hours'] !== ''): ?>
					<?php echo $this->container['gi_link']['working_hours'].'<br>' ?>
					<?php endif ?>
					<?php endif ?>
				</div>
			</div>
			<div class="col col-12 col-md-3 mb-2 mb-md-0">
				<h6 class="font-weight-bold"><?php echo lang('H_ESSENTIAL_INFORMATION') ;?></h6>
				<ul class="list-inline small">
				<?php foreach($this->container['ei_link'] as $key => $value): ?>
					<?php if ((int) $value['position'] !== 0): ?>
					<li class="list-inline-item mb-2">
						<i class="material-icons"><?php echo $value['material_icon'] ?></i>
						<a class="text-primary" onclick="navigate('/<?php echo $value['slug'] ?>')"><?php echo $value['title'] ?></a>
					</li>
					<?php endif ?>
				<?php endforeach ?>
				</ul>
			</div>
			<div class="col col-12 col-md-3 mb-2 mb-md-0">
				<h6 class="font-weight-bold"><?php echo lang('H_G_CONTACT_US') ;?></h6>
				<ul class="list-inline small">
					<?php if (isset($this->container['gi_link']['email'])): ?>
					<?php if ($this->container['gi_link']['email'] !== ''): ?>
					<li class="list-inline-item mb-2">
						<i class="material-icons" style="font-size:1em;margin-top:0px;">&#xe0be;</i>
						<a class="text-primary" href="mailto:<?php echo $this->container['gi_link']['email'] ?>"><?php echo $this->container['gi_link']['email'] ?></a>
					</li>
					<?php endif ?>
					<?php endif ?>
					<?php if (isset($this->container['gi_link']['office_number'])): ?>
					<?php if ($this->container['gi_link']['office_number'] !== ''): ?>
					<li class="list-inline-item mb-2">
						<i class="material-icons" style="font-size:1em;margin-top:0px;">&#xe0b0;</i>
						<a class="text-primary" href="tel:<?php echo $this->container['gi_link']['office_number'] ?>"><?php echo $this->container['gi_link']['office_number'] ?></a>
					</li>
					<?php endif ?>
					<?php endif ?>
					<?php if (isset($this->container['gi_link']['mobile_number'])): ?>
					<?php if ($this->container['gi_link']['mobile_number'] !== ''): ?>
					<li class="list-inline-item mb-2">
						<i class="material-icons" style="font-size:1em;margin-top:0px;">&#xe32c;</i>
						<a class="text-primary" href="tel:<?php echo $this->container['gi_link']['mobile_number'] ?>"><?php echo $this->container['gi_link']['mobile_number'] ?></a>
					</li>
					<li class="list-inline-item mb-2">
						<i class="material-icons" style="font-size:1em;margin-top:0px;">&#xe0d8;</i>
						<a class="text-primary" href="sms:<?php echo $this->container['gi_link']['mobile_number'] ?>"><?php echo $this->container['gi_link']['mobile_number'] ?></a>
					</li>
					<?php endif ?>
					<?php endif ?>
				</ul>
			</div>
			<div class="col col-12 col-md-3 mb-2 mb-md-0">
				<h6 class="font-weight-bold"><?php echo lang('H_G_SOCIAL_CHANNEL') ;?></h6>
				<ul class="list-inline small">
				<?php foreach($this->container['sc_link'] as $key => $value): ?>
					<li class="list-inline-item mb-2">
						<img id="sc_<?php echo $value['id'] ?>" class="rounded-circle logo icon-footer" src="/static/img/favicon-32x32.png" alt="<?php echo $value['name'] ?>"/>
						<a class="text-primary" target="_blank" href="<?php echo $value['url'] ?>">
						<?php echo $value['name'] ?>
						</a>
					</li>
				<?php endforeach ?>
				</ul>
				<script src="/src/sc.js" type="text/javascript" async></script>
			</div>
		</div>
	</div>
	</div>
	<button type="button" class="btn btn-dark btn-circle dropup shadow-sm mr-auto ml-3 mb-3 fixed-bottom d-none d-lg-block d-xl-block" data-toggle="modal" data-target="#ic-modal" data-placement="top" title="<?php echo lang('H_G_INBOX_CHANNEL') ;?>" style="z-index:99999!important;"><i class="material-icons mi_fab">&#xe0e1;</i></button>
	<div id="ic-modal" class="modal fade border-0" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl border-0">
		<div class="modal-content border-0" style="background:transparent!important">
			<h3 class="text-white text-uppercase font-weight-bold text-center mb-3"><?php echo lang('H_G_INBOX_CHANNEL') ;?></h3>
			<ul class="list-inline text-center">
			<?php foreach($this->container['ic_link'] as $key => $value): ?>
				<li class="list-inline-item mb-2">
					<a target="_blank" href="<?php echo str_replace('%param', 'Hi', $value['url']) ?>">
						<img id="ic_<?php echo $value['id'] ?>" class="btn-circle shadow-sm" src="/static/img/favicon-32x32.png" alt="<?php echo $value['name'] ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $value['name'] ?>"/>
					</a>
				</li>
			<?php endforeach ?>
				<?php if (isset($this->container['gi_link']['email'])): ?>
				<?php if ($this->container['gi_link']['email'] !== ''): ?>
				<li class="list-inline-item mb-2">
					<a href="mailto:<?php echo $this->container['gi_link']['email'] ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->container['gi_link']['email'] ?>">
					<button class="btn btn-primary shadow-sm btn-circle">
						<i class="material-icons mi_fab">&#xe0be;</i>
					</button>
					</a>
				</li>
				<?php endif ?>
				<?php endif ?>
				<?php if (isset($this->container['gi_link']['office_number'])): ?>
				<?php if ($this->container['gi_link']['office_number'] !== ''): ?>
				<li class="list-inline-item mb-2">
					<a href="tel:<?php echo $this->container['gi_link']['office_number'] ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->container['gi_link']['office_number'] ?>">
					<button class="btn btn-primary shadow-sm btn-circle">
						<i class="material-icons mi_fab">&#xe0b0;</i>
					</button>
					</a>
				</li>
				<?php endif ?>
				<?php endif ?>
				<?php if (isset($this->container['gi_link']['mobile_number'])): ?>
				<?php if ($this->container['gi_link']['mobile_number'] !== ''): ?>
				<li class="list-inline-item mb-2">
					<a href="tel:<?php echo $this->container['gi_link']['mobile_number'] ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->container['gi_link']['mobile_number'] ?>">
						<button class="btn btn-primary shadow-sm btn-circle">
							<i class="material-icons mi_fab">&#xe32c;</i>
						</button>
					</a>
				</li>
				<li class="list-inline-item mb-2">
					<a href="sms:<?php echo $this->container['gi_link']['mobile_number'] ?>?body=Hi" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->container['gi_link']['mobile_number'] ?>">
						<button class="btn btn-primary shadow-sm btn-circle">
							<i class="material-icons mi_fab">&#xe0d8;</i>
						</button>
					</a>
				</li>
				<?php endif ?>
				<?php endif ?>
			</ul>
			<script src="/src/ic.js" type="text/javascript" async></script>
			<script type="text/javascript">
				var scrolltotop = {
					setting: {
						startline: 155,
						scrollto: 0,
						scrollduration: 1e3,
						fadeduration: [500, 100]
					},
					controlHTML: '<button class="btn btn-dark btn-circle dropup shadow-sm mr-3 mb-3"><i class="material-icons mi_fab">&#xe5d8;</i></button>',
					controlattrs: {
						offsetx: 5,
						offsety: 5
					},
					anchorkeyword: "#top",
					state: {
						isvisible: !1,
						shouldvisible: !1
					},
					scrollup: function() {
						this.cssfixedsupport || this.$control.css({
							opacity: 0
						});
						var t = isNaN(this.setting.scrollto) ? this.setting.scrollto : parseInt(this.setting.scrollto);
						t = "string" == typeof t && 1 == jQuery("#" + t).length ? jQuery("#" + t).offset().top : 0, this.$body.animate({
							scrollTop: t
						}, this.setting.scrollduration)
					},
					keepfixed: function() {
						var t = jQuery(window),
							o = t.scrollLeft() + t.width() - this.$control.width() - this.controlattrs.offsetx,
							s = t.scrollTop() + t.height() - this.$control.height() - this.controlattrs.offsety;
						this.$control.css({
							left: o + "px",
							top: s + "px"
						})
					},
					togglecontrol: function() {
						var t = jQuery(window).scrollTop();
						this.cssfixedsupport || this.keepfixed(), this.state.shouldvisible = t >= this.setting.startline ? !0 : !1, this.state.shouldvisible && !this.state.isvisible ? (this.$control.stop().animate({
							opacity: 1
						}, this.setting.fadeduration[0]), this.state.isvisible = !0) : 0 == this.state.shouldvisible && this.state.isvisible && (this.$control.stop().animate({
							opacity: 0
						}, this.setting.fadeduration[1]), this.state.isvisible = !1)
						if (this.state.isvisible == true) {
							$('#navbar').removeClass('d-lg-none d-xl-none')
							$('#navbar').addClass('fadeIn')
						} else {
							if ($('#navbar').hasClass('fadeIn')) {
								$('#navbar').removeClass('fadeIn')
							}
							$('#navbar').addClass('d-lg-none d-xl-none')
						}
					},
					init: function() {
						jQuery(document).ready(function(t) {
							var o = scrolltotop,
								s = document.all;
							o.cssfixedsupport = !s || s && "CSS1Compat" == document.compatMode && window.XMLHttpRequest, o.$body = t(window.opera ? "CSS1Compat" == document.compatMode ? "html" : "body" : "html,body"), o.$control = t('<div id="topcontrol">' + o.controlHTML + "</div>").css({
								position: o.cssfixedsupport ? "fixed" : "absolute",
								bottom: o.controlattrs.offsety,
								right: o.controlattrs.offsetx,
								opacity: 0,
								cursor: "pointer"
							}).attr({
								title: "Scroll to Top"
							}).click(function() {
								return o.scrollup(), !1
							}).appendTo("body"), document.all && !window.XMLHttpRequest && "" != o.$control.text() && o.$control.css({
								width: o.$control.width()
							}), o.togglecontrol(), t('a[href="' + o.anchorkeyword + '"]').click(function() {
								return o.scrollup(), !1
							}), t(window).bind("scroll resize", function(t) {
								o.togglecontrol()
							})
						})
					}
				};
				scrolltotop.init();
			</script>
		</div>
	  </div>
	</div>
</div>
