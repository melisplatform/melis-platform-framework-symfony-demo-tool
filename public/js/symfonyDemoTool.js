$(document).ready(function(){
    var $body = $('body');
    var albumId = null;

    /**
     * Open modal to update record
     */
    $body.on("click", ".symfony-demo-tool #btn-update-album", function(){
        albumId = $(this).parents("tr").attr("id");
        renderModal("/melis/get-form/"+albumId);
    });

    /**
     * Open modal to add new record
     */
    $body.on("click", ".symfony-demo-tool #btn-new-album", function(){
        albumId = null;
        renderModal("/melis/get-form");
    });

    /**
     * Save album
     */
    $body.on("click", "#btn-save-album", function(){
        if(albumId == null)
            saveAlbum("/melis/save-album");
        else
            saveAlbum("/melis/save-album/"+albumId);
    });

    /**
     * Delete album
     */
    $body.on("click", ".symfony-demo-tool #btn-delete-album", function(){
        var _this = $(this);
        melisCoreTool.confirm(
            translations.tr_meliscore_common_yes,
            translations.tr_meliscore_common_no,
            translations.tr_MelisPlatformFrameworkSymfonyDemoToolPlugin_delete_album_title,
            translations.tr_MelisPlatformFrameworkSymfonyDemoToolPlugin_delete_album_message,
            function() {
                $.ajax({
                    url: "/melis/delete-album",
                    data: {"id" : _this.parents("tr").attr("id")},
                    method: "POST",
                    beforeSend: function(){

                    },
                    success: function(data){
                        // update flash messenger values
                        melisCore.flashMessenger();
                        data = $.parseJSON(data);

                        if(data.success){
                            melisHelper.melisOkNotification(data.title, data.message);
                            //refresh table
                            $("#tableSymfonyDemoTool").DataTable().ajax.reload();
                        }else{
                            melisHelper.melisKoNotification(data.title, data.message);
                        }
                    }
                });
            }
        );
    });

    /**
     * Save album
     * @param url
     */
    function saveAlbum(url){
        $.ajax({
            url: url,
            data: $("#album_form").serializeArray(),
            method: "POST",
            beforeSend: function(){
                //disable button
                $("#btn-save-album").attr("disabled", true);
                //disable all fields
                $("#album_form :input").prop("disabled", true);
            },
            success: function(data){
                // update flash messenger values
                melisCore.flashMessenger();

                data = $.parseJSON(data);
                if(data.success) {
                    $("#symfonyDemoToolAlbumModal").modal("hide");
                    melisHelper.melisOkNotification(data.title, data.message);
                    //refresh table
                    $("#tableSymfonyDemoTool").DataTable().ajax.reload();
                    //assign null to album id after saving/updating record
                    albumId = null;
                }else{
                    melisHelper.melisKoNotification(data.title, data.message, data.errors);
                    melisCoreTool.highlightErrors(0, data.errors, "album_form");
                }
                //enable save button
                $("#btn-save-album").attr("disabled", false);
                //enable form fields
                $("#album_form :input").prop("disabled", false);
            }
        });
    }

    /**
     *
     * @param url
     */
    function renderModal(url)
    {
        var modal = $("#symfonyDemoToolAlbumModal");
        modal.modal('show');
        $.ajax({
            url: url,
            method: "GET",
            beforeSend: function(){
                /**
                 * Lets show a loader while waiting for the ajax to get
                 * the content
                 */
                modal.find(".modal-content #loader").removeClass('hidden');
                modal.find(".modal-content .modal-body").addClass('hidden');
                /**
                 * we need to modify a little bit the modal
                 * like changing the text and icon of the header to
                 * determine whether we are going to update or
                 * create a record since we are using one
                 * modal for both update and create
                 */
                var title =  modal.find("li.active").find("a");
                if(albumId == null){
                    title.removeClass("edit").addClass("plus");
                    title.find("p.modal-tab-title").text("Create");
                }else{
                    title.removeClass("plus").addClass("edit");
                    title.find("p.modal-tab-title").text("Update");
                }
            },
            success: function(data){
                /**
                 * Hide the load and show the content
                 */
                modal.find(".modal-content #loader").addClass('hidden');
                modal.find(".modal-content .modal-body").removeClass('hidden');
                /**
                 * Replace the content of the modal
                 */
                modal.find(".tab-content .active").html(data);
            }
        });
    }
});