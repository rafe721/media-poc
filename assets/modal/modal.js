// Get the modal
var body = document.getElementById('main_content');

var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
		body.classList.remove("surface_blur");
		body.className += " surface_no_blur";
        modal.style.display = "none";
    }
}

function unblur() {
	body.classList.remove("surface_blur");
	body.className += " surface_no_blur";
}

function openModal(id, init_method) {
	var modal_el = document.getElementById(id);
	body.classList.remove("surface_no_blur");
	body.className += " surface_blur";
	modal_el.classList.remove("modal-content-closing");
	modal_el.className += " modal-content-opening";
	if (null != init_method) {
		init_method();
	}
	
}

function closeModal(ele) {
	var id = '';
	var element_ = ele;
	while (id == '') {
		if (element_.classList.contains("modal")) {
			id = element_.id;
		} else {
			if (element_.nodeName == 'BODY') {
				break;
			}
			element_ = element_.parentElement;
		}
	}
	
	body.classList.remove("surface_blur");
	body.className += " surface_no_blur";
	
	var modal_el = document.getElementById(id);
	modal_el.classList.remove("modal-content-opening");
	modal_el.className += " .modal-content-closing";
}

function closeModalById(id) {
	
	body.classList.remove("surface_blur");
	body.className += " surface_no_blur";
	
	var modal_el = document.getElementById(id);
	modal_el.classList.remove("modal-content-opening");
	modal_el.className += " .modal-content-closing";
}