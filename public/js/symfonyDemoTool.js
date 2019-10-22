$(document).ready(function(){
    var $body = $('body');
    var albumId = null;

    $body.on("click", ".symfony-demo-tool .btn_update", function(){
        albumId = $(this).parents("tr").attr("id");
        var modalUrl = "/melis/MelisPlatformFrameworkSymfonyDemoTool/SymfonyDemoTool/renderAlbumModalHandler";
        melisHelper.createModal('id_melisplatform_framework_symfony_demo_tool_modal', 'melisplatform_framework_symfony_demo_tool_modal', true, {'album_id': albumId}, modalUrl, function () {});
    });

    $body.on("click", ".symfony-demo-tool #btn-new-album", function(){
        var modalUrl = "/melis/MelisPlatformFrameworkSymfonyDemoTool/SymfonyDemoTool/renderAlbumModalHandler";
        melisHelper.createModal('id_melisplatform_framework_symfony_demo_tool_modal', 'melisplatform_framework_symfony_demo_tool_modal', true, {}, modalUrl, function () {});
    });

    $body.on("click", "#btn-save-album", function(){
        if(albumId == null)
            saveAlbum("/melis/save-album");
        else
            saveAlbum("/melis/save-album/"+albumId);
    });

    $body.on("click", ".symfony-demo-tool .btn_delete", function(){
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
                        data = $.parseJSON(data);
                        if(data.success){
                            melisHelper.melisOkNotification(data.title, data.message);
                            //refresh site table
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
                $("#btn-save-album").attr("disabled", true);
            },
            success: function(data){
                data = $.parseJSON(data);
                if(data.success) {
                    $("#id_melisplatform_framework_symfony_demo_tool_modal_container").modal("hide");
                    melisHelper.melisOkNotification(data.title, data.message);
                    //refresh site table
                    $("#tableSymfonyDemoTool").DataTable().ajax.reload();
                }else{
                    melisHelper.melisKoNotification(data.title, data.message, data.errors);
                }
                $("#btn-save-album").attr("disabled", false);
            }
        });
    }
});