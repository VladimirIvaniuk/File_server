$(document).ready(function () {
    var check="";
    var newNameForRename = "";
    $('tbody tr').click(function () {
        $('tbody tr').each(function () {
            $(this).removeClass("checked");
        });
        check=$(this).find('.search');
        $(this).addClass("checked");
    });


    $('#btnRename').click(function () {

        if(check.text()!="" && $("input[name='newName']").val()!="") {
            newNameForRename=$("input[name='newName']").val();
            $.ajax({
                url: "rename.php",
                type: "post",
                data: {'nameFile': check.text(),'newName':newNameForRename},
                success: function (data) {
                    if(data=="1"){
                        $(this).find('.search').html(newNameForRename);
                    }
                }
            });
        }
        else{
            alert("Выбери файл или дерикторию");
        }
    });
    $("#openFolder").click(function () {
        if (check!=""){
            $.ajax({
                type:"post",
                url:"open_dir.php",
                data:{'nameDir':check.text()},

                }
            )
        }
    })




});