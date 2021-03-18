const backToTopButton=document.querySelector("#gototop")
window.addEventListener("scroll",scrollFunction);
function scrollFunction(){
    if(window.scrollY > 300){
        backToTopButton.style.display="block"
    }
    else{
        backToTopButton.style.display="none"
    }
}