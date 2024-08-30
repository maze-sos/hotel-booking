<?php require "../includes/header.php" ?>
<?php require "../config/config.php" ?>

<style>
  /* Apply some basic styling to the form */
#paymentForm {
  max-width: 400px;
  margin: 100px auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: white;
}

/* Style for form groups (labels and inputs) */
.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

input {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 3px;
}

/* Style for the submit button */
.form-submit {
  text-align: center;
}

button {
  padding: 5px 20px;
  background-color: #FC456A;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
  font-size: 16px;
}

button:hover {
  background-color: #fff;
  color: #FC456A;
}

</style>

<?php
  if(!isset($_SERVER['HTTP_REFERER'])){
echo  "<script>window.location.href='".APPURL."'</script>";
    exit;
}
?>

    <div class="hero-wrap js-fullheight" style="background-image: url('<?php echo APPURL; ?>/images/image_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate">
        <form id="paymentForm">
        <h2>Pay For Room</h2>
        <div class="form-group">
          <label for="roomname">Room Name</label>
          <input type="text" id="roomname" value="<?php echo $_SESSION['name']; ?>" readonly/>
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email-address" value="<?php echo $_SESSION['email']; ?>" readonly />
        </div>
        <div class="form-group">
          <label for="amount">Amount (Naira)</label>
          <input type="tel" id="amount" value="<?php echo $_SESSION['price']; ?>" readonly/>
        </div>
        <div class="form-group">
          <label for="first-name">Username</label>
          <input type="text" id="first-name"  value="<?php echo $_SESSION['username']; ?>" readonly/>
        </div>
        <div class="form-submit">
          <button id="launch-btn" type="button"> Pay </button>
        </div>
<script type="application/javascript">
    const copyToClipboard = text => {
      const elm = document.createElement('textarea');
      elm.value = text;
      document.body.appendChild(elm);
      elm.select();
      document.execCommand('copy');
      document.body.removeChild(elm);
    };
    var connect;
    var config = {
      key: "test_pk_ku8af8e0gc6hibayqx5b",
      onSuccess: function (response) {
        copyToClipboard(response.code);
        console.log(JSON.stringify(response));
        alert(JSON.stringify(response));
        window.location.href = "<?php echo APPURL; ?>"
        /**
         response : { "code": "code_xyz" }
        you can send this code back to your server to get this
        authenticated account and start making requests.
        */

      },
      onClose: function () {
        console.log('user closed the widget.')
        window.location.href = "<?php echo APPURL; ?>"
      }
    };
    connect = new Connect(config);
    connect.setup();
    var launch = document.getElementById('launch-btn');
    launch.onclick = function (e) {
      connect.open();
    };
</script>
</form>
          </div>
        </div>
      </div>
    </div>


<?php require "../includes/footer.php" ?>