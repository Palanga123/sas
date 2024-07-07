function tabing(event, tab){
    let i, links, tabContent, show

    //Hide content
    tabContent = document.getElementsByClassName("tabContent")
    for(i = 0; i < tabContent.length; i++){
        tabContent[i].style.display = "none" 
    }

    links = document.getElementsByClassName("links")
    for(i = 0; i < links.length; i++){
        links[i].classList.remove("text-white")
        links[i].classList.remove("bg-sky-600")
    }

    show = document.getElementById(tab);
    show.style.display = "block"
    event.currentTarget.classList.add("bg-sky-600")
    event.currentTarget.classList.add("text-white")
}

document.getElementById("default").click()


