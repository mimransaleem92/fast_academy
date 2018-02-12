function create_menu(basepath)
{
	var base = (basepath == 'null') ? '' : basepath;

	document.write(
		'<table cellpadding="0" cellspaceing="0" border="0" style="width:98%"><tr>' +
		'<td class="td" valign="top">' +

		'<ul>' +
		'<li><a href="'+base+'index.html">User Guide Home</a></li>' +	
		'<li><a href="'+base+'toc.html">Table of Contents Page</a></li>' +
		'</ul>' +	

		'<h3>Basic Info</h3>' +
		'<ul>' +
			'<li><a href="'+base+'general/requirements.html">Requirements</a></li>' +
			'<li><a href="'+base+'license.html">License Agreement</a></li>' +
			'<li><a href="'+base+'changelog.html">Change Log</a></li>' +
			'<li><a href="'+base+'general/credits.html">Credits</a></li>' +
		'</ul>' +	
		
		'<h3>Installation</h3>' +
		'<ul>' +
			'<li><a href="'+base+'installation/downloads.html">Downloading CIwY</a></li>' +
			'<li><a href="'+base+'installation/index.html">Installation Instructions</a></li>' +
			'<li><a href="'+base+'installation/upgrading.html">Upgrading from a Previous Version</a></li>' +
			'<li><a href="'+base+'installation/troubleshooting.html">Troubleshooting</a></li>' +
		'</ul>' +
		
		'</td><td class="td_sep" valign="top">' +

		'<h3>Introduction</h3>' +
		'<ul>' +
			'<li><a href="'+base+'overview/getting_started.html">Getting Started</a></li>' +
		'</ul>' +	

		'<h3>General Topics</h3>' +
		'<ul>' +
			'<li><a href="'+base+'general/ciwy.html">CIwY Class</a></li>' +
			'<li><a href="'+base+'general/page_render.html">Render pages with YUI components</a></li>' +
			'<li><a href="'+base+'general/yuiloader.html">Loading a YUI component</a></li>' +
			'<li><a href="'+base+'general/reserved_names.html">Reserved names</a></li>' +
		'</ul>' +
		
		'</td><td class="td_sep" valign="top">' +

		'<h3>CIwY Widgets Reference</h3>' +
		'<ul>' +
		'<li><a href="'+base+'components/autocomplete.html">Autocomplete</a></li>' +
		'<li><a href="'+base+'components/calendar.html">Calendar</a></li>' +
		'<li><a href="'+base+'components/datatable.html">Datatable</a></li>' +
		'</ul>' +

    '</td><td class="td_sep" valign="top">' +

		'<h3>CIwY Utility Reference</h3>' +
		'<ul>' +
		'<li><a href="'+base+'components/animation.html">Animation</a></li>' +
		'<li><a href="'+base+'components/datasource.html">Datasource</a></li>' +
		'<li><a href="'+base+'components/dragdrop.html">Dragdrop</a></li>' +
		'</ul>' +
				
		'</td></tr></table>');
}