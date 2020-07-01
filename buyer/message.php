<?php include 'inc/header.php'; ?>

                    <div class="app-inner-layout__wrapper ml-4 mr-4 mb-4">
                        
                       <?php include("../app/message_view.php"); ?>
                    </div>
<div class="chat-popup" id="myForm">
  <div class="form-container">
    <h6 style="padding-top: 7px; padding-bottom: 7px;">Message Seller/Admin/Buyer</h6>
    <hr>
    <div class="form-group">
        <label for="msg"><b>User/Seller</b></label>
        <input type="text" class="form-control" id="userid" onchange="loadChatbox(this.id)" onclick="fetch_seller(this.id);"  onfocus="fetch_seller(this.id);" onkeyup="fetch_seller(this.id);" required>

    </div>
    <div id="chat-box$('#userid.id')" class="chatbox" style="overflow: scroll;
    max-height: 150px;"></div>
    <div class="form-group">
        <label for="msg"><b>Message</b></label>
        <textarea placeholder="Type message.." id="b_message" name="b_message" rows="2" required></textarea>
    </div>
    <button type="submit" onclick="ReplyChatbox()"class="btn btn-sm">Send</button>
    <button type="button" class="btn btn-sm cancel" onclick="closeForm()">Close</button>

</div>
</div>
<?php include 'inc/footer.php'; ?>
<script>
$.ajax({
  type: 'GET',
  url: '../api/controllers/get_message_view.php',
  data: {
    view : "inbox"
  },
  cache: false,
  dataType: 'text',
  success: function (response) {
    $('#view').html(response)

  },
  error: function (response) {

  }
});
</script>

<script type="text/javascript">
     function sendmessage(uid){
         $('#messenger').modal('show');
     }

    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
</script>
