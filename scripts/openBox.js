    //open dialog box
    function openConfirmBox(event) {
        event.preventDefault();
        document.getElementById("confirmModal").style.display = "block";
      }
      
      function closeConfirmBox() {
        document.getElementById("confirmModal").style.display = "none";
      }
      

      function confirmLogout(event) {
        event.preventDefault(); 
        document.getElementById("confirmModal").style.display = "block";
      }

         
      function closeLogout() {
        document.getElementById("confirmModal").style.display = "none";
      }