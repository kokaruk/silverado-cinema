function loadCSS(){

    if( document.getElementById("wireframecss").checked)
    {
        var file = document.createElement("link");
        file.setAttribute("rel", "stylesheet");
        file.setAttribute("type", "text/css");
        file.setAttribute("href", "css/wireframe.css");

        if (typeof file !== "undefined"){
            document.head.appendChild(file);
        }

    } else {
        var wireframe = document.querySelector("link[href='css/wireframe.css']")
        wireframe.parentNode.removeChild(wireframe);
    }


}