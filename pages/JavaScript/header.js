function toggle(tab){

    tabName = document.getElementById(tab)
    icon = document.getElementById("icon")

    if(tabName.classList.contains("hidden")){
        tabName.classList.remove("hidden")
        icon.classList.add("rotate-90")
    }else{
        tabName.classList.add("hidden")
        icon.classList.remove("rotate-90")
    }
}