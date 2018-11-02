<div class="app-form-message-box">
  <div class="app-form-submition-info js-form-submission">
    <div class="app-submission-process">
      <div class="loader d-inline-block mr-3"></div>
      <div class="text-info d-inline-block">Submission in process, please wait..</div>
    </div>
  </div>

  <strong class="text-success app-form-submition-info js-form-success">Message successfully submitted, Thank you!</strong>
  <strong class="text-danger app-form-submition-info js-form-error">There was a problem with Contact Form, Please try again!</strong>
</div>

<form action="#" method="post" id="sunsetContactForm" data-url="<?php echo admin_url( 'admin-ajax.php' ); ?>">

  <div class="form-group">
    <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required="required">

    <div class="invalid-feedback">
      Please provide a valid name.
    </div>
  </div>

  <div class="form-group">
    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="required">

    <div class="invalid-feedback">
      Please provide a valid email.
    </div>
  </div>

  <div class="form-group">
    <textarea name="message" id="message" class="form-control"  placeholder="Your Message" required="required"></textarea>

    <div class="invalid-feedback">
      Please provide a valid message.
    </div>
  </div>

  <button type="submit" class="btn btn-default">Submit</button>
  
</form>
