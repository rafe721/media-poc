// 7.4 Display controller #STARTS
app.controller('mediaCtrl', ['$scope', '$http', function($scope, $http) {
	
	var notification = null;
	
	var isOverlay = false;
	
	// initialising arrays;
	$scope.change = [];
	$scope.preview = [];
	
	/* method used to look for similar displays */
	$scope.loadSimilar = function() {
		// $scope.server_response_Message = $scope.display_search;
		$scope.server_response_Message = "Loading Similar";
		$scope.server_response_status = "Nothing Yet " + $scope.display_search;
		if ("" == $scope.display_search || null == $scope.display_search) {
			// $scope.media = $scope.default_list;
			$scope.getAll();
			// $scope.server_response_Message = "default list loaded";
			console.log("loading default list");
			$scope.server_response_status = "loading All";
		} else {		
			// $scope.server_response_Message = "will load from server";
			console.log("loading from server");
			$http({
				method: 'POST',
				data: {
					'query' : $scope.display_search
				},
				url: 'api/media/search.php'
			}).then(function successCallback(response) {
				/* if ('No Records Found' == response.data.message) {
					$scope.displays = null;
				} else {
					$scope.displays = response.data.records;
				} */
				if ("No Records Found" == response.data.message) {
					// $scope.server_response_Message = response.data.message;
					$scope.media = null;
				} else {
					$scope.media = response.data.records;	
				}
				$scope.server_response_status = "loading query result";
			});
		}
	}
	
	$scope.pauseOrPlay = function(ele){
           var video = angular.element(ele.srcElement);
		   video[0].play();
            // video[0].pause(); // video.play()
    }
	
	/* Read Methods */
	$scope.readOne = function(id){
		$http({
			method: 'GET',
			// data: { 'id' : id },
			url: 'api/media/read_one.php?id='+id
		}).then(function successCallback(response) {
			// put the values in form
			$scope.ui = response.data[0]; /// ui has all the fields
			if (!$scope.isOverlay) {
				openNav();
			}
			$scope.isOverlay = true;
		}).error(function(data, status, headers, config){
			// Materialize.toast('Unable to retrieve record.', 4000);
			openNav();
			notification = new NotificationBar({
				message : '<p>Failed to retrieve media Data.</p>',
				icon: 'like',
				layout : 'bar',
				location: 'bottom',
				onClose : function() {
					bttn.disabled = false;
				}
			});
			
			notification.show();
		});
		// openNav();
	}
	
	$scope.closeOverlay = function(){
		if ($scope.isOverlay) {
			closeNav();
			$scope.isOverlay = false;
			$scope.ui = [];
		}
		// openNav();
	}
	
	$scope.getAll = function(){
		$http({
			method: 'GET',
			url: 'api/media/read.php'
		}).then(function successCallback(response) {
			$scope.default_list = response.data.records;
			$scope.media = $scope.default_list;
		});
	}
	
	$scope.preview = function(media_id) {
		// call ajax and get updated name
		$scope.preview.title = "Preview: "; // name from the server
		$scope.preview.path = "uploads/dizzy.webm";
		$scope.preview.type = "video/webm";
		
		$scope.change.media_id = media_id;
		$scope.change.media_name = media_name;
		
		$('#form_media_name_label').show();
		$('#modal_text_input').show();
		// $('#form_media_name_input').show();
		
		$('#btn_change_media').show();
		$('#btn_remove_media').hide();
		
		$scope.form_media_id = media_id;
		$scope.form_media_name = media_name;
		$scope.form_media_label = "Change how you refer " + media_name;
		
		openModal('view_media');
	}
	
	/* Modal Methods */
	$scope.showChangeModal = function(media_id, media_name) {
		$scope.media_form_title = "Change";
		
		$scope.change.media_id = media_id;
		$scope.change.media_name = media_name;
		
		$('#form_media_name_label').show();
		$('#modal_text_input').show();
		// $('#form_media_name_input').show();
		
		$('#btn_change_media').show();
		$('#btn_remove_media').hide();
		
		$scope.form_media_id = media_id;
		$scope.form_media_name = media_name;
		$scope.form_media_label = "Change how you refer " + media_name;
		
		openModal('media_editable');
	}
	
	/* Modal Methods */
	$scope.showRemoveModal = function(media_id, media_name) {
		$scope.media_form_title = "Remove";
		
		$('#form_media_name_label').show();
		$('#modal_text_input').hide();
		// $('#form_media_name_input').hide();
		
		$('#btn_change_media').hide();
		$('#btn_remove_media').show();
		
		$scope.form_media_id = media_id;
		
		$scope.form_media_label = 'Are you sure you would like to remove ' + media_name + "? Slots with this Video will automatically be cleared.";
		
		openModal('media_editable');
	}
	
	/* Modal Methods */
	$scope.clearDialogFields = function(media_id, media_name) {
		$('#btn_change_media').show();
		$('#btn_remove_media').show();
		$scope.media_form_title = "Media Dialog";
		$scope.form_media_id = "None";
		$scope.form_media_label = "Media Label";
		
	}
	
	/* Update Methods */
	$scope.updateMedia = function($event){
		var el = event.target; // get target from Event.
		$scope.server_response_status = "updating Media";
		if ("" == $scope.form_media_name) {
			$scope.form_media_name = $scope.change.media_name;
			notification = new NotificationBar({
				message : '<p>Media name cannot be empty.</p>',
				icon: 'like',
				layout : 'bar',
				location: 'bottom',
				onClose : function() {
					bttn.disabled = false;
				}
			});

			notification.show();
		} else {
			if ($scope.change.media_name == $scope.form_media_name) {
				notification = new NotificationBar({
					message : '<p>The file in the system was not changed as the new Reference name is the same as the old.</p>',
					icon: 'like',
					layout : 'bar',
					location: 'bottom',
					onClose : function() {
						bttn.disabled = false;
					}
				});

				notification.show();
				
				$scope.clearForm();
					
				$scope.loadSimilar();
				
				if (null == $event) {
					$scope.hideMediaModal();
				} else {
					closeModal(el);	
				}
				
				$scope.clearDialogFields();
			} else {
				
				$http({
					method: 'POST',
					data: {
						'media_id' : $scope.form_media_id,
						'media_name' : $scope.form_media_name
					},
					url: 'api/media/update.php'
				}).then(function successCallback(response) {
					
					$scope.server_response_status = response.data[0].status;
					
					$scope.server_response_Message = response.data[0].message;
			 
					// clear modal content
					$scope.clearForm();
					
					$scope.loadSimilar();
					
					
					if (null == $event) {
						$scope.hideMediaModal();
					} else {
						closeModal(el);	
					}
					
					if ($scope.isOverlay) {
						$scope.readOne($scope.form_media_id);
					}
					
					$scope.clearDialogFields();
					
					notification = new NotificationBar({
						message : '<p>The Media reference was renamed to <b>' + $scope.form_media_name + '</b></p>',
						icon: 'like',
						layout : 'bar',
						location: 'bottom',
						onClose : function() {
							bttn.disabled = false;
						}
					});

					notification.show();
				});
			}
			$scope.change = []; // reset the array
		}
	}
	
	/* delete Methods */
	$scope.removeMedia = function($event){
		var el = event.target; // get target from Event.
		$scope.server_response_status = "Removing Media";
		$http({
			method: 'POST',
			data: {
				'media_id' : $scope.form_media_id
			},
			url: 'api/media/delete.php'
		}).then(function successCallback(response) {
			
			$scope.server_response_status = response.data[0].status;
			
			$scope.server_response_Message = response.data[0].message;
	 
			// clear modal content
			$scope.clearForm();
			
			$scope.loadSimilar();
			
			if (null == $event) {
				$scope.hideMediaModal();
			} else {
				closeModal(el);	
			}
			
			if ($scope.isOverlay) {
				closeNav();
				$scope.ui = [];
				$scope.isOverlay = false;
			}
			 
			$scope.clearDialogFields();
			
			$scope.showDeleteNotification();
		});
	}
	
	/* Modal Methods */
	$scope.showChangeNotification = function() {
		//showNotification();
		notification = new NotificationBar({
			message : '<p>Media has been Changed.</p>',
			icon: 'like',
			layout : 'bar',
			location: 'bottom',
			onClose : function() {
				bttn.disabled = false;
			}
		});

		notification.show();
	}
	
				
	/* Modal Methods */
	$scope.showDeleteNotification = function() {
		//showNotification();
		notification = new NotificationBar({
			message : '<p>Media has been deleted</p>',
			icon: 'like',
			layout : 'bar',
			location: 'bottom',
			onClose : function() {
				bttn.disabled = false;
			}
		});

		notification.show();
	}
	
	$scope.hideMediaModal = function() {
		hide_media();
	}
	
	$scope.closeDialog = function($event) {
		// reset the Modal Dialog Fields
		$scope.clearDialogFields();
		
		var el = event.target;
		closeModal(el);
	}
	
	/* Show Add Slot Dialog */
	
	$scope.hideSlotModal = function() {
		hide_slot();
	}
	
	$scope.clearSlotModal = function() {
		hide_slot(); // the CSS first
		$scope.slot_form_title = "Placebo";
		$scope.slot_form_slot_no = 0;
		$scope.slot_media_id = 0;
		$scope.slot_media = null;
	}
	
	$scope.modifySlotData = function () {
		
		/* 
		 * media_id = slot_media_id
		 * display_id = ui.display_id
		 * slot_no = slot_form_slot_no
		 */
		// $scope.hideSlotModal(); // hide the slot modal immediately.
		$http({
			method: 'POST',
			data: {
				'media_id' : $scope.slot_media_id,
				'display_id' : $scope.ui.display_id,
				'slot_no' : $scope.slot_form_slot_no
			},
			url: 'api/media_on_display/update.php'
		}).then(function successCallback(response) {
			$scope.server_response_status = response.data[0].status;
			
			$scope.server_response_Message = response.data[0].message;
			
			// response.data.message to display information to user.
			$scope.modifySlotUI(parseInt($scope.slot_form_slot_no) - 1 ,response.data[0].slot);
			$scope.clearSlotModal();
		});
	}
	
	$scope.modifySlotUI = function (slot_no, aSlot) {
		/* another method
		$scope.ui.slots[2].media_id = 15;
		*/
		console.log(slot_no);
		console.log(aSlot);
		$scope.ui.slots[slot_no] = aSlot;
	}
	
	$scope.showSlotPreview = function (slot_no, media_id) {
		var aSlot = {slot_no: 3, media_id: 2, media_name: "gestapo"};
		// $scope.ui.slots[2] = aSlot;
		$scope.modifySlotUI(2, aSlot);
		
	}
	
	/*  */
	$scope.showAddSlotDialog = function(slot_no) {
		$scope.slot_form_title = "Add Slot";
		$scope.slot_form_slot_no = slot_no;
		// for mediaId
		// $scope.slot_media_id = 8;
		
		// show create button hide others
		$('#btn_add_slot').show();
		$('#btn_clear_slot').hide();
		$('#btn_swap_slot').hide();
		
		// show the loading div
		$('#slot_loading').show();
		show_slot();
		// get names of available media.
		$http({
			method: 'GET',
			url: 'api/media/read.php'
		}).then(function successCallback(response) {
			$('#slot_loading').hide();
			// $scope.slot_media_id = '14';
			$scope.slot_media = response.data.media;
		});
		// show_slot_modal();
	}
	
	/* clear Slot Dialog */
	$scope.showClearSlotDialog = function(slot_no) {
		$scope.slot_form_title = "Clear Slot";
		
		/* 
		 * media_id = slot_media_id
		 * display_id = ui.display_id
		 * slot_no = slot_form_slot_no
		 */
		
		// for mediaId
		$scope.slot_media_id = 0; // '0' as we are clearing
		
		// for slot no
		$scope.slot_form_slot_no = slot_no;

		// show Clear button hide others
		$('#btn_add_slot').hide();
		$('#btn_clear_slot').show();
		$('#btn_swap_slot').hide();
		
		// hide the loading div
		$('#slot_loading').show();
		show_slot();
		
	}
	
	/* */
	$scope.showSwapSlotDialog = function(slot_no, media_id) {
		$scope.slot_form_title = "Swap Slot Media";
		
		/* 
		 * media_id = slot_media_id
		 * display_id = ui.display_id
		 * slot_no = slot_form_slot_no
		 */
		
		// for slot no
		$scope.slot_form_slot_no = slot_no;
		
		// show update button hide others	
		$('#btn_add_slot').hide();
		$('#btn_clear_slot').hide();
		$('#btn_swap_slot').show();
		
		// show the loading div
		$('#slot_loading').show();
		show_slot();
		// get names of available media.
		$http({
			method: 'GET',
			url: 'api/media/read.php'
		}).then(function successCallback(response) {
			$('#slot_loading').hide();
			
			$scope.slot_media_id = media_id.toString(); // has to be done
			$scope.slot_media = response.data.media; // media that came from the server
		});
	}
	
	
	$scope.addSlotMedia = function(slot_no) {
		$scope.slot_form_title = "Clear Slot";
		
		// for slot no
		$scope.slot_form_slot_no = slot_no;
		
		// show create product button
		$('#btn_add_slot').show();
		$('#slot_loading').show();
		show_slot();
		$http({
			method: 'GET',
			url: 'api/media/read.php'
		}).then(function successCallback(response) {
			$('#slot_loading').hide();
			// $scope.slot_media_id = '8'; preselect that works
			$scope.slot_media = response.data.media;
		});
		// show_slot_modal();
	}
	
	
	/* END of Slot modification methods */
	/* START of Display modification methods */
	
	$scope.available_slots = [1, 2, 3, 4, 5, 6]
	
	/* show the Create display Form */
	$scope.popCreateform = function() {
		$scope.clearForm();
		$scope.display_form_title = "Create Form";
		
		// show create product button
		$('#btn_add_display').show();
		
		// show update product button
		$('#btn_update_display').hide();
		
		// hide remove display Button
		$('#btn_remove_display').hide();
		
		div_show();
	}
	
	$scope.clearForm = function() {
		$scope.display_form_title = "Display Form";
		$scope.form_reg_code = "";
		$scope.form_display_name = "";
		$scope.form_slot_count = 2;
		
		// hide add display button
		$('#btn_add_display').hide();
		
		// hide update display button
		$('#btn_update_display').hide();
		
		// hide remove display Button
		$('#btn_remove_display').hide();
		
	}
	
	/* update Display form */
	$scope.popUpdateform = function() {
		$scope.display_form_title = "Update Display";
		$scope.form_display_id = $scope.ui.display_id;
		$scope.form_reg_code = $scope.ui.reg_code;
		$scope.form_display_name = $scope.ui.display_name;
		$scope.form_slot_count = parseInt($scope.ui.slot_count, 10);
		
		// hide Add Display button
		$('#btn_add_display').hide();
		
		// show update product button
		$('#btn_update_display').show();
		
		// hide remove display Button
		$('#btn_remove_display').hide();
		
		div_show();
	}
	
	/* Remove Display Form */
	$scope.popRemoveform = function() {
		$scope.display_form_title = "Remove Display";
		$scope.form_display_id = $scope.ui.display_id;
		$scope.form_reg_code = $scope.ui.reg_code;
		$scope.form_display_name = $scope.ui.display_name;
		$scope.form_slot_count = parseInt($scope.ui.slot_count, 10);
		
		// hide Add Display button
		$('#btn_add_display').hide();
		
		// show update product button
		$('#btn_update_display').hide();
		
		// hide remove display Button
		$('#btn_remove_display').show();
		
		div_show();
	}
	
	/* Create Display methods */
	$scope.createDisplay = function(){
 
		$http({
			method: 'POST',
			data: {
				'display_name' : $scope.form_display_name,
				'reg_code' : $scope.form_reg_code,
				'slot_count' : $scope.form_slot_count
			},
			url: 'api/display/create.php'
		}).then(function successCallback(response) {
			
			$scope.server_response_status = response.data[0].status;
			
			$scope.server_response_Message = response.data[0].message;
	 
			// clear modal content
			$scope.clearForm();
			
			div_hide();
	 
			// refresh the list
			$scope.getAll();
		});
	}
	
	/* Update Methods */
	$scope.updateDisplay = function(){
 
		$http({
			method: 'POST',
			data: {
				'display_id' : $scope.form_display_id,
				'display_name' : $scope.form_display_name,
				'reg_code' : $scope.form_reg_code,
				'slot_count' : $scope.form_slot_count
			},
			url: 'api/display/update.php'
		}).then(function successCallback(response) {
			
			$scope.server_response_status = response.data[0].status;
			
			$scope.server_response_Message = response.data[0].message;
	 
			// clear modal content
			$scope.clearForm();
			
			div_hide();
	 
			// refresh the list
			$scope.getAll();
		});
	}
	
	/* delete Methods */
	$scope.removeDisplay = function(){
 
		$http({
			method: 'POST',
			data: {
				'display_id' : $scope.form_display_id
			},
			url: 'api/display/delete.php'
		}).then(function successCallback(response) {
			
			$scope.server_response_status = response.data[0].status;
			
			$scope.server_response_Message = response.data[0].message;
	 
			// clear modal content
			$scope.clearForm();
			
			div_hide();
	 
			// refresh the list
			$scope.getAll();
		});
	}
	
}]);
// 7.5 Display controller #ENDS

app.filter("trustUrl", ['$sce', function ($sce) {
	return function (recordingUrl) {
		return $sce.trustAsResourceUrl(recordingUrl);
	};
}]);