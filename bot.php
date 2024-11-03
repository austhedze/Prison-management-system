<?php
session_start();

if ($_SESSION['role'] != 'user') {
    header('Location: login.php');
    exit;
}

include 'connection.php';

$username = $_SESSION['username'];
    
// Fetch user details from the database
 $sql = "SELECT * FROM users WHERE username = '$username'";
 $result = mysqli_query($conn, $sql);
 $user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obtain answers to FAQs</title>
    <style>
    body { 
        font-family: Arial, sans-serif; 
        background-color: #2c2c3e;
        display: flex; 
        justify-content: center; 
        align-items: center; 
        height: 100vh; 
        margin: 0; 
    }

    .sidebar {
        width: 20%;
        background-color: #2c2c3e;
        padding: 20px;
        color: white;
        position: fixed;
        height: 100%;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        left: 0;
    }

    .sidebar img {
        width: 100px;
        height: 100px;
        border-radius: 2px;
        margin-bottom: 20px;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        padding: 4px;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        background-color: #323554;
        transition: background-color 0.3s;
        font-size: 16px;
    }

    .sidebar a:hover {
        background-color: orangered;
    }

    .sidebar .icon {
        width: 30px;
        height: 30px;
        margin-right: 20px;
        margin-top: 20px;
    }

    #chat-container { 
        width: 100%; 
        max-width: 600px; 
        background: rgba(0, 0, 0, 0.5);
        border-radius:  20px; 
        backdrop-filter: blur(10px); 
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); 
        overflow: hidden; 
        display: flex;
        flex-direction: column;
        height: 80vh;
    }

    #chatbox { 
        padding: 15px; 
        background: rgba(0, 0, 0, 0.1);
        flex-grow: 1;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .message { 
        padding: 10px 10px; 
        border-radius: 20px 0px 20px 0px; 
        max-width: 75%; 
        word-wrap: break-word; 
        display: flex;
        align-items: center;
        color: white; 
    }

    .user { 
        background-color: rgba(0, 123, 255, 0.7); 
        color: white; 
        align-self: flex-end;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); 
    }

    .bot { 
        background-color: rgba(32, 201, 151, 0.7); 
        color: white; 
        align-self: flex-start;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    #userInputContainer { 
        display: flex; 
        padding: 10px; 
        background: rgba(255, 255, 255, 0.6);
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    #userInput { 
        flex: 1; 
        padding: 10px; 
        border: none;
        border-radius: 20px; 
        font-size: 14px; 
        outline: none;
        color: white;
        background-color: rgba(255, 255, 255, 0.2);
    }

    #sendButton { 
        padding: 10px 20px; 
        border: none; 
        background-color: rgba(0, 123, 255, 0.8);
        color: white; 
        border-radius: 20px; 
        cursor: pointer; 
        margin-left: 10px; 
        transition: background-color 0.3s; 
    }

    #sendButton:hover { 
        background-color: rgba(0, 123, 255, 1); 
    }

    .bot-avatar {
        width: 30px; 
        height: 30px;
        border-radius: 50%; 
        margin-left: 10px;
        align-self: flex-end; 
    }

    
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: static;
            box-shadow: none;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar img {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
        }

        .sidebar a {
            font-size: 14px;
            padding: 8px;
            margin-bottom: 10px;
            display: inline-flex;
            align-items: center;
        }

        #chat-container {
            width: 100%;
            max-width: 100%;
            height: calc(100vh - 140px);
        }

        #userInputContainer {
            padding: 5px;
        }

        #userInput {
            font-size: 12px;
            padding: 8px;
        }

        #sendButton {
            padding: 8px 16px;
            font-size: 12px;
        }
    }
    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 3px solid lightgreen;
        display: block;
        float: right;
        right: 0;
        top:20px;
        position: absolute;
        margin-right:30px;

    }
 
</style>

</head>
<body>

    <div class="sidebar" style="background-color: #2c2c3e;">

<img src='images/logo.jpg' style='width: 100px; height:100px; border-radius:45px'>
<div class="spacer" style='height:5px'>

</div>
<a href="user_dashboard.php">
    <img src="icons/home.png" alt="Dashboard" class="icon"> Home
</a>
<div class="spacer" style='height:30px'></div>
<a href="request_visit.php">
    <img src="icons/visit.png" alt="Add Inmate" class="icon"> visitation
</a>
</a>
<div class="spacer" style='height:30px'></div>
<a href="staffs.php">
    <img src="icons/staff.png" alt="Add Staff" class="icon">Staffs
</a>
<div class="spacer" style='height:30px'></div>

<div class="spacer" style='height:30px'></div>
<a href="logout.php" onclick="return confirm('Are You sure you want to LogOut?')">
    <img src="icons/logout.png" alt="Logout" class="icon"> Logout
</a>
</div>

<a href="user_profile.php">

<div>
    <img src="<?php echo $user['user_profile_picture'] && file_exists($user['user_profile_picture']) ? $user['user_profile_picture'] : 'icons/person.png'; ?>"
        class="avatar" alt="Avatar">
</div>
</a>


    <div id="chat-container">
    <div id="chatbox">
        <div class="message bot">
            <span>Hello <span style="color:orange"> <?php echo ucfirst(explode('@', $_SESSION['username'])[0]); ?>! </span>How can I help you with prison-related queries today?</span>
            <img src="images/logo.jpg" alt="Bot Avatar" class="bot-avatar" />
        </div>
    </div>

    <div id="userInputContainer">
        <input type="text" id="userInput" placeholder="Type your question here..." />
        <button id="sendButton" onclick="sendMessage()">Send</button>
    </div>
