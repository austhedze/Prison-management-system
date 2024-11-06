    //open dialog box
    function openConfirmBox(event) {
        event.preventDefault(); // Prevent the default link action
        document.getElementById("confirmModal").style.display = "block";
      }
      
      function closeConfirmBox() {
        document.getElementById("confirmModal").style.display = "none";
      }
      