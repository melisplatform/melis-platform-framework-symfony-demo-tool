$(document).ready(function(){
    var body = $('body');

    body.on("click", "#btn-new-album", function(){
        var modalUrl = "/melis/MelisCodeExampleSymfony/MelisCodeExampleSymfony/renderCodeExampleSymfonyModalHandler";
        melisHelper.createModal('id_meliscodeexamplesymfony_tool_modal', 'meliscodeexamplesymfony_tool_modal', true, {}, modalUrl, function () {});
    });
    
    body.on("submit", "", function(){

    });
});