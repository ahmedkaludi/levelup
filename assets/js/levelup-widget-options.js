( function( $ ) {
    'use strict';

	var ModalView = Backbone.View.extend({
        name: "ModalView",
        modalBlanket: null,
        modalContainer: null,
        defaultOptions:
		{
			fadeInDuration:150,
			fadeOutDuration:150,
			showCloseButton:false,
			bodyOverflowHidden:false,
            setFocusOnFirstFormControl:true,
            targetContainer: document.body,
            slideFromAbove: false,
            slideFromBelow: false,
            slideDistance: 150,
			closeImageUrl: "close-modal.png",
			closeImageHoverUrl: "close-modal-hover.png",
			showModalAtScrollPosition: true,
			permanentlyVisible: false,
            backgroundClickClosesModal: true,
            pressingEscapeClosesModal: true,
            css:
            {
                
                "border-radius": "10px"
            }
		},

        initialize: function(){ },
        events: {},
        showModalBlanket: function(){
                return this.ensureModalBlanket().fadeIn( this.options.fadeInDuration);
            }, 
        hideModalBlanket: function() {
            return this.modalBlanket.fadeOut( this.options.fadeOutDuration);
        },
		ensureModalContainer: function( target) {
            if( target != null){
                // A target is passed in, we need to re-render the modal container into the target.
                if( this.modalContainer != null){
                    this.modalContainer.remove();
                    this.modalContainer = null;
                }
            }
            if( this.modalContainer == null){
                this.modalContainer =
                    $("<div id='levelup-modalContainer'>")
                        .css({
                            "z-index":"99999",
                            "position":"relative",
                            "-webkit-border-radius": "6px",
                            "-moz-border-radius": "6px",
                            "border-radius": "6px"
                            })
                        .appendTo( target);
            }

            return this.modalContainer;
        },

        ensureModalBlanket:function(){
                this.modalBlanket = $("#modal-blanket");
                if( this.modalBlanket.length == 0){
                    this.modalBlanket =
                        $("<div id='modal-blanket'>")
                            .css({
                                    position: "absolute",
                                    top: 0,
                                    left: 0,
                                    height: $(document).height(), // Span the full document height...
                                    width: "100%", // ...and full width
                                    opacity: 0.5, // Make it slightly transparent
                                    backgroundColor: "#000",
                                    "z-index": 99900
                                })
                            .appendTo( document.body)
                            .hide();
                }
				else
                {
                    // Ensure the blanket spans the whole document, screen may have been updated.
                    this.modalBlanket.css(
                        {
                            height: $(document).height(), // Span the full document height...
                            width: "100%" // ...and full width
                        });
                }

                return this.modalBlanket;
            },

        keyup: function( event) {
                if( event.keyCode == 27 && this.options.pressingEscapeClosesModal)
                {
                    this.hideModal();
                }
            },

        click: function( event){
                if( event.target.id == "modal-blanket" && this.options.backgroundClickClosesModal)
                {
                    this.hideModal();
                }
            },

        setFocusOnFirstFormControl: function() {
                var controls = $("input, select, email, url, number, range, date, month, week, time, datetime, datetime-local, search, color", $(this.el));
                if( controls.length > 0)
                {
                    $(controls[0]).focus();
                }
            },

        hideModal: function() {
                this.trigger( "closeModalWindow");
                 $(document.body).find('.elementor-preview-drop-event').hide();

                this.hideModalBlanket();
                $(document.body).unbind( "keyup", this.keyup);
                this.modalBlanket.unbind( "click", this.click);

                if( this.options.bodyOverflowHidden === true)
                {
                    $(document.body).css( "overflow", this.originalBodyOverflowValue);
                }

                var container = this.modalContainer;
                $(this.modalContainer)
                    .fadeOut(
                        this.options.fadeOutDuration,
                        function()
                        {
                            container.remove();
                        });
            },

        getCoordinate: function( coordinate, css) {
                if( typeof( css[coordinate]) !== "undefined")
                {
                    var value = css[coordinate];
                    delete css[coordinate]; // Don't apply positioning to the $el, we apply it to the modal container. Remove it from options.css

                    return value;
                }
            },

		recenter: function() {
				return this.recentre();
			},
		// Re-centre the modal dialog after it has been displayed. Useful if the height changes after initial rendering eg; jquery ui tabs will hide tab sections
		recentre: function() {
                var $el = $(this.el);
                var coords = {
                    top: this.getCoordinate( "top", this.options.css),
                    left: this.getCoordinate( "left", this.options.css),
                    right: this.getCoordinate( "right", this.options.css),
                    bottom: this.getCoordinate( "bottom", this.options.css),
                    isEmpty: function(){return (this.top == null && this.left == null && this.right == null && this.bottom == null);}
                    };

                var offsets = this.getOffsets();
                var centreY = $(window).height() / 2;
                var centreX = $(window).width() / 2;
                var modalContainer = this.modalContainer;
                var positionY = centreY  - ($el.outerHeight() / 2);
                modalContainer.css({"top": (positionY + offsets.y) + "px"});

                var positionX = centreX - ($el.outerWidth() / 2);
                modalContainer.css({"left": (positionX + offsets.x) + "px"});

                return this;
            },

        getOffsets:
            function()
            {
                var offsetY = 0, offsetX = 0;
                if( this.options.showModalAtScrollPosition)
                {
                    offsetY = $(document).scrollTop(),
                    offsetX = $(document).scrollLeft()
                }

                return {x:offsetX, y:offsetY};
            },

        showModal:
            function( options )
            {
                this.defaultOptions.targetContainer = document.body;
                this.options = $.extend( true, {}, this.defaultOptions, options, this.options);

				if( this.options.permanentlyVisible)
                {
                    this.options.showCloseButton = false;
                    this.options.backgroundClickClosesModal = false;
                    this.options.pressingEscapeClosesModal = false;
                }

                //Set the center alignment padding + border see css style
                var $el = $(this.el);

				var centreY = $(window).height() / 2;
                var centreX = $(window).width() / 2;
                var modalContainer = this.ensureModalContainer( this.options.targetContainer).empty();
		
		        $el.addClass( "modal");

                var coords = {
                    top: this.getCoordinate( "top", this.options.css),
                    left: this.getCoordinate( "left", this.options.css),
                    right: this.getCoordinate( "right", this.options.css),
                    bottom: this.getCoordinate( "bottom", this.options.css),
                    isEmpty: function(){return (this.top == null && this.left == null && this.right == null && this.bottom == null);}
                    };

				$el.css( this.options.css);

                this.showModalBlanket();
                this.keyup = _.bind( this.keyup, this);
                this.click = _.bind( this.click, this);
                $(document.body).keyup( this.keyup); // This handler is unbound in hideModal()
                this.modalBlanket.click( this.click); // This handler is unbound in hideModal()

                if( this.options.bodyOverflowHidden === true)
                {
                    this.originalBodyOverflowValue = $(document.body).css( "overflow");
                    $(document.body).css( "overflow", "hidden");
                }

                modalContainer
                    .append( $el);

                modalContainer.css({
                        "opacity": 0,
                        "position": "absolute",
                        "z-index": 999999});

				var offsets = this.getOffsets();

                // Only apply default centre coordinates if no css positions have been supplied
                if( coords.isEmpty())
                {
                    var positionY = centreY  - ($el.outerHeight() / 2);
                    if( positionY < 10) positionY = 10;

					// Overriding the coordinates with explicit values if they are passed in
                    if( typeof( this.options.y) !== "undefined")
                    {
                        positionY = this.options.y;
                    }
                    else
                    {
                        positionY += offsets.y;
                    }

                    modalContainer.css({"top": positionY + "px"});

                    var positionX = centreX - ($el.outerWidth() / 2);
					// Overriding the coordinates with explicit values if they are passed in
                    if( typeof( this.options.x) !== "undefined")
                    {
                        positionX = this.options.x;
                    }
                    else
                    {
                        positionX += offsets.x;
                    }

                    modalContainer.css({"left": positionX + "px"});
                }
                else
                {
                    if( coords.top != null) modalContainer.css({"top": coords.top + offsets.y});
                    if( coords.left != null) modalContainer.css({"left": coords.left + offsets.x});
                    if( coords.right != null) modalContainer.css({"right": coords.right});
                    if( coords.bottom != null) modalContainer.css({"bottom": coords.bottom});
                }

                if( this.options.setFocusOnFirstFormControl)
                {
                    this.setFocusOnFirstFormControl();
                }

                if( this.options.showCloseButton)
                {
                    var view = this;
                    var image =
                        $("<a href='#' id='modalCloseButton'>&#160;</a>")
                            .css({
									"position":"absolute",
									"top":"-10px",
									"right":"-10px",
									"width":"32px",
									"height":"32px",
									"background":"transparent url(" + view.options.closeImageUrl + ") top left no-repeat",
									"text-decoration":"none"})
                            .appendTo( this.modalContainer)
                            .hover(
                                function()
                                {
                                    $(this).css( "background-image", "url(" + view.options.closeImageHoverUrl + ") !important");
                                },
                                function()
                                {
                                    $(this).css( "background-image", "url(" + view.options.closeImageUrl + ") !important");
                                })
                            .click(
                                function( event)
                                {
                                    event.preventDefault();
                                    view.hideModal();
                                });
                }
                var view = this;
                $('.close').click( function( event){
                        event.preventDefault();
                        view.hideModal();
                });
                var animateProperties = {opacity:1};
                var modalOffset = modalContainer.offset();
                    
                if( this.options.slideFromAbove)
                {
                    modalContainer.css({"top": (modalOffset.top - this.options.slideDistance) + "px"});
                    animateProperties.top = coords.top;
                }

                if( this.options.slideFromBelow)
                {
                    modalContainer.css({"top": (modalOffset.top + this.options.slideDistance) + "px"});
                    animateProperties.top = coords.top;
                }

                this.modalContainer.animate( animateProperties, this.options.fadeInDuration);

				return this;
            }
    });


    var LevelupPopupView = ModalView.extend({
                    name: "LevelupPopupView",
                    model: {},
                    //template: '#tmpl-levelup-library-templates' ,
                    initialize:function() {
                      _.bindAll( this, "render");
                      this.template = _.template($('#tmpl-levelup-library-templates').html());
                    },
                    events: {
                      "click .levelup-elementor-design": "elementGetData"
                    },
                    elementGetData: function(e) {
                         e.preventDefault();
                        var modalViewThis = e.currentTarget;
                        var templateId = $(modalViewThis).attr("data-template-id");
                        //jQuery("[data-setting=layoutDesignSelected]").val(templateId).trigger("change");
                       $.ajax({
                            url: levelup_object.ajax_url,
                            type:'post',
                            dataType: 'json',
                            data: {templateId: templateId, action: 'levelup_get_design', currentWidget: LevelupWidgets.itemData},
                            success:function(data){
                                if(data.status=='200'){
                                    elementor.getPreviewView().addChildModel(data.content, {});
                                    $('.elementor-control-layoutDesignSelected').hide();
                                }
                            },
                            error: function(){
                              $('.elementor-control-layoutDesignSelected').hide();  
                            }
                        });
                        

                        
                        
                      this.hideModal();
                   },
                   showLoadingView: function() {
                   },
                    render: function() {
                        $(this.el).html( this.template(this.model));
                        return this;
                    }
                }); 

    $( window ).on( 'elementor:init', function(require,module,exports) {
         if(levelup_object.widget_design.designs.length==0){
           
            elementor.hooks.addFilter('elements/base-section-container/behaviors', function(behaviors, model){
                 $("#elementor-panel-category-levelup-widgets").find(".elementor-panel-category-items").find('.elementor-element-wrapper:first').hide();
                var message = "<div style='padding:5px;text-align:center'>LevelUp Installation: <a href='"+levelup_object.elementor_theme_settings+"' class='elementor-button elementor-button-success' style='border-radius:3px 0 0 3px;padding: 4px;'>Finish Setup</a></div>";
                $("#elementor-panel-category-levelup-widgets").find(".elementor-panel-category-items").prepend(message);
                $("#elementor-panel-elements-search-area").after(message);
                return behaviors;
            })
            
        }else{
        
        	elementor.hooks.addAction(
                'panel/open_editor/widget',
                function( panel, model, view ) {
                    $('.elementor-control-layoutDesignSelected').hide();
                    var currentStatus = $("[data-setting=layoutDesignSelectionpoup]").val();
                    if(currentStatus!='yes'){
                        model.attributes.settings.attributes.layoutDesignSelectionpoup = 'yes';
                    }
                    //openCallToActionDesignPopup(model.attributes.widgetType);
    			}
            );

        }
        

        
     });

    var LevelupWidgetsExtands = Backbone.View.extend({
            initialize: function initialize(){
                //To hide layout options
                var self = this;
                $( window ).on( 'elementor:init', function(require,module,exports) {
                     $('.elementor-control-layoutDesignSelected').hide();
                    self.listenTo(elementor.channels.panelElements, 'element:drag:start', self.onPanelElementDragStartTrack)
                    self.listenTo(elementor.channels.panelElements, 'element:drag:end', self.onPanelElementDragEndTrack)
                })
            },
            onPanelElementDragEndTrack: function onPanelElementDragEndTrack(){
                elementor.helpers.enableElementEvents(this.$el.find('iframe'));
                if($('#levelup-drop-element').length>0){
                    $('#levelup-drop-element').remove();
                }
            },
            onPanelElementDragStartTrack: function onPanelElementDragStartTrack(){
                elementor.helpers.disableElementEvents(this.$el.find('iframe'));
                var elementView = elementor.channels.panelElements.request('element:selected');
                this.itemData = {
                    elType: elementView.model.get('elType'),
                    widgetType: elementView.model.get('widgetType')
                };
                var is_Levelup = levelup_object.widget_design.designs[this.itemData.widgetType];
                console.log(is_Levelup);
                if(
                    ( is_Levelup )  && this.itemData.elType=='widget'
                ){
                    
                    if($('#levelup-drop-element').length>0){
                        $('.levelup-preview-drop-event').remove();
                    }
                    $('#elementor-preview-loading').after("<div class='levelup-preview-drop-event' id='levelup-drop-element'>Drop here</div>");
                    $('.levelup-preview-drop-event').css('border','2px dashed #d5dadf').show();
                    var settings = {};
                    settings.items = '#levelup-drop-element';

                    $("#levelup-drop-element").bind("dragover", _.bind(this._dragOverEvent, this))
                    $("#levelup-drop-element").bind("dragenter", _.bind(this._dragEnterEvent, this))
                    $("#levelup-drop-element").bind("dragleave", _.bind(this._dragLeaveEvent, this))
                    $("#levelup-drop-element").bind("drop", _.bind(this._dropEvent, this))
                }
            },
            _dragOverEvent: function(e){
                if (e.originalEvent) e = e.originalEvent
                if (e.preventDefault) e.preventDefault()
                    $(e.target).addClass("levelup-dragging-on-child");
            },
            _dragEnterEvent: function(e){
                if (e.originalEvent) e = e.originalEvent
                if (e.preventDefault) e.preventDefault()
                $(e.target).html("You can Drop Here");
                
            },
            _dragLeaveEvent: function(e){
                if (e.originalEvent) e = e.originalEvent
                if (e.preventDefault) e.preventDefault()
                $(e.target).removeClass("levelup-dragging-on-child");  
                $(e.target).html("Drop here");
            },
            _dropEvent: function(e){
                if (e.originalEvent) e = e.originalEvent
                if (e.preventDefault) e.preventDefault()
                openCallToActionDesignPopup(this.itemData.widgetType);
            }
        });
   

    var LevelupWidgets = new LevelupWidgetsExtands();

    $(document).on("click",'.elementor-control-type-section', function(){
        $(this).parents('#elementor-controls').find('.elementor-control-layoutDesignSelected').hide();
    });
    var openCallToActionDesignPopup = function(designElement){
	    var view = new LevelupPopupView();
	    view.model = levelup_object.widget_design.designs[designElement];
	    view.render().showModal({});
	}

}( jQuery ) );