<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-content">
				<div id="tabs">
					<ul>
						<?php foreach($languages as $language) : ?>
							<? if (isset($categories[$language->language_id])) :?>
								<li><a href="#<?php echo $language->language_code; ?>"><?php echo ucfirst(strtolower($language->language_name)); ?></a></li>
							<? endif; ?>
						<? endforeach; ?>
					</ul>
					<div id="tabs-1">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Homepage</th>
									<th>Description</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Nginx</td>
									<td>http://nginx.org</td>
									<td>webserver</td>
								</tr>
								<tr>
									<td>2</td>
									<td>Apache</td>
									<td>http://apache.org</td>
									<td>webserver</td>
								</tr>
								<tr>
									<td>3</td>
									<td>Skype</td>
									<td>http://www.skype.com</td>
									<td>Messenger</td>
								</tr>
								<tr>
									<td>4</td>
									<td>Blender</td>
									<td>http://www.blender.org</td>
									<td>3D-modeller</td>
								</tr>
							</tbody>
						</table>
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
