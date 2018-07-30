jQuery( window ).on( 'elementor:init', function() {
	var ControlEmojiOneAreaItemView = elementor.modules.controls.BaseData.extend( {
		onReady: function() {
			var self = this,
				options = _.extend( {
					emojiPlaceholder: ':smile_cat:',
					pickerPosition: 'bottom',
					filtersPosition: 'top',
					searchPosition: 'bottom',
					saveEmojisAs: 'image',
					inline: true,
				}, this.model.get( 'emojionearea_options' ) );

			this.ui.textarea.emojioneArea( options );

		},

		saveValue: function() {
			this.setValue( this.ui.textarea.getText() );
		},

		onBeforeDestroy: function() {
			this.saveValue();
			this.ui.textarea.emojioneArea().destroy();
		}
	} );
	elementor.addControlView( 'emojionearea', ControlEmojiOneAreaItemView );
	$("#emojionearea").emojioneArea();
} );