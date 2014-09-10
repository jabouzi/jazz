<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>UI Tabs</span>
				</div>
				<div class="box-icons pull-right">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content">
				<div id="tabs">
					<ul>
						<li><a href="#tabs-1">Android</a></li>
						<li><a href="#tabs-2">Firefox OS</a></li>
						<li><a href="#tabs-3">Linux</a></li>
					</ul>
					<div id="tabs-1">
						<p>
							Android is an operating system based on the Linux kernel, and designed primarily for touchscreen
							mobile devices such as smartphones and tablet computers. Initially developed by Android, Inc.,
							which Google backed financially and later bought in 2005, Android was unveiled in 2007 along with
							the founding of the Open Handset Alliance: a consortium of hardware, software, and telecommunication
							companies devoted to advancing open standards for mobile devices. The first publicly available
							smartphone running Android, the HTC Dream, was released on October 22, 2008.
						</p>
					</div>
					<div id="tabs-2">
						<p>
							Firefox OS (project name: Boot to Gecko, also known as B2G) is a Linux-based open-source operating
							system for smartphones and tablet computers and is set to be used on smart TVs. It is being developed
							by Mozilla, the non-profit organization best known for the Firefox web browser. Firefox OS is
							designed to provide a "complete" community-based alternative system for mobile devices, using open
							standards and approaches such as HTML5 applications, JavaScript, a robust privilege model, open web
							APIs to communicate directly with cellphone hardware, and application marketplace. As such,
							it competes with proprietary systems such as Apple's iOS, Google's Chrome OS and Microsoft's Windows
							Phone, as well as other open source systems such as Android, Jolla's Sailfish OS and Ubuntu Touch.
						</p>
					</div>
					<div id="tabs-3">
						<p>
							Linux is a Unix-like and POSIX-compliant computer operating system assembled under the model of free
							and open source software development and distribution. The defining component of Linux is the Linux
							kernel, an operating system kernel first released on 5 October 1991 by Linus Torvalds.
						</p>
						<p>
							Linux was originally developed as a free operating system for Intel x86-based personal computers.
							It has since been ported to more computer hardware platforms than any other operating system.
							It is a leading operating system on servers and other big iron systems such as mainframe computers
							and supercomputers: as of June 2013, more than 95% of the world's 500 fastest supercomputers run
							some variant of Linux, including all the 44 fastest. Linux also runs on embedded systems (devices
							where the operating system is typically built into the firmware and highly tailored to the system)
							such as mobile phones, tablet computers, network routers, building automation controls,
							televisions and video game consoles; the Android system in wide use on mobile devices is built on
							the Linux kernel.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	// Create jQuery-UI tabs
	$("#tabs").tabs();
	// Sortable for elements
	$(".sort").sortable({
		items: "div.col-sm-2",
		appendTo: 'div.box-content'
	});
	var icons = {
		header: "ui-icon-circle-arrow-e",
		activeHeader: "ui-icon-circle-arrow-s"
	};
});
</script>
