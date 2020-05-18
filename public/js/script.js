
// model related code
const model = $('.model-container');
const model_edform = $('.model-edform-container');
const backdrop = $('.backdrop');
const body = $('body');
const title = document.getElementsByClassName("example");

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
    
    document.getElementById("ed-title").value = title[data].innerHTML;
    document.getElementById("ed-desc").value = desc[data].innerHTML;
    document.getElementById("ed-postid").value = document.getElementById("id_holder").innerHTML;

    model_edform.fadeIn(200);
    backdrop.show();
    body.css('overflow','hidden');
}


$('#askQuestionBtn').on('click', () => {
    $('#addQuestionForm').submit()
});
