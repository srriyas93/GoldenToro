<!-- Include Header --> 
<?php
    include('page_header.php');
?>
<!-- Include Other Files -->
<?php 
    include('customers-ajax.php');
?>
<!-- Include Left Side Bar --> 
<?php
    include('page_left-sidebar.php');
?>
<!-- Include Right Side Bar --> 
<?php
    include('page_right-sidebar.php');
?>

<!-- Main Content -->
<section class="content page-calendar">
      <div class="body_scroll">
            <div class="block-header">
                  <div class="row">
                        <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Calendar</h2>
                        <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="dashboard.php"><i class="zmdi zmdi-home"></i> Home</a>
                              </li>
                              <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                              <li class="breadcrumb-item active">Trading Calendar</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                    class="zmdi zmdi-sort-amount-desc"></i></button>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                    class="zmdi zmdi-arrow-right"></i></button>
                        </div>
                  </div>
            </div>
            <div class="container-fluid">
                  <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                              <div class="card">
                                    <div class="body">
                                          <div id="calendar"></div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</section>
<!-- Add New Event popup -->
<div class="modal fade" id="addNewEvent" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title"><strong>Add</strong> a holiday</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  </div>
                  <div class="modal-body">
                        <form>
                        <div class="row">
                              <div class="col-md-6">
                                    <label class="control-label">Holiday Name</label>
                                    <input class="form-control" placeholder="Enter name" type="text" name="category-name">
                              </div>
                              <div class="col-md-6">
                                    <label class="control-label">Choose Event Color</label>
                                    <select class="form-control" data-placeholder="Choose a color..." name="category-color">
                                    <option value="success">Success</option>
                                    <option value="danger">Danger</option>
                                    <option value="info">Info</option>
                                    <option value="primary">Primary</option>
                                    <option value="warning">Warning</option>
                                    </select>
                              </div>
                        </div>
                        </form>
                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-success save-event" data-dismiss="modal">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
            </div>
      </div>
</div>
<!-- Add Direct Event popup -->
<div class="modal fade" id="addDirectEvent" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title">Add a Holiday</h4>
                  </div>
                  <div class="modal-body">
                        <div class="row">
                              <div class="col-md-12">
                                    <div class="form-group">
                                          <label>Selected Date</label>
                                          <input type="text" id="txtEventDate" name="txtEventDate" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                          <label>Holiday Type*</label>
                                          <select id="ddlevent" name="ddlevent" class="form-control" required>
                                          <option value="1">Saturday</option>
                                          <option value="2">Sunday</option>
                                          <option value="3">Public Holiday</option>
                                          </select>
                                    </div>
                              </div>
                              <!-- <div class="col-md-6">
                                    <div class="form-group">
                                          <label>Holiday Name</label>
                                          <input class="form-control" name="event-name" type="text" />
                                    </div>
                              </div> -->
                        </div>
                  </div>
                  <div class="modal-footer">
                        <a class="btn save-btn btn-success" onclick="insertCalEvent();" href="javascript:void(0);">Save</a>
                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
            </div>
      </div>
</div>
<!-- Event Edit Modal popup -->
<div class="modal fade" id="eventEditModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title">Edit Holiday</h4>
                  </div>
                  <div class="modal-body">
                        <div class="row">
                              <div class="col-md-12">
                                    <div class="form-group">
                                          <label>Selected Date</label>
                                          <input type="text" class="form-control" value="10-09-2020" disabled>
                                    </div>
                                    <div class="form-group">
                                          <label>Holiday Type*</label>
                                          <select name="event-bg" class="form-control" required>
                                          <option value="1">Saturday</option>
                                          <option value="2">Sunday</option>
                                          <option value="3">Public Holiday</option>
                                          </select>
                                    </div>
                              </div>
                              <!-- <div class="col-md-6">
                                    <div class="form-group">
                                          <label>Holiday Name</label>
                                          <input class="form-control" name="event-name" type="text" />
                                    </div>
                              </div> -->
                        </div>
                  </div>
                  <div class="modal-footer">
                        <button class="btn mr-auto delete-btn btn-danger">Delete</button>
                        <button class="btn save-btn btn-success">Save</button>
                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>
            </div>
      </div>
</div>

<!-- Include Footer --> 
<?php
    include('page_footer.php');
?>