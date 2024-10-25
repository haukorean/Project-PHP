<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/css/icons.min.css')}}">
    <link rel="stylesheet" type="text/css" id="light-style" href="{{asset('/backend/assets/css/app.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/HomeUser.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/StyleMultiItem.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/styleChatbot.css')}}">

    <title>{{$title_tag}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <script src="{{asset('/backend/assets/js/vendor.min.js')}}"></script>  
        <script src="{{asset('/backend/assets/js/app.min.js')}}"></script>
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

        <link rel="stylesheet" href="{{asset('/backend/sweetalert2.min.css')}}">
        <script src="{{asset('/backend/sweetalert2.all.min.js')}}"></script>

         <!-- Scripts -->
 
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
         <!-- Scripts -->
    


    <script>
      Pusher.logToConsole = true;
      var pusher = new Pusher('604a7d0330f3d7bd2d2b', {
        cluster: 'ap1'
      });
      var iduser = {{Auth::user()->id}};
      var channel = pusher.subscribe('notificationbook.'+ iduser);
      channel.bind('my-event', function(data) {
        $.NotificationApp.send("","Kết quả khám bệnh của bạn đã có !","top-right","#FF6347","infor"); 
      });


    </script>
</head>

<body>


      <section class="wrapper" >
         @include('User.include.header_user')

          <div class="content-page" >
                <div class="content">
                      @include('User.include.sidebar_left_user')
                       <div class="container-fluid layout_user">
                          <div id="loader" class="d-flex justify-content-center align-items-center">
                              <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                              </div>
                          </div>
                          <div id="main" style="display: none">
                              @yield('contents_user')
                          </div>
  
                        </div>
                 
                </div>
                <!-- content -->
            </div>









         <button class="chatbot-toggler">
            <span class="material-symbols-rounded"><img class="iconChat" src="{{asset('/Image/iconChat.png')}}" alt=""></span>
            <span class="material-symbols-outlined"><img class="iconChat" src="{{asset('/Image/iconChat.png')}}" alt=""></span>
          </button>
          <div class="chatbot">
            <header>
              <h2>Chatbot SHC</h2>
              <span class="close-btn material-symbols-outlined"><i class=" dripicons-cross"></i></span>
            </header>
            <ul class="chatbox">
              <li class="chat incoming">
                <span class="material-symbols-outlined"><img class="iconChatsm" src="{{asset('/Image/iconChat.png')}}" alt=""></span>
                <p>Xin Chào 👋<br>Tôi là trợ lý y tế, tôi có thể giúp gì cho bạn?</p>
              </li>



            </ul>
            <div class="chat-input">
                 <textarea id="messChat" placeholder="Enter a message..." spellcheck="false" required></textarea>
                 <span id="send-btn" class="material-symbols-rounded"><img class="" src="{{asset('/Image/send-message.png')}}" alt=""></span>
          
            </div>
          </div>


    </section>



<script type="text/javascript" >
 $(document).ready(function(){
  
  $(window).on('load', function() {
      var displayTime = 50;
      setTimeout(function() {
          $('#main').fadeIn();
           $('#loader').remove();
      }, displayTime);
    });


  });
</script>  

<script type="text/javascript">
    const chatbotToggler = document.querySelector(".chatbot-toggler");
    const closeBtn = document.querySelector(".close-btn");

  $('#send-btn').on("click", function(){
 
   SendChat()
     
  });

    function SendChat(){
        $('.chat-input').hide();

        var value = $('#messChat').val();

        $('.chatbox').append(` <li class="chat outgoing"><p>`+value+`</p></li>`).scrollTop($(".chatbox")[0].scrollHeight)

        $('.chatbox').append(`<li class="chat incoming LoadingMes">
                      <span class="material-symbols-outlined"><img class="iconChatsm" src="{{asset('/Image/iconChat.png')}}" alt=""></span>
                      <p>Đang phân tích...</p>
                    </li>`).scrollTop($(".chatbox")[0].scrollHeight)

         var _token = $('input[name="_token"]').val();
           $.ajax({
                  url:'{{url('/user/chatbot-al')}}',
                  method:"GET",
                  headers:{
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                data:{value:value},
                  success:function(data){

                 $('.chat-input').show();
                 $('#messChat').val("");

                 $('.LoadingMes').remove()
                 $('.chatbox').append(`<li class="chat incoming">
                      <span class="material-symbols-outlined"><img class="iconChatsm" src="{{asset('/Image/iconChat.png')}}" alt=""></span>
                      <p>`+data+`</p>
                    </li>`).scrollTop($(".chatbox")[0].scrollHeight)
                            
                  }
          }); 

    }



    $(document).keydown(function(event) {
      if (event.keyCode === 13 ) {
        SendChat()
      }

   }); 



     closeBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
     chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));


