// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('NextGEN');
	
	tinymce.create('tinymce.plugins.NextGEN', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');

			ed.addCommand('mceNextGEN', function() {
				ed.windowManager.open({
				    // call content via admin-ajax, no need to know the full plugin path
					file : ajaxurl + '?action=ngg_tinymce',
					width : 360 + ed.getLang('NextGEN.delta_width', 0),
					height : 210 + ed.getLang('NextGEN.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('NextGEN', {
				title : 'NextGEN.desc',
				cmd : 'mceNextGEN',
				image : url + '/nextgen.gif'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('NextGEN', n.nodeName == 'IMG');
			});
		},

		/**
		 * Creates control instances based in the incomming name. This method is normally not
		 * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
		 * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
		 * method can be used to create those.
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			return null;
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
					longname  : 'NextGEN',
					author 	  : 'Alex Rabe',
					authorurl : 'http://alexrabe.de',
					infourl   : 'http://alexrabe.de',
					version   : "2.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('NextGEN', tinymce.plugins.NextGEN);
})();