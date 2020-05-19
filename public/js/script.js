
// model related code

const model = $('.model-container');
const model_announcement = $('.model-announcement-container');
const model_edform = $('.model-edform-container');
const model_edit_form = $('.model-edit-container');
const model_add_mod_form = $('.model-add-mod-container');
const backdrop = $('.backdrop');
const body = $('body');
const form = document.getElementsByClassName("rating-form");
const unrateForm = document.getElementsByClassName("unrate-form");


function openModel(e) {
    model.fadeIn(200);
    backdrop.show();
    body.css('overflow','hidden');
}

function openAnnouncementModel(data) {
    var id_holder = this.document.getElementsByClassName("id_holder");
    document.getElementById("subredlite-id").value = id_holder[data].innerHTML;

    model_announcement.fadeIn(200);
    backdrop.show();
    body.css('overflow','hidden');
}

function closeAllModel(e) {
    model.hide();
    model_announcement.hide();
    model_edform.hide();
    model_edit_form.hide();
    model_add_mod_form.hide();
    backdrop.fadeOut(500);
    body.css('overflow','scroll');
    body.css('overflow-x','hidden');
}

function openEditModel(data) {

    var title = this.document.getElementsByClassName("title");
    var desc = this.document.getElementsByClassName("desc");
    var id_holder = this.document.getElementsByClassName("id_holder");
    
    document.getElementById("ed-title").value = title[data].innerHTML;
    document.getElementById("ed-postidw").value = id_holder[data].innerHTML;
    document.getElementById("ed-desc").value = desc[data].innerHTML;

    model_edform.fadeIn(200);
    backdrop.show();
    body.css('overflow','hidden');
}

function openSubRedliteEditModel(data) {

    var title = this.document.getElementsByClassName("name");
    var desc = this.document.getElementsByClassName("desc");
    var id_holder = this.document.getElementsByClassName("id_holder");
    
    document.getElementById("edit-name").value = title[data].innerHTML;
    document.getElementById("edit-subredlite-id").value = id_holder[data].innerHTML;
    document.getElementById("edit-description").value = desc[data].innerHTML;

    model_edit_form.fadeIn(200);
    backdrop.show();
    body.css('overflow','hidden');
}

function openAddModModel(data) {
    var id_holder = this.document.getElementsByClassName("id_holder");
    
    document.getElementById("mod-subredlite-id").value = id_holder[data].innerHTML;

    model_add_mod_form.fadeIn(200);
    backdrop.show();
    body.css('overflow','hidden');
}

function closeRateForm(data){
    form[data].style.display = "none";
}

function openRateForm(data){
    
    form[data].style.display = "block";
}


function submitUnrateForm(index){

    unrateForm[index].submit();
}

