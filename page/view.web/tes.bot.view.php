 <style type="text/css">
   body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
}

.chat-container {
  max-width: 400px;
  margin: 20px auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.chat-display {
  max-height: 300px;
  overflow-y: auto;
  padding: 10px;
}

.bot-message {
  background-color: #f2f2f2;
  padding: 8px;
  margin-bottom: 10px;
  border-radius: 5px;
}

.user-input {
  display: flex;
  margin-top: 10px;
}

#user-input {
  flex-grow: 1;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

#send-button {
  padding: 8px 15px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

 </style>

 <div class="chat-container">
    <div class="chat-display" id="chat-display">
      <div class="bot-message">Halo! Saya BotChat. Ada yang bisa saya bantu?</div>
    </div>
    <div class="user-input">
      <input type="text" id="user-input" placeholder="Ketik pesan...">
      <button id="send-button">Kirim</button>
    </div>
  </div>

  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
  const chatDisplay = document.getElementById("chat-display");
  const userInput = document.getElementById("user-input");
  const sendButton = document.getElementById("send-button");

  sendButton.addEventListener("click", function () {
    const userMessage = userInput.value.trim();
    if (userMessage !== "") {
      displayUserMessage(userMessage);
      getBotResponse(userMessage);
      userInput.value = "";
    }
  });

  function displayUserMessage(message) {
    const userMessageDiv = document.createElement("div");
    userMessageDiv.className = "user-message";
    userMessageDiv.innerHTML = message;
    chatDisplay.appendChild(userMessageDiv);
    chatDisplay.scrollTop = chatDisplay.scrollHeight;
  }

  function displayBotMessage(message) {
    const botMessageDiv = document.createElement("div");
    botMessageDiv.className = "bot-message";
    botMessageDiv.innerHTML = message;
    chatDisplay.appendChild(botMessageDiv);
    chatDisplay.scrollTop = chatDisplay.scrollHeight;
  }

  function getBotResponse(userMessage) {
    // Di sini, Anda bisa menggunakan logika untuk menghasilkan respons bot
    // Contoh sederhana: Echo balik pesan pengguna
    const botResponse = "Anda berkata: " + userMessage;
    displayBotMessage(botResponse);
  }
});

  </script>