</script>



{{-- <script type="text/javascript">
        const chatbotToggler = document.querySelector(".chatbot-toggler");
        const closeBtn = document.querySelector(".close-btn");
        const chatbox = document.querySelector(".chatbox");
        const chatInput = document.querySelector(".chat-input textarea");
        const sendChatBtn = document.querySelector(".chat-input span");

        let userMessage = null; // Variable to store user's message

        // Paste your API key here
        const inputInitHeight = chatInput.scrollHeight;

        const createChatLi = (message, className) => {
            // Create a chat <li> element with passed message and className
            const chatLi = document.createElement("li");
            chatLi.classList.add("chat", `${className}`);
            let chatContent = className === "outgoing" ? `<p></p>` : `<span class="material-symbols-outlined">
            <img class="iconChatsm" src="{{asset('/Image/iconChat.png')}}" alt=""></span> <p></p>`;
            chatLi.innerHTML = chatContent;
            chatLi.querySelector("p").textContent = message;
            return chatLi; // return chat <li> element
        }

        const generateResponse = (chatElement) => {
            const API_URL = "https://api.openai.com/v1/chat/completions";
            const messageElement = chatElement.querySelector("p");

            // Define the properties and message for the API request
            const requestOptions = {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${API_KEY}`
                },
                body: JSON.stringify({
                    model: "gpt-3.5-turbo",
                    messages: [{role: "user", content: userMessage}],
                })
            }

            // Send POST request to API, get response and set the reponse as paragraph text
            fetch(API_URL, requestOptions).then(res => res.json()).then(data => {
                messageElement.textContent = data.choices[0].message.content.trim();
            }).catch(() => {
                messageElement.classList.add("error");
                messageElement.textContent = "Ối! Đã xảy ra lỗi. Vui lòng thử lại.";
            }).finally(() => chatbox.scrollTo(0, chatbox.scrollHeight));
        }

        const handleChat = () => {
            userMessage = chatInput.value.trim(); // Get user entered message and remove extra whitespace
            if(!userMessage) return;

            // Clear the input textarea and set its height to default
            chatInput.value = "";
            chatInput.style.height = `${inputInitHeight}px`;

            // Append the user's message to the chatbox
            chatbox.appendChild(createChatLi(userMessage, "outgoing"));
            chatbox.scrollTo(0, chatbox.scrollHeight);
            
            setTimeout(() => {
                // Display "Thinking..." message while waiting for the response
                const incomingChatLi = createChatLi("Đang phân tích...", "incoming");
                chatbox.appendChild(incomingChatLi);
                chatbox.scrollTo(0, chatbox.scrollHeight);
                generateResponse(incomingChatLi);
            }, 600);
        }

        chatInput.addEventListener("input", () => {
            // Adjust the height of the input textarea based on its content
            chatInput.style.height = `${inputInitHeight}px`;
            chatInput.style.height = `${chatInput.scrollHeight}px`;
        });

        chatInput.addEventListener("keydown", (e) => {
            // If Enter key is pressed without Shift key and the window 
            // width is greater than 800px, handle the chat
            if(e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
                e.preventDefault();
                handleChat();
            }
        });

        sendChatBtn.addEventListener("click", handleChat);
        closeBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
        chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));

</script> --}}
                        
</body>
</html>
