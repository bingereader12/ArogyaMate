$(document).ready(function(){
    var user1ans1 = document.querySelector(".user1ans1");
    user1ans1.addEventListener("click",function(){
        setTimeout(function(){
            $("#loader1").hide(); 
            $("#bot2").show();
            $("#user2").show();
        },500);
        $("#loader1").show();
    })
    var btnsub = document.querySelector("#btnsub");
    btnsub.addEventListener("click",function(e){
        e.preventDefault();
        setTimeout(function(){
            $("#loader2").hide(); $("#loader2").hide();
            $("#bot3").show();
            $("#user3").show();
        },500);
        $("#loader2").show();
        $("#loader2").show();
    })

    var thankyou = document.querySelector(".thankyou");
    thankyou.addEventListener("click",function(){
        swal("Congratulations", "We will connect shortly.", "success");      
    })
    var user1ans2 = document.querySelector(".user1ans2");
    user1ans2.addEventListener("click", function(){
        // Hide other responses (if any)
        $("#bot2").hide();
        $("#bot3").hide();
        $("#loader").show(); // Show loading indicator (optional)

        // Simulate a delay (you can replace this with actual code to fetch a cat image)
        setTimeout(function(){
            $("#loader").hide(); // Hide loading indicator
            $("#bot2").show(); // Show bot's response with cat image
        }, 1000); // Adjust the delay time as needed
    });
  
    // Handle user1ans3 and user1ans4 (Redirect to Website Pages)
    var user1ans3 = document.querySelector(".user1ans3");
    var user1ans4 = document.querySelector(".user1ans4");
    user1ans3.addEventListener("click", function(){
      window.location.href = "website_page_url_1_here"; // Replace with the URL of the first page
    });
    user1ans4.addEventListener("click", function(){
      window.location.href = "website_page_url_2_here"; // Replace with the URL of the second page
    });
  
    // Handle user1ans5, user1ans6, and user1ans7 (Redirect to Website Pages, Similar to user1ans3 and user1ans4)
  
    // Handle user1ans8 (Display Information about ArogyaMate)
    var user1ans8 = document.querySelector(".user1ans8");
    user1ans8.addEventListener("click", function(){
      displayBotMessage("ArogyaMate is a platform that provides health-related information and services. It offers a wide range of features to help you stay informed about your health.");
      scrollToBottom();
    });
  
    // Example: Display Bot's Welcome Message
    setTimeout(function(){
      bot1.style.display = "block";
      displayBotMessage("Hey there! How may I help you today?");
      scrollToBottom();
    }, 500); 
})