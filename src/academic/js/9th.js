//verifyPersistentLogin()
const timeline        = document.getElementById("timeline")
const Timeline        = document.getElementById("Timeline")
const CollegeList  = document.getElementById("CollegeList")
const Academics  = document.getElementById("Academics")


timeline.addEventListener("click", function(){
    navigateTo("/timeline");
})
Timeline.addEventListener("click", function(){
    navigateTo("/timeline");
})

CollegeList.addEventListener("click", function(){
    navigateTo("/college_list");
})

Academics.addEventListener("click", function(){
    navigateTo("/academic");
})