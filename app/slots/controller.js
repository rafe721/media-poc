// 7.4 Display controller #STARTS
app.controller('slotsCtrl', ['$scope', '$http', function($scope, $http) {
	
	/* method used to look for similar displays */
	$scope.loadSimilar = function() {
		// $scope.server_response_Message = $scope.display_search;
		if ("" === $scope.display_search) {
			$scope.displays = $scope.default_list;
			$scope.server_response_Message = "default list loaded";
			console.log("loading default list");
		} else {		
			$scope.server_response_Message = "will load from server";
			console.log("loading from server");
			$http({
				method: 'POST',
				data: {
					'query' : $scope.display_search
				},
				url: 'api/slots/search.php'
			}).then(function successCallback(response) {
				/* if ('No Records Found' == response.data.message) {
					$scope.displays = null;
				} else {
					$scope.displays = response.data.records;
				} */
				if ("No Records Found" == response.data.message) {
					$scope.server_response_Message = response.data.message;
					$scope.displays = null;
				} else {
					$scope.displays = response.data.records;	
				}
				
				
			});
		}
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
			url: 'api/slots/update.php'
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
			url: 'api/slots/read.php'
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
			url: 'api/slots/read.php'
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
			url: 'api/slots/create.php'
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
	
	/* Read Methods */
	$scope.readOne = function(display_id, slot_no){
		closeNav();
		// post id of product to be edited
		$http({
			method: 'POST',
			data: {
				'display_id' : display_id,
				'slot_no' : slot_no
				},
			url: 'api/slots/read_one.php'
		}).then(function successCallback(response) {
			// put the values in form
			$scope.ui = response.data; // ui has all the fields
			openNav();
		})
		.error(function(data, status, headers, config){
			// Materialize.toast('Unable to retrieve record.', 4000);
			openNav();
		});
		/* $http({
			method: 'GET',
			// data: { 'id' : id },
			url: 'api/slots/read_one.php?id='+id
		}).then(function successCallback(response) {
			// put the values in form
			$scope.ui = response.data; // ui has all the fields
			
			openNav();
		}).error(function(data, status, headers, config){
			// Materialize.toast('Unable to retrieve record.', 4000);
			// openNav();
		});
		openNav(); */
	}
	
	$scope.getAll = function(){
		$http({
			method: 'GET',
			url: 'api/slots/read.php'
		}).then(function successCallback(response) {
			// $scope.default_list = response.data.records;
			$scope.displays = response.data[0].records;
		});
	}
	
	/* Update Methods */
	$scope.updateSlot = function(display_id, slot_no, media_id){
		$http({
			method: 'POST',
			data: {
				'display_id' : display_id,
				'slot_no' : slot_no,
				'media_id' : media_id
				},
			url: 'api/slots/update.php'
		}).then(function successCallback(response) {
			// put the values in form
			// $scope.ui = response.data; // ui has all the fields
			
			$scope.readOne(display_id, slot_no);
	 
			// refresh the list
			$scope.getAll();
			
			openNav();
		})
		.error(function(data, status, headers, config){
			// Materialize.toast('Unable to retrieve record.', 4000);
			// alert('here');
			openNav();
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
			url: 'api/slots/update.php'
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
			url: 'api/slots/delete.php'
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