</div>

<script>
  const faqs = [
    { keywords: ["who", "your name"], answer: "I am Web-D Group3 Prison Management Information System chatbot created to provide assistance with frequently asked questions related to prison management." },
    { keywords: ["hi"], answer: "Yes, hello! How can I assist you today?" },
      { keywords: ["yes"], answer: "fantanstic, you are eager to learn, ask more !" },
    { keywords: ["okay"], answer: "nice, thank you very much for your understanding" },
    { keywords: ["what", "are", "the ", "mostly", "most", "frequent", "committed", "crimes"], answer: "frequently committed crimes include, theft, murder, smuggling and rape, however some recent research indicates that familily issues including divorce matters are at an alarmig late, how would mind learning more of this?" },
    { keywords: ["who", "created", "made"], answer: "I was built by Web Dev Group 3 members: Upendo, Mirrium, Eliot, Lenzo, Austin, and Moses" },
    { keywords: ["contact", "inmate"], answer: "Inmates can be contacted through written letters or during visitation hours. Phone calls may be available for certain inmates." },
    { keywords: ["visit", "when", "days", "inmate"], answer: "Visitation is generally available any day, but weekends may have limited access." },
    { keywords: ["contact", "pmis", "staff", "member"], answer: "You can contact any of the PMIS staff members for assistance." },
    { keywords: ["how many", "accounts"], answer: "You can have only one account in this system." },
    { keywords: ["hello", "hy", "ey", "pmis",], answer: "Hi there! Let's chat. How can I help?" },
    { keywords: ["okay", " thanks ", "thank you" ], answer: "You are most welcome !" },
     { keywords: [ "what is your basic", "what is your fundamental", "what is your policy","can my sentence be reduced","handling inmate", "handle inmate", "structure", "basic", "fundamental", "policy" ], answer: "Sure am glad to help you with that, well For cases such murder and rape, for both gender sentence reduction remains unchanged, however it does for other types of crimes such as theft among others. This implies that if you are over 50 years of age your sentence slashes by half unless you committed rape or maurder.Moreover its slashes down by quater when you plead guity. was this response helpful ?" },
    { keywords: ["why", "how",], answer: "My knowledge is limited, consider contacting any staff member" },
    { keywords: ["visit", "inmate", "prisoner"], answer: "To visit an inmate, please submit a visitation request to the visitation manager." },
    { keywords: ["when", "not", "visit"], answer: "Visits may vary on holidays. Please check with the visitation office for holiday schedules." },
    { keywords: ["send", "packages", "inmate"], answer: "Packages are allowed only during approved dates and must contain items from the approved list." },
    { keywords: ["how", "release", "inmate"], answer: "Inmate release dates are based on sentence completion, or they may be eligible for parole based on behavior and other factors." },
    { keywords: ["who", "can", "visit"], answer: "Immediate family members, legal representatives, and approved contacts are generally allowed to visit inmates." },
    { keywords: ["what", "can", "bring", "visitor"], answer: "Please bring only ID and approved items. Personal belongings, like phones, are usually not allowed inside visitation areas." },
    { keywords: ["how", "send", "money",  "prisoner","inmate"], answer: "You can send money through an approved financial service or deposit it directly at the facility." },
    { keywords: ["can", "schedule", "appointment", "visit"], answer: "Appointments can be scheduled online or by calling the visitation office directly." },
    { keywords: ["where", "is", "inmate", "located"], answer: "You can inquire about an inmate's location through the inmate lookup service or by contacting the facility's administration." },
    { keywords: ["who", "is", "warden"], answer: "The current warden is responsible for the overall administration and management of the facility." },
    { keywords: ["rules", "for", "visitation"], answer: "Visitors must follow dress codes and arrive on time. Certain rules vary by facility, so please confirm before visiting." }
];

function findAnswer(userQuestion) {
            const lowerUserQuestion = userQuestion.toLowerCase();
            for (const faq of faqs) {
                if (faq.keywords.some(keyword => lowerUserQuestion.includes(keyword))) {
                    return faq.answer;
                }
            }
            return "Sorry, I couldn't find an answer to that question.";
        }

        function typeText(element, text, delay = 45) {
            element.innerHTML = ""; // Clear previous content
            let index = 0;

            function typing() {
                if (index < text.length) {
                    element.innerHTML += text.charAt(index);
                    index++;
                    setTimeout(typing, delay);
                }
            }
            typing();
        }

        function sendMessage() {
            const userInput = document.getElementById("userInput");
            const chatbox = document.getElementById("chatbox");

            if (userInput.value.trim() === "") return;

            const userMessage = document.createElement("div");
            userMessage.className = "message user";
            userMessage.textContent = userInput.value;
            chatbox.appendChild(userMessage);

            // Get bot's response
            const botResponse = findAnswer(userInput.value);
            const botMessage = document.createElement("div");
            botMessage.className = "message bot";
            chatbox.appendChild(botMessage);

            // Type the bot's response
            typeText(botMessage, botResponse);

            userInput.value = ""; 
            chatbox.scrollTop = chatbox.scrollHeight;
        }
    </script>

</body>
</html>
