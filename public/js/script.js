
// model related code

const model = $('.model-container');
const model_edform = $('.model-edform-container');
const backdrop = $('.backdrop');
const body = $('body');
const form = document.getElementsByClassName("rating-form");
const unrateForm = document.getElementsByClassName("unrate-form");


function openModel(e) {
    model.fadeIn(200);
    backdrop.show();
    body.css('overflow','hidden');
}

function closeAllModel(e) {
    model.hide();
    model_edform.hide();
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

function closeRateForm(data){
    form[data].style.display = "none";
}

function openRateForm(data){
    
    form[data].style.display = "block";
}


function submitUnrateForm(index){

    unrateForm[index].submit();
}

