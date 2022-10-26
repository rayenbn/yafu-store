<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="enquiry-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h1 style="font-size: 28px;">Request for Free Conslutation</h1>
       
        <form class="form-quote" action="{{ url('get-a-quote/send') }}" method="post">
          {{ csrf_field() }}
          <div class="form-group row">
            <div class="form-field col-md-6 form-m-bttm">
              <input name="name" type="text" placeholder="Name *" class="form-control required" >
            </div>
            <div class="form-field col-md-6">
              <input name="company" type="text" placeholder="Company" class="form-control" >
            </div>
          </div>
          <div class="form-group row">
            <div class="form-field col-md-6 form-m-bttm">
              <input name="email" type="email" placeholder="Email *" class="form-control required email" required>
            </div>
            <div class="form-field col-md-6">
              <input name="phone" type="text" placeholder="Phone *" class="form-control required" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="form-group col-md-6 ">
                <label for="reach">Best Time to Reach</label>
                <select class="form-control js-select2 hover select2-hidden-accessible" name="reach" data-placeholder="List default" tabindex="-1" aria-hidden="true" required>
                    <option value="">Please select</option>
                    <option value="09am-12pm">09 AM - 12 PM</option>
                    <option value="12pm-03pm">12 PM - 03 PM</option>
                    <option value="03pm-06pm">03 PM - 06 PM</option>
                </select>
            </div>
           
            <div class="form-group col-md-6">
                <label name="hear">Hear About Us</label >
                <select class="form-control js-select2 hover select2-hidden-accessible" name="hear" data-placeholder="List default"  tabindex="-1" aria-hidden="true" required>
                <option value="">Please select</option>
                  <option value="Friends" >Friends</option>
                  <option value="Facebook" >Facebook</option>
                  <option value="Google" >Google</option>
                  <option value="Collegue" >Collegue</option>
                  <option value="Others" >Others</option>
                </select>
            </div>
            
            



            
            
          </div>
          <div class="form-group row">
            <div class="form-field col-md-12">
              <textarea name="message" placeholder="Messages *" rows="10" class="txtarea form-control required" required></textarea>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Send Enquiry</button>
      </div>
      <div class="form-results"></div>
      </form>
    </div>
  </div>
</div>