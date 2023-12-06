$(document).ready(function(){
    // Header app
    $("nav ul li").on('click' , function(){
        console.log($(this).text());
    })
    $("nav i.datalist").on('click' , function(){
        $("ul.linked-list").toggleClass("block").toggleClass("links");
    })
    var homeOffset = $("#home").offset().top
    var servicesOffset = $("#services").offset().top
    var portfolioOffset = $("#portfolio").offset().top
    var aboutOffset = $("#about").offset().top
    var pricingOffset = $("#pricing").offset().top
    var contactOffset = $("#contact").offset().top

    $(window).scroll(function(){
        var windowOffset = $(this).scrollTop();

        if(windowOffset >= servicesOffset){
            $(".arrow-parent").fadeIn()

        }else{
            $(".arrow-parent").fadeOut()
        }
        if(windowOffset >= homeOffset && windowOffset <= servicesOffset){
            $(".links li.Home").addClass("active").siblings().removeClass("active");
        }if(windowOffset >= servicesOffset && windowOffset <= portfolioOffset){
            $(".links li.Services").addClass("active").siblings().removeClass("active");
        }if(windowOffset >= portfolioOffset && windowOffset <= aboutOffset){
            $(".links li.Portfolio").addClass("active").siblings().removeClass("active");
        }if(windowOffset >= aboutOffset && windowOffset <= pricingOffset){
            $(".links li.About").addClass("active").siblings().removeClass("active");
        }if(windowOffset >= pricingOffset && windowOffset <= contactOffset){
            $(".links li.Pricing").addClass("active").siblings().removeClass("active");
        }if(windowOffset >= contactOffset){
            $(".links li.Contact").addClass("active").siblings().removeClass("active");
        }

        if(windowOffset >= servicesOffset - 100 ){
            $("header").css({
                backgroundColor: "rgba(1,1,1,0.6)",
                Transform:"translateY(-20px)"
            })
        }else{
            $("header").css({
                backgroundColor: "rgba(1,1,1,0)",
                Transform:"translateY(0px)"
            })
        }

    })

    $(".arrow-parent").click(function(){
        ("body").animate({ scrollTop : '0'},1500)
    })

    $("textarea").keyup(function(e){
        if(e.target.value.length >= 100){
            e.target.value = e.target.value.substr(0,100)
        }
    })

    // $("nav ul li a[href^='#']").click(function(){
        
    //     let Href = $(this).attr('href');
    //     let offseet = $(Href).offset().top
    //     $("html,body").animate({scrollTop : offseet}, 2000)
    // })

    if(localStorage.getItem("counter")){
        var counter = parseInt(localStorage.getItem("counter"))
    }else{
        var counter = 1
    }
    $(".home").css({
        backgroundImage: `url(images/landing${counter}.jpg)`
    })
    $(".home .bullets span").eq(counter-1).css({
        border:"0",
        backgroundColor:'var(--main-color)'

    }).siblings().css({
        border:"1px solid #fff",
        backgroundColor:'transparent'
    })

    if(!localStorage.getItem("counter")){
        localStorage.setItem("counter",counter)
    }

    $(".fa-angle-right").click(function(){
        counter = parseInt(localStorage.getItem("counter"))

        if(counter >= 4){
            counter=1
        }else{
            counter += 1
        }
        $(".home").css({
            backgroundImage: `url(images/landing${counter}.jpg)`
        })
        $(".home .bullets span").eq(counter-1).css({
            border:"0",
            backgroundColor:'var(--main-color)'
    
        }).siblings().css({
            border:"1px solid #fff",
            backgroundColor:'transparent'
        })
        localStorage.setItem("counter",counter)

    })
    $(".fa-angle-left").click(function(){
        counter = parseInt(localStorage.getItem("counter"))

        if(counter == 1){
            counter=4
        }else{
            counter -= 1
        }
        $(".home").css({
            backgroundImage: `url(images/landing${counter}.jpg)`
        })
        $(".home .bullets span").eq(counter-1).css({
            border:"0",
            backgroundColor:'var(--main-color)'
    
        }).siblings().css({
            border:"1px solid #fff",
            backgroundColor:'transparent'
        })
        localStorage.setItem("counter",counter)

        
    })
    $(".home .bullets span").click(function(){
        counter = parseInt(localStorage.getItem("counter"))

        $(".home").css({
            backgroundImage: `url(images/landing${$(this).attr("class")}.jpg)`
        })
        $(".home .bullets span").eq($(this).attr("class")-1).css({
            border:"0",
            backgroundColor:'var(--main-color)'
    
        }).siblings().css({
            border:"1px solid #fff",
            backgroundColor:'transparent'
        })
        localStorage.setItem("counter",$(this).attr("class"))
        console.log($(this).attr("class"));

    })

    
})

var typed = new Typed('#demo', {
    strings: ['We Are Kasper We Make Art.','We Are Kasper We Make Art.'],
    typeSpeed: 50,
    backSpeed: 20,
    loop:true
  });



$(window).on("load",function(){
    $(".loading-area").fadeOut(3000)
})