function changePageSize() {
    var size = $('#perPage').val();
    var oldUrl = window.location.pathname;
    var split = oldUrl.split("/");
    var newUrl ="";
    if(split.length > 2){
        for (var i = 0; i < split.length; i++){
            if(i == 4){
                newUrl += size + "/";
            } else if(split[i] != "") {
                newUrl += split[i] + "/";
            }
        }

    } else {
        for (var i = 0; i < split.length; i++){
            newUrl += split[i] + "/";
        }
        newUrl += "index/1/" + size + "/";
    }
    window.location.pathname = newUrl;
}