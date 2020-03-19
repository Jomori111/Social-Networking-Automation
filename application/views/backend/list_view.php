<?php
  $this->load->view("backend/header");
?>


<div class="page-body">      
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5>Existing Lists</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 xl-100">
                <ul class="nav nav-tabs nav-primary" id="pills-warningtab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-warninghome-tab" data-toggle="pill" href="#pills-warninghome" role="tab" aria-controls="pills-warninghome" aria-selected="true">
                      <i class="icofont icofont-ui-home"></i>Existing List
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-warningprofile-tab" data-toggle="pill" href="#pills-warningprofile" role="tab" aria-controls="pills-warningprofile" aria-selected="false">
                      <i class="icofont icofont-man-in-glasses"></i>Additional Text
                    </a>
                  </li>
                </ul>
                <div class="tab-content" id="pills-warningtabContent">

                  <div class="tab-pane fade show active" id="pills-warninghome" role="tabpanel" aria-labelledby="pills-warninghome-tab">
                    <div class="row">
                      <div class="col-md-8" style="margin:auto">
                        <h6 class="m-t-10">Company</h6><hr>
                        <div class="form-group row">
                          <div class="col-lg-12">
                            <select id="company" name="company" class="form-control btn-square">
                              <?php foreach($company as $key => $com){?><option value = "<?=$com['id']?>"><?=$com['name']?></option><?php }?>
                            </select>
                          </div>
                        </div>
                      </div>  
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group row">
                              <label class="col-lg-12 control-label text-lg-left" for="company_message">Message</label>  
                              <div class="col-lg-9">
                                <input name="company_message"  id = "company_message" type="text" placeholder="Message" class="form-control btn-square input-md">
                              </div>
                              <div class="col-lg-3">
                                <button type="button" class="btn btn-success" id = "add_message">Add</button>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div id = "message_table"></div>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group row">
                              <label class="col-lg-12 control-label text-lg-left" for="company_link">Link</label>  
                              <div class="col-lg-3">
                                <input name="company_nick"  id = "company_nick" type="text" placeholder="Nickname" class="form-control btn-square input-md">
                              </div>
                              <div class="col-lg-6">
                                <input name="company_link"  id = "company_link" type="text" placeholder="https://yourwebsite.com" class="form-control btn-square input-md">
                              </div>
                              <div class="col-lg-3">
                                <button type="button" class="btn btn-success" id = "add_link">Add</button>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div id = "link_table"></div>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-6" style = "margin-top: 2rem">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group row">
                              <label class="col-lg-12 control-label text-lg-left" for="company_hash">hashtag</label>  
                              <div class="col-lg-9">
                                <input name="company_hash"  id = "company_hash" type="text" placeholder="hashtag" class="form-control btn-square input-md">
                              </div>
                              <div class="col-lg-3">
                                <button type="button" class="btn btn-success" id = "add_hash">Add</button>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div id = "hash_table"></div>
                          </div>
                        </div>
                      </div>



                      <div class="col-md-6" style = "margin-top: 2rem">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group row">
                              <label class="col-lg-12 control-label text-lg-left" for="company_hash">Add-on text</label>  
                              <div class="col-lg-9">
                                <input name="company_addon"  id = "company_addon" type="text" placeholder="Add-on text" class="form-control btn-square input-md">
                              </div>
                              <div class="col-lg-3">
                                <button type="button" class="btn btn-success" id = "add_addon">Add</button>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div id = "addon_table"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="pills-warningprofile" role="tabpanel" aria-labelledby="pills-warningprofile-tab">
                    <form action = "admin_list/add_additional_text" id = "additional_text" method="post">
                      <div class="row">
                        <div class="col-sm-6 col-xl-3 xl-50 col-lg-6 box-col-6">
                          <h3>Linkedin</h3>
                          <textarea class="form-control" rows = "6" name = "linkedin_text"></textarea>
                        </div>

                        <div class="col-sm-6 col-xl-3 xl-50 col-lg-6 box-col-6">
                          <h3>Facebook</h3>
                          <textarea class="form-control" rows = "6" name = "facebook_text"></textarea>
                        </div>

                        <div class="col-sm-6 col-xl-3 xl-50 col-lg-6 box-col-6">
                          <h3>Twitter</h3>
                          <textarea class="form-control" rows = "6" name = "twitter_text"></textarea>
                        </div>

                        <div class="col-sm-6 col-xl-3 xl-50 col-lg-6 box-col-6">
                          <h3>Instagram</h3>
                          <textarea class="form-control" rows = "6" name = "instagram_text"></textarea>
                        </div>

                        <div class="col-md-12">
                          <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  $this->load->view("backend/footer");
?>
<input type="hidden" id = "hidden_company_id" value = "<?=$company[0]['id']?>">
<script src="assets/frontend/js/list.js"></script